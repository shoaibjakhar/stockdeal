<?php  include('partial/session_start.php'); ?>

<?php
 // $UserName = $_GET['UserName'];
 // $Source = $_GET['Source'];
 // $Disposition = $_GET['Disposition'];
 
date_default_timezone_set('Asia/Kolkata');
 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Update Clients Login Detail</title>
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
 <!--<a href="memberpage.php">Dashbord</a> | <a href="customer-profile.php">Customer Profile Last 60</a> | <a href="customer-profile-all.php">Customer Profile All</a> | <a href="clients.php"  >Clients Login</a> | <a href="clients-update.php" class="btn btn-xs btn-primary">Client Update</a> | <a href="customer-profile-packaged-expired.php">Packaged Expired</a>-->
 <a href="memberpage.php">Dashbord</a>| <a href="clients.php"  >Clients Login</a> | <a href="clients-update.php" class="btn btn-xs btn-primary">Client Update</a>
 </div>
<!-- <div class="pull-right"><a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a></div> -->
 <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">

<?php include('connection/dbconnection_crm.php')?>


<?php
$sql = ("SELECT Id, User, Password , Mobile, DATE_FORMAT(  `Timestamp` ,  '%d-%m-%Y' ) AS DateTimeCurrent
FROM clients ORDER BY  `clients`.`Timestamp` DESC");
$result = mysqli_query($connect,$sql);
echo('<form action="stock-tips-update-back.php" method="post">');
echo('<table id="Clients" class="display table table-bordered" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr class="brand-color-bg">');
  echo('<th>Date</th>');
  echo('<th>User Name</th>');
  echo('<th>Password</th>');
  echo('<th>User ID / Mobile</th>');
  echo('<th>&nbsp;</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = $result->fetch_array())
{
echo('<tr>');
 echo('<td>'.$row['DateTimeCurrent'].'</td>');
 echo('<td><input type="hidden" class="Id form-control" value="'.$row['Id'].'"/><input type="text" class="User form-control" value="'.$row['User'].'"/></td>');
 echo('<td><input type="text" class="Password form-control" value="'.$row['Password'].'"/></td>');
 echo('<td><input type="text" class="Mobile form-control" value="'.$row['Mobile'].'"/></td>');
 echo('<td><input type="hidden" value="'.$row['Id'].'"'. 'class="id"/>'.'<a href="#_"' . 'class="btn btn-primary Updatebtn">Update</a>'.'</td>');
  }
 echo('</tr>');
echo('</tbody>');
echo('</table>');
echo('</form>');
?>



</div>

</div>



<form action="clients-tips-update-back.php" method="get" style="display:none;">
<input type="text"  name="Id" id="Id" value=""/>
<input type="text"  name="User" id="User" value=""/>
<input type="text"  name="Password" id="Password" value=""/>
<input type="text"  name="Mobile" id="Mobile" value=""/>

<input type="submit" id="aa"/>
</form>

<?php include('partial/footer.php') ?>




<script type="text/javascript">


	
	
$(document).ready(function() {

	$('.Updatebtn').click(function() {
		var Id =  $(this).closest('tr').find('.Id').val() 
		var User =  $(this).closest('tr').find('.User').val() 
		var Password  = $(this).closest('tr').find('.Password').val() 
		var Mobile = $(this).closest('tr').find('.Mobile').val()
		//alert(Id+Ideas);
		$('#Id').val(Id)
		$('#User').val(User)
		$('#Password').val(Password)
		$('#Mobile').val(Mobile)
		
		$('#aa').trigger("click");
		});
		
		
});
</script>