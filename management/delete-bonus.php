<?php include('connection/dbconnection_crm.php')?>
<?php
 session_start();
$id = $_GET['id'];
$qry = "DELETE FROM `bonus` WHERE  id = '$id'";
mysqli_query($connect, $qry);
  $_SESSION['success'] = 'Record deleted successfully!';
        
    	header('Location:agent-bonus-details.php');


?>