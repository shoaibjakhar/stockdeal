<?php  include('partial/session_start.php'); ?>

<?php
//session_start();
 //$username = $username;
 //echo $username;

//include('partial/validate-user.php');
?>

<?php
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Customer Profile</title>
<?php require('partial/plugins.php'); ?>

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
//aa.open("GET","customer-profile-results.php?Mobile_No="+Mobile_No+"&Costumer_ID="+Costumer_ID,true);
aa.open("GET","customer-profile-results.php?Mobile_No="+Mobile_No,true);
aa.send();
}


</script>

</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">
 <a href="memberpage.php">Dashbord</a> | <a href="customer-profile-view-new.php">Paid Customers </a> | <a href="customer-profile.php" class="btn btn-xs btn-primary">Search Customer by number</a> 
</div>
<div class="cont-area" style="margin:20px;">
<input type="text" value="" id="Mobile_No" class="pull-left form-control" style="width:250px;" placeholder="Mobile Number"/>

<!--<div class="pull-left" style="margin-left:10px;margin-top:8px;">OR</div> 
<input type="text" value="" id="Costumer_ID" class="pull-left form-control" style="width:250px;margin-left:10px;" placeholder="Customer Id"/>
-->
<button onclick="showUser()" class="pull-left form-control btn btn-primary" style="margin-left:10px; width:150px;">Search</button>

<br /><br />
<div class="clearfix"></div>
<div id="txtHint" style="width:100%; overflow:auto; margin-top:10px;"></div>
</div>

</div>


<?php include('partial/footer.php') ?>
