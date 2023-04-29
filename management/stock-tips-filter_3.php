<?php  include('partial/session_start.php'); ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Stock Tips</title>
<?php require('partial/plugins.php'); ?>
</head>
<body>
<?php include('partial/sidebar.php') ?>
<div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>
  </header>

  	
  	 <div class="breadcurms">
 <div class="pull-left">
  <a href="memberpage.php">Dashbord</a> | <a href="stock-tips.php">Stock Tips</a> | <a href="stock-tips-download.php" class="btn btn-xs btn-primary">Download</a>  | <a href="stock-tips-filter_4.php">Filter 4</a> | <a href="stock-tips-update.php">Today's Update</a> | <a href="stock-tips-update-3month.php">Last 3 Months's Update</a> | <a href="stock-tips-update-open.php">Open</a>
 </div>
  
 <div class="clearfix"></div>
</div>  
  	
 

  <div class="containter" style="padding:15px 20px 0 10px;">
   <?php include('connection/dbconnection_crm.php')?>
   
  <form class="form-inline" method="get" action="stock-tips-filter_3_back1.php">
  
	   <div class="form-group">
    <input type="text" class="form-control" value="" id="StartDate" placeholder="Start Date" autocomplete="off">
    <input type="hidden" value="" id="StartDateUSA" name="StartDateUSA">
  </div>
   <div class="form-group">
    <input type="text" value=""  class="form-control" id="EndtDate" placeholder="End Date" autocomplete="off">
    <input type="hidden" value="" id="EndtDateUSA" name="EndtDateUSA">
  </div>
  <div class="form-group">
    <select id="Packages" name="Packages"  class="form-control">
     <?php include('partial/segments.php') ?>
</select>
  </div>
   <button type="submit" class="btn btn-primary rowcountbtn" style="margin-left: 15px;">Submit</button>
  </div>
  
  
  
  
  
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
