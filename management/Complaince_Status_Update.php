<?php include('connection/dbconnection_crm.php')?>

<?php



if($_POST){

   // print_r($_POST);

   

   $upd = "update Customer_profile set Compliance_Status = '".$_POST['Compliance_Status']."'  where Costumer_ID = '".$_POST['Costumer_ID']."'"; 

  //echo $upd;

  

   mysqli_query($connect,$upd);

   header('location:customer-profile-new-this-month.php');

}













?>