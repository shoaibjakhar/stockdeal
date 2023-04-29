<?php  include('partial/session_start.php'); ?>
<?php

  include('connection/dbconnection_crm.php');
  $result_update = mysqli_query($connect,"UPDATE Agent_request SET read_bit='1' where ToWhom = 'Akshay Shetty' ");
?>

<?php
 // $UserName = $_GET['UserName'];
 // $Source = $_GET['Source'];
 // $Disposition = $_GET['Disposition'];
 

 
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
  <?php
// function definition is written in hearder-top.php
// if agent bank details are missing, will redirect on agent login details page
check_agent_bank_details();
?>
</header>
<div class="breadcurms">
 <div class="pull-left">
  <!--<a href="memberpage.php">Dashbord</a> | <a href="agent-request-received.php" class="btn btn-xs btn-primary">Received</a> | <a href="agent-request-sent.php">Sent</a> |  <a href="employee-login-details.php">Agent login details</a>-->
  <a href="memberpage.php">Dashbord</a> | <a href="agent-request-received.php" class="btn btn-xs btn-primary">Received</a> | <a href="agent-request-sent.php">Sent</a> | <a href="employee-login-details.php" >Agent login details</a> 
  <?php if($_SESSION['Role'] == 'Super Admin'){ ?>
  | <a href="employee-login-details.php?filter=admin" >Team Leader login details</a>
  | <a href="sr-tl-login-details.php?filter=admin" >SR Team Leader login details</a>
  <?php }
  ?>

  <?php
  
  if($_SESSION['Role'] == 'Super Admin') {
      
    //echo(' ');   
  }
  
  ?> 
 </div>
 
 <div class="clearfix"></div>
</div>

<div class="containter" style="padding:20px 20px 0 20px;">



<?php

include('connection/dbconnection_crm.php');


if(isset($_GET['filter']) && $_GET['filter'] != ''){
     $sql = ("SELECT Id,  DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DateTimeConvert, Agent, ToWhom, Subject, Priority, Message, Respond, Status, Customer_Name, Mobile, Paid_Amount, AmountPaidDate, Package, Duration,  Risk_Profile_Score, KYC, Done, Mode_of_Payment,TL_Status,Team_Leader_Name  FROM Agent_request where Status = 'Close' AND TL_Status = 'Open' AND  (Team_Leader_Name = '".$_SESSION['username']."') ORDER BY  `Id` DESC");
}
else{
    $sql = ("SELECT Id,  DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DateTimeConvert, Agent, ToWhom, Subject, Priority, Message, Respond, Status, Customer_Name, Mobile, Paid_Amount, AmountPaidDate, Package, Duration,  Risk_Profile_Score, KYC, Done, Mode_of_Payment,TL_Status,Team_Leader_Name  FROM Agent_request where  (Team_Leader_Name = '".$_SESSION['username']."') ORDER BY  `Id` DESC");
}

$result = mysqli_query($connect,$sql);
echo('<table id="Agent_request" class="display" cellspacing="0" width="100%">');

echo('<thead>');

 echo('<tr>');


echo('<th>Update</th>');
  echo('<th>Date</th>');

	echo('<th>From</th>');
	
		echo('<th>Team Leader</th>');
		
			
		

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
if($row['TL_Status'] == 'Open' && $row['Status'] == 'Close'){
echo('<td><input type="hidden" value="'.$row['Id'].'" class="Id"/> <a href="#_" class="UpdateBtn btn btn btn-xs RSI-Primary ">Update</a></td>');
}
else{
    echo '<td></td>';
}
  echo('<td>'.$row['DateTimeConvert'].'</td>');

  echo('<td><a href="#_" class="btn btn-xs '.$row['Status'].'">'.$row['Status'].'</a>&nbsp;&nbsp;'.$row['Agent'].'</td>');


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




<div class="modal fade" id="UpdateStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="AddFreeTrailLabel">Update request</h4>
      </div>
      <div class="modal-body">
      <!-- -->
	  <div class="alert alert-danger" style="display:none">
  <strong>Please fill required fields</strong>
</div>
       
       
<table width="100%"  border="0" class="table table-bordered" cellspacing="0" cellpadding="0"> <!--  -->
  <tbody>
    <tr>
     
      <td>Status*</td>
      
    </tr>
    <tr>
      
     
      <td>
      <input type="hidden" value="" id="Id" >
       <select name="" id="StatusRespond" class="form-control">
    	
       	<option value="Open">Open</option>
       	<option value="Close">Close</option>
       	<option value="Decline">Decline</option>
       </select>
      </td>
      
    </tr>
    <tr>
    	<td colspan="2">Message*</td>
    	
    </tr>
    <tr>
    
    	<td colspan="2"><textarea rows="4" id="Respond" class="form-control" placeholder="Message"></textarea></td>
    </tr>
  </tbody>
</table>
<!-- -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="Update">Update</button>
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



var Id  = document.getElementById('Id').value
var Respond   = document.getElementById('Respond').value
var StatusRespond   = document.getElementById('StatusRespond').value




aa.open("GET","agent-request-update.php?Id="+Id+"&Respond="+Respond+"&StatusRespond="+StatusRespond,true);
aa.send();

//var aa =Id +' '+ Respond +' '+ StatusRespond;
//alert(aa)

setTimeout(function(){  location.reload(); }, 2000);
}


	
	
	
	$('.UpdateBtn').click(function(){
	 $('#UpdateStatus').modal('show');
	 var Id = $(this).closest('tr').find('.Id').val(); 
	 var StatusRespond = $(this).closest('tr').find('.Status').text();
     var Respond = $(this).closest('tr').find('.Respond').text();
	
	$('#Id').val(Id)
	$('#StatusRespond').val(StatusRespond)
	$('#Respond').val(Respond)
		
		//alert(Id+Respond+Status)
	});

	
	$('#Update').click(function(){
		
	var Respond   = document.getElementById('Respond').value
     var StatusRespond   = document.getElementById('StatusRespond').value
		
		if(StatusRespond != "" && Respond != "") {
		//alert('aa');
		Add();
		}
		else {
		//alert('bb');	
		$('.alert-danger').show();
			//alert('asdf')
			}
		
		
	});  
	
	
	
	
	
	
});
</script>
<?php include('partial/footer.php') ?>
