<?php
include('../connection/dbconnection_crm.php');

if($_POST){
    $upd = "delete from Customer_profile where id = '".$_POST['CustomerId']."'";
    mysqli_query($connect,$upd);
   $del = "delete from Customer_Payment_History where  Costumer_ID = '".$_POST['cust']."'";
    mysqli_query($connect,$del);
}
echo 'success';


?>
