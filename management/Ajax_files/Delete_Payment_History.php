<?php
include('../connection/dbconnection_crm.php');

if($_POST){
    $upd = "delete from Customer_Payment_History where Costumer_ID = '".$_POST['CustomerId']."'";
    mysqli_query($connect,$upd);
}
echo 'success';


?>
