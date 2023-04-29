<?php  include('partial/session_start.php'); ?>


<?php
if(isset($_GET['UserName']) && isset($_GET['Source']) && isset($_GET['Disposition'])){
     $UserName = $_GET['UserName'];
     $Source = $_GET['Source'];
     $Disposition = $_GET['Disposition'];
}
 
date_default_timezone_set('Asia/Kolkata');
 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>	Quality &amp; Compliance</title>
<?php require('partial/plugins.php'); ?>
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
  <a href="memberpage.php">Dashbord</a> | <a href="quality-analysis.php" class="btn btn-xs btn-primary">Quality &amp; Compliance </a>  | <a href="quality-analysis-others.php" class="">Others</a> | 
  <a onclick="return confirmation()" href="offer-letter-functions.php?Id=<?php echo $_SESSION["Id"]?>" class="btn btn-sm"><i class="fa fa-send"></i> Request For Offer Letter</a> 
 </div>
 <!-- <div class="pull-right"><a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a></div> -->
 <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>
<?php
$sql = ("SELECT Quality_Column_1, Quality_Column_2 FROM `Options` where Quality_Column_2 IS NOT NULL");
$result = mysqli_query($connect,$sql);

echo('<table cellspacing="0" cellpadding="0" class="table table-bordered">');
echo('<tbody>');
 echo('<tr  class="brand-color-bg">');

  
  echo('<th>CRM</th>');
  echo('<th>Quality &amp; Compliance</th>');

  echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
  echo('<td>'.$row['Quality_Column_1'].'</td>');
  echo('<td>'.$row['Quality_Column_2'].'</td>');

  
 // echo('<td><input type="hidden" value="'.$row['Id'].'"'. 'class="id"/>'.'<a href="#_"' . 'class="btn btn-danger">Delete</a>'.'</td>');
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