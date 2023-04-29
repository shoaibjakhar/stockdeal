<?php include('connection/dbconnection_crm.php')?>

<?php

$Compliance_Remarks = addslashes($_POST['Compliance_Remarks']);

if($_POST){

   // print_r($_POST);

   

   $upd = "update Compliance_History set SaleDate = '".$_POST['SaleDate']."', Compliance_Remarks = '".$Compliance_Remarks."' where id = '".$_POST['id']."'"; 

 // echo $upd;

  

   mysqli_query($connect,$upd);

   header('location:Compliance_History.php?cust='.$_POST['cust']);

}













?>