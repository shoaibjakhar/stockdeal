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

<title>Demo Stock Tips</title>

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
<a href="memberpage.php">Dashbord</a> | <a href="demo-customer-profile.php"  class="btn btn-xs btn-primary">Demo Customer Profile</a> | <a href="demo-stock-tips.php">Demo Stock Tips</a> 
 </div>

 

 <!-- <div class="pull-right"><a href="#" class="btn btn-md btn-primary"  data-toggle="modal" data-target="#AddCustomerProfile"><i class="fa fa-plus"></i> Existing</a></div> -->

 <!-- <div class="pull-right" style="margin-right:15px;"><a href="#" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#AddCustomerProfile"><i class="fa fa-plus"></i> New</a></div> -->

 <div class="clearfix"></div>

</div>

<div class="containter" style="padding:20px 20px 0 20px;">



<?php



$sql = ("SELECT Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, FirstName, LastName, Email_ID, Mobile_No, Location, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout, Balance_amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Demo_Customer_profile ORDER BY  `DateTime` DESC LIMIT 0 , 1000");



//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");



/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin

FROM fut_hni");*/





$result = mysqli_query($connect,$sql);



echo('<table id="Demo_Customer_profile" class="display" cellspacing="0" width="100%">');

echo('<thead>');

 echo('<tr>');

  echo('<th>Costumer ID</th>');

  echo('<th>Sale_Date</th>');

  echo('<th>First Name</th>');

  echo('<th>Last Name</th>');

  echo('<th>Email ID</th>');

  echo('<th>Mobile No</th>');

  echo('<th>Location</th>');

  echo('<th>Package_Name</th>');

  echo('<th>Activation Date</th>');

  echo('<th>Exp_Date</th>');

  echo('<th>Status</th>');

  echo('<th >Remark_for_FollowUps</th>');

  echo('<th>Paid Amout</th>');

  echo('<th>Balance amount</th>');

  echo('<th>Payment Mdoe</th>');

  echo('<th>Agent</th>');

  echo('<th>Manager</th>');

  echo('<th>Date_Time</th>');

 echo('</tr>');

echo('</thead>');

echo('<tbody>');

while($row = mysqli_fetch_array($result))

{

echo('<tr>');

 echo('<td>'.$row['Costumer_ID']./*'<form  action="demo-customer-profile-update.php" method="get"><input type="hidden" name="Costumer_ID" value="'.$row['Costumer_ID'].'"/> <input type="Submit" class="btn btn-primary btn-xs" value="Edit" style="margin-top:10px;"/></form>'.'<form  action="demo-customer-profile-delete-back.php" method="get"><input type="hidden" name="Costumer_ID" value="'.$row['Costumer_ID'].'"/> <input type="Submit" class="btn btn-danger btn-xs" value="Delete" style="margin-top:10px;"/></form>'.*/'</td>');

  echo('<td>'.$row['SaleDateIND'].'</td>');

echo('<td>'.$row['FirstName'].'</td>');

//echo('<td>'.'<a href="'.'disposition.php?Mobile='.$row['Mobile'].'Blaster&Disposition=Sale&UserName='.$username.'">'.$row['Mobile'].'</a></td>');

echo('<td>'.$row['LastName'].'</td>');



 echo('<td>'.$row['Email_ID'].'</td>');

 echo('<td>'.$row['Mobile_No'].'</td>');

 echo('<td>'.$row['Location'].'</td>');

 echo('<td>'.$row['PackageName'].'</td>');

 echo('<td>'.$row['ActivationDate'].'</td>');

 echo('<td>'.$row['ExpDate'].'</td>');

 echo('<td class="'.$row['Status'].'">'.$row['Status'].'</td>');

 echo('<td >'.$row['Remark'].'</td>');

 echo('<td>'.$row['Paid_Amout'].'</td>');

 echo('<td>'.$row['Balance_amount'].'</td>');

 echo('<td>'.$row['PaymentMode'].'</td>');

 echo('<td>'.$row['Agent'].'</td>');

 echo('<td>'.$row['Manager'].'</td>');

 echo('<td>'.$row['DateTimeConvert'].'</td>');

}

 echo('</tr>');

echo('</tbody>');

echo('</table>');





?>







</div>



</div>







<!-- Modal -->

<div class="modal fade" id="AddCustomerProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="AddCustomerProfileLabel">Customer Profile</h4>

      </div>

      <div class="modal-body">

        <div class="alert alert-danger" style="display:none">

  <strong>Please fill mandatory fields </strong>

</div>


      <!-- -->

	  <?php

$sql = "SELECT MAX(Costumer_ID) as MaximumID FROM Demo_Customer_profile";

$result = mysqli_query($connect,$sql);

?>

       <input type="hidden" id="Costumer_IDLast" value="<?php  echo mysql_result($result, 0);?>"/>

       <input type="hidden" id="DateTime"  value="<?php echo date("Y-m-d h:i:s") ?>"/>

<table width="100%"  border="0" class="table table-bordered" cellspacing="0" cellpadding="0"> <!--  -->

  <tbody>

    <tr>

      <td>Sale Date*</td>

      <td>First Name*</td>

      <td>Last Name</td>

    </tr>

    <tr>

      <td>

      <input type="hidden" value="" id="Costumer_ID" class="form-control" placeholder="Costumer ID" disabled/>



        <input type="text" value="" id="SaleDate" class="form-control" placeholder="Sale Date"/>

       <input type="hidden" value="" id="altSaleDate" class="form-control" placeholder="alt Sale Date"/>

      </td>

      <td><input type="text" value="" id="FirstName" class="form-control" placeholder="First Name"/></td>

      <td><input type="text" value="" id="LastName" class="form-control" placeholder="Last Name"/></td>

    </tr>

    <tr>

      <td>Email ID</td>

      <td>Mobile No*</td>

      <td>Location</td>

    </tr>

    <tr>

      <td><input type="text" value="" id="Email_ID" class="form-control" placeholder="Email ID"/></td>

      <td><input type="text" value="" id="Mobile_No" class="form-control" placeholder="Mobile No"/></td>

      <td>

      <select class="form-control" id="Location">

            <option value="">Select State</option>

           <?php include('partial/State.php') ?>

          </select>

          

          

      </td>

    </tr>

    <tr>

      <td>Package Name*</td>

      <td>Activation Date</td>

      <td>Expired Date</td>

    </tr>

    <tr>

      <td>

     

      <select class="form-control" id="PackageName">

            <option value="">Select Package</option>

           <?php include('partial/segments.php') ?>

          </select>

      </td>

      <td>

       <input type="text" value="" id="Activation_Date" class="form-control" placeholder="Activation Date"/>

       <input type="hidden" value="" id="altActivation_Date" class="form-control" placeholder="Activation Date"/>

      </td>

      <td>

       <input type="text" value="" id="Exp_Date" class="form-control" placeholder="Expired Date"/>

       <input type="hidden" value="" id="altExp_Date" class="form-control" placeholder="Expired Date"/>

      </td>

    </tr>

    <tr>

      <td>Remark*</td>

      <td>Paid Amout*</td>

      <td>Balance Amount*</td>

    </tr>

    <tr>

      <td><input type="text" value="" id="Remark" class="form-control" placeholder="Remark"/></td>

      <td><input type="text" value="" id="Paid_Amout" class="form-control" placeholder="Paid Amout"/></td>

      <td><input type="text" value="" id="Balance_amount" class="form-control" placeholder="Balance Amount"/></td>

    </tr>

    <tr>

      <td>Payment Mode*</td>

      <td>Agent*</td>

      <td>Manager*</td>

    </tr>

    <tr>

      <td>

         <select class="form-control" id="PaymentMode">

       

           <?php include('partial/payment_mode.php') ?>

          </select>

      

      </td>

      <td>

      <select class="form-control" id="Agent">

          <?php include('partial/agents.php') ?>

          </select>

      </td>

      <td>

      

      <select class="form-control" id="Manager">

          <?php include('partial/manager.php') ?>

          </select>

      </td>

    </tr>

  </tbody>

</table>

<!-- -->

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="button" class="btn btn-primary" id="Add">Add</button>

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





var Costumer_ID  = document.getElementById('Costumer_ID').value

var altSaleDate  = document.getElementById('altSaleDate').value

var FirstName  = document.getElementById('FirstName').value

var LastName  = document.getElementById('LastName').value

var Email_ID  = document.getElementById('Email_ID').value

var Mobile_No  = document.getElementById('Mobile_No').value

var Location  = document.getElementById('Location').value

var PackageName  = document.getElementById('PackageName').value

var altActivation_Date  = document.getElementById('altActivation_Date').value

var altExp_Date  = document.getElementById('altExp_Date').value

var Remark  = document.getElementById('Remark').value

var Paid_Amout  = document.getElementById('Paid_Amout').value

var Balance_amount  = document.getElementById('Balance_amount').value

var PaymentMode  = document.getElementById('PaymentMode').value

var Agent  = document.getElementById('Agent').value

var Manager  = document.getElementById('Manager').value

var DateTime  = document.getElementById('DateTime').value





/*

var aa = Costumer_ID +' '+ altSaleDate  +' '+ FirstName +' '+ LastName +' '+ Email_ID +' '+ Mobile_No +' '+ Location +' '+ PackageName +' '+ altActivation_Date +' '+ altExp_Date +' '+ Remark +' '+ Paid_Amout +' '+ Balance_amount +' '+ PaymentMode +' '+ Agent +' '+ Manager +' '+DateTime ;

alert(aa)*/





aa.open("GET","demo-customer-profile-add.php?Costumer_ID="+Costumer_ID+"&altSaleDate="+altSaleDate+"&FirstName="+FirstName+"&LastName="+LastName+"&Email_ID="+Email_ID+"&Mobile_No="+Mobile_No+"&Location="+Location+"&PackageName="+PackageName+"&altActivation_Date="+altActivation_Date+"&altExp_Date="+altExp_Date+"&Remark="+Remark+"&Paid_Amout="+Paid_Amout+"&Balance_amount="+Balance_amount+"&Balance_amount="+Balance_amount+"&PaymentMode="+PaymentMode+"&Agent="+Agent+"&Manager="+Manager+"&DateTime="+DateTime,true);

aa.send();







setTimeout(function(){  location.reload(); }, 1000);



}







	

	

$(document).ready(function() {

	/*

	$('#Add').click(function() {

		 Add();

	});

	*/

	

	

	$('#Add').click(function() {

		

var Costumer_ID  = document.getElementById('Costumer_ID').value

var altSaleDate  = document.getElementById('altSaleDate').value

var FirstName  = document.getElementById('FirstName').value

var LastName  = document.getElementById('LastName').value

var Email_ID  = document.getElementById('Email_ID').value

var Mobile_No  = document.getElementById('Mobile_No').value

var Location  = document.getElementById('Location').value

var PackageName  = document.getElementById('PackageName').value

var altActivation_Date  = document.getElementById('altActivation_Date').value

var altExp_Date  = document.getElementById('altExp_Date').value

var Remark  = document.getElementById('Remark').value

var Paid_Amout  = document.getElementById('Paid_Amout').value

var Balance_amount  = document.getElementById('Balance_amount').value

var PaymentMode  = document.getElementById('PaymentMode').value

var Agent  = document.getElementById('Agent').value

var Manager  = document.getElementById('Manager').value

var DateTime  = document.getElementById('DateTime').value

	

	//alert(altSaleDate)

		

		if(Costumer_ID != "" && FirstName != "" && Mobile_No != "" && PackageName != "" && Remark != "" && Paid_Amout != "" && Balance_amount != "" && PaymentMode != "" && Agent != "" && Manager != "" && DateTime != "") {

		//alert('aa');

		Add();

		}

		else {

		//alert('bb');	

		//Add();

		$('.alert-danger').show();

			}

	});

	

	

$( "#Activation_Date" ).datepicker({

	dateFormat: 'dd-mm-yy', 

    altField  : '#altActivation_Date',

    altFormat : 'yy-mm-dd',

    format    : 'yy-mm-dd'

	

});



$( "#SaleDate" ).datepicker({

	dateFormat: 'dd-mm-yy', 

    altField  : '#altSaleDate',

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