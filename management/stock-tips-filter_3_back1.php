<?php  include('partial/session_start.php'); ?>


<?php
 
$StartDateUSA = $_GET['StartDateUSA'];
$EndtDateUSA = $_GET['EndtDateUSA'];
$Packages = $_GET['Packages'];
//$username = $_GET['username'];
//$limit = $_GET['limit'];

//echo($StartDateUSA.' '.$EndtDateUSA.' '.$Packages); 

//$Disposition = $_GET['Disposition'];
 //$limit = $_GET['limit'];
 
date_default_timezone_set('Asia/Kolkata');
 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Stock Tips</title>
<?php require('partial/plugins.php'); ?>
</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">
 <div class="pull-left">
  <a href="memberpage.php">Dashbord</a> | <a href="stock-tips.php">Stock Tips</a> | <a href="stock-tips-filter_3.php" class="btn btn-xs btn-primary">Filter 3</a>  | <a href="stock-tips-filter_4.php">Filter 4</a> | <a href="stock-tips-update.php">Today's Update</a> | <a href="stock-tips-update-3month.php">Last 3 Months's Update</a> | <a href="stock-tips-update-open.php">Open</a>
 </div>
  
 <div class="clearfix"></div>
</div>   
	
	
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php') ?>

	
	<?php
	
	$sql = ("SELECT Id, Ideas, Sagment, Result, DATE_FORMAT( DateTime,  '%d-%m-%Y %H:%i' ) AS DateTimeCurrent FROM stock_tips WHERE Date >= '".$StartDateUSA."' AND Date <= '".$EndtDateUSA."' && `Sagment` ='".$Packages."' limit 30");


$result = mysqli_query($connect, $sql);

echo('<table id="" class="display table table-bordered" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr class="brand-color-bg">');
  echo('<th style="width:160px;">Date Time</th>');
  echo('<th style="width:200px;">Sagment</th>');
  echo('<th>Ideas</th>');
  echo('<th>Results</th>');
  
  echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
  echo('<td>'.$row['DateTimeCurrent'].'</td>');
  echo('<td>'.$row['Sagment'].'</td>');
  echo('<td>'.$row['Ideas'].'</td>');
  echo('<td><div class="btn '.$row['Result'].'" style="margin-left:10px;margin-right:10px">'.$row['Result'].'</div></td>');
  }
 echo('</tr>');
echo('</tbody>');
echo('</table>');


 /*
$sql = ("SELECT Id, Full_Name, Email, Mobile, Disposition, Source, UserName, Date, DateTime, TimeStamp, ModalFowllowUpDateTime FROM Assigned_Leads WHERE (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."') && `username` ='".$username."' ORDER BY  `Assigned_Leads`.`Id` DESC  LIMIT 0,  $limit" );
 
$result = mysqli_query($connect,$sql) or die($sql."<br/><br/>".mysql_error());
 
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
 
echo "<form name='form_update' method='post' action='stock-tips-filter_3_back1.php'>\n";
while ($students = mysqli_fetch_array($result)) {
	echo '<tr>';
	echo "<td>{$students['Full_Name']}</td>";
	echo "<td style='display:none;'>{$students['Id']}<input type='hidden' name='Id[$i]' value='{$students['Id']}' /></td>";
	echo "<td class='UserNameData' style='font-weight:bold;'>{$students['UserName']}</td>";
	echo "<td style='display:none;'><input type='text' size='40' class='AgentNames' name='UserName[$i]' value='{$students['UserName']}' /></td>";
	echo "<td>{$students['Mobile']}</td>";
	echo "<td>{$students['Source']}</td>";
	echo "<td>{$students['Disposition']}</td>";
	echo "<td>{$students['DateTime']}</td>";
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
*/
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