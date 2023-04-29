 <?php

include('connection/dbconnection_crm.php');


$Id = $_GET['Id'];
 echo($Id);

$sql ="DELETE FROM `Demo_Stock_Tips` WHERE `Demo_Stock_Tips`.`Id` ='".$Id."'";
mysqli_query($connect, $sql) or die('Error updating database');

header('Location: demo-stock-tips.php');

?>
