<?php
include('connection/dbconnection_crm.php');

$Invoice_Summary ="select Invoice_Summary from Options where Id = 1";
$qr_Invoice_Summary = mysqli_query($connect, $Invoice_Summary);
$dets_Invoice_Summary = mysqli_fetch_assoc($qr_Invoice_Summary);

function convert($sum) {
    $years = floor($sum / 365);
    $months = floor(($sum - ($years * 365))/30);
    $days = ($sum - ($years * 365) - ($months * 30));
    $rt = '';
    if($years>0){
        $rt .= $years.' years, ';
    }
    if($months>0){
        $rt .= $months.' months, ';
    }
    $rt.=  $days . " days";
    return $rt;
}

function GenRandPass($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


if($_POST){
    $sel = "select * from Customer_Payment_History where Costumer_ID = '".$_POST['CustomerId']."'";
    $sel_profile = "SELECT * FROM Customer_profile WHERE  Costumer_ID = '".$_POST['CustomerId']."'";
    $qry_profile = mysqli_query($connect, $sel_profile);
    $fetch_profile = mysqli_fetch_assoc($qry_profile);
    
    $qry = mysqli_query($connect, $sel);
   
    $Paid_Amout = 0;
    $Number_of_Days = '';
    while($row = mysqli_fetch_assoc($qry)){
        $fetch[] = $row;
        $Paid_Amout +=$row['Paid_Amout'];
        $datediff = strtotime($row['Exp_Date']) - strtotime($fetch_profile['Activation_Date']);
        
        $Number_of_Days = round($datediff/(60*60*24)) ;  //$row['Number_of_Days'];
    }
   
   
    
    $Email_ID = $fetch[0]['Email_ID'];
    $Mobile_No = str_replace(" ","",$fetch[0]['Mobile_No']);
    $Full_Name = $fetch[0]['Full_Name'];
    $PackageName = $fetch[0]['PackageName'];
    
     $sel = "select Customer_Portal from Options where Id = 1";
        $qry = mysqli_query($connect, $sel);
        $fetch_data = mysqli_fetch_assoc($qry);
        $Customer_Portal = $fetch_data['Customer_Portal'];
    $table = '					<table width="100%" class="table table-striped" border="0" cellspacing="0" cellpadding="0">
  <tbody>
  <tr>
   <td colspan="5" style="text-align:center"><h2>Invoice details</h2></td>
  </tr>
    <tr>
      <td style="font-size:16px;"><strong>#</strong></td>
      <td style="font-size:16px;"><strong>Date</strong></td>
      <td style="font-size:16px;"><strong>Invoice #</strong></td>
      <td style="font-size:16px;"><strong>Package</strong></td>
      <td style="font-size:16px;"><strong></td>
    </tr>
 
   
    <tr>
      <td style="font-size:16px;">1</td>
      <td style="font-size:16px;">'.date('d-F-Y',strtotime($fetch[0]['SaleDate'])).'</td>
      <td style="font-size:16px;">'.$fetch[0]['Costumer_ID'].'</td>
      <td style="font-size:16px;">'.$fetch[0]['PackageName'].'</td>
      <td style="font-size:16px;"><a href="'.$Customer_Portal.'RSI-Invoice-download.php?id='.$fetch[0]['Costumer_ID'].'" class="" style="background:#bf1d1d;color:#fff;padding: 10px 16px;text-decoration:none;font-size: 16px;">Download Invoice</a></td>
    </tr>
  
   
  </tbody>
</table>';
    //$Number_of_Days = $fetch[0]['Number_of_Days'];
    
    $sel = "select * from clients where Mobile = '".$Mobile_No."'";
    $qry = mysqli_query($connect, $sel);
    $get_dt = mysqli_fetch_assoc($qry);
    if($get_dt){
        $password = $get_dt['Password'];
    }
    else{
       $password = GenRandPass(); 
    }
    
    
     $sel = "select Payment_Receipt_MailTemplate from Options where Id = 1";
        $qry = mysqli_query($connect, $sel);
        $fetch_data = mysqli_fetch_assoc($qry);
       // print_r($fetch_data);
        $Payment_Receipt_MailTemplate = $fetch_data['Payment_Receipt_MailTemplate'];
        $var = array(
                '{{PRICING_DETAILS}}'=>$Paid_Amout,
                '{{PACKAGE_NAME}}'=>$PackageName,
                '{{NO_OF_DAYS}}'=>convert($Number_of_Days),
                '{{LOGIN_ID}}'=>$Mobile_No,
                '{{table}}'=>$table,
                '{{LOGIN_PASSWORD}}'=>$password
            );
            
            foreach($var as $key => $val){
                $Payment_Receipt_MailTemplate = str_replace($key,$val,$Payment_Receipt_MailTemplate);
            }
    
         $value = sendEmail($Email_ID,$Payment_Receipt_MailTemplate);  
    
            
    if(empty($get_dt)){
       
         
            
        $sql = "INSERT INTO clients (User,Password,Email,Mobile,Password_Changed_Date) values('".$Full_Name."','".$password."','".$Email_ID."','".$Mobile_No."','2021-10-01 01:01:01')";
        mysqli_query($connect, $sql);
        
    }


    $upd = "update Customer_Payment_History set Approval_Status = 'Approved' where Costumer_ID = '".$_POST['CustomerId']."'";
    mysqli_query($connect, $upd);
}
echo 'success';






//header("Location: customer-profile-new-this-month.php");


function sendEmail($to,$message){
        global $connect;
        $sel = "select Sales_Email,Info_Email,Support_Email from Options where Id = 1";
        $qry = mysqli_query($connect, $sel);
        $fetch = mysqli_fetch_assoc($qry);
        $Sales_Email = $fetch['Sales_Email'];
        $Info_Email = $fetch['Info_Email'];
        $Support_Email = $fetch['Support_Email'];
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$Sales_Email.'>' . "\r\n";
        $headers .= 'Cc: '.$Sales_Email . "\r\n";
        $headers .= 'Cc: '.$Info_Email . "\r\n";
        $subject = "Payment Details";
        if($mail = mail($to,$subject,$message,$headers)){
            return true;
        }
}

?>