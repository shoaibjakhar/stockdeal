<?php include('connection/dbconnection_crm.php')?>

<?php



if($_POST){

   // print_r($_POST);

   

   $upd = "update Customer_Payment_History set SaleDate = '".$_POST['SaleDate']."', Paid_Amout = '".$_POST['TotalReceivedAmount']."', Company_Amount = '".$_POST['Company_Amount']."', Tax_Amount = '".$_POST['TAX_Amount']."', PaymentMode = '".$_POST['PaymentMode']."', Agent_1 = '".$_POST['Agent_1']."', Agent_2 = '".$_POST['Agent_2']."', Agent_3 = '".$_POST['Agent_3']."', Agent_1_Shared_Amount = '".$_POST['Agent_1_Shared_Amount']."',  Agent_2_Shared_Amount = '".$_POST['Agent_2_Shared_Amount']."', Agent_3_Shared_Amount = '".$_POST['Agent_3_Shared_Amount']."', Agent_2_Percentange = '".$_POST['Agent_2_Percentange']."', Agent_1_Percentange = '".$_POST['Agent_1_Percentange']."', Agent_3_Percentange='".$_POST['Agent_3_Percentange']."' , Number_of_Days='".$_POST['Number_of_Days']."', PackageName = '".$_POST['Segment']."'  where id = '".$_POST['id']."'"; 

 // echo $upd;

  

   mysqli_query($connect ,$upd);

   header('location:customer-profile-payment-history-new.php?cust='.$_POST['cust']);

}













?>