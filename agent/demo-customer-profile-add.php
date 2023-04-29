<?php

$Costumer_ID = $_GET['Costumer_ID'];
$altSaleDate = $_GET['altSaleDate'];
$FirstName = $_GET['FirstName'];
$LastName = $_GET['LastName'];
$Email_ID = $_GET['Email_ID'];
$Mobile_No = $_GET['Mobile_No'];
$Location = $_GET['Location'];
$PackageName = $_GET['PackageName'];
$altActivation_Date = $_GET['altActivation_Date'];
$altExp_Date = $_GET['altExp_Date']; 
$Remark = $_GET['Remark'];
$Paid_Amout = $_GET['Paid_Amout'];
$Balance_amount = $_GET['Balance_amount'];
$PaymentMode = $_GET['PaymentMode'];
$Agent = $_GET['Agent'];
$Manager = $_GET['Manager'];
$DateTime = $_GET['DateTime'];
  
?>


<?php include('connection/dbconnection_crm.php')?>



<?php
$sql ="INSERT INTO `Demo_Customer_profile` (`id`, `Data`, `Costumer_ID`, `SaleDate`, `FirstName`, `LastName`, `Email_ID`, `Mobile_No`, `Location`, `PackageName`, `Activation_Date`, `Exp_Date`, `Remark`, `Paid_Amout`, `Balance_amount`,`PaymentMode`, `Agent`, `Manager`, `DateTime`, `Timestamp`) VALUES (NULL, '', '".$Costumer_ID."', '".$altSaleDate."', '".$FirstName."', '".$LastName."', '".$Email_ID."', '".$Mobile_No."', '".$Location."', '".$PackageName."', '".$altActivation_Date."', '".$altExp_Date."', '".$Remark."', '".$Paid_Amout."', '".$Balance_amount."', '".$PaymentMode."', '".$Agent."', '".$Manager."', '".$DateTime."',  CURRENT_TIMESTAMP);";
mysqli_query($connect,$sql) or die('Error updating database');
?>






