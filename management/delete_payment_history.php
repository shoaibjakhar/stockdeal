<?php include('connection/dbconnection_crm.php')?>
<?php

$id = $_GET['Id'];
$qry = "delete from Customer_Payment_History where id = '$id'";
mysqli_query($connect, $qry);
header('location:customer-profile-payment-history-new.php?cust='.$_GET['cust']);






?>