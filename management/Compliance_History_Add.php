<?php
ob_start(); 
$Costumer_ID = $_POST['Costumer_ID'];
$altSaleDate = $_POST['altSaleDate'];
$Full_Name = $_POST['Full_Name'];
$PanNumber = $_POST['PanNumber'];
$Email_ID = $_POST['Email_ID'];
$Mobile_No = $_POST['Mobile_No'];
$KYC = $_POST['KYC'];
$Compliance_Remarks = addslashes($_POST['Compliance_Remarks']);
$altActivation_Date = $_POST['altActivation_Date'];
$altExp_Date = $_POST['altExp_Date']; 
$Remark = $_POST['Remark'];
$Company_Amount = $_POST['Company_Amount'];
$TotalReceivedAmount = $_POST['TotalReceivedAmount'];
$TAX_Amount = $_POST['TAX_Amount'];
$PaymentMode = $_POST['PaymentMode'];
$Agent = $_POST['Agent'];
$Date_of_Birth = $_POST['altDate_of_Birth'];
$DateTime = $_POST['DateTime'];
$Risk_Score = $_POST['Risk_Score'];
$Risk_Level = $_POST['Risk_Level'];
$Agent_1 = $_POST['Agent_1'];
$Agent_1_Percentange = $_POST['Agent_1_Percentange'];
$Agent_1_Shared_Amount = $_POST['Agent_1_Shared_Amount'];
$Agent_2 = $_POST['Agent_2'];
$Agent_2_Percentange = $_POST['Agent_2_Percentange'];
$Agent_2_Shared_Amount = $_POST['Agent_2_Shared_Amount'];
$Agent_3 = $_POST['Agent_3'];
$Agent_3_Percentange = $_POST['Agent_3_Percentange'];
$Agent_3_Shared_Amount = $_POST['Agent_3_Shared_Amount'];

 
echo('Costumer_ID <strong>'.$Costumer_ID.' </strong><br>');
echo('altSaleDate <strong>'.$altSaleDate.' </strong><br>');
echo('Full_Name <strong>'.$Full_Name.' </strong><br>');
echo('PanNumber <strong>'.$PanNumber.' </strong><br>');
echo('Email_ID <strong>'.$Email_ID.' </strong><br>');
echo('Mobile_No <strong>'.$Mobile_No.' </strong><br>');
echo('KYC <strong>'.$KYC.' </strong><br>');
echo('PackageName <strong>'.$PackageName.' </strong><br>');
echo('altActivation_Date <strong>'.$altActivation_Date.' </strong><br>');
echo('altExp_Date <strong>'.$altExp_Date.' </strong><br>');
echo('Remark <strong>'.$Remark.' </strong><br>');
echo('Compliance_Remarks <strong>'.$Compliance_Remarks.' </strong><br>');
echo('Company_Amount <strong>'.$Company_Amount.' </strong><br>');
echo('TotalReceivedAmount <strong>'.$TotalReceivedAmount.' </strong><br>');
echo('TAX_Amount <strong>'.$TAX_Amount.' </strong><br>');
echo('PaymentMode <strong>'.$PaymentMode.' </strong><br>');
echo('Agent <strong>'.$Agent.' </strong><br>');

echo('DateTime <strong>'.$DateTime.' </strong><br>');
echo('Date_of_Birth <strong>'.$Date_of_Birth.' </strong><br>');
echo('Risk_Score <strong>'.$Risk_Score.' </strong><br>');
echo('Risk_Level <strong>'.$Risk_Level.' </strong><br>');
echo('Agent_1 <strong>'.$Agent_1.' </strong><br>');
echo('Agent_1_Percentange <strong>'.$Agent_1_Percentange.' </strong><br>');
echo('Agent_1_Shared_Amount <strong>'.$Agent_1_Shared_Amount.' </strong><br>');
echo('Agent_2 <strong>'.$Agent_2.' </strong><br>');
echo('Agent_2_Percentange <strong>'.$Agent_2_Percentange.' </strong><br>');
echo('Agent_2_Shared_Amount <strong>'.$Agent_2_Shared_Amount.' </strong><br>');
echo('Agent_3 <strong>'.$Agent_3.' </strong><br>');
echo('Agent_3_Percentange <strong>'.$Agent_3_Percentange.' </strong><br>');
echo('Agent_3_Shared_Amount <strong>'.$Agent_3_Shared_Amount.' </strong><br>');

?>


<?php include('connection/dbconnection_crm.php')?>



<?php

$sel = "select * from Customer_profile where Costumer_ID = '$Costumer_ID'";
$qry = mysqli_query($connect, $sel);
$fetch_data = mysqli_fetch_assoc($qry);
	
$sql = "INSERT INTO `Compliance_History` (`Costumer_ID`, `SaleDate`, `Full_Name`, `Email_ID`, `Mobile_No`, `Compliance_Remarks`) 
VALUES ('".$Costumer_ID."', '".$altSaleDate."', '".$fetch_data['Full_Name']."', '".$fetch_data['Email_ID']."', '".$fetch_data['Mobile_No']."', '".$Compliance_Remarks."');";

//echo($sql.'<br/><br/>');
mysqli_query($connect, $sql) or die('Error updating database');

 header("Location:Compliance_History.php?cust=".$Costumer_ID);
die('here');
?>





