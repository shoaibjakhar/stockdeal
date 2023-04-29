<?php
ini_set('memory_limit','-1');
include($_SERVER['DOCUMENT_ROOT']."/stockdeal/management/connection/dbconnection_crm.php");
session_start();
 $username = $_SESSION['username'];
 $Role = $_SESSION['Role'];
//echo $username;
//echo $Role;
date_default_timezone_set('Asia/Kolkata'); 
$TodaysDate = date("Y-m-d");
include('validate-user.php');
?>