<?php
include('connection/dbconnection_crm.php');
$upd = "UPDATE Customer_Payment_History SET SaleDate = '".$_POST['altSaleDate']."', PaymentMode = '".$_POST['PaymentMode']."',Agent_1_TL = '".$_POST['Agent_1_TL']."',Agent_1 = '".$_POST['Agent_1']."',Agent_1_Percentange = '".$_POST['Agent_1_Percentange']."',Agent_1_Shared_Amount = '".$_POST['Agent_1_Shared_Amount']."',Agent_2_TL = '".$_POST['Agent_2_TL']."',Agent_2 = '".$_POST['Agent_2']."',Agent_2_Percentange = '".$_POST['Agent_2_Percentange']."',Agent_2_Shared_Amount = '".$_POST['Agent_2_Shared_Amount']."',Agent_3_TL = '".$_POST['Agent_3_TL']."',Agent_3 = '".$_POST['Agent_3']."',Agent_3_Percentange = '".$_POST['Agent_3_Percentange']."',Agent_3_Shared_Amount = '".$_POST['Agent_3_Shared_Amount']."',Gateway_Amount = '".$_POST['Gateway_Amount']."',Company_Amount = '".$_POST['Company_Amount']."',Tax_Amount = '".$_POST['Tax_Amount']."' WHERE Id = '".$_POST['Id']."'";

mysqli_query($connect, $upd);
header('location:customer-profile-payment-history-new.php?cust='.$_POST['cust']);