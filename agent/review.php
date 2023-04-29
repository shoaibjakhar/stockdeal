<?php
include('connection/dbconnection_crm.php');
$t = $_GET['t'];
if(empty($t)){
    die('Opps some system errors! Please contact system administration');
}
else{
    $time = time();
    $valid_time = strtotime('+1 day',$t);
    if($valid_time<$time){
        //include('');
        die('Opps some system errors! Please contact system administration');
    }
    else{
        $sel = "SELECT * FROM `Options` where Id = 13";
        $qry = mysqli_query($connect,$sel);
        $fetch = mysqli_fetch_assoc($qry);
        if($fetch){
            $link = $fetch['Sender_ID'];
            echo '<script>window.location.href="'.$link.'"</script>';
        }
        else{
            die('Invalid Link');
        }
    }
}


?>