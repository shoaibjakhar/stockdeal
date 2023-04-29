<?php  include('partial/session_start.php'); ?>


<?php
if(isset($_GET['UserName']) && isset($_GET['Source']) && isset($_GET['Disposition'])){
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
}
 
date_default_timezone_set('Asia/Kolkata');
 
 ?>

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
  <a href="memberpage.php">Dashbord</a> | <a href="stock-tips.php">Stock Tips</a> | <a href="stock-tips-filter.php" class="btn btn-xs btn-primary">Filter 3</a>  | <a href="stock-tips-filter_2.php">Filter 4</a> | <a href="stock-tips-update.php">Today's Update</a> | <a href="stock-tips-update-3month.php">Last 3 Months's Update</a> | <a href="stock-tips-update-open.php">Open</a>
 </div>
  
 <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">

<?php include('connection/dbconnection_crm.php')?>

<div style="margin-bottom:15px;">
<form class="form-inline">
  <div class="form-group">
    <input type="text" class="form-control" value="" id="StartDate">
    <input type="hidden" value="" id="StartDateUSA">
  </div>
   <div class="form-group">
    <input type="text" value=""  class="form-control" id="EndtDate">
    <input type="hidden" value="" id="EndtDateUSA">
  </div>
  <div class="form-group">
    <select id="Packages"  class="form-control">
     <option value="">Select</option>
			<?php
			$get_risk_qry = "SELECT Segment FROM `Options` where Segment IS NOT NULL";
			$getd_qry = mysqli_query($connect, $get_risk_qry );
			while ( $get_options = mysqli_fetch_assoc( $getd_qry ) ) {
				?>
			<option value="<?php echo $get_options['Segment']; ?>">
				<?php echo $get_options['Segment'] ?>
			</option>
			<?php
			//	echo '<option value="'.$get_options['Package'].'">.$get_options["Package"].</option> ';
			}
			?>
</select>
  </div>
  
  <button type="button" class="btn btn-primary" onclick="showUser()">Submit</button>
</form>
</div>


<div id="txtHint"></div>

</div>




<!-- Modal -->



</div>


<?php include('partial/footer.php') ?>



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
var Packages = document.getElementById("Packages").value


aa.open("GET","stock-tips-back.php?StartDateUSA="+StartDateUSA+"&EndtDateUSA="+EndtDateUSA+"&Packages="+Packages,true);

aa.send();
//alert(StartDateUSA + EndtDateUSA + Packages)

}
</script>


<script type="text/javascript">

	
	
$(document).ready(function() {
 
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