<?php

$Id_modal = $_GET['Id_modal'];
$DateTimeModel = $_GET['DateTimeModel'];
$Disposition_Modal = $_GET['Disposition_Modal'];


?>

 <?php include('connection/dbconnection_crm.php')?>

<?php


$sql ="UPDATE  `Assigned_Leads` SET  `Disposition` =  '".$Disposition_Modal."',
`DateTime` =  '".$DateTimeModel."' WHERE  `Assigned_Leads`.`Id` ='".$Id_modal."'";
 mysqli_query($connect, $sql) or die('Error updating database');
?>
