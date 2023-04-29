<?php
date_default_timezone_set('Asia/Kolkata');
include('connection/dbconnection_crm.php');

$ModalFowllowUpDateTime = $_POST['ModalFowllowUpDateTime'];
$Segments = $_POST['Segment'];
$Idea = $_POST['Idea'];
$FowllowUpDateTime = $_POST['FowllowUpDateTime'];
?>




<?php
if (count($Segments)){
	foreach($Segments as $Segment){
	$sql ="INSERT INTO `Demo_Stock_Tips` (`Id`, `DateTime`, `Date`, `Sagment`, `Ideas`, `Result`, `TimeStamp`) VALUES (NULL, '".$ModalFowllowUpDateTime."', '".$FowllowUpDateTime."', '".$Segment."', '".$Idea."', 'Open', CURRENT_TIMESTAMP);";
  mysqli_query($connect, $sql) or die('Error updating database');
	}}
		
	 $result_update = mysqli_query($connect, "UPDATE employee SET demo_read_notification=0 ");
	


?>



