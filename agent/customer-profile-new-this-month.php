<?php  include('partial/session_start.php'); ?>

<?php

if(isset($_GET['UserName']) && isset($_GET['Source']) && isset($_GET['Disposition'])){
 $UserName = $_GET['UserName'];

 $Source = $_GET['Source'];

 $Disposition = $_GET['Disposition'];
}

date_default_timezone_set('Asia/Kolkata');
$sel_sho_hide = "SELECT Show_Hide FROM Options WHERE Show_Hide IS NOT NULL LIMIT 1";
$qry_show_hide = mysqli_query($connect, $sel_sho_hide);
$fetch_show_hide = mysqli_fetch_assoc($qry_show_hide);
$show_hide = (array)json_decode($fetch_show_hide['Show_Hide']);


function diff_month($date1,$date2,$type=null){
    // echo $date1.'<br>';
    // echo $date2.'<br>';
    if($type != ''){
         return round(abs(strtotime($date1) - strtotime($date2))/(86400));  
    }
    else{
        return round(abs(strtotime($date1) - strtotime($date2))/(86400*30),2);  
    } 
}


 ?>

<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Customer Profile</title>

<?php require('partial/plugins.php'); ?>
  
  

  <style>
      .dt-buttons {display:none;}
    label {margin-top:10px;}
  </style>
    

</head>

<body>

 <?php include('partial/sidebar.php') ?>

<div class="main_container">

<header>

  <?php include('partial/header-top.php') ?>

</header>

<div class="breadcurms">

 <div class="pull-left">

<a href="memberpage.php">Dashbord</a> | <a href="customer-profile-new-this-month.php" class="btn btn-xs btn-primary">This Month</a> | <a href="customer-profile-new-3-month-details.php" >Payment History</a>

 </div>

 <!-- <div class="pull-right"><a href="#" class="btn btn-md btn-primary"  data-toggle="modal" data-target="#AddCustomerProfile"><i class="fa fa-plus"></i> Existing</a></div> -->


  
  <div class="pull-right" style="margin-right:15px;"><a href="#" class="btn btn-xs btn-primary add-customer-profile-btn"  data-toggle="modal" data-target="#AddCustomerProfile"><i class="fa fa-plus"></i> New</a></div>
  <!--<div class="pull-right" style="margin-right:15px;"><a href="#" class="btn btn-xs btn-primary add-customer-profile-btn"><i class="fa fa-plus"></i> New</a></div>-->
  
  
  


 <div class="clearfix"></div>

</div>

<div class="containter" style="padding:20px 20px 0 20px;">

<?php include('connection/dbconnection_crm.php')?>

<?php



function calculateSum($type,$id){

    global $connect;

     $sel = "select Paid_Amout,Company_Amount,Tax_Amount, Gateway_Amount from Customer_Payment_History where Costumer_ID = '$id'";

    $qry = mysqli_query($connect, $sel);

     $total_paid = 0;

     $com = 0;

     $tax = 0;
     $gateway = 0;

     while($row = mysqli_fetch_assoc($qry)){

         $total_paid = $total_paid + $row['Paid_Amout'];

         $com = $com+$row['Company_Amount'];

         $tax = $tax+ $row['Tax_Amount'];
         $gateway = $gateway + $row['Gateway_Amount'];

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

     else if($type == 'gateway'){

         return $gateway;

     }

     else{

         return false;

     }

    

   

}





function agentList($id){

    global $connect;

      $sel = "select Agent_1,Agent_2,Agent_3 from Customer_Payment_History where Costumer_ID = '$id'";

     $qry = mysqli_query($connect, $sel);

      while($row = mysqli_fetch_assoc($qry)){

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


//print_r($_COOKIE);


function totalShared($cust_id){

    global $connect;

    $sel = "select Agent_1_Shared_Amount, Agent_2_Shared_Amount,Agent_3_Shared_Amount from Customer_Payment_History where Costumer_ID  = '$cust_id'";

    $qry = mysqli_query($connect, $sel);

    $sum = 0;

    while($fetch = mysqli_fetch_assoc($qry)){

        $sum = $sum + $fetch['Agent_1_Shared_Amount'] + $fetch['Agent_2_Shared_Amount'] + $fetch['Agent_3_Shared_Amount'];

    }

    return $sum;

}

//print_r(agentList(651));





$sql = ("SELECT Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Approval_Status, Full_Name, PPI_Credits,  Email_ID, Mobile_No, Pan_Number, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,

DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout,  Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount,Agent_2, Agent_2_Percentange,

    Agent_2_Shared_Amount,Agent_3, Agent_3_Percentange,

    Agent_3_Shared_Amount,utr_no,

Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert , DATE_FORMAT( Created_payment_date,  '%d-%m-%Y %h %i' ) AS Created_payment_date FROM Customer_profile WHERE (SaleDate>= DATE_FORMAT(CURDATE(),'%Y-%m-01') - INTERVAL 1 MONTH) AND (Agent_1 = '".$username."' OR Agent_2 = '".$username."' OR Agent_3 = '".$username."')  ORDER BY  `id` DESC ");




//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");

/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin

FROM fut_hni");*/

$result = mysqli_query($connect, $sql);

echo('<table id="Admin_Customer_Profile" class="display" cellspacing="0" width="100%">');

echo('<thead>');

 echo('<tr>');
 echo('<th>Approval Status</th>');
  echo('<th>Costumer ID</th>');



  echo('<th><div style="width:120px;"></div>Sale_Date</th>');

  echo('<th><div style="width:120px;"></div>Sale Month</th>');

  echo('<th>Full Name</th>');

  //echo('<th>Last Name</th>');

  echo('<th>Email ID</th>');

  echo('<th>Mobile No</th>');

  

  echo('<th>Package_Name</th>');

  echo('<th>Activation Date</th>');

  echo('<th>Exp_Date</th>');
  echo '<th>Discount</th>';

  echo('<th>PPI_Credits Recharge</th>');

  echo('<th>PPI_Credits Available</th>');

  echo('<th><div style="width:120px;"></div>Status</th>');

  echo('<th >Remark</th>');

  echo('<th>Total Amout Received</th>');

  echo('<th>Gateway Amount</th>');
  echo('<th>Company Amount</th>');

    echo('<th>Tax Amount</th>');

  //echo('<th>Payment Mode</th>');

  echo('<th>Agent_Full_Name</th>');



  echo('<th>Share</th>');
    if($show_hide['Date_of_Birth']){
        echo('<th>Date_of_Birth</th>');
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
  echo('<th>Created Payment Date</th>');
    echo('<th>UTR NO#</th>');

//   echo('<th>Positive</th>');

//   echo('<th>Negative</th>');

//   echo('<th>Open</th>');

echo '<th>Package Price</th>';
  echo '<th>No Of Days</th>';
  
  echo '<th>Delete</th>';

  echo('</tr>');

echo('</thead>');

echo('<tbody>');

while($row = mysqli_fetch_array($result))

{

    $new_sel = 'SELECT count(*) as cn FROM `stock_tips` WHERE DATE(Date) >= "'.date('Y-m-d',strtotime($row['ActivationDate'])).'" AND DATE(Date) <= "'.date('Y-m-d').'" and 

    Result = "Positive" and Sagment ="'.$row['PackageName'].'"';

  

    $qrys = mysqli_query($connect, $new_sel);

  //echo($new_sel);

    $fet = mysqli_fetch_assoc($qrys);

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
 echo('<td>');
 if($row['Approval_Status'] == 'Pending'){
     echo '<span class="btn btn-sm btn-danger">Pending</span>';
 }
 else{
     echo $row['Approval_Status'];
 }
 echo '</td>';
 
 echo('<td>'.$row['Costumer_ID']);
 $cr_time = time();
 $sale_date = strtotime($row['SaleDateIND']);
 $datediff = $cr_time - $sale_date;
 if(round($datediff/(60*60*24))<=2 && $row['Approval_Status'] == 'Pending'){
 
 //echo ('<form  action="customer-profile-update.php" method="get"><input type="hidden" name="Costumer_ID" value="'.$row['Costumer_ID'].'"/> <input type="Submit" class="btn btn-primary btn-xs Edit-btn" value="Edit"/></form>');
 //echo '<a href="customer-profile-delete.php?Costumer_ID='.$row['Costumer_ID'].'" class="btn btn-sm btn-danger" >Delete</a>';
 }
 
 echo ('<br><form  action="customer-profile-update.php" method="get"><input type="hidden" name="Costumer_ID" value="'.$row['Costumer_ID'].'"/> <input type="Submit" class="btn btn-primary btn-xs Edit-btn" value="Edit"/></form>');
 
 echo ('<a type="button" value="Add" class="btn btn-success btn-xs" href="customer-profile-payment-history-new.php?cust='.$row['Costumer_ID'].'" style="margin-top:5px;">Details</a>');

 
 echo '</td>';

  echo('<td>'.$row['SaleDateIND'].'</td>');

   echo('<td>'.date("M Y",strtotime($row['SaleDateIND'])).'</td>');

echo('<td>'.$row['Full_Name'].'</td>');

//echo('<td>'.'<a href="'.'disposition.php?Mobile='.$row['Mobile'].'Blaster&Disposition=Sale&UserName='.$_SESSION['username'].'">'.$row['Mobile'].'</a></td>');

//echo('<td>'.$row['LastName'].'</td>');

 echo('<td>'.$row['Email_ID'].'</td>');

 echo('<td>'.$row['Mobile_No'].'</td>');



 echo('<td>'.$row['PackageName'].'</td>');

 echo('<td>'.date("d-M-Y", strtotime($row['ActivationDate'])).'</td>') ;

 echo('<td>'.date("d-M-Y", strtotime($row['ExpDate'])).'</td>') ;
 
 
$Sel_Package_Name = "SELECT Segment_Amount FROM Options WHERE Segment = '".$row['PackageName']."'";
$qry_package_name = mysqli_query($connect, $Sel_Package_Name);
$fetch_package_price = mysqli_fetch_assoc($qry_package_name);

$sel_amount_paid = "SELECT SUM(Paid_Amout) as Amount FROM `Customer_Payment_History` where Costumer_ID = '".$row['Costumer_ID']."'";
$qry_amount_paid = mysqli_query($connect, $sel_amount_paid);
$fetch_amount_paid = mysqli_fetch_assoc($qry_amount_paid);

$diff_month = diff_month($row['ActivationDate'],$row['ExpDate']);
$total_amount = ($fetch_package_price['Segment_Amount']*$diff_month);

$Total_Discount = $total_amount-$fetch_amount_paid['Amount'];
$Discount_Percentage = round(($Total_Discount/$total_amount)*100);
 echo '<td>₹'.$Total_Discount.', '.$Discount_Percentage.'%</td>';

  echo('<td>'.$row['PPI_Credits'].'</td>');

  echo('<td> '.$avl_bal.' </td>');

 echo('<td class="'.$row['Status'].'">'.$row['Status'].'</td>');

 echo('<td >'.$row['Remark'].'</td>');

 echo('<td>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'.calculateSum("paid",$row['Costumer_ID']).'</td>');

 echo('<td>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'.calculateSum("gateway",$row['Costumer_ID']).'</td>');
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

// $qr = mysqli_query($connect, $qry);

// $d = mysqli_fetch_assoc($qr);

// $Positive = $d['counts'];



// $qry = "select count(*) as counts from stock_tips where Sagment = '".$packagename."' and Result = 'Nagitive' and (Date BETWEEN '".$activation_date."' and '".$expiry_date."')";

// $qr = mysqli_query($connect, $qry);

// $ds = mysqli_fetch_assoc($qr);

// $Nagitive = $ds['counts'];



// $qry = "select count(*) as counts from stock_tips where Sagment = '".$packagename."' and Result = 'Open' and (Date BETWEEN '".$activation_date."' and '".$expiry_date."')";

// $qr = mysqli_query($connect, $qry);

// $dss = mysqli_fetch_assoc($qr);



// $Open = $dss['counts'];

 

 
 if($show_hide['Date_of_Birth']){
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
    echo('<td>'.$row['PanNumber'].'</td>');
 }

 if($show_hide['Risk_Score']){
    echo('<td>'.$row['Risk_Score'].'</td>');
}
 if($show_hide['Risk_Level']){
 echo('<td>'.$row['Risk_Level'].'</td>');
}
 echo('<td>'.$row['DateTimeConvert'].'</td>');
 echo('<td>'.$row['Created_payment_date'].'</td>');
 echo('<td>'.$row['utr_no'].'</td>');

//  echo('<td><a href="#" class="btn btn-success btn-xs">'.$Positive.'</a></td>');

//  echo('<td><a href="#" class="btn btn-danger btn-xs">'.$Nagitive.'</a></td>');

//   echo('<td><a href="#" class="btn btn-info btn-xs">'.$Open.'</a></td>');


 
    echo '<td>'.$fetch_package_price['Segment_Amount'].'</td>';
     echo '<td>'. diff_month($row['ActivationDate'],$row['ExpDate'],'days').'</td>';
 
  
  
  echo '<td>';

$cr_time = time();
 $sale_date = strtotime($row['SaleDateIND']);
 $datediff = $cr_time - $sale_date;
 if(round($datediff/(60*60*24))<=2 && $row['Approval_Status'] == 'Pending'){

 //echo ('<form  action="customer-profile-update.php" method="get"><input type="hidden" name="Costumer_ID" value="'.$row['Costumer_ID'].'"/> <input type="Submit" class="btn btn-primary btn-xs Edit-btn" value="Edit"/></form>');
 ?>
<a href="customer-profile-delete.php?Costumer_ID=<?php echo $row['Costumer_ID']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger" >Delete</a>
<?php
 }
echo '</td>';
 echo('</tr>');
}






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

$result = mysqli_query($connect, $sql);


?>

       <input type="hidden" id="Costumer_IDLast" value="<?php  echo mysqli_result($result, 0);?>"/>

       <input type="hidden" id="DateTime" name="DateTime"   value="<?php echo date("Y-m-d h:i:s") ?>"/>
        <div class="row">
          <div class="col-sm-3">
           <label for="">Mobile Number</label>
            <input type="text" value="" id="Mobile_No" name="Mobile_No" class="form-control" placeholder="Mobile No" pattern="[1-9]{1}[0-9]{9}" title="Enter only 10 digit" maxlength="10" required/>
      <input type="hidden" value="" id="Costumer_ID" name="Costumer_ID" class="form-control" placeholder="Costumer ID" />
          </div>
          
          <div class="col-sm-3">
           <label for="">Full Name*</label>
            <input type="text" value="" id="Full_Name" onchange="return CheckAgentName()"  name="Full_Name"  class="form-control capitalize" placeholder="Full Name" required>
            <p class="" style="color:red;" id="Full_Name_Check_Error"></p>
          </div>
          
          <div class="col-sm-3">
           <label for="">Email ID</label>
            <input type="text" value="" id="Email_ID" name="Email_ID" onchange="return CheckAgentEmail()"  class="form-control lowercase" placeholder="Email ID" required/>
            <p class="" style="color:red;" id="Email_Check_Error"></p>
          </div>
          <?php
            if($show_hide['PanNumber']){
          ?>
          <div class="col-sm-3">
           <label for="">Pan Number</label>
            <input type="text" value="" id="PanNumber" name="PanNumber"  class="form-control uppercase" placeholder="Pan Number" maxlength="10" required/>
          </div>
          <?php
            }
          ?>
          
          <?php
            if($show_hide['KYC']){
          ?>
            <div class="col-sm-3">
           <label for="">KYC</label>
            <select class="form-control" id="KYC" name="KYC" required>

            <option value="" selected>Select</option>

            <option value="Download">Download</option>

            <option value="Fetch">Fetch</option>

            <option value="Scan">Scan copy</option>

          </select>

          </div>
          <?php
            }
          ?>
         
         
          <?php
            if($show_hide['Risk_Score']){
          ?>
           <div class="col-sm-3">
           <label for="">Risk_Score</label>
            <input type="text" value="" id="Risk_Score" name="Risk_Score" class="form-control" placeholder="Risk Score" required/>
          </div>
          <?php
            }
          ?>
          
          
          <?php
            if($show_hide['Date_of_Birth']){
          ?>
          <div class="col-sm-3">
           <label for="">Date of Birth *</label>
            <input type="text" value="" id="Date_of_Birth" name="Date_of_Birth" class="form-control" placeholder="Date of Birth"  autocomplete="off" required/>

       <input type="hidden" value="" id="altDate_of_Birth" name="altDate_of_Birth" class="form-control" placeholder="Date of Birth"/>
          </div>
          <?php
            }
          ?>
          
          
          <div class="col-sm-3">
           <label for="">Package Name*</label>
             <select class="form-control" id="PackageName" onchange="FetchSegment(this);CalculateDays();" name="PackageName" required>

            <option value="">Select Package</option>

           <?php 
               echo $sel_segment = "SELECT Segment, Segment_Amount FROM Options WHERE Segment IS NOT NULL AND Segment_Status ='Active'";
                $qry_segment = mysqli_query($connect, $sel_segment);
                while($fetch_segment = mysqli_fetch_assoc($qry_segment)){
                    echo '<option data-amount="'.$fetch_segment['Segment_Amount'].'" value="'.$fetch_segment['Segment'].'">'.$fetch_segment['Segment'].'</option>';
                }
           ?>

          </select>
          </div>
          <div class="col-sm-3">
              <label>Package Price</label>
              <input type="text" readonly class="form-control" value="" id="PackagePrice" name="PackagePrice" />
          </div>
          
          <div class="col-sm-3">
           <label for="">Sale Date*</label>
            <input type="text" value="" id="SaleDate" name="SaleDate"  class="form-control" placeholder="Sale Date"  autocomplete="off" required/>

       <input type="hidden" value="" id="altSaleDate" name="altSaleDate" class="form-control" placeholder="alt Sale Date"/>
          </div>
          
          <div class="col-sm-3">
           <label for="">Activation Date</label>
            <input type="text" value="" id="Activation_Date" onchange="CalculateDays()" name="Activation_Date" class="form-control" placeholder="Activation Date"  autocomplete="off" required/>

       <input type="hidden" value="" id="altActivation_Date" name="altActivation_Date" class="form-control" placeholder="Activation Date"/>
          </div>

          
          <div class="col-sm-3">
           <label for="">Expired Date</label>
            <input type="text" value="" id="Exp_Date" name="Exp_Date" onchange="CalculateDays()"  class="form-control" placeholder="Expired Date"  autocomplete="off" required/>

       <input type="hidden" value="" id="altExp_Date" name="altExp_Date" class="form-control" placeholder="Expired Date"/>

          </div>
          
          
          
        <div class="col-sm-3">
           <label for="">Number of days*</label>
             <input type="text" value="" id="Number_of_Days" name="Number_of_Days" class="form-control inherit" placeholder="Number of days" required/>
          </div>
          
          <div class="col-sm-3">
           <label for="">Payment Mode*</label>
            <select class="form-control" id="PaymentMode" name="PaymentMode" required>

           <?php include('partial/payment_mode.php') ?>

          </select>
           <small id="result_payment_method" class="text-danger"></small>
          </div>
         
         
          
          
          
          
          
          <div class="col-sm-3">
           <label for="">Total Received Amount*</label>
            <input type="text" value="" id="TotalReceivedAmount" name="TotalReceivedAmount" class="form-control" placeholder="Estimated Amount" required/>
            <small id="max_amount_error" class="text-danger"></small>
          </div>
          
          <div class="col-sm-3">
           <label for="">Gateway Amount*</label>
             <input type="text" value="" id="Gateway_Amounts_readonly" name="" class="form-control" placeholder="Gateway Amount" disabled/>

             <input type="hidden" value="" id="Gateway_Amounts" name="Gateway_Amount" class="form-control" placeholder="Gateway Amount" required/>
          </div>

          <div class="col-sm-3">
           <label for="">Company Amount*</label>
             <input type="text" value="" id="Company_Amounts_readonly" name="" class="form-control" placeholder="Paid Amout" disabled/>

    <input type="hidden" value="" id="Company_Amounts" name="Company_Amount" class="form-control" placeholder="Paid Amout" required/>
          </div>
          
          <div class="col-sm-3">
           <label for="">Tax Amount*</label>
            <input type="text" value="" id="TAX_Amount_readonly" name="" class="form-control" placeholder="TAX Amount" disabled/>
      <input type="hidden" value="" id="TAX_Amount" name="TAX_Amount" class="form-control" placeholder="TAX Amount" required/>
          </div>
          
           <div class="col-sm-3">
               <?php
                    $sel_agent = "SELECT username,Team_Leader FROM employee WHERE Role = 'Agent' AND Status='Active' AND username != 'Select' AND username != 'Akshay Shetty' ";
                              $qry_agent = mysqli_query($connect, $sel_agent);
                              $fetch_agent_list = array();
                              while($fetch_agent = mysqli_fetch_assoc($qry_agent)){
                                 $fetch_agent_list[] = $fetch_agent;
                              }
                $sel_cu_agent = "SELECT Team_Leader FROM employee WHERE username = '".$username."'";
                $qry_c_agent = mysqli_query($connect, $sel_cu_agent);
                $fetch_c_agent = mysqli_fetch_assoc($qry_c_agent);
               ?>
                <label for="">Agent One</label>
                <input type="text" name="Agent_1_TL" value="<?php echo $fetch_c_agent['Team_Leader']; ?>"  placeholder="Agent_1_TL" class="form-control" readonly/>
              <input type="text" value="<?php  echo $username;?>" id="" name="" class="form-control" placeholder="" disabled/>
                        <input type="hidden" value="<?php  echo $username;?>" id="Agent_1" name="Agent_1" class="form-control" placeholder="" required/>
                        
             <input type="text" placeholder="%" value="100" id="Agent_1_Percentange" name="Agent_1_Percentange" class="form-control" style="width: 50px;float: left;" required>

        <input type="text" name="Agent_1_Shared_Amount" id="Agent_1_Shared_Amount" value="" placeholder="Shared Amount" class="form-control" style="width: 130px;float: left;" required readonly>
          </div>
          
           <div class="col-sm-3">
                
           <label for="">Agent Two</label>
           <input type="text" name="Agent_2_TL"  placeholder="Agent_2_TL" class="form-control" readonly/>
            <select class="form-control Agent_Name_Change" id="Agent_2" name="Agent_2">

                    <?php
                    
                    echo '<option value="">Select Agent</option>';
                             foreach($fetch_agent_list as $fetch_agent){
                                   echo '<option data-tl="'.$fetch_agent['Team_Leader'].'" value="'.$fetch_agent['username'].'">'.$fetch_agent['username'].'</option>';
                              }
                            ?>

          </select>
             <input type="text" placeholder="%" value="" disabled="true" name="Agent_2_Percentange" id="Agent_2_Percentange" class="form-control" style="width: 50px;float: left;" >

        <input type="text" value="" placeholder="Shared Amount" name="Agent_2_Shared_Amount" id="Agent_2_Shared_Amount" class="form-control" style="width: 130px;float: left;" readonly>
          </div>
          
           <div class="col-sm-3">
           
           <label for="">Agent Three</label>
            <input type="text" name="Agent_3_TL"  placeholder="Agent_3_TL" class="form-control" readonly/>
            <select class="form-control Agent_Name_Change" id="Agent_3" name="Agent_3">

          <?php
                    
                    echo '<option value="">Select Agent</option>';
                             foreach($fetch_agent_list as $fetch_agent){
                                   echo '<option data-tl="'.$fetch_agent['Team_Leader'].'" value="'.$fetch_agent['username'].'">'.$fetch_agent['username'].'</option>';
                              }
                            ?>

          </select>
             <input type="text" placeholder="%" value="" disabled="true" name="Agent_3_Percentange" id="Agent_3_Percentange" class="form-control" style="width: 50px;float: left;" >

        <input type="text" value="" name="Agent_3_Shared_Amount" id="Agent_3_Shared_Amount" placeholder="Shared Amount" class="form-control" style="width: 130px;float: left;" readonly >
          </div>
          
           <div class="col-sm-3">
           <label for="">Remark</label>
            <input type="text" value="" id="Remark" name="Remark" class="form-control inherit" placeholder="Remark" required/>
          </div>

           <div class="col-sm-3">
           <label for="">Payment Created Date</label>
            <input type="datetime-local" value="<?php echo date('Y-m-d\TH:i'); ?>" class="form-control" name="Created_payment_date">
          </div>

           <div class="col-sm-3">
           <label for="">PPE Credit</label>
            <input type="text" class="form-control" name="PPI_Credits" placeholder="PPE Credit">
          </div>
          <div class="col-sm-3">
            <label for="">UTR NO.#</label>
            <input type="text" value="" class="form-control" name="utr_no" required>
          </div>
        </div>
<!-- -->
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary" id="Submit_Btn">Add</button>

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

    var btn_check_1 = 1;
    var btn_check_2 = 1;
      function CheckAgentName(){
              var Full_Name_Check = $("#Full_Name").val();

              // alert('ok');
              // return 1;

              $.ajax({
                type:"post",
                url:"Ajax_files/Check_Agent_Name.php",
                data:{
                  Agent_Name:Full_Name_Check
                },
                success:(res)=>{
                  var Result = JSON.parse(res);
                  if(Result.status == 'success'){
                    $("#Full_Name_Check_Error").text('');
                       btn_check_1=1;
                    if(btn_check_1 == 1 && btn_check_2==1 )
                    {
                       $("#Submit_Btn").removeAttr('disabled');
                    }
                   
                    return true;
                  }
                  else{
                    $("#Full_Name_Check_Error").text('Customer Name Already Exists');
                    $("#Submit_Btn").attr('disabled','disabled');
                    $("#Full_Name").focus();
                       btn_check_1=0;
                    return false;
                  }
                }
              })
            }

              function CheckAgentEmail(){
              var Email_ID_Check = $("#Email_ID").val();

              // alert('ok');
              // return 1;

              $.ajax({
                type:"post",
                url:"Ajax_files/Check_Agent_Email.php",
                data:{
                  Email_ID:Email_ID_Check
                },
                success:(res)=>{
                  var Result = JSON.parse(res);
                  if(Result.status == 'success'){
                    $("#Email_Check_Error").text('');
                    btn_check_2=1;
                    if(btn_check_1 == 1 && btn_check_2==1 )
                    {
                       $("#Submit_Btn").removeAttr('disabled');
                    }
                    return true;
                  }
                  else{
                    $("#Email_Check_Error").text('Customer Email Already Exists');
                    $("#Full_Name").focus();
                     $("#Submit_Btn").attr('disabled','disabled');
                    btn_check_2=0;
                    return false;
                  }
                }
              })
            }

</script>

<script type="text/javascript">



$(document).ready(function() {

$('#PaymentMode').change(function(){
      
    $('#TotalReceivedAmount, #Company_Amounts, #Company_Amounts_readonly, #TAX_Amount, #TAX_Amount_readonly, #Gateway_Amounts_readonly, #Gateway_Amounts').val('');
   
  $("#TotalReceivedAmount").keyup(function(){

    // alert($("#PaymentMode").val());

    if($("#PaymentMode").val() == 'HDFC Bank' || $("#PaymentMode").val() == 'ICICI Bank' || $("#PaymentMode").val() == 'Axis Bank'){ 
      var TotalReceivedAmount = $('#TotalReceivedAmount').val();
      //    console.log(TotalReceivedAmount);
      var Company_Amount =  Math.round(TotalReceivedAmount/1.18); 
      var TAX_AmountGiven =  TotalReceivedAmount-Company_Amount; 
      var AmountCompanyReceived =  TotalReceivedAmount - TAX_AmountGiven;

      $('#Company_Amount, #Company_Amount_readonly').val(AmountCompanyReceived);
      $('#TAX_Amount, #TAX_Amount_readonly').val(TAX_AmountGiven);
      $('#Company_Amounts, #Company_Amounts_readonly').val(Company_Amount,2);
      console.log(AmountCompanyReceived)
    } else {
        var TotalReceivedAmount = $('#TotalReceivedAmount').val();
        var three_percent =  TotalReceivedAmount/100*3; // updated to 3 percent from 1.95
        var eighteen_percent_of_three_percent =  three_percent/100*18; 
        var Gateway_Amount =  three_percent+eighteen_percent_of_three_percent;  
        var Remaining_Amount = TotalReceivedAmount - Gateway_Amount;
        var Gst_Amount = Remaining_Amount/100*18;
        var Company_Amount =  Math.round(Remaining_Amount - Gst_Amount);  

        var TAX_AmountGiven =  Math.round(Gst_Amount); 
        var AmountCompanyReceived = Company_Amount;
          
        $('#Company_Amount, #Company_Amount_readonly').val(AmountCompanyReceived);
        $('#TAX_Amount, #TAX_Amount_readonly').val(TAX_AmountGiven);
        $('#Company_Amounts, #Company_Amounts_readonly').val(Company_Amount,2);
        $('#Gateway_Amounts, #Gateway_Amounts_readonly').val(Gateway_Amount,2);
    }
  });
    

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

  console.log("total" + total);

  if(per1>100 || per2>100 || per3>100){

      alert('Percentage must be less then equals to 100');

      return false;

  }

  else if((total <99 && total<100) || total>100){

      alert('Total percentage must be 100%');

      return false;

  }
 

})

$("#TotalReceivedAmount").keyup(()=>{
setTimeout(function(){  
    var company_am =  parseInt($("#Company_Amounts").val());
    var per1 = parseInt($("#Agent_1_Percentange").val())?parseInt($("#Agent_1_Percentange").val()):0;
    var per2 = parseInt($("#Agent_2_Percentange").val())?parseInt($("#Agent_2_Percentange").val()):0;
    var per3 = parseInt($("#Agent_3_Percentange").val())?parseInt($("#Agent_3_Percentange").val()):0;
    var per =  company_am*(per1/100);

    $("#Agent_1_Shared_Amount").val(per);
    $("#Agent_2_Shared_Amount").val(company_am*(per2/100));
    $("#Agent_3_Shared_Amount").val(company_am*(per3/100));
}, 1000);
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

 "bLengthChange": false,

 "bFilter": true,

 "bInfo": true,

 "bAutoWidth": false,

 // "scrollY": winHeight+"px",//softwebies

 "scrollCollapse": true,

 "paging": true,//softwebies

 "scrollX": true,

 "searching":true,
 "pageLength": 5,//softwebies



 "lengthMenu":[250],

dom: 'Bfrtip',

        buttons: [

            'copyHtml5',

            'excelHtml5',

            'csvHtml5',

            'pdfHtml5'

        ],  



        initComplete: function () {

            this.api().columns([2,3,6]).every( function () {

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

        }

    });



  });







</script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" ></script>
<script>

    $(document).ready(()=>{

        $("#Mobile_No").keyup((e)=>{

        trigger_user(e);

        })
        
        $("#Mobile_No").bind('input propertychange',function(e){
            console.log($(this).val());
            trigger_user(e);
        })

    })
    
    
    function trigger_user(e){
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
    }




function FetchSegment(e){
    var amount = $(e).find('option:selected').attr('data-amount');
    $("#PackagePrice").val(amount);
}

function CalculateDays(){
    
    var Activation_Date = $("#Activation_Date").val();
    var Exp_Date = $("#Exp_Date").val();
    Activation_Date = Activation_Date.split('-');
    Activation_Date = new Date(Activation_Date[2],Activation_Date[1],Activation_Date[0]);
    
    Exp_Date = Exp_Date.split('-');
    Exp_Date = new Date(Exp_Date[2],Exp_Date[1],Exp_Date[0]);
    var Activation_Date_UnixTime = parseInt(Activation_Date.getTime()/1000);
    var Exp_Date_UnixTime = parseInt(Exp_Date.getTime()/1000);
    
    var TimeDifference = ((Exp_Date_UnixTime - Activation_Date_UnixTime)/60/60/24);
    if(TimeDifference){
        $("#Number_of_Days").val(TimeDifference);
    }
    else{
        $("#Number_of_Days").val(0);
    }
    
    
   var PackagePrice = $("#PackagePrice").val();
   var Estimated = parseInt((PackagePrice/30)*TimeDifference);
   $("#TotalReceivedAmount").val('');
   $("#TotalReceivedAmount").attr('placeholder','Estimated Amount '+Estimated);
   $("#TotalReceivedAmount").attr('data-max-amount',Estimated);
   
}

$("#TotalReceivedAmount").keyup((e)=>{
    $("#max_amount_error").text("");
   var Estimated = $(e.target).attr('data-max-amount');
   var Amount = $(e.target).val();
   //console.log("amount and estimated" + Amount+' '+Estimated)
   var No_Of_days = $("#Number_of_Days").val();
   
//   if(parseInt(Amount)>parseInt(Estimated)){
//       $("#max_amount_error").text('Maximum '+Estimated+' is allowed for '+No_Of_days+' days')
//         $(e.target).val('');
//       return false;
//   }
})


$(document).ready(()=>{
    $('.Agent_Name_Change').change((e)=>{
        var agent_name = $(e.target).find(':selected').attr('data-tl');
        $(e.target).closest('div').find('input').filter(':first').val(agent_name);
                $(e.target).next('input').prop("disabled", false);

    })
    
    $("#TotalReceivedAmount").focus(()=>{
        var PaymentMode = $("#PaymentMode").val();
        if(!PaymentMode){
            $("#PaymentMode").focus();
            $("#result_payment_method").text('Kindly Choose Payment Method');
        }
        else{
            $("#result_payment_method").text('');
        }
    })
    $("#PaymentMode").change(()=>{
        $("#result_payment_method").text('');
    })
})
</script>









