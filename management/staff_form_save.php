<?php
ob_start();
date_default_timezone_set('Asia/Kolkata');


include('connection/dbconnection_crm.php');
// echo "<pre>"; print_r($_POST); echo "</pre>";
if ($_POST['update']) {
	
	$beneficiary_name 		= isset($_POST['beneficiary_name']) ? $_POST['beneficiary_name'] :'';
	$mobile 				= isset($_POST['mobile']) ? $_POST['mobile'] :'';
	$email 					= isset($_POST['email']) ? $_POST['email'] :'';
	$category 				= isset($_POST['category']) ? $_POST['category'] :'';
	$address 				= isset($_POST['address']) ? $_POST['address'] :'';
	$bank_name 				= isset($_POST['bank_name']) ? $_POST['bank_name'] :'';
	$account_no 			= isset($_POST['account_no']) ? $_POST['account_no'] :'';
	$ifsc_code 				= isset($_POST['ifsc_code']) ? $_POST['ifsc_code'] :'';
	$amount 				= isset($_POST['amount']) ? $_POST['amount'] :'';
	$remarks 				= isset($_POST['remarks']) ? $_POST['remarks'] :'';
	$id 					= isset($_POST['id']) ? $_POST['id'] :'';

	$sql = "UPDATE staff SET beneficiary_name = '".$beneficiary_name."', mobile = '".$mobile."', email = '".$email."', category = '".$category."', address = '".$address."', bank_name = '".$bank_name."', account_no = '".$account_no."', ifsc_code = '".$ifsc_code."', amount = '".$amount."', remarks = '".$remarks."' WHERE id =".$id;

} else if($_GET['delete']){
	$sql = "DELETE FROM staff WHERE id = ". $_GET['id'];
} else {

	$beneficiary_name 		= isset($_POST['beneficiary_name']) ? $_POST['beneficiary_name'] :'';
	$mobile 				= isset($_POST['mobile']) ? $_POST['mobile'] :'';
	$email 					= isset($_POST['email']) ? $_POST['email'] :'';
	$category 				= isset($_POST['category']) ? $_POST['category'] :'';
	$address 				= isset($_POST['address']) ? $_POST['address'] :'';
	$bank_name 				= isset($_POST['bank_name']) ? $_POST['bank_name'] :'';
	$account_no 			= isset($_POST['account_no']) ? $_POST['account_no'] :'';
	$ifsc_code 				= isset($_POST['ifsc_code']) ? $_POST['ifsc_code'] :'';
	$amount 				= isset($_POST['amount']) ? $_POST['amount'] :'';
	$remarks 				= isset($_POST['remarks']) ? $_POST['remarks'] :'';

	$sql ="INSERT INTO  `staff` (`id`,`beneficiary_name`, `mobile`, `email`, `category`, `address`, `bank_name`, `account_no`, `ifsc_code`, `amount`, `remarks`)VALUES (NULL ,  '".$beneficiary_name."',  '".$mobile."',  '".$email."',  '".$category."',  '".$address."',  '".$bank_name."',  '".$account_no."', '".$ifsc_code."',  '".$amount."',  '".$remarks."');";
}

	// echo $sql; die();
mysqli_query($connect, $sql) or die('Error manupulating database');


header('Location: support_staff.php');



?>
