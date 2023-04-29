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
<title>Terms and conditions</title>
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
  <a href="memberpage.php">Dashbord</a> | <a href="follow-up-history.php" class="btn btn-xs btn-primary">Terms and conditions accepted </a>  | <a href="quality-analysis.php" class="">Quality &amp; Compliance</a> | <a href="quality-analysis-others.php"> Others</a>
 </div>
 <!-- <div class="pull-right"><a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a></div> -->
 <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>
<?php

$sql = ("SELECT * FROM packageactivation ORDER BY  `id` DESC LIMIT 0 , 1000 ");

//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");

/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
FROM fut_hni");*/


$result = mysqli_query($connect, $sql);

echo('<table id="FollowUpHistory" class="display" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Full Name</th>');
  echo('<th>Mobile</th>');
  echo('<th>Package Name</th>');
  echo('<th>Remote Address</th>');
  echo('<th>Terms and conditions accepted</th>');
  echo('<th>Current Date</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
  echo('<td>'.$row['Full_Name'].'</td>');
  echo('<td>'.$row['Mobile'].'</td>');
  echo('<td>'.$row['Packagename'].'</td>');
  echo('<td>'.$row['remoteAddress'].'</td>');
  echo('<td>'.$row['terms_and_conditions_accepted'].'</td>');
  echo('<td>'.$row['CurrentDate'].'</td>');
}
 echo('</tr>');
echo('</tbody>');
echo('</table>');


?>



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