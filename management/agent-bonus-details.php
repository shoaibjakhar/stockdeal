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
    <a href="team-lead-advance-payment-details.php" >Team Lead Advance Payment</a> |
    <a href="agent-bonus-details.php" class="btn btn-xs btn-primary" >Agent Bonus Details</a> 

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

  $sql="SELECT bonus.*, employee.username
        FROM bonus
        INNER JOIN employee ON bonus.employee_id=employee.id WHERE employee.Role='Agent' ORDER BY bonus.id DESC";
        $result = mysqli_query($connect, $sql );


   $sql1 = "SELECT Id,username FROM employee  where  Role='Agent' AND Status='Active' ORDER BY  `username` ASC LIMIT 0 , 1000";

   $agents = mysqli_query($connect, $sql1 );
    if(!empty($_SESSION['error'])){ ?>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="alert alert-warning alert-dismissible show" role="alert">
                  <strong><?php echo $_SESSION['error']; ?></strong> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
           
    <?php unset($_SESSION['error']); } else if (!empty($_SESSION['success'])){ ?>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="alert alert-success alert-dismissible show" role="alert">
                  <strong><?php echo $_SESSION['success']; ?></strong> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    <?php unset($_SESSION['success']); }?>


  <table id="agent_payment" class="display table-bordered" style="">
    <thead>
      <tr>

        <th>Sr#</th>
        <th>Agent Name</th>
        <th>Bonus Amount</th>
        <th>Date</th>
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
           <td><?php echo $fetch['amount'];?></td>
           <td><?php echo $fetch['valid_date'];?></td>           
           <td>
            <a  href='edit-employee-bonus-details.php?id=<?php echo $fetch["id"] ?>' class="btn btn-xs btn-success">Edit</a>
            <a onclick="return confirm('Are you sure?')" href='delete-bonus.php?id=<?php echo $fetch["id"] ?>' class="btn btn-xs btn-danger">Delete</a>
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

   <form action="add-employee-bonus-details.php" method="post" enctype="multipart/form-data">
     <!--<form>-->
      <input type="hidden" name="Role" value="Agent">
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
               <label for="state">Select Agent:</label>
               <select class="form-control" name="employee_id" id="employee_id" required>
                <option value="" selected disabled>Select</option>
                <?php foreach ($agents as $key => $agent) {?>
                <option value="<?php echo $agent['Id'] ?>"><?php echo $agent['username'] ?></option>
               <?php }?>
              </select>  
            </div>
          </div>
          <div class="col-sm-3" id="Salery_dive">

              <div class="form-group">

               <label for="Date of Join">Agent Salery:</label>

               <input type="text"  id="current_salery" value="0.00" class="form-control" >

             </div>
         </div>
           <div class="col-sm-3">

          <div class="form-group">

           <label for="Date of Join">Bonus Amount:</label>

           <input type="number"  name="amount"  value="" class="form-control" required>

         </div>

       </div>
         <div class="col-sm-3">

          <div class="form-group">

           <label for="Date of Join">Date:</label>

           <input type="date"  name="valid_date"  value="<?php echo Date('Y-m-d');?>" class="form-control" required>

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


    $('#agent_payment').DataTable();
    
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

