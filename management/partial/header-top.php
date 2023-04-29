  <?php
  date_default_timezone_set('Asia/Kolkata'); 
	 $result = mysqli_query($connect, "SELECT Company_Name FROM Options WHERE Id = '1'");
         $Company_Name = mysqli_result($result, 0);
			//echo($Login_Logo);
			
			
error_reporting(0);

// if agent bank details are missing, will redirect on agent login details page
function check_agent_bank_details(){
    global $connect;
    if($_SESSION['username'] != '' && $_SESSION['Role'] == 'Team Leader'){
        $leadname = $_SESSION['username'];
        $sel = ("SELECT * FROM `employee` WHERE `Team_Leader` = '$leadname' and `OnWorking` != 'Off' and ((`Bank_Details` is null or `Bank_Details` = '') OR (`Account_NO` is null or `Account_NO` = '') OR (`IFSC_Code` is null or `IFSC_Code` = ''))");
        $qry = mysqli_query($connect, $sel);
        $fetch = mysqli_fetch_assoc($qry);
        // echo "<pre>"; print_r($fetch); echo "</pre>";
        // die("here");
        if(count($fetch) > 0){
            $_SESSION['error_message'] = "Please Update ALL Agent Bank Details And Unlock Your Profile!!";
            header("Location: employee-login-details.php"); 
        }
    }
    
}

			
	    ?>



<!--------New Code ahsan start--------- -->
<style>
  #BreakTimeStartButton:hover{
    right: 0px!important;
  }
</style>
<?php if($_SESSION["Role"] == "Team Leader"){?>
<button type="button" id="BreakTimeStartButton" class="btn btn-success" style="position: fixed; right: -82px; z-index: 999; top: 260px;" data-toggle="modal" data-target="#BreakTimeGroup" data-backdrop="static" data-keyboard="false"><i class="fa fa-coffee MR10" aria-hidden="true"></i> Break Time</button>
<?php }?>

<script>
  $(document).ready( function () {
    
/******************************************************************/
/********Datatable dynamic height ************************/ 
/****************************************************************/  
    
    var winHeight = $(window).height() - 300;
    
    
    $("#BreakRemark").hide();
    $("#StartBreakTime").hide();
    //$("#StopBreakTime").hide();
    /******************************************************************/
/******** Modal Break Time Category Wise ************************/  
/****************************************************************/  

  $("#BreakTimeGroupBut a").click(function(){
      // alert('asdf');
   // $("#BreakTimeGroupBut a").removeClass('btn-warning')  
   // $("#BreakTimeGroupBut a").removeClass('btn-primary') 
    $("#BreakTimeGroupBut a").addClass('btn-primary') 
   $(this).removeClass('btn-primary')  
   $(this).addClass('btn-success')  
  });
  
  
  $("#WashRoom").click(function(){
   $('#BreakTimeImage').attr('src', 'assests/Images/Wash-Room.png');
    $("#BreakRemark").hide();
    $("#BreakRemark").val("");
    $("#StartBreakTime").show();
    $("#StartBreakTime").attr('data-action-type','assests/Images/Wash-Room.png');
    $("#StartBreakTime").attr('data-action-val','WashRoom');
    
    
  });
   $("#Tea").click(function(){
   $('#BreakTimeImage').attr('src', 'assests/Images/Tea.png');
    $("#BreakRemark").hide();
    $("#BreakRemark").val("");
    $("#StartBreakTime").show();
    $("#StartBreakTime").attr('data-action-type','assests/Images/Tea.png');
    $("#StartBreakTime").attr('data-action-val','Tea');
    
    
  });
 $("#Dinner_Lunch").click(function(){
   $('#BreakTimeImage').attr('src', 'assests/Images/Dinner-Lunch.png');
    $("#BreakRemark").hide();
    $("#BreakRemark").val("");
    $("#StartBreakTime").show();
    $("#StartBreakTime").attr('data-action-type','assests/Images/Dinner-Lunch.png');
    $("#StartBreakTime").attr('data-action-val','Dinner_Lunch');
  });
 $("#Meeting").click(function(){
   $('#BreakTimeImage').attr('src', 'assests/Images/Meeting.png');
   $("#BreakRemark").show();
   $("#StartBreakTime").show();
   $("#BreakRemark").val("");
   $("#StartBreakTime").attr('data-action-type','assests/Images/Meeting.png');
   $("#StartBreakTime").attr('data-action-val','Meeting');
  });
   $("#Others").click(function(){
   $('#BreakTimeImage').attr('src', 'assests/Images/Others.png');
   $("#BreakRemark").show();
   $("#BreakRemark").val("");
   $("#StartBreakTime").show();
   $("#StartBreakTime").attr('data-action-type','assests/Images/Others.png');
   $("#StartBreakTime").attr('data-action-val','Others');
  });
    
$("#StartBreakTime").click(function(){
    
   // $("#BreakTimeModalShow").modal({backdrop: 'static', keyboard: false});
    var image = $(this).attr('data-action-type');
    var type = $(this).attr('data-action-val');
    //alert(type);
    
    if(type == 'Meeting' || type == 'Others' ){
        var remark = $("#BreakRemark").val();
        if(remark.length <5){
            alert("Minimum 5 Characters are Required");
            $("#BreakRemark").focus();
        }
        else{
            $("#SetBreakStatusImage").attr('src',image);
            $("#BreakTimeGroup").modal('hide');
            $("#BreakTimeModalShow").modal({backdrop: 'static', keyboard: false});
        }
    }else{
       $("#SetBreakStatusImage").attr('src',image);
       $("#BreakTimeGroup").modal('hide');
       $("#BreakTimeModalShow").modal({backdrop: 'static', keyboard: false});
    }
    
    
})
    
    
    
    
    
/*********************************************************/
/******** Break Time Start Button Animate slide toggle ********************/  
/********************************************************/
$("#BreakTimeStartButton").hover(function(){
  $(this).stop().animate({right: '0px'});
  }, function(){
  $(this).stop().animate({right: '-82px'});
});


});
</script>



<div id="Category_Break_Modal_load_content">
 <!-- Modal Break Time Category Wise -->
  <div class="modal fade" id="BreakTimeGroup" role="dialog">
    <div class="modal-dialog"> 
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header ">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Break Time</h4>
        </div>
        <div class="modal-body">
          <div>
       <img src="Dinner-Lunch.png" alt="" id="BreakTimeImage" style="width:100%;">
      </div>
          <div>
            <div class="btn-group btn-group-justified" id="BreakTimeGroupBut"> 
        <!--<a href="#" class="btn btn-primary" id="WashRoom">Wash Room</a> -->
        <a href="#" class="btn btn-primary" id="Dinner_Lunch">Dinner/Lunch</a>
        <a href="#" class="btn btn-primary" id="Tea">Tea</a> 
        <a href="#" class="btn btn-primary" id="Meeting">Meeting</a> 
        <!--<a href="#" class="btn btn-primary" id="Others">Others</a> -->
        
      </div>
        <div> 
    <input type="text" class="form-control" id="BreakRemark" placeholder="Enter Remark" style="margin-top: 10px; display: none;"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-lg" id="StartBreakTime" data-action-type="" data-action-val="" style="display: none;">Start Break Time</button>
         
      <!--  data-dismiss="modal" -->
        </div>
      </div>
    </div>
  </div>




  <div class="modal fade" id="BreakTimeModalShow" role="dialog">
    <div class="modal-dialog"> 
      
     
      <div class="modal-content">
        <div class="modal-body text-center" style="background: #f3f3f3">
          <div> <img src="placeholder.png" id="SetBreakStatusImage" style="max-width: 566px;" alt=""> </div>
          <p>
          </p><div>
            <input type="hidden" name="type" id="type" value="dinner">
            <div class="values" style="font-size: 70px;" id="basicUsage">00:00:00</div>
           
           <script>
           $(document).ready(function(){
             var timer = new Timer();
           $('#StartBreakTime').click(function(){
                //alert("Hello");
                var remark = $("#BreakRemark").val();
                var type = $(this).attr('data-action-val');

                $("#type").val(type);
                
                
                 if(type == 'Meeting' || type == 'Others' ){
                    if(remark.length >=5){
                                 // $.post("Ajax_files/StartBreakNew.php",{type:type,remark:remark },function(results){
                                 //    console.log('Break Started');
                                 //    console.log(results);
                                 // });
                             
                              $(timer).on('secondsUpdated', function(e) {
                                $('#basicUsage').html(timer.getTimeValues().toString());
                              });
                              timer.start();
                              // autoRun();
                       
                    }
                    
                }else{
                  
                     
                     // $.post("Ajax_files/StartBreakNew.php",{type:type,remark:remark },function(results){
                     //     console.log('Break Started');
                     //     console.log(results);
                     // });
                 
                  $(timer).on('secondsUpdated', function(e) {
                    $('#basicUsage').html(timer.getTimeValues().toString());
                  });
                  timer.start();
                   // autoRun();
                }
                   
                  
                  
                  
                 
                });
                
                $("#BreakTimeEnd").click(function(){
                   // var timer = new Timer();
                   var total_time = $("#basicUsage").text();
                   const myArray = total_time.split(":");
                   let hours = parseInt(myArray[0]);
                   let minuts = parseInt(myArray[1]);
                   let seconds = parseInt(myArray[2]);
                   var time_in_minuts =(hours*60*60) + minuts;
                   //alert(time_in_minuts);
                  
                    timer.stop();
                     // pause();
                    // var time = "time";
                    var remark = $("#BreakRemark").val();
                    var type= $("#type").val();
                    //alert(type);
                 
                     $.post("Ajax_files/StopBreakNew.php",{time:time_in_minuts,type:type,remark:remark},function(res)
                     {
                        //alert(res);
                         //window.location.reload();
                     });
                })
           });
          
              
         </script>
            <script src="https://cdn.jsdelivr.net/npm/easytimer@1.1.1/src/easytimer.min.js"></script>      
          </div>
          
        </div>
        <div class="modal-footer text-center">
          <button type="button" id="BreakTimeEnd" class="btn btn-lg btn-primary" data-dismiss="modal">Break Complete</button>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="header-top">
  <div class="">
    <div class="col-xs-4">
    
     <img src="images/menu-2.png" alt="2" title="2" id="" class="toggle-menu" style="display:none;"/>
    <!-- <img src="images/logo.png" alt="Real Stock Ideas" class="logo" title="Real Stock Ideas"/>--></div>
    <div class="col-xs-5"><p class="text-center font-size18">Welcome to Stock Deal  </p></div>
    <div class="col-xs-3"><p class="font-size18 logout"><a href="logout.php">Logout&nbsp; <img src="images/logout.png"/></a></p></div>
  </div>
  <div class="clearfix"></div>
</div>
