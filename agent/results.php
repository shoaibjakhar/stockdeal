<?php  include('partial/session_start.php'); ?>


<?php
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
 

 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Leads</title>
<?php require('partial/plugins.php'); ?>
</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms"> <a href="view-leads.php" class="">View Leads</a> | <a href="lead-details.php" >Lead details</a> | <a href="lead-details-filter2-new.php" >Filter 1</a> | <a href="leads-view.php">Add New Leads</a></div>
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>
<?php
$sql = ("SELECT  DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DateTimeConvert, Full_Name, Email, Mobile, State, Source, Disposition, TimeStamp, Investment, Segment  FROM  
`Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."') ORDER BY  `Assigned_Leads`.`TimeStamp` DESC ");

	
	
	
	
	
/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
FROM fut_hni");*/


$result = mysqli_query($connect, $sql);

echo('<table id="DispositionResults" class="display" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Full_Name</th>');
  echo('<th>Investment</th>');
  echo('<th>Segment</th>');
  echo('<th>Mobile</th>');
  echo('<th>Date</th>');
  echo('<th>State</th>');
  //echo('<th>Source</th>');
  echo('<th>Disposition</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
 echo('<td>'.$row['Full_Name'].'</td>');
echo('<td>'.$row['Investment'].'</td>');
echo('<td>'.$row['Segment'].'</td>');	
echo('<td>'.'<a class="" href="'.'disposition.php?Mobile='.$row['Mobile'].'&UserName='.$username.'&FollowUpId='.$row['id'].'&Full_Name='.$row['Full_Name'].'"><i class="fa fa-phone" aria-hidden="true"></i> '.$row['Mobile'].'</a>');
 echo('<td>'.$row['DateTimeConvert'].'</td>');
	echo('<td>'.$row['State'].'</td>');
 //echo('<td>'.$row['Source'].'</td>');
 echo('<td>'.$row['Disposition'].'</td>');
}
 echo('</tr>');
echo('</tbody>');
echo('</table>');


?>



</div>

</div>


<?php include('partial/footer.php') ?>
