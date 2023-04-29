<?php  include('partial/session_start.php'); ?>

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

  /*
  [style*="color:red"]{display:none;}
  [style*="color:green"]{display:none;}
  */
 /* .username {white-space: nowrap;width: 50px;overflow: hidden;text-overflow: clip;}*/
</style>

<?php 

if($_SESSION['Role'] != 'Team Leader' && $_SESSION['Role'] != 'SR_TL') {
 echo('<style>[style*="color:red"]{display:none;}[style*="color:green"]{display:none;}.badge {white-space: nowrap;width: 24px;overflow: hidden;text-overflow: clip;}.ShowAllTd {display:none;}</style>');
}
?>

</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
    <?php 
    // function definition is written in hearder-top.php
    // if agent bank details are missing, will redirect on agent login details page
    check_agent_bank_details();
  ?>
  
</header>

<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>
<?php
  
 
  if($_SESSION['Role'] == 'Team Leader')
  {
    include('Attendance/admin-attendance-to-show-tl.php');
  }
  else if($_SESSION['Role'] == 'SR_TL')
  {
    include('Attendance/admin-attendance-to-show-sr-tl.php');
  }
  else //($_SESSION['Role'] != 'Team Leader' && $_SESSION['Role'] != 'SR_TL')
  {
    if(empty($_GET['holiday_list']))
    {
      include('Attendance/admin-attendance.php');
    }
    else
    {
         include('Attendance/holydays-list.php');
    }

  }

  

?>



</div>

</div>


<?php include('partial/footer.php') ?>
