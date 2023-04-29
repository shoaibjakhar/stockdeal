<?php  include('partial/session_start.php'); ?>
<?php
if(isset($_GET['UserName']) && isset($_GET['Source']) && isset($_GET['Disposition']) && isset($_GET['FollowUpId'])){
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
 $Mobile = preg_replace("/\s+/","",$_GET['Mobile']);
 $FollowUpId = $_GET['FollowUpId'];
}
$Mobile = preg_replace("/\s+/","",$_GET['Mobile']);
// echo $Mobile;exit;
if(strlen($Mobile)<4){
    $_SESSION['error'] = 'Please Enter Minimum 4 Charecters to Get Result';
    header('location:lead-details-filter2-new.php');
    exit();
}
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Leads</title>
<?php require('partial/plugins.php'); ?>
<style>
 .follow-up-notif-wrap{display:none;}
</style>

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
<div id="UpdateSaleTarget" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Update Name</h4>

      </div>

      <form method="post" action="javascript:void(0)" id="Update_Commit_Form">

      <div class="modal-body">

          <p>Name : </p>
          <input type = "text" class = "form-control name_val" name = "full_name">

        <div> 

       

        <input id="updates_val_id" type="hidden" name="Id" value="0" class="form-control id_val"/>

        </div>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary">Update</button>

      </div>

      </form>

    </div>



  </div>

</div>

<div id="UpdateMobileTarget" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Add Mobile</h4>

      </div>

      <form method="post" action="javascript:void(0)" id="Update_Mobile_Form">

      <div class="modal-body">
          
          <p>Mobile : </p>
          <input type = "text" class = "form-control mobile_1" name = "full_name" readonly>

          <p>Other Mobile Number  : </p>
          <input type = "text" class = "form-control mobile_2" name = "Mobile_2" >

        <div> 

       

        <input id="updates_val_id" type="hidden" name="Id" value="0" class="form-control id_val"/>

        </div>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary">Update</button>

      </div>

      </form>

    </div>



  </div>

</div>
<div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>
  </header>
  <div class="breadcurms"> 
  <!-- <a href="view-leads.php">View Leads</a> | <a href="lead-details.php" >Lead details</a> | <a href="lead-details-filter2-new.php">Filter 1</a>-->
  <!--<a href="memberpage.php">Follow Up Leads</a> | <a href="follow-up-leads-filter-2.php" >Filter 2</a> | <a href="fresh-leads.php" class="">Fresh Leads</a> | <a href="lead-details-filter2-new.php">Filter 1</a>  | <a href="leads-view.php">Add New Leads</a>-->
   <?php
    if($_SESSION['Role'] == 'Customer Care'){
        ?>
            <a href="follow-up-leads-filter-2.php">Filter 2</a> | <a href="lead-details-filter2-new.php" class="btn btn-xs btn-primary">Filter 1</a>
        <?php
    }
    else{
 ?>
 <a href="memberpage.php">Follow Up Leads</a> | <a href="follow-up-leads-filter-2.php">Filter 2</a> | <a href="fresh-leads.php">Fresh Leads</a> | <a href="lead-details-filter2-new.php" class="btn btn-xs btn-primary">Filter 1</a>  | <a href="leads-view.php">Add New Leads</a>
<?php
    }
?>
  </div>
  <div class="containter" style="padding:20px 20px 0 20px;">
    <?php include('connection/dbconnection_crm.php')?>
    <?php
 $sql = ("SELECT Full_Name, UserName, Email, Mobile,Mobile_2, State, Source, Disposition , Id, DATE_FORMAT( DateTime,  '%d/%m/%Y %H:%i %p' ) AS DATEandTime, Segment FROM  `Assigned_Leads` where `Mobile`='".$Mobile."'");
$result = mysqli_query($connect,$sql);

//echo('<table id="veiw_Leadstest" class="display" cellspacing="0" width="100%">');
echo('<table id="" class="table" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Full Name</th>');
  echo('<th>Email</th>');
  echo('<th>Mobile</th>');
  echo('<th>State</th>');
  echo('<th>Agent</th>');
  //echo('<th>Source</th>');
  echo('<th>Disposition</th>');
  echo('<th>Segment</th>');
  echo('<th>DateTime</th>');
  echo('<th>Update</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');

// echo "<pre>";
// print_r(mysqli_fetch_array($result));
// echo "</pre>";
// exit;
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
 echo('<td id="Full_Name">'.$row['Full_Name'].'&nbsp;&nbsp;&nbsp;<a class = "upDateCommit" data-name = "'.$row['Full_Name'].'" data-id = "'.$row['Id'].'" href="javascript:void()"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>');
 echo('<td id="Email">'.$row['Email'].'</td>');
 echo('<td id="Mobile"> <a href="javascript:void()" class = "updateMobile" data-id = "'.$row['Id'].'" data-mobile = "'.$row['Mobile'].'" data-mobile2 = "'.$row['Mobile_2'].'"  ><i class="fa fa-plus" aria-hidden="true"></i></a>&nbsp; <span id="bar">'.$row['Mobile'].'</span>, '.$row['Mobile_2'].' <a  class="btn btn-primary btn-xs" data-clipboard-action="copy" data-clipboard-target="#bar"> Copy</a></td>');
 echo('<td id="State">'.$row['State'].'</td>');
 echo('<td>'.$row['UserName'].'</td>');
 //echo('<td id="Source">'.$row['Source'].'</td>');
 echo('<td id="Disposition">'.$row['Disposition'].'</td>');
 echo('<td id="Segment">'.$row['Segment'].'</td>');
 echo('<td>'.$row['DATEandTime'].'</td>');
 echo('<td>'.'<a href="#" class="btn btn-primary update" id="'.$row['Id'].'" data-toggle="modal" data-target="#myModal_1">'.'Update'.'</a>'.'</td>');
}
 echo('</tr>');
echo('</tbody>');
echo('</table>');
?>
  </div>
   <div class="containter" style="padding:20px 20px 0 20px;">
  <div style="padding:5px;" class="brand-color-bg"><strong>Supervisor Review</strong></div>

    <?php include('connection/dbconnection_crm.php')?>

    <?php

$sql = ("SELECT * FROM `supervisor-review` where Mobile = '".$Mobile."' ORDER BY  `Id` DESC  LIMIT 0 , 30");

//echo $sql;

 

$result = mysqli_query($connect,$sql);



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
  </div>
  <div class="containter" style="padding:20px 20px 0 20px;">
  <div style="padding:5px;" class="brand-color-bg"><strong>Follow Up History</strong></div>
    <?php //include('connection/dbconnection_crm.php')?>
    <?php
$sql = ("SELECT DATE_FORMAT( DateTime,  '%d/%m/%Y %h:%i %p' ) AS DATEandTime, Full_Name, Email, Mobile, Disposition, Remark, UserName, DATE_FORMAT( FowllowUpDateTime,  '%d/%m/%Y %h:%i %p' ) AS FollowUpDATEandTime, State, Segment from `FolllowUpLeads` where (Mobile = '".$Mobile."' OR Full_Name LIKE '%".$Mobile."%' OR Email LIKE '%".$Mobile."%' ) ORDER BY  `DATEandTime` DESC  
LIMIT 0 , 30");
$result = mysqli_query($connect,$sql);
//echo('<table id="veiw_Leadstest" class="display" cellspacing="0" width="100%">');
echo('<table id="followUpHistory" class="table" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Date</th>');
  echo('<th>Full Name</th>');
  echo('<th>Email</th>');
  echo('<th>Mobile</th>');
  echo('<th>Disposition</th>');
  echo('<th>Segment</th>');
  echo('<th>Remark</th>');
  echo('<th>Agent Name</th>');
  echo('<th>Fowllow Up Date Time</th>');
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
  echo('<td id="">'.$row['FollowUpDATEandTime'].'</a></td>');
  echo('<td id="">'.$row['State'].'</a></td>');
 echo('</tr>');
}
echo('</tbody>');
echo('</table>');
?>
  </div>
	<div class="containter" style="padding:20px 20px 0 20px;">
<?php //include('connection/dbconnection_crm.php')?>
<?php

function calculateSum($type,$id){
    global $connect;
     $sel = "select Paid_Amout,Company_Amount,Tax_Amount from Customer_Payment_History where Costumer_ID = '$id'";
    $qry = mysqli_query($connect,$sel);
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
     $qry = mysqli_query($connect,$sel);
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
    $qry = mysqli_query($connect,$sel);
    $sum = 0;
    while($fetch = mysqli_fetch_assoc($qry)){
        $sum = $sum + $fetch['Agent_1_Shared_Amount'] + $fetch['Agent_2_Shared_Amount'] + $fetch['Agent_3_Shared_Amount'];
    }
    return $sum;
}
//print_r(agentList(651));


$sql = ("SELECT Id, Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name,  Email_ID, Mobile_No, Pan_Number, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,
DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout,  Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount,Agent_2, Agent_2_Percentange,
    Agent_2_Shared_Amount,Agent_3, Agent_3_Percentange,
    Agent_3_Shared_Amount,
Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_profile WHERE (Mobile_No = '".$Mobile."' OR Full_Name LIKE '%".$Mobile."%' OR Email_ID LIKE '%".$Mobile."%' ) ORDER BY  `DateTime` DESC ");
//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");
/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
FROM fut_hni");*/

//echo $sql;
$result = mysqli_query($connect,$sql);
echo('<table id="Result_Customer_Profile" class="display" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Costumer ID</th>');
  //echo('<th>Download Invoice</th>');
  echo('<th><div style="width:120px;"></div>Sale_Date</th>');
  //echo('<th><div style="width:120px;"></div>Sale Month</th>');
  echo('<th>Full Name</th>');
  //echo('<th>Last Name</th>');
  //echo('<th>Email ID</th>');
  echo('<th>Mobile No</th>');
  
  echo('<th>Package_Name</th>');
  echo('<th>Activation Date</th>');
  echo('<th>Exp_Date</th>');
  echo('<th><div style="width:120px;"></div>Status</th>');
  //echo('<th >Remark</th>');
  //echo('<th>Total Amout Received</th>');
  //echo('<th>Company Amount</th>');
    //echo('<th>Tax Amount</th>');
  //echo('<th>Payment Mode</th>');
  echo('<th>Agent_Full_Name</th>');

  echo('<th style="display: none">Share</th>');
  //echo('<th>Date_of_Birth</th>');
  //echo('<th>KYC</th>');
  //echo('<th>Pan Number</th>');
  echo('<th>Risk Score</th>');
  echo('<th>Risk Level</th>');
  echo('<th>Positive</th>');
  echo('<th>Negative</th>');
    echo('<th>Open</th>');
  //echo('<th>Date Time</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
 echo('<td>'.$row['Costumer_ID'].'<br><a type="button" value="Add" class="btn btn-success btn-xs" href="customer-profile-payment-history-new.php?cust='.$row['Costumer_ID'].'" style="margin-top:5px;">Details</a>'.'</td>');
  //echo('<td><a href="RSI-Invoice-download.php?id='.$row['Costumer_ID'].'&t='.time().'" class="btn btn-danger btn-xs invoice"><i class="fa fa-download" aria-hidden="true"></i> Invoice<a/></td>');
  echo('<td>'.$row['SaleDateIND'].'</td>');
   //echo('<td>'.date("M Y",strtotime($row['SaleDateIND'])).'</td>');
echo('<td>'.$row['Full_Name'].'</td>');
//echo('<td>'.'<a href="'.'disposition.php?Mobile='.$row['Mobile'].'Blaster&Disposition=Sale&UserName='.$username.'">'.$row['Mobile'].'</a></td>');
//echo('<td>'.$row['LastName'].'</td>');
 //echo('<td>'.$row['Email_ID'].'</td>');
 echo('<td>'.$row['Mobile_No'].'</td>');

 echo('<td>'.$row['PackageName'].'</td>');
 echo('<td>'.date("d-M-Y", strtotime($row['ActivationDate'])).'</td>') ;
 echo('<td>'.date("d-M-Y", strtotime($row['ExpDate'])).'</td>') ;
 echo('<td class="'.$row['Status'].'">'.$row['Status'].'</td>');
 //echo('<td >'.$row['Remark'].'</td>');
 //echo('<td>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'.calculateSum("paid",$row['Costumer_ID']).'</td>');
 //echo('<td>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'.calculateSum("com",$row['Costumer_ID']).'</td>');
  //echo('<td>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'.calculateSum("tax",$row['Costumer_ID']).'</td>');
 //echo('<td>'.$row['PaymentMode'].'</td>');
 
?>
      <td>
          <ul class="agent-list">
          <?php
                echo agentList($row['Costumer_ID']);
         
           
           ?>
           </ul>
    </td>
     <td style="display: none">
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
$qr = mysqli_query($connect,$qry);
$d = mysqli_fetch_assoc($qr);
$Positive = $d['counts'];

$qry = "select count(*) as counts from stock_tips where Sagment = '".$packagename."' and Result = 'Nagitive' and (Date BETWEEN '".$activation_date."' and '".$expiry_date."')";
$qr = mysqli_query($connect,$qry);
$ds = mysqli_fetch_assoc($qr);
$Nagitive = $ds['counts'];

$qry = "select count(*) as counts from stock_tips where Sagment = '".$packagename."' and Result = 'Open' and (Date BETWEEN '".$activation_date."' and '".$expiry_date."')";
$qr = mysqli_query($connect,$qry);
$dss = mysqli_fetch_assoc($qr);

$Open = $dss['counts'];

 
 /* echo('<td>');
     if($row['Date_of_Birth']){
         echo $row['Date_of_Birth'];
     }
     else{
          echo "";
     }

{
    
}
 echo ('</td>') ; */
 
 
 //echo('<td>'.$row['KYC'].'</td>');
 //echo('<td>'.$row['Pan_Number'].'</td>');
 echo('<td>'.$row['Risk_Score'].'</td>');
 echo('<td>'.$row['Risk_Level'].'</td>');
 echo('<td><a href="#" class="btn btn-success btn-xs">'.$Positive.'</a></td>');
 echo('<td><a href="#" class="btn btn-danger btn-xs">'.$Nagitive.'</a></td>');
  echo('<td><a href="#" class="btn btn-info btn-xs">'.$Open.'</a></td>');
 //echo('<td>'.$row['DateTimeConvert'].'</td>');
}
 echo('</tr>');
echo('</tbody>');
echo('</table>');
?>
</div>
</div>
<script src="js/clipboard.min.js"></script>
    <!-- 3. Instantiate clipboard -->
    <script>
    var clipboard = new Clipboard('.btn');
    clipboard.on('success', function(e) {
        console.log(e);
    });
    clipboard.on('error', function(e) {
        console.log(e);
    });
    </script>
<?php include('partial/footer.php') ?>
<form action="disposition-update.php" method="get">
<!-- Modal -->
<div class="modal fade" id="myModal_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Disposition</h4>
      </div>
      <div class="modal-body">
      <div class="alert alert-danger" id="InvalidInvestment_Choose_color" role="alert" style="display:none">
       <p>All fields are mandatory</p>
      </div>
        <table width="100%" class="table" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td>Disposition</td>
              <td><span class="disableNow">Date</span></td>
              <td><span class="disableNow">Hour</span></td>
              <td><span class="disableNow">Minutes</span></td>
            </tr>
            <tr>
              </td>
              <td><select id="Disposition_Modal" name="Disposition_Modal" class="form-control">
                  <?php require('partial/disposition.php'); ?> 
                </select>
                
                
                </td>
                <td><input type="text" class="form-control disableNow" id="datepicker" placeholder="Date" autocomplete="off">
                        <input type="hidden" class="form-control" id="FowllowUpDateTime" name="FowllowUpDateTime" placeholder="Date" autocomplete="off"></td>
                <td>
      <select id="Hour" name="Hour" class="disableNow form-control">
          <?php require('partial/hour.php'); ?> 
        </select></td>
      <td>
      <select id="Minuts" name="Minuts" class="disableNow form-control">
          <?php require('partial/minutes.php'); ?> 
        </select></td>
      <td style="display:none">
       <select id="Second" name="Second" class="form-control">
          <?php require('partial/seconds.php'); ?> 
        </select></td>
            </tr>
             <tr>
              <td>Remark</td>
              <td></td>
				 <td colspan="2"><span class="disableNow">Priority</span></td>
            </tr>
             <tr>
               <td colspan="2"><textarea id="Modal_remark" name="Modal_remark" class="form-control"></textarea></td>
              <td colspan="2"> <select id="Priority" name="Priority" class="form-control disableNow">
                   <option value="">Select</option>
                   <option value="High">High</option>
                   <option value="Medium">Medium</option>
				   <option value="Low">Low</option>
				   <option value="No Follow Up">No Follow Up</option>
        </select>
        <input type="hidden" id="Disposition_Class" value="" name="Disposition_Class" />
        
        </td>
            </tr>
             <tr style="display:none;">
             <td colspan="4"><input type="text" class="form-control" id="Modal_Full_Name" name="Modal_Full_Name"/>
             <input type="text" class="form-control" id="Modal_Email" name="Modal_Email"/>
              <input type="text" class="form-control" id="Modal_Mobile" name="Modal_Mobile"/>
             <input type="text" class="form-control" id="Modal_State" name="Modal_State"/>
				 <input type="text" class="form-control" id="Modal_Segment" name="Modal_Segment" style="width:200px;"/>
              <input type="text" class="form-control" id="Id_modal" name="Id_modal"/>
              <input type="text" class="form-control" id="DateTimeModel" name="DateTimeModel" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y-m-d H:i:s");?>"/>
             
				  <input type="text" id="Modal_UserName" name="Modal_UserName" value="<?php  echo $username;?>" class="form-control"/>
				  <input type="text"  name="FollowUpId" id="FollowUpId"  value="<?php  echo $_GET['FollowUpId']; ?>" />
				 </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button"  class="btn btn-primary"  id="SaveChanges">Save changes</button>
		  <input type="submit" value="Save changes" class="btn btn-primary" style="display:none;" id="SaveChangesFinal"/>
      </div>
    </div>
  </div>
</div>
</form>
<?php
    $sel = "select disposition from Options where Disposition_Date_Time = 'No'";
    $qry = mysqli_query($connect,$sel);
    $dispositions = array();
    while($row = mysqli_fetch_assoc($qry)){
        $dispositions[] = $row['disposition'];
    }
?>
<script>
var dispositions = '<?php echo json_encode($dispositions); ?>';
$(document).ready(function(e) {
   // console.log(dispositions);
   $('.update').click(function() {
	   
	var Id = $(this).attr("id");
	$('#Id_modal').val(Id);
	var Full_Name = $(this).parent().parent().find('#Full_Name').text();
	$('#Modal_Full_Name').val(Full_Name)
	var Email = $(this).parent().parent().find('#Email').text();
	$('#Modal_Email').val(Email)
	var Mobile = $(this).parent().parent().find('#Mobile span').text(); //$('#Mobile span').text()
	$('#Modal_Mobile').val(Mobile)
	var State = $(this).parent().parent().find('#State').text(); //$('#State').text()
	$('#Modal_State').val(State)
	   var Segment = $(this).parent().parent().find('#Segment').text(); //$('#Segment').text()
	$('#Modal_Segment').val(Segment)
	//$('#Id_modal').val()
	//$('#Id_modal').val()
	//$('#Id_modal').val()
	//$('#Id_modal').val()
	   
	   
	   
  });
  
   $(".upDateCommit").click(function(){

            $("#UpdateSaleTarget").modal('show');

            var name= $(this).attr("data-name");
            
             var id= $(this).attr("data-id");

            $(".name_val").val(name);

              $(".id_val").val(id);
          

            

        })
        
         
         $("#Update_Commit_Form").submit(function(e){

            e.preventDefault;

            var formData = $("#Update_Commit_Form").serialize();

           $.ajax({

               type:"post",

               url:"Ajax_files/Update_Name.php",

               data:formData,

               success:function(datas){

                  // console.log(datas);

                  window.location.reload();

               }

               

           })

        })
        
         $(".updateMobile").click(function(){

            $("#UpdateMobileTarget").modal('show');

            var mobile= $(this).attr("data-mobile");
            var mobile2= $(this).attr("data-mobile2");
            
             var id= $(this).attr("data-id");

            $(".mobile_1").val(mobile);
            $(".mobile_2").val(mobile2);

              $(".id_val").val(id);
          

            

        })
        
        $("#Update_Mobile_Form").submit(function(e){

            e.preventDefault;

            var formData = $("#Update_Mobile_Form").serialize();

           $.ajax({

               type:"post",

               url:"Ajax_files/Update_Mobile.php",

               data:formData,

               success:function(datas){

                  // console.log(datas);

                  window.location.reload();

               }

               

           })

        })
        
/*
  function UpdateDisposition() {
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  aa=new XMLHttpRequest();
  }
aa.onreadystatechange=function()
  {
  if (aa.readyState==4 && aa.status==200)
    {
    document.getElementById("txtHint").innerHTML=aa.responseText;
	}
  }
//var altDatepicker  = document.getElementById('altDatepicker').value
var Id_modal  = document.getElementById('Id_modal').value
var DateTimeModel  = document.getElementById('DateTimeModel').value
var Disposition_Modal  = document.getElementById('Disposition_Modal').value
var FowllowUpDateTime = $('#FowllowUpDateTime').val();
var Hour = $('#Hour').val();
var Minuts = $('#Minuts').val();
var Second = $('#Second').val();
var ModalFowllowUpDateTime = FowllowUpDateTime +' '+ Hour +':'+ Minuts +':'+ Second;
//alert(ModalFowllowUpDateTime)
//return false;
aa.open("GET","disposition-update.php?Id_modal="+Id_modal+"&DateTimeModel="+DateTimeModel+"&Disposition_Modal="+Disposition_Modal+"&ModalFowllowUpDateTime="+ModalFowllowUpDateTime,true);
aa.send();
}
  function FolllowUpLeads() {
	//alert('ok')
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  aa=new XMLHttpRequest();
  }
aa.onreadystatechange=function()
  {
  if (aa.readyState==4 && aa.status==200)
    {
    document.getElementById("txtHint").innerHTML=aa.responseText;
	}
  }
//var altDatepicker  = document.getElementById('altDatepicker').value
var DateTimeModel  = document.getElementById('DateTimeModel').value
var Disposition_Modal  = document.getElementById('Disposition_Modal').value
var Modal_Full_Name  = document.getElementById('Modal_Full_Name').value
var Modal_Email  = document.getElementById('Modal_Email').value
var Modal_Mobile  = document.getElementById('Modal_Mobile').value
var Modal_remark  = document.getElementById('Modal_remark').value
var Modal_UserName  = document.getElementById('Modal_UserName').value
 var FowllowUpDateTime = $('#FowllowUpDateTime').val();
  var Hour = $('#Hour').val();
  var Minuts = $('#Minuts').val();
  var Second = $('#Second').val();
var ModalFowllowUpDateTime = FowllowUpDateTime +' '+ Hour +':'+ Minuts +':'+ Second;
var Modal_State  = document.getElementById('Modal_State').value
//return false;
aa.open("GET","followUpleads-add.php?DateTimeModel="+DateTimeModel+"&Modal_Full_Name="+Modal_Full_Name+"&Modal_Email="+Modal_Email+"&Modal_Mobile="+Modal_Mobile+"&Disposition_Modal="+Disposition_Modal+"&Modal_remark="+Modal_remark+"&Modal_UserName="+Modal_UserName+"&ModalFowllowUpDateTime="+ModalFowllowUpDateTime+"&Modal_State="+Modal_State,true);
aa.send();
setTimeout(function(){ 
 var FollowUpId  = document.getElementById('FollowUpId').value
  $('#FollowUpIdButton').trigger('click');
  }, 500);
  }
*/
/*
 $('#SaveChanges').click(function() {
	var Disposition_Modal = $('#Disposition_Modal').val()
	var FowllowUpDateTime = $('#FowllowUpDateTime').val()
	var Hour = $('#Hour').val()
	var Minuts = $('#Minuts').val()
	var Modal_remark = $('#Modal_remark').val()
 });
  */
  $( "#datepicker" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#FowllowUpDateTime',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd'
});
  $("#Disposition_Modal").on('change', function() {
	 var disableNow = $(this).val()
	// if(disableNow == 'NT' || disableNow == 'NI' || disableNow == 'CT' || disableNow == 'LB' || disableNow == 'DND' || disableNow == 'WN' || disableNow == 'DC' || disableNow == 'Sale' ||  disableNow == 'NCD') {
    //alert('The option with value ' + $(this).val());
    if(dispositions.includes(disableNow)){
	$('.disableNow').css({'visibility':'hidden'})//.hide()
	 }
	 else {
		 $('.disableNow').css({'visibility':'visible'})
		 }
		 
		 	var Class = $('option:selected',this).attr('data-class');
	$("#Disposition_Class").val(Class);
	console.log(Class)
		 
});
$('#SaveChanges').click(function(){
	var Disposition_Modal = $('#Disposition_Modal').val();
	var Modal_remark = $('#Modal_remark').val();
	var Priority = $('#Priority').val();
	if(Disposition_Modal != ""  && Modal_remark != "") {
		  $('#InvalidInvestment_Choose_color').hide();
		  $('#SaveChangesFinal').trigger('click');
	  }
	  else {
		  $('#InvalidInvestment_Choose_color').show();
          //alert('Ok')
		  }
	});	
});
</script>
</body>
</html>