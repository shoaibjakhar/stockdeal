 <?php

include('connection/dbconnection_crm.php');


//$Idea = $_GET['Idea'];

$Idea = $connect -> real_escape_string($_GET['Idea']);  // This Works Always.

$Id = $_GET['Id'];
$resultUpdate = $_GET['resultUpdate'];

 //echo($Id.$Idea);



$sql ="UPDATE  `Demo_Stock_Tips` SET  `Ideas` = '".$Idea."', Result = '".$resultUpdate."'  WHERE `Demo_Stock_Tips`.`Id` ='".$Id."';";

mysqli_query($connect, $sql) or die('Error updating database');

echo($sql);




//header('Location: demo-stock-tips-update.php');
//header('Location: https://www.google.com/');
?>


<script>
window.location.href='demo-stock-tips-update.php';
</script>