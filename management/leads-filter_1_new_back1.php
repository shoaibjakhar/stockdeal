<?php  include('partial/session_start.php'); ?>


<?php

$Mobile = $_GET['Mobile'];
if(strlen($Mobile)<4){
    $_SESSION['error'] = 'Please Enter Minimum 4 Charecters to Get Result';
    header('location:leads-filter_1_new.php');
    exit();
}
/*
$StartDateUSA = $_GET['StartDateUSA'];
$EndtDateUSA = $_GET['EndtDateUSA'];
$disposition = $_GET['disposition'];
$username = $_GET['username'];

$limit = $_GET['limit'];
*/

//echo($StartDateUSA.' '.$EndtDateUSA.' '.$username.' '.$disposition.' '.$limit); 

//$Disposition = $_GET['Disposition'];
 //$limit = $_GET['limit'];
 
date_default_timezone_set('Asia/Kolkata');
 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Update leads</title>
<?php require('partial/plugins.php'); ?>

<style>
    
    .quadrat {
  width: 50px;
  height: 50px;
  -webkit-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Safari 4+ */
  -moz-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Fx 5+ */
  -o-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Opera 12+ */
  animation: NAME-YOUR-ANIMATION 1s infinite;  /* IE 10+, Fx 29+ */
}

@-webkit-keyframes NAME-YOUR-ANIMATION {
  0%, 49% {
    background-color: #c23616);
    color:#fff;
     /*border: 3px solid #d63031; */
  }
  50%, 100% {
    background-color: #c23616;
    color:#fff;
   /* border: 3px solid rgb(117, 209, 63);*/
  }
}
    
     </style>

</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
    
    
   
    
    
    <?php
if (isset($_SESSION['Role'])) {

    if($_SESSION['Role'] == 'Super Admin') {
    
echo '<div class="breadcurms"> <a href="memberpage.php">Dashbord</a> | <a href="leads-view.php">Assigned Leads</a> | <a href="leads-filter_1_new.php" class="">Filter 1</a> | <a href="leads-filter_3_new.php">Filter 3</a> | <a href="leads-filter_4_new.php" class="">Filter 4</a> | <a href="leads-filter_6_new.php">Filter 6</a> | <a href="leads-filter_7_new.php" class="">Last 7 days Inactive</a> | <a href="leads-filter_2_new.php">Churn</a> | <a href="leads-view-delete.php">Delete</a> </div>';
        
    }
    
    else if ($_SESSION['Role'] == 'Admin Assist') {
        echo '<div class="breadcurms"><a href="leads-filter_1_new.php" class="btn btn-xs btn-primary">Filter 1</a></div>';
    }
}

?>  
    <div class="containter" style="padding:20px 20px 0 20px;">

<?php include('connection/dbconnection_crm.php')?>

<?php



function calculateSum($type,$id){

    global $connect;

     $sel = "select Paid_Amout,Company_Amount,Tax_Amount from Customer_Payment_History where Costumer_ID = '$id'";

    $qry = mysqli_query($connect, $sel);

     $total_paid = 0;

     $com = 0;

     $tax = 0;

     while($row = mysqli_fetch_assoc($qry)){

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





$sql = ("SELECT id, Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name,Compliance_Status, PPI_Credits, compliance_officer_verification,  Email_ID, Mobile_No, Pan_Number, Approval_Status, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,

DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout,  Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount,Agent_2, Agent_2_Percentange,

    Agent_2_Shared_Amount,Agent_3, Agent_3_Percentange,

    Agent_3_Shared_Amount,

Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_profile WHERE (Mobile_NO = '".$Mobile."' OR Full_Name LIKE '%".$Mobile."%' OR Email_ID LIKE '%".$Mobile."%' ) ORDER BY  `Id` DESC");

//echo ($sql);

//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");

/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin

FROM fut_hni");*/

$result = mysqli_query($connect, $sql);

echo('<table id="Admin_Customer_Profile" class="display" cellspacing="0" width="100%">');

echo('<thead>');

 echo('<tr>');

 // echo('<th style="">Approval_Status</th>');

if($_SESSION['Role'] == 'Super Admin' || $_SESSION['Role'] == 'Admin Assist'){ 
  echo('<th>Admin Approval</th>');
    }
  
  //echo('<th>Compliance officer verification status</th>');
    
      echo('<th>Compliance status</th>');
      echo('<th>Costumer ID</th>');
  
  echo('<th>Download Invoice</th>');

  echo('<th><div style="width:120px;"></div>Sale_Date</th>');

  echo('<th><div style="width:120px;"></div>Sale Month</th>');

  echo('<th>Full Name</th>');

  //echo('<th>Last Name</th>');

  echo('<th>Email ID</th>');

  echo('<th>Mobile No</th>');

  

  echo('<th>Package_Name</th>');

  echo('<th>Activation Date</th>');

  echo('<th>Exp_Date</th>');

  echo('<th>PPI_Credits Recharge</th>');

  echo('<th>PPI_Credits Available</th>');

  echo('<th><div style="width:120px;"></div>Status</th>');

  echo('<th >Remark</th>');

  echo('<th>Total Amout Received</th>');

  echo('<th>Company Amount</th>');

    echo('<th>Tax Amount</th>');

  //echo('<th>Payment Mode</th>');

  echo('<th>Agent_Full_Name</th>');



  echo('<th>Share</th>');

  echo('<th>Date_of_Birth</th>');

  echo('<th>KYC</th>');

  echo('<th>Pan Number</th>');

  echo('<th>Risk Score</th>');

  echo('<th>Risk Level</th>');

  echo('<th>Date Time</th>');

  echo('<th>Positive</th>');

  echo('<th>Negative</th>');

  echo('<th>Open</th>');
  echo('<th>Delete</th>');

  echo('</tr>');

echo('</thead>');

echo('<tbody>');
$i = 0;

while($row = mysqli_fetch_array($result))

{
  /*  $i++;
if($i == 2){
   // break;
}*/

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
 
if($_SESSION['Role'] == 'Super Admin' || $_SESSION['Role'] == 'Admin Assist'){
echo('<td>');       

 if($row['Approval_Status'] == 'Pending'){
     echo '
    <span class="btn btn-danger">'.$row['Approval_Status'].'</span>
    <a href="javascript:void(0)" onclick="changeStatus('.$row['Costumer_ID'].')">Approve now</a>';
 }
 
 echo ('</td>');
 
}


  //echo('<td>');
 //if($row['compliance_officer_verification'] == 'Compliance officer verification pending'){
     //echo '
    //<span class="btn btn-danger">'.$row['compliance_officer_verification'].'</span>
    //<a href="javascript:void(0)" onclick="compliance_officer_verification('.$row['Costumer_ID'].')" class="compliance_officer_verified">Approve now</a>';
 //}
 
 
 //echo ('</td>');


 echo ('<td>');
?>
    <form method="post" action="Complaince_Status_Update.php">
        <input type="hidden" name="Costumer_ID" value="<?php  echo $row['Costumer_ID']; ?>" required />
        <select class="form-control" name="Compliance_Status" onchange="this.form.submit()">
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
    
     echo('<td>'.$row['Costumer_ID']);
    
     if($_SESSION['Role'] == 'Super Admin' || $_SESSION['Role'] == 'Admin Assist'){
     echo ('
     <form  action="customer-profile-update.php" method="get"><input type="hidden" name="Costumer_ID" value="'.$row['Costumer_ID'].'"/> <input type="Submit" class="btn btn-primary btn-xs Edit-btn" value="Edit"/></form>');
     
     }
     else if($_SESSION['Role'] == 'compliance officer' && $row['Approval_Status'] == 'Pending' ){
         echo ('
     <form  action="customer-profile-update.php" method="get"><input type="hidden" name="Costumer_ID" value="'.$row['Costumer_ID'].'"/> <input type="Submit" class="btn btn-primary btn-xs Edit-btn" value="Edit"/></form>');
     
     }
    
    //echo $_SESSION['Role'];
     
    echo (' <a type="button" value="Add" class="btn btn-success btn-xs" href="customer-profile-payment-history-new.php?cust='.$row['Costumer_ID'].'" style="margin-top:5px;">Details</a> <a type="button" value="Add" class="btn btn-success btn-xs" href="Compliance_History.php?cust='.$row['Costumer_ID'].'" style="margin-top:5px;">Complaint History</a></td>');
 
  echo('<td><a href="RSI-Invoice-download.php?id='.$row['Costumer_ID'].'&t='.time().'" class="btn btn-danger btn-xs invoice"><i class="fa fa-download" aria-hidden="true"></i> Invoice<a/></td>');

  echo('<td>'.$row['SaleDateIND'].'</td>');

   echo('<td>'.date("F Y",strtotime($row['SaleDateIND'])).'</td>');

echo('<td>'.ucfirst($row['Full_Name']).'</td>');

//echo('<td>'.'<a href="'.'disposition.php?Mobile='.$row['Mobile'].'Blaster&Disposition=Sale&UserName='.$_SESSION['username'].'">'.$row['Mobile'].'</a></td>');

//echo('<td>'.$row['LastName'].'</td>');

 echo('<td>'.strtolower($row['Email_ID']).'</td>');

 echo('<td>'.$row['Mobile_No'].'</td>');



 echo('<td>'.$row['PackageName'].'</td>');

 echo('<td>'.date("d-M-Y", strtotime($row['ActivationDate'])).'</td>') ;

 echo('<td>'.date("d-M-Y", strtotime($row['ExpDate'])).'</td>') ;

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



$qry = "select count(*) as counts from stock_tips where Sagment = '".$packagename."' and Result = 'Positive' and (Date BETWEEN '".$activation_date."' and '".$expiry_date."')";

$qr = mysqli_query($connect, $qry);

$d = mysqli_fetch_assoc($qr);

$Positive = $d['counts'];



$qry = "select count(*) as counts from stock_tips where Sagment = '".$packagename."' and Result = 'Negative' and (Date BETWEEN '".$activation_date."' and '".$expiry_date."')";

$qr = mysqli_query($connect, $qry);

$ds = mysqli_fetch_assoc($qr);

$Negative = $ds['counts'];



$qry = "select count(*) as counts from stock_tips where Sagment = '".$packagename."' and Result = 'Open' and (Date BETWEEN '".$activation_date."' and '".$expiry_date."')";

$qr = mysqli_query($connect, $qry);

$dss = mysqli_fetch_assoc($qr);



$Open = $dss['counts'];

 

 

 echo('<td>');

     if($row['Date_of_Birth']){

         echo $row['Date_of_Birth'];

     }

     else{

          echo "";

     }



 

 echo ('</td>') ;

 

 

 echo('<td>'.$row['KYC'].'</td>');

 echo('<td>'.strtoupper($row['Pan_Number']).'</td>');

 echo('<td>'.$row['Risk_Score'].'</td>');

 echo('<td>'.$row['Risk_Level'].'</td>');

 echo('<td>'.$row['DateTimeConvert'].'</td>');

 echo('<td><a href="#" class="btn btn-success btn-xs">'.$Positive.'</a></td>');

 echo('<td><a href="#" class="btn btn-danger btn-xs">'.$Negative.'</a></td>');

  echo('<td><a href="#" class="btn btn-info btn-xs">'.$Open.'</a></td>');
  if($row['Approval_Status'] == 'Pending' ){
       echo('<td><a href="#" class="btn btn-danger btn-xs" onclick="deleteCustomer('.$row['id'].')">Delete</a></td>');
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
    
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>

    

    <?php

 
$sql = ("SELECT Full_Name, Id, UserName, Mobile, Source, Disposition, Segment, DATE_FORMAT(TimeStamp, '%d/%m/%Y') AS TimeStampINR, DATE_FORMAT(LeadDateTime, '%d/%m/%Y') AS LeadDateTimeINR FROM Assigned_Leads WHERE `Mobile` ='".$Mobile."' ORDER BY `Assigned_Leads`.`Id` DESC LIMIT 0, 30" );

$result = mysqli_query($connect, $sql) or die($sql."<br/><br/>".mysql_error());
 // echo "<pre>";
// print_r(mysqli_fetch_array($result));
// echo "</pre>";
// exit;
$i = 0;
 
echo '<table width="100%" class="table table-bordered rowcount">';
echo '<tr class="brand-color-bg">';
echo '<td style="display:">Full Name</td>';
echo '<td>Agent Name</td>';
echo '<td style="display:none">Agent Name</td>';
echo '<td>Mobile</td>';
echo '<td>Source</td>';
echo '<td>Disposition</td>';
echo '<td>Segment</td>';
echo '<td>Lead Capture</td>';
echo '<td>Disposition update</td>';
echo '</tr>';
 
echo "<form name='form_update' method='post' action='leads-filter_back.php'>\n";
while ($students = mysqli_fetch_array($result)) {
    echo '<tr>';
    echo "<td>{$students['Full_Name']}</td>";
    echo "<td style='display:none;'>{$students['Id']}<input type='hidden' name='Id[$i]' value='{$students['Id']}' /></td>";
    echo "<td class='UserNameData' style='font-weight:bold;'>{$students['UserName']}</td>";
    echo "<td style='display:none;'><input type='text' size='40' class='AgentNames' name='UserName[$i]' value='{$students['UserName']}' /></td>";
    echo "<td>{$students['Mobile']}</td>";
    echo "<td>{$students['Source']}</td>";
    echo "<td>{$students['Disposition']}</td>";
    echo "<td>{$students['Segment']}</td>";
    echo "<td>{$students['LeadDateTimeINR']}</td>";
    echo "<td>{$students['TimeStampINR']}</td>";
    echo '</tr>';
    ++$i;
}
echo '<tr>';
echo "<td>
<select id='Agent' class='form-control AgentNames'>
  
</select>
<td style='font-size:18px;font-weight:bold;'>Total Records <span class='totalrow'></span></td>
<td><input type='submit' value='SUBMIT' class='btn btn-primary'/> </td>
</td>";
echo '</tr>';
echo "</form>";
echo '</table>';
?>
    
</div>



  <div class="containter" style="padding:20px 20px 0 20px;">

  <div style="padding:5px;" class="brand-color-bg"><strong>Supervisor Review</strong></div>

    <?php include('connection/dbconnection_crm.php')?>

    <?php

$sql = ("SELECT * FROM `supervisor-review` where Mobile = '".$Mobile."' ORDER BY  `Id` DESC  LIMIT 0 , 30");

//echo $sql;

 

$result = mysqli_query($connect, $sql);



//echo('<table id="veiw_Leadstest" class="display" cellspacing="0" width="100%">');

echo('<table id="followUpHistory" class="table" cellspacing="0" width="100%">');

echo('<thead>');

 echo('<tr>');
  echo('<th>Date</th>');
  echo('<th>Mobile</th>');
  echo('<th>Remark</th>');
  echo('<th>User</th>');
 echo('</tr>');

echo('</thead>');

echo('<tbody>');

while($row = mysqli_fetch_array($result))

{

echo('<tr class="quadrat">');

  echo('<td id="">'.$row['Date'].'</td>');
  echo('<td id="">'.$row['Mobile'].'</a></td>');
  echo('<td id="">'.$row['Remark'].'</a></td>');
  echo('<td id="">'.$row['User'].'</a></td>');

 echo('</tr>');

}

echo('</tbody>');

echo('</table>');





?>


 <div style="padding:5px;" class="brand-color-bg"><strong>Follow Up History</strong></div>

    <?php include('connection/dbconnection_crm.php')?>

    <?php

$sql = ("SELECT DATE_FORMAT( DateTime,  '%d/%m/%Y %h:%i %p' ) AS DATEandTime, Full_Name, Email, Mobile, Disposition, Remark, UserName, DATE_FORMAT( FowllowUpDateTime,  '%d/%m/%Y %h:%i %p' ) AS FollowUpDATEandTime, DATE_FORMAT( TimeStamp,  '%d/%m/%Y' ) AS TimeStampCreated, State,  Segment from `FolllowUpLeads` where Mobile = '".$Mobile."' ORDER BY  `DATEandTime` DESC  

LIMIT 0 , 30");

 

$result = mysqli_query($connect, $sql);



//echo('<table id="veiw_Leadstest" class="display" cellspacing="0" width="100%">');

echo('<table id="followUpHistory" class="table" cellspacing="0" width="100%">');

echo('<thead>');

 echo('<tr>');

  echo('<th>Assigned Date</th>');

  echo('<th>Full Name</th>');

  echo('<th>Email</th>');

  echo('<th>Mobile</th>');

  echo('<th>Disposition</th>');
  echo('<th>Segment</th>');

  echo('<th>Remark</th>');

  echo('<th>Agent Name</th>');

  echo('<th>Created Date Time</th>');

  echo('<th>State</th>');

  echo('</tr>');

echo('</thead>');

echo('<tbody>');

while($row = mysqli_fetch_array($result))

{

echo('<tr>');

  echo('<td id="">'.$row['DATEandTime'].'</td>');

  echo('<td id="">'.$row['Full_Name'].'</td>');

  echo('<td id="">'.$row['Email'].'</td>');

  echo('<td id="">'.$row['Mobile'].'</a></td>');

  echo('<td id="">'.$row['Disposition'].'</a></td>');
  echo('<td id="">'.$row['Segment'].'</a></td>');

  echo('<td id="">'.$row['Remark'].'</a></td>');

  echo('<td id="">'.$row['UserName'].'</a></td>');

  echo('<td id="">'.  $row['TimeStampCreated'].'</a></td>');

  echo('<td id="">'.$row['State'].'</a></td>');

  

  

 echo('</tr>');

}

echo('</tbody>');

echo('</table>');





?>

  </div>



</div>


<?php include('partial/footer.php') ?>
<script type="text/javascript">
$(document).ready(function() {
 <?php include('partial/agents-name.php'); ?>
    
    $('#Agent').live('change',function(){
  var Agent = $(this).val();
  $('.AgentNames').val(Agent)
  $('.UserNameData').text(Agent)
});
    
    setTimeout(function(){ 
     var rowcount =  $('.rowcount').find('tr').length - 2
     $('.totalrow').text(rowcount)
    }, 1000);
    
    

    
});
</script>


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
            { "orderable": false, "targets": [0,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27] }
        ],
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": false,
        "scrollY": winHeight+"px",
        "scrollCollapse": true,
        "paging": false,
        "scrollX": true,
        "searching":true,
        "lengthMenu":[250],
        dom: 'Bfrtip',
        buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
        ]
    
        });



  });







</script>





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
    
    var deleteCustomer = function(id){
        var r = confirm("Are you sure?");
        if (r == true) {
            $.ajax({
                type:"post",
                url:"Ajax_files/Delete_Customer.php",
                data:{
                    CustomerId:id
                },
                success:(res)=>{
                    console.log(res)
                    window.location.reload();
                }
            })
        }
    }
    
</script>