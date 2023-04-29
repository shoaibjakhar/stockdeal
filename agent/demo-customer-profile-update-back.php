 <?php

include('connection/dbconnection_crm.php');


//$Idea = $_GET['Idea'];

//$Idea = mysql_real_escape_string($_GET['Idea']);  // This Works Always.

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

    
          

//$resultUpdate = $_GET['resultUpdate'];

 echo($Costumer_ID.$altSaleDate.$FirstName.$LastName.$Email_ID.$Mobile_No.$Location.$PackageName.$altActivation_Date.$altExp_Date.$Remark.$Paid_Amout.$Balance_amount.$PaymentMode.$Agent.$Manager);



$sql ="UPDATE  `Demo_Customer_profile` SET  `SaleDate` = '".$altSaleDate."', FirstName = '".$FirstName."', LastName = '".$LastName."', Email_ID = '".$Email_ID."', Mobile_No = '".$Mobile_No."', Location = '".$Location."', PackageName = '".$PackageName."', Activation_Date = '".$altActivation_Date."', Exp_Date = '".$altExp_Date."', Remark = '".$Remark."', Paid_Amout = '".$Paid_Amout."', Balance_amount = '".Balance_amount."', PaymentMode = '".$PaymentMode."', Agent = '".$Agent."', Manager = '".$Manager."'  WHERE `Demo_Customer_profile`.`Costumer_ID` ='".$Costumer_ID ."';";
mysqli_query($connect,$sql) or die('Error updating database');

header('Location: demo-customer-profile.php');

?>
