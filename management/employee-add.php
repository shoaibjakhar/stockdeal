<?php
ob_start(); 
$msg = ""; 


    $filename = $_FILES["image"]["name"];

    $tempname = $_FILES["image"]["tmp_name"];  

    $folder = "employee-uploads-profile/".time().$filename;   

    if (move_uploaded_file($tempname, $folder)) 
    {

        $Agent_Photo = "employee-uploads-profile/".time().$filename; 

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
$Email = $_POST['Email'];
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
$Team_Leader = $_POST['Team_Leader'];
$salery = $_POST['salery'];
$Role   = $_POST['Role'];

$Account_NO = $_POST['Account_NO'];
$IFSC_Code   = $_POST['IFSC_Code'];

// echo('<strong>Date_of_Join</strong> '.$Date_of_Join.'<br>');
// echo('<strong>Full_Name</strong> '.$Full_Name.'<br>');
// echo('<strong>Password</strong> '.$Password.'<br>');
// echo('<strong>Mobile</strong> '.$Mobile.'<br>');
// echo('<strong>Emergency_Contact_Number</strong> '.$Emergency_Contact_Number.'<br>');
// echo('<strong>Date_of_Birth</strong> '.$Date_of_Birth.'<br>');
// echo('<strong>Email</strong> '.$Email.'<br>');
// echo('<strong>Gender</strong> '.$Gender.'<br>');
// echo('<strong>Address</strong> '.$Address.'<br>');
// echo('<strong>Permanent_Address</strong> '.$Permanent_Address.'<br>');
// echo('<strong>Bank_Details</strong> '.$Bank_Details.'<br>');
// echo('<strong>Marital_Status</strong> '.$Marital_Status.'<br>');
// echo('<strong>PAN_Number</strong> '.$PAN_Number.'<br>');
// echo('<strong>PAN_Photo_Copy</strong> '.$PAN_Photo_Copy.'<br>');
// echo('<strong>Adhar_Number</strong> '.$Adhar_Number.'<br>');
// echo('<strong>Adhar_Photo_Copy</strong> '.$Adhar_Photo_Copy.'<br>');
// echo('<strong>Blood_Group</strong> '.$Blood_Group.'<br>');
// echo('<strong>Agent_Photo</strong> '.$Agent_Photo.'<br>');
// echo('<strong>Joining_Sources</strong> '.$Joining_Sources.'<br>');
// echo('<strong>Referred_by</strong> '.$Referred_by.'<br>');
// echo('<strong>Last_Working_Date</strong> '.$Last_Working_Date.'<br>');
// echo('<strong>Team_Leader</strong> '.$Team_Leader.'<br>');
// echo('<strong>Salery</strong> '.$salery.'<br>');

// echo('<strong>Team_Leader</strong> '.$Account_NO.'<br>');
// echo('<strong>Salery</strong> '.$IFSC_Code.'<br>');
// die();
?>


<?php include('connection/dbconnection_crm.php')?>



<?php


	$sql ="INSERT INTO `employee` (`Id`, `Mobile`, `username`, `Email`, `Date_of_Join`,`Role`, `Emergency_Number`, `Date_of_Birth`, `Address`, `Gender`, `Marital_Status`, `Permanent_Address`, `Bank_Details`, `PAN_Number`, `PAN_Copy`, `Adhar_Number`, `Adhar_Copy`, `Blood_Group`, `Photo`, `Joining_Sources`, `Referred_by`, `Date_of_Leave`, `Team_Leader`, `salery` , `Account_NO`, `IFSC_Code`) VALUES 
	
	(NULL, '".$Mobile."', '".$Full_Name."', '".$Email."', '".$Date_of_Join."', '".$Role."', '".$Emergency_Contact_Number."', '".$Date_of_Birth."', '".$Address."', '".$Gender."', '".$Marital_Status."', '".$Permanent_Address."', '".$Bank_Details."', '".$PAN_Number."', '".$PAN_Photo_Copy."', '".$Adhar_Number."', '".$Adhar_Photo_Copy."', '".$Blood_Group."', '".$Agent_Photo."', '".$Joining_Sources."', '".$Referred_by."', '".$Last_Working_Date."', '".$Team_Leader."', '".$salery."', '".$Account_NO."', '".$IFSC_Code."');";
//echo $sql;
 mysqli_query($connect, $sql) or die('Error updating database');


//header('location:employee-login-details.php');

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
<script>
   // window.location.href="employee-login-details.php";
</script>

