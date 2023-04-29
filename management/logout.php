<?php

session_start();
require('includes/config.php');
 $logout_id = $_SESSION["Id"] ;
include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");
 if($_SESSION["Role"] == "Team Leader")
        {
         $up_qry = "update TL_attendence set Login_Status = 'InActive' where tl_id = '".$logout_id."' AND date='".date('d-m-Y')."'";
         mysqli_query($connect,$up_qry);
      }

//logout
$user->logout(); 

//logged in return to index page
header('Location: index.php');
exit;
?>

 