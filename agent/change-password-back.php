<?php
date_default_timezone_set("Asia/Kolkata");
$Id = $_GET['Id'];
$NewPassword  = $_GET['NewPassword'];

$dtime = date('Y-m-d H:i:s');
?>


<?php include('connection/dbconnection_crm.php')?>


<?php
$sql ="UPDATE  `employee` SET  `Password` =  '".$NewPassword."',`Change_Password_Date_Time` = '".$dtime."' WHERE  `employee`.`Id` ='".$Id."'";

//UPDATE  `employee` SET  `Password` =  'asfasd' WHERE  `employee`.`Id` ='41'

mysqli_query($connect,$sql) or die('Error updating database');

?>




