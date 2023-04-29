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
    <div class="breadcurms"> <a href="memberpage.php">Dashbord</a> | <a href="leads-view.php">Assigned Leads</a> | <a href="leads-filter_1_new.php" class="btn btn-xs btn-primary">Filter 1</a> | <a href="leads-filter_3_new.php">Filter 3</a> | <a href="leads-filter_4_new.php">Filter 4</a> | <a href="leads-filter_6_new.php">Filter 6</a> |  <a href="leads-filter_7_new.php" class="">Last 7 days Inactive</a> | <a href="leads-view-delete.php">Delete</a> </div>

  <div class="containter" style="padding:20px 20px 0 20px;">
   <?php include('connection/dbconnection_crm.php')?>
<div style="margin-bottom:15px;">
<form class="form-inline">


  <div class="form-group pull-left"  style="margin-left:10px;">
  <input type="text" placeholder="Mobile Number" id="Mobile"  class="form-control"/>
  </div>
   
  
  <button type="button" class="btn btn-primary rowcountbtn pull-left"  style="margin-left:10px;" onclick="showUser()">Submit</button>
  <div class="pull-left"  style="margin-left:10px;margin-top:6px;">Total: <strong class="totalrow"></strong></div>
</form>
<div class="clearfix"></div>
</div>
<div id="txtHint"></div>
<div id="FollowUpHint" style="width:100%; overflow:auto; margin-top:10px;"></div>
 
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
  
//var StartDateUSA = document.getElementById("StartDateUSA").value
//var EndtDateUSA = document.getElementById("EndtDateUSA").value
//var disposition = document.getElementById("disposition").value
var Mobile = document.getElementById("Mobile").value
//var limit = document.getElementById("limit").value

aa.open("GET","leads-filter-back_5.php?Mobile="+Mobile,true);

aa.send();
//alert(Mobile)
rowcount()
showFollowUpHistory()
}




function showFollowUpHistory()
{
	alert('asd')
var Mobile = document.getElementById("Mobile").value
//var Costumer_ID = document.getElementById("Costumer_ID").value
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  aa=new XMLHttpRequest();
  }

aa.onreadystatechange=function()
  {
  if (aa.readyState==4 && aa.status==200)
    {
    document.getElementById("FollowUpHint").innerHTML=aa.responseText;
    }
  }
aa.open("GET","lead-details-filter3-results.php?Mobile="+Mobile,true);
aa.send();
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
