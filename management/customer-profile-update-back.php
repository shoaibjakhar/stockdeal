<?php
include('connection/dbconnection_crm.php');
//print_r($_POST);die;

$Costumer_ID = $_POST['Costumer_ID'];
$Email_ID = $_POST['Email_ID'];
$Mobile_No = $_POST['Mobile_No'];
$Full_Name = $_POST['Full_Name'];
$PackageName = $_POST['PackageName'];
$SaleDate = $_POST['altSaleDate'];
$altActivation_Date = $_POST['altActivation_Date'];
$altExp_Date = $_POST['altExp_Date'];
$PaymentMode = $_POST['PaymentMode'];
$Remark = $_POST['Remark'];
$PPI_Credits = $_POST['PPI_Credits'];
$Number_of_Days = $_POST['Number_of_Days'];

$sel_sho_hide = "SELECT Show_Hide FROM Options WHERE Show_Hide IS NOT NULL LIMIT 1";
$qry_show_hide = mysqli_query($connect ,$sel_sho_hide);
$fetch_show_hide = mysqli_fetch_assoc($qry_show_hide);
$show_hide = (array)json_decode($fetch_show_hide['Show_Hide']);
if($show_hide['Date_of_Birth']){
    $Date_of_Birth = $_POST['Date_of_Birth'];
}
else{
    $Date_of_Birth = date('Y-m-d');
}

if($show_hide['Risk_Score']){
    $Risk_Score = $_POST['Risk_Score'];
}
else{
    $Risk_Score = 0;
}
//Risk_Score

echo $upd_pr = "UPDATE Customer_profile SET Date_of_Birth = '".$Date_of_Birth."',KYC = '".$_POST['KYC']."',Pan_Number = '".$_POST['Pan_Number']."',Risk_Score = '".$Risk_Score."', Email_ID = '".$Email_ID."', Mobile_No = '".$Mobile_No."', Full_Name = '".$Full_Name."',PackageName = '".$PackageName."',SaleDate = '".$SaleDate."',Activation_Date = '".$altActivation_Date."',Exp_Date = '".$altExp_Date."',Remark = '".$Remark."',PPI_Credits = '".$PPI_Credits."'  WHERE Costumer_ID = '".$Costumer_ID."'";
mysqli_query($connect, $upd_pr);
$upd = "UPDATE Customer_Payment_History SET Date_of_Birth = '".$Date_of_Birth."',KYC = '".$_POST['KYC']."',Pan_Number = '".$_POST['Pan_Number']."',Risk_Score = '".$Risk_Score."', Email_ID = '".$Email_ID."', Mobile_No = '".$Mobile_No."', Full_Name = '".$Full_Name."',PackageName = '".$PackageName."' WHERE Costumer_ID = '".$Costumer_ID."' ";
mysqli_query($connect, $upd);

$upd = "UPDATE Customer_Payment_History SET Date_of_Birth = '".$Date_of_Birth."',KYC = '".$_POST['KYC']."',Pan_Number = '".$_POST['Pan_Number']."',Risk_Score = '".$Risk_Score."', Email_ID = '".$Email_ID."', Mobile_No = '".$Mobile_No."', Full_Name = '".$Full_Name."',PackageName = '".$PackageName."',Number_of_Days = '".$Number_of_Days."', Activation_Date = '".$altActivation_Date."', Exp_Date = '".$altExp_Date."',Remark = '".$Remark."' WHERE Costumer_ID = '".$Costumer_ID."' ORDER BY id DESC LIMIT 1 ";
mysqli_query($connect, $upd);

header('Location: customer-profile-all-in-one.php?cust='.$Costumer_ID);

// //$Idea = $_GET['Idea'];

// //$Idea = mysql_real_escape_string($_GET['Idea']);  // This Works Always.


// $altSaleDate = $_GET['altSaleDate'];

// $Pan_Number = $_GET['Pan_Number'];


// $KYC = $_GET['KYC_select'];

// $altActivation_Date = $_GET['altActivation_Date'];



// $altExp_Date = $_GET['altExp_Date'];
// $Remark = $_GET['Remark'];
// //$Paid_Amout = $_GET['Paid_Amout'];
// //$Company_Amount = $_GET['Company_Amount'];
// //$Tax_Amount = $_GET['Tax_Amount'];

// $PaymentMode = $_GET['payment_mode'];
// $Agent_Name = $_GET['Agent_Name'];
// $Date_of_Birth = $_GET['altDate_of_Birth']?$_GET['altDate_of_Birth']:date('Y-m-d');
// $Risk_Score = $_GET['Risk_Score']?$_GET['Risk_Score']:0;
// $Risk_Level = $_GET['Risk_Level_select']?$_GET['Risk_Level_select']:'No';
// $PPI_Credits = $_GET['PPI_Credits'];

    
          

// //$resultUpdate = $_GET['resultUpdate'];

//  echo('<strong>Costumer_ID </strong>'.$Costumer_ID.'<br>');
//  echo('<strong>SaleDate </strong>'.$altSaleDate. '<br>');
//  echo('<strong>Full_Name </strong>'.$Full_Name.'<br>');
//  echo('<strong>Pan_Number </strong>'.$Pan_Number.'<br>');
//  echo('<strong>Email_ID </strong>'.$Email_ID.'<br>');
//  echo('<strong>Mobile_No </strong>'.$Mobile_No.'<br>');
//  echo('<strong>KYC </strong>'.$KYC.'<br>');
//  echo('<strong>$PackageName </strong>'.$PackageName.'<br>');
//  echo('<strong>Activation_Date</strong>'.$altActivation_Date.'<br>');
//  echo('<strong>Exp_Date</strong>'.$altExp_Date.'<br>');
//  echo('<strong>Exp_Date</strong>'.$altExp_Date.'<br>');
//  echo('<strong>Paid_Amout </strong>'.$Paid_Amout .'<br>');
//  echo('<strong>Company_Amount </strong>'.$Company_Amount .'<br>');
//  echo('<strong>Tax_Amount </strong>'.$Tax_Amount .'<br>');
//  echo('<strong>Date_of_Birth </strong>'.$Date_of_Birth .'<br>');
//  echo('<strong>PaymentMode </strong>'.$PaymentMode .'<br>');
//  echo('<strong>Agent_Name  </strong>'.$Agent_Name .'<br>');
//  echo('<strong>Risk_Score  </strong>'.$Risk_Score .'<br>');
//  echo('<strong>Risk_Level  </strong>'.$Risk_Level .'<br>');
//  echo('<strong>Remark  </strong>'.$Remark .'<br>');



// $sql ="UPDATE  `Customer_profile` SET  `SaleDate` = '".$altSaleDate."', `PPI_Credits` = '".$PPI_Credits."', Full_Name = '".$Full_Name."', Pan_Number = '".$Pan_Number."', Email_ID = '".$Email_ID."', Mobile_No = '".$Mobile_No."', KYC = '".$KYC."', PackageName = '".$PackageName."', Activation_Date = '".$altActivation_Date."', Exp_Date = '".$altExp_Date."', Remark = '".$Remark."',  Agent = '".$Agent_Name."', Date_of_Birth = '".$Date_of_Birth."', Risk_Score = '".$Risk_Score."', Risk_Level = '".$Risk_Level."', Remark = '".$Remark."'  WHERE `Customer_profile`.`Costumer_ID` ='".$Costumer_ID ."';";
// echo($sql.'<br>');
// mysqli_query($connect ,$sql) or die('Error updating database');


// header('Location: customer-profile-all-in-one.php?cust='.$Costumer_ID);

?>
