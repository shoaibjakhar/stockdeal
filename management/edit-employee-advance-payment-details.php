<?php  
ob_start();
include('partial/session_start.php'); ?>

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


.Full_Name {text-transform: capitalize}


</style>



<body>





 <?php include('partial/sidebar.php') ?>



 <div class="main_container">

  <header>

   <?php include('partial/header-top.php') ?>



 </header>


 <div class="breadcurms">

   <div class="pull-left">

    <a href="memberpage.php">Dashbord</a> | 
    <a href="agent-advance-payment-details.php"     >Agent Advance Payment</a> | 
    <a href="team-lead-advance-payment-details.php" >Team Lead Advance Payment</a> 

  </div>



  <div class="clearfix"></div>

</div>

<div class="containter" style="padding:50px 72px 0 72px;">


  <?php include('connection/dbconnection_crm.php')?>

  <?php



  $id = $_GET[ 'id' ];

  $sql="SELECT Advance_salary.*, employee.username
  FROM Advance_salary
  INNER JOIN employee ON Advance_salary.employee_id=employee.id WHERE Advance_salary.id='".$id."'";
  $result = mysqli_query($connect, $sql);
  $row = $result->fetch_assoc();

  ?>

  <form action="update-employee-advance-payment-details.php" method="post" enctype="multipart/form-data">
   <!--<form>-->
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="Role" value="<?php echo $row['role']; ?>">
 
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
           <label for="state">Employee Name:</label>
          <input type="text" class="form-control" name="employee_name" value="<?php echo $row['username'] ?>" readonly> 
        </div>
      </div>
      <div class="col-sm-4">

        <div class="form-group">

         <label for="Date of Join">Advance Given:</label>

         <input type="number"  name="advance_payment"  value="<?php echo $row['advance_payment'] ?>" class="form-control" readonly>

       </div>

     </div>


<div class="col-sm-4">

      <div class="form-group">

       <label for="Date of Join">Installments Paid:</label>
        
        <select class="form-control" name="return_in_installment">
            
            <?php 
                for($i =0; $i <= $row['return_in_installment']; $i++){ 
            ?>
                <option><?php echo $i; ?></option>    
            <?php } ?>
        
        
        </select>



       <!--<input type="number"  name="return_installment"  value="<?php echo isset($row['return_installment'])? $row['return_installment']:0; ?>" class="form-control">-->

     </div>

   </div>

    <div class="col-sm-4">

      <div class="form-group">

       <label for="Date of Join">Return Date:</label>

       <input type="date"  name="return_payment_date"  value="<?php echo $row['return_payment_date'] ?>" class="form-control">

     </div>

   </div>

</div>

 <button type="submit" class="btn btn-primary pull-right" id="addEmployeeButton">Update</button>





</form>
</div>

</div>


<?php include('partial/footer.php') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>


