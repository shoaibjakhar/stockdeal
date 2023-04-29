<?php  include('partial/session_start.php'); ?>

<?php
// $UserName = $_GET[ 'UserName' ];
// $Source = $_GET[ 'Source' ];
// $Disposition = $_GET[ 'Disposition' ];

date_default_timezone_set( 'Asia/Kolkata' );

?>


<?php

  /*
  if($_SESSION['Role'] == 'Super Admin') {
      
   
  
   
      
  }
  
  else if ($_SESSION['Role'] != 'Super Admin') {
      
       die('This page content cannot be accessed');
      
  }
  */
  ?> 


  <!doctype html>
  <html>

  <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Agent</title>
   <?php require('partial/plugins.php'); ?>



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


  input[type="date"]::-webkit-calendar-picker-indicator {
    color: rgba(0, 0, 0, 0);
    opacity: 1;
    display: block;
    background: url(images/calendar.png) no-repeat;
    width: 20px;
    height: 20px;
    border-width: thin;
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/2.0.4/css/Jcrop.css" />
<!--https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/2.0.4/css/Jcrop.gif-->
<style>
  .modal-dialog {
    width:90% !important;
    margin:15px !important;
  }
/*
.jcrop-active{
    width:inherit !important;
    height:inherit !important;
}
*/
</style>

<body>


	<?php include('partial/sidebar.php') ?>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/2.0.4/js/Jcrop.min.js"></script>
	<div class="main_container">
		<header>
			<?php include('partial/header-top.php') ?>

		</header>
		<div class="breadcurms">
			<div class="pull-left">
       <a href="memberpage.php">Dashbord</a> | <a href="agent-request-received.php">Received</a> | <a href="agent-request-sent.php">Sent</a> | <a href="employee-login-details.php" class="btn btn-xs btn-primary">Agent login details</a>
     </div>

     <div class="clearfix"></div>
   </div>
   <div class="containter" style="padding:20px 20px 0 20px;">

     <?php include('connection/dbconnection_crm.php')?>
     <?php 

     $Id = $_GET["Id"];

     $sql = "SELECT * FROM  `employee` WHERE  `Id` = '" .$Id. "' ";
			  //echo $sql = "SELECT * FROM  `employee` WHERE Id = 138";

     $result = mysqli_query($connect , $sql );

     while ( $row = mysqli_fetch_array( $result ) ) {
      echo('<form action="employee-update.php" method="post">');
      echo('<div class="row">');
      echo('<input type="hidden" name="Id" value="'.$row['Id'].'">');




      ?>

      <div class="col-sm-3">
       <div class="form-group">
         <label for="profile_pic"> 
           <img src="<?php
           if($row['Photo'] != '' || $row['Photo'] != NULL){
             echo $row['Photo'];
           }
           else{

             echo "data:image/jpeg;base64,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";
           }
           ?>" style="width:200px;" id="main_img"/> 
           <span class="btn btn-success btn-block" style="border-top-left-radius: 0px;border-top-right-radius: 0px">Change Photo</span>
         </label>
         <input type="file" name="" id="profile_pic" style="display:none;">
         <input type="hidden" name="Photo" id="profile_picture_base_64">
       </div>
     </div>





     <?php




     echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="Date of Join">Date of Join:</label>
      <input type="date" data-date="" name="Date_of_Join" data-date-format="DD MMMM YYYY" value="'.$row['Date_of_Join'].'" class="form-control">

      </div>
      </div>');


     echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="Full Name">Full Name:</label>
      <input type="text" class="form-control" name="Full_Name" placeholder="Full Name" value="'.$row['username'].'" disabled>
      </div>
      </div>'); 


     echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="Password">Password:</label>
      <input type="text" class="form-control" name="Password" placeholder="Password" value="'.$row['Password'].'">
      </div>
      </div>');



     echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="Mobile">Mobile:</label>
      <input type="text" class="form-control" name="Mobile" placeholder="Mobile" value="'.$row['Mobile'].'">
      </div>
      </div>');

     echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="Emergency Contact Number">Emergency Contact Number:</label>
      <input type="text" class="form-control" name="Emergency_Contact_Number" placeholder="Emergency Contact Number" value="'.$row['Emergency_Number'].'">
      </div>
      </div>');

     echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="Date of Birth">Date of Birth:</label>
      <input type="date" data-date="" name="Date_of_Birth" data-date-format="DD MMMM YYYY" value="'.$row['Date_of_Birth'].'" class="form-control">
      </div>
      </div>');

     echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="Email">Email:</label>
      <input type="text" class="form-control" name="Email" placeholder="Email" value="'.$row['Email'].'">
      </div>
      </div>');







     $gen = ('<div class="col-sm-3">
      <div class="form-group">
      <label for="Gender">Gender:</label>
      <select class="form-control" name="Gender">');

     if($row['Gender'] == 'Male'){
      $gen .= '<option value="Male" selected>Male</option><option value="Female">Female</option>';
    }
    else if($row['Gender'] == 'Female'){
      $gen .= '<option value="Male" >Male</option><option value="Female" selected>Female</option>';
    }
    else{
      $gen .= '<option value="" selected>Select</option><option value="Male" >Male</option><option value="Female">Female</option>';
    }


    $gen .= ('</select>

      </div>
      </div>');

    echo $gen;
    $address_array = json_decode($row['Address']);

    $pincode = ($address_array->pincode) ? $address_array->pincode :'';
    $house_no = ($address_array->house_no) ? $address_array->house_no :'';
    $landmark = ($address_array->landmark) ? $address_array->landmark :'';
    $city = ($address_array->city) ? $address_array->city :'';
    $state = ($address_array->state) ? $address_array->state :'';


    echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="Blood_Group">Blood Group:</label>
      <input type="text" class="form-control" name="Blood_Group" placeholder="Blood Group" value="'.$row['Blood_Group'].'">
      </div>
      </div>');


    echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="pincode">PinCode:</label>
      <input type="text" class="form-control" name="Address[pincode]" placeholder="Pincode" value="'.$pincode.'" required>
      </div>
      </div>

      <div class="col-sm-6">
      <div class="form-group">
      <label for="house_no">Flat, House No., Building, Company, Apartment:</label>
      <input type="text" class="form-control" name="Address[house_no]" placeholder="Flat, House no" value="'.$house_no.'" required>
      </div>
      </div>
      <div class="col-sm-3">
      <div class="form-group">
      <label for="landmark">Landmark:</label>
      <input type="text" class="form-control" name="Address[landmark]" placeholder="Landmark" value="'.$landmark.'" required>
      </div>
      </div>

      <div class="col-sm-3">
      <div class="form-group">
      <label for="city">Town/City:</label>
      <input type="text" class="form-control" name="Address[city]" placeholder="City" value="'.$city.'" required>
      </div>
      </div>
      <div class="col-sm-3">
      <div class="form-group">
      <label for="state">State:</label>
      <select class="form-control" name="Address[state]" required>
      <option value="'.$state.'" selected>'.$state.'</option>
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
      </div>');
// <input type="text" class="form-control" name="Address[state]" placeholder="State" value="'.$state.'" required>
    if(!empty($row['Permanent_Address'])){
      $permanent_address = $row['Permanent_Address'];
    } else{
      $permanent_address = $house_no. ', '.$landmark.', '.$pincode. ', '. $city. ', '.$state;
    }		
    echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="Permanent Address">Permanent Address:</label>


      <textarea cols="30" rows="5"  class="form-control" name="Permanent_Address" placeholder="Permanent Address">'.$permanent_address. '</textarea>

      </div>
      </div>');
    $bank_name = $row['Bank_Details'];

    ?>

    <div class="col-sm-3">
      <div class="form-group">
        <label for="Bank Details">Bank Name:</label>
        
        <select class="form-control" name="Bank_Details" required>
          <option value="">Select Bank</option>
          <option value="">Select Bank</option>
          <option value="Bank of Baroda" <?php echo ($bank_name == "Bank of Baroda") ? "selected" : ""; ?>>Bank of Baroda</option>
          <option value="Bank of India" <?php echo ($bank_name == "Bank of India") ? "selected" : ""; ?> >Bank of India</option>
          <option value="Bank of Maharashtra" <?php echo ($bank_name == "Bank of Maharashtra") ? "selected" : ""; ?>>Bank of Maharashtra</option>
          <option value="Canara Bank" <?php echo ($bank_name == "Canara Bank") ? "selected" : ""; ?>>Canara Bank</option>
          <option value="Central Bank of India" <?php echo ($bank_name == "Central Bank of India") ? "selected" : ""; ?>>Central Bank of India</option>
          <option value="Indian Bank" <?php echo ($bank_name == "Indian Bank") ? "selected" : ""; ?>>Indian Bank</option>
          <option value="Indian Overseas Bank" <?php echo ($bank_name == "Indian Overseas Bank") ? "selected" : ""; ?>>Indian Overseas Bank</option>
          <option value="Punjab & Sind Bank" <?php echo ($bank_name == "Punjab & Sind Bank") ? "selected" : ""; ?>>Punjab & Sind Bank</option>
          <option value="Punjab National Bank" <?php echo ($bank_name == "Punjab National Bank") ? "selected" : ""; ?>>Punjab National Bank</option>
          <option value="State Bank of India" <?php echo ($bank_name == "State Bank of India") ? "selected" : ""; ?>>State Bank of India</option>
          <option value="UCO Bank" <?php echo ($bank_name == "UCO Bank") ? "selected" : ""; ?>>UCO Bank</option>
          <option value="Union Bank of India" <?php echo ($bank_name == "Union Bank of India") ? "selected" : ""; ?>>Union Bank of India</option>
          <option value="Axis Bank Ltd" <?php echo ($bank_name == "Axis Bank Ltd") ? "selected" : ""; ?>>Axis Bank Ltd.</option>
          <option value="Bandhan Bank Ltd" <?php echo ($bank_name == "Bandhan Bank Ltd") ? "selected" : ""; ?>>Bandhan Bank Ltd</option>
          <option value="CSB Bank Ltd" <?php echo ($bank_name == "CSB Bank Ltd") ? "selected" : ""; ?>>CSB Bank Ltd</option>
          <option value="City Union Bank Ltd" <?php echo ($bank_name == "City Union Bank Ltd") ? "selected" : ""; ?>>City Union Bank Ltd</option>
          <option value="DCB Bank Ltd" <?php echo ($bank_name == "DCB Bank Ltd") ? "selected" : ""; ?>>DCB Bank Ltd</option>
          <option value="Dhanlaxmi Bank Ltd" <?php echo ($bank_name == "Dhanlaxmi Bank Ltd") ? "selected" : ""; ?>>Dhanlaxmi Bank Ltd</option>
          <option value="Federal Bank Ltd" <?php echo ($bank_name == "Federal Bank Ltd") ? "selected" : ""; ?>>Federal Bank Ltd</option>
          <option value="HDFC Bank Ltd" <?php echo ($bank_name == "HDFC Bank Ltd") ? "selected" : ""; ?>>HDFC Bank Ltd</option>
          <option value="ICICI Bank Ltd" <?php echo ($bank_name == "ICICI Bank Ltd") ? "selected" : ""; ?>>ICICI Bank Ltd</option>
          <option value="Induslnd Bank Ltd" <?php echo ($bank_name == "Induslnd Bank Ltd") ? "selected" : ""; ?>>Induslnd Bank Ltd</option>
          <option value="IDFC First Bank Ltd" <?php echo ($bank_name == "IDFC First Bank Ltd") ? "selected" : ""; ?>>IDFC First Bank Ltd</option>
          <option value="Jammu & Kashmir Bank Ltd" <?php echo ($bank_name == "Jammu & Kashmir Bank Ltd") ? "selected" : ""; ?>>Jammu & Kashmir Bank Ltd</option>
          <option value="Karnataka Bank Ltd" <?php echo ($bank_name == "Karnataka Bank Ltd") ? "selected" : ""; ?>>Karnataka Bank Ltd</option>
          <option value="Karur Vysya Bank Ltd" <?php echo ($bank_name == "Karur Vysya Bank Ltd") ? "selected" : ""; ?>>Karur Vysya Bank Ltd</option>
          <option value="Kotak Mahindra Bank Ltd" <?php echo ($bank_name == "Kotak Mahindra Bank Ltd") ? "selected" : ""; ?>>Kotak Mahindra Bank Ltd</option>
          <option value="Nainital Bank Ltd" <?php echo ($bank_name == "Nainital Bank Ltd") ? "selected" : ""; ?>>Nainital Bank Ltd</option>
          <option value="RBL Bank Ltd" <?php echo ($bank_name == "RBL Bank Ltd") ? "selected" : ""; ?>>RBL Bank Ltd</option>
          <option value="South Indian Bank Ltd" <?php echo ($bank_name == "South Indian Bank Ltd") ? "selected" : ""; ?>>South Indian Bank Ltd</option>
          <option value="Tamilnad Mercantile Bank Ltd" <?php echo ($bank_name == "Tamilnad Mercantile Bank Ltd") ? "selected" : ""; ?>>Tamilnad Mercantile Bank Ltd</option>
          <option value="YES Bank Ltd" <?php echo ($bank_name == "YES Bank Ltd") ? "selected" : ""; ?>>YES Bank Ltd</option>
          <option value="IDBI Bank Ltd" <?php echo ($bank_name == "IDBI Bank Ltd") ? "selected" : ""; ?>>IDBI Bank Ltd</option>
          <option value="Au Small Finance Bank Limited" <?php echo ($bank_name == "Au Small Finance Bank Limited") ? "selected" : ""; ?>>Au Small Finance Bank Limited</option>
          <option value="Capital Small Finance Bank Limited" <?php echo ($bank_name == "Capital Small Finance Bank Limited") ? "selected" : ""; ?>>Capital Small Finance Bank Limited</option>
          <option value="Equitas Small Finance Bank Limited" <?php echo ($bank_name == "Equitas Small Finance Bank Limited") ? "selected" : ""; ?>>Equitas Small Finance Bank Limited</option>
          <option value="Suryoday Small Finance Bank Limited" <?php echo ($bank_name == "Suryoday Small Finance Bank Limited") ? "selected" : ""; ?>>Suryoday Small Finance Bank Limited</option>
          <option value="Ujjivan Small Finance Bank Limited" <?php echo ($bank_name == "Ujjivan Small Finance Bank Limited") ? "selected" : ""; ?>>Ujjivan Small Finance Bank Limited</option>
          <option value="Utkarsh Small Finance Bank Limited" <?php echo ($bank_name == "Utkarsh Small Finance Bank Limited") ? "selected" : ""; ?>>Utkarsh Small Finance Bank Limited</option>
          <option value="ESAF Small Finance Bank Limited" <?php echo ($bank_name == "ESAF Small Finance Bank Limited") ? "selected" : ""; ?>>ESAF Small Finance Bank Limited</option>
          <option value="Fincare Small Finance Bank Limited" <?php echo ($bank_name == "Fincare Small Finance Bank Limited") ? "selected" : ""; ?>>Fincare Small Finance Bank Limited</option>
          <option value="Jana Small Finance Bank Limited" <?php echo ($bank_name == "Jana Small Finance Bank Limited") ? "selected" : ""; ?>>Jana Small Finance Bank Limited</option>
          <option value="North East Small Finance Bank Limited" <?php echo ($bank_name == "North East Small Finance Bank Limited") ? "selected" : ""; ?>>North East Small Finance Bank Limited</option>
        </select>  
        <!--<textarea cols="30" rows="4" class="form-control" name="Bank_Details" placeholder="Permanent Address" value="" required></textarea>-->
      </div>
    </div>


    <?php

// 		echo('');

    ?>
    <div class="col-sm-3">

      <div class="form-group">

        <label for="PAN Number">Account NO:</label>

        <input type="password" class="form-control" name="Account_NO" placeholder="Account NO" id="Account_NO" required="true" value="<?php echo $row['Account_NO']?> ">

      </div>

    </div>

    <div class="col-sm-3">

      <div class="form-group">

        <label for="PAN Number">Re-Enter Account NO:</label><span id="acc_no_error"></span>
        <!--oninput="checkAccountNo()"-->
        <input id="Re_Enter_Account_NO"  type="password" class="form-control" name="Re_Enter_Account_NO" required="true" placeholder="Re-Enter Account NO" value="<?php echo $row['Account_NO']?>">

      </div>

    </div>

    <div class="col-sm-3">

      <div class="form-group">

        <label for="PAN Number">IFSC Code:</label>

        <input type="password" class="form-control" name="IFSC_Code" id="ifsc_code" placeholder="IFSC Code" required="true" value="<?php echo $row['IFSC_Code']?>">

      </div>

    </div>


    <div class="col-sm-3">

      <div class="form-group">

        <label for="PAN Number">Re-Enter IFSC Code:</label><span id="ifsc_code_error"></span>

        <input type="password" class="form-control" name="Re_Enter_IFSC_Code" id="re_enter_ifsc_code" required="true" placeholder="IFSC Code" value="<?php echo $row['IFSC_Code']?>">

      </div>

    </div>

    <?php 

    echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="PAN Number">PAN Number:</label>
      <input type="text" class="form-control" name="PAN_Number" placeholder="PAN Number" value="'.$row['PAN_Number'].'">
      </div>
      </div>');

    echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="PAN_Photo_Copy">PAN Photo Copy:</label>
      <input type="text" class="form-control" name="PAN_Photo_Copy" placeholder="URL" value="'.$row['PAN_Copy'].'">
      </div>
      </div>');

    echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="Adhar Number">Adhar Number:</label>
      <input type="text" class="form-control" name="Adhar_Number" placeholder="Adhar Number" value="'.$row['Adhar_Number'].'">
      </div>
      </div>');

    echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="PAN_Photo_Copy">Adhar Photo Copy:</label>
      <input type="text" class="form-control" name="Adhar_Photo_Copy" placeholder="URL" value="'.$row['Adhar_Copy'].'">
      </div>
      </div>');


    $Joining_Sources = ('<div class="col-sm-3">
      <div class="form-group">
      <label for="Joining Sources">Joining Sources:</label>
      <select class="form-control" name="Joining_Sources">');

    if($row['Joining_Sources'] == 'Walk in Interview'){
      $Joining_Sources .= '<option value="Walk in Interview" selected>Walk in Interview</option><option value="Recruitment Agencies">Recruitment Agencies</option><option value="Advertisement">Advertisement</option><option value="Reference">Reference</option>';
    }
    else if($row['Joining_Sources'] == 'Recruitment Agencies'){
      $Joining_Sources .= '<option value="Walk in Interview">Walk in Interview</option><option value="Recruitment Agencies" selected>Recruitment Agencies</option><option value="Advertisement">Advertisement</option><option value="Reference">Reference</option>';
    }
    else if($row['Joining_Sources'] == 'Advertisement'){
      $Joining_Sources .= '<option value="Walk in Interview">Walk in Interview</option><option value="Recruitment Agencies">Recruitment Agencies</option><option value="Advertisement" selected>Advertisement</option><option value="Reference">Reference</option>';
    }

    else if($row['Joining_Sources'] == 'Reference'){
      $Joining_Sources .= '<option value="Walk in Interview">Walk in Interview</option><option value="Recruitment Agencies">Recruitment Agencies</option><option value="Advertisement">Advertisement</option><option value="Reference" selected>Reference</option>';
    }

    else{
      $Joining_Sources .= '<option value="" selected>Select</option><option value="Walk in Interview">Walk in Interview</option><option value="Recruitment Agencies">Recruitment Agencies</option><option value="Advertisement">Advertisement</option><option value="Reference">Reference</option>';
    }


    $Joining_Sources .= ('</select>

      </div>
      </div>');

    echo $Joining_Sources; 

    echo('<div class="col-sm-3">
      <div class="form-group">
      <label for="Referred by">Referred by:</label>
      <input type="text" class="form-control" name="Referred_by" placeholder="Referred_by" value="'.$row['Referred_by'].'">
      </div>
      </div>');

    echo('<div class="col-sm-3">
     <div class="form-group">
     <label for="Last Working Date">Last Working Date:</label>
     <input type="date" data-date="" name="Last_Working_Date" data-date-format="DD MMMM YYYY" value="'.$row['Date_of_Leave'].'" class="form-control">
     </div>
     </div>');

    $employeeAgreement = ('<div class="col-sm-3">
      <div class="form-group">
      <label for="Gender">Employee Agreement:</label>
      <select class="form-control" name="employeeAgreement">');

    if($row['employeeAgreement'] == 'Yes'){
      $employeeAgreement .= '<option value="Yes" selected>Yes</option><option value="No">No</option>';
    }
    else if($row['employeeAgreement'] == 'No'){
      $employeeAgreement .= '<option value="Yes">Yes</option><option value="No" selected>No</option>';
    }
    else{
      $employeeAgreement .= '<option value="" selected>Select</option><option value="Yes" >Yes</option><option value="No">No</option>';
    }


    $employeeAgreement .= ('</select>

      </div>
      </div>');

    echo $employeeAgreement;


    $Marital_Status = ('<div class="col-sm-3">
      <div class="form-group">
      <label for="Marital Status">Marital Status:</label>
      <select class="form-control" name="Marital_Status">');

    if($row['Marital_Status'] == 'Married'){
      $Marital_Status .= '<option value="Married" selected>Married</option><option value="Single">Single </option>';
    }
    else if($row['Marital_Status'] == 'Single'){
      $Marital_Status .= '<option value="Married" >Married</option><option value="Single" selected>Single</option>';
    }
    else{
      $Marital_Status .= '<option value="" selected>Select</option><option value="Married" >Married</option><option value="Single">Single</option>';
    }


    $Marital_Status .= ('</select>

      </div></div>');
    echo $Marital_Status;
    ?>

    <div class="col-sm-3">
      <div class="form-group">
        <label>Select Team Leader</label>
        <select class="form-control" name="Team_Leader" required>

          <option value="Admin" selected>Admin</option>
          <?php

                // $sel_tl = "SELECT username FROM admin WHERE (Role ='Team Leader' OR Role = 'compliance officer') AND Status = 'Active'";
          $sel_tl ="SELECT username FROM employee WHERE Role ='Team Leader' AND Status = 'Active'";
          echo  $sel_tl;

          $qry_tl = mysqli_query($connect,$sel_tl);
          while($fetch_tl = mysqli_fetch_assoc($qry_tl)){
            if($fetch_tl['username'] == $row['Team_Leader']){
              echo '<option selected value="'.$fetch_tl['username'].'">'.$fetch_tl['username'].'</option>';
              continue;
            }
            echo '<option value="'.$fetch_tl['username'].'">'.$fetch_tl['username'].'</option>';
          }
          ?>
        </select>
      </div>
    </div>
    <input type="hidden" class="form-control" name="salery" placeholder="" value="<?php echo $row['salery'];?>">
    <input type="hidden" class="form-control" name="Role" placeholder="" value="<?php echo $row['Role'];?>">

    <?php if($_SESSION['Role'] == 'Super Admin'){?>

      <div class="col-md-3">
        <div class="form-group">
          <label>Select Role</label>
          <select class="form-control" name="Role">
            <option value="Agent" <?php if($row['Role'] == 'Agent'){ echo 'selected'; } ?>>Agent</option>
            <option value="Customer Care" <?php if($row['Role'] == 'Customer Care'){ echo 'selected'; } ?>>Customer Care</option>
            <option value="Team Leader" <?php if($row['Role'] == 'Team Leader'){ echo 'selected'; } ?>>Team Leader</option>
          </select>
        </div>
      </div>

    <?php } ?>

    <?php if($_SESSION['Role'] == 'Super Admin'){?>
      <div class="col-md-3">
        <div class="form-group">
          <label>Salary</label>
          <input type="text" class="form-control" name="salery" placeholder="" value="<?php echo $row['salery'];?>">
        </div>
      </div>
    <?php } ?>

    <?php






    echo('<div class="col-sm-3">
     <div class="form-group">
     <label for="">&nbsp;</label>
     <input type="submit" id="submit_update" value="UPDATE" class="btn btn-primary" style="height: 36px;margin-top: 22px;">
     </div>
     </div>

     </div>');


  } 

  echo('</form>');

  ?>

</div>

</div>





<!-- Modal -->
<div id="crop_image" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Crop Image</h4>

      </div>
      <div class="modal-body">
       <img src="data:image/jpeg;base64,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" id="croppable_img"/>


       <input type="hidden"  id="x" name="x" />
       <input type="hidden"  id="y" name="y" />
       <input type="hidden"  id="x2" name="x2" />
       <input type="hidden"  id="y2" name="y2" />
       <input type="hidden"  id="h" name="h" />
       <input type="hidden"  id="w" name="w" />
       <input type="hidden" id="imgs" name="imgs" value=""><br>

       <button type="button" class="btn btn-sm btn-info" id="crop_btn" style="margin-left:45%;">Crop & Save</button>


     </div>

   </div>

 </div>
</div>





<?php include('partial/footer.php') ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

<script type="text/javascript">
	


  $(document).ready(function(){

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




    $("input").on("change", function() {
      this.setAttribute(
        "data-date",
        moment(this.value, "YYYY-MM-DD")
        .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change")



  });

</script>
<script>
  $("#profile_pic").change(function(){
    var ext = $('#profile_pic').val().split('.').pop().toLowerCase();
    console.log(ext);
    if($("#profile_pic").val() != ''){

      if($.inArray(ext, ['jpg','jpeg']) == -1) {
        alert('Only JPG and JPEG are allowed');
      }

      else{
        function showCoords(c)
        {
         $('#x').val(c.x);
         $('#y').val(c.y);
         $('#x2').val(c.x2);
         $('#y2').val(c.y2);
         $('#w').val(c.w);
         $('#h').val(c.h);
       };
       $("#crop_image").modal('show');
       $("#crop_image").preloader();
       var fileToUpload = $('#profile_pic').prop('files')[0];
       var data = new FormData();
       data.append('input_file_name',fileToUpload);
            //console.log(fileToUpload);
            $.ajax({
              type:"post",
              url:"/Profile/upload_image.php",
              data:data,
              contentType: false,
              cache: false,
              processData:false,
              success:function(result){
                   // console.log(result);
                   var getResult = JSON.parse(result);
                   if(getResult.status == 'success'){
                     $("#crop_image").preloader('remove');
                     $("#croppable_img").prop("src","/Profile/"+getResult.img_name);
                     $("#imgs").val(getResult.imgs);
                     $('#croppable_img').Jcrop({
                       onChange: showCoords,
                       onSelect: showCoords
                     });
                     $("#crop_btn").click(function(){

                       var x = $('#x').val();
                       var y = $('#y').val();
                       var x2 = $('#x2').val();
                       var y2 = $('#y2').val();
                       var h = $('#h').val();
                       var w = $('#w').val();
                       var imgs = getResult.img_name;
                       var emp_id = "<?php echo $Id; ?>"
                       var frm_dt = "x="+x+"&y="+y+"&x2="+x2+"&y2="+y2+"&h="+h+"&w="+w+"&imgs="+imgs + "&emp_id="+emp_id;
                       if(x =='' || y == '' || h=='' || w == ''){
                         alert("Please crop the image first.");
                       }
                       else{
                         $("#crop_image").preloader();
                         $.ajax({
                          type:"post",
                          url:"/Profile/image-crop.php",
                          data:frm_dt,
                          success:function(res){
                            var myResult = JSON.parse(res);
                            $("#crop_image").modal('hide');
                            $("#crop_image").preloader('remove');
                            $("#profile_picture_base_64").val(myResult.image_base);
                            $("#main_img").prop("src",myResult.image_base);
                                         //console.log(res);
                                         window.location.reload();
                                       } 
                                     })
                       }



                     })
                   }
                 }
               })
          }
        }

      })
  
  $('#crop_image').on('hidden.bs.modal', function () {
    // do something…
    window.location.reload();
  });
</script>

