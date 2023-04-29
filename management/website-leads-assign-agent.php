<?php
//$AgentId = $_GET['AgentId'];
$id           =      $_GET["id"];
$AssignToCSR  =      $_GET["AssignToCSR"];
$AssignStatus =      $_GET["AssignStatus"];
$DateTime = date('Y-m-d H:i:s'); 
include('connection/dbconnection_crm.php');
$sql =" UPDATE `Assigned_Leads`  SET `Leads_Assigned_Date` = '".$DateTime."',  `Status` =  '".$AssignStatus."', `UserName` =  '".$AssignToCSR."'  WHERE  `Assigned_Leads`.`id` = '".$id."' ";
mysqli_query($connect, $sql) or die('Error updating database'.mysql_error);
//echo($id.' '.$AssignToCSR.' '.$AssignStatus);
header('Location: website-leads-rsi.php');
?>


