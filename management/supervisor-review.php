<?php  include('partial/session_start.php'); ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Supervisor Review</title>
<?php require('partial/plugins.php'); ?>
</head>
<body>
<?php include('partial/sidebar.php') ?>
<div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>
  </header>

	
	<?php
if (isset($_SESSION['Role'])) {

    if($_SESSION['Role'] == 'Super Admin') {
  	
echo '<div class="breadcurms"> <a href="memberpage.php">Dashbord</a> | <a href="leads-view.php">Assigned Leads</a> | <a href="leads-filter_1_new.php" class="btn btn-xs btn-primary">Filter 1</a> | <a href="leads-filter_3_new.php" >Filter 3</a> | <a href="leads-filter_4_new.php" >Filter 4</a> | <a href="leads-filter_6_new.php">Filter 6</a> | <a href="leads-filter_7_new.php" class="">Last 7 days Inactive</a> | <a href="leads-filter_2_new.php">Churn</a> | <a href="leads-view-delete.php">Delete</a> </div>';
		
    }
	
	else if ($_SESSION['Role'] == 'Admin Assist' OR $_SESSION['Role'] == 'Team Leader') {
        echo '<div class="breadcurms"><a href="leads-filter_1_new.php" class="">Filter 1</a> | <a href="#" class="btn btn-xs btn-primary">Supervisor Review</a></div>';
    }
}

?>	
	
 

  <div class="containter" style="padding:15px 20px 0 10px;">
   <?php include('connection/dbconnection_crm.php')?>
   <div class="containter" style="padding:15px 20px 0 10px;">
  <form method="get" action="supervisor-review-back.php">
	  <div class="row">
	   <div class="col-sm-4">
  <div class="form-group">
    <label for="">Mobile Number</label>
    <input type="text" class="form-control" name="Mobile" placeholder="Enter Mobile Number" required>
  </div>
  <div class="form-group">
    <label for="">Remark</label>
    <textarea class="form-control" name="Remark" rows="3" placeholder="Enter remark" required></textarea>
	  <input type="hidden" name="User" value="<?php echo $_SESSION['username']?>">
  </div>
  <button type="submit" class="btn btn-primary">SUBMIT</button>
		  
	   
		</div>
	  </div>

  </form>
<div class="clearfix"></div>
</div>
	  <div class="containter" style="padding:20px 20px 0 20px;">

<?php

include('connection/dbconnection_crm.php');


$sql = ("SELECT * FROM `supervisor-review`");


//Agent = '".$UserNameSession."'
	
	
	
//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");



/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin

FROM fut_hni");*/





$result = mysqli_query($connect, $sql);



echo('<table id="Agent_request" class="display" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
	echo('<th>Date</th>');
  echo('<th>Mobile</th>');
  echo('<th>Remark</th>');
	echo('<th>User</th>');
  
  
 echo('</tr>');
echo('</thead>');
echo('<tbody>');

while($row = mysqli_fetch_array($result))

{
echo('<tr>');
	

  echo('<td>'.$row['Date'].'</td>');
  echo('<td>'.$row['Mobile'].'</td>');
  echo('<td>'.$row['Remark'].'</td>');
  echo('<td>'.$row['User'].'</td>');

 
}
echo('</tr>');

echo('</tbody>');

echo('</table>');





?>


</div>
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
