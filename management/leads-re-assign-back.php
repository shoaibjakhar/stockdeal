<?php  include('partial/session_start.php'); ?>


<?php
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
 $limit = $_GET['limit'];
 
date_default_timezone_set('Asia/Kolkata');
 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Website Leads</title>
<?php require('partial/plugins.php'); ?>
</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">
 <a href="memberpage.php">Dashbord</a> | <a href="website-leads-rsi.php">Single Assign</a> | <a href="assign-multiple-leads.php">Multiple Assign</a> | <a href="assign-leads-new-front.php" class="btn btn-xs btn-primary">Bulk Assign</a> 
</div>
	
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>

	
	<?php

 if($_SESSION['Role'] == 'Super Admin') {
  //$sql = "SELECT Id, Full_Name, Email, Mobile, Segment, Disposition, Source,  State, UserName, Date, DateTime, TimeStamp, ModalFowllowUpDateTime FROM Assigned_Leads WHERE `username` ='Akshay Shetty' && `Disposition` ='Fresh' && `Source` ='".$Source."' ORDER BY  `Assigned_Leads`.`Id` DESC  LIMIT 0, $limit";     
 }

 else if($_SESSION['Role'] == 'Team Leader') {
    $sql = "SELECT Id, Full_Name, Email, Mobile, Segment, Disposition, Source,  State, UserName, Date, DateTime, TimeStamp, ModalFowllowUpDateTime FROM Assigned_Leads WHERE `username` ='".$_GET['agent_name']."' && `Disposition` ='Fresh' ORDER BY  `Assigned_Leads`.`Id` DESC  LIMIT 0, $limit";  
 }


 
$result = mysqli_query($connect ,$sql) or die($sql."<br/><br/>".mysql_error());
 
$i = 0;
 
echo '<table width="100%" class="table table-bordered rowcount">';
echo '<tr class="brand-color-bg">';
echo '<td style="display:">Customer Name</td>';
echo '<td>Agent Name</td>';
echo '<td style="display:none">Full_Name</td>';
echo '<td>Mobile</td>';
echo '<td>Segment</td>';
echo '<td>Source</td>';
echo '<td>Disposition</td>';
echo '<td>Date Time</td>';
echo '</tr>';
 
echo "<form name='form_update' method='post' action='assign-leads-new-back.php'>\n";
while ($students = mysqli_fetch_array($result)) {
	echo '<tr>';
	echo "<td>{$students['Full_Name']}</td>";
	echo "<td style='display:none;'>{$students['Id']}<input type='hidden' name='Id[$i]' value='{$students['Id']}' /></td>";
	echo "<td class='UserNameData' style='font-weight:bold;'>{$students['UserName']}</td>";
	echo "<td style='display:none;'><input type='text' size='40' class='AgentNames' name='UserName[$i]' value='{$students['UserName']}' /></td>";
	echo "<td>{$students['Mobile']}</td>";
	echo "<td>{$students['Segment']}</td>";
	echo "<td>{$students['Source']}</td>";
	echo "<td>{$students['Disposition']}</td>";
	echo "<td>{$students['DateTime']}</td>";
	echo '</tr>';
	++$i;
}
echo '<tr>';
echo "<td>";
?>
<select id='Agent' class='form-control AgentNames' name="AgentNames">
    <option value="">Select Agents</option>
  <?php
  $sel = "SELECT username from employee where Team_Leader = '$username'";
    $qry = mysqli_query($connect ,$sel);
    while($row = mysqli_fetch_assoc($qry)){
    echo '<option value="'.$row['username'].'">'.$row['username'].'</option>';
    }
  ?>
</select>
<?php
echo "
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
 <?php // include('partial/agents-name.php'); ?>
	
//	$('#Agent').live('change',function(){
  //var Agent = $(this).val();
  //$('.AgentNames').val(Agent)
  //$('.UserNameData').text(Agent)
});
	
	setTimeout(function(){ 
	 var rowcount =  $('.rowcount').find('tr').length - 2
	 $('.totalrow').text(rowcount)
	}, 1000);
	
});
</script>