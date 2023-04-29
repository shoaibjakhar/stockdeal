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
    <a href="agent-advance-payment-details.php" >Agent Advance Payment</a> | 
    <a href="team-lead-advance-payment-details.php" class="btn btn-xs btn-primary">Team Lead Advance Payment</a> 

  </div>

  <div class="pull-right">

   <a href="#" class="btn btn-xs btn-primary addEmployeeLogindetails" data-toggle="modal" data-target="#addPaymentDetail"><i class="fa fa-plus"></i> Add</a>

 </div>

 <div class="clearfix"></div>

</div>

<div class="containter" style="padding:20px 20px 0 20px;">


  <?php include('connection/dbconnection_crm.php')?>

  <?php

  // $sql = "SELECT * FROM Advance_salary  where  Role='Agent' ORDER BY  `id` DESC LIMIT 0 , 1000";

  // $result = mysqli_query($connect, $sql );

  $sql="SELECT Advance_salary.*, employee.username
        FROM Advance_salary
        INNER JOIN employee ON Advance_salary.employee_id=employee.id WHERE employee.Role='Team Leader' ORDER BY Advance_salary.id DESC";
        $result = mysqli_query($connect, $sql);


   $sql1 = "SELECT * FROM employee  where  Role='Team Leader' AND Status='Active' ORDER BY  `id` DESC LIMIT 0 , 1000";

  $team_leaders = mysqli_query($connect, $sql1 );

  ?>


  <table id="tl_payment" class="display" style="text-align: center;">
    <thead>
      <tr>

        <th>Sr#</th>
        <th>Team Lead Name</th>
        <th>Advance Payment</th>
        <th>Return Payment</th>
        <th>Total installment</th>
        <th>Return in installment</th>
        <th>Return installment</th>
        <th>Advance Payment Date</th>
        <th>Action</th>

      </tr>
    </thead>
    <tbody>
      <?php 
      if(1){ 
        $i=0;
        while($fetch = $result->fetch_assoc())
        {
          $i++;
          ?>
          <tr>
           <td><?php echo $i;?> </td>
           <td><?php echo $fetch['username'];?> </td>
           <td><?php echo $fetch['advance_payment'];?></td>
           <td><?php echo $fetch['return_payment'];?></td>
           <td><?php echo $fetch['total_num_installment'];?></td>
           <td><?php echo $fetch['return_in_installment'];?></td>
           <td><?php echo $fetch['return_installment'];?></td>
           <td><?php echo $fetch['advance_payment_date'];?></td>
           <td>
            <a  href='edit-employee-advance-payment-details.php?id=<?php echo $fetch["id"] ?>' class="btn btn-xs btn-success">Edit</a>
            <a onclick="return confirm('Are you sure?')" href='#delete.php?id=<?php echo $fetch["id"] ?>' class="btn btn-xs btn-danger">Delete</a>
          </td>

        </tr>   

        <?php   
      }
    }
    ?>
  </tbody>
</table>


</div>







</div>

<!-- Modal -->

<div class="modal fade" id="addPaymentDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog  modal-lg" role="document">

   <form action="add-employee-advance-payment-details.php" method="post" enctype="multipart/form-data">
     <!--<form>-->
      <input type="hidden" name="Role" value="Team Leader">
      <input type="hidden" name="total_num_installment" value="6">
      <div class="modal-content">

       <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="AddFreeTrailLabel">Add New Employee Payment Details</h4>

      </div>

      <div class="modal-body">

        <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
               <label for="state">Select Team Lead:</label>
               <select class="form-control" name="employee_id"  id="employee_id" required>
                <option value="" disabled>Select</option>
                <?php foreach ($team_leaders as $key => $team_leader) {?>
                <option value="<?php echo $team_leader['Id'] ?>"><?php echo $team_leader['username'] ?></option>
               <?php }?>
              </select>  
            </div>
          </div>
          <div class="col-sm-3" id="Salery_dive">

              <div class="form-group">

               <label for="Date of Join">Team Lead Salery:</label>

               <input type="text"  id="current_salery" value="0.00" class="form-control" >

             </div>
         </div>
           <div class="col-sm-3">

          <div class="form-group">

           <label for="Date of Join">Advance Payment:</label>

           <input type="number"  name="advance_payment"  value="" class="form-control" required>

         </div>

       </div>
         <div class="col-sm-3">

          <div class="form-group">

           <label for="Date of Join">Advance Payment Date:</label>

           <input type="date"  name="advance_payment_date"  value="" class="form-control" required>

         </div>

       </div>

    <div class="col-sm-3">

      <div class="form-group">

       <label for="Marital Status">Return IN Installment:</label>
       <select class="form-control" name="return_in_installment" required>

        <option value="1" selected>1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
      </select>
    </div>

  </div>

</div>
</div>


<div class="modal-footer">

 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

 <button type="submit" class="btn btn-primary" id="addEmployeeButton">Add</button>

</div>

</div>

</form>

</div>

</div>







<?php include('partial/footer.php') ?>





<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>



<script>

  $(document).ready(function(){


    $('#tl_payment').DataTable();
    
    $('#employee_id').on('change', function() {

      var employee_id = this.value;
    $.ajax({
      url: "Ajax_files/get_employee_salery.php", 
      data:{id:employee_id},
      type:'post',
      success: function(result){
       $("#current_salery").val(result);
     } 

    });
  });

  });

</script>

