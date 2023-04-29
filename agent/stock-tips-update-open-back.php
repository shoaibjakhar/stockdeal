 <?php

include('connection/dbconnection_crm.php');


//$Idea = $_GET['Idea'];

//$Idea = mysql_real_escape_string($_GET['Idea']);  // This Works Always.

$Id = $_GET['Id'];
$resultUpdate = $_GET['resultUpdate'];

 echo($Id.$Idea);



$sql ="UPDATE  `stock_tips` SET  Result = '".$resultUpdate."'  WHERE `stock_tips`.`Id` ='".$Id."';";
mysqli_query($connect, $sql) or die('Error updating database');

header('Location: stock-tips-update-open.php');

?>
