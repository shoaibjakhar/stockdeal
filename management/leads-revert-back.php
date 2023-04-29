<?php
include('connection/dbconnection_crm.php');
session_start();
if(isset($_GET['Team_Leader']) && $_GET['Team_Leader'] != ''){
	$sels = "select * from Assigned_Leads where UserName = '".$_GET['Team_Leader']."' and Disposition = 'Fresh' ";
	$qry = mysqli_query($connect, $sels);
	while($fetch = mysqli_fetch_assoc($qry)){
		if($_SESSION['Role']=='Team Leader'){
			$upd = "UPDATE Assigned_Leads SET UserName = '".$_SESSION['username']."' WHERE Id = '".$fetch['Id']."'";

			mysqli_query($connect, $upd);
		}
		else if($_SESSION['Role']=='SR_TL'){
			$upd = "UPDATE Assigned_Leads SET UserName = '".$_SESSION['username']."' WHERE Id = '".$fetch['Id']."'";

			mysqli_query($connect, $upd);
		}
		else{
			$upd = "UPDATE Assigned_Leads SET UserName = 'Suraj Dubey', Status = 'Open' WHERE Id = '".$fetch['Id']."'";
			mysqli_query($connect, $upd);
		}

	}
}
header('location:'.$_SERVER['HTTP_REFERER']);
?>