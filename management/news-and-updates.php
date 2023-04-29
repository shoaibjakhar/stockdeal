<?php  include('partial/session_start.php'); ?>


<?php
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
 
date_default_timezone_set('Asia/Kolkata');
 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Trading Guidelines</title>
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
  <a href="memberpage.php">Dashbord</a> | <a href="news-and-updates.php" class="btn btn-xs btn-primary">Trading Guidelines </a>  | <a href="quality-analysis.php" class="">Quality &amp; Compliance</a> | <a href="quality-analysis-others.php"> Others</a>
 </div>
 <!-- <div class="pull-right"><a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a></div> -->
 <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>

	<div class="row">
  <div class="col-sm-12" style="display:;">
    <div class="panel panel-default" style="">
      <div class="panel-heading font-size16"><a href="news-and-updates.php">Trading Guidelines</a> 
	
<a href="#" class="btn  btn-primary pull-right" style="margin-top: -6px;"  data-toggle="modal" data-target="#AddNewPost"> <i class="fa fa-plus" aria-hidden="true"></i> New</a>

		  </div>
      <div class="panel-body PT30 ">
        <?php
						
$sql = "SELECT * FROM `News_and_Updates` WHERE Status = 'Active' ORDER BY Date DESC";
if($result = mysqli_query($connect, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo '<table id="Agent_profile" class="table table-bordered table-hover MT20" cellspacing="0" width="100%">';
            echo('<thead>');
 echo('<tr style="display:none;">');
  echo('<th></th>');


	echo ('<th></th>');

  
 
 echo('</tr>');
echo('</thead>');
echo('<tbody>');
        while($row = mysqli_fetch_array($result)){
            echo('<tr>');
   echo('<td>
   <h3><a href="news-and-updates-single-post.php?post_id='.$row['Id'].'">'.$row['Subject'].'</a></h3>
   <div class="MB20"><span class="bold MR20">Date: '.$row['DateTime'].'</span> <span class="bold MR20"> Author: '.$row['Author_Name'].'</span></div>
   
   </td>');


	echo '<td style="vertical-align: middle;"><a href="delete-post.php?post_id='.$row['Id'].'" class="btn btn-danger btn-sm">Delete</a></td>';

   
   
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} 
 
// Close connection
//mysql_close($connect);
?>	
      </div>
    </div>
  </div>
</div>



</div>




<!-- -->
<div id="AddNewPost" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg"> 
    
    <!-- Modal content-->
    <form method="post" action="news-and-updates-back.php">
      <div class="modal-content">
        <div class="modal-body">
          <div class="form-group">
            <label for="Subject">Subject:</label>
            <input type="text" class="form-control" id="Subject" name="Subject">
          </div>
          <div class="form-group">
            <label for="email">Post content</label>
            <textarea id="" class="form-control" name="Post_content" style="height:200px;"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Submit">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>
<style>
 div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    margin-top: -66px;
    margin-right: 120px;
}
</style>



</div>


<?php include('partial/footer.php') ?>
<script type="text/javascript">



function Add() {
	//alert('asd')
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



var FirstName  = document.getElementById('FirstName').value
var LastName  = document.getElementById('LastName').value
var EmailID  = document.getElementById('EmailID').value
var MobileNo  = document.getElementById('MobileNo').value
var Location  = document.getElementById('Location').value
var Package_Name  = document.getElementById('Package_Name').value
var altActivation_Date  = document.getElementById('altActivation_Date').value
var altExp_Date  = document.getElementById('altExp_Date').value
var DateTime  = document.getElementById('DateTime').value
var Agent  = document.getElementById('Agent').value
var Manager  = document.getElementById('Manager').value




aa.open("GET","free-trail-add.php?FirstName="+FirstName+"&LastName="+LastName+"&EmailID="+EmailID+"&MobileNo="+MobileNo+"&Location="+Location+"&Package_Name="+Package_Name+"&altActivation_Date="+altActivation_Date+"&altExp_Date="+altExp_Date+"&DateTime="+DateTime+"&Agent="+Agent+"&Manager="+Manager,true);
aa.send();

var aa =FirstName +' '+ LastName +' '+ EmailID +' '+ MobileNo +' '+ Location +' '+ Package_Name +' '+ altActivation_Date +' '+ altExp_Date +' '+ DateTime +' '+Agent +' '+ Manager ;

alert(aa)
setTimeout(function(){  location.reload(); }, 2000);

}



	
	
$(document).ready(function() {
	
	$('#Add').click(function() {
		 Add();
	});
	
$( "#Activation_Date" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#altActivation_Date',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd'
});

$( "#Exp_Date" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#altExp_Date',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd'
});

	
	
   var Costumer_IDLast = $('#Costumer_IDLast').val();
   var Costumer_ID = parseInt(Costumer_IDLast) + 1
   $('#Costumer_ID').val(Costumer_ID);
   
   
   
   
   
$('.Choose_color').click(function() {
	  var Class = $('#Class').val();
	  var altDatepicker = $('#altDatepicker').val();
	  var Hour = $('#Hour').val();
	  var Minuts = $('#Minuts').val();
	  var Second = $('#Second').val();

	  if(Class != "" && altDatepicker != "" && Hour != "" && Minuts != "" && Second != "") {
		  $('#InvalidInvestment_Choose_color').hide();
		   Add()
		  }
		  else {
			  $('#InvalidInvestment_Choose_color').show();
			  //alert('bb')
			  //return false;
			  }


});

   
});
</script>