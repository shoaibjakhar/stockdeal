<?php include('connection/dbconnection_crm.php')?>
<?php
$id = $_GET['id'];

     $del = "delete from agreement where  id = '".$id."'";
     mysqli_query($connect, $del);
     header('location:agreement_list.php');
?>


