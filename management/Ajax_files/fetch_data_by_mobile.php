<?php include('../connection/dbconnection_crm.php')?>

<?php

if($_POST){
    $mobile = $_POST['mobile'];
    $sel = "select * from Customer_profile where Mobile_No = '".$mobile."'";
    $qry = mysqli_query($connect,$sel);
    $fetch = mysqli_fetch_assoc($qry);
    
    if($fetch){
        $fetch['status'] = 'success';
    }
    else{
        $fetch['status'] = 'failed';
    }
     print json_encode($fetch);
    
}


?>