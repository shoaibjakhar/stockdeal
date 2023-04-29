<?php  include('partial/session_start.php'); ?>
<?php

//session_start();

 //$username = $username;

//  echo $username;exit;

//include('partial/validate-user.php');

//include('connection/dbconnection_crm.php');

$result_update = mysqli_query($connect,"UPDATE Agent_request SET read_bit='1' where ToWhom = '$username' ");



?>



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

<title>Agent Request</title>

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

  <a href="memberpage.php">Dashbord</a> | <a href="agent-request-received.php" class="btn btn-xs btn-primary">Received</a> | <a href="agent-request-sent.php">Sent</a> 

 </div>

 

 <div class="clearfix"></div>

</div>



<div class="containter" style="padding:20px 20px 0 20px;">



<?php







$sql = ("SELECT Id,  DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DateTimeConvert, Agent, ToWhom, Subject, Priority, Message, Respond, Status, TL_Status, Customer_Name, Mobile, Paid_Amount, Package, Duration,  Risk_Profile_Score, KYC, Done, Team_Leader_Name  FROM Agent_request where (ToWhom = '".$username."' && Status='Open') ORDER BY  `Id` DESC");


//echo($sql);



//Agent = '".$UserNameSession."'

	

	

	

//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");







/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin



FROM fut_hni");*/











$result = mysqli_query($connect,$sql);







echo('<table id="Agent_request" class="display" cellspacing="0" width="100%">');

echo('<thead>');

 echo('<tr>');


echo('<th>Update</th>');
  echo('<th>Date</th>');

	echo('<th>From</th>');
	
		echo('<th>Team Laeder</th>');
		
			
		

  echo('<th>Subject</th>');

  //echo('<th>Customer_Name</th>');

  //echo('<th>Mobile</th>');

  //echo('<th>Paid_Amount</th>');

  //echo('<th>AmountPaidDate</th>');

  //echo('<th>Package</th>');

  //echo('<th>Duration</th>');

  //echo('<th>Risk_Profile_Score</th>');

  //echo('<th>KYC</th>');

  //echo('<th>Mode of Payment</th>');

	

  echo('<th style="width:250px;">Message</th>');

  echo('<th>Respond</th>');

  //echo('<th>Update</th>');

 echo('</tr>');

echo('</thead>');

echo('<tbody>');

while($row = mysqli_fetch_array($result))

{

echo('<tr>');

echo('<td><input type="hidden" value="'.$row['Id'].'" class="Id"/> <a href="#_" class="UpdateBtn btn btn btn-xs RSI-Primary '.$row['Done'].'">Update</a></td>');

  echo('<td>'.$row['DateTimeConvert'].'</td>');

  echo('<td><a href="#_" class="btn btn-xs '.$row['Status'].'">'.$row['Status'].'</a>&nbsp;&nbsp;'.$row['Agent'].'</td>');
    echo('<td><a href="#_" class="btn btn-xs '.$row['TL_Status'].'">'.$row['TL_Status'].'</a>&nbsp;&nbsp;'.$row['Team_Leader_Name'].'</td>');

  echo('<td>'.$row['Subject'].'</td>');

 // echo('<td>'.$row['Customer_Name'].'</td>');

  //echo('<td>'.$row['Mobile'].'</td>');

  //echo('<td>'.$row['Paid_Amount'].'</td>');

  //echo('<td>'.date( 'd-m-Y', strtotime($row['AmountPaidDate'])).'</td>');

  //echo('<td>'.$row['Package'].'</td>');

  //echo('<td>'.$row['Duration'].'</td>');

  //echo('<td>'.$row['Risk_Profile_Score'].'</td>');

  //echo('<td>'.$row['KYC'].'</td>');

	//echo('<td>'.$row['Mode_of_Payment'].'</td>');

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
        <option value="In Progress">In Progress</option>
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

