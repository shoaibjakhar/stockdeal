<?php

$Id = $_GET['Id'];
$StatusRespond  = $_GET['StatusRespond'];
$Respond  = $_GET['Respond'];

  
?>


<?php include('connection/dbconnection_crm.php')?>


<?php
$sql ="UPDATE  `Agent_request` SET  `Respond` =  '".$Respond."', `Status` =  '".$StatusRespond."' , `Done` =  'Yes' WHERE  `Agent_request`.`Id` ='".$Id."';";

mysqli_query($connect,$sql) or die('Error updating database');

?>




