<?php include('connection/dbconnection_crm.php')?>

<?php
	
$Id = $_POST['Id'];	



$sql ="UPDATE `employee` SET `Status` = 'Active' WHERE `employee`.`Id` = '".$Id."'";
mysqli_query($connect, $sql) or die('Error updating database');
echo($Id);
header('Location: employee-login-details.php');

?>




