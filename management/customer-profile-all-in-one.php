<?php  include('partial/session_start.php'); ?>

<?php
//***************ahsan
 // $UserName = $_GET['UserName'];

 // $Source = $_GET['Source'];

 // $Disposition = $_GET['Disposition'];

//***************ahsan
date_default_timezone_set('Asia/Kolkata');

$sel_sho_hide = "SELECT Show_Hide FROM Options WHERE Show_Hide IS NOT NULL LIMIT 1";
$qry_show_hide = mysqli_query($connect,$sel_sho_hide);
$fetch_show_hide = $qry_show_hide->fetch_assoc();
$show_hide = (array)json_decode($fetch_show_hide['Show_Hide']);


function diff_month($date1,$date2,$type=null){
    // echo $date1.'<br>';
    // echo $date2.'<br>';
    
    
    if($type != ''){
        $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);
        $diff = $datetime1->diff($datetime2);
        return $diff->days;
        //return 
        
        // return round(abs(strtotime($date1) - strtotime($date2))/(86400));  
    }
    else{
         $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);
        $diff = $datetime1->diff($datetime2);
        return $diff->days;
        
       // return round(abs(strtotime($date1) - strtotime($date2))/(86400*30),2);  
    } 
}

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
 ?>

<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Customer Profile</title>

<?php require('partial/plugins.php'); ?>
  
  


    

</head>

<body>

 <?php include('partial/sidebar.php') ?>

<div class="main_container">

<header>

  <?php include('partial/header-top.php') ?>
  
  <?php 
    // function definition is written in hearder-top.php
    // if agent bank details are missing, will redirect on agent login details page
    check_agent_bank_details();
  ?>
  
  <?php 
  if($_SESSION['Role'] == 'compliance officer' || $_SESSION['Role'] == 'Admin Assist'){ 
   //echo('<style> .compliance_officer_verified {display:block !important}</style>');
  }
  ?>
  
</header>

<div class="breadcurms">

 <div class="pull-left">

<?php include('partial/customer-profile-header-menu.php');?>






 </div>

 <!-- <div class="pull-right"><a href="#" class="btn btn-md btn-primary"  data-toggle="modal" data-target="#AddCustomerProfile"><i class="fa fa-plus"></i> Existing</a></div> -->


  
  <div class="pull-right" style="margin-right:15px;">
      <!--<a href="#" class="btn btn-xs btn-primary add-customer-profile-btn"  data-toggle="modal" data-target="#AddCustomerProfile"><i class="fa fa-plus"></i> New</a>-->
      </div>
  
  
  
  


 <div class="clearfix"></div>

</div>

<div class="containter" style="padding:20px 20px 0 20px;">

<?php include('connection/dbconnection_crm.php')?>

<?php



function calculateSum($type,$id){

    global $connect;

     $sel = "select Paid_Amout,Company_Amount,Tax_Amount from Customer_Payment_History where Costumer_ID = '$id'";

    $qry = mysqli_query($connect,$sel);

     $total_paid = 0;

     $com = 0;

     $tax = 0;

     while($row = $qry->fetch_assoc()){

         $total_paid = $total_paid + $row['Paid_Amout'];

         $com = $com+$row['Company_Amount'];

         $tax = $tax+ $row['Tax_Amount'];

     }

     if($type == 'paid'){

         return $total_paid;

     }

     else if($type == 'com'){

         return $com;

     }

     else if($type == 'tax'){

         return $tax;

     }

     else{

         return false;

     }

    

   

}





function agentList($id){

    global $connect;

     $sel = "select Agent_1,Agent_2,Agent_3 from Customer_Payment_History where Costumer_ID = '$id'";

     $qry = mysqli_query($connect,$sel);

      while($row = $qry->fetch_assoc()){

        $agent[] = $row['Agent_1'];

        $agent[] = $row['Agent_2'];

        $agent[] = $row['Agent_3'];

     }

    

     $agent = array_unique($agent);

     $li = "";

     foreach($agent as $agents){

         $li .= "<li>".$agents."</li>";

     }

     return $li;

}





function totalShared($cust_id){

    global $connect;

    $sel = "select Agent_1_Shared_Amount, Agent_2_Shared_Amount,Agent_3_Shared_Amount from Customer_Payment_History where Costumer_ID  = '$cust_id'";

    $qry = mysqli_query($connect,$sel);

    $sum = 0;

    while($fetch = $qry->fetch_assoc()){

        $sum = $sum + $fetch['Agent_1_Shared_Amount'] + $fetch['Agent_2_Shared_Amount'] + $fetch['Agent_3_Shared_Amount'];

    }

    return $sum;

}

//print_r(agentList(651));




if(isset($_GET['filter']) && $_GET['filter'] != ''){
    if($_GET['filter'] == 'this_month'){
        $sql = ("SELECT id,Welcome_Mail,Trading_Guidence_Mail, Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name,Compliance_Status, PPI_Credits, compliance_officer_verification,  Email_ID, Mobile_No, Pan_Number, Approval_Status, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,

        DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout,  Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount,Agent_2, Agent_2_Percentange,
        
            Agent_2_Shared_Amount,Agent_3, Agent_3_Percentange,
        
            Agent_3_Shared_Amount,utr_no,
        
        Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert , DATE_FORMAT( Created_payment_date,  '%d-%m-%Y %h %i' ) AS Created_payment_date FROM Customer_profile WHERE MONTH(SaleDate) = MONTH(CURRENT_DATE()) AND YEAR(SaleDate) = YEAR(CURRENT_DATE())  ORDER BY  `Id` DESC");
    
      }
    else if($_GET['filter'] == 'last_month'){
        $sql = ("SELECT id,Welcome_Mail,Trading_Guidence_Mail, Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name,Compliance_Status, PPI_Credits, compliance_officer_verification,  Email_ID, Mobile_No, Pan_Number, Approval_Status, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,

        DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout,  Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount,Agent_2, Agent_2_Percentange,
        
            Agent_2_Shared_Amount,Agent_3, Agent_3_Percentange,
        
            Agent_3_Shared_Amount,utr_no,
        
        Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert , DATE_FORMAT( Created_payment_date,  '%d-%m-%Y %h %i' ) AS Created_payment_date FROM Customer_profile WHERE YEAR(SaleDate) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
        AND MONTH(SaleDate) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)  ORDER BY  `Id` DESC");
    }
    else if($_GET['filter'] == 'last_3_months'){
        $sql = ("SELECT id,Welcome_Mail,Trading_Guidence_Mail, Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name,Compliance_Status, PPI_Credits, compliance_officer_verification,  Email_ID, Mobile_No, Pan_Number, Approval_Status, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,

DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout,  Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount,Agent_2, Agent_2_Percentange,

    Agent_2_Shared_Amount,Agent_3, Agent_3_Percentange,

    Agent_3_Shared_Amount,utr_no,

Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert , DATE_FORMAT( Created_payment_date,  '%d-%m-%Y %h %i' ) AS Created_payment_date FROM Customer_profile WHERE (SaleDate>= DATE_FORMAT(CURDATE(),'%Y-%m-01') - INTERVAL 3 MONTH)  ORDER BY  `Id` DESC");

    }
    
    else if($_GET['filter'] == 'last_6_months'){
        $sql = ("SELECT id,Welcome_Mail,Trading_Guidence_Mail, Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name,Compliance_Status, PPI_Credits, compliance_officer_verification,  Email_ID, Mobile_No, Pan_Number, Approval_Status, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,

DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout,  Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount,Agent_2, Agent_2_Percentange,

    Agent_2_Shared_Amount,Agent_3, Agent_3_Percentange,

    Agent_3_Shared_Amount,utr_no,

Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert , DATE_FORMAT( Created_payment_date,  '%d-%m-%Y %h %i' ) AS Created_payment_date FROM Customer_profile WHERE (SaleDate>= DATE_FORMAT(CURDATE(),'%Y-%m-01') - INTERVAL 7 MONTH)  ORDER BY  `Id` DESC");

    }
    
}
else{
    if(isset($_GET['cust']) && $_GET['cust'] != ''){
        $sql = ("SELECT id,Welcome_Mail,Trading_Guidence_Mail, Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name,Compliance_Status, PPI_Credits, compliance_officer_verification,  Email_ID, Mobile_No, Pan_Number, Approval_Status, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,
        
        DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout,  Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount,Agent_2, Agent_2_Percentange,
        
            Agent_2_Shared_Amount,Agent_3, Agent_3_Percentange,
        
            Agent_3_Shared_Amount,utr_no,
        
        Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert , DATE_FORMAT( Created_payment_date,  '%d-%m-%Y %h %i' ) AS Created_payment_date FROM Customer_profile WHERE Costumer_ID = '".$_GET['cust']."'  ORDER BY  `Id` DESC LIMIT 50");
   
    }
    else{
       $sql = ("SELECT id,Welcome_Mail,Trading_Guidence_Mail, Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name,Compliance_Status, PPI_Credits, compliance_officer_verification,  Email_ID, Mobile_No, Pan_Number, Approval_Status, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,
        
        DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout,  Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount,Agent_2, Agent_2_Percentange,
        
            Agent_2_Shared_Amount,Agent_3, Agent_3_Percentange,
        
            Agent_3_Shared_Amount,utr_no,
        
        Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert , DATE_FORMAT( Created_payment_date,  '%d-%m-%Y %h %i' ) AS Created_payment_date  FROM Customer_profile  ORDER BY  `Id` DESC LIMIT 50");
    
    }
       
}



//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");

/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin

FROM fut_hni");*/
// echo $sql;
$result = mysqli_query($connect,$sql);

echo('<table id="Admin_Customer_Profile" class="display" cellspacing="0" width="100%">');

echo('<thead>');

 echo('<tr>');

 // echo('<th style="">Approval_Status</th>');
//print_r($_SESSION);

if($_SESSION['Role'] == 'Super Admin' || $_SESSION['Role'] == 'Admin Assist' || $_SESSION['Role'] == 'compliance officer'){ 
  echo('<th>Admin Approval</th>');
  }
  
  //echo('<th>Compliance officer verification status</th>');
  
    echo('<th>Compliance status</th>');
    echo('<th>Costumer ID</th>');
  
  echo('<th>Download Invoice</th>');
  if($show_hide['Welcome_Email_Status']){
  echo('<th>Welcome Email Status</th>');
  }
  echo('<th>Trading Guidence Email Status</th>');

  echo('<th><div style="width:120px;"></div>Sale Date</th>');

  echo('<th>Created Payment Date</th>');

  echo('<th><div style="width:120px;"></div>Sale Month</th>');

  echo('<th>Full Name</th>');

  //echo('<th>Last Name</th>');

  echo('<th>Email ID</th>');

  echo('<th>Mobile No</th>');

  

  echo('<th>Package Name</th>');

  echo('<th>Activation Date</th>');

  echo('<th>Exp Date</th>');
  echo '<th>No Of Days</th>';
  echo '<th>Discount</th>';

  echo('<th>PPI Credits Recharge</th>');

  echo('<th>PPI Credits Available</th>');

  echo('<th><div style="width:120px;"></div>Status</th>');

  echo('<th >Remark</th>');

  echo('<th>Total Amout Received</th>');

  echo('<th>Company Amount</th>');

    echo('<th>Tax Amount</th>');

  //echo('<th>Payment Mode</th>');

  echo('<th>Agent Full Name</th>');



  echo('<th>Share</th>');
if($show_hide['Date_of_Birth']){
  echo('<th>Date Of Birth</th>');
}
if($show_hide['KYC']){
  echo('<th>KYC</th>');
}
if($show_hide['PanNumber']){
  echo('<th>Pan Number</th>');
}
 if($show_hide['Risk_Score']){
  echo('<th>Risk Score</th>');
 }
  if($show_hide['Risk_Level']){
  echo('<th>Risk Level</th>');
 }
 
  

  echo('<th>Date Time</th>');

  
   echo('<th>UTR NO#.</th>');

  //echo('<th>Positive</th>');

  //echo('<th>Negative</th>');

  //echo('<th>Open</th>');
  echo '<th>Package Price</th>';
  
  
  echo('<th>Delete</th>');

  echo('</tr>');

echo('</thead>');

echo('<tbody>');
$i = 0;

while($row = $result->fetch_array())

{
  /*  $i++;
if($i == 2){
   // break;
}*/

    $new_sel = 'SELECT count(*) as cn FROM `stock_tips` WHERE DATE(Date) >= "'.date('Y-m-d',strtotime($row['ActivationDate'])).'" AND DATE(Date) <= "'.date('Y-m-d').'" and 

    Result = "Positive" and Sagment ="'.$row['PackageName'].'"';

  

    $qrys = mysqli_query($connect,$new_sel);

  //echo($new_sel);

    $fet = $qrys->fetch_assoc();

    if($fet){

        $balance = $fet['cn'];

    }

    else{

        $balance = 0;

    }

    if($row['PPI_Credits']-$balance<0){

        $avl_bal = 0;

    }

    else{

        $avl_bal = $row['PPI_Credits']-$balance;

    }

echo('<tr>');
 
if($_SESSION['Role'] == 'Super Admin' || $_SESSION['Role'] == 'Admin Assist' || $_SESSION['Role'] == 'compliance officer'){
echo('<td>');   

if($_SESSION['Role'] == 'compliance officer'){
    if($row['Approval_Status'] == 'Pending'){
        echo '<span class="btn btn-danger">'.$row['Approval_Status'].'</span>';
    }
    else{
        echo '<span class="btn btn-success">'.$row['Approval_Status'].'</span>';
    }
}
else{
//  if($row['Approval_Status'] == 'Pending'){

    $customer_payment_history_sql = "SELECT id,Costumer_ID, Approval_Status FROM Customer_Payment_History where Costumer_ID = ".$row['Costumer_ID']." AND Approval_Status != 'Approved'";
// echo $customer_payment_history_sql;
    $customer_payment_history_qrys = mysqli_query($connect,$customer_payment_history_sql);
    
      //echo($new_sel);
    
        $customer_payment_history_result = $customer_payment_history_qrys->fetch_assoc();
// echo "<pre>"; print_r($customer_payment_history_result); echo "</pre>";
     if(!empty($customer_payment_history_result)){
              echo '<span class="btn btn-danger">Pending</span><a type="button" value="Add" class="btn btn-success btn-xs" href="customer-profile-payment-history-new.php?cust='.$row['Costumer_ID'].'" style="margin-top:5px;" target="_blank">Approve now</a>';
     } else {
         if($row['Approval_Status'] != "Approved"){
             echo '<span class="btn btn-danger">'.$row['Approval_Status'].'</span><a href="javascript:void(0)" onclick="changeStatus('.$row['Costumer_ID'].')">Mark Approved And Send Invoice</a>';
         } else {
             echo '<span class="btn btn-danger">'.$row['Approval_Status'].'</span><a href="javascript:void(0)" onclick="changeStatus('.$row['Costumer_ID'].')">Resend Invoice</a>';
         }
                      
     }

//  }
}
 
 echo ('</td>');
 
}


  //echo('<td>');
 //if($row['compliance_officer_verification'] == 'Compliance officer verification pending'){
   //  echo '
    //<span class="btn btn-danger">'.$row['compliance_officer_verification'].'</span>
   // <a href="javascript:void(0)" onclick="compliance_officer_verification('.$row['Costumer_ID'].')" class="compliance_officer_verified">Approve now</a>';
 //}
 
 
 echo ('</td>');


 echo ('<td>');
?>
    <form method="post" action="Complaince_Status_Update.php">
        <input type="hidden" name="Costumer_ID" value="<?php  echo $row['Costumer_ID']; ?>" required />
        <!--<select class="form-control" name="Compliance_Status" onchange="this.form.submit()">-->
        <select class="form-control" name="Compliance_Status">
            <option value="No Compliance" <?php if($row['Compliance_Status'] == 'No Compliance'){ echo 'selected'; } ?>>No Compliance</option>
             <option value="Open" <?php if($row['Compliance_Status'] == 'Open'){ echo 'selected'; } ?>>Open</option>
              <option value="Close" <?php if($row['Compliance_Status'] == 'Close'){ echo 'selected'; } ?>>Close</option>
        </select>
    </form>
    <br>
    <?php
        if($row['Compliance_Status'] == 'Open'){
            echo '<span class="badge badge-danger" style="background:red;">Open</span>';
        }
        if($row['Compliance_Status'] == 'Close'){
            echo '<span class="badge badge-success" style="background:green;">Close</span>';
        }
    ?>
<?php
 
 echo ('</td>');
  
   echo('<td>');//$row['Costumer_ID']
  
   if($_SESSION['Role'] == 'Super Admin' || $_SESSION['Role'] == 'Admin Assist'){
   echo (' <form  action="customer-profile-update.php" method="get" target="_blank"><input type="hidden" name="Costumer_ID" value="'.$row['Costumer_ID'].'"/> <input type="Submit" class="btn btn-primary btn-xs Edit-btn" value="Edit" target="_blank"/></form>');
   
   }
   else if($_SESSION['Role'] == 'compliance officer' && $row['Approval_Status'] == 'Pending' ){
       echo ('
   <form  action="customer-profile-update.php" method="get" target="_blank"><input type="hidden" name="Costumer_ID" value="'.$row['Costumer_ID'].'"/> <input type="Submit" class="btn btn-primary btn-xs Edit-btn" value="Edit" target="_blank"/></form>');
   
   }
  
  //echo $_SESSION['Role'];
   
  echo (' <a type="button" value="Add" class="btn btn-success btn-xs" href="customer-profile-payment-history-new.php?cust='.$row['Costumer_ID'].'" style="margin-top:5px;" target="_blank">Details</a> <a type="button" value="Add" class="btn btn-success btn-xs" href="Compliance_History.php?cust='.$row['Costumer_ID'].'" style="margin-top:5px;">Complaint History</a></td>');
 
//   echo('<td><a href="RSI-Invoice-download.php?id='.$row['Costumer_ID'].'&t='.time().'" class="btn btn-danger btn-xs invoice"><i class="fa fa-download" aria-hidden="true"></i> Invoice<a/></td>');
  echo('<td><a href="customer-profile-invoice.php?id='.$row["Costumer_ID"].'" class="btn btn-danger btn-xs invoice" download target="_blank"><i class="fa fa-download" aria-hidden="true"></i> Invoice<a/></td>');

?>
<?php
if($show_hide['Welcome_Email_Status']){
echo('<td>');
    
        if($row['Welcome_Mail'] == 'Pending'){
            ?>
            <span class="badge" style="background:#ffc107;color:#000;">Welcome Email Pending</span>
            <?php
                if($row['Approval_Status'] == 'Approved'){
            ?>
            <br>
            <a href="Ajax_files/send-welcome-email.php?id=<?php echo $row['id']; ?>" style="text-align:center;"><button class="btn btn-xs btn-primary" style="margin-top:5px;margin-left:15px;">Send Welcome Email</button></a>
            <?php
                }
        }
        else{
            ?>
            <span class="badge" style="background:#1e7e34;color:#fff;">Welcome Email Sent</span>
            
            <?php
        }
  
    
echo('</td>');
}
  ?>

<td>
    <?php
        if($row['Trading_Guidence_Mail'] == 'Pending'){
            ?>
            <span class="badge" style="background:#ffc107;color:#000;">Trading Guidence Email Pending</span>
            <?php
                if($row['Approval_Status'] == 'Approved'){
            ?>
            <br>
            <a href="Ajax_files/send-trading-guidence-email.php?id=<?php echo $row['Costumer_ID']; ?>" style="text-align:center;"><button class="btn btn-xs btn-primary" style="margin-top:5px;margin-left:15px;">Send Trading Guidence Email</button></a>
            <?php
                }
        }
        else{
            ?>
            <span class="badge" style="background:#1e7e34;color:#fff;">Trading Guidence Email Sent</span>
            
            <?php
        }
    ?>
    
</td>


<?php
  echo('<td>'.$row['SaleDateIND'].'</td>');

   echo('<td>'.$row['Created_payment_date'].'</td>');

   echo('<td>'.date("M Y",strtotime($row['SaleDateIND'])).'</td>');

echo('<td>'.ucfirst($row['Full_Name']).'</td>');

//echo('<td>'.'<a href="'.'disposition.php?Mobile='.$row['Mobile'].'Blaster&Disposition=Sale&UserName='.$_SESSION['username'].'">'.$row['Mobile'].'</a></td>');

//echo('<td>'.$row['LastName'].'</td>');

 echo('<td>'.strtolower($row['Email_ID']).'</td>');

 echo('<td>'.$row['Mobile_No'].'</td>');



 echo('<td>'.$row['PackageName'].'</td>');

 echo('<td>'.date("d-M-Y", strtotime($row['ActivationDate'])).'</td>') ;

 echo('<td>'.date("d-M-Y", strtotime($row['ExpDate'])).'</td>') ;
 echo '<td>'. convert(diff_month($row['ActivationDate'],$row['ExpDate'],'days')).'</td>';
  
 
 $Sel_Package_Name = "SELECT Segment_Amount FROM Options WHERE Segment = '".$row['PackageName']."'";
$qry_package_name = mysqli_query($connect,$Sel_Package_Name);
$fetch_package_price = $qry_package_name->fetch_assoc();

$sel_amount_paid = "SELECT SUM(Paid_Amout) as Amount FROM `Customer_Payment_History` where Costumer_ID = '".$row['Costumer_ID']."'";
$qry_amount_paid = mysqli_query($connect,$sel_amount_paid);
$fetch_amount_paid = $qry_amount_paid->fetch_assoc();

$diff_month = diff_month($row['ActivationDate'],$row['ExpDate']);
$total_amount = (($fetch_package_price['Segment_Amount']/30)*$diff_month);


$Total_Discount = $total_amount-$fetch_amount_paid['Amount'];
if($total_amount != ""){
    $Discount_Percentage = round(($Total_Discount/$total_amount)*100);
    echo '<td>₹'.$Total_Discount.', '.$Discount_Percentage.'%</td>';
}

  echo('<td>'.$row['PPI_Credits'].'</td>');

  echo('<td> '.$avl_bal.' </td>');

 echo('<td class="'.$row['Status'].'">'.$row['Status'].'</td>');

 echo('<td >'.$row['Remark'].'</td>');

 echo('<td>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'.calculateSum("paid",$row['Costumer_ID']).'</td>');

 echo('<td>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'.calculateSum("com",$row['Costumer_ID']).'</td>');

  echo('<td>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'.calculateSum("tax",$row['Costumer_ID']).'</td>');

 //echo('<td>'.$row['PaymentMode'].'</td>');

 

?>

      <td>

          <ul class="agent-list">

          <?php

                echo agentList($row['Costumer_ID']);

         

           

           ?>

           </ul>

    </td>

     <td>

           <ul class="agent-list">

         <i class="fa fa-inr" aria-hidden="true"></i>

          <?php

          echo totalShared($row['Costumer_ID']);

           

           ?>

           </ul>

    </td>

     

      <?php

 

 $packagename = $row['PackageName']; 

$activation_date = date("Y-m-d", strtotime($row['ActivationDate']));

$expiry_date = date("Y-m-d", strtotime($row['ExpDate']));



// $qry = "select count(*) as counts from stock_tips where Sagment = '".$packagename."' and Result = 'Positive' and (Date BETWEEN '".$activation_date."' and '".$expiry_date."')";

// $qr = mysqli_query($connect,$qry);

// $d = mysqli_fetch_assoc($qr);

// $Positive = $d['counts'];



// $qry = "select count(*) as counts from stock_tips where Sagment = '".$packagename."' and Result = 'Negative' and (Date BETWEEN '".$activation_date."' and '".$expiry_date."')";

// $qr = mysqli_query($connect,$qry);

// $ds = mysqli_fetch_assoc($qr);

// $Negative = $ds['counts'];



// $qry = "select count(*) as counts from stock_tips where Sagment = '".$packagename."' and Result = 'Open' and (Date BETWEEN '".$activation_date."' and '".$expiry_date."')";

// $qr = mysqli_query($connect,$qry);

// $dss = mysqli_fetch_assoc($qr);



// $Open = $dss['counts'];

 

 
 if($show_hide['Risk_Score']){
 echo('<td>');

     if($row['Date_of_Birth']){

         echo $row['Date_of_Birth'];

     }

     else{

          echo "";

     }



 

 echo ('</td>') ;
 }
 

 
 if($show_hide['KYC']){
 echo('<td>'.$row['KYC'].'</td>');
 }
 if($show_hide['PanNumber']){
 echo('<td>'.strtoupper($row['Pan_Number']).'</td>');
 }
 if($show_hide['Risk_Score']){
 echo('<td>'.$row['Risk_Score'].'</td>');
 }
 if($show_hide['Risk_Level']){
 echo('<td>'.$row['Risk_Level'].'</td>');
}
 echo('<td>'.$row['DateTimeConvert'].'</td>');


 echo('<td>'.$row['utr_no'].'</td>');

//  echo('<td><a href="#" class="btn btn-success btn-xs">'.$Positive.'</a></td>');

//  echo('<td><a href="#" class="btn btn-danger btn-xs">'.$Negative.'</a></td>');

//   echo('<td><a href="#" class="btn btn-info btn-xs">'.$Open.'</a></td>');



    echo '<td>'.$fetch_package_price['Segment_Amount'].'</td>';
     
  
  if($row['Approval_Status'] == 'Pending' ){
       echo('<td><a href="#" class="btn btn-danger btn-xs" onclick="deleteCustomer('.$row['id'].','.$row['Costumer_ID'].')">Delete</a></td>');
  }
 else{
     echo '<td></td>';
 }

}

 echo('</tr>');

echo('</tbody>');

echo('</table>');

?>

</div>

</div>

<!-- Modal -->

<div class="modal fade" id="AddCustomerProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="AddCustomerProfileLabel">Customer Profile</h4>

      </div>

      <div class="modal-body">

      <form action="customer-profile-add-new.php" method="post" id="update_submit">

        <div class="alert alert-danger" style="display:none">

  <strong>Please fill mandatory fields </strong>

</div>

      <!-- -->

    <?php

$sql = "SELECT MAX(Costumer_ID) as MaximumID FROM Customer_profile";

$result = mysqli_query($connect,$sql);

?>

       <input type="hidden" id="Costumer_IDLast" value="<?php  echo mysqli_result($result, 0);?>"/>

       <input type="hidden" id="DateTime" name="DateTime"   value="<?php echo date("Y-m-d h:i:s") ?>"/>

<table width="100%"  border="0" class="table table-bordered" cellspacing="0" cellpadding="0"> <!--  -->

  <tbody>

    <tr>

      <td>Sale Date*</td>

      <td>Full Name*</td>

      <td>Pan Number</td>

     <td>Email ID</td>

    </tr>

    <tr>

      <td>

      <input type="hidden" value="" id="Costumer_ID" name="Costumer_ID" class="form-control" placeholder="Costumer ID" />

        <input type="text" value="" id="SaleDate" name="SaleDate"  class="form-control" placeholder="Sale Date"  autocomplete="off" required/>

       <input type="hidden" value="" id="altSaleDate" name="altSaleDate" class="form-control" placeholder="alt Sale Date"/>

      </td>

      <td><input type="text" value="" id="Full_Name" name="Full_Name"  class="form-control" placeholder="Full Name" required></td>

      <td><input type="text" value="" id="PanNumber" name="PanNumber"  class="form-control" placeholder="Pan Number" required/></td>

     <td><input type="text" value="" id="Email_ID" name="Email_ID" class="form-control" placeholder="Email ID" required/></td>

    </tr>

    <tr>

     <td>Package Name*</td>

      <td>Activation Date</td>

      <td>Mobile No*</td>

      <td>KYC</td>

    </tr>

    <tr>

      <td>

      <select class="form-control" id="PackageName" name="PackageName" required>

            <option value="">Select Package</option>

           <?php include('partial/segments.php') ?>

          </select>

      </td>

    <td>

       <input type="text" value="" id="Activation_Date" name="Activation_Date" class="form-control" placeholder="Activation Date"  autocomplete="off" required/>

       <input type="hidden" value="" id="altActivation_Date" name="altActivation_Date" class="form-control" placeholder="Activation Date"/>

      </td>

      <td><input type="text" value="" id="Mobile_No" name="Mobile_No" class="form-control" placeholder="Mobile No" required/></td>

      <td>

      <select class="form-control" id="KYC" name="KYC" required>

            <option value="" selected>Select</option>

            <option value="Download">Download</option>

            <option value="Fetch">Fetch</option>

            <option value="Scan">Scan copy</option>

          </select>

      </td>

    </tr>
    
      <tr>

     <td>Date of Birth *</td>

      <td>Payment Mode*</td>

      <td>Risk_Score</td>

      <td>Risk_Level</td>

    </tr>

   

    <tr>

        <td>

       <input type="text" value="" id="Date_of_Birth" name="Date_of_Birth" class="form-control" placeholder="Date of Birth"  autocomplete="off" required/>

       <input type="hidden" value="" id="altDate_of_Birth" name="altDate_of_Birth" class="form-control" placeholder="Date of Birth"/>

      </td>

      <td>

         <select class="form-control" id="PaymentMode" name="PaymentMode" required>

           <?php include('partial/payment_mode.php') ?>

          </select>

      </td>

    <td><input type="text" value="" id="Risk_Score" name="Risk_Score" class="form-control" placeholder="Risk Score" required/></td>

     <td>

      <select class="form-control" id="Risk_Level" name="Risk_Level" required="">

           <option value="" selected="">Select</option>

        <option value="Low">Low</option>

        <option value="Medium">Medium</option>

        <option value="High">High</option>

          </select>

     </td>

  

      

    </tr>

    <tr>

      

      <td>Expired Date</td>

      <td>Total Received Amount*</td>

      <td>Company Amount*</td>

      <td>Tax Amount*</td>

    </tr>

    <tr>

     

      

      <td>

       <input type="text" value="" id="Exp_Date" name="Exp_Date" class="form-control" placeholder="Expired Date"  autocomplete="off" required/>

       <input type="hidden" value="" id="altExp_Date" name="altExp_Date" class="form-control" placeholder="Expired Date"/>

      </td>

     <td><input type="text" value="" id="TotalReceivedAmount" name="TotalReceivedAmount" class="form-control" placeholder="Total Received Amount" required/></td>

    

      <td>

    <input type="text" value="" id="Company_Amounts" name="Company_Amount" class="form-control" placeholder="Paid Amout" required/>

    </td>

      <td> 

      <input type="text" value="" id="TAX_Amount" name="TAX_Amount" class="form-control" placeholder="TAX Amount" required/></td>

    </tr>

  

  

      <tr>

        

      

     

      <td>Agent One</td>

      <td>Agent Two</td>

    <td>Agent Three</td>

       <td>Remark</td>

    </tr>

     <tr>

      

     

      

     <td><select class="form-control" id="Agent_1" name="Agent_1" required>

          <?php include('partial/agents.php') ?>

          </select></td>

     <td><select class="form-control" id="Agent_2" name="Agent_2">

          <?php include('partial/agents.php') ?>

          </select></td>

     <td><select class="form-control" id="Agent_3" name="Agent_3">

          <?php include('partial/agents.php') ?>

          </select></td>

     <td><input type="text" value="" id="Remark" name="Remark" class="form-control" placeholder="Remark" required/></td>

    </tr>

    <tr>

     

      <td><input type="text" placeholder="%" value="" id="Agent_1_Percentange" name="Agent_1_Percentange" class="form-control" style="width: 50px;float: left;" required>

        <input type="text" name="Agent_1_Shared_Amount" id="Agent_1_Shared_Amount" value="" placeholder="Shared Amount" class="form-control" style="width: 130px;float: left;" required readonly></td>

      <td>

        <input type="text" placeholder="%" value="" name="Agent_2_Percentange" id="Agent_2_Percentange" class="form-control" style="width: 50px;float: left;" >

        <input type="text" value="" placeholder="Shared Amount" name="Agent_2_Shared_Amount" id="Agent_2_Shared_Amount" class="form-control" style="width: 130px;float: left;" readonly></td>

      <td><input type="text" placeholder="%" value="" name="Agent_3_Percentange" id="Agent_3_Percentange" class="form-control" style="width: 50px;float: left;" >

        <input type="text" value="" name="Agent_3_Shared_Amount" id="Agent_3_Shared_Amount" placeholder="Shared Amount" class="form-control" style="width: 130px;float: left;" readonly ></td>

      <td><input type="text" class="form-control" name="PPI_Credits" placeholder="PPE Credit"></td>

    </tr>

  

  </tbody>

</table>

        

<!-- -->

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary" id="">Add</button>

      </div>

      </form>

    </div>

  </div>

</div>

<?php include('partial/footer.php') ?>

   <!-- popover-content end here -->

 <!-- <script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>   -->

<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>   

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>

<script type="text/javascript">



$(document).ready(function() {


$('#PaymentMode').change(function(){
  if($(this).val() == 'HDFC Bank' || $(this).val() == 'ICICI Bank' || $(this).val() == 'Axis Bank'){ 
      
    $('#TotalReceivedAmount, #Company_Amounts, #Company_Amounts_readonly, #TAX_Amount, #TAX_Amount_readonly').val('');
   
  $("#TotalReceivedAmount").keyup(function(){
    var TotalReceivedAmount = $('#TotalReceivedAmount').val();
    var Company_Amount =  Math.round(TotalReceivedAmount/1.18); 
  var TAX_AmountGiven =  TotalReceivedAmount-Company_Amount; 
  var AmountCompanyReceived =  TotalReceivedAmount - TAX_AmountGiven;
    
  $('#Company_Amount, #Company_Amount_readonly').val(AmountCompanyReceived);
  $('#TAX_Amount, #TAX_Amount_readonly').val(TAX_AmountGiven);
  $('#Company_Amounts, #Company_Amounts_readonly').val(Company_Amount,2);
    console.log(AmountCompanyReceived)
  });
    
  }
  else {
  $('#TotalReceivedAmount, #Company_Amounts, #Company_Amounts_readonly, #TAX_Amount, #TAX_Amount_readonly').val('');
    
  $("#TotalReceivedAmount").keyup(function(){
    var TotalReceivedAmount = $('#TotalReceivedAmount').val();
 var Three_Percent =  Math.round(TotalReceivedAmount/100*3); 
    var Company_Amount =  Math.round((TotalReceivedAmount-Three_Percent)/(1.18));  
  var TAX_AmountGiven =  TotalReceivedAmount-Company_Amount; 
  var AmountCompanyReceived =  TotalReceivedAmount - TAX_AmountGiven;
    
  $('#Company_Amount, #Company_Amount_readonly').val(AmountCompanyReceived);
  $('#TAX_Amount, #TAX_Amount_readonly').val(TAX_AmountGiven);
  $('#Company_Amounts, #Company_Amounts_readonly').val(Company_Amount,2);
    console.log(AmountCompanyReceived)
  });
    
  }
});
  





$( "#Activation_Date" ).datepicker({

  dateFormat: 'dd-mm-yy', 

    altField  : '#altActivation_Date',

    altFormat : 'yy-mm-dd',

    format    : 'yy-mm-dd'

});

  

$( "#SaleDate" ).datepicker({

  dateFormat: 'dd-mm-yy', 

    altField  : '#altSaleDate',

    altFormat : 'yy-mm-dd',

    format    : 'yy-mm-dd'

});

  

$( "#Exp_Date" ).datepicker({

  dateFormat: 'dd-mm-yy', 

    altField  : '#altExp_Date',

    altFormat : 'yy-mm-dd',

    format    : 'yy-mm-dd'

});



$( "#Date_of_Birth" ).datepicker( {

      changeMonth: true,

      changeYear: true,

      yearRange: '1930:2010',

      dateFormat: 'mm-dd-yy',

      altField: '#altDate_of_Birth',

      altFormat: 'yy-mm-dd',

      format: 'yy-mm-dd'

});

  

var Costumer_IDLast = $('#Costumer_IDLast').val();

var Costumer_ID = parseInt(Costumer_IDLast) + 1

$('#Costumer_ID').val(Costumer_ID);

  

/** Temp **/

/*

$('#PackageName').find(":selected").text('Stock Future'); 

$('#PackageName').find(":selected").val('Stock Future');



$('#PaymentMode').find(":selected").text('Axis Bank');  

$('#PaymentMode').find(":selected").val('Axis Bank');

  

$('#Agent_1').find(":selected").text('Ashmi Ashish Sonawane');  

$('#Agent_1').find(":selected").val('Ashmi Ashish Sonawane');

  

$('#Agent_2').find(":selected").text('Jaya Sagat'); 

$('#Agent_2').find(":selected").val('Jaya Sagat');

  

$('#Agent_3').find(":selected").text('Pooja Kharwar');  

$('#Agent_3').find(":selected").val('Pooja Kharwar'); 

  */

/*  

$( "#PackageName option:selected" ).text(); 

$( "#PaymentMode option:selected" ).text('Axis Bank');  

$( "#Agent_1 option:selected" ).text('Ashmi Ashish Sonawane');  

$( "#Agent_2 option:selected" ).text('Jaya Sagat'); 

$( "#Agent_3 option:selected" ).text('Pooja Kharwar');  

*/

});





$("#update_submit").submit((e)=>{

   // e.preventDefault();

  var per1 = parseInt($("#Agent_1_Percentange").val())?parseInt($("#Agent_1_Percentange").val()):0;

  var per2 = parseInt($("#Agent_2_Percentange").val())?parseInt($("#Agent_2_Percentange").val()):0;

  var per3 = parseInt($("#Agent_3_Percentange").val())?parseInt($("#Agent_3_Percentange").val()):0;

  var total = parseInt(per1)+parseInt(per2)+parseInt(per3);

  console.log(total);

  if(per1>100 || per2>100 || per3>100){

      alert('Percentage must be less then equals to 100');

      return false;

  }

  else if((total <99 && total<100) || total>100){

      alert('Total percentage must be 100%');

      return false;

  }

   

    

})

$("#Company_Amounts").keyup(()=>{

    var company_am =  parseInt($("#Company_Amounts").val());

    var per1 = parseInt($("#Agent_1_Percentange").val())?parseInt($("#Agent_1_Percentange").val()):0;

    var per2 = parseInt($("#Agent_2_Percentange").val())?parseInt($("#Agent_2_Percentange").val()):0;

    var per3 = parseInt($("#Agent_3_Percentange").val())?parseInt($("#Agent_3_Percentange").val()):0;

    var per =  company_am*(per1/100);

    $("#Agent_1_Shared_Amount").val(per);

     $("#Agent_2_Shared_Amount").val(company_am*(per2/100));

      $("#Agent_3_Shared_Amount").val(company_am*(per3/100));

      

    

    

    

})



$("#Agent_1_Percentange").keyup(()=>{

    var company_am =  parseInt($("#Company_Amounts").val());

    var per1 = parseInt($("#Agent_1_Percentange").val())?parseInt($("#Agent_1_Percentange").val()):0;

    var per =  company_am*(per1/100);

   $("#Agent_1_Shared_Amount").val(per);

    

    

})



$("#Agent_2_Percentange").keyup(()=>{

    var company_am =  parseInt($("#Company_Amounts").val());

    var per1 = parseInt($("#Agent_2_Percentange").val())?parseInt($("#Agent_2_Percentange").val()):0;

    var per =  company_am*(per1/100);

   $("#Agent_2_Shared_Amount").val(per);

    

    

})



$("#Agent_3_Percentange").keyup(()=>{

    var company_am =  parseInt($("#Company_Amounts").val());

    var per1 = parseInt($("#Agent_3_Percentange").val())?parseInt($("#Agent_3_Percentange").val()):0;

    var per =  company_am*(per1/100);

   $("#Agent_3_Shared_Amount").val(per);

    

    

})





</script>
<?php if($_SESSION['Role'] == 'Super Admin' || $_SESSION['Role'] == 'Admin Assist'){?>
<script>



$(document).ready(function(){

/*********************************************************/

/******** Admin Customer Profile ************************/  

/********************************************************/

    var winHeight = $(window).height() - 300;   

    

    

    

    $('#Admin_Customer_Profile').DataTable( {

     

    

     autoWidth:        true, 

    "order": [],

    "ordering": true,

   columnDefs: [

    

    { "orderable": false, "targets": [0,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22] }

      ],

  "bPaginate": false,

 // "bLengthChange": false,

 "bFilter": true,

 "bInfo": true,

 "bAutoWidth": false,

 // "scrollY": winHeight+"px",

 "scrollCollapse": true,

 "paging": true,

 "scrollX": true,

 "searching":true,



 "lengthMenu":[250],
 "pageLength": 5,

dom: 'Bfrtip',

        buttons: [

            'copyHtml5',

            'excelHtml5',

            'csvHtml5',

            'pdfHtml5'

        ],  



        initComplete: function () {
            /*
            this.api().columns([6,9]).every( function () {

                var column = this;

                var select = $('<select class="form-control"><option value="">Select</option></select>')

                    .appendTo( $(column.header()) )

                    .on( 'change', function () {

                        var val = $.fn.dataTable.util.escapeRegex(

                            $(this).val()

                        );

 

                        column

                            .search( val ? '^'+val+'$' : '', true, false )

                            .draw();

                    } );

 

                column.data().unique().sort().each( function ( d, j ) {

                    select.append( '<option value="'+d+'">'+d+'</option>' );

                } );

            } );
            */

        }

    });



  });







</script>
<?php }
?>




<script>

    $(document).ready(()=>{

        $("#Mobile_No").keyup((e)=>{

            var Mobile_No = $("#Mobile_No").val();

            if(Mobile_No.length == 10){

               $.ajax({

                   type:"post",

                   url:"Ajax_files/fetch_data_by_mobile.php",

                   data:{mobile:Mobile_No},

                   success:(res)=>{

                       //console.log(res);

                       var result = JSON.parse(res);

                       if(result.status == 'success'){

                           console.log(result);

                           

                           $("#Full_Name").val(result.Full_Name);

                           $("#PanNumber").val(result.Pan_Number);

                           $("#Email_ID").val(result.Email_ID);

                           $("#Date_of_Birth, #altDate_of_Birth").val(result.Date_of_Birth);

                           $("#Risk_Score").val(result.Risk_Score);

                           $("#Risk_Level").val(result.Risk_Level);

                           

                           

                           $("#KYC").val(result.KYC);

                           

                           

                       }

                   }

               })

            }

        })

    })


function changeStatus(id){
    $.ajax({
        type:"post",
        url:"Ajax_files/update_profile_status.php",
        data:{
            CustomerId:id
        },
        success:(res)=>{
            window.location.reload();
            console.log(res);
        }
    })
}
  
  function compliance_officer_verification(id){
    $.ajax({
        type:"post",
        url:"Ajax_files/compliance_officer_verification.php",
        data:{
            CustomerId:id
        },
        success:(res)=>{
            window.location.reload();
            console.log(res);
        }
    })
}
  
  var deleteCustomer = function(id,customer_id){
      var r = confirm("Are you sure?");
        if (r == true) {
          $.ajax({
              type:"post",
              url:"Ajax_files/Delete_Customer.php",
              data:{
                  CustomerId:id,
                  cust:customer_id
              },
              success:(res)=>{
                  console.log(res)
                  window.location.reload();
              }
          })
        }
  }
  
</script>









