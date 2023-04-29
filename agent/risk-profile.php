<?php  include('partial/session_start.php'); ?>
<?php


//session_start();
 //$username = $_SESSION['username'];
 //echo $username;
//include('connection/dbconnection_crm.php');
//include('partial/validate-user.php');
$result_update = mysqli_query($connect,"UPDATE employee SET read_notification='1' where username = '$username' ");
?>
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
<title>Risk Profile</title>
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
<a href="memberpage.php">Dashbord</a> | <a href="risk-profile.php">Risk Profile</a>  | <a href="risk-profile.php?page=true">All</a> 
 </div>
 <!-- <div class="pull-right"><a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a></div>  -->
 <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">
<?php
// echo $sql = ("SELECT Id, Ideas, Sagment, Result, DATE_FORMAT( DateTime,  '%d-%m-%Y %H : %i %p' ) AS DateTimeCurrent FROM stock_tips WHERE DATE( CURDATE( ) ) = DATE( DateTime) ORDER BY `stock_tips`.`DateTime` DESC");

include('connection/database_connection_wordpress.php');
//$result = mysqli_query($connect,$sql);

echo('<table id="Risk_Profile" class="display table table-bordered" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr class="brand-color-bg">');
    echo('<th>Date</th>');
  echo('<th>Full Name</th>');
   echo('<th>Point Score</th>');
   echo('<th>Email</th>');
  echo('<th style="display:">Mobile</th>');
   echo('<th>Date of Birth and PAN</th>');
  echo('<th>I Agree Approval Status</th>');
   //echo('<th>Ideas</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');
if(!empty($datas)){
foreach($datas as $row)
{
    
     $sel = 'select  UserName from Assigned_Leads where Mobile = "'.$row['Phone'].'"';
    $qry = mysqli_query($connects,$sel);
    $dt = mysqli_fetch_assoc($qry);
    /*
        if($dt['UserName'] != $username){
            continue;
        } */
   
    //$all_data = (($row['quiz_results']));
   // print_r($row);
    
echo('<tr>');
     echo('<td>'.date('d F Y H:i', strtotime($row['Dates'])).'</td>');
  echo('<td>'.$row['Full_Name'].'</td>');
  echo('<td>'.$row['Points'].'</td>');
  //echo('<td> '.$row['DOB'].'</td>');
  echo('<td> '.$row['Email'].'</td>');
   if(strlen($row['Phone']) < 10) { 
  echo('<td style="background:red;color:#fff"><span class="number-hide">'.$row['Phone'].'</span></td>');
   }
    else {
    echo('<td style="display:"><span class="number-hide">'.$row['Phone'].'</span></td>');
    }
    
  echo('<td>'.$row['PAN'].'</td>');
  
  $qryss = "select * from Kyc_Customers where Phone = '".$row['Phone']."' order by id desc limit 1";
  $qrysss =  mysqli_query($connect,$qryss);
  $get_ds = mysqli_fetch_assoc($qrysss);
  //print"<pre>";
  //print_r($connects);
  //print_r($get_ds);
  
  if($get_ds){
      if($get_ds['Agreed'] == 'Agreed'){
           echo('<td><span class="btn btn-xs btn-success">I Agreed</span></td>');
      }
      else{
          echo('<td><span class="btn btn-xs btn-danger">Pending</span></td>');
      }
      
  }
  else{
       echo('<td><span class="btn btn-xs btn-danger">Pending</span></td>');
  }
 
  
  
  
 // echo('<td><input type="hidden" value="'.$row['Id'].'"'. 'class="id"/>'.'<a href="#_"' . 'class="btn btn-danger">Delete</a>'.'</td>');
  }
}
 echo('</tr>');
echo('</tbody>');
echo('</table>');

?>
</div>
</div>
<!-- Modal -->



<?php include('partial/footer.php') ?>

<script type="text/javascript">

$(document).ready(function() {

	$('#Risk_Profile').dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": false,
        "scrollY": $(window).height() - 370+"px",
        "sScrollX": "100%",
        "bScrollCollapse": true,
        "scrollCollapse": true,
        "aaSorting": [],
		 "order": [[ 0, "desc" ]]

    });
	
});
</script>


<?php include('partial/protect-website-data.php'); ?>
