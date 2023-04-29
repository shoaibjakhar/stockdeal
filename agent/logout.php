<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
session_start();
// require('includes/config.php');

//logout
//$user->logout(); 


//include($_SERVER['DOCUMENT_ROOT']."/cookie.class.php");
include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");
$Id = $_SESSION['Id'];
	$up_qry = "UPDATE employee set Login_Status = 'InActive' where Id = '".$Id."'";
	
	mysqli_query($connect,$up_qry);

//App_Cookie::getInstance()->destroryAllCookies();
 
session_regenerate_id();
session_destroy();
//print_r($_SESSION); 
//logged in return to index page?>
<script>
  location.href = "index.php"  
</script>
