<?php
session_start();
include('../connection/dbconnection_crm.php');
if(isset($_POST['password']) && $_POST['password'] != ''){
    $upd = "UPDATE admin SET Password = '".$_POST['password']."' WHERE Id = '".$_POST['Id']."'";
    mysqli_query($connect,$upd);
    $_SESSION['message'] = 'Password Updated Successfull';
    header('location:'.$_SERVER['HTTP_REFERER']);
}
else{
    if($_POST['Status'] == 'Disabled'){
        $Status = 'Active';
    }
    else{
        $Status = 'Disabled';
    }
    $upd = "update admin set Status = '".$Status."'  where Id = '".$_POST['Id']."'";
    mysqli_query($connect,$upd);
    echo 'success';
}
?>