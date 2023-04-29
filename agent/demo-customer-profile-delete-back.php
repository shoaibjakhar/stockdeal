 <?php

include('connection/dbconnection_crm.php');


//$Idea = $_GET['Idea'];

//$Idea = mysql_real_escape_string($_GET['Idea']);  // This Works Always.

$Costumer_ID = $_GET['Costumer_ID'];

echo($Costumer_ID);

$sql ="DELETE FROM `Demo_Customer_profile` WHERE `Demo_Customer_profile`.`Costumer_ID` ='".$Costumer_ID."'";

mysqli_query($connect,$sql) or die('Error updating database');

header('Location: demo-customer-profile.php');



?>
