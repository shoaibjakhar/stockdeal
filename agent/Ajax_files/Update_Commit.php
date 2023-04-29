<?php
include('../connection/dbconnection_crm.php');

if($_POST){
    $upd = "update employee set Sale_Target = '".$_POST['Target']."' where Id = '".$_POST['Id']."'";
    mysqli_query($connect,$upd);
}
echo 'success';


?>




