<?php  include('partial/session_start.php'); ?>



<?php

if(isset($_GET[ 'UserName' ]) && isset($_GET[ 'Source' ]) && isset($_GET[ 'Disposition' ])){
  $UserName = isset($_GET[ 'UserName' ]) ? $_GET[ 'UserName' ] :'';

  $Source = isset($_GET[ 'Source' ]) ? $_GET[ 'Source' ] :'';

  $Disposition = isset($_GET[ 'Disposition' ]) ? $_GET[ 'Disposition' ] :'';



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
      <a href="employee-login-details.php">Agent login details</a> |
      <a href="inactive-employee-login-details.php" >InActive Agent login details</a> 
      <a href="agents-importing-issue.php" >| Agents issue in importing</a> 

      <?php if($_SESSION['Role'] == "Super Admin"){ ?>
       | <a href="employee-login-details.php?filter=admin" <?php if(!empty($_GET['filter'])){ ?> class="btn btn-xs btn-primary" <?php } ?>>Team Leader login details</a>
       | <a href="inactive-employee-login-details.php?filter=admin" >InActive Team Leader login details</a>
       | <a href="sr-tl-login-details.php?filter=admin"  >SR Team Leader login details</a>
       | <a href="inactive-sr-tl-login-details.php?filter=admin" >InActive SR Team Leader login details</a>
       | <a href="updated_salaries_emp_list.php" class="btn btn-xs btn-primary">Updated Salaries Employees List</a>
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




 $sql = ( "SELECT ul.id, ul.employee_id, ul.previous_salary, ul.updated_salary, ul.salary_updated_at, e.username, e.Role, e.`Status`, e.`Id` AS employee_id, e.Photo FROM employee_salaries_update_logs as ul inner join employee as e ON ul.employee_id = e.Id
ORDER BY ul.id DESC LIMIT ".$initial_page." ,".$limit."");

$result = mysqli_query($connect, $sql );

      //echo( '<form action="aa.php" method="post">' );

echo( '<table id="employee" class="display table table-bordered" cellspacing="0" width="100%">' );

echo( '<thead>' );

echo( '<tr class="brand-color-bg">' );

echo( '<th>Employee</th>' );

echo( '<th>Role</th>' );

echo( '<th>Previous Salary</th>' );
echo( '<th>Updated Salary</th>' );
echo( '<th>Salary Updated At</th>' );
echo( '<th>Employee Status</th>' );
echo( '<th>Action</th>' );


echo( '</tr>' );

echo( '</thead>' );

echo( '<tbody>' );

while ( $row = mysqli_fetch_array( $result ) ) {

echo( '<tr>' );
echo( '<td>' . $row[ 'username' ] . '</td>' );
echo( '<td>' . $row[ 'Role' ] . '</td>' );
echo( '<td>' . $row[ 'previous_salary' ] . '</td>' );
echo( '<td>' . $row[ 'updated_salary' ] . '</td>' );
echo( '<td>' . $row[ 'salary_updated_at' ] . '</td>' );
echo( '<td>' . $row[ 'Status' ] . '</td>' );

echo( '<td> <a href="employee-login-details-update-tl.php?Id='.$row["employee_id"].'" class="btn btn-xs btn-primary employee-details-update">Update</a>' );
echo( '</tr>' );




}


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
        <a class="btn btn-success" href = "employee-login-details.php?page=<?php echo $page_number;?>&filter=admin"><?php echo $page_number; ?></a>
      <?php }else{?>
       <a class="btn btn-success" href = "employee-login-details.php?page=<?php echo $page_number;?>"><?php echo $page_number; ?></a>
     <?php }?>
   <?php }else{?>
     <?php   if(isset($_GET['filter']) && $_GET['filter'] == 'admin'){?>
      <a class="btn btn-primary" href = "employee-login-details.php?page=<?php echo $page_number;?>&filter=admin"><?php echo $page_number; ?></a>
    <?php }else{?>
     <a class="btn btn-primary" href = "employee-login-details.php?page=<?php echo $page_number;?>"><?php echo $page_number; ?></a>
   <?php }?>
 <?php }}  
 ?>
</div>
<?php }?>

</div>



<!-- Modal -->




<!-- Modal -->










<?php include('partial/footer.php') ?>





<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>



<script type="text/javascript">







  $(document).ready(function(){

    // $("#no_content_to_checkbox").prop("checked")
    //  alert();
    //  $("#permanent_adress").hide();   
    // }
    





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




<?php if(isset($_GET['filter']) && $_GET['filter'] == 'admin'){?>
<script>

  $(function(){
    //alert('Team_Leader');
    $.get("suggestion-search.php",{ role:"Team_Leader", status:"Active" },function(response){
      console.log(response);
      var myArr = JSON.parse(response);
                  // var currencies = [
                  //     { value: 'Afghan afghani', data: 'AFN' },

                  //     { value: 'Zimbabwean dollar', data: 'ZWD' },
                  //   ];

                  $('#autocomplete').autocomplete({
                    lookup: myArr,
                    onSelect: function (suggestion) {
                      var thehtml = '<strong>Name:</strong> ' + suggestion.value + ' <br> <strong>Symbol:</strong> ' + suggestion.data;
                      $('#outputcontent').html(thehtml);
                    }
                  });

                });
  });
</script>
<?php } else {?>
<script>
  $(function(){
    // alert('Agent');
    $.get("suggestion-search.php",{ role:"Agent", status:"Active" },function(response){
      console.log(response);
      var myArr = JSON.parse(response);
                  // var currencies = [
                  //     { value: 'Afghan afghani', data: 'AFN' },

                  //     { value: 'Zimbabwean dollar', data: 'ZWD' },
                  //   ];

                  $('#autocomplete').autocomplete({
                    lookup: myArr,
                    onSelect: function (suggestion) {
                      var thehtml = '<strong>Name:</strong> ' + suggestion.value + ' <br> <strong>Symbol:</strong> ' + suggestion.data;
                      $('#outputcontent').html(thehtml);
                    }
                  });

                });
  });
</script>

<?php }?>