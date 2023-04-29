<?php


$FullName = $_GET['FullName'];
$EmailID = $_GET['EmailID'];
$MobileNo = $_GET['MobileNo'];
$State = $_GET['State'];
$Source = $_GET['Source'];
$Disposition = $_GET['Disposition'];
$UserName = $_GET['UserName'];
$CurrentDate = $_GET['CurrentDate'];
$CurrentDateTime = date('Y-m-d h:i:s');
?>


<?php include('connection/dbconnection_crm.php')?>

<?php

$sql ="INSERT INTO `Assigned_Leads` (`Id`, `Full_Name`, `Email`, `Mobile`, `State`, `Source`, `Disposition`, `UserName`, `Date`, 
`DateTime`, `TimeStamp`) VALUES (NULL, '".$FullName."', '".$EmailID."', '".$MobileNo."', '".$State."', '".$Source."', '".$Disposition."', '".$UserName."', '".$CurrentDate."', '".$CurrentDateTime."', CURRENT_TIMESTAMP);";

mysqli_query($connect,$sql) or die('Error updating database');
?>




