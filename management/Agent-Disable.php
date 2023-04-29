<?php include('connection/dbconnection_crm.php')?>

<?php
$Id = $_POST['Id'];	

echo($Id);

$sql ="UPDATE `employee` SET `Status` = 'disabled' WHERE `employee`.`Id` = '".$Id."'";
mysqli_query($connect,$sql) or die('Error updating database');

header('Location: employee-login-details.php');

?>




