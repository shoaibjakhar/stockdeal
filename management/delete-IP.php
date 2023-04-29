<?php include('connection/dbconnection_crm.php')?>
<?php

$id = $_GET['id'];
$qry = "DELETE FROM `allowUser` WHERE  id = '$id'";
mysqli_query($connect, $qry);
header('location:ip-restriction-history.php');


?>