<?php
include('partial/session_start.php');
$Id = $_GET['Id'];
$NewPassword  = $_GET['NewPassword'];

  
?>


<?php include('connection/dbconnection_crm.php')?>


<?php
if($_SESSION['Role'] == 'Super Admin'){
  $sql ="UPDATE  `admin` SET  `Password` =  '".$NewPassword."' WHERE  `admin`.`Id` ='".$Id."'";
   mysqli_query($connect,$sql) or die('Error updating database');
}
else if($_SESSION['Role'] == 'Team Leader'|| $_SESSION['Role'] == 'SR_TL')
{
   $sql ="UPDATE  `employee` SET  `Password` =  '".$NewPassword."' WHERE  `employee`.`Id` ='".$Id."'";
   mysqli_query($connect,$sql) or die('Error updating database');
}

?>




