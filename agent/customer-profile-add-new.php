<?php include('connection/dbconnection_crm.php');

$sql = "SELECT MAX(Costumer_ID) as MaximumID FROM Customer_profile";

$result = mysqli_query($connect, $sql);
$Costumer_ID =1 + mysqli_result($result, 0);
$altSaleDate = $_POST['altSaleDate'];
$Full_Name = ucwords(strtolower($_POST['Full_Name']));
$PanNumber = $_POST['PanNumber'];
$Email_ID = str_replace(" ","",$_POST['Email_ID']);
$Mobile_No = str_replace(" ","",$_POST['Mobile_No']);
$KYC = $_POST['KYC'];
$PackageName = $_POST['PackageName'];
$altActivation_Date = $_POST['altActivation_Date'];
$altExp_Date = $_POST['altExp_Date']; 
$Remark = $_POST['Remark'];
$Gateway_Amount = $_POST['Gateway_Amount'];
$Company_Amount = $_POST['Company_Amount'];
$TotalReceivedAmount = $_POST['TotalReceivedAmount'];
$TAX_Amount = $_POST['TAX_Amount'];
$PaymentMode = $_POST['PaymentMode'];
$Agent = $_POST['Agent'];
$Date_of_Birth = $_POST['altDate_of_Birth']?$_POST['altDate_of_Birth']:date('Y-m-d');
$DateTime = $_POST['DateTime'];
$Risk_Score = $_POST['Risk_Score']?$_POST['Risk_Score']:'0';
//$Risk_Score = 101;
$Agent_1 = $_POST['Agent_1'];
$Agent_1_Percentange = $_POST['Agent_1_Percentange'];
$Agent_1_Shared_Amount = $_POST['Agent_1_Shared_Amount'];
$Agent_2 = $_POST['Agent_2'];
$Agent_2_Percentange = $_POST['Agent_2_Percentange'];
$Agent_2_Shared_Amount = $_POST['Agent_2_Shared_Amount'];
$Agent_3 = $_POST['Agent_3'];
$Agent_3_Percentange = $_POST['Agent_3_Percentange'];
$Agent_3_Shared_Amount = $_POST['Agent_3_Shared_Amount'];
$PPI_Credits = $_POST['PPI_Credits'];
$Number_of_Days = $_POST['Number_of_Days'];
 
 $PackagePrice = $_POST['PackagePrice'];
$Agent_1_TL = $_POST['Agent_1_TL'];
$Agent_2_TL = $_POST['Agent_2_TL'];
$Agent_3_TL = $_POST['Agent_3_TL'];

$Risk_Level = "High Risk";

$Created_payment_date = $_POST['Created_payment_date'];
$utr_no = $_POST['utr_no'];

// echo $Created_payment_date;
// die();
// if($Risk_Score <= '19') {
//  echo ($Risk_Level = 'Low Risk');
// }

// else if($Risk_Score >= '20' && $Risk_Score <= '48' ) {
//  echo ($Risk_Level = 'Medium Risk');
//  }
 
//  else if($Risk_Score >= '49') {
//   echo ($Risk_Level = 'High Risk');
//  }
 
 
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






<?php


$sql ="INSERT INTO `Customer_profile` (`Costumer_ID`, `SaleDate`, `Email_ID`, `Mobile_No`, `PackageName`,`PackagePrice`,`Agent_1_TL`,`Agent_2_TL`,`Agent_3_TL`, `Activation_Date`, `Exp_Date`, `Remark`, `Paid_Amout`, `PaymentMode`, `Agent`, `DateTime`, Full_Name, Pan_Number, KYC, Gateway_Amount, Company_Amount, Tax_Amount, Date_of_Birth, Risk_Score, Risk_Level, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount, Agent_2, Agent_2_Percentange, Agent_2_Shared_Amount, Agent_3, Agent_3_Percentange, Agent_3_Shared_Amount, PPI_Credits, Data,Created_payment_date,utr_no) VALUES 
('".$Costumer_ID."', '".$altSaleDate."',  '".$Email_ID."', '".$Mobile_No."', '".$PackageName."','".$PackagePrice."','".$Agent_1_TL."','".$Agent_2_TL."','".$Agent_3_TL."', '".$altActivation_Date."', '".$altExp_Date."', '".$Remark."', '".$TotalReceivedAmount."', '".$PaymentMode."', '".$Agent."', '".$DateTime."', '".$Full_Name."', '".$PanNumber."', '".$KYC."', '".$Gateway_Amount."',  '".$Company_Amount."', '".$TAX_Amount."', '".$Date_of_Birth."', '".$Risk_Score."', '".$Risk_Level."', '".$Agent_1."', '".$Agent_1_Percentange."', '".$Agent_1_Shared_Amount."', '".$Agent_2."', '".$Agent_2_Percentange."', '".$Agent_2_Shared_Amount."', '".$Agent_3."', '".$Agent_3_Percentange."', '".$Agent_3_Shared_Amount."', '".$PPI_Credits."', 'empty' , '".$Created_payment_date."', '".$utr_no."')";
// echo($sql.'<br/><br/>');

$row = mysqli_query($connect,$sql);
// echo "<pre>";
// print_r($row);
// echo "</row>";
// exit;



$sql_2 ="INSERT INTO `Customer_Payment_History` (`Costumer_ID`, `SaleDate`, `Email_ID`, `Mobile_No`, `PackageName`,`Agent_1_TL`,`Agent_2_TL`,`Agent_3_TL`, `Activation_Date`, `Exp_Date`, `Remark`, `Paid_Amout`, `PaymentMode`, `Agent`, `DateTime`, Full_Name, Pan_Number, KYC, Gateway_Amount, Company_Amount, Tax_Amount, Date_of_Birth, Risk_Score, Risk_Level, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount, Agent_2, Agent_2_Percentange, Agent_2_Shared_Amount, Agent_3, Agent_3_Percentange, Agent_3_Shared_Amount, `Number_of_Days`, Created_payment_date,utr_no) VALUES 
('".$Costumer_ID."', '".$altSaleDate."',  '".$Email_ID."', '".$Mobile_No."', '".$PackageName."','".$Agent_1_TL."','".$Agent_2_TL."','".$Agent_3_TL."', '".$altActivation_Date."', '".$altExp_Date."', '".$Remark."', '".$TotalReceivedAmount."', '".$PaymentMode."', '".$Agent."', '".$DateTime."', '".$Full_Name."', '".$PanNumber."', '".$KYC."', '".$Gateway_Amount."',  '".$Company_Amount."', '".$TAX_Amount."', '".$Date_of_Birth."', '".$Risk_Score."', '".$Risk_Level."', '".$Agent_1."', '".$Agent_1_Percentange."', '".$Agent_1_Shared_Amount."', '".$Agent_2."', '".$Agent_2_Percentange."', '".$Agent_2_Shared_Amount."', '".$Agent_3."', '".$Agent_3_Percentange."', '".$Agent_3_Shared_Amount."', '".$Number_of_Days."', '".$Created_payment_date."', '".$utr_no."')";
mysqli_query($connect,$sql_2) or die('Error updating database');


/*********************************/
// adding logs will del later
$context = json_encode(['file' => 'customer-profile-payment-history-new-add.php', 'Costumer_ID' => $Costumer_ID, 'Agent_1_TL' => $Agent_1_TL, 'Agent_2_TL' => $Agent_2_TL, 'Agent_3_TL' => $Agent_2_TL]);
$msg = 'payment_history_admin';

$query_params = [
    'Costumer_ID' => $Costumer_ID,
    'SaleDate' => $altSaleDate,
    'Email_ID' => $Email_ID,
    'Mobile_No' => $Mobile_No,
    'PackageName' => $PackageName,
    'Agent_1_TL' => $Agent_1_TL,
    'Agent_2_TL' => $Agent_2_TL,
    'Agent_3_TL' => $Agent_3_TL,
    'Activation_Date' => $altActivation_Date,
    'Exp_Date' => $altExp_Date,
    'Remark' => $Remark,
    'Paid_Amout' => $TotalReceivedAmount,
    'PaymentMode' => $PaymentMode,
    'Agent' => $Agent,
    'DateTime' => $DateTime,
    'Full_Name' => $Full_Name,
    'Pan_Number' => $PanNumber,
    'KYC' => $KYC,
    'Gateway_Amount' => $Gateway_Amount,
    'Company_Amount' => $Company_Amount,
    'Tax_Amount' => $TAX_Amount,
    'Date_of_Birth' => $Date_of_Birth,
    'Risk_Score' => $Risk_Score,
    'Risk_Level' => $Risk_Level,
    'Agent_1' => $Agent_1,
    'Agent_1_Percentange' => $Agent_1_Percentange,
    'Agent_1_Shared_Amount' => $Agent_1_Shared_Amount,
    'Agent_2' => $Agent_2,
    'Agent_2_Percentange' => $Agent_2_Percentange,
    'Agent_2_Shared_Amount' => $Agent_2_Shared_Amount,
    'Agent_3' => $Agent_3,
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




$sel = "select * from clients where Mobile = '".$Mobile_No."'";
$qry = mysqli_query($connect,$sel);
$get_dt = mysqli_fetch_array($qry);
if(!$get_dt){
    $sql = "INSERT INTO clients (User,Password,Email,Mobile) values('".$Full_Name."','".$Mobile_No."','".$Email_ID."','".$Mobile_No."')";
    mysqli_query($connect,$sql);
    sendEmail($Email_ID,$Mobile_No,$Mobile_No);
}


function sendEmail($to,$username,$password){
    $message = "<html><head><title>Users Details</title></head>
        <body>
        <p>Here is your login details!</p>
        <table border='1'>
        <tr>
        <th>Username</th>
        <th>Password</th>
        </tr>
        <tr>
        <td>".$username."</td>
        <td>".$password."</td>
        </tr>
        </table>
        </body>
        </html>
        ";
        
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <info@massolution.in>' . "\r\n";
        
        
        if($mail = mail($to,$subject,$message,$headers)){
            return true;
        }
}


// header("Location: customer-profile-new-this-month.php");

?>

<script>
    
    location.href='customer-profile-new-this-month.php';
</script>




