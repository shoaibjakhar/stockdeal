<?php  include('partial/session_start.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/partial/access-control-role-base.php"); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Assigned Leads</title>
<?php require('partial/plugins.php'); ?>
</head>
<body>
<?php include('partial/sidebar.php') ?>
<div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>
  </header>

  	
  	 <div class="breadcurms"> <a href="memberpage.php">Dashbord</a> | <a href="leads-view.php">Assigned Leads</a> | <a href="leads-filter_1_new.php">Filter 1</a> | <a href="leads-filter_3_new.php">Filter 3</a> | <a href="leads-filter_4_new.php">Filter 4</a> | <a href="leads-filter_6_new.php">Filter 6</a> | <a href="leads-filter_7_new.php"  class="btn btn-xs btn-primary">Last 7 days Inactive</a> | <a href="leads-filter_2_new.php">Churn</a> | <a href="leads-view-delete.php">Delete</a> </div>   
  	
 

  <div class="containter" style="padding:15px 20px 0 10px;">
   <?php include('connection/dbconnection_crm.php')?>
   
  <form class="form-inline" method="get" action="leads-filter_7_new_back1.php">
  <div class="form-group pull-left"  style="margin-left:10px;">
	
	    <div class="form-group pull-left"  style="margin-left:10px;">
    <select id="username" name="username"  class="form-control">
     <?php include('partial/agents.php') ?>
</select>
  </div>
	  <div class="form-group pull-left"  style="margin-left:10px;">
    <select id="disposition" name="disposition" class="form-control">
     <?php include('partial/disposition.php') ?>
</select>
  </div>
	  <div class="form-group pull-left">
    <select id="source_name" name="source_name" style="margin-left:10px;width:120px;"  class="form-control">
     <?php include('partial/source_name.php') ?>
</select>
  </div>
	  
   
  </div>
  
   <div class="form-group pull-left"  style="margin-left:10px;">
    <input type="text" value="100" style="width:100px;" class="form-control" name="limit">
   
  </div>
  
  <button type="submit" class="btn btn-primary rowcountbtn pull-left" style="margin-left: 15px;">Submit</button>
  
</form>
<div class="clearfix"></div>
</div>


</div>
</div>

<script type="text/javascript">
	
$(document).ready(function() {
		
$(".rowcountbtn").live("click", function(){
    
	setTimeout(function(){ 
	 var rowcount =  $('.rowcount').find('tr').length - 2
	 $('.totalrow').text(rowcount)
	}, 1000);
});
	/*
	
$('#Agent').live('change',function(){
  var Agent = $(this).val();
  $('.AgentNames').val(Agent)
  $('.UserNameData').text(Agent)
});
	
	*/
	
 $( "#StartDate" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#StartDateUSA',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd',
	
});


$( "#EndtDate" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#EndtDateUSA',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd',
	
});
   
});
</script>
<?php include('partial/footer.php') ?>
