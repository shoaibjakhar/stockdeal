<?php  include('partial/session_start.php'); ?>

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
<div class="breadcurms">
<a href="sales-agent-wise.php">Sales Agent Wise</a> | <a href="sales-agent-report.php">Monthly Report</a> | <a href="sales-report-monthly-wise.php">Yearly Report</a></div>

  <div class="containter" style="padding:20px 20px 0 20px;">
   <?php include('connection/dbconnection_crm.php')?>
<div style="margin-bottom:15px;">
<form class="form-inline">

   
  <div class="form-group pull-left"  style="margin-left:10px;">
     <select id="years"  class="form-control">
     <?php include('partial/years.php') ?>
</select>
   
  </div>
  
  <button type="button" class="btn btn-primary rowcountbtn pull-left"  style="margin-left:10px;" onclick="showUser()">Submit</button>
 
</form>
<div class="clearfix"></div>
</div>
<div id="txtHint"></div>

 
</div>
</div>

<script type="text/javascript">
function showUser()
{

//var years    = document.getElementById("years").value
var years    = document.getElementById("years").value
    
    $('#txtHint').load("sales-report-monthly-wise-back.php?years="+years+"&time="+$.now());
   
}
</script>


<script type="text/javascript">
	
$(document).ready(function() {
	

		
$(".rowcountbtn").live("click", function(){
    
	setTimeout(function(){ 
	 var rowcount =  $('.rowcount').find('tr').length - 2
	 $('.totalrow').text(rowcount)
	}, 1000);
});



$('#Agent').live('change',function(){
  var Agent = $(this).val();
  $('.AgentNames').val(Agent)
  $('.UserNameData').text(Agent)
});
	
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
