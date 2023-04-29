<?php
session_start();
 $username = $_SESSION['username'];
 //echo $username;
include('connection/dbconnection_crm.php');
include('partial/validate-user.php');
$result_update = mysqli_query($connect, "UPDATE employee SET read_notification='1' where username = '$username' ");
?>
<?php
if(isset($_GET['UserName']) && isset($_GET['Source']) && isset($_GET['Disposition'])){
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
date_default_timezone_set('Asia/Kolkata');}
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Risk Profile</title>
<?php require('partial/plugins.php'); ?>
<style>
    .dt-buttons {float:left;}
</style>
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
<a href="memberpage.php">Dashbord</a> | <a href="risk-profile.php">Risk Profile</a>  | <a href="risk-profile.php?page=true">All</a>
 </div>
 
 <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>	  
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
 
 <!-- <div class="pull-right"><a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a></div>  -->
 <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">
<?php
// echo $sql = ("SELECT Id, Ideas, Sagment, Result, DATE_FORMAT( DateTime,  '%d-%m-%Y %H : %i %p' ) AS DateTimeCurrent FROM stock_tips WHERE DATE( CURDATE( ) ) = DATE( DateTime) ORDER BY `stock_tips`.`DateTime` DESC");


$result = mysqli_query($sql);

echo('<table id="Risk_Profile" class="display table table-bordered" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr class="brand-color-bg">');
    echo('<th>Action</th>');
     echo('<th>Date</th>');
  echo('<th>Full Name</th>');
   echo('<th>Point Score</th>');
   echo('<th>Email</th>');
 echo('<th>Phone</th>');
   echo('<th>Date of Birth and PAN</th>');
      echo('<th>IP Address</th>');
  echo('<th>I Agree Approval Status</th>');
   //echo('<th>Ideas</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');
include('connection/database_connection_wordpress.php');
foreach($datas as $row)
{
    
     $sel = 'select  UserName from Assigned_Leads where Mobile = "'.$row['Phone'].'"';
    $qry = mysqli_query($connect, $sel);
    $dt = mysqli_fetch_assoc($qry);
    
        if($dt['UserName'] != $_SESSION["username"]){
           // continue;
        }
   
    //$all_data = (($row['quiz_results']));
   // print_r($row);
    
echo('<tr>');

echo('<td><a href="javascript:void(0)" class="btn btn-xs btn-danger delete_val" data-id="'.$row['result_id'].'">Delete</a></td>');
     echo('<td>'.date('d F Y H:i', strtotime($row['Dates'])).'</td>');
  echo('<td>'.ucwords(strtolower($row['Full_Name'])).'</td>');
  echo('<td>'.$row['Points'].'</td>');
  //echo('<td> '.$row['DOB'].'</td>');
  echo('<td> '.strtolower($row['Email']).'</td>');
  if(strlen($row['Phone']) < 10) { 
 echo('<td style="background:red;color:#FFF">'.$row['Phone'].'</td>');
  }
  else {
    echo('<td>'.$row['Phone'].'</td>');  
  }
  echo('<td>'.strtoupper($row['PAN']).'</td>');
    echo('<td>'.$row['user_ip'].'</td>');
  $qrys = "select * from Kyc_Customers where Phone = '".$row['Phone']."'";
  $qry =  mysqli_query($qrys);
  $get_d = mysqli_fetch_assoc($qry);
  if($get_d){
       echo('<td><span class="btn btn-xs btn-success">I Agreed</span></td>');
  }
  else{
       echo('<td><span class="btn btn-xs btn-danger">Pending</span></td>');
  }
 
  
  
  
 // echo('<td><input type="hidden" value="'.$row['Id'].'"'. 'class="id"/>'.'<a href="#_"' . 'class="btn btn-danger">Delete</a>'.'</td>');
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
    
    
    	 var table = $('#Risk_Profile').DataTable( {
        scrollY:        "500px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
		ordering: true,
        info:     true,
		 bFilter: true,
		 dom: 'Bfrtip',
        buttons: [
             'csv'
        ],
         "order": [[ 0, "desc" ]]
        /*
		 fixedColumns:   {
            leftColumns: 1
            
        } 
		 ,
		 */
    } );
    
    $(".delete_val").click(function(e){
        var id = $(e.target).attr("data-id");
        $.ajax({
            url : "Ajax_files/delete_risk_profile.php",
            type : "post",
            data : {id : id},
            success : function(data){
                 window.location.reload()
            }
        })
    })

});
</script>