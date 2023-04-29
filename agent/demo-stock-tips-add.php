<?php
date_default_timezone_set('Asia/Kolkata');

$ModalFowllowUpDateTime = $_GET['ModalFowllowUpDateTime'];
$Segment = $_GET['Segment'];
$Idea = $_GET['Idea'];
$FowllowUpDateTime = $_GET['FowllowUpDateTime'];
  
?>


<?php include('connection/dbconnection_crm.php')?>


<?php
$sql ="INSERT INTO `Demo_Stock_Tips` (`Id`, `DateTime`, `Date`, `Sagment`, `Ideas`, `Result`, `TimeStamp`) VALUES (NULL, '".$ModalFowllowUpDateTime."', '".$FowllowUpDateTime."', '".$Segment."', '".$Idea."', 'Open', CURRENT_TIMESTAMP);";
mysqli_query($connect,$sql) or die('Error updating database');
?>



