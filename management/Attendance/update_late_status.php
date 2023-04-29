<?php
date_default_timezone_set('Asia/Kolkata');
include("../connection/dbconnection_crm.php");

$method = $_POST['method'];
$id = $_POST['id'];
if($method == 'remove_inform'){
    $sql = "UPDATE attendence SET Informed_Late = NULL where id = '".$id."'  ";
}

else if($method == 'set_ontime'){
    $sel = 'select * from attendence where id = "'.$id.'"';
    $qry = mysqli_query($connect, $sel);
    $fetch = mysqli_fetch_assoc($qry);
    $login_time = $fetch['login_time'];
    $ex = explode(' ',$login_time);
    // $new_time = $ex['0']." 08:59 AM";
    $new_time = $ex['0']." 09:00:00 AM";

    
  
    $upd = 'update attendence set login_time = "'.$new_time.'", OnTimeRevert = "'.$login_time.'" , on_time_status="ontime" , tl_convert_late_to_ontime="yes" where id = "'.$id.'"';
    mysqli_query($connect, $upd);
}
else if($method == 'remove_ontime'){
    $sel = 'select * from attendence where id = "'.$id.'"';
    $qry = mysqli_query($connect, $sel);
    $fetch = mysqli_fetch_assoc($qry);
    $login_time = $fetch['OnTimeRevert'];
   
    $upd = 'update attendence set login_time = "'.$login_time.'" , tl_convert_late_to_ontime="no" , on_time_status="late" , OnTimeRevert = NULL where id = "'.$id.'"';
    mysqli_query($connect, $upd);
}

else{
   $sql = "UPDATE attendence SET Informed_Late = '".$method."' where id = '".$id."'  ";  
}


mysqli_query($connect, $sql);
echo 'success';

?>