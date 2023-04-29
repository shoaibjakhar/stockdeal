 <?php

include('connection/dbconnection_crm.php');


//$Idea = $_GET['Idea'];

//$Idea = mysql_real_escape_string($_GET['Idea']);  // This Works Always.

$Id = $_GET['Id'];
$resultUpdate = $_GET['resultUpdate'];

 echo($Id.$Idea);



$sql ="UPDATE `Demo_Stock_Tips` SET  Result = '".$resultUpdate."'  WHERE `Demo_Stock_Tips`.`Id` ='".$Id."';";
mysqli_query($connect, $sql) or die('Error updating database');

//header('Location: demo-stock-tips-update-open.php');

?>


<script>
window.location.href='demo-stock-tips-update-open.php';
</script>