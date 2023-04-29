<?php


$DateTime = $_GET['DateTime'];
$ToWhom    = $_GET['ToWhom'];
$Agent    = $_GET['Agent'];
$Subject  = $_GET['Subject'];
$Priority = $_GET['Priority'];
$Message  = $_GET['Message'];
$Status  = $_GET['Status'];

  
?>


<?php include('connection/dbconnection_crm.php')?>


<?php
$sql ="INSERT INTO  `Agent_request` (`Id` ,`DateTime` ,`Agent` ,`ToWhom` ,`Subject` ,`Priority` ,`Message` ,`Status`)
VALUES (NULL ,  '".$DateTime."',  '".$Agent."', '".$ToWhom."',  '".$Subject."',  '".$Priority."', '".$Message."', '".$Status."');";

mysqli_query($connect, $sql) or die('Error updating database');

?>




