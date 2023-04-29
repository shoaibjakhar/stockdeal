<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set("Asia/Calcutta");

$domain_name = $_SERVER['HTTP_HOST'];

// Real Stock Ideas
if($domain_name == 'management.stockdeal.co.in' || $domain_name == 'www.management.stockdeal.co.in'){

	define('DBHOST','localhost');
	define('DBUSER','stockdeal_ra');
	define('DBPASS','0YZm0!$F@');
	define('DBNAME','stockdeal_ra');
}


//application address
#define('DIR','https://rsi-admin.webmahape.online');
define('DIR','https://management.stockdeal.co.in');
define('SITEEMAIL','noreply@rsi-admin.webmahape.online/'); 

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
include('classes/phpmailer/mail.php');
$user = new User($db);
?>




