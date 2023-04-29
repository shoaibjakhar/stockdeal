 <?php

include('connection/dbconnection_crm.php');


$Id = $_GET['Id'];
 echo($Id);

$sql ="DELETE FROM `stock_tips` WHERE `stock_tips`.`Id` ='".$Id."'";
mysqli_query($connect, $sql) or die('Error updating database');

header('Location: stock-tips.php');

?>
