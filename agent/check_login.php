<?php 

//check_login.php

include('partial/session_start.php');

session_start();


$sel = "SELECT user_session_id FROM employee WHERE id = '".$_SESSION['Id']."'";
$qry = mysqli_query($connect,$sel);

$fetch = mysqli_fetch_assoc($qry);


	if($_SESSION['user_session_id'] != $fetch['user_session_id'])
	{
		// die("not matching");
		$data['output'] = 'logout';
	}
	else
	{
		// die("match");
		$data['output'] = 'login';
	}

echo json_encode($data);

?>