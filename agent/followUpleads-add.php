<?php

$Disposition_Modal = $_GET['Disposition_Modal'];
$DateTimeModel = $_GET['DateTimeModel'];
$Disposition_Modal = $_GET['Disposition_Modal'];
$Modal_Full_Name = $_GET['Modal_Full_Name'];
$Modal_Email = $_GET['Modal_Email'];
$Modal_Mobile = $_GET['Modal_Mobile'];
$Modal_remark = $_GET['Modal_remark'];
$Modal_UserName = $_GET['Modal_UserName'];
$ModalFowllowUpDateTime = $_GET['ModalFowllowUpDateTime'];
$Modal_State = $_GET['Modal_State'];
?>

 <?php include('connection/dbconnection_crm.php')?>

<?php

//'".$DateTimeModel."',

$sql ="INSERT INTO `FolllowUpLeads` (`Id`, `DateTime`, `Full_Name`, `Email`, `Mobile`, `Disposition`, `Remark`, `UserName`, `FowllowUpDateTime`, `State`, `TimeStamp`) VALUES (NULL, '".$DateTimeModel."', '".$Modal_Full_Name."', '".$Modal_Email."', '".$Modal_Mobile."', '".$Disposition_Modal."', '".$Modal_remark."', '".$Modal_UserName."', '".$ModalFowllowUpDateTime."', '".$Modal_State."', CURRENT_TIMESTAMP);";
 mysqli_query($connect,$sql) or die('Error updating database');

?>
