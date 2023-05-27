<?php
ob_start(); 
$msg = ""; 


    $filename = $_FILES["image"]["name"];

    $tempname = $_FILES["image"]["tmp_name"];  

    $folder = "vendor-uploads-profile/".time().$filename;   

    if (move_uploaded_file($tempname, $folder)) 
    {

        $Agent_Photo = "vendor-uploads-profile/".time().$filename; 

    }else{

        $Agent_Photo = ''; 

    }

?>

<?php
date_default_timezone_set('Asia/Kolkata');
// echo "<pre>"; print_r($_POST); echo "</pre>"; die;
$Date_of_Join = $_POST['Date_of_Join'];
$Full_Name = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", ucwords(strtolower($_POST['Full_Name'])))));
$Password = str_replace(" ","",$_POST['Password']);
$Mobile = str_replace(" ","",$_POST['Mobile']);
$Emergency_Contact_Number = str_replace(" ","",$_POST['Emergency_Contact_Number']);
$Date_of_Birth = $_POST['Date_of_Birth'];
$Email = isset($_POST['Email']) ? $_POST['Email'] :'';
$Gender = $_POST['Gender'];
// $Address = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", addslashes($_POST['Address']))));
$Address = json_encode($_POST['Address']);
$Permanent_Address = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", addslashes($_POST['Permanent_Address']))));
$Bank_Details = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", addslashes($_POST['Bank_Details']))));
$Marital_Status = $_POST['Marital_Status'];
$PAN_Number = $_POST['PAN_Number'];
$PAN_Photo_Copy = $_POST['PAN_Photo_Copy'];
$Adhar_Number = $_POST['Adhar_Number']?$_POST['Adhar_Number']:0;
$Adhar_Photo_Copy = $_POST['Adhar_Photo_Copy'];
$Blood_Group = $_POST['Blood_Group'];
// $Agent_Photo = $_POST['Agent_Photo'];
$Joining_Sources = $_POST['Joining_Sources'];
$Referred_by = $_POST['Referred_by'];
$Last_Working_Date = $_POST['Last_Working_Date']?$_POST['Last_Working_Date']:date('Y-m-d');
$salery = $_POST['salery'];
$Role   = $_POST['Role'];

$Account_NO = $_POST['Account_NO'];
$IFSC_Code   = $_POST['IFSC_Code'];

?>


<?php include('connection/dbconnection_crm.php')?>



<?php


	$sql ="INSERT INTO `vendors` (`Id`, `Mobile`, `username`, `Email`, `Date_of_Join`,`Role`, `Emergency_Number`, `Date_of_Birth`, `Address`, `Gender`, `Marital_Status`, `Permanent_Address`, `Bank_Details`, `PAN_Number`, `PAN_Copy`, `Adhar_Number`, `Adhar_Copy`, `Blood_Group`, `Photo`, `Joining_Sources`, `Referred_by`, `Date_of_Leave`, `Team_Leader`, `salery` , `Account_NO`, `IFSC_Code`) VALUES 
	
	(NULL, '".$Mobile."', '".$Full_Name."', '".$Email."', '".$Date_of_Join."', '".$Role."', '".$Emergency_Contact_Number."', '".$Date_of_Birth."', '".$Address."', '".$Gender."', '".$Marital_Status."', '".$Permanent_Address."', '".$Bank_Details."', '".$PAN_Number."', '".$PAN_Photo_Copy."', '".$Adhar_Number."', '".$Adhar_Photo_Copy."', '".$Blood_Group."', '".$Agent_Photo."', '".$Joining_Sources."', '".$Referred_by."', '".$Last_Working_Date."', '".$Team_Leader."', '".$salery."', '".$Account_NO."', '".$IFSC_Code."');";
//echo $sql;
 mysqli_query($connect, $sql) or die('Error updating database');


//header('location:employee-login-details.php');

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
<script>
   // window.location.href="employee-login-details.php";
</script>

