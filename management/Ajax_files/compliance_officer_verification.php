<?php
include('../connection/dbconnection_crm.php');

if($_POST){
    $upd = "update Customer_profile set compliance_officer_verification = 'Verified' where Costumer_ID = '".$_POST['CustomerId']."'";
    mysqli_query($connect,$upd);
}
echo 'success';


?>