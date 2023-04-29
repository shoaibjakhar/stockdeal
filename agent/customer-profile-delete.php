<?php include('connection/dbconnection_crm.php')?>
<?php
$cust = $_GET['Costumer_ID'];
$del = "delete from Customer_profile where  Costumer_ID = '".$cust."'";
mysqli_query($connect,$del);
$del = "delete from Customer_Payment_History where  Costumer_ID = '".$cust."'";
mysqli_query($connect,$del);
header('location:customer-profile-new-this-month.php');

