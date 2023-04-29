<?php  include('partial/session_start.php'); ?>


<?php
 
$StartDateUSA = $_GET['StartDateUSA'];
$EndtDateUSA = $_GET['EndtDateUSA'];
$disposition = $_GET['disposition'];
$username = $_GET['username'];
$source_name = $_GET['source_name'];
$limit = $_GET['limit'];


//echo($StartDateUSA.' '.$EndtDateUSA.' '.$username.' '.$disposition.' '.$source_name.' '.$limit); 

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
</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms"> <a href="memberpage.php">Dashbord</a> | <a href="leads-view.php">Assigned Leads</a> | <a href="leads-filter_1_new.php">Filter 1</a> | <a href="leads-filter_3_new.php">Filter 3</a> | <a href="leads-filter_4_new.php" class="">Filter 4</a> | <a href="leads-filter_6_new.php" class="">Filter 6</a> | <a href="leads-filter_7_new.php" class="">Last 7 days Inactive</a> | <a href="leads-view-delete.php">Delete</a>
	
	
	
	</div> 
	
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>

	
	<?php

 
$sql = ("SELECT Id, Full_Name, Email, Mobile, Disposition, Source, UserName, Date, DateTime, TimeStamp, ModalFowllowUpDateTime FROM Assigned_Leads WHERE (DateTime >= '".$StartDateUSA."') AND (DateTime <= '".$EndtDateUSA."') && `username` ='".$username."' && `Disposition` ='".$disposition."' && `Source` ='".$source_name."' ORDER BY  `Assigned_Leads`.`Id` DESC  LIMIT 0,  $limit" );
 
$result = mysqli_query($connect ,$sql) or die($sql."<br/><br/>".mysql_error());
 
$i = 0;
 
echo '<table width="100%" class="table table-bordered rowcount">';
echo '<tr class="brand-color-bg">';
echo '<td style="display:">Name</td>';
echo '<td>Full_Name</td>';
echo '<td style="display:none">Full_Name</td>';
echo '<td>Mobile</td>';
echo '<td>Source</td>';
echo '<td>Disposition</td>';
echo '<td>Date Time</td>';
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
	echo "<td>{$students['TimeStamp']}</td>";
	echo '</tr>';
	++$i;
}
echo '<tr>';
echo "<td>
<select id='Agent' class='form-control AgentNames' name='UserName'>
  
</select>
<td style='font-size:18px;font-weight:bold;'>Total Records <span class='totalrow'></span></td>
<td><input type='submit' value='SUBMIT' class='btn btn-primary'/> </td>
</td>";
echo '</tr>';
echo "</form>";
echo '</table>';
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