<?php
include('connection/dbconnection_crm.php');
$Id = $_GET['Id'];
$resultUpdate = $_GET['resultUpdate'];
echo($Id.$Idea);
echo $sql ="UPDATE `stock_tips` SET  Result = '".$resultUpdate."'  WHERE `stock_tips`.`Id` ='".$Id."';";
mysqli_query($connect, $sql) or die('Error updating database');
header('Location: stock-tips-update-open.php');
?>
