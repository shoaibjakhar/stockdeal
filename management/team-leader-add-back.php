<?php
session_start();
include('connection/dbconnection_crm.php');
date_default_timezone_set('Asia/Kolkata');
$ins = "INSERT INTO admin (username,Password,Role,Status) VALUES('".$_POST['username']."','".$_POST['Password']."','Team Leader','Active')";
mysqli_query($connect, $ins);
$_SESSION['message'] = "Team Leader Added Successfully";
header('location:'.$_SERVER['HTTP_REFERER']);
