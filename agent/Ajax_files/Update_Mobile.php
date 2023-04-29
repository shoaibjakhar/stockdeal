<?php

include('../connection/dbconnection_crm.php');

if($_POST){
    $upd = "update Assigned_Leads set Mobile_2 = '".$_POST['Mobile_2']."' where Id = '".$_POST['Id']."'";
    mysqli_query($connect, $upd);
}
echo 'success';


?>




