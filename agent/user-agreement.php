<?php  include('partial/session_start.php'); ?>

<?php


include('connection/dbconnection_crm.php');

$result_update = mysqli_query($connect, "UPDATE employee SET read_notification=1 where username = '$username' ");
//echo $result_update;
?>


<?php
 $UserName = $_GET['UserName'];
 //echo $UserName; exit;
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
 
date_default_timezone_set('Asia/Kolkata');
 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Stock Tips</title>
<?php require('partial/plugins.php'); ?>
<style>
.Agreed {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
}

.Pending {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}
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
  <a href="memberpage.php">Dashbord</a>
  
  <?php
  
  if($_SESSION['Role'] == 'Super Admin') {
      
    //echo(' ');   
  }
  
  ?> 
 </div>
 
 <div class="clearfix"></div>
</div>

<div class="containter" style="padding:20px 20px 0 20px;">

<?php

include('connection/dbconnection_crm.php');


$sql = ("SELECT * FROM User_Agreement  ORDER BY  `Id` DESC");


//Agent = '".$UserNameSession."'
	
	
	
//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");



/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin

FROM fut_hni");*/





$result = mysqli_query($connect, $sql);



echo('<table id="Agent_request" class="display" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
 echo('<th>Status</th>');
 echo('<th>DateTime</th>');
 echo('<th>Full_Name</th>');
 echo('<th>Email</th>');
 echo('<th>Mobile</th>');
 //echo('<th>Agent_Name</th>');
 echo('<th>IP Address</th>');
 //echo('<th>Action</th>');
  
 echo('</tr>');
echo('</thead>');
echo('<tbody>');

while($row = mysql_fetch_array($result))

{
echo('<tr>');
	 echo('<td> <a href="#_" class="btn btn-xs  '.$row['Status'].'">'.$row['Status'].'</a></td>');
  echo('<td>'.date("d-F-Y h:i a",strtotime($row['DateTime'])).'</td>');
  echo('<td>'.$row['Full_Name'].'</td>');
 echo('<td>'.$row['Email'].'</td>');
  echo('<td>'.$row['Mobile'].'</td>');
  //echo('<td>'.$row['Agent_Name'].'</td>');
  echo('<td>'.$row['remoteAddress'].'</td>');
   //echo('<td></td>');
}
echo('</tr>');

echo('</tbody>');

echo('</table>');





?>


</div>



<?php include('partial/footer.php') ?>




