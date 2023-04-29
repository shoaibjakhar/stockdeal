<?php  include('partial/session_start.php'); ?>
<?php
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
 $UserNameSession = $username;
 
 
global $users;
$users = $username;
function getShared($id){
    //echo $id;
    global $users;
    global $connect;
     $sel = "select Agent_1,Agent,Agent_2,Agent_3,Agent_1_Shared_Amount,Agent_2_Shared_Amount,Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";
     $qry = mysqli_query($connect,$sel);
      while($row = mysqli_fetch_assoc($qry)){
         if($users != $row['Agent']){
           // continue;
         }
         else{
             $am = $row['Agent_1_Shared_Amount'];  
         }
        if($users != $row['Agent_1']){
           // continue;
        }
        else{
           $am = $row['Agent_1_Shared_Amount']; 
        }
        if($users != $row['Agent_2']){
           // continue;
        }
        else{
            $am = $row['Agent_2_Shared_Amount'];  
        }
        if($users != $row['Agent_3']){
           // continue;
        }
        else{
            $am = $row['Agent_3_Shared_Amount'];  
        }
     }
     return $am;
    
}


 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Customer Profile </title>
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
<a href="memberpage.php">Dashbord</a> | <a href="customer-profile.php" class="btn btn-xs btn-primary">Paid Customers</a> | <a href="customer-profile.php">Search Customer by number</a></div>
 <!-- <div class="pull-right"><a href="#" class="btn btn-md btn-primary"  data-toggle="modal" data-target="#AddCustomerProfile"><i class="fa fa-plus"></i> Existing</a></div> -->
 <!-- 
 <div class="pull-right" style="margin-right:15px;"><a href="#" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#AddCustomerProfile"><i class="fa fa-plus"></i> New</a></div>
-->

 <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>
<?php
 $sql = ("SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_Payment_History where  (Agent = '".$UserNameSession."' or Agent_1 = '".$UserNameSession."' or Agent_2 = '".$UserNameSession."' or Agent_3 = '".$UserNameSession."') && MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) ORDER BY  `Costumer_ID` DESC");
//Agent = '".$UserNameSession."'
//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");
/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
FROM fut_hni");*/
$result = mysqli_query($connect,$sql);
echo('<table id="Customer_profile" class="display" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  //echo('<th>Costumer ID</th>');
  echo('<th>Sale_Date</th>');
  echo('<th>Full Name</th>');
 // echo('<th>Last Name</th>');
 
  echo('<th>Mobile No</th>');
  //echo('<th>Location</th>');
  echo('<th>Package_Name</th>');
  echo('<th>Activation Date</th>');
  echo('<th>Exp_Date</th>');
  echo('<th>Status</th>');
  echo('<th>Remark for FollowUps</th>');
  echo('<th>Total Amount Received</th>');
  echo("<th>Shared Amount</th>");
  echo('<th>Tax</th>');
  //echo('<th>Balance amount</th>');
  echo('<th>Payment Mode</th>');
	 echo('<th>Email ID</th>');
  echo('<th>Agent</th>');
  //echo('<th>Manager</th>');
  //echo('<th>Date_Time</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
// echo('<td>'.$row['Costumer_ID'].'</td>');
  echo('<td>'.$row['SaleDateIND'].'</td>');
echo('<td>'.$row['Full_Name'].'</td>');
//echo('<td>'.'<a href="'.'disposition.php?Mobile='.$row['Mobile'].'Blaster&Disposition=Sale&UserName='.$username.'">'.$row['Mobile'].'</a></td>');
//echo('<td>'.$row['LastName'].'</td>');

 echo('<td>'.$row['Mobile_No'].'</td>');
 //echo('<td>'.$row['Location'].'</td>');
 echo('<td>'.$row['PackageName'].'</td>');
 echo('<td>'.$row['ActivationDate'].'</td>');
 echo('<td>'.$row['ExpDate'].'</td>');
 echo('<td class="'.$row['Status'].'">'.$row['Status'].'</td>');
 echo('<td >'.$row['Remark'].'</td>');
 echo('<td >'.$row['Paid_Amout'].'</td>');
 echo('<td >'.getShared($row["id"]).'</td>');
 echo('<td>'.$row['Tax_Amount'].'</td>');
 //echo('<td>'.$row['Balance_amount'].'</td>');
 echo('<td>'.$row['PaymentMode'].'</td>');
	 echo('<td>'.$row['Email_ID'].'</td>');
 echo('<td>'.$row['Agent'].'</td>');
 //echo('<td>'.$row['Manager'].'</td>');
 //echo('<td>'.$row['DateTimeConvert'].'</td>');
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
aa.open("GET","customer-profile-add.php?Costumer_ID="+Costumer_ID+"&altSaleDate="+altSaleDate+"&FirstName="+FirstName+"&LastName="+LastName+"&Email_ID="+Email_ID+"&Mobile_No="+Mobile_No+"&Location="+Location+"&PackageName="+PackageName+"&altActivation_Date="+altActivation_Date+"&altExp_Date="+altExp_Date+"&Remark="+Remark+"&Paid_Amout="+Paid_Amout+"&Balance_amount="+Balance_amount+"&Balance_amount="+Balance_amount+"&PaymentMode="+PaymentMode+"&Agent="+Agent+"&Manager="+Manager+"&DateTime="+DateTime,true);
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