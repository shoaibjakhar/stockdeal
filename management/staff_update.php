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
  
  <?php 

    if ($_GET['id']) {
  
      $sql = "SELECT * FROM staff WHERE id=".$_GET['id'];
      $qry = mysqli_query($connect, $sql);
      $vendor_data = mysqli_fetch_assoc($qry);


    }

  ?>



   <form action="staff_form_save.php" method="post" enctype="multipart/form-data">
     <!--<form>-->
         <input type="hidden" name="id" value="<?php echo isset($vendor_data['id']) ? $vendor_data['id'] :'' ?>">

        <div class="row">

       <div class="col-sm-3">

        <div class="form-group">

         <label for="Full Name">Name:</label>

         <input type="text" class="form-control Full_Name" name="beneficiary_name" placeholder="Full Name" value="<?php echo isset($vendor_data['beneficiary_name']) ? $vendor_data['beneficiary_name'] :'' ?>" required>
         <p class="" style="color:red;" id="Full_Name_Check_Error"></p>
       </div>

     </div>

   <div class="col-sm-3">

    <div class="form-group">

     <label for="Mobile">Mobile:</label>

     <input type="text" class="form-control" name="mobile" placeholder="Mobile" value="<?php echo isset($vendor_data['mobile']) ? $vendor_data['mobile'] :'' ?>" required>

   </div>

 </div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="Email">Email:</label>

   <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo isset($vendor_data['email']) ? $vendor_data['email'] :'' ?>">

 </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

   <label for="Gender">Category:</label>



   <select class="form-control" name="category" required>

    <option value="" selected>Select</option>

    <option value="House Keeping" <?php echo ($vendor_data['category'] == "House Keeping") ? 'selected' :'' ?>>House Keeping</option>
    <option value="Trainer" <?php echo ($vendor_data['category'] == "Trainer") ? 'selected' :'' ?>>Trainer</option>
    <option value="HR" <?php echo ($vendor_data['category'] == "HR") ? 'selected' :'' ?>>HR</option>
  </select>



</div>

</div>










 <div class="col-sm-6">
  <div class="form-group">
   <label for="Permanent Address">Address:</label>
   <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo isset($vendor_data['address']) ? $vendor_data['address'] :'' ?>" required>
 </div>
</div>



<div class="col-sm-3">

  <div class="form-group">

   <label for="Bank Details">Bank Name:</label>

<?php $bank_name = isset($vendor_data['bank_name']) ? $vendor_data['bank_name'] :'' ?>
   <select class="form-control" name="bank_name" required>
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



<div class="col-sm-3">

  <div class="form-group">

    <label for="PAN Number">Account NO:</label>

    <input id="Account_NO" type="password" class="form-control" name="account_no" required="true" placeholder="Account NO" value="<?php echo isset($vendor_data['account_no']) ? $vendor_data['account_no'] :'' ?>">

  </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

    <label for="PAN Number">Re-Enter Account NO:</label><span id="acc_no_error"></span>

    <input id="Re_Enter_Account_NO" type="password" class="form-control" required="true" name="Re_Enter_Account_NO" placeholder="Re-Enter Account NO" value="<?php echo isset($vendor_data['account_no']) ? $vendor_data['account_no'] :'' ?>">

  </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

    <label for="PAN Number">IFSC Code:</label><span id="ifsc_code_error"></span>

    <input id="ifsc_code" type="password" class="form-control" name="ifsc_code" required="true" placeholder="IFSC Code" value="<?php echo isset($vendor_data['ifsc_code']) ? $vendor_data['ifsc_code'] :'' ?>">

  </div>

</div>

<div class="col-sm-3">

  <div class="form-group">

    <label for="PAN Number">Re-Enter IFSC Code:</label><span id="ifsc_code_error"></span>

    <input id="re_enter_ifsc_code" type="password" class="form-control" name="Re_Enter_IFSC_Code" required="true" placeholder="Re-Enter IFSC Code" value="<?php echo isset($vendor_data['ifsc_code']) ? $vendor_data['ifsc_code'] :'' ?>">

  </div>

</div>

   <div class="col-sm-3">


     <div class="form-group">

      <label for="Last Working Date">Amount</label>

      <input type="number" required name="amount" value="<?php echo isset($vendor_data['amount']) ? $vendor_data['amount'] :'' ?>" class="form-control">

    </div>

  </div>

  <div class="col-sm-3">


     <div class="form-group">

      <label for="Last Working Date">Remarks</label>

      <input type="text" required name="remarks" value="<?php echo isset($vendor_data['remarks']) ? $vendor_data['remarks'] :'' ?>" class="form-control">

    </div>

  </div>
   <div class="col-sm-3">
     <div class="form-group">
      <button type="submit" name="update" value="update" class="btn btn-primary">Update</button>
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

</form>










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