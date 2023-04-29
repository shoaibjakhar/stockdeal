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
  <div class="breadcurms"> <a href="memberpage.php">Dashbord</a> | <a href="leads-view.php">Assigned Leads</a> | <a href="leads-filter_1_new.php">Filter 1</a> | <a href="leads-filter_3_new.php" class="btn btn-xs btn-primary">Filter 3</a> | <a href="leads-filter_4_new.php">Filter 4</a> | <a href="leads-filter_6_new.php">Filter 6</a> |  <a href="leads-filter_7_new.php" class="">Last 7 days Inactive</a> | <a href="leads-view-delete.php">Delete</a> </div>

  <div class="containter" style="padding:20px 20px 0 20px;">
   <?php include('connection/dbconnection_crm.php')?>
<div style="margin-bottom:15px;">
<form class="form-inline">
  <div class="form-group pull-left">
    <input type="text" class="form-control" style="width:120px;" placeholder="Start Date" value="" id="StartDate">
    <input type="hidden" value="" id="StartDateUSA">
  </div>
   <div class="form-group pull-left" style="margin-left:10px;">
    <input type="text" value=""  class="form-control" style="width:120px;"  placeholder="End Date" id="EndtDate">
    <input type="hidden" value="" id="EndtDateUSA">
  </div>
 
  <!--
  <div class="form-group">
    <select id="disposition"  class="form-control">
     <?php /*include('partial/disposition.php')*/ ?>
</select>
  </div>
  -->
  <div class="form-group pull-left"  style="margin-left:10px;">
    <select id="username"  class="form-control">
     <?php include('partial/agents.php') ?>
</select>
  </div>
   <div class="form-group pull-left"  style="margin-left:10px;">
    <input type="text" value="10" style="width:100px;" class="form-control" id="limit">
   
  </div>
  
  <button type="button" class="btn btn-primary rowcountbtn pull-left"  style="margin-left:10px;" onclick="showUser()">Submit</button>
  <div class="pull-left"  style="margin-left:10px;margin-top:6px;">Total: <strong class="totalrow"></strong></div>
</form>
<div class="clearfix"></div>
</div>
<div id="txtHint"></div>

 
</div>
</div>

<script type="text/javascript">
function showUser()
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  aa=new XMLHttpRequest();
  }

aa.onreadystatechange=function()
  {
  if (aa.readyState==4 && aa.status==200)
    {
    document.getElementById("txtHint").innerHTML=aa.responseText;
	}
  }
  
var StartDateUSA = document.getElementById("StartDateUSA").value
var EndtDateUSA = document.getElementById("EndtDateUSA").value
//var disposition = document.getElementById("disposition").value
var username = document.getElementById("username").value
var limit = document.getElementById("limit").value

aa.open("GET","leads-filter-back_3.php?StartDateUSA="+StartDateUSA+"&EndtDateUSA="+EndtDateUSA+"&username="+username+"&limit="+limit,true);

aa.send();
//alert(StartDateUSA + EndtDateUSA + username + limit)
rowcount()
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
