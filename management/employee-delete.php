<?php include('connection/dbconnection_crm.php')?>
<?php
$id = $_GET['id'];

     $del = "delete from employee where  id = '".$id."'";
     mysqli_query($connect, $del);
     header('location:employee-login-details.php');
?>


