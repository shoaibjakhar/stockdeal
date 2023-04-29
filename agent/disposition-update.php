<?php  include('partial/session_start.php'); ?>

<?php

$Id_modal = $_GET['Id_modal'];
$FollowUpId = $_GET['FollowUpId'];
$DateTimeModel = $_GET['DateTimeModel'];
$Disposition_Modal = $_GET['Disposition_Modal'];
$ModalFowllowUpDateTime = $_GET['ModalFowllowUpDateTime'];

$FowllowUpDateTime = $_GET['FowllowUpDateTime'];
$Hour = $_GET['Hour'];
$Minuts = $_GET['Minuts'];
$Second = $_GET['Second'];
$ModalFowllowUpDateTime = $_GET['ModalFowllowUpDateTime'];
$FowllowUpDateTimeFinal = $FowllowUpDateTime.' '.$Hour.':'.$Minuts.':'.$Second;


if ($FowllowUpDateTimeFinal == ' ::01') {
    echo('<h1>Yes</h1>');
    
    $FowllowUpDateTimeFinal = '2021-01-01 01:01:01';
}
else {
   $FowllowUpDateTimeFinal = $FowllowUpDateTime.' '.$Hour.':'.$Minuts.':'.$Second;
    // echo('<h1>No</h1>');
}



$Disposition_Modal = $_GET['Disposition_Modal'];
$Modal_Full_Name = $_GET['Modal_Full_Name'];
$Modal_Email = $_GET['Modal_Email'];
$Modal_Mobile = $_GET['Modal_Mobile'];
$Modal_remark = addcslashes($_GET['Modal_remark'],"'");
$Priority = $_GET['Priority'];
$Modal_State = $_GET['Modal_State'];
$Modal_UserName = $_GET['Modal_UserName'];
//$Modal_State = $_GET['Modal_State'];
$Modal_Segment = $_GET['Modal_Segment'];
$Disposition_Class = $_GET['Disposition_Class'];



// echo("Id_modal".' '.$Id_modal.'<br/>');
// echo("FollowUpId".' '.$FollowUpId.'<br/>');
// echo("DateTimeModel".' '.$DateTimeModel.'<br/>');
// echo("Disposition_Modal".' '.$Disposition_Modal.'<br/>');
// echo("FowllowUpDateTime".' '.$FowllowUpDateTime.'<br/>');
// echo("FowllowUpDateTimeFinal".' '.$FowllowUpDateTimeFinal.'<br/>');
// echo("Modal_Full_Name".' '.$Modal_Full_Name.'<br/>');  
// echo("Modal_Email".' '.$Modal_Email.'<br/>');
// echo("Modal_Mobile".' '.$Modal_Mobile.'<br/>');
// echo("Disposition_Modal".' '.$Disposition_Modal.'<br/>');
// echo("Modal_remark".' '.$Modal_remark.'<br/>');
// echo("Priority".' '.$Priority.'<br/>');
// echo("Modal_UserName".' '.$Modal_UserName.'<br/>');
// echo("Modal_State".' '.$Modal_State.'<br/>');
// echo("Modal_Segment".' '.$Modal_Segment.'<br/>');


?>

 <?php include('connection/dbconnection_crm.php') ?>

<?php
 
$sql ="UPDATE  `Assigned_Leads` SET  `Disposition` =  '".$Disposition_Modal."', `Class` =  '".$Disposition_Class."',
`DateTime` =  '".$DateTimeModel."', `ModalFowllowUpDateTime` =  '".$FowllowUpDateTimeFinal."', `Message` =  '".$Modal_remark."' WHERE  `Assigned_Leads`.`Id` ='".$Id_modal."'";
// echo($sql);
mysqli_query($connect,$sql) or die('Error updating database 1');

$sql ="INSERT INTO `FolllowUpLeads` (`Source`, `Status`, `DateTime`, `Full_Name`, `Email`, `Mobile`, `Disposition`, `Segment`, `Remark`, `UserName`, `FowllowUpDateTime`, `State`, `Priority`) VALUES ('FB', 'Empty','".$DateTimeModel."', '".$Modal_Full_Name."', '".$Modal_Email."', '".$Modal_Mobile."', '".$Disposition_Modal."', '".$Modal_Segment."', '".$Modal_remark."', '".$Modal_UserName."', '".$FowllowUpDateTimeFinal."', '".$Modal_State."', '".$Priority."');";
// echo($sql);
mysqli_query($connect,$sql) or die('Error updating database 2');



$sql ="UPDATE  `FolllowUpLeads` SET  `Status` =  'Done' WHERE  `FolllowUpLeads`.`Id` ='".$FollowUpId."'";
mysqli_query($connect,$sql) or die('Error updating database 3');


?>

<script type="text/javascript"  src="js/jquery.min.js"></script> 


<?php
$sel = "select Sender_ID from Options where Id = '1' ";
$qry = mysqli_query($connect,$sel);
$Sender_IDs = mysqli_fetch_assoc($qry);
if($Sender_IDs){
    $Sender_ID = $Sender_IDs['Sender_ID'];
}
else{
    $Sender_ID = '';
}

$sel = "select Compliance_Email from Options where Id = '1' ";
$qry = mysqli_query($connect,$sel);
$Compliance_Emails = mysqli_fetch_assoc($qry);
if($Compliance_Emails){
    $Compliance_Email = $Compliance_Emails['Compliance_Email'];
}
else{
    $Compliance_Email = '';
}

$sel = "select Support_Email from Options where Id = '1' ";
$qry = mysqli_query($connect,$sel);
$Support_Emails = mysqli_fetch_assoc($qry);
if($Support_Emails){
    $Support_Email = $Support_Emails['Support_Email'];
}
else{
    $Support_Email = '';
}

$sel = "select Company_Website from Options where Id = '1' ";
$qry = mysqli_query($connect,$sel);
$Company_Websites = mysqli_fetch_assoc($qry);
if($Company_Websites){
    $Company_Website = $Company_Websites['Company_Website'];
}
else{
    $Company_Website = '';
}


$sel = "select Company_Abbreviation from Options where Id = '1' ";
$qry = mysqli_query($connect,$sel);
$Company_Abbreviations = mysqli_fetch_assoc($qry);
if($Company_Abbreviations){
    $Company_Abbreviation = $Company_Abbreviations['Company_Abbreviation'];
}
else{
    $Company_Abbreviation = '';
}



//echo ('<h1>'. $Mobile . $username. '</h1>')	

?>



<script>
/*
const $domain_name = "<?php //echo $domain_name; ?>";
var Type = "<?php //echo $Disposition_Modal ?>"


if (Type == 'CBWP' || Type == 'CBWOP' || Type == 'PTPO' || Type == 'PTPC' || Type == 'FT' || Type == 'PC') {

 
	    window.open('http://api.msg91.com/api/sendhttp.php?sender='+"<?php echo $Sender_ID; ?>"+'&route=4&mobiles='+"<?php echo $Modal_Mobile; ?>"+'&authkey=194772AKvTih0W91K5a6720c8&country=91&message= Dear Subscriber,\n You Just spoke to our Representative, Request You to share your valuable feedback at '+"<?php echo $Compliance_Email; ?>"+' , You can reach  ('+"<?php echo $username; ?>"+' - '+"<?php echo $Mobile; ?>"+') for sales and services queries. \n Regards,\n Quality Assurance Team.\n '+"<?php echo $Company_Website; ?>"+'','_blank','self.close()');
	    window.location.href='memberpage.php'
}
	
else if (Type == 'FTN' || Type == 'R' || Type == 'B' || Type == 'NR' || Type == 'SW' || Type == 'NCD') {
 
        window.open('http://api.msg91.com/api/sendhttp.php?sender='+"<?php echo $Sender_ID; ?>"+'&route=4&mobiles='+"<?php echo $Modal_Mobile; ?>"+'&authkey=194772AKvTih0W91K5a6720c8&country=91&message= Dear Subscriber,\n You Just missed a call from us, Here is our callback details ('+"<?php echo $username; ?>"+' - '+"<?php echo $Mobile; ?>"+') or email at '+"<?php echo $Support_Email; ?>"+'\n Regards,\n '+"<?php echo $Company_Abbreviation; ?>"+' TEAM\n '+"<?php echo $Company_Website; ?>"+'','_blank','self.close()');
	    window.location.href='memberpage.php'
}	
	
else {
	window.location.href='memberpage.php'
}
*/

	</script>
	
	<script>
	
	window.location.href='memberpage.php';
	
	</script>

