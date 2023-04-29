<?php  include('partial/session_start.php'); ?>

<?php
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
 

 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Send SMS</title>
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

</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">
 <div class="pull-left">
  <a href="memberpage.php">Dashbord</a> | <a href="#" class="btn btn-xs btn-primary">Send SMS</a> 
 </div>
 
 <div class="clearfix"></div>
</div>

 <div class="clearfix"></div>
 <div class="cont-area" style="margin:20px;">
<div class="" style="margin-bottom:20px;">
  
  <div class="btn-group">
    <a href="send-sms-1.php" class="btn btn-default">SMS Services One</a>
    <a href="send-sms-1.php" class="btn btn-primary">SMS Services Two</a>
  </div>
</div>

<?php

$sel = "select Id,SMS_Subject,SMS_Body,SMS_Body_Print from Options where SMS_Subject != '' ";
$qry = mysqli_query($connect, $sel);
while($row = mysqli_fetch_assoc($qry)){
    $smsdata[] = $row;
}

$sel = "select Sender_ID from Options where Id = '1' ";
$qry = mysqli_query($connect, $sel);
$Sender_IDs = mysqli_fetch_assoc($qry);
if($Sender_IDs){
    $Sender_ID = $Sender_IDs['Sender_ID'];
}
else{
    $Sender_ID = '';
}






?>
<div class="">
	<div class="row">
		<div class="col-sm-4">
	<form method="get" action="send-sms-back-1.php" target="_blank" id="SendSMS">
	  <input type="hidden" name="sender_id" value="<?php echo $Sender_ID; ?>"/>
	<input type="text" name="Mobile" value="" placeholder="Enter Mobile Number" class="form-control" required><br/>
	<select name="" id="Type" class="form-control" required>
 <option value="">Select Template</option>
 <?php
 
    foreach($smsdata as $sms){
        if($sms['Id'] == 13){
            echo ' <option id="'.$sms["SMS_Body"].' '.$sms["SMS_Body_Print"].'?t='.time().'" value="'.$sms["SMS_Body"].' '.$sms["SMS_Body_Print"].'?t='.time().'">'.$sms["SMS_Subject"].'</option>';
            continue;
        }
        echo ' <option id="'.$sms["SMS_Body"].'" value="'.$sms["SMS_Body_Print"].'">'.$sms["SMS_Subject"].'</option>';
    }
 
 ?>

 

		
		
 

 
</select><br/>

	
	<input type="text" value=""  class="form-control" name="Message" id="Message"  style="display:none;"/>
	<br/>
	<div id="MessageDisable" style="border: #ccc solid 1px;  width: 100%; height: 256px;padding:10px; margin-bottom: 20px;"></div>
	<input type="submit" value="SEND" id="Send" class="btn btn-primary"><br/>
</form>

<h1 style="display: none" id="MessageSent">Message sent</h1>
		</div>
	</div>
</div>



</div>
</div>



<?php include('partial/footer.php') ?>

<script type="text/javascript">
	
$(document).ready(function() {

	$('#Type').change(function(e) {
var Body = $(this).val();
var Body_print = $(this).find('option:selected').attr('id');
if(Body_print == ''){
  $('#Message').val('');
     $('#MessageDisable').html('');   
}
else{
     $('#Message').val(Body_print);
     $('#MessageDisable').html(Body);
     
}


/*		
if (Type === '1') {
 $('#Message').val('Bank Name : AXIS BANK Payee Name : Real Stock Ideas. Bank A/C NO : 917020075893771. Bank IFSC Code : UTIB0002458. Bank Address : MAHAPE NAVI MUMBAI - 400709.');
 $('#MessageDisable').html('Bank Name : AXIS BANK<br/>Payee Name : Real Stock Ideas. Bank A/C NO : 917020075893771. Bank IFSC Code : UTIB0002458. Bank Address : MAHAPE NAVI MUMBAI - 400709.');	
}
		
if (Type === '2') {
 $('#Message').val('Bank Name : HDFC BANK\n Payee Name : Real Stock Ideas.\n Bank A/C NO : 50200021126311.\nBank IFSC Code : HDFC0001602.\n Bank Address : Shop 1 Gr Flr, Technocity, Plot X4/5, TTC Industrial area, Mahape, Shil Phata - Mahape Rd, T.T.C. Industrial Area, MIDC Industrial Area, Navi Mumbai, Maharashtra 400701.');
 $('#MessageDisable').html('Bank Name : HDFC BANK<br/>Payee Name : Real Stock Ideas.<br/> Bank A/C NO : 50200021126311.<br/> Bank IFSC Code : HDFC0001602.<br/> Bank Address : Shop 1&2, Gr Flr, Technocity, Plot X4/5, TTC Industrial area, Mahape, Shil Phata - Mahape Rd, T.T.C. Industrial Area, MIDC Industrial Area, Navi Mumbai, Maharashtra 400701.');	
}
else if (Type === '3') {
 $('#Message').val('Bank Name: ICICI BANK DETAILS\n Payee Name:Real Stock Ideas.\n Bank A/C no:056405500261.\n Bank IFSC code:ICIC0000564.\n Bank address: ICICI BANK LTD,plot no X-513 technocity,Next to Sarovar Portico, Mahape Navi Mumbai - 400701.\n contact us on 022 49180000');
 $('#MessageDisable').html('Bank Name: ICICI BANK DETAILS<br/> Payee Name:Real Stock Ideas.<br/> Bank A/C no:056405500261.<br/> Bank IFSC code:ICIC0000564.<br/> Bank address: ICICI BANK LTD,plot no X-513 technocity,Next to Sarovar Portico, Mahape Navi Mumbai - 400701.<br/> contact us on 022 49180000');	
}	

else if (Type === '4') {
 $('#Message').val('Dear Customer,\n Below mentioned is our website address :\n www.realstockideas.in\n Regards,\n RSI TEAM.');
 $('#MessageDisable').html('Dear Customer,<br/> Below mentioned is our website address :<br/> www.realstockideas.in<br/> Regards,<br/>RSI TEAM.');	
}	

else if (Type === '5') {
 $('#Message').val('Dear Subscriber,\n kindly submit your KYC Document in case if you have not submitted,\n you can forward your documents (Copy of Pan-card and Aadhar Card is Mandatory as per guidelines) Mail it at sales@realstockideas.in for any query\n contact us at :022 49180000');
 $('#MessageDisable').html('Dear Subscriber,<br/> kindly submit your KYC Document in case if you have not submitted,<br/> you can forward your documents (Copy of Pan-card and Aadhar Card is Mandatory as per guidelines) Mail it at sales@realstockideas.in for any query<br/> contact us at :022 49180000');	
}	
		
else if (Type === '6') {
 $('#Message').val('Dear Subscriber,\n Now you can also View Ideas Online using Login Id and Password , To View Ideas Online , Request for Login id and Password at support@realstockideas.in\n Regards, RSI TEAM.');
 $('#MessageDisable').html('Dear Subscriber,<br/> Now you can also View Ideas Online using Login Id and Password , To View Ideas Online , Request for Login id and Password at support@realstockideas.in <br/> Regards, RSI TEAM.');	
}

else if (Type === '7') {
 $('#Message').val('Dear Subscriber,\n You Just spoke to our Representative, Request You to share your valuable feedback at 9594242668 or email at compliance@realstockideas.in\n Regards,\n Quality Assurance Team.\n www.realstockideas.in');
 $('#MessageDisable').html('Dear Subscriber,\n You Just spoke to our Representative, Request You to share your valuable feedback at 9594242668 or email at compliance@realstockideas.in\n Regards,\n Quality Assurance Team.\n www.realstockideas.in');	
}		

else if (Type === '8') {
 $('#Message').val('Dear Customer,\n Service Activation Link is sent to your registered email id,\n Kindly Click to the link to activate your services.\n For any Quires contact us at 02249180000.\n Regards,\n RSI TEAM');
 $('#MessageDisable').html('Dear Customer,<br/> Service Activation Link is sent to your registered email id,<br/> Kindly Click to the link to activate your services.<br/> For any Quires contact us at 02249180000.<br/> Regards,<br/> RSI TEAM  ');	
}		

else if (Type === '9') {
 $('#Message').val('Dear Subcriber,\n To start the services through sms type START  RSIDEA to 7738098600,\n Regards,\n RSI TEAM Contact\n - 022 49180000');
 $('#MessageDisable').html('Dear Subcriber,\n To start the services through sms type START RSIDEA to 7738098600,\n Regards,\n RSI TEAM Contact\n - 022 49180000');	
}
		
else if (Type === '10') {
 $('#Message').val('Dear Subscriber,\n Please get you risk profling done.\n click on the link below\nhttps://www.realstockideas.in/risk-profile/\n Regards,\n RSI TEAM\n Tel : 02249180000\n www.realstockideas.in');
 $('#MessageDisable').html('Dear Subscriber,\n Please get you risk profling done.\n click on the link below\nhttps://www.realstockideas.in/risk-profile/\n Regards,\n RSI TEAM\n Tel : 02249180000\n www.realstockideas.in');	
}
*/

		
});
	
$('#Send').click(function() {
 //$('#SendSMS').hide();
 //$('#MessageSent').show();
 });
});
	
	// \n  <br/>
	
</script>









 


 




