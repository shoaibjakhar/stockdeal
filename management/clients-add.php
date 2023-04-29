<?php
date_default_timezone_set('Asia/Kolkata');

$User = $_GET['User'];
$Password = $_GET['Password'];
$Mobile = $_GET['Mobile'];
?>


<?php include('connection/dbconnection_crm.php')?>



<?php
$sql ="INSERT INTO  `clients` (`Id` ,`User` ,`Password` ,`Email` ,`Mobile` ,`Timestamp`)VALUES (NULL ,  '".$User."',  '".$Password."',  '', '".$Mobile."', CURRENT_TIMESTAMP);";
mysqli_query($connect, $sql) or die('Error updating database');
?>

