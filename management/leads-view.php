<?php  include('partial/session_start.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/partial/access-control-role-base.php"); ?>
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
    <div class="breadcurms"> <a href="memberpage.php">Dashbord</a> | <a href="leads-view.php"  class="btn btn-xs btn-primary">Assigned Leads</a> | <a href="lead-details-filter1.php">Filter 1</a> | <a href="leads-filter_3_new.php">Filter 3</a> | <a href="leads-filter_4_new.php">Filter 4</a> | <a href="leads-filter_7_new.php" class="">Last 7 days Inactive</a> | <a href="leads-filter_2_new.php">Churn</a> | <a href="leads-view-delete.php">Delete</a><a href="#" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a></div>

    <div class="containter" style="padding:20px 20px 0 20px;">


      <div style="display:none;">
        <input type="text" id="DispositionAgent" value=""/>
        <input type="text" id="DispositionAgentId" value=""/>

        <button id="DispositionAgentUpdate" onClick="Update()">Update</button>
      </div>
      
      <?php include('connection/dbconnection_crm.php')?>
      <?php

      $sql = ("SELECT Id, Full_Name, Email, Mobile, State, Source, Disposition, UserName, DATE_FORMAT( TimeStamp,  '%d/%m/%Y %h:%i %p' ) AS DateTimeINR FROM Assigned_Leads ORDER BY  `Id` DESC LIMIT 0 , 200");

//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");

/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
FROM fut_hni");*/

if($_SESSION['Role'] == 'SR_TL'){
   $sql1 = ("SELECT `username` FROM `employee` WHERE Role='Team Leader' AND `Status` = 'Active' ORDER BY  `employee`.`username` ASC LIMIT 0 , 200");
}
if($_SESSION['Role'] == 'Team Leader'){
    $sql1 = ("SELECT `username` FROM `employee` WHERE Role='Agent' AND `Status` = 'Active' ORDER BY  `employee`.`username` ASC LIMIT 0 , 200");
}

if($_SESSION['Role'] == 'Super Admin'){
 
 $sql1 = ("SELECT `username` FROM `employee` WHERE Role='SR_TL' AND `Status` = 'Active' ORDER BY  `employee`.`username` ASC LIMIT 0 , 200");
    
}
//echo("$('.AgentNames').html('"); 
$result1 = mysqli_query($connect, $sql1);
$sl= '<option value="">Select</option>';
while($row1 = mysqli_fetch_array($result1))

{
  $sl.= '<option value="'.$row1['username'].'">'.$row1['username'].'</option>';
}


$result = mysqli_query($connect,$sql);

// echo('<table id="ViewLeads" class="display" cellspacing="0" width="100%">');
echo('<table id="ViewLeads_id" class="display" cellspacing="0" width="100%">');
echo('<thead>');
echo('<tr>');
echo('<th style="display:none">Change</th>');
echo('<th>Change</th>');
echo('<th>Full Name</th>');
echo('<th>Email</th>');
echo('<th>Mobile</th>');
echo('<th>State</th>');
echo('<th>Source</th>');
echo('<th>Disposition</th>');
echo('<th>User Name</th>');
echo('<th>Date</th>');
echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = $result->fetch_array())
{
  echo('<tr>');
  echo ('<td style="display:none"><input type="text" class="Agent" value="'.$row['UserName'].'"></td>');
  echo ('<td><input type="hidden" id="DispositionAgentId" value="'.$row['Id'].'"><select class="form-control ChangeAgent AgentNames" style="width:160px;">

   '.$sl. '</select></td>');
  echo('<td>'.$row['Full_Name'].'</td>');
  echo('<td>'.$row['Email'].'</td>');
  echo('<td>'.$row['Mobile'].'</td>');
  echo('<td>'.$row['State'].'</td>');
  echo('<td>'.$row['Source'].'</td>');
  echo('<td>'.$row['Disposition'].'</td>');
  echo('<td>'.$row['UserName'].'</td>');
  echo('<td>'.$row['DateTimeINR'].'</td>');
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
                <?php include('partial/source_name.php') ?>
              </select>   </td>
              <td>  <select class="form-control" id="Disposition">
                <?php include('partial/disposition.php') ?>
              </select></td>
            </tr>
            <tr>
              
              <td>UserName<span>*</span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
             
              <td> <select class="form-control" id="UserName">
                <?php //include('partial/agents.php') 
                  echo $sl;
                ?>
              </select>
            </td>
            <td><input style="display:none" type="text" value="<?php echo date('Y-m-d') ?>" id="CurrentDate" class="form-control" placeholder="Current Date"/></td>
            <td>&nbsp;</td>
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

//alert(abc)


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

$(document).ready(function(){ 
  
  <?php 
     // include('partial/agents-name.php'); 
  ?>
  
}); 

</script>
<?php include('partial/footer.php') ?>

<script>
     $('#ViewLeads_id').DataTable();
</script>
