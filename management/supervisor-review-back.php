<?php
ob_start(); 


echo $Date =     date("Y-m-d");
echo $User    = $_GET['User'];
echo $Remark    = addslashes($_GET['Remark']);
echo $Mobile  = $_GET['Mobile'];


  
?>


<?php include('connection/dbconnection_crm.php')?>


<?php

$sql ="INSERT INTO  `supervisor-review` (`Date` ,`User` ,`Remark` ,`Mobile`)
VALUES ('".$Date."',  '".$User."', '".$Remark."',  '".$Mobile."');";

echo $sql;
mysqli_query($connect, $sql) or die('Error updating database');

header("Location: supervisor-review.php");

?>
