<?php
ob_start(); 
error_reporting(1);
ini_set('display_errors',1);


$Costumer_ID = isset($_POST['Costumer_ID']) ? $_POST['Costumer_ID'] : '';
$altSaleDate = isset($_POST['altSaleDate']) ? $_POST['altSaleDate'] : '';
$Full_Name = isset($_POST['Full_Name']) ? $_POST['Full_Name'] : '';
$PanNumber = isset($_POST['PanNumber']) ? $_POST['PanNumber'] : '';
$Email_ID = isset($_POST['Email_ID']) ? $_POST['Email_ID'] : '';
$Mobile_No = isset($_POST['Mobile_No']) ? $_POST['Mobile_No'] : '';
$KYC = isset($_POST['KYC']) ? $_POST['KYC'] : '';
$PackageName = isset($_POST['PackageName']) ? $_POST['PackageName'] : '';
$altActivation_Date = isset($_POST['altActivation_Date']) ? date_format($_POST['altActivation_Date'],"Y/m/d") : '';
$altExp_Date = isset($_POST['altExp_Date']) ? $_POST['altExp_Date'] : ''; 
$Remark = isset($_POST['Remark']) ? $_POST['Remark'] : '';
$Gateway_Amount = isset($_POST['Gateway_Amount']) ? $_POST['Gateway_Amount'] : '';
$Company_Amount = isset($_POST['Company_Amount']) ? $_POST['Company_Amount'] : '';
$Number_of_Days = isset($_POST['Number_of_Days']) ? $_POST['Number_of_Days'] : '';


$TotalReceivedAmount = isset($_POST['TotalReceivedAmount']) ? $_POST['TotalReceivedAmount'] :'';
$TAX_Amount = isset($_POST['TAX_Amount']) ? $_POST['TAX_Amount'] :'';
$PaymentMode = isset($_POST['PaymentMode']) ? $_POST['PaymentMode'] :'';
$Agent = isset($_POST['Agent']) ? $_POST['Agent'] :'';
$Date_of_Birth = isset($_POST['altDate_of_Birth']) ? $_POST['altDate_of_Birth'] :'';
$DateTime = isset($_POST['DateTime']) ? $_POST['DateTime'] :'';
$Risk_Score = isset($_POST['Risk_Score']) ? $_POST['Risk_Score'] :'';
$Risk_Level = isset($_POST['Risk_Level']) ? $_POST['Risk_Level'] :'';
$Agent_1 = isset($_POST['Agent_1']) ? $_POST['Agent_1'] :'';
$Agent_1_TL = isset($_POST['Agent_1_TL']) ? $_POST['Agent_1_TL'] :'';
$Agent_1_Percentange = isset($_POST['Agent_1_Percentange']) ? $_POST['Agent_1_Percentange'] :'';
$Agent_1_Shared_Amount = isset($_POST['Agent_1_Shared_Amount']) ? $_POST['Agent_1_Shared_Amount'] :'';
$Agent_2 = isset($_POST['Agent_2']) ? $_POST['Agent_2'] :'';
$Agent_2_TL = isset($_POST['Agent_2_TL']) ? $_POST['Agent_2_TL'] :'';
$Agent_2_Percentange = isset($_POST['Agent_2_Percentange']) ? $_POST['Agent_2_Percentange'] :'';
$Agent_2_Shared_Amount = isset($_POST['Agent_2_Shared_Amount']) ? $_POST['Agent_2_Shared_Amount'] :'';
$Agent_3 = isset($_POST['Agent_3']) ? $_POST['Agent_3'] :'';
$Agent_3_TL = isset($_POST['Agent_3_TL']) ? $_POST['Agent_3_TL'] :'';
$Agent_3_Percentange = isset($_POST['Agent_3_Percentange']) ? $_POST['Agent_3_Percentange'] :'';
$Agent_3_Shared_Amount = isset($_POST['Agent_3_Shared_Amount']) ? $_POST['Agent_3_Shared_Amount'] :'';

$Created_payment_date = isset($_POST['Created_payment_date']) ? $_POST['Created_payment_date'] :'';
$utr_no               = isset($_POST['utr_no']) ? $_POST['utr_no'] :'';


 
// echo('Costumer_ID <strong>'.$Costumer_ID.' </strong><br>');
// echo('altSaleDate <strong>'.$altSaleDate.' </strong><br>');
// echo('Full_Name <strong>'.$Full_Name.' </strong><br>');
// echo('PanNumber <strong>'.$PanNumber.' </strong><br>');
// echo('Email_ID <strong>'.$Email_ID.' </strong><br>');
// echo('Mobile_No <strong>'.$Mobile_No.' </strong><br>');
// echo('KYC <strong>'.$KYC.' </strong><br>');
// echo('PackageName <strong>'.$PackageName.' </strong><br>');
// echo('altActivation_Date <strong>'.$altActivation_Date.' </strong><br>');
// echo('altExp_Date <strong>'.$altExp_Date.' </strong><br>');
// echo('Remark <strong>'.$Remark.' </strong><br>');
// echo('Company_Amount <strong>'.$Company_Amount.' </strong><br>');
// echo('TotalReceivedAmount <strong>'.$TotalReceivedAmount.' </strong><br>');
// echo('TAX_Amount <strong>'.$TAX_Amount.' </strong><br>');
// echo('PaymentMode <strong>'.$PaymentMode.' </strong><br>');
// echo('Agent <strong>'.$Agent.' </strong><br>');

// echo('DateTime <strong>'.$DateTime.' </strong><br>');
// echo('Date_of_Birth <strong>'.$Date_of_Birth.' </strong><br>');
// echo('Risk_Score <strong>'.$Risk_Score.' </strong><br>');
// echo('Risk_Level <strong>'.$Risk_Level.' </strong><br>');
// echo('Agent_1 <strong>'.$Agent_1.' </strong><br>');
// echo('Agent_1_Percentange <strong>'.$Agent_1_Percentange.' </strong><br>');
// echo('Agent_1_Shared_Amount <strong>'.$Agent_1_Shared_Amount.' </strong><br>');
// echo('Agent_2 <strong>'.$Agent_2.' </strong><br>');
// echo('Agent_2_Percentange <strong>'.$Agent_2_Percentange.' </strong><br>');
// echo('Agent_2_Shared_Amount <strong>'.$Agent_2_Shared_Amount.' </strong><br>');
// echo('Agent_3 <strong>'.$Agent_3.' </strong><br>');
// echo('Agent_3_Percentange <strong>'.$Agent_3_Percentange.' </strong><br>');
// echo('Agent_3_Shared_Amount <strong>'.$Agent_3_Shared_Amount.' </strong><br>');

?>


<?php include('connection/dbconnection_crm.php')?>



<?php
 $sel = "select * from Customer_profile where Costumer_ID = '$Costumer_ID'";
$qry = mysqli_query($connect, $sel);
$fetch_data = mysqli_fetch_assoc($qry);
//print_r($fetch_data);

/*
$sql ="INSERT INTO `Customer_profile` (`Costumer_ID`, `SaleDate`, `Email_ID`, `Mobile_No`, `PackageName`, `Activation_Date`, `Exp_Date`, `Remark`, `Paid_Amout`, `PaymentMode`, `Agent`, `DateTime`, Full_Name, Pan_Number, KYC, Company_Amount, Tax_Amount, Date_of_Birth, Risk_Score, Risk_Level, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount, Agent_2, Agent_2_Percentange, Agent_2_Shared_Amount, Agent_3, Agent_3_Percentange, Agent_3_Shared_Amount) VALUES 
('".$Costumer_ID."', '".$altSaleDate."',  '".$Email_ID."', '".$Mobile_No."', '".$PackageName."', '".$altActivation_Date."', '".$altExp_Date."', '".$Remark."', '".$TotalReceivedAmount."', '".$PaymentMode."', '".$Agent."', '".$DateTime."', '".$Full_Name."', '".$PanNumber."', '".$KYC."',  '".$Company_Amount."', '".$TAX_Amount."', '".$Date_of_Birth."', '".$Risk_Score."', '".$Risk_Level."', '".$Agent_1."', '".$Agent_1_Percentange."', '".$Agent_1_Shared_Amount."', '".$Agent_2."', '".$Agent_2_Percentange."', '".$Agent_2_Shared_Amount."', '".$Agent_3."', '".$Agent_3_Percentange."', '".$Agent_3_Shared_Amount."');";

//echo($sql.'<br/><br/>');

mysqli_query($connect,$sql) or die('Error updating database');
*/
    
    
$sql = "INSERT INTO `Customer_Payment_History` (`Costumer_ID`, `SaleDate`, `Exp_Date`, `Full_Name`, `Email_ID`, `Mobile_No`, `PackageName`,`Activation_Date`, `Paid_Amout`, `PaymentMode`, `Gateway_Amount`, `Company_Amount`, `Tax_Amount`, `Agent_1`,`Agent_1_TL`, `Agent_1_Percentange`, `Agent_1_Shared_Amount`, `Agent_2`,`Agent_2_TL`, `Agent_2_Percentange`, `Agent_2_Shared_Amount`, `Agent_3`,`Agent_3_TL`, `Agent_3_Percentange`, `Agent_3_Shared_Amount` , `Number_of_Days`, `Created_payment_date`, `utr_no`) 
VALUES ('".$Costumer_ID."', '".$altSaleDate."', '".$altExp_Date."', '".$fetch_data['Full_Name']."', '".$fetch_data['Email_ID']."', '".$fetch_data['Mobile_No']."', '".$fetch_data['PackageName']."','".$fetch_data['Activation_Date']."', '".$TotalReceivedAmount."', '".$PaymentMode."', '". $Gateway_Amount ."' , '".$Company_Amount."', '".$TAX_Amount."', '".$Agent_1."','".$Agent_1_TL."', '".$Agent_1_Percentange."', '".$Agent_1_Shared_Amount."', '".$Agent_2."','".$Agent_2_TL."', '".$Agent_2_Percentange."', '".$Agent_2_Shared_Amount."', '".$Agent_3."','".$Agent_3_TL."', '".$Agent_3_Percentange."', '".$Agent_3_Shared_Amount."', '".$Number_of_Days."', '".$Created_payment_date."', '".$utr_no."');";

$myfile = fopen("query_logs/admin_payment_history_queires.txt", "a");
$txt = "This  is " . date("Y-m-d H:i:sa") . "\n" . $sql . "\n\n";

fwrite($myfile, $txt);
fclose($myfile);


// log here in database @shoaib
// same do for agent so can track the queries and missing fields

//echo($sql.'<br/><br/>');

$result = mysqli_query($connect ,$sql) or die('Error updating database');
 $last_insert_id = $connect->insert_id; 

// adding logs will del later

$context = json_encode(['file' => 'customer-profile-payment-history-new-add.php', 'Costumer_ID' => $Costumer_ID, 'Agent_1_TL' => $Agent_1_TL, 'Agent_2_TL' => $Agent_2_TL, 'Agent_3_TL' => $Agent_2_TL]);
$msg = 'payment_history_admin';

$query_params = [
    'Costumer_ID' => $Costumer_ID, 
    'SaleDate' => $altSaleDate, 
    'Exp_Date' => $altExp_Date, 
    'Full_Name' => $fetch_data['Full_Name'], 
    'Email_ID' => $fetch_data['Email_ID'], 
    'Mobile_No' => $fetch_data['Mobile_No'], 
    'PackageName' => $fetch_data['PackageName'],
    'Activation_Date' => $fetch_data['Activation_Date'], 
    'Paid_Amout' => $TotalReceivedAmount, 
    'PaymentMode' => $PaymentMode, 
    'Company_Amount' => $Company_Amount, 
    'Tax_Amount' => $TAX_Amount, 
    'Agent_1' => $Agent_1,
    'Agent_1_TL' => $Agent_1_TL, 
    'Agent_1_Percentange' => $Agent_1_Percentange, 
    'Agent_1_Shared_Amount' => $Agent_1_Shared_Amount, 
    'Agent_2' => $Agent_2,
    'Agent_2_TL' => $Agent_2_TL, 
    'Agent_2_Percentange' => $Agent_2_Percentange, 
    'Agent_2_Shared_Amount' => $Agent_2_Shared_Amount, 
    'Agent_3' => $Agent_3,
    'Agent_3_TL' => $Agent_3_TL, 
    'Agent_3_Percentange' => $Agent_3_Percentange, 
    'Agent_3_Shared_Amount' => $Agent_3_Shared_Amount,
    'Number_of_Days' => $Number_of_Days, 
    'Created_payment_date' => $Created_payment_date, 
    'utr_no' => $utr_no,
];
$query = json_encode($query_params);
session_start();
$created_by = json_encode(['username' => $_SESSION['username'], 'Role' => $_SESSION['Role']]);

$logs_sql = "INSERT INTO `query_logs` (`context`, `msg`, `query`, `created_by`) 
             VALUES ('".$context."', '".$msg."', '".$query."', '".$created_by."');";

mysqli_query($connect ,$logs_sql) or die('Error inserting query logs in database at customer-profile-payment-history-new');

// logs ends
 // print_r($result);
 // die();

// header("Location: Ajax_files/extend-package-email.php?id=".$last_insert_id);

 // die();
// echo "string";
// print_r($connect->insert_id);
// die();
$upd = "update Customer_profile set Exp_Date = '".$altExp_Date."' WHERE Costumer_ID = '".$Costumer_ID."'";
mysqli_query($connect, $upd);



/*  

values ('$Costumer_ID','$altSaleDate','$PackageName','$TotalReceivedAmount','$PaymentMode',
'$Agent','$DateTime','$Full_Name','$Company_Amount','$TAX_Amount','$Agent_1','$Agent_1_Percentange','$Agent_1_Shared_Amount','$Agent_2','$Agent_2_Percentange','$Agent_2_Shared_Amount','$Agent_3','$Agent_3_Percentange','$Agent_3_Shared_Amount',
'".$fetch_data['Email_ID']."')";

/*******************
$sql_2 ="INSERT INTO `Customer_Payment_History` (`Costumer_ID`, `SaleDate`, `Email_ID`, `Mobile_No`, `PackageName`, `Activation_Date`, `Exp_Date`, `Remark`, `Paid_Amout`, `PaymentMode`, `Agent`, `DateTime`, Full_Name, Pan_Number, KYC, Company_Amount, Tax_Amount, Date_of_Birth, Risk_Score, Risk_Level, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount, Agent_2, Agent_2_Percentange, Agent_2_Shared_Amount, Agent_3, Agent_3_Percentange, Agent_3_Shared_Amount) 
VALUES 
('".$Costumer_ID."', '".$altSaleDate."',  '".$Email_ID."', '".$Mobile_No."', '".$PackageName."', '".$altActivation_Date."', '".$altExp_Date."', '".$Remark."', '".$TotalReceivedAmount."', '".$PaymentMode."', 
'".$Agent."', '".$DateTime."', '".$Full_Name."', '".$PanNumber."', '".$KYC."',  '".$Company_Amount."', '".$TAX_Amount."', '".$Date_of_Birth."', '".$Risk_Score."', '".$Risk_Level."', '".$Agent_1."', 
'".$Agent_1_Percentange."', '".$Agent_1_Shared_Amount."', '".$Agent_2."', '".$Agent_2_Percentange."', '".$Agent_2_Shared_Amount."', '".$Agent_3."', '".$Agent_3_Percentange."', '".$Agent_3_Shared_Amount."');";
echo($sql_2.'<br/><br/>');

mysqli_query($connect, $sql_2); or die('Error updating database');
*/


//print_r($_POST);

/*
if($Costumer_ID){
    $sel = "select * from Customer_Payment_History where Costumer_ID = '".$Costumer_ID."'";
    $qry = mysqli_query($connect,$sel);
    $Paid_Amout = 0;
    while($row = mysqli_fetch_assoc($qry)){
        $fetch[] = $row;
        $Paid_Amout +=$row['Paid_Amout'];
    }
    //print_r($fetch);
    
    $Email_ID = $fetch[0]['Email_ID'];
    $Mobile_No = $fetch[0]['Mobile_No'];
    $Full_Name = $fetch[0]['Full_Name'];
    $PackageName = $fetch[0]['PackageName'];
    //$Number_of_Days = $fetch[0]['Number_of_Days'];
    
    $sel = "select * from clients where Mobile = '".$Mobile_No."'";
    $qry = mysqli_query($connect, $sel);
    $get_dt = mysqli_fetch_array($qry);
    
     $sel = "select Payment_Receipt_MailTemplate from Options where Id = 1";
        $qry = mysqli_query($connect, $sel);
        $fetch_data = mysqli_fetch_assoc($qry);
       // print_r($fetch_data);
        $Payment_Receipt_MailTemplate = $fetch_data['Payment_Receipt_MailTemplate'];
        $var = array(
                '{{PRICING_DETAILS}}'=>$Paid_Amout,
                '{{PACKAGE_NAME}}'=>$PackageName,
                '{{NO_OF_DAYS}}'=>$Number_of_Days,
                '{{LOGIN_ID}}'=>$Mobile_No,
                '{{LOGIN_PASSWORD}}'=>$Mobile_No
            );
            
            foreach($var as $key => $val){
                $Payment_Receipt_MailTemplate = str_replace($key,$val,$Payment_Receipt_MailTemplate);
            }
          sendEmail($Email_ID,$Payment_Receipt_MailTemplate);  
            
    if(!$get_dt){
       
            //echo $Payment_Receipt_MailTemplate;
            
        $sql = "INSERT INTO clients (User,Password,Email,Mobile) values('".$Full_Name."','".$Mobile_No."','".$Email_ID."','".$Mobile_No."')";
        mysqli_query($connect, $sql);
        
    }


    $upd = "update Customer_Payment_History set Approval_Status = 'Approved' where Costumer_ID = '".$_POST['CustomerId']."'";
    mysqli_query($connect, $upd);
}


//header("Location: customer-profile-new-this-month.php");


function sendEmail($to,$message){
        global $connect;
        $sel = "select Sales_Email,Support_Email from Options where Id = 1";
        $qry = mysqli_query($connect, $sel);
        $fetch = mysqli_fetch_assoc($qry);
        //print_r($fetch);
        $Sales_Email = $fetch['Sales_Email'];
        $Support_Email = $fetch['Support_Email'];
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$Sales_Email.'>' . "\r\n";
        $headers .= 'Cc: '.$Sales_Email . "\r\n";
        $subject = "Payment Details";
        //$headers;
        if($mail = mail($to,$subject,$message,$headers)){
            return true;
        }
}



*/
?>

<?php
//echo 'here';
header("Location:Ajax_files/extend-package-email.php?id=".$last_insert_id);
//echo 'here1';
// header("Location: ../customer-profile-payment-history-new.php?cust=2");

?>




