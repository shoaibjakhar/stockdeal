<?php  include('partial/session_start.php'); ?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Assigned Leads</title>
<?php require('partial/plugins.php'); ?>
</head>
<body>
<?php include('partial/sidebar.php') ?>
<div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>
  </header>
 <div class="breadcurms"> <!-- <a href="view-leads.php">View Leads</a> | <a href="lead-details.php">Lead details</a> | <a href="lead-details-filter2-new.php" >Filter 1</a> <a href="#" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add New Leads</a> -->
  
   <a href="memberpage.php">Follow Up Leads</a> | <a href="follow-up-leads-filter-2.php" >Filter 2</a> | <a href="fresh-leads.php">Fresh Leads</a> | <a href="lead-details-filter2-new.php">Filter 1</a>  <a href="#" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add New Leads</a>
  
  
  
  
  </div>

  <div class="containter" style="padding:20px 20px 0 20px;">


<div style="display:none;">
<input type="text" id="DispositionAgent" value=""/>
<input type="text" id="DispositionAgentId" value=""/>

<button id="DispositionAgentUpdate" onClick="Update()">Update</button>
  </div>
  
    <?php include('connection/dbconnection_crm.php')?>
<?php

$sql = ("SELECT Id, Full_Name, Email, Mobile, State, Source, Disposition, UserName, DATE_FORMAT( Date,  '%d-%m-%Y' ) AS Date FROM Assigned_Leads where  UserName='".$username."'  ORDER BY  `Id` DESC LIMIT 0 , 300");

//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");

/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
FROM fut_hni");*/


$result = mysqli_query($connect,$sql);

echo('<table id="Agent_request" class="display" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
 echo('<th style="display:none">Change</th>');

  echo('<th>Full_Name</th>');
  echo('<th>Email</th>');
  echo('<th>Mobile</th>');
  echo('<th>State</th>');
  //echo('<th>Source</th>');
  echo('<th>Disposition</th>');
  echo('<th>Agent Name</th>');
  echo('<th>Full_Date</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
echo ('<td style="display:none"><input type="text" class="Agent" value="'.$row['UserName'].'"></td>');
 echo('<td>'.$row['Full_Name'].'</td>');
echo('<td>'.$row['Email'].'</td>');
echo('<td>'.$row['Mobile'].'</td>');
 echo('<td>'.$row['State'].'</td>');
 //echo('<td>'.$row['Source'].'</td>');
 echo('<td>'.$row['Disposition'].'</td>');
 echo('<td>'.$row['UserName'].'</td>');
 echo('<td>'.$row['Date'].'</td>');
}
 echo('</tr>');
echo('</tbody>');
echo('</table>');


?>


  <div class="alert alert-success" style="display:none">
  <strong>Agent Changed Successfully.</strong>
</div>
</div>
</div>


<div class="modal fade" id="AddFreeTrail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="AddFreeTrailLabel">Add New Lead</h4>
      </div>
      <div class="modal-body">
      <!-- -->
	  <div class="alert alert-danger" style="display:none">
  <strong>Please fill required fields</strong>
</div>
    <!--  -->   
<table width="100%"  border="0" class="table table-bordered" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>Full Name </td>
      <td>Email ID</td>
      <td>Mobile No<span>*</span></td>
    </tr>
    <tr>
      
      <td><input type="text" value="" id="FullName" class="form-control" placeholder="Full Name"/></td>
      <td><input type="text" value="" id="EmailID" class="form-control" placeholder="Email ID"/></td>
      <td><input type="text" value="" id="MobileNo" class="form-control" placeholder="Mobile No"/></td>
    </tr>
    <tr>
      
      <td>State</td>
      <td>Source<span>*</span></td>
      <td>Disposition<span>*</span></td>
    </tr>
    <tr>
     
      <td><input type="text" value="" id="State" class="form-control" placeholder="State"/></td>
      <td><select class="form-control" id="Source">
          <option value="">Select</option>
			<?php
			$get_risk_qry = "SELECT Source FROM `Options` where Source IS NOT NULL";
			$getd_qry = mysqli_query($connect, $get_risk_qry );
			while ( $get_options = mysqli_fetch_assoc( $getd_qry ) ) {
				?>
			<option value="<?php echo $get_options['Source']; ?>">
				<?php echo $get_options['Source'] ?>
			</option>
			<?php
			//	echo '<option value="'.$get_options['Package'].'">.$get_options["Package"].</option> ';
			}
			?>
          </select>   </td>
       <td>  <select class="form-control" id="Disposition">
		   <option value="">Select</option>
          <?php
			$get_risk_qry = "SELECT Disposition FROM `Options` where Disposition IS NOT NULL";
			$getd_qry = mysqli_query($connect, $get_risk_qry );
			while ( $get_options = mysqli_fetch_assoc( $getd_qry ) ) {
				?>
			<option value="<?php echo $get_options['Disposition']; ?>">
				<?php echo $get_options['Disposition'] ?>
			</option>
			<?php
			//	echo '<option value="'.$get_options['Package'].'">.$get_options["Package"].</option> ';
			}
			?>
          </select>
          <input type="hidden" value="<?php  echo $username;?>" id="UserName" class="form-control" >
          <input type="hidden" value="<?php echo date('Y-m-d') ?>" id="CurrentDate" class="form-control" placeholder="Current Date"/>
          </td>
    </tr>
  </tbody>
</table>
<!-- -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="Add()">Add</button>
      </div>
    </div>
  </div>
</div>

    
    <script>
    
        function AddNow() {
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


//alert(abc)

var FullName  = document.getElementById('FullName').value
var EmailID  = document.getElementById('EmailID').value
var MobileNo  = document.getElementById('MobileNo').value
var State  = document.getElementById('State').value
var Source  = document.getElementById('Source').value
var Disposition  = document.getElementById('Disposition').value
var UserName  = document.getElementById('UserName').value
var CurrentDate  = document.getElementById('CurrentDate').value 

var abc = FullName + EmailID + MobileNo + State + Source + Disposition + UserName + CurrentDate




aa.open("GET","leads-add.php?FullName="+FullName+"&EmailID="+EmailID+"&MobileNo="+MobileNo+"&State="+State+"&Source="+Source+"&Disposition="+Disposition+"&UserName="+UserName+"&CurrentDate="+CurrentDate,true);
aa.send();
//alert(abc)

setTimeout(function(){  location.reload(); }, 1000);
}

function Add() {
	
	
var MobileNo  = document.getElementById('MobileNo').value
var Source  = document.getElementById('Source').value
var Disposition  = document.getElementById('Disposition').value
var UserName  = document.getElementById('UserName').value	
	
if(MobileNo != "" && Source != "" && Disposition != "" && UserName != "") {

		AddNow();
		}
		else {

		$('.alert-danger').show();
		
			}

}

</script>
<?php include('partial/footer.php') ?>
