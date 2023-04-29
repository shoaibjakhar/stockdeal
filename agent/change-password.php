<?php  include('partial/session_start.php'); ?>

<?php
 //$username = $username;
 $Id = $User_Id;
 $ExistingPassword = $Password;
?>

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
<title>Change Password</title>
<?php require('partial/plugins.php'); ?>

<script type="text/javascript">
/*
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
aa.open("GET","free-trail-results.php?Mobile_No="+Mobile_No,true);
aa.send();
}
*/

</script>
<style>

	
	
	
</style>
</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">
 <div class="pull-left">
  <a href="memberpage.php">Dashbord</a> | <a href="agent-request-received.php" class="btn btn-xs btn-primary">Change Password</a> 
 </div>
 <div class="clearfix"></div>
</div>

<div class="" style="padding:20px 20px 0 20px;">
    <div class="alert alert-danger" >
        Please change your password to use CRM
    </div>

	<div class=" changepassword">
		<div class="col-sm-3">
			<input type="hidden" value="<?php echo($Id) ?>" id="Id">
  <div class="form-group">
    <label for="">Existing Password:</label>
    <input type="hidden" class="form-control" value="<?php echo($ExistingPassword) ?>" id="ExistingPassword">
    <input type="text" class="form-control" value="" id="OldPassword">
    <span id="errorMessage_1" style="color:red;"></span>
  </div>
    <div class="form-group">
    <label for="">New Password:</label>
    <input type="text" class="form-control" value="" id="NewPassword">
    <span id="errorMessage_2" style="color:red;"></span>
  </div>
  
  <button type="submit" class="btn btn-primary" id="Update">Change Now</button>

		</div>
	</div>
	
	<div class=" changepasswordSuccessfully"  style="font-size: 22px;color:green;display: none">
		<p>Password changed successfully!</p>
	</div>
</div>


<script type="text/javascript">
	
	
$(document).ready(function() {
	
function ChangePassword() {
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



var Id         = document.getElementById('Id').value
var ExistingPassword   = document.getElementById('ExistingPassword').value
var OldPassword   = document.getElementById('OldPassword').value
var NewPassword   = document.getElementById('NewPassword').value

aa.open("GET","change-password-back.php?Id="+Id+"&NewPassword="+NewPassword,true);
aa.send();	
	

//var aa =Id +' '+ NewPassword ;
//alert(aa)

//setTimeout(function(){  location.reload(); }, 2000);
}


	$('#Update').click(function(){
	 var Id         = document.getElementById('Id').value
     var ExistingPassword   = document.getElementById('ExistingPassword').value
	 var OldPassword   = document.getElementById('OldPassword').value
     var NewPassword   = $('#NewPassword').val()
	
	//$('#Id').val(Id)
	//$('#ExistingPassword').val(ExistingPassword)
	//$('#NewPassword').val(NewPassword)
		
		//alert(Id+' '+ExistingPassword+' '+NewPassword);
		
		if(ExistingPassword != OldPassword) {
			$('#errorMessage_1').text('Existing password not match');
		}
		
		else if(NewPassword == '' || NewPassword == undefined) {
			$('#errorMessage_1').hide();
			$('#errorMessage_2').text('Please enter new password');
		    //alert('asdf')
		}
		
		else if(NewPassword.length <= 5) {
			$('#errorMessage_1').hide();
			$('#errorMessage_2').text('Password should be minimum 6 characters ');
		    //alert('asdf')
		}
		
		else {
			$('.changepassword').hide();
			$('.changepasswordSuccessfully').show();
			$('#errorMessage_1, #errorMessage_2').hide();
			
			ChangePassword()
			
			setTimeout(function(){ 
			
				location.reload();
			
				window.location.href="logout.php"
				
			}, 3000);
			
		}
			
			
		
		
	});

	
	/*$('#Update').click(function(){
		
	var Password   = document.getElementById('Password').value
     //var StatusRespond   = document.getElementById('StatusRespond').value
		
		if(StatusRespond != "" && Respond != "") {
		//alert('aa');
		ChangePassword();
		}
		else {
		//alert('bb');	
		//$('.alert-danger').show();
			alert('asdf')
			}
		
		
	});  */
	
	
	
	
	
	
});
</script>
<?php include('partial/footer.php') ?>
