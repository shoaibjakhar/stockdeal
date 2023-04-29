<?php
session_start();
error_reporting(-1);
ini_set('display_errors',1);
ini_set('memory_limit', '-1');
//print_r($_SESSION); exit;
// define('EXPIRY',time()+3*60*60);
// include($_SERVER['DOCUMENT_ROOT']."/cookie.class.php");

//print"<pre>";
// print_r($_SESSION); exit;
$username = $_SESSION['username'];
$User_Id = $_SESSION['Id']; 
$Role = $_SESSION['Role'];
$Password =  $_SESSION["Password"];
$Mobile = $_SESSION['Mobile'];
//var_dump($username);
// print"</pre>";
 //$_SESSION['Id'] -> $User_Id
//$_SESSION['Role'] -> $Role
//$_SESSION['username'] -> $username
//$_SESSION['Mobile'] -> $Mobile
$username = $_SESSION['username'];
include_once($_SERVER['DOCUMENT_ROOT']."/stockdeal/agent/connection/dbconnection_crm.php");
//print_r($_SESSION);
date_default_timezone_set("Asia/Kolkata");
if($_SESSION['username'] != ''){
    $sel = "SELECT Change_Password_Date_Time FROM employee WHERE username = '".$_SESSION['username']."'";
    $qry = mysqli_query($connect,$sel);
    $fetch = mysqli_fetch_assoc($qry);
    if($fetch['Change_Password_Date_Time']){
        $datetime1 = new DateTime(date('Y-m-d',strtotime($fetch['Change_Password_Date_Time'])));
        $datetime2 = new DateTime(date('Y-m-d'));
        $difference = $datetime1->diff($datetime2);
        if($difference->days>15){
            $change_pass_page = basename($_SERVER["SCRIPT_FILENAME"], '.php');
            if($change_pass_page != 'change-password'){
                header('location:change-password.php');
            }
        }
        
        
    }
}






//header('location:testingredirect.php');
 
include('validate-user.php');

date_default_timezone_set('Asia/Kolkata'); 

 
 //print_r($_SESSION);
?>