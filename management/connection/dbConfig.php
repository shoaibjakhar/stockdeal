<?php
error_reporting(-1);
ini_set('display_errors',1);
$domain_name = $_SERVER['HTTP_HOST'];

// Real Stock Ideas Admin
if($domain_name == 'management.stockdeal.co.in' || $domain_name == 'www.management.stockdeal.co.in'){

	$dbHost = 'localhost';
	$dbUser = 'stockdeal_ra';
	$dbPass = '0YZm0!$F@';
	$dbName = 'stockdeal_ra';
	$conn = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);

}


?>



