<?php
include('../connection/dbconnection_crm.php');
$id = 1;
$Duplicate_Leads = $_POST['Duplicate_Leads'];
$qry = "update Options set Duplicate_Leads = '".$Duplicate_Leads."' where Id = '".$id."' ";
mysqli_query($connect,$qry);
$json['status'] = 'success';
print json_encode($json);
?>