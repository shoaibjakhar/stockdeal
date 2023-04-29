<?php
ob_start();
session_start();
$DateTime = date('Y-m-d H:i:s'); 
include_once('connection/dbConfig.php');
if(isset($_POST['bulk_delete_submit'])){
    $idArr = $_POST['checked_id'];
	$AgentNames = $_POST['AgentNames'];
	//print_r($idArr);die;
	
    foreach($idArr as $id){
        mysqli_query($conn, "UPDATE  `Assigned_Leads`  SET `Leads_Assigned_Date` = '".$DateTime."',  `Status` =". "'Assigned', `UserName` =  '".$AgentNames."'  WHERE  `Assigned_Leads`.`id` = '".$id."'") or die('Error');
    }
    $_SESSION['success_msg'] = 'Updated successfully.';
    header('Location: assign-multiple-leads.php');
}
?>
