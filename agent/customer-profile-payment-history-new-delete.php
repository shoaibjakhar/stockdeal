<?php include('connection/dbconnection_crm.php')?>
<?php


$cust = $_GET['cust'];

$hist_id = $_GET['id'];

$del = "delete from Customer_Payment_History where id = '".$hist_id."'";
$del_query = mysqli_query($connect, $del);

$sel = "select Exp_Date from Customer_Payment_History where Costumer_ID = '".$cust."' order by id desc limit 1";
$qry = mysqli_query($connect, $sel);
$fetch = mysqli_fetch_assoc($qry);
if($fetch){
    $upd = "update Customer_profile set Exp_Date = '".$fetch['Exp_Date']."' where Costumer_ID = '".$cust."'";
    mysqli_query($connect, $upd);
    header('location:customer-profile-payment-history-new.php?cust='.$cust);
}
else{

     $del = "delete from Customer_profile where  Costumer_ID = '".$cust."'";
     mysqli_query($connect, $del);
      header('location:customer-profile-new-this-month.php');
}


