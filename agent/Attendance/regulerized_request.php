<?php


include("../connection/dbconnection_crm.php");
if($_POST){
    $id = $_POST['id'];
    $message = $_POST['message'];
    $ins = "UPDATE attendence SET reg_status='pending', message = '".$message."' where id = '".$id."'";
    mysqli_query($connect,$ins);
    $json_data['status'] = 'success';
    echo json_encode($json_data);
    
}