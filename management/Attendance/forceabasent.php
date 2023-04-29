<?php


include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");
if($_POST){
 
 print_r($_POST) ;  
 $sel = "select * from attendence where user_id = '".$_POST['user_id']."' and date = '".$_POST['date']."'";
 $qry = mysqli_query($connect, $sel);
 $fetch = mysqli_fetch_assoc($qry);
 if($fetch){
     $upd = "update attendence set total_time = 0, manually_added_time = 0 where user_id = '".$_POST['user_id']."' and date = '".$_POST['date']."'";
     mysqli_query($connect, $upd);
     echo 'success';
 }
 else{
     echo 'success';
 }
    
    
    
    
}