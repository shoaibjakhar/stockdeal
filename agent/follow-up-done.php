<?php



$FollowUpId = $_GET['FollowUpId'];


echo ($FollowUpId);
?>

 <?php include('connection/dbconnection_crm.php')?>

<?php

$sql ="UPDATE  `FolllowUpLeads` SET  `Status` =  'Done' WHERE  `FolllowUpLeads`.`Id` ='".$FollowUpId."'";
 mysqli_query($connect,$sql) or die('Error updating database');

header("Location: memberpage.php")

?>

