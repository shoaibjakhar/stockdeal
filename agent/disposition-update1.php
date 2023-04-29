<?php

$Id_modal = $_GET['Id_modal'];
$DateTimeModel = $_GET['DateTimeModel'];
$Disposition_Modal = $_GET['Disposition_Modal'];
$Modal_UserName = $_GET['Modal_UserName'];


?>

 <?php include('connection/dbconnection_crm.php')?>

<?php

$sql ="UPDATE  `Assigned_Leads` SET  `Disposition` =  '".$Disposition_Modal."',`UserName` =  '".$Modal_UserName."',
`DateTime` =  '".$DateTimeModel."' WHERE  `Assigned_Leads`.`Id` ='".$Id_modal."'";
 mysqli_query($connect,$sql) or die('Error updating database');
?>
