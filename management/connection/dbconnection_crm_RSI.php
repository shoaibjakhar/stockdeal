<?php 
error_reporting(0);
ini_set('display_errors',0);
$connect = mysqli_connect('localhost','realstoc_RSI','J*XTM.Y&fH[F','realstoc_RSI');
	if(!$connect)
	{
	die('Could not connect!' . mysql_error);
	}

?>

