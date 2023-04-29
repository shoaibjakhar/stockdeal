<?php  include('partial/session_start.php'); ?>


<?php
 /*$UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];*/
 
  $Costumer_ID = $_GET['Costumer_ID'];

 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sales Agent Wise</title>
<?php require('partial/plugins.php'); ?>
<style>

.dataTables_filter { display:none;}
</style>
</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">
 <a href="demo-customer-profile.php">Customer Profile</a> 
</div>
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>
<?php


//$sql = "SELECT Agent, Manager, SUM( Paid_Amout ) AS SalesAgentWise FROM Demo_Customer_profile GROUP BY `Agent` ORDER BY `SalesAgentWise` DESC LIMIT 0, 30 ";

$sql ="SELECT * FROM  `Demo_Customer_profile` WHERE  `Costumer_ID` = '".$Costumer_ID."' " ;


/*$sql = ("SELECT Costumer_ID, FirstName, LastName, Email_ID, Mobile_No, Location, PackageName, DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , Remark, Paid_Amout, Balance_amount, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DateTime FROM Demo_Customer_profile");*/

//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");

/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
FROM fut_hni");*/

$result = mysqli_query($connect,$sql);

echo('<table id="" class="table" cellspacing="0" width="100%">');
echo('<tbody>');
	echo('<form  action="demo-customer-profile-update-back.php" method="get">');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
 echo('<td>'.'Sale Date*'.'</td>');
 echo('<td>'.'First Name'.'</td>');
 echo('<td>'.'Last Name'.'</td>');
 echo('<td>'.'Email ID'.'</td>');
echo('</tr>');
echo('<tr>');
 echo('<td>'.'<input type="hidden" name="Costumer_ID" value="'.$row['Costumer_ID'].'" class="form-control"/><input type="text" id="SaleDate" value="'.$row['SaleDate'].'" class="form-control"/><input type="text" name="altSaleDate" id="altSaleDate"  value="'.$row['SaleDate'].'" class="form-control" style="display:none"/>'.'</td>');
 echo('<td>'.'<input type="text" name="FirstName" value="'.$row['FirstName'].'" class="form-control"/>'.'</td>');
 echo('<td>'.'<input type="text" name="LastName" value="'.$row['LastName'].'" class="form-control"/>'.'</td>');
 echo('<td>'.'<input type="text" name="Email_ID" value="'.$row['Email_ID'].'" class="form-control"/>'.'</td>');
echo('</tr>');
echo('<tr>');
 echo('<td>'.'Mobile No'.'</td>');
 echo('<td>'.'Location'.'</td>');
 echo('<td>'.'Package Name*'.'</td>');
 echo('<td>'.'Activation Date'.'</td>');
echo('</tr>');
echo('<tr>');
 echo('<td>'.'<input type="text" name="Mobile_No" value="'.$row['Mobile_No'].'" class="form-control"/>'.'</td>');
 echo('<td>'.'<input type="text" name="Location" value="'.$row['Location'].'" class="form-control"/>'.'</td>');
 echo('<td>'.'<input type="text" name="PackageName" value="'.$row['PackageName'].'" class="form-control PackageName" style="display:none"/><p class="PackageName form-control">'.$row['PackageName'].'</p>'.'</td>');
 echo('<td>'.'<input type="text" id="Activation_Date" value="'.$row['Activation_Date'].'" class="form-control"/><input type="text" name="altActivation_Date" id="altActivation_Date" value="'.$row['Activation_Date'].'" class="form-control" style="display:none"/>'.'</td>');
echo('</tr>');
echo('<tr>');
 echo('<td>'.'Exp Date'.'</td>');
 echo('<td>'.'Remark'.'</td>');
 echo('<td>'.'Paid Amout'.'</td>');
 echo('<td>'.'Balance amount'.'</td>');
echo('</tr>');
echo('<tr>');
 echo('<td>'.'<input type="text" id="Exp_Date" value="'.$row['Exp_Date'].'" class="form-control"/><input  style="display:none" type="text" name="altExp_Date" id="altExp_Date" value="'.$row['Exp_Date'].'" class="form-control"/>'.'</td>');
 echo('<td>'.'<input type="text" name="Remark" value="'.$row['Remark'].'" class="form-control"/>'.'</td>');
 echo('<td>'.'<input type="text" name="Paid_Amout" value="'.$row['Paid_Amout'].'" class="form-control"/>'.'</td>');
 echo('<td>'.'<input type="text" name="Balance_amount" value="'.$row['Balance_amount'].'" class="form-control"/>'.'</td>');
echo('</tr>');
echo('<tr>');
 echo('<td>'.'Payment Mode*'.'</td>');
 echo('<td>'.'Agent*'.'</td>');
 echo('<td>'.'Manager*'.'</td>');
echo('</tr>');
echo('<tr>');
 echo('<td>'.'<input type="text" name="PaymentMode" value="'.$row['PaymentMode'].'" class="form-control payment_mode" style="display:none"/><p class="payment_mode form-control">'.$row['PaymentMode'].'</p>'.'</td>');
 echo('<td>'.'<input type="text" name="Agent" value="'.$row['Agent'].'" class="form-control Agent" style="display:none"/><p class="Agent form-control">'.$row['Agent'].'</p>'.'</td>');
 echo('<td>'.'<input type="text" name="Manager" value="'.$row['Manager'].'" class="form-control Manager" style="display:none"/><p class="Manager form-control">'.$row['Manager'].'</p>'.'</td>');
echo('<td>'.'<input type="submit" value="UPDATE" class="btn btn-primary btn-block"/>'.'</td>');
echo('</tr>');

}
	

echo('</tbody>');
echo('</table>');

echo('</form>');
?>

<div>
	
	<table class="table table-bordered" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td><strong>Change Package Name</strong></td>
      <td><strong>Change Agent</strong></td>
      <td><strong>Change Manager</strong></td>
      <td><strong>Change Payment Mode</strong></td>
    </tr>
    <tr>
      <td><select class="form-control" id="PackageName">

            <option value="">Select Package</option>

           <?php include('partial/segments.php') ?>

          </select></td>
        <td><select class="form-control" id="Agent">

            <option value="">Select Agent</option>

           <?php include('partial/agents.php') ?>

          </select></td>
            <td><select class="form-control" id="Manager">

          
           <?php include('partial/manager.php') ?>

          </select></td>
       
     
      <td><select class="form-control" id="payment_mode">

        

           <?php include('partial/payment_mode.php') ?>

          </select></td>
    </tr>
   
  </tbody>
</table>

	
</div>
</div>

</div>
<script>

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

	
	
$(document).ready(function(){
	
$('#PackageName').change(function(){	
	$('.PackageName').val($(this).val())
	$('.PackageName').text($(this).val()) 
});
	
$('#Agent').change(function(){	
	$('.Agent').val($(this).val()) 
	$('.Agent').text($(this).val()) 
});
	
$('#Manager').change(function(){	
	$('.Manager').val($(this).val())
	$('.Manager').text($(this).val()) 
});
	
$('#payment_mode').change(function(){	
	$('.payment_mode').val($(this).val())
	$('.payment_mode').text($(this).val())
});	

})

	
</script>

<?php include('partial/footer.php') ?>
