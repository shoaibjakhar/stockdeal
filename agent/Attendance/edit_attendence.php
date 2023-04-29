<?php
date_default_timezone_set('Asia/Kolkata');
include("../connection/dbconnection_crm.php");
error_reporting(0);
if($_POST){
   $id = $_POST['id'];
   $user_id = $_POST['user_id'];
   $mark = $_POST['mark'];
   $methods = $_POST['methods'];
   $date = $_POST['date'];
   $user_query = "SELECT * FROM employee WHERE Id = '".$user_id."'";
   $get_qry = mysqli_query($connect, $user_query);
   $row = mysqli_fetch_assoc($get_qry);
   
   
    $attd_query = "SELECT * FROM attendence WHERE id = '".$id."' and date = '".$date."'";
   $attd_qry = mysqli_query($connect, $attd_query);
   $attd = mysqli_fetch_assoc($attd_qry);
   $get_day_hours = "SELECT Halfday_Hour,Fullday_Hours FROM Options WHERE Id = '1'";
$qry_hours = mysqli_query($connect, $get_day_hours);
$get_hours_data = mysqli_fetch_assoc($qry_hours);
$Fullday_Hours = $get_hours_data['Fullday_Hours'];
$Halfday_Hour = $get_hours_data['Halfday_Hour'];
   
  // echo $row['Agent_Name'];
   if($id == ''){
       if($mark == 'half_day'){
           $extra_time = $Halfday_Hour*60;
       }
       else if($mark == 'present'){
           $extra_time = $Fullday_Hours*60;
       }
       else if($mark == 'absent'){
           $extra_time = 0;
       }
       
       $ins = "INSERT INTO attendence (user_id,Agent_Name,manually_added_time,date) VALUES('".$user_id."','".$row['username']."','".$extra_time."','".$date."') ";
      
   }
   else if($mark == 'rejected'){
         $up_query = "UPDATE attendence SET reg_status = 'rejected' WHERE id = '".$id."'";
           mysqli_query($connect, $up_query);
      }
      
   else{
    if($mark == 'half_day'){
           $extra_time = $Halfday_Hour*60;
       }
       else if($mark == 'present'){
           $extra_time = $Fullday_Hours*60;
       }
       
       //echo $attd['total_time'];
       $final_extra_time = $extra_time - $attd['total_time'];
       if($final_extra_time <0){
           $final_extra_time = 0;
       }
       if($mark == 'absent'){
           $final_extra_time = 0;
           
       }
       // $reg_status = $attd['reg_status'];
       
      // if($reg_staus == 'pending'){
           $reg_status = 'approved';
          // $message = '';
     //  }
       
      // echo $reg_status;
      
      $ins = "UPDATE attendence SET reg_status = '".$reg_status."', manually_added_time = '".$final_extra_time."' where id = '".$id."' and date = '".$date."' ";
      
      
   }
   
  // echo $ins;
  
 // print_r($_POST);
   
    mysqli_query($connect, $ins);
       $json_data['status'] = 'success';
       
       echo json_encode($json_data);
   
}






?>