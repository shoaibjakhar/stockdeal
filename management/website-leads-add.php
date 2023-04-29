<?php

$Full_Name = $_GET['Full_Name'];
$Email = $_GET['Email'];
$State = $_GET['State'];
$Mobile = $_GET['Mobile'];
$Agent = $_GET['Agent'];
$CurrentDate = $_GET['CurrentDate'];

  
?>


<?php include('connection/dbconnection_crm.php')?>

<?php
$sql ="INSERT INTO `Assigned_Leads` (`Id`, `Full_Name`, `Email`, `Mobile`, `State`, `Source`, `Disposition`, `UserName`, `Date`, `DateTime`, `TimeStamp`, `Data`, `Change`) VALUES (NULL, '".$Full_Name."', '".$Email."', '".$Mobile."', '".$State."', 'Website', 'Fresh', '".$Agent."', '".$CurrentDate."', '', CURRENT_TIMESTAMP, '', '');";
mysqli_query($connect, $sql) or die('Error updating database');
?>





