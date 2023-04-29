<?php  include('partial/session_start.php'); ?>
<?php// include($_SERVER['DOCUMENT_ROOT']."/partial/access-control-role-base.php"); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Website Leads</title>
<?php require('partial/plugins.php'); ?>
</head>
<body>
<?php include('partial/sidebar.php') ?>
<div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>
  </header>
   <div class="breadcurms">
 <a href="memberpage.php">Dashbord</a> | <a href="website-leads-rsi.php">Single Assign</a> | <a href="assign-multiple-leads.php">Multiple Assign</a> | 
 <a href="assign-leads-new-front.php">Bulk Assign</a> | <a href="leads-re-assign.php" class="btn btn-xs btn-primary">Re Assign</a>
</div>

  <div class="containter" style="padding:15px 20px 0 10px;">
   <?php include('connection/dbconnection_crm.php')?>
   
   <?php 
   
   if($_SESSION['Role'] == 'Super Admin') { 
   
   //echo('<form class="form-inline" method="get" action="assign-leads-new-TL.php">');
       
   }
   
  else if($_SESSION['Role'] == 'Team Leader') { 
   
   echo('<form class="form-inline" method="get" action="leads-re-assign-back.php">');
       
   }
  
  ?>
  
  <div class="form-group pull-left"  style="margin-left:10px;">
    <!--<select name="Source"  class="form-control">
    <?php //include('partial/source_name.php') ?>
</select>-->
    <select class="form-control" name="agent_name">
        <option value="">Select Agent</option>
        <?php
            $sel = "SELECT * FROM employee where Team_Leader != '' AND Team_Leader = '".$username."'";
            $qry = mysqli_query($connect,$sel);
            while($fetch = mysqli_fetch_assoc($qry)){
                echo '<option value="'.$fetch['username'].'">'.$fetch['username'].'</option>';
            }
        ?>
    </select>
  </div>
  
   <div class="form-group pull-left"  style="margin-left:10px;">
    <input type="text" value="10" style="width:100px;" class="form-control" name="limit">
   
  </div>
  
  <button type="submit" class="btn btn-primary rowcountbtn pull-left" style="margin-left: 15px;">Submit</button>
  
</form>
<div class="clearfix"></div>
</div>


</div>
</div>


<?php include('partial/footer.php') ?>
