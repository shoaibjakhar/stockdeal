<?php
ob_start();

include('connection/dbconnection_crm.php');


//$Idea = $_GET['Idea'];

//$Idea = mysql_real_escape_string($_GET['Idea']);  // This Works Always.

$Id = $_GET['Id'];
$User = $_GET['User'];
$Password = $_GET['Password'];
$Mobile = $_GET['Mobile'];


 echo($Id.$User.$Password.$Mobile);



$sql ="UPDATE  `clients` SET  `User` =  '".$User."', `Password` =  '".$Password."', `Mobile` =  '".$Mobile."' WHERE  `clients`.`Id` ='".$Id."';";
mysqli_query($connect, $sql) or die('Error updating database');

header('Location: clients.php');



?>
