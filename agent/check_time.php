<?php  include('partial/session_start.php'); ?>

<?php

date_default_timezone_set('Asia/Kolkata');

//echo "Hello";

/*

*Firstit will check user is in active state since last 5 minutes, if active then it will add 5 minutes every 5 minutes.

*

*/





if($_POST){

  //session_start();

 include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");




   $user_id = $User_Id;

    $get_atd = "SELECT * FROM attendence where user_id = '".$user_id."' and date = '".date('d-m-Y')."'";

  $get_atd_qry = mysqli_query($connect,$get_atd);

  $row  = mysqli_fetch_array($get_atd_qry);





//print_r($row);

   $c_time = date('m/d/Y h:i:s A',time());

    $last_up_time = $_SESSION['spent_time'];

    $cstr_time =  strtotime($c_time);

  // echo "<br>";

  $max_time = strtotime($last_up_time . ' + 5 minute');

   //echo $max_time = strtotime($last_up_time . ' + 20 second');
//echo date('d m Y H:i:s A',$last_up_time);
//echo $last_up_time;



  if($cstr_time >= $max_time){

   

	$upd_query = "UPDATE attendence SET total_time = '".($row['total_time'] + 5)."' where id = '".$row['id']."' and date = '".date('d-m-Y')."'";

   mysqli_query($connect,$upd_query);

    $_SESSION['spent_time'] = $c_time;

    echo "Completed";



  }

  else{

    echo "Still Not Completed";

  }

}





 ?>

