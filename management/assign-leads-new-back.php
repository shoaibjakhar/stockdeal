<?php include('connection/dbconnection_crm.php')?>
<?php
$DateTime = date('Y-m-d H:i:s'); 
$size = count($_POST['UserName']);
 //print_r($_POST);
$i = 0;
while ($i < $size) {
	$UserName = $_POST['AgentNames'];
	$Id = $_POST['Id'][$i];
 
	echo($UserName.'<br/>'.$Id);
	
	$query = "UPDATE Assigned_Leads SET `Leads_Assigned_Date` = '".$DateTime."', UserName = '$UserName', Status = 'Assigned', TimeStamp = now(), DateTime = now() WHERE Id = '$Id' LIMIT 1";
	mysqli_query($connect, $query) or die ("Error in query: $query");
	echo "$UserName<br /><br /><em>Updated!</em><br /><br />";
	++$i;

}
header('Location: assign-leads-new-front.php');
?>







