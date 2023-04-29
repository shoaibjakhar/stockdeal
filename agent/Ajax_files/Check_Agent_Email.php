<?php
$result = array();
include('../connection/dbconnection_crm.php');
if($_POST){
    if($_POST['type'] == 'TL'){
        $sel = "SELECT * FROM `admin` WHERE username = '".$_POST['Agent_Name']."'";
    }
    else{
        $sel = "SELECT * FROM `Customer_profile` WHERE Email_ID = '".$_POST['Email_ID']."'";
    }
    $qry = mysqli_query($connect,$sel);
    $fetch = mysqli_fetch_assoc($qry);
    if($fetch){
        $result = array(
                'status'=>'error',
                'message'=>'Agent Name Result Already Exists'
            );
    }
    else{
        $result = array(
                'status'=>'success',
                'message'=>'Agent Name Is Ready To Use'
            );
    }
}
else{
    $result = array(
                'status'=>'error',
                'message'=>'Method Not Allowed'
            );
}
print json_encode($result);