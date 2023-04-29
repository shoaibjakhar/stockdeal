<?php
ob_start();
include('connection/dbconnection_crm.php');
$DateTime = date('Y-m-d H:i:s'); 
$size = count($_POST['Id']);
$i = 0;
while ($i < $size) {
	$UserName = $_POST['UserName'];
	$Id = $_POST['Id'][$i];
 
	echo($UserName.'<br/>'.$Id);
	
	$query = "UPDATE Assigned_Leads SET `Leads_Assigned_Date` = '".$DateTime."',  UserName = '$UserName', Status = 'Assigned', Disposition = 'Fresh', Churn_Status = '', TimeStamp = now(), DateTime = now() WHERE Id = '$Id' LIMIT 1";
	mysqli_query($connect, $query) or die ("Error in query: $query");
	echo "$UserName<br /><br /><em>Updated!</em><br /><br />";
	++$i;
}
header('Location: leads-filter_1_new.php');
?>







