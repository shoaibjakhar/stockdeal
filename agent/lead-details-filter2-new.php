<?php  include('partial/session_start.php'); ?>


<?php
if(isset($_GET['UserName']) && isset($_GET['Source']) && isset($_GET['Disposition'])){
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
}
 
 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Leads</title>
<?php require('partial/plugins.php'); ?>
<style>
 .follow-up-notif-wrap{display:none;}
</style>
</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">

 <!--<a href="view-leads.php">View Leads</a> | <a href="lead-details.php" >Lead details</a> | <a href="lead-details-filter2-new.php"  class="btn btn-xs btn-primary">Filter 1</a> | <a href="leads-view.php">Add New Leads</a> -->
 <?php
    if($_SESSION['Role'] == 'Customer Care'){
        ?>
            <a href="follow-up-leads-filter-2.php">Filter 2</a> | <a href="lead-details-filter2-new.php" class="btn btn-xs btn-primary">Filter 1</a>
        <?php
    }
    else{
 ?>
 <a href="memberpage.php">Follow Up Leads</a> | <a href="follow-up-leads-filter-2.php">Filter 2</a> | <a href="fresh-leads.php">Fresh Leads</a> | <a href="lead-details-filter2-new.php" class="btn btn-xs btn-primary">Filter 1</a>  | <a href="leads-view.php">Add New Leads</a>
<?php
    }
?>
 <div class="clearfix"></div>
</div>

 <div class="clearfix"></div>
<div class="cont-area" style="margin:20px;">
<form action="disposition-filter-1.php" method="get">
    <?php if(isset($_SESSION['error'])){ ?>
	    <div class="alert alert-danger" role="alert">
          <?php
	            
	                echo '<h4>'.$_SESSION['error'].'</h4>';
	                $_SESSION['error'] = null;
	           
	           
	        ?>
        </div>
        <?php  } ?>
 <input type="text" value="" id="Mobile" name="Mobile" class="pull-left form-control" style="width:500px;" placeholder="Search By Mobile Number, Customer Name or Email Id"/>

 <input type="submit" value="Search" class="pull-left form-control btn btn-primary" style="margin-left:10px; width:150px;">
</form>
</div>
</div>


<script type="text/javascript">



</script>


<script>

$(document).ready(function(e) {
	       
	

  
});

</script>

<?php include('partial/footer.php') ?>
