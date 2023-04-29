<?php

include('../connection/dbconnection_crm.php');

if($_POST){
    $upd = "update Assigned_Leads set Full_Name = '".$_POST['full_name']."' where Id = '".$_POST['Id']."'";
    mysqli_query($connect,$upd);
}
echo 'success';


?>




