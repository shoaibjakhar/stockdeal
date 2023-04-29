<?php include('connection/dbconnection_crm.php')?>
<?php

$id = $_GET['Id'];
$qry = "delete from Compliance_History where id = '$id'";
mysqli_query($connect, $qry);
header('location:Compliance_History.php?cust='.$_GET['cust']);






?>