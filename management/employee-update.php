<?php
date_default_timezone_set('Asia/Kolkata');

$Date_of_Join = $_POST['Date_of_Join'];
$Id = $_POST['Id'];
$Password = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ",$_POST['Password'])));
$Mobile = $_POST['Mobile'];
$Emergency_Contact_Number = $_POST['Emergency_Contact_Number'];
$Date_of_Birth = $_POST['Date_of_Birth'];
$Email = $_POST['Email'];
$Gender = $_POST['Gender'];
// $Address = addslashes(trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ",$_POST['Address']))));
$Address = json_encode($_POST['Address']);
$Permanent_Address = addslashes(trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ",$_POST['Permanent_Address']))));
$Bank_Details = addslashes(trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ",$_POST['Bank_Details']))));
$Marital_Status = $_POST['Marital_Status'];
$PAN_Number = $_POST['PAN_Number'];
$PAN_Photo_Copy = $_POST['PAN_Photo_Copy'];
$Adhar_Number = $_POST['Adhar_Number'];
$Adhar_Photo_Copy = $_POST['Adhar_Photo_Copy'];
$Blood_Group = $_POST['Blood_Group'];
$Joining_Sources = $_POST['Joining_Sources'];
$Referred_by = $_POST['Referred_by'];
$Agent_Photo = $_POST['Agent_Photo'];
$Last_Working_Date = $_POST['Last_Working_Date'];
$employeeAgreement = $_POST['employeeAgreement'];
$Roles             = $_POST['Role'];
$Team_Leader = $_POST['Team_Leader'];

$salery= $_POST['salery'];

$Account_NO = $_POST['Account_NO'];
$IFSC_Code   = $_POST['IFSC_Code'];

// if($_POST['Role'] == 'Customer Care'){
//     $Roles = 'Customer Care';
// }
// else{
//     $Roles = 'Agent';
// }

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
// echo('<strong>Last_Working_Date</strong> '.$Last_Working_Date.'<br>');
// echo('<strong>employeeAgreement</strong> '.$employeeAgreement.'<br>');

?>


<?php include('connection/dbconnection_crm.php')?>



<?php
/*
	$sql ="INSERT INTO `employee` (`Id`, `Mobile`, `username`, `Email`, `Date_of_Join`, `Emergency_Number`, `Date_of_Birth`, `Address`, `Gender`, `Marital_Status`, `Permanent_Address`, `PAN_Number`, `PAN_Copy`, `Adhar_Number`, `Adhar_Copy`, `Blood_Group`, `Photo`, `Date_of_Leave`) VALUES 
	
	(NULL, '".$Mobile."', '".$Full_Name."', '".$Email."', '".$Date_of_Join."', '".$Emergency_Contact_Number."', '".$Date_of_Birth."', '".$Address."', '".$Gender."', '".$Marital_Status."', '".$Permanent_Address."', '".$PAN_Number."', '".$PAN_Photo_Copy."', '".$Adhar_Number."', '".$Adhar_Photo_Copy."', '".$Blood_Group."', '".$Agent_Photo."', '".$Last_Working_Date."');";

*/

$sql = "UPDATE employee SET `Account_NO`='".$Account_NO."',`IFSC_Code`='".$IFSC_Code."',`salery`='".$salery."', `Team_Leader`='".$Team_Leader."', `Date_of_Join`='".$Date_of_Join."', `Password`='".$Password."', `Mobile`='".$Mobile."', `Emergency_Number`='".$Emergency_Contact_Number."', `Date_of_Birth`='".$Date_of_Birth."', `Email`='".$Email."', `Gender`='".$Gender."', `Marital_Status`='".$Marital_Status."', `Address`='".$Address."', `Permanent_Address`='".$Permanent_Address."', `Bank_Details`='".$Bank_Details."', `PAN_Number`='".$PAN_Number."', `PAN_Copy`='".$PAN_Photo_Copy."', `Adhar_Number`='".$Adhar_Number."', `Adhar_Copy`='".$Adhar_Photo_Copy."', `Blood_Group`='".$Blood_Group."', `Joining_Sources`='".$Joining_Sources."', `Referred_by`='".$Referred_by."', `Date_of_Leave`='".$Last_Working_Date."', `employeeAgreement`='".$employeeAgreement."', `Role` = '".$Roles."'  where `Id`='".$Id."'";
mysqli_query($connect, $sql) or die('Error updating database');


//header('location:employee-login-details.php');
?>
<script>window.location.href="employee-login-details.php"</script>
