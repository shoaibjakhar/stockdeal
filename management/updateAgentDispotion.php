<?php

$DispositionAgent = $_GET['DispositionAgent'];
$DispositionAgentId = $_GET['DispositionAgentId'];


  include('connection/dbconnection_crm.php');
?>




<?php
$sql ="UPDATE `Assigned_Leads` SET  `UserName` =  '".$DispositionAgent."' WHERE  `Assigned_Leads`.`Id` =$DispositionAgentId;";
mysqli_query($connect ,$sql) or die('Error updating database');
?>




