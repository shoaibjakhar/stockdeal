<?php  include('partial/session_start.php'); ?>

  <?php

if($_GET['post_id']){
    $post_id = $_GET['post_id'];
    $sel_post = "SELECT * FROM News_and_Updates WHERE Id = '{$post_id}'";
    $qry_posts = mysqli_query($connect, $sel_post);
    $qry_post = mysqli_fetch_assoc($qry_posts);
    //print_r($qry_post);
}
else{
    echo "<script>window.history.back()</script>";
}


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>News and Updates</title>
<?php require('partial/plugins.php'); ?>
</head>
<body>
<?php include('partial/sidebar.php') ?>
<div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>
  </header>
  <div class="breadcurms"> <a href="news-and-updates.php"  class="btn btn-xs btn-primary">News and Updates</a> | <a href="quality-analysis.php">Quality & Compliance</a> | <a href="quality-analysis-others.php"> Others</a></div>
  <div class="containter" style="padding:20px 20px 0 20px;">
    <?php include('connection/dbconnection_crm.php')?>
 
   

	<div class="row">
  <div class="col-sm-12" style="display:;">
    <div class="panel panel-default" style="padding-bottom:20px;">
      <div class="panel-heading font-size16"><a href="news-and-updates.php">News and Updates Single Post</a> 
      <?php //if ( $_SESSION['Role'] == 'Admin' or $_SESSION['Role'] == 'Super Admin' ) {
	//echo ('<a href="#" class="btn  btn-success pull-right" style="margin-top: -6px;"  data-toggle="modal" data-target="#AddNewPost"> <i class="fa fa-plus" aria-hidden="true"></i> New Post</a>');
//}  ?>
      
      
      </div>
      <div class="panel-body">
		  
		 <div>
			    <?php
			    
			    $sel_pre = "SELECT Id From News_and_Updates WHERE Id<'$post_id' AND Status = 'Active'";
			    
			    $qry_pre = mysqli_query($connect, $sel_pre);
			    $get_pre_id = mysqli_fetch_assoc($qry_pre);
			    //print_r($get_pre_id);
			    
			    $sel_next = "SELECT Id From News_and_Updates WHERE Id>'$post_id' AND Status = 'Active'";
			    
			    $qry_next = mysqli_query($connect, $sel_next);
			    $get_next_id = mysqli_fetch_assoc($qry_next);
			    
			    if($get_pre_id){
			    ?>
			    
			    <?php
			    }
			    if($get_next_id){
			    
			    ?>
				
				<?php
			    }
				?>
				</div>
		  <div class="clearfix"></div>
        <div class="post-heading">
	    <h1>  <?php
	    if($qry_post['User_View']){
        	   //if()
        	   $user_view =  (array)json_decode($qry_post['User_View']);
        	  // $user_view = array_combine(range(1, count($user_view)), array_values($user_view));
               //echo array_search($_SESSION['Id'],$user_view);
               //print_r($user_view);
               $total_news_count =  count($user_view);
        	   if(array_search($User_Id,$user_view)){
        	       $user_view = $user_view;
        	       //echo "found";
        	   }
        	   else{
        	      //array_push($user_view,$_SESSION['Id']); 
        	      //echo "Not Found";
        	      $user_view[$total_news_count+1] = $User_Id;
        	      
        	      
        	   }
        	     
        	     //print_r($user_view);
	    }
	    else{
	        $user_view = array("1"=>$User_Id);
	    }
	    
	    //print_r($user_view);
	    
	    $json_data = json_encode($user_view);
	    
	   //echo $json_data;
	     $up_queries = "UPDATE News_and_Updates SET User_View = '$json_data' WHERE Id = '$post_id'";
	    mysqli_query($connect, $up_queries);
		 
		 echo $qry_post['Subject'];
		 
		 ?></h1>
	    <div><span>Author: <strong> <?php
		 
		 echo $qry_post['Author_Name'];
		 
		 ?></strong></span> <span>Date: <strong><?php
		 
		 echo $qry_post['Date'];
		 
		 ?></strong></span><br/><br/></div>
		</div>
		<div class="post-conent">
		 <p>
		 <?php
		 
		 echo $qry_post['Post_content'];
		 
		 ?>
		 </p> 
		  <div class="clearfix"></div>
			<div>
			    <?php
			    
			    $sel_pre = "SELECT Id From News_and_Updates WHERE Id<'$post_id' AND Status = 'Active'";
			    
			    $qry_pre = mysqli_query($connect, $sel_pre);
			    $get_pre_id = mysqli_fetch_assoc($qry_pre);
			    //print_r($get_pre_id);
			    
			    $sel_next = "SELECT Id From News_and_Updates WHERE Id>'$post_id' AND Status = 'Active'";
			    
			    $qry_next = mysqli_query($connect, $sel_next);
			    $get_next_id = mysqli_fetch_assoc($qry_next);
			    
			    if($get_pre_id){
			    ?>
			    <a href="news-and-updates-single-post.php?post_id=<?php echo $get_pre_id['Id']; ?>" class="pull-left btn btn-primary MR20"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</a>
			    <?php
			    }
			    if($get_next_id){
			    
			    ?>
				<a href="news-and-updates-single-post.php?post_id=<?php echo $get_next_id['Id']; ?>" class="pull-left btn btn-primary">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
				<?php
			    }
				?>
				</div>
		  </div>  
      </div>
    </div>
  </div>
</div>






    
  </div>
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
