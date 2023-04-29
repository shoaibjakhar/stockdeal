<?php  include('partial/session_start.php'); ?>



<?php

if(isset($_GET[ 'UserName' ]) && isset($_GET[ 'Source' ]) && isset($_GET[ 'Disposition' ])){
  $UserName = $_GET[ 'UserName' ];

  $Source = $_GET[ 'Source' ];

  $Disposition = $_GET[ 'Disposition' ];



  date_default_timezone_set( 'Asia/Kolkata' );
}



?>


<!doctype html>

<html>



<head>

 <meta charset="utf-8">

 <meta name="viewport" content="width=device-width, initial-scale=1">

 <title>SR Team Lead Login Details</title>

 <?php require('partial/plugins.php'); ?>



 <style type="text/css">
  .dataTables_info{
    display: none;
  }
</style>



</head>

<style>

 .disabled {background: #fff;color:#e74c3c;text-align: center;}

 .Active {background: #fff;color:#009900;;text-align: center;}

 input {

  position: relative;

  width: 150px; height: 20px;

  /* color: white;*/

}



input[type=date] {line-height: 28px;}



input:before {

  position: absolute;

  top: 3px; left: 10px;

  content: attr(data-date);

  display: inline-block;

  color: black;

}





input::-webkit-datetime-edit, input::-webkit-inner-spin-button, input::-webkit-clear-button {

  display: none;

}



input::-webkit-calendar-picker-indicator {

  position: absolute;

  top: 4px;

  right: 8px;

  color: black;

  opacity: 1;

}

.Full_Name {text-transform: capitalize}



input[type="date"]::-webkit-calendar-picker-indicator {

  color: rgba(0, 0, 0, 0);

  opacity: 1;

  display: block;

  background: url(images/calendar.png) no-repeat;

  width: 20px;

  height: 20px;

  border-width: thin;

}
  #autocomplete{
  width: 60%;

  height: 41.5px;


  border:#f39c12 solid 2px;
  border-radius: 6px 6px 6px 6px;
  padding-left: 10px;


}
#autocomplete:focus{
  outline: none;
}
#searchButton{
  margin-left: -70px;
  background-color:#f39c12;
  color: white;
  height: 42px;
  width: 20%;
  border: #f39c12 solid 2px;
  border-radius: 0 5px 5px 0;
}
.autocomplete-suggestions{
  padding-left: 10px;
  background-color: white;
  width: 300px;
  overflow: auto;
  border:#ddd solid 1px;
  border-radius: 5px;
}
</style>



<body>





 <?php include('partial/sidebar.php') ?>



 <div class="main_container">

  <header>

   <?php include('partial/header-top.php') ?>



 </header>
      <!-- <form action="upload-image.php" method="POST" enctype="multipart/form-data">
         <div class="row">
        <div class="col-sm-6 col-md-6">
             <input type="file" name="image" class="form-control" id="image" />
             <input type="submit" name="submit" value="Upload">
          </div>
      </div> 
    </form> -->

    <div class="breadcurms">

     <div class="pull-left">

      <a href="memberpage.php">Dashbord</a> | 
      <a href="agent-request-received.php">Received</a> | 
      <a href="agent-request-sent.php">Sent</a> | 
      <a href="employee-login-details.php" <?php if(empty($_GET['filter'])){ ?> class="btn btn-xs btn-primary" <?php } ?>>Agent login details</a> |
      <a href="inactive-employee-login-details.php" >InActive Agent login details</a> 
      <a href="agents-importing-issue.php" >| Agents issue in importing</a> 

      <?php if($_SESSION['Role'] == "Super Admin"){ ?>
       | <a href="employee-login-details.php?filter=admin" >Team Leader login details</a>
       | <a href="inactive-employee-login-details.php?filter=admin" >InActive Team Leader login details</a>

       | <a href="sr-tl-login-details.php?filter=admin"  class="btn btn-xs btn-primary" >SR Team Leader login details</a>
       | <a href="inactive-sr-tl-login-details.php?filter=admin" >InActive SR Team Leader login details</a>
     <?php } ?>
   </div>

   <div class="pull-right">
    <?php if(isset($_GET['filter']) && $_GET['filter'] == 'admin'){ ?>
     <!-- <a href="#" class="btn btn-xs btn-primary addEmployeeLogindetails" data-toggle="modal" data-target="#AddTeamLeaderModal"><i class="fa fa-plus"></i> Add</a> -->
     <a href="#" class="btn btn-xs btn-primary addEmployeeLogindetails" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a>
     <?php
   }
   else{
     ?>
     <a href="#" class="btn btn-xs btn-primary addEmployeeLogindetails" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a>
     <?php
   }
   ?>
   <!--    <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#Reason_for_leave"><i class="fa fa-plus"></i> Reason_for_leave</a>-->

 </div>

 <div class="clearfix"></div>

</div>

<div class="containter" style="padding:20px 20px 0 20px;">
 <?php
 if(isset($_SESSION['message']) && $_SESSION['message'] != ''){
  ?>
  <div class="alert alert-success" role="alert">
   <?php echo $_SESSION['message']; ?>
 </div>
 <?php
 $_SESSION['message'] = null;
}
?>

<?php
if(isset($_SESSION['error_message']) && $_SESSION['error_message'] != ''){
  ?>
  <div class="alert alert-danger" role="alert">
   <?php echo $_SESSION['error_message']; ?>
 </div>
 <?php
 unset($_SESSION['error_message']);
}
?>

<?php include('connection/dbconnection_crm.php')?>


<!-- pagination  Code  -->
<?php 

$limit=15; 

if(isset($_GET['filter']) && $_GET['filter'] == 'admin'){
  $getQuery = "SELECT * from employee  where  Role='SR_TL' AND status='Active'";  
}
else if($_SESSION['Role'] == 'Team Leader'){

  $getQuery = "SELECT * from employee  where  Role='Agent' AND Team_Leader = '".$username."' AND status='Active' ORDER BY id ASC";  
}
else
{
  $getQuery = "SELECT * from employee  where  Role='Agent' AND status='Active' ORDER BY id ASC";  
}


$result = mysqli_query($connect, $getQuery);  

$total_rows = mysqli_num_rows($result); 

$total_pages = ceil ($total_rows / $limit);  



if (!isset($_GET['page']) ) {  

  $selected_page_number = 1;  

} else {  

 $selected_page_number = $_GET['page'];  

} 


$initial_page = ($selected_page_number-1) * $limit; 

?>
<div class="row">
  <div class="col-sm-offset-3 col-sm-6">
   <form method="post" action="">
    <input type="text" name="search" id="autocomplete" placeholder="Search by name" value="<?php echo isset($_POST['submit_search'])?$_POST['search']:''?>" required>
    <input type="submit" name="submit_search" id="searchButton" value="Search">
  </form>
  <br>
</div>

</div>


<?php
if(isset($_POST['submit_search']) && isset($_GET['filter']) && $_GET['filter'] == 'admin')
{
  $search_value = $_POST['search'];
  $sql = ( "SELECT * FROM employee  where status='Active' AND Role='SR_TL' AND (username LIKE '%".$search_value."%' Or Team_Leader LIKE '%".$search_value."%') ORDER BY  `employee`.`Status`,`username` ");
}

else if(isset($_GET['filter']) && $_GET['filter'] == 'admin'){

  $sql = ( "SELECT * FROM employee  where status='Active' AND Role='SR_TL' ORDER BY  `employee`.`Status`,`username` ASC LIMIT ".$initial_page." ,".$limit."");

}
else if($_SESSION['Role'] == 'SR_TL' && isset($_POST['submit_search']))
{
  $search_value = $_POST['search'];
  $sql = ( "SELECT * FROM employee  where  status='Active' AND Team_Leader = '".$username."' AND (username LIKE '%".$search_value."%' Or Team_Leader LIKE '%".$search_value."%')   ORDER BY  `employee`.`Status`,`username` ASC LIMIT ".$initial_page." ,".$limit."");
}
else if($_SESSION['Role'] == 'SR_TL')
{
 $sql = ( "SELECT * FROM employee  where  status='Active' AND Team_Leader = '".$username."'  ORDER BY  `employee`.`Status`,`username` ASC LIMIT ".$initial_page." ,".$limit."");
}
else{
 $sql = ( "SELECT * FROM employee  where  Role='Agent' AND status='Active' ORDER BY  `id` DESC LIMIT ".$initial_page." ,".$limit."");
}


$result = mysqli_query($connect, $sql );

      //echo( '<form action="aa.php" method="post">' );

echo( '<table id="employee" class="display table table-bordered" cellspacing="0" width="100%">' );

echo( '<thead>' );

echo( '<tr class="brand-color-bg">' );

echo( '<th>Photo</th>' );

echo( '<th>Update</th>' );

echo( '<th>Status</th>' );

echo( '<th>Control</th>' );

echo( '<th>Date Of Join</th>' );

echo( '<th>Balance Leave</th>' );

echo( '<th>Used Leave</th>' );

echo( '<th>Full Name</th>' );

echo( '<th>Password</th>' );

echo( '<th>Role</th>' );
echo( '<th>Team Leader</th>' );

if($_SESSION['Role'] == 'Super Admin'){
  echo( '<th>Salery</th>' );
}

echo( '<th>Mobile</th>' );

echo( '<th>Emergency Number</th>' );



echo( '<th>Email Id</th>' );

echo( '<th>Date Of Birth</th>' );

echo( '<th>Gender</th>' );

echo( '<th>Current Address</th>' );

echo( '<th>Permanent Address</th>' );

echo( '<th>Bank Details</th>' );
echo( '<th>Account Number</th>' );
echo( '<th>IFSC Code</th>' );

echo( '<th>PAN</th>' );

      //echo( '<th>PAN Copy</th>' );

echo( '<th>Adhar</th>' );

      //echo( '<th>Adhar Copy</th>' );

echo( '<th>Blood Group</th>' );



echo( '<th>Joining Sources</th>' );

echo( '<th>Referred By</th>' );

echo( '<th>Marital Status</th>' );

echo( '<th>Last Working Day</th>' );
echo( '<th>Employee Agreement</th>' );
echo( '<th>Offer Letter</th>' );



echo( '</tr>' );

echo( '</thead>' );

echo( '<tbody>' );

while ( $row = mysqli_fetch_array( $result ) ) {



          //echo $select = "select * from employee where username = '".$row['UserName']."'";

                //$qryss = mysqli_query($connect, $select);

                //$fet_leaves = mysqli_fetch_assoc($qryss);

 $leaves_used = count((array)json_decode($row['Paid_Leaves_Log']));

 if($row[ 'Bank_Details' ]=='' || $row[ 'Account_NO' ]=='' || $row[ 'IFSC_Code' ]=='' || $row[ 'Bank_Details' ]=='NA' || $row[ 'Account_NO' ]=='NA' || $row[ 'IFSC_Code' ]=='NA' || $row[ 'Bank_Details' ]=='na' || $row[ 'Account_NO' ]=='na' || $row[ 'IFSC_Code' ]=='na')
 {
  echo( '<tr style="background-color: #c9160af5;color:white;">' );
}
else 
{
  echo( '<tr>' );
}

echo( '<td>' );

if($row['Photo'] != '' || $row['Photo'] != NULL){

  echo "<img class='img-thumbnail' src='".$row['Photo']."' >";

}

else{



  echo "<img class='img-thumbnail' src='data:image/jpeg;base64,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'>";

}



echo ( '</td>' );


if(isset($_GET['filter']) && $_GET['filter'] == 'admin')
{
  echo('<td> <a href="employee-login-details-update-tl.php?Id='.$row["Id"].'" class="btn btn-xs btn-primary employee-details-update">Update</a>
   <a onclick="return confirm('."'Are you sure?'".')" href="employee-delete.php?id='.$row["Id"].'" class="btn btn-xs btn-danger employee-details-update">Delete</a></td>');

}
else
{
  echo('<td> <a href="employee-login-details-update.php?Id='.$row["Id"].'" class="btn btn-xs btn-primary employee-details-update">Update</a>
   <a onclick="return confirm('."'Are you sure?'".')" href="employee-delete.php?id='.$row["Id"].'" class="btn btn-xs btn-danger employee-details-update">Delete</a></td>');

}


echo('<td> <a href="#_" class="'.$row['Status'].'">'.$row['Status'].'</a></td>');

echo('<td>');
if($row['Status'] == 'Active'){
  echo ('<img src="images/'.$row['Status'].'.png" class="Enable_Disables pointer" data-user-id="'.$row["Id"].'" data-user-status="'.$row["Status"].'" style="cursor:pointer"/>');
}else{
  echo ('<img src="images/'.$row['Status'].'.png" class="Enable_Disable pointer" data-user-id="'.$row["Id"].'" data-user-status="'.$row["Status"].'" style="cursor:pointer"/>');
}

('</td>');

echo( '<td>' . $row[ 'Date_of_Join' ] . '</td>' );

echo( '<td>' . $row[ 'Balance_Leave' ] . '</td>' );

echo( '<td>' . $leaves_used . '</td>' );

echo( '<td>' . $row[ 'username' ] . '</td>' );



echo( '<td>' . $row[ 'Password' ] . '</td>' );

if($row['Role']=="SR_TL")
{
  echo( '<td>SR Team Leader</td>' );
}
else
{
  echo( '<td>' . $row['Role'] . '</td>' );
}
echo( '<td>' . $row[ 'Team_Leader' ] . '</td>' );

if($_SESSION['Role'] == 'Super Admin'){

 echo( '<td>' . $row[ 'salery' ] . '</td>' );
}

echo( '<td>' . $row[ 'Mobile' ] . '</td>' );

echo( '<td>' . $row[ 'Emergency_Number' ] . '</td>' );



echo( '<td>' . $row[ 'Email' ] . '</td>' );

echo( '<td>' . $row[ 'Date_of_Birth' ] . '</td>' );

echo( '<td>' . $row[ 'Gender' ] . '</td>' );



$address_array = json_decode($row['Address']);

if(json_last_error() === JSON_ERROR_NONE){

  $pincode = ($address_array->pincode) ? $address_array->pincode :'';
  $house_no = ($address_array->house_no) ? $address_array->house_no :'';
  $landmark = ($address_array->landmark) ? $address_array->landmark :'';
  $city = ($address_array->city) ? $address_array->city :'';
  $state = ($address_array->state) ? $address_array->state :'';
  $address = $house_no. ', '.$landmark.', '.$pincode. ', '. $city. ', '.$state;
} else{
  $address = $row['Address'];
}
echo( '<td>' . $address . '</td>' );

echo( '<td>' . $row[ 'Permanent_Address' ] . '</td>' );

echo( '<td>' . $row[ 'Bank_Details' ] . '</td>' );
echo( '<td>' . $row[ 'Account_NO' ] . '</td>' );
echo( '<td>' . strtoupper($row[ 'IFSC_Code' ]) . '</td>' );

echo( '<td>' . $row[ 'PAN_Number' ] . '</td>' );





$PAN_Copy = $row['PAN_Copy']; 

if($PAN_Copy == NULL || $PAN_Copy == '') {

             //echo '<td>&nbsp;</td>';  

}

else {



    //echo( '<td><a href="'.$PAN_Copy.'" class="btn btn-xs btn-primary" target="_blank">View PAN Copy</a></td>');

}





echo( '<td>' . $row[ 'Adhar_Number' ] . '</td>' );



$Adhar_Copy = $row['Adhar_Copy']; 

if($Adhar_Copy == NULL || $Adhar_Copy == '') {

             //echo '<td>&nbsp;</td>';  

}

else {



    //echo( '<td><a href="'.$Adhar_Copy.'" class="btn btn-xs btn-primary" target="_blank">View Adhar Copy</a></td>');

}





echo( '<td>' . $row[ 'Blood_Group' ] . '</td>' );



echo( '<td>' . $row[ 'Joining_Sources' ] . '</td>' );

echo( '<td>' . $row[ 'Referred_by' ] . '</td>' );

echo( '<td>' . $row[ 'Marital_Status' ] . '</td>' );

echo( '<td>' . $row[ 'Date_of_Leave' ] . '</td>' );
echo( '<td>' . $row[ 'employeeAgreement' ] . '</td>' );
echo( '<td> <a onclick="return confirmation()" href="offer-letter-functions.php?Id='.$row["Id"].'" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Send Offer Letter</a></td>' );




}

echo( '</tr>' );

echo( '</tbody>' );

echo( '</table>' );

      //echo( '</form>' );




?>








</div>
<?php if(!isset($_POST['submit_search'])){?>
<div class="pagination" style="padding-right: 20px;padding-top: 15px;padding-bottom: 15px;">
  <?php 


  for($page_number = 1; $page_number <= $total_pages; $page_number++) 
  {
   if($page_number == $selected_page_number){  
     ?>
     <?php   if(isset($_GET['filter']) && $_GET['filter'] == 'admin'){?>
      <a class="btn btn-success" href = "sr-tl-login-details.php?page=<?php echo $page_number;?>&filter=admin"><?php echo $page_number; ?></a>
    <?php }else{?>
     <a class="btn btn-success" href = "sr-tl-login-details.php?page=<?php echo $page_number;?>"><?php echo $page_number; ?></a>
   <?php }?>
 <?php }else{?>
   <?php   if(isset($_GET['filter']) && $_GET['filter'] == 'admin'){?>
    <a class="btn btn-primary" href = "sr-tl-login-details.php?page=<?php echo $page_number;?>&filter=admin"><?php echo $page_number; ?></a>
  <?php }else{?>
   <a class="btn btn-primary" href = "sr-tl-login-details.php?page=<?php echo $page_number;?>"><?php echo $page_number; ?></a>
 <?php }?>
<?php }}  
?>
</div>
<?php }?>

</div>



<!-- Modal -->
<div class="modal fade" id="AddTeamLeaderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form method="POST" action="team-leader-add-back.php">
    <div class="modal-content">
     <div class="modal-header">

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     <h5 class="modal-title" id="exampleModalLabel">Add Team Leader</h5>
   </div>
   <div class="modal-body">

    <div class="form-group">
     <label>Username</label>
     <input type="text" name="username" class="form-control" id="TeamLeaderNameCheck" onchange="CheckTeamLeaderName()" required placeholder="Enter Username" autocomplete="new-username" />
     <p class="" style="color:red;" id="Team_Leader_Name_Check_Error"></p>
   </div>
   <div class="form-group">
     <label>Password</label>
     <input type="password" name="Password" class="form-control" required placeholder="Enter Password" autocomplete="new-password" />
   </div>

 </div>
 <div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary" id="Team_Leader_Form_Submit">Submit</button>
</div>
</div>
</form>
</div>
</div>



<!-- Modal -->

<div class="modal fade" id="AddFreeTrail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog  modal-lg" role="document">

   <form action="employee-add.php" method="post" enctype="multipart/form-data">
     <!--<form>-->

      <div class="modal-content">

       <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="AddFreeTrailLabel">Add New Employee Details</h4>

      </div>

      <div class="modal-body">

        <div class="row">
         <div class="col-sm-6 col-md-3">
          <label for="Date of Join">Upload profile:</label>
          <input type="file" name="image" class="form-control" id="image" required />
        </div>


        <div class="col-sm-3">

          <div class="form-group">

           <label for="Date of Join">Date of Join:</label>

           <input type="date" data-date="" name="Date_of_Join" data-date-format="DD MMMM YYYY" value="<?php echo(date("Y-m-d")) ?>" class="form-control">

         </div>

       </div>

       <div class="col-sm-3">

        <div class="form-group">

         <label for="Full Name">Full Name:</label>

         <input type="text" class="form-control Full_Name" onchange="return CheckAgentName()" id="Full_Name_Check" name="Full_Name" placeholder="Full Name" value="" required>
         <p class="" style="color:red;" id="Full_Name_Check_Error"></p>
       </div>

     </div>

     <div class="col-sm-3">

      <div class="form-group">

       <label for="Password">Password:</label>

       <input type="text" class="form-control" name="Password" placeholder="Password" value="123456">

     </div>

   </div>

   <div class="col-sm-3">

    <div class="form-group">

     <label for="Mobile">Mobile:</label>

     <input type="text" class="form-control" name="Mobile" placeholder="Mobile" value="" required>

   </div>

 </div>

 <div class="col-sm-3">

  <div class="form-group">

   <label for="Emergency Contact Number">Emergency Contact Number:</label>

   <input type="text" class="form-control" name="Emergency_Contact_Number" placeholder="Emergency Contact Number" value="" required>

 </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="Date of Birth">Date of Birth:</label>

   <input type="date" data-date="" name="Date_of_Birth" data-date-format="DD MMMM YYYY" value="<?php echo(date("Y-m-d")) ?>" class="form-control">

 </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="Email">Email:</label>

   <input type="text" class="form-control" name="Email" placeholder="Email" value="" required>

 </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="Gender">Gender:</label>



   <select class="form-control" name="Gender" required>

    <option value="" selected>Select</option>

    <option value="Male">Male</option>

    <option value="Female">Female</option>



  </select>



</div>

</div>

<div class="col-sm-6">
  <div class="form-group">
   <label for="house_no">Flat, House No., Building, Company, Apartment:</label>
   <input type="text" class="form-control" name="Address[house_no]" placeholder="Flat, House no" value="" required>
 </div>
</div>
<div class="col-sm-3">
  <div class="form-group">
   <label for="landmark">Landmark:</label>
   <input type="text" class="form-control" name="Address[landmark]" placeholder="Landmark" value="" required>
 </div>
</div>

<div class="col-sm-3">
  <div class="form-group">
   <label for="pincode">PinCode:</label>
   <input type="text" class="form-control" name="Address[pincode]" placeholder="Pincode" value="" required>
 </div>
</div>

<div class="col-sm-3">
  <div class="form-group">
   <label for="city">Town/City:</label>
   <input type="text" class="form-control" name="Address[city]" placeholder="City" value="" required>
 </div>
</div>
<div class="col-sm-3">
  <div class="form-group">
   <label for="state">State:</label>
   <!-- <input type="text" class="form-control" name="Address[state]" placeholder="State" value="" required> -->
   <select class="form-control" name="Address[state]" required>
    <option value="" disabled>Select</option>
    <option value="Andhra Pradesh">Andhra Pradesh</option>
    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
    <option value="Assam">Assam</option>
    <option value="Bihar">Bihar</option>
    <option value="Chhattisgarh">Chhattisgarh</option>
    <option value="Goa">Goa</option>
    <option value="Gujarat">Gujarat</option>
    <option value="Haryana">Haryana</option>
    <option value="Himachal Pradesh">Himachal Pradesh</option>
    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
    <option value="Jharkhand">Jharkhand</option>
    <option value="Karnataka">Karnataka</option>
    <option value="Kerala">Kerala</option>
    <option value="Madhya Pradesh">Madhya Pradesh</option>
    <option value="Maharashtra">Maharashtra</option>
    <option value="Manipur">Manipur</option>
    <option value="Meghalaya">Meghalaya</option>
    <option value="Mizoram">Mizoram</option>
    <option value="Nagaland">Nagaland</option>
    <option value="Odisha">Odisha</option>
    <option value="Punjab">Punjab</option>
    <option value="Rajasthan">Rajasthan</option>
    <option value="Sikkim">Sikkim</option>
    <option value="Tamil Nadu">Tamil Nadu</option>
    <option value="Telangana">Telangana</option>
    <option value="Tripura">Tripura</option>
    <option value="Uttarakhand">Uttarakhand</option>
    <option value="Uttar Pradesh">Uttar Pradesh</option>
    <option value="West Bengal">West Bengal</option>
  </select>  
</div>
</div>

<div class="col-sm-6" style="padding-top: 20px">
  <div class="form-group">
   <label style="margin-top: 11px;margin-left: 7px;">Permanent Address Same As Pervious:</label>
   <style>  
     #no_content_to_checkbox:before {
       content:none !important;
     }
     #no_content_to_checkbox {
       width: 25px;
       float:left;
     </style>
     <input type="checkbox" name="permanent_address_same_as_prev" class="form-control" id="no_content_to_checkbox" value="" > 
   </div>
 </div>
 <div class="col-sm-6" style="clear:both">
  <div class="form-group">
   <label for="Permanent Address">Permanent Address:</label>
   <input type="text" class="form-control" id= "permanent_adress" name="Permanent_Address" placeholder="Permanent Address" value="" required>
 </div>
</div>



<div class="col-sm-3">

  <div class="form-group">

   <label for="Bank Details">Bank Name:</label>


   <select class="form-control" name="Bank_Details" required>
    <option value="">Select Bank</option>
    <option value="Bank of Baroda">Bank of Baroda</option>
    <option value="Bank of India">Bank of India</option>
    <option value="Bank of Maharashtra">Bank of Maharashtra</option>
    <option value="Canara Bank">Canara Bank</option>
    <option value="Central Bank of India">Central Bank of India</option>
    <option value="Indian Bank">Indian Bank</option>
    <option value="Indian Overseas Bank">Indian Overseas Bank</option>
    <option value="Punjab & Sind Bank">Punjab & Sind Bank</option>
    <option value="Punjab National Bank">Punjab National Bank</option>
    <option value="State Bank of India">State Bank of India</option>
    <option value="UCO Bank">UCO Bank</option>
    <option value="Union Bank of India">Union Bank of India</option>
    <option value="Axis Bank Ltd">Axis Bank Ltd.</option>
    <option value="Bandhan Bank Ltd">Bandhan Bank Ltd</option>
    <option value="CSB Bank Ltd">CSB Bank Ltd</option>
    <option value="City Union Bank Ltd">City Union Bank Ltd</option>
    <option value="DCB Bank Ltd">DCB Bank Ltd</option>
    <option value="Dhanlaxmi Bank Ltd">Dhanlaxmi Bank Ltd</option>
    <option value="Federal Bank Ltd">Federal Bank Ltd</option>
    <option value="HDFC Bank Ltd">HDFC Bank Ltd</option>
    <option value="ICICI Bank Ltd">ICICI Bank Ltd</option>
    <option value="Induslnd Bank Ltd">Induslnd Bank Ltd</option>
    <option value="IDFC First Bank Ltd">IDFC First Bank Ltd</option>
    <option value="Jammu & Kashmir Bank Ltd">Jammu & Kashmir Bank Ltd</option>
    <option value="Karnataka Bank Ltd">Karnataka Bank Ltd</option>
    <option value="Karur Vysya Bank Ltd">Karur Vysya Bank Ltd</option>
    <option value="Kotak Mahindra Bank Ltd">Kotak Mahindra Bank Ltd</option>
    <option value="Nainital Bank Ltd">Nainital Bank Ltd</option>
    <option value="RBL Bank Ltd">RBL Bank Ltd</option>
    <option value="South Indian Bank Ltd">South Indian Bank Ltd</option>
    <option value="Tamilnad Mercantile Bank Ltd">Tamilnad Mercantile Bank Ltd</option>
    <option value="YES Bank Ltd">YES Bank Ltd</option>
    <option value="IDBI Bank Ltd">IDBI Bank Ltd</option>
    <option value="Au Small Finance Bank Limited">Au Small Finance Bank Limited</option>
    <option value="Capital Small Finance Bank Limited">Capital Small Finance Bank Limited</option>
    <option value="Equitas Small Finance Bank Limited">Equitas Small Finance Bank Limited</option>
    <option value="Suryoday Small Finance Bank Limited">Suryoday Small Finance Bank Limited</option>
    <option value="Ujjivan Small Finance Bank Limited">Ujjivan Small Finance Bank Limited</option>
    <option value="Utkarsh Small Finance Bank Limited">Utkarsh Small Finance Bank Limited</option>
    <option value="ESAF Small Finance Bank Limited">ESAF Small Finance Bank Limited</option>
    <option value="Fincare Small Finance Bank Limited">Fincare Small Finance Bank Limited</option>
    <option value="Jana Small Finance Bank Limited">Jana Small Finance Bank Limited</option>
    <option value="North East Small Finance Bank Limited">North East Small Finance Bank Limited</option>
  </select>    


  <!--<textarea cols="30" rows="4" class="form-control" name="Bank_Details" placeholder="Permanent Address" value="" required></textarea>-->

</div>

</div>



<div class="col-sm-3">

  <div class="form-group">

    <label for="PAN Number">Account NO:</label>

    <input id="Account_NO" type="password" class="form-control" name="Account_NO" required="true" placeholder="Account NO" value="">

  </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

    <label for="PAN Number">Re-Enter Account NO:</label><span id="acc_no_error"></span>

    <input id="Re_Enter_Account_NO" type="password" class="form-control" required="true" name="Re_Enter_Account_NO" placeholder="Re-Enter Account NO" value="">

  </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

    <label for="PAN Number">IFSC Code:</label><span id="ifsc_code_error"></span>

    <input id="ifsc_code" type="password" class="form-control" name="IFSC_Code" required="true" placeholder="IFSC Code" value="">

  </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

    <label for="PAN Number">Re-Enter IFSC Code:</label><span id="ifsc_code_error"></span>

    <input id="re_enter_ifsc_code" type="password" class="form-control" name="Re_Enter_IFSC_Code" required="true" placeholder="Re-Enter IFSC Code" value="">

  </div>

</div>





<div class="col-sm-3">

  <div class="form-group">

   <label for="Marital Status">Marital Status:</label>



   <select class="form-control" name="Marital_Status" required>

    <option value="" selected>Select</option>

    <option value="Married">Married</option>

    <option value="Single">Single</option>



  </select>



</div>

</div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="PAN Number">PAN Number:</label>

   <input type="text" class="form-control" name="PAN_Number" placeholder="PAN Number" value="">

 </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="PAN_Photo_Copy">PAN Photo Copy:</label>

   <input type="text" class="form-control" name="PAN_Photo_Copy" placeholder="URL" value="">

 </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="Adhar Number">Adhar Number:</label>

   <input type="text" class="form-control" name="Adhar_Number" placeholder="Adhar Number" value="">

 </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="PAN_Photo_Copy">Adhar Photo Copy:</label>

   <input type="text" class="form-control" name="Adhar_Photo_Copy" placeholder="URL" value="">

 </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="Blood_Group">Blood Group:</label>

   <input type="text" class="form-control" name="Blood_Group" placeholder="Blood Group" value="">

 </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="Joining Sources">Joining Sources:</label>

   <select class="form-control" name="Joining_Sources" required>

    <option value="" selected>Select</option>

    <option value="Walk in Interview">Walk in Interview</option>

    <option value="Recruitment Agencies">Recruitment Agencies</option>

    <option value="Advertisement">Advertisement</option>

    <option value="Reference">Reference</option>



  </select>

</div>

</div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="Blood_Group">Referred by:</label>

   <input type="text" class="form-control" name="Referred_by" placeholder="Referred by" value="">

 </div>

</div>

<!--<div class="col-sm-3">-->

  <!--      <div class="form-group">-->

   <!--  <label for="Last Working Date">Last Working Date:</label>-->

   <!--  <input type="date" data-date="" name="Last_Working_Date" data-date-format="DD MMMM YYYY" value="<?php //echo(date("Y-m-d")) ?>" class="form-control">-->

   <!--</div>-->

   <!--</div>-->

   <div class="col-sm-3">

    <div class="form-group">

     <label for="Last Working Date">Team Leader:</label>

     <input type="text" readonly name="Team_Leader" value="<?php echo $username; ?>" class="form-control">

   </div>


   <!--<div class="form-group">-->

     <!--  <label for="Last Working Date">Salary</label>-->

     <!--  <input type="text" name="Team_Leader" class="form-control">-->

     <!--</div>-->

   </div>

   <div class="col-sm-3">


     <div class="form-group">

      <label for="Last Working Date">Salary</label>

      <input type="number" required name="salery" class="form-control">

    </div>

  </div>
  <input type="hidden"  name="Role" value="SR_TL">


<div class="col-sm-3">


 <div class="form-group">
  <p id="Account_NO_Error"></p>
</div>

<div class="form-group">
  <p id="IFSC_Code_Error"></p>
</div>

</div>



</div>



<!-- Hidden fields -->

<input type="hidden" class="form-control" id="CurrentDateTime" placeholder="Mobile" value="<?php echo date("d-m-Y H:i A");?>">





<!-- -->

</div>

<div class="modal-footer">

 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

 <button type="submit" class="btn btn-primary" id="addEmployeeButton">Add</button>

</div>

</div>

</form>

</div>

</div>


<div class="modal fade" id="Reason_for_leave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

 <div class="modal-dialog  modal-lg" role="document">



  <div class="modal-content">

   <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

    <h4 class="modal-title" id="AddFreeTrailLabel">Reason For Leave</h4>

  </div>

  <div class="modal-body">



    <div class="row">




     <div class="col-sm-3">

      <div class="form-group">

       <label for="Joining Sources">Reason For Leave:</label>

       <select class="form-control" name="Reason_for_leave" id = "Reason_for_leave_value" required>

        <option value="" selected>Select</option>

        <option value="Absconding">Absconding</option>

        <option value="Resign">Resign</option>

        <option value="Terminated">Terminated</option>

        <option value="Fraud Activity">Fraud Activity</option>
        <option value="Poor Performance">Poor Performance</option>



      </select>

    </div>

  </div>
  <div class="col-md-3">
    <div class="form-group">
     <label>Last Working Day</label>
     <input type="date" data-date="" name="Last_Working_Date" id="Last_Working_Dates" data-date-format="DD MMMM YYYY" value="<?php echo date('Y-m-d'); ?>" class="form-control" />
   </div>
 </div>





</div>




</div>

<div class="modal-footer">

  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

  <button type="button" class="btn btn-primary" id="leave_button">Add</button>

</div>

</div>



</div>

</div>



<form action="stock-tips-delete.php" method="get" style="display:none">

 <input type="text" name="Id" class="Id" value=""/>



 <input type="submit" id="aa"/>

</form>

<?php include('partial/footer.php') ?>





<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>



<script type="text/javascript">







  $(document).ready(function(){

    // $("#no_content_to_checkbox").prop("checked")
    //  alert();
    //  $("#permanent_adress").hide();   
    // }
    $("#no_content_to_checkbox").on('click', function(){
      $("#no_content_to_checkbox").attr("checked") ? $("#permanent_adress").attr('disabled', true) : $("#permanent_adress").attr('disabled', false);
    })
    
    
    $("#Re_Enter_Account_NO").focusin(function(){
      $("#Re_Enter_Account_NO").css({"background-color":"#fff", "border":"1px solid #ccc"});
    }); 
    $("#Re_Enter_Account_NO").focusout(function(){

     var re_enter_acc_no = $("#Re_Enter_Account_NO").val();
     var acc_no          = $("#Account_NO").val();

     if(re_enter_acc_no != acc_no){
       $("#Re_Enter_Account_NO").css({"background-color":"yellow", "border":"2px solid red"});
       $("#acc_no_error").text("Account No doesn't match");
       $("#acc_no_error").css({"color":"red", "font-size":"12px"});
       $(':input[type="submit"]').prop('disabled', true);
     }else{
       $("#Re_Enter_Account_NO").css({"background-color":"#fff", "border":"1px solid #ccc"});
       $("#acc_no_error").text("");
       $(':input[type="submit"]').prop('disabled', false);
     }


   });

    $("#re_enter_ifsc_code").focusin(function(){
      $("#re_enter_ifsc_code").css({"background-color":"#fff", "border":"1px solid #ccc"});
    }); 
    $("#re_enter_ifsc_code").focusout(function(){

     var re_enter_ifsc_code = $("#re_enter_ifsc_code").val();
     var ifsc_code          = $("#ifsc_code").val();

     if(re_enter_ifsc_code != ifsc_code){
       $("#re_enter_ifsc_code").css({"background-color":"yellow", "border":"2px solid red"});
       $("#ifsc_code_error").text("IFSC Code doesn't match");
       $("#ifsc_code_error").css({"color":"red", "font-size":"12px"});
       $(':input[type="submit"]').prop('disabled', true);
     }else{
       $("#re_enter_ifsc_code").css({"background-color":"#fff", "border":"1px solid #ccc"});
       $("#ifsc_code_error").text("");
       $(':input[type="submit"]').prop('disabled', false);

     }


   });




// $("#addEmployeeButton").click(function(){
//     // event.preventDefault(e)

//     var Account_NO = document.getElementById("Account_NO").value;
//        var Re_Enter_Account_NO = document.getElementById("Re_Enter_Account_NO").value;

//         var IFSC_Code = document.getElementById("IFSC_Code").value;
//        var Re_Enter_IFSC_Code = document.getElementById("IFSC_Code").value;

//        if(Account_NO != Re_Enter_Account_NO){
//            var Account_NO = document.getElemenetById("Account_NO_Error").innerHTML = "Account Number Not Matched";
//        }
//        else
//        if(IFSC_Code != Re_Enter_IFSC_Code){
//            var IFSC_Code = document.getElemenetById("IFSC_Code_Error").innerHTML = "IFSC Code Not Matched";
//        }
//        else
//        if(Account_NO == Re_Enter_Account_NO && IFSC_Code == Re_Enter_IFSC_Code){

//        }


// })






$(".Enable_Disable").click(function(){



 var id = $(this).attr('data-user-id');
 var Status = $(this).attr('data-user-status');
      //  alert(id);

      $.ajax({

        type:"post",

        url:"Ajax_files/Agent_Enable_Disable.php",

        data:{"CustomerId":id,"Status":Status},



        success:function(result){
                //console.log(result);
                window.location.reload();

                if(result == 'success'){



                }



              }



            })

    })


$(".Enable_Disables_Admin").click((e)=>{
 var id = $(e.target).attr('data-user-id');
 var Status = $(e.target).attr('data-user-status');
 var formData = {"Id":id,"Status":Status};
 console.log(formData)
 $.ajax({
  type:"post",
  url:"Ajax_files/Admin_Enable_Disable.php",
  data:formData,
  success:function(result){
   console.log(result);
   window.location.reload()
 }

})
})

$(".Enable_Disables").click(function(){



 var id = $(this).attr('data-user-id');
 var Status = $(this).attr('data-user-status');
 $("#Reason_for_leave").modal("show");
      //  alert(id);
      $(document).on("click","#leave_button",function(){


       // check start
       // if(Account_NO == Re_Enter_Account_NO && IFSC_Code == Re_Enter_IFSC_Code){
        var Reason_for_leave = $("#Reason_for_leave_value").val();
        var Last_Working_Date = $("#Last_Working_Dates").val();
        if(Reason_for_leave != '' && Last_Working_Date != ''){
         $.ajax({

          type:"post",

          url:"Ajax_files/Agent_Enable_Disable.php",

          data:{"CustomerId":id,"Status":Status,"Reason_for_leave":Reason_for_leave,"Date_of_Leave":Last_Working_Date},



          success:function(result){
                            //console.log(result);
                            window.location.reload();

                            if(result == 'success'){



                            }



                          }



                        })
       }else{
         alert("Please select reason for leave")
       }
        // check end 
       // }
       
      })

    })



 /*

  $("#Enable_CRM_Yes").click(function(){

     $("#Enable_CRM").trigger("click");

  });

  

  $("#Disable_CRM_No").click(function(){

     $("#Disable_CRM").trigger("click");

    alert('aaa');

  });

  

  

var Permission_CRM = $('#Permission_CRM').val();

  

  if (Permission_CRM == 'Yes') {

    $('.Enable_CRM_wrap').show();

    $('.Disable_CRM_wrap').hide();

  }

  

  else if (Permission_CRM == 'No')  {

       

    $('.Disable_CRM_wrap').show();

    $('.Enable_CRM_wrap').hide();

    

  }*/





  



  $(".No").click(function(){

    $(this).next().trigger("click");

  });



  $(".Yes").click(function(){

    $(this).next().trigger("click");

  });     

  



  $('.Status_wrap').find(".Status").each(function() {

    var Status = $(this).val();



    if(Status =='Active') {

      $(this).prev().hide();

    }

    else {

      $(this).next().hide();

    }



  });

  

  





  

  /**********************************************/

  /*

  $("#Enable_Admin_Yes").click(function(){

     $("#Enable_Admin").trigger("click");

    alert('Enable');

  });

  

  $("#Disable_Admin_No").click(function(){

     $("#Disable_Admin").trigger("click");

    alert('Disable');

  });*/

  

  /*

var Permission_Admin = $('#Permission_Admin').val();

  

  if (Permission_Admin == 'Yes') {

    $('.Enable_Admin_wrap').show();

    $('.Disable_Admin_wrap').hide();

  }

  

  else if (Permission_Admin == 'No')  {

       

    $('.Disable_Admin_wrap').show();

    $('.Enable_Admin_wrap').hide();

    

    }

    */







  });









$(document).ready(function(){



  function Add() {

      ///alert('asd')

      if ( window.XMLHttpRequest ) { // code for IE7+, Firefox, Chrome, Opera, Safari

        aa = new XMLHttpRequest();

      }



      aa.onreadystatechange = function () {

        if ( aa.readyState == 4 && aa.status == 200 ) {

          document.getElementById( "txtHint" ).innerHTML = aa.responseText;

        }

      }



      var User = document.getElementById( 'User' ).value

      var Password = document.getElementById( 'Password' ).value

      //var Mobile = document.getElementById( 'Mobile' ).value



      aa.open( "GET", "employee-add.php?User=" + User + "&Password=" + Password, true );

      aa.send();

 //alert (User + Password)



 setTimeout( function () {

  location.reload();

 }, 1000 );



}





$('#Add').click(function(){



  var User = document.getElementById( 'User' ).value

  var Password = document.getElementById( 'Password' ).value



  if(User != "" && Password != "") {

    //alert('aa');

    Add();

  }

  else {

    //alert('bb');  

    $('.alert-danger').show();

      //alert('asdf')

    }

    

    

  });  







$("input").on("change", function() {

 var id_image = $(this).attr('id');
 if(id_image !='image'){
   this.setAttribute(

    "data-date",

    moment(this.value, "YYYY-MM-DD")

    .format( this.getAttribute("data-date-format") )

    )
 }

}).trigger("change")







});


$(".updatePassword").click((e)=>{
  var Id = $(e.target).attr('data-user-id');
  var Team_Leader_Name = $(e.target).attr('data-team-leader-name');
  $("#Team_Leader_Id").val(Id);
  $("#Team_Leader_Name").text(Team_Leader_Name)
  $("#UpdatePasswordModal").modal('show');
  $("#Update_Password").focus();
  console.log(Id);
})


function CheckAgentName(){
  var Full_Name_Check = $("#Full_Name_Check").val();
  if(Full_Name_Check=='')
  {
    return 1;
  }
  $.ajax({
   type:"post",
   url:"Ajax_files/Check_Agent_Name.php",
   data:{
    Agent_Name:Full_Name_Check
  },
  success:(res)=>{
    var Result = JSON.parse(res);
    if(Result.status == 'success'){
     $("#Full_Name_Check_Error").text('');
     return true;
   }
   else{
     $("#Full_Name_Check_Error").text('Agent Name Already Exists');
     $("#Full_Name_Check").focus();
     return false;
   }
 }
})
}

function CheckTeamLeaderName(){
  $("#Team_Leader_Form_Submit").prop('disabled',true);
  var TeamLeaderNameCheck = $("#TeamLeaderNameCheck").val();
  $.ajax({
   type:"post",
   url:"Ajax_files/Check_Agent_Name.php",
   data:{
    Agent_Name:TeamLeaderNameCheck,
    type:'TL'
  },
  success:(res)=>{
    console.log(res);
    var Result = JSON.parse(res);
    if(Result.status == 'success'){
     $("#Team_Leader_Name_Check_Error").text('');
     $("#Team_Leader_Form_Submit").prop('disabled',false);
     return true;
   }
   else{
     $("#Team_Leader_Name_Check_Error").text('Team Leader Name Already Exists');
     $("#Team_Leader_Form_Submit").prop('disabled',true);
     $("#TeamLeaderNameCheck").focus();
     return false;
   }
 }
})
}


</script>

<div class="modal" id="UpdatePasswordModal" tabindex="-1" role="dialog">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title">Update Password of <span id="Team_Leader_Name"></span></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>
 <div class="modal-body">
  <form id="Team_Leader_Update_Password" method="POST" action="Ajax_files/Admin_Enable_Disable.php" >
   <input type="hidden" name="Id" value="" id="Team_Leader_Id" required />
   <div class="form-group">
    <label>Update Password</label>
    <input type="password" name="password" id="Update_Password" class="form-control" required />
  </div>
</form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-primary" onclick="$('#Team_Leader_Update_Password').submit();">Save changes</button>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

          <script>

              $(function(){
                $.get("suggestion-search.php",{ role:"SR_TL", status:"Active" },function(response){
                  console.log(response);
                  var myArr = JSON.parse(response);
                  // var currencies = [
                  //     { value: 'Afghan afghani', data: 'AFN' },
                     
                  //     { value: 'Zimbabwean dollar', data: 'ZWD' },
                  //   ];

                  $('#autocomplete').autocomplete({
                    lookup: myArr,
                    onSelect: function (suggestion) {
                      var thehtml = '<strong>Currency Name:</strong> ' + suggestion.value + ' <br> <strong>Symbol:</strong> ' + suggestion.data;
                      $('#outputcontent').html(thehtml);
                    }
                  });

                });
                 });
            </script>