<?php 
error_reporting(-1);
ini_set('display_errors',1);
$connect = mysqli_connect('localhost','shareidea_ra','2T1zlj_14*KT','shareidea_ra');
	if(!$connect)
	{
	die('Could not connect!' . mysql_error);
	}

?>

