<?php
ob_start();
error_reporting(1);
ini_set('display_errors',1);
$domain_name = $_SERVER['HTTP_HOST'];

// Real Stock Ideas  
if($domain_name == 'management.stockdeal.co.in' || $domain_name == 'www.management.stockdeal.co.in' || $domain_name = "localhost"){

	$connect = mysqli_connect('localhost','stockdeal_ra','0YZm0!$F@','stockdeal_ra');
//	$connect = mysqli_connect('db-mysql-blr1-20482-do-user-10692459-0.b.db.ondigitalocean.com:25060','doadmin','iKd5pNhhL1YaDbrE','defaultdb');
	
	if(!$connect)
	{
	die('Could not connect!' . mysql_error);
	}
}


if (!function_exists('mysql_result')) {
  function mysql_result($res, $row, $field=0) {
    return mysqli_result($res, $row, $field=0);
  }
}

if (!function_exists('mysqli_result')) {
  function mysqli_result($res, $row, $field=0) {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
  }
}

if (!function_exists('mysql_query')) {
    function mysql_query($query){
        global $connect;
        return mysqli_query($connect,$query);
    }
}

//mysql_fetch_array

if (!function_exists('mysql_fetch_array')) {
    function mysql_fetch_array($query){
        global $connect;
        return mysqli_fetch_array($query);
    }
}
if (!function_exists('mysql_fetch_assoc')) {
    function mysql_fetch_assoc($query){
        global $connect;
        return mysqli_fetch_array($query);
    }
}
if (!function_exists('mysql_close')) {
    function mysql_close($con){
        //global $connect;
        return mysqli_close($con);
    }
}
//mysql_free_result
if (!function_exists('mysql_num_rows')) {
    function mysql_num_rows($query){
        global $connect;
        return mysqli_num_rows($query);
    }
}

if (!function_exists('mysql_free_result')) {
    function mysql_free_result($query){
        global $connect;
        return mysqli_free_result($query);
    }
}

 
?>

