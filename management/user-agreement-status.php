<?php  include('partial/session_start.php'); ?>
<?php
  include('connection/dbconnection_crm.php');
?>

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
<title>Agent</title>
<?php require('partial/plugins.php'); ?>


<style>
.Agreed,.Approved {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
}

.Pending {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}
</style>
</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">
 <div class="pull-left">
  <a href="memberpage.php">Dashbord</a> | <a href="agent-request-received.php" class="btn btn-xs btn-primary">Received</a> | <a href="agent-request-sent.php">Sent</a> |  <a href="employee-login-details.php">Agent login details</a>
  
  <?php
  
  if($_SESSION['Role'] == 'Super Admin') {
      
    //echo(' ');   
  }
  
  ?> 
 </div>
 
 <div class="clearfix"></div>
</div>

<div class="containter" style="padding:20px 20px 0 20px;">

<?php

include('connection/dbconnection_crm.php');


$sql = ("SELECT * FROM User_Agreement where Trash IS NULL  ORDER BY  `Id` DESC");


//Agent = '".$UserNameSession."'
    
    
    
//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");



/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin

FROM fut_hni");*/
if($_SESSION['Role'] == 'Admin Assist'){

if(isset($_GET['action']) && $_GET['action'] == 'delete' && $_GET['id'] != ''){
    $del = "UPDATE User_Agreement SET Trash = 'Yes' WHERE Id = '".$_GET['id']."'";
    mysqli_query($connect, $del);
    $sel_agreement = "SELECT * FROM User_Agreement WHERE Id = '".$_GET['id']."'";
    $qry_agrement = mysqli_query($connect, $sel_agreement);
    $fetch_agreement = mysqli_fetch_assoc($qry_agrement);
    $_SESSION['delete'] = true;
    $_SESSION['agreement_user'] = $fetch_agreement['Full_Name'];
    header('location:user-agreement-status.php');
    die();
}

if(isset($_GET['action']) && $_GET['action'] == 'approve' && $_GET['id'] != ''){
    $upd = "UPDATE User_Agreement SET Status = 'Approved' WHERE Id = '".$_GET['id']."'";
    mysqli_query($connect, $upd);
    $sel_agreement = "SELECT * FROM User_Agreement WHERE Id = '".$_GET['id']."'";
    $qry_agrement = mysqli_query($connect, $sel_agreement);
    $fetch_agreement = mysqli_fetch_assoc($qry_agrement);
    $_SESSION['approved'] = true;
    $_SESSION['agreement_user'] = $fetch_agreement['Full_Name'];
    header('location:user-agreement-status.php');
    die();
}

if(isset($_SESSION['approved']) && $_SESSION['approved'] == true){
    echo '<div class="alert alert-success message_alert" role="alert">
 '. $_SESSION['agreement_user'].'\'s User Agreement\'s Status Updated Successfully
</div>';
 $_SESSION['approved'] = false;
 $_SESSION['agreement_user'] = null;
}

if(isset($_SESSION['delete']) && $_SESSION['delete'] == true){
    echo '<div class="alert alert-danger message_alert" role="alert">
 '. $_SESSION['agreement_user'].'\'s User Agreement Deleted Successfully
</div>';
 $_SESSION['delete'] = false;
 $_SESSION['agreement_user'] = null;
}
}

$result = mysqli_query($connect, $sql);



echo('<table id="Agent_request" class="display" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
 echo('<th>Status</th>');
 echo('<th>DateTime</th>');
 echo('<th>Full_Name</th>');
 echo('<th>Email</th>');
 echo('<th>Mobile</th>');
 echo('<th>Agent_Name</th>');
 echo '<th>Sign</th>';
 echo('<th>IP Address</th>');
 if($_SESSION['Role'] == 'Admin Assist'){
  echo('<th>Action</th>');
 } 
 echo('</tr>');
echo('</thead>');
echo('<tbody>');

while($row = mysqli_fetch_array($result))

{
echo('<tr>');
     echo('<td> <a href="#_" class="btn btn-xs  '.$row['Status'].'">'.$row['Status'].'</a></td>');
  echo('<td>'.date("d-F-Y h:i a",strtotime($row['DateTime'])).'</td>');
  echo('<td>'.$row['Full_Name'].'</td>');
 echo('<td>'.$row['Email'].'</td>');
  echo('<td>'.$row['Mobile'].'</td>');
  echo('<td>'.$row['Agent_Name'].'</td>');
  if($row['Signature']){
  echo '<td>
    <button class="btn btn-xs btn-info view_signature" data-url="'.$row['Signature'].'">View</button>
  </td>';
  }
  else{
      echo '<td></td>';
  }
  echo('<td>'.$row['remoteAddress'].'</td>');
  
  if($_SESSION['Role'] == 'Admin Assist'){
  
  $sel_cust = "SELECT * FROM `Customer_profile` WHERE (Email_ID = '".$row['Email']."' OR Mobile_No = '".$row['Mobile']."')";
  $qry_cust = mysqli_query($connect, $sel_cust);
  $fetch_cust = mysqli_fetch_assoc($qry_cust);
  
  echo '<td>';
  
  if($row['Status'] != 'Approved'){
     // echo ('<a href="user-agreement-status.php?action=approve&id='.$row['Id'].'" class="btn btn-xs btn-success">Approve</a> &nbsp;');
  }
    if($row['Status'] != 'Approved'){
          if($fetch_cust){
              if($fetch_cust['Approval_Status'] != 'Approved'){
                  echo('<a href="user-agreement-status.php?action=delete&id='.$row['Id'].'" onclick="return confirm('."'Are you Sure to delete?"."'".')" class="btn btn-xs btn-danger" style="">Delete</a></td>');
              }
              else{
                  echo '</td>';
              }
          }
          else{
             echo('<a href="user-agreement-status.php?action=delete&id='.$row['Id'].'" onclick="return confirm('."'Are you Sure to delete?"."'".')" class="btn btn-xs btn-danger" style="">Delete</a></td>');
          }
      
    }
  }
   
}
echo('</tr>');

echo('</tbody>');

echo('</table>');





?>


</div>


<div class="modal fade modal-lg" id="Show_Sign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Digital Signature</h5>
      </div>
      <div class="modal-body">
        <div>
            <img src="" id="Digital_Sign"  class="img-thumbnail img-fluid" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<?php include('partial/footer.php') ?>
<script>
    $(document).ready(()=>{
        $('.message_alert').delay(5000).fadeOut('slow');
        $(".view_signature").click((e)=>{
            var img = $(e.target).attr('data-url');
            <?php
                $sel = "SELECT Digital_Signature_Url FROM Options WHERE Id = 1";
                $qry = mysqli_query($connect, $sel);
                $fetch = mysqli_fetch_assoc($qry);
            ?>
            $("#Digital_Sign").attr("src","<?php echo $fetch['Digital_Signature_Url'] ?>/Signatures/"+img);
            $("#Show_Sign").modal('show');
            //Digital_Sign
        })
    })
</script>