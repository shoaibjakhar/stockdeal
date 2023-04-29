<?php include($_SERVER['DOCUMENT_ROOT']."/partial/access-control-role-base.php"); ?>
<?php
    if(!include('partial/session_start.php')){
        include('partial/session_start.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Assigned Leads</title>
<?php require('partial/plugins.php'); ?>
<!-- <link rel="stylesheet" href="style.css"/>
<script type="text/javascript" src="js/jquery.min.js"></script> -->
<script type="text/javascript">
function delete_confirm(){
	var result = confirm("Are you sure to delete users?");
	if(result){
		return true;
	}else{
		return false;
	}
}

$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
	
	$('.checkbox').on('click',function(){
		if($('.checkbox:checked').length == $('.checkbox').length){
			$('#select_all').prop('checked',true);
		}else{
			$('#select_all').prop('checked',false);
		}
	});
	
	setTimeout(function(){ 
	$('.alert-success').hide();
	}, 1000);
	
});
</script>
</head>

<body>
<?php include('partial/sidebar.php') ?>
<div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>
  </header>
 <div class="breadcurms"> <a href="memberpage.php">Dashbord</a> | <a href="leads-view.php" class="btn btn-xs btn-primary">Assigned Leads</a> | <a href="leads-filter_1_new.php">Filter 1</a> | <a href="leads-filter_3_new.php" >Filter 3</a> | <a href="leads-filter_4_new.php" >Filter 4</a> | <a href="leads-filter_6_new.php">Filter 6</a> | <a href="leads-filter_7_new.php" class="">Last 7 days Inactive</a> | <a href="leads-filter_2_new.php" >Churn</a> | <a href="leads-view-delete.php">Delete</a> </div>    

  <div class="containter" style="padding:20px 20px 0 20px;">
<?php session_start(); if(!empty($_SESSION['success_msg'])){ ?>
<div class="alert alert-success"><?php echo $_SESSION['success_msg']; ?></div>
<?php unset($_SESSION['success_msg']); } ?>
<?php
include_once('connection/dbConfig.php');

$query = mysqli_query($conn,"SELECT Id, Full_Name, Email, Mobile, State, Source, Disposition, UserName, DATE_FORMAT( Date,  '%d-%m-%Y' ) AS Date FROM Assigned_Leads WHERE `date` BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 10 DAY ) AND CURDATE( ) ORDER BY  `Assigned_Leads`.`Date` DESC ");
?>
<form name="bulk_action_form" action="leads-view-delete-back.php" method="post" onSubmit="return delete_confirm();"/>
    <table style="width:170px; margin-bottom:0;" border="0" class="table">
  <tr>
    <td><input type="checkbox" name="select_all " id="select_all" value=""/> Select All</td>
    <td> <input type="submit" class="btn btn-xs btn-danger" name="bulk_delete_submit" value="Delete"/></td>
  </tr>
</table>

   
    <table id="ViewLeadsDelete" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th></th>        
            <th>Full_Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>State</th>
            <th>Source</th>
            <th>Disposition</th>
            <th>UserName</th>
            <th>Date</th>
            
            
        </tr>
        </thead>
        <?php
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td align="center"><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $row['Id']; ?>"/></td>        
            <td><?php echo $row['Full_Name']; ?></td>
            <td><?php echo $row['Email']; ?></td>
            <td><?php echo $row['Mobile']; ?></td>
            <td><?php echo $row['State']; ?></td>
            <td><?php echo $row['Source']; ?></td>
            <td><?php echo $row['Disposition']; ?></td>
            <td><?php echo $row['UserName']; ?></td>
            <td><?php echo $row['Date']; ?></td>
        </tr> 
        <?php } }else{ ?>
            <tr><td colspan="5">No records found.</td></tr> 
        <?php } ?>
    </table>
   
</form>
    </div>
<?php include('partial/footer.php') ?>
</body>

</html> 