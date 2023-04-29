

<?php include('connection/dbconnection_crm.php')?>


<?php


$size = count($_POST['UserName']);

$i = 0;
while ($i < $size) {
	$UserName= $_POST['UserName'][$i];
	$Id = $_POST['Id'][$i];
	
	$query = "UPDATE Assigned_Leads SET UserName = '$UserName', TimeStamp = now(), DateTime = now() WHERE Id = '$Id' LIMIT 1";
	mysqli_query($connect, $query) or die ("Error in query: $query");
	echo "$UserName<br /><br /><em>Updated!</em><br /><br />";
	++$i;
}

	header('Location: leads-filter_7_new.php');
?>







