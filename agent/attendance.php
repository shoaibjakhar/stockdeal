<?php  include('partial/session_start.php'); ?>
<?php

//session_start();

 //$username = $username;

 //echo $username;


//include('partial/validate-user.php');

?>

<?php

 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Attendence</title>
<?php require('partial/plugins.php'); ?>
<style>

.dataTables_filter { display:none;}
</style>
</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>


<div class="containter" style="padding:20px 20px 0 20px;">
<?php //include('connection/dbconnection_crm.php')?>
<?php

    if(empty($_GET['holiday_list'])){
      include('Attendance/agent-attendance.php');
    }
    else{
         include('Attendance/holydays-list.php');
    }

?>



</div>

</div>


<?php include('partial/footer.php') ?>
