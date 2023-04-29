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

<?php
// function definition is written in hearder-top.php
// if agent bank details are missing, will redirect on agent login details page
check_agent_bank_details();
?>

	
	<?php
if (isset($_SESSION['Role'])) {

    if($_SESSION['Role'] == 'Super Admin') {
  	
echo '<div class="breadcurms"> <a href="memberpage.php">Dashbord</a> | <a href="leads-view.php">Assigned Leads</a> | <a href="leads-filter_1_new.php" class="btn btn-xs btn-primary">Filter 1</a> | <a href="leads-filter_3_new.php" >Filter 3</a> | <a href="leads-filter_4_new.php" >Filter 4</a> | <a href="leads-filter_6_new.php">Filter 6</a> | <a href="leads-filter_7_new.php" class="">Last 7 days Inactive</a> | <a href="leads-filter_2_new.php">Churn</a> | <a href="leads-view-delete.php">Delete</a> </div>';
		
    }
	
	else if ($_SESSION['Role'] != 'Super Admin') {
        echo '<div class="breadcurms"><a href="leads-filter_1_new.php" class="btn btn-xs btn-primary">Filter 1</a> | <a href="supervisor-review.php" class="btn btn-xs btn-primary">Supervisor Review</a></div>';
    }
}

?>	
	
 

  <div class="containter" style="padding:15px 20px 0 10px;">
   <?php include('connection/dbconnection_crm.php')?>
   
  <form class="form-inline" method="get" action="leads-filter_1_new_back1.php"id="Submit_Search" >
        <?php if(isset($_SESSION['error'])){ ?>
	    <div class="alert alert-danger" role="alert">
          <?php
	            
	                echo '<h4>'.$_SESSION['error'].'</h4>';
	                $_SESSION['error'] = null;
	           
	           
	        ?>
        </div>
        <?php  } ?>
	  <div class="form-group pull-left"  style="margin-left:10px;">
		  
		   <input type="text" placeholder="Search By Mobile Number, Customer Name or Email Id" id="Mobile"  name="Mobile"  class="form-control Mobile_Numbers" style="width: 500px;"/>
	       
 
	
  </div>
  
	  
	  
   
  </div>
  
   
  
  <button type="submit" class="btn btn-primary rowcountbtn pull-left" style="margin-left: 15px;" >Submit</button>
  
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


$("#Submit_Search").submit(()=>{
    var Mobile_Number = $(".Mobile_Numbers").val();
    console.log(Mobile_Number)
    if(Mobile_Number.length<4){
        alert('Minimum 4 Charecters Are Required');
    }
    retun false;
})
</script>
<?php include('partial/footer.php') ?>
