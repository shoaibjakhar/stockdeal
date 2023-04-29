<?php
$DateTime = $_POST['DateTime'];
$Agent    = $_POST['Agent'];
$ToWhom    = $_POST['ToWhom'];
$Team_Leader_Name   = $_POST['Team_Leader_Name'];
$Request_Type  = $_POST['Request_Type']; // New
$Subject  = addslashes($_POST['Subject']);
$Customer_Name = $_POST['Customer_Name']; // New
$Message  = addslashes($_POST['Message']);
$Mobile  = $_POST['Mobile']; // New
$Paid_Amount  = $_POST['Paid_Amount']; // New
$AmountPaidDate  = $_POST['AmountPaidDate']; // New
$Package  = $_POST['Package']; // New
$Duration  = $_POST['Duration']; // New
$Risk_Profile_Score  = $_POST['Risk_Profile_Score']; // New
$KYC  = $_POST['KYC']; // New
$Mode_of_Payment  = $_POST['Mode_of_Payment']; // New
// echo('<strong>DateTime</strong>: '.$DateTime.'<br>');
// echo('<strong>Agent</strong>: '.$Agent.'<br>');
// echo('<strong>ToWhom</strong>: '.$ToWhom.'<br>');
// echo('<strong>Request_Type</strong>: '.$Request_Type.'<br>');
// echo('<strong>Customer_Name</strong>: '.$Customer_Name.'<br>');
// echo('<strong>Message</strong>: '.$Message.'<br>');
// echo('<strong>Mobile</strong>: '.$Mobile.'<br>');
// echo('<strong>Paid_Amount</strong>: '.$Paid_Amount.'<br>');
// echo('<strong>AmountPaidDate</strong>: '.$AmountPaidDate.'<br>');
// echo('<strong>Package</strong>: '.$Package.'<br>');
// echo('<strong>Duration</strong>: '.$Duration.'<br>');
// echo('<strong>Risk_Profile_Score</strong>: '.$Risk_Profile_Score.'<br>');
// echo('<strong>KYC</strong>: '.$KYC.'<br>');
// echo('<strong>Mode_of_Payment</strong>: '.$Mode_of_Payment.'<br>');
?>
<?php include('connection/dbconnection_crm.php')?>
<?php
$sql ="INSERT INTO `Agent_request` (`DateTime` ,`Agent` ,`ToWhom` ,`Request_Type`  ,`Subject` ,`Customer_Name` ,`Message` ,`Mobile`,`Paid_Amount`,`Package`,`Duration`,`Risk_Profile_Score`,`KYC`,`Mode_of_Payment`,`Team_Leader_Name`)
VALUES ('".$DateTime."',  '".$Agent."', '".$ToWhom."',  '".$Request_Type."',  '".$Subject."', '".$Customer_Name."', '".$Message."', '".$Mobile."', '".$Paid_Amount."',  '".$Package."', '".$Duration."', '".$Risk_Profile_Score."', '".$KYC."', '".$Mode_of_Payment."', '".$Team_Leader_Name."');";
//echo($sql);
mysqli_query($connect,$sql) or die('Error updating database');
//header('Location: agent-request-sent.php');
?>
<script>
    window.location.href='agent-request-sent.php';
</script>