<?php

	include('partial/session_start.php');

	session_start();
	$t = time();
	$t0 = $_SESSION['user_session_time'];
	$diff = $t - $t0;

	if ($diff > 1200 || !isset($t0)) {
	  $data['output'] = "logout";
	} else {
	  $data['Inactive_time'] = $diff . "sec";
	}

	echo json_encode($data);


?>




