<?php  include('partial/session_start.php'); ?>


<?php
//  $UserName = $_GET['UserName'];
//  $Source = $_GET['Source'];
//  $Disposition = $_GET['Disposition'];
 

 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Agent</title>
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
aa.open("GET","free-trail-results.php?Mobile_No="+Mobile_No,true);
aa.send();
}


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
   <!--<a href="memberpage.php">Dashbord</a> | <a href="agent-request-received.php">Received</a> | <a href="agent-request-sent.php" class="btn btn-xs btn-primary">Sent</a>-->
   <?php
  /*
  if($_SESSION['Role'] == 'Super Admin') {
      
    echo(' |  <a href="employee-login-details.php">Agent login details</a>');   
  }
  */
  
  ?> 
  <a href="memberpage.php">Dashbord</a> | <a href="agent-request-received.php">Received</a> | <a href="agent-request-sent.php" class="btn btn-xs btn-primary">Sent</a> | <a href="employee-login-details.php" >Agent login details</a> 
  <?php if($_SESSION['Role'] == 'Super Admin'){ ?>
  | <a href="employee-login-details.php?filter=admin" >Team Leader login details</a>
  <?php }
  ?>

  
 </div>
 <div class="pull-right"><a href="#" class="btn btn-xs btn-primary agentRequestSent" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> New Request</a></div>
 <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">

<?php

include('connection/dbconnection_crm.php');

$sql = ("SELECT Id,  DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DateTimeConvert,TL_Status,Team_Leader_Name, Agent, ToWhom, Subject, Priority, Message, Respond, Status, Customer_Name, Mobile, Paid_Amount, Paid_Date, Package, Duration,  Risk_Profile_Score, KYC, Done FROM Agent_request where  Team_Leader_Name = '".$_SESSION['username']."'  ORDER BY `Id` DESC LIMIT 500");


$result = mysqli_query($connect,$sql);

echo('<table id="Agent_request" class="display" cellspacing="0" width="100%">');

echo('<thead>');

 echo('<tr>');



  echo('<th>Date</th>');

	echo('<th>To</th>');
		echo('<th>Team Laeder</th>');

  echo('<th>Subject</th>');

  echo('<th style="width:250px;">Message</th>');

  echo('<th>Respond</th>');

  //echo('<th>Update</th>');

 echo('</tr>');

echo('</thead>');

echo('<tbody>');

while($row = mysqli_fetch_array($result))

{

echo('<tr>');



  echo('<td>'.$row['DateTimeConvert'].'</td>');

  echo('<td><a href="#_" class="btn btn-xs '.$row['Status'].'">'.$row['Status'].'</a>&nbsp;&nbsp;'.$row['ToWhom'].'</td>');
    echo('<td><a href="#_" class="btn btn-xs '.$row['TL_Status'].'">'.$row['TL_Status'].'</a>&nbsp;&nbsp;'.$row['Team_Leader_Name'].'</td>');

  echo('<td>'.$row['Subject'].'</td>');

  echo('<td style="width:400px;">'.$row['Message'].'</td>');

  echo('<td>'.$row['Respond'].'</td>');

  

  //echo('<td><input type="hidden" value="'.$row['Id'].'" class="Id"/> <a href="#_" class="UpdateBtn btn RSI-Primary">Update</a></td>');

}

echo('</tr>');

echo('</tbody>');

echo('</table>');

?>

</div>

<div class="modal fade" id="AddFreeTrail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="AddFreeTrailLabel">Send request to manager</h4>
      </div>
      <div class="modal-body">
      <!-- -->
	  <div class="alert alert-danger" style="display:none">
  <strong>Please fill required fields</strong>
</div>
       
       <input type="hidden" id="DateTime"  value="<?php echo date("Y-m-d h:i:s") ?>"/>
       <input type="hidden" id="Agent"     value="<?php  echo $_SESSION['username'];?>"/>
        <input type="hidden" id="Status"  value="Open"/>
<table width="100%"  border="0" class="table table-bordered" cellspacing="0" cellpadding="0"> <!--  -->
  <tbody>
    <tr>
      <td>To<span>*</span></td>
      <td>Subject<span>*</span></td>
      <td>Priority*</td>
      
    </tr>
    <tr>
      <td>
      	
      	  <select class="form-control" id="ToWhom">

          <?php include('partial/agents.php') ?>

          </select>
      	
      </td>
      <td><input type="text" value="" id="Subject" class="form-control" placeholder="Subject"/></td>
      <td>
       <select name="" id="Priority" class="form-control">
       	<option selected>Select level</option>
       	<option value="Low">Low</option>
       	<option value="Medium">Medium</option>
       	<option value="High">High</option>
       </select>
      </td>
      
    </tr>
    <tr>
    	<td colspan="2">Message*</td>
    	
    </tr>
    <tr>
    
    	<td colspan="2"><textarea rows="4" id="Message" class="form-control" placeholder="Message"></textarea></td>
    </tr>
  </tbody>
</table>
<!-- -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="Add">Send</button>
      </div>
    </div>
  </div>
</div>



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


var DateTime  = document.getElementById('DateTime').value
var Agent     = document.getElementById('Agent').value
var ToWhom   = document.getElementById('ToWhom').value
var Subject   = document.getElementById('Subject').value
var Priority  = document.getElementById('Priority').value
var Message   = document.getElementById('Message').value
var Status   = document.getElementById('Status').value




aa.open("GET","agent-request-back.php?DateTime="+DateTime+"&Agent="+Agent+"&ToWhom="+ToWhom+"&Subject="+Subject+"&Priority="+Priority+"&Message="+Message+"&Status="+Status,true);
aa.send();

//var aa =DateTime +' '+ Agent +' '+ Subject +' '+ Priority +' '+ Message;

//alert(aa)
setTimeout(function(){  location.reload(); }, 2000);

}



	
	
$(document).ready(function() {
	
	$('#Add').click(function() {
		
var DateTime  = document.getElementById('DateTime').value
var ToWhom     = document.getElementById('ToWhom').value
var Agent     = document.getElementById('Agent').value
var Subject   = document.getElementById('Subject').value
var Priority  = document.getElementById('Priority').value
var Message   = document.getElementById('Message').value
var Status   = document.getElementById('Status').value
		
		if(DateTime != "" && Agent != "" && ToWhom != "" && Subject != "" && Priority != "" && Message != "" && Status != "") {
		//alert('aa');
		Add();
		}
		else {
		//alert('bb');	
		$('.alert-danger').show();
			}
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
<?php include('partial/footer.php') ?>
