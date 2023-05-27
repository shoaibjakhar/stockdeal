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
      <a href="employee-login-details.php" >Agent login details</a> |
      <a href="inactive-employee-login-details.php" >InActive Agent login details</a> 
      <a href="agents-importing-issue.php" >| Agents issue in importing</a> 

      <?php if($_SESSION['Role'] == "Super Admin"){ ?>
       | <a href="employee-login-details.php?filter=admin">Team Leader login details</a>
       | <a href="inactive-employee-login-details.php?filter=admin" >InActive Team Leader login details</a>
       | <a href="sr-tl-login-details.php?filter=admin"  >SR Team Leader login details</a>
       | <a href="inactive-sr-tl-login-details.php?filter=admin" >InActive SR Team Leader login details</a>
       | <a href="updated_salaries_emp_list.php" >Updated Salaries Employees List</a>
       | <a href="Vendor_forms.php?filter=admin">Vendors Details</a>
       | <a href="support_staff.php?filter=admin" class="btn btn-xs btn-primary" >Staff Details</a>
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
  $getQuery = "SELECT * from employee  where  Role='Team Leader' AND status='Active'";  
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

  $sql = ( "SELECT * FROM staff  where status='Active' ORDER BY  `id` DESC");


$result = mysqli_query($connect, $sql );

      //echo( '<form action="aa.php" method="post">' );

echo( '<table id="employee" class="display table table-bordered" cellspacing="0" width="100%">' );
  echo( '<thead>' );
    echo( '<tr class="brand-color-bg">' );
      echo( '<th>Beneficiary Name</th>' );
      echo( '<th>Mobile</th>' );
      echo( '<th>Email</th>' );
      echo( '<th>Category</th>' );
      echo( '<th>Address</th>' );
      echo( '<th>Bank Name</th>' );
      echo( '<th>Account NO:</th>' );
      echo( '<th>IFSC Code:</th>' );
      echo( '<th>Amount</th>' );
      echo( '<th>Remarks</th>' );
      echo( '<th>Created At</th>' );
      echo( '<th>Updated At</th>' );
      echo( '<th>Action</th>' );
    echo( '</tr>' );
  echo( '</thead>' );
  echo( '<tbody>' );

while ( $row = mysqli_fetch_array( $result ) ) {

// echo "<pre>"; print_r($row); echo "</pre>";

  echo( '<tr>' );

echo( '<td>' . $row[ 'beneficiary_name' ] . '</td>' );
echo( '<td>' . $row[ 'mobile' ] . '</td>' );
echo( '<td>' . $row[ 'email' ] . '</td>' );
echo( '<td>' . $row[ 'category' ] . '</td>' );
echo( '<td>' . $row[ 'address' ] . '</td>' );
echo( '<td>' . $row[ 'bank_name' ] . '</td>' );
echo( '<td>' . $row[ 'account_no' ] . '</td>' );
echo( '<td>' . $row[ 'ifsc_code' ] . '</td>' );
echo( '<td>' . $row[ 'amount' ] . '</td>' );
echo( '<td>' . $row[ 'remarks' ] . '</td>' );
echo( '<td>' . $row[ 'created_at' ] . '</td>' );
echo( '<td>' . $row[ 'updated_at' ] . '</td>' );

echo( '<td><a href="staff_update.php?id='.$row['id' ].'" class="btn btn-xs btn-primary employee-details-update">Update</a>
   <a onclick="" href="staff_form_save.php?delete=1&id='.$row['id' ].'" class="btn btn-xs btn-danger">Delete</a></td>' );

}

echo( '</tr>' );

echo( '</tbody>' );

echo( '</table>' );

?>


</div>
</div>



<!-- Modal -->

<div class="modal fade" id="AddFreeTrail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog  modal-lg" role="document">

   <form action="staff_form_save.php" method="post" enctype="multipart/form-data">
     <!--<form>-->

      <div class="modal-content">

       <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="AddFreeTrailLabel">Add New Staff</h4>

      </div>

      <div class="modal-body">

        <div class="row">

       <div class="col-sm-3">

        <div class="form-group">

         <label for="Full Name">Name:</label>

         <input type="text" class="form-control Full_Name" onchange="return CheckAgentName()" id="Full_Name_Check" name="beneficiary_name" placeholder="Full Name" value="" required>
         <p class="" style="color:red;" id="Full_Name_Check_Error"></p>
       </div>

     </div>

   <div class="col-sm-3">

    <div class="form-group">

     <label for="Mobile">Mobile:</label>

     <input type="text" class="form-control" name="mobile" placeholder="Mobile" value="" required>

   </div>

 </div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="Email">Email:</label>

   <input type="text" class="form-control" name="email" placeholder="Email" value="">

 </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="Gender">Category:</label>



   <select class="form-control" name="category" required>

    <option value="" selected>Select</option>

    <option value="House Keeping">House Keeping</option>
    <option value="Trainer">Trainer</option>
    <option value="HR">HR</option>




  </select>



</div>

</div>










 <div class="col-sm-6">
  <div class="form-group">
   <label for="Permanent Address">Address:</label>
   <input type="text" class="form-control" name="address" placeholder="Address" value="" required>
 </div>
</div>



<div class="col-sm-3">

  <div class="form-group">

   <label for="Bank Details">Bank Name:</label>


   <select class="form-control" name="bank_name" required>
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

    <input id="Account_NO" type="password" class="form-control" name="account_no" required="true" placeholder="Account NO" value="">

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

    <input id="ifsc_code" type="password" class="form-control" name="ifsc_code" required="true" placeholder="IFSC Code" value="">

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

      <label for="Last Working Date">Amount</label>

      <input type="number" required name="amount" value="" class="form-control">

    </div>

  </div>

  <div class="col-sm-3">


     <div class="form-group">

      <label for="Last Working Date">Remarks</label>

      <input type="text" required name="remarks" value="" class="form-control">

    </div>

  </div>


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

 <button type="submit" class="btn btn-primary">Add</button>

</div>

</div>

</form>

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


  $(".No").click(function(){

    $(this).next().trigger("click");

  });



  $(".Yes").click(function(){

    $(this).next().trigger("click");

  });     

  });

</script>