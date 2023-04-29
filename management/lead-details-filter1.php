<?php  include('partial/session_start.php'); ?>

<?php
 // $UserName = $_GET['UserName'];
 // $Source = $_GET['Source'];
 // $Disposition = $_GET['Disposition'];
 

 
 ?>

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

  <a href="memberpage.php">Dashbord</a> | <a href="leads-view.php">Assigned Leads</a> | <a href="lead-details-filter1.php"  class="btn btn-xs btn-primary">Filter 1</a> | <a href="leads-filter_3_new.php">Filter 3</a> | <a href="leads-filter_4_new.php">Filter 4</a> | <a href="leads-filter_7_new.php" class="">Last 7 days Inactive</a> | <a href="leads-filter_2_new.php">Churn</a> | <a href="leads-view-delete.php">Delete</a><a href="#" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a>

 <div class="clearfix"></div>
</div>

 <div class="clearfix"></div>
<div class="cont-area" style="margin:20px;">
<input type="text" value="" id="Mobile_No" class="pull-left form-control" style="width:250px;" placeholder="Mobile Number"/>

<button onclick="showUser()" class="pull-left form-control btn btn-primary" style="margin-left:10px; width:150px;">Search</button>

<br /><br />
<div class="clearfix"></div>
<div id="txtHint" style="width:100%; overflow:auto; margin-top:10px;"></div>
</div>

</div>


<script type="text/javascript">

function showUser()
{
var Mobile_No = document.getElementById("Mobile_No").value
//var Costumer_ID = document.getElementById("Costumer_ID").value
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
aa.open("GET","leads-filter-back_1.php?Mobile_No="+Mobile_No,true);
aa.send();
}


</script>


<?php include('partial/footer.php') ?>
