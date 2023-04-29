<?php

$Id_Notification = $_GET['Id_Notification'];
$Follow_Up_Reminder_datepicker = $_GET['Follow_Up_Reminder_datepicker'];
$Hour = $_GET['Hour'];
$Minuts = $_GET['Minuts'];
$FowllowUpDateTime = $Follow_Up_Reminder_datepicker.' '.$Hour.':'.$Minuts.':00';

echo("Id_Notification".' '.$Id_Notification.'<br/>');
echo("Follow_Up_Reminder_datepicker".' '.$Follow_Up_Reminder_datepicker.'<br/>');
echo("Hour".' '.$Hour.'<br/>');
echo("Minuts".' '.$Minuts.'<br/>');

echo ($FowllowUpDateTime) 
?>


 <?php include('connection/dbconnection_crm.php') ?>

<?php

$sql ="UPDATE  `FolllowUpLeads` SET  `FowllowUpDateTime` =  '".$FowllowUpDateTime."' WHERE  `FolllowUpLeads`.`Id` ='".$Id_Notification."'";
mysqli_query($connect, $sql) or die('Error updating database');

	
header('Location: memberpage');
?>






