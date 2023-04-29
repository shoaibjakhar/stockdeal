<?php
ob_start();
include('connection/dbconnection_crm.php');
/*
//$Idea = $_GET['Idea'];

//$Idea = mysql_real_escape_string($_GET['Idea']);  // This Works Always.

$Costumer_ID = $_GET['Costumer_ID'];
$altSaleDate = $_GET['altSaleDate'];
$Full_Name = $_GET['Full_Name'];
$Pan_Number = $_GET['Pan_Number'];
$Email_ID = $_GET['Email_ID'];
$Mobile_No = $_GET['Mobile_No'];

$KYC = $_GET['KYC_select'];
$PackageName = $_GET['PackageName'];
$altActivation_Date = $_GET['altActivation_Date'];



$altExp_Date = $_GET['altExp_Date'];
$Remark = $_GET['Remark'];
$Paid_Amout = $_GET['Paid_Amout'];
$Company_Amount = $_GET['Company_Amount'];
$Tax_Amount = $_GET['Tax_Amount'];

$PaymentMode = $_GET['payment_mode'];
$Agent_Name = $_GET['Agent_Name'];
$Date_of_Birth = $_GET['altDate_of_Birth'];
$Risk_Score = $_GET['Risk_Score'];
$Risk_Level = $_GET['Risk_Level_select'];
$PPI_Credits = $_GET['PPI_Credits'];

    
          

//$resultUpdate = $_GET['resultUpdate'];

 echo('<strong>Costumer_ID </strong>'.$Costumer_ID.'<br>');
 echo('<strong>SaleDate </strong>'.$altSaleDate. '<br>');
 echo('<strong>Full_Name </strong>'.$Full_Name.'<br>');
 echo('<strong>Pan_Number </strong>'.$Pan_Number.'<br>');
 echo('<strong>Email_ID </strong>'.$Email_ID.'<br>');
 echo('<strong>Mobile_No </strong>'.$Mobile_No.'<br>');
 echo('<strong>KYC </strong>'.$KYC.'<br>');
 echo('<strong>$PackageName </strong>'.$PackageName.'<br>');
 echo('<strong>Activation_Date</strong>'.$altActivation_Date.'<br>');
 echo('<strong>Exp_Date</strong>'.$altExp_Date.'<br>');
 echo('<strong>Exp_Date</strong>'.$altExp_Date.'<br>');
 echo('<strong>Paid_Amout </strong>'.$Paid_Amout .'<br>');
 echo('<strong>Company_Amount </strong>'.$Company_Amount .'<br>');
 echo('<strong>Tax_Amount </strong>'.$Tax_Amount .'<br>');
 echo('<strong>Date_of_Birth </strong>'.$Date_of_Birth .'<br>');
 echo('<strong>PaymentMode </strong>'.$PaymentMode .'<br>');
 echo('<strong>Agent_Name  </strong>'.$Agent_Name .'<br>');
 echo('<strong>Risk_Score  </strong>'.$Risk_Score .'<br>');
 echo('<strong>Risk_Level  </strong>'.$Risk_Level .'<br>');
 echo('<strong>Remark  </strong>'.$Remark .'<br>');

*/

// $sql ="UPDATE  `Customer_profile` SET  `SaleDate` = '".$altSaleDate."', `PPI_Credits` = '".$PPI_Credits."', Full_Name = '".$Full_Name."', Pan_Number = '".$Pan_Number."', Email_ID = '".$Email_ID."', Mobile_No = '".$Mobile_No."', KYC = '".$KYC."', PackageName = '".$PackageName."', Activation_Date = '".$altActivation_Date."', Exp_Date = '".$altExp_Date."', Remark = '".$Remark."', Agent = '".$Agent_Name."', Date_of_Birth = '".$Date_of_Birth."', Risk_Score = '".$Risk_Score."', Risk_Level = '".$Risk_Level."', Remark = '".$Remark."'  WHERE `Customer_profile`.`Costumer_ID` ='".$Costumer_ID ."';";
// echo($sql.'<br>');
// mysqli_query($connect, $sql) or die('Error updating database');

$PackageName = $_POST['PackageName'];
$Costumer_ID = $_POST['Costumer_ID'];
$upd = "UPDATE Customer_profile SET PackageName = '".$PackageName."' WHERE `Customer_profile`.`Costumer_ID` ='".$Costumer_ID ."';";
mysqli_query($connect,$upd) or die('Error updating database');
header('Location: customer-profile-new-this-month.php');

?>
