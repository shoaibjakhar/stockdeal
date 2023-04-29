<?php date_default_timezone_set('Asia/Kolkata'); ?>

<?php $_SESSION['user_session_time'] = time(); ?>
<!--------New Code ahsan start--------- -->
<style>
  #BreakTimeStartButton:hover{
    right: 0px!important;
  }
</style>

<button type="button" id="BreakTimeStartButton" class="btn btn-primary" style="position: fixed; right: -90px; z-index: 999; top: 260px;" data-toggle="modal" data-target="#BreakTimeGroup" data-backdrop="static" data-keyboard="false"><i class="fa fa-coffee MR10" aria-hidden="true"></i> Break Time</button>

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
   $(this).addClass('btn-warning')  
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
  $(this).stop().animate({right: '-90px'});
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




<!--------New Code ahsan end--------- -->
<div id="show_birth_day_notification"></div>
<script>
   
    
   


    $("#show_birth_day_notification").load('Ajax_files/birth_day_notification.php');
</script>


<!-- follow up notif-wrap -->
<?php


$DateTimeINR = date("Y-m-d H:i:s");

//echo($DateTimeINR);
  
$sql="SELECT id,update_count, DATE_FORMAT( DateTime, '%d/%m/%Y %h:%i %p' ) AS DateTime, Full_Name, Email, Mobile, Disposition, Remark, UserName, DATE_FORMAT( FowllowUpDateTime, '%d-%m-%Y %h:%i' ) AS FowllowUpDateTime , DATE_FORMAT( FowllowUpDateTime, '%d/%m/%Y' ) AS FowllowUpDate, DATE_FORMAT( FowllowUpDateTime, '%H' ) AS FowllowUpTime, DATE_FORMAT( FowllowUpDateTime, '%p') AS FowllowUpTimeAM_PM, State, Priority, Segment FROM FolllowUpLeads WHERE FowllowUpDateTime <= '".$DateTimeINR."' AND UserName ='".$username."' AND NOT Status='Done' AND NOT Disposition='NT' AND NOT Disposition='NI' AND NOT Disposition='CT' AND NOT Disposition='LB' AND NOT Disposition='DND' AND NOT Disposition='WN' AND NOT Disposition='DC' AND NOT Disposition='Sale' AND NOT Disposition='NCD' AND NOT FowllowUpDateTime='0000-00-00 00:00:00' AND FowllowUpDateTime >= DATE_FORMAT(CURDATE(), '%Y-%m-01') - INTERVAL 2 MONTH ORDER BY `FolllowUpLeads`.`FowllowUpDateTime` DESC LIMIT 0 , 1";
  
  
$result = mysqli_query($connect,$sql);


  
while($row = mysqli_fetch_array($result))
  {
  
  echo('<div class="follow-up-notif-wrap">');
  echo('<div class="follow-up-notif">');
  echo('<div class="follow-up notice-danger">');
  echo('<div class="follow-up-notif">');
  echo('<div class="infotab">');
echo('<form action="notification-update.php" method="GET">');
  echo('<table class="table table-fit" style="margin:0 0 0 40px;padding:0;"><tbody>
     <tr><td style="vertical-align: top;display:none">
               <span class="number">105</span>
            </td>
       
            <td>
               <div class="head">Follow Up</div>
               <div class="content">'.$row['FowllowUpDateTime'].'</div>
            </td>
            <td>
               <div class="head">Name</div>
               <div class="content">'.$row['Full_Name'].'<input type="hidden" name="Id_Notification" value="'.$row['id'].'"/><input type="hidden" name="update_count" value="'.($row['update_count'] + 1) .'"/></div>
            </td>
       <td>
               <div class="head">Mobile</div>
               <div class="content">



         <a class="" href="'.'disposition.php?Mobile='.$row['Mobile'].'&UserName='.$username.'&FollowUpId='.$row['id'].'&Full_Name='.$row['Full_Name'].'">'.$row['Mobile'].'</a></div>
            </td>
            <td>
               <div class="head">Disposition</div>
               <div class="content">'.$row['Disposition'].'</div>
            </td>
      <td>
               <div class="head">Segment</div>
               <div class="content">'.$row['Segment'].'</div>
            </td>
            <td>
               <div class="head">Remarks</div>
               <div class="content"><textarea style="width:380px;">'.$row['Remark'].'</textarea></div>
            </td>
             <td>
               <div class="head">Count</div>
               <div class="content">'.$row['update_count'].'</div>
            </td>
            <td>
               
         <a class="btn btn-success" href="'.'disposition.php?Mobile='.$row['Mobile'].'&UserName='.$username.'&FollowUpId='.$row['id'].'&Full_Name='.$row['Full_Name'].'&update_count='.$row['update_count'].'">Update</a>
            </td>
            <td>
               <button type="submit" class="btn btn-info purple">Remind Me Later</button>
            </td>
       <td>
               <div class="head">Date</div>
               <div class="form-group">
                  <input type="text" style="width:120px;" class="form-control disableNow" id="Follow_Up_Reminder_datepicker_INR" placeholder="Date" autocomplete="off" required>

                        <input type="hidden" class="form-control" id="Follow_Up_Reminder_datepicker" name="Follow_Up_Reminder_datepicker" placeholder="Date">
            </div>
            </td>
       <td>
               <div class="head">Hour</div>
               <div class=""><select id="Hour" name="Hour" class="disableNow form-control" style="width:70px;" required>
                       <option value="" disabled selected>H</option>  
                       <option value="01">01</option> 
                       <option value="02">02</option> 
                       <option value="03">03</option> 
                       <option value="04">04</option> 
                       <option value="05">05</option> 
                       <option value="06">06</option> 
                       <option value="07">07</option> 
                       <option value="08">08</option> 
                       <option value="09">09</option> 
                       <option value="10">10</option> 
                       <option value="11">11</option> 
                       <option value="12">12</option> 
                       <option value="13">13</option> 
                       <option value="14">14</option> 
                       <option value="15">15</option> 
                       <option value="16">16</option> 
                       <option value="17">17</option> 
                       <option value="18">18</option> 
                       <option value="19">19</option> 
                       <option value="20">20</option> 
                       <option value="21">21</option> 
                       <option value="22">22</option> 
                       <option value="23">23</option> 


        </select></div>
            </td>
       <td>
               <div class="head">Minuts</div>
               <div class="">       
     <select id="Minuts" name="Minuts" class="disableNow form-control" style="width:70px;" required>
<option value="" disabled selected>M</option> 
                       <option value="01">01</option> 
                       <option value="02">02</option> 
                       <option value="03">03</option> 
                       <option value="04">04</option> 
                       <option value="05">05</option> 
                       <option value="06">06</option> 
                       <option value="07">07</option> 
                       <option value="08">08</option> 
                       <option value="09">09</option> 
                       <option value="10">10</option> 
                       <option value="11">11</option> 
                       <option value="12">12</option> 
                       <option value="13">13</option> 
                       <option value="14">14</option> 
                       <option value="15">15</option> 
                       <option value="16">16</option> 
                       <option value="17">17</option> 
                       <option value="18">18</option> 
                       <option value="19">19</option> 
                       <option value="20">20</option> 
                       <option value="21">21</option> 
                       <option value="22">22</option> 
                       <option value="23">23</option> 
                       <option value="24">24</option> 
                       <option value="25">25</option> 
                       <option value="26">26</option> 
                       <option value="27">27</option> 
                       <option value="28">28</option> 
                       <option value="29">29</option> 
                       <option value="30">30</option> 
                       <option value="31">31</option> 
                       <option value="32">32</option> 
                       <option value="33">33</option> 
                       <option value="34">34</option> 
                       <option value="35">35</option> 
                       <option value="36">36</option> 
                       <option value="37">37</option> 
                       <option value="38">38</option> 
                       <option value="39">39</option> 
                       <option value="40">40</option> 
                       <option value="41">41</option> 
                       <option value="42">42</option> 
                       <option value="43">43</option> 
                       <option value="44">44</option> 
                       <option value="45">45</option> 
                       <option value="46">46</option> 
                       <option value="47">47</option> 
                       <option value="48">48</option> 
                       <option value="49">49</option> 
                       <option value="50">50</option> 
                       <option value="51">51</option> 
                       <option value="52">52</option> 
                       <option value="53">53</option> 
                       <option value="54">54</option> 
                       <option value="55">55</option> 
                       <option value="56">56</option> 
                       <option value="57">57</option> 
                       <option value="58">58</option> 

        </select></div>
            </td>
      
         </tr>
      </tbody>
   </table>');
  echo('</form>');
  echo('</div>');
  echo('</div>');
  echo('</div>');
  echo('</div>');
  echo('</div>');
  
  }




?>         




<?php
if(isset($_GET['del_notifi'])){
   $usernames = $_GET['ses_user'];
   $result_update = mysqli_query($connect,"UPDATE employee SET read_notification='1' where username = '$usernames' "); 
  
  //$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  //header('location:'.$actual_link);
  header('location:memberpage.php');
}
if(isset($_GET['del_notifi_demo'])){
   $usernames = $_GET['ses_user'];
   $result_update = mysqli_query($connect,"UPDATE employee SET demo_read_notification='1' where username = '$usernames' "); 
  
  //$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  //header('location:'.$actual_link);
  header('location:memberpage.php');
}
?>

    <div class="brand-logo">
      <?php
   $result = mysqli_query($connect,"SELECT Company_Name FROM Options WHERE Id = '1'");
         $Company_Name = mysqli_result($result, 0);
      //echo($Login_Logo);
      
      ?>

<div class="header-top">
  <div class="">
    <div class="col-xs-4">
     <img src="images/menu-1.png" alt="1" title="1" id="toggleMenu1" class="toggle-menu" style="display:none;"/>
     <img src="images/menu-2.png" alt="2" title="2" id="toggleMenu2" class="toggle-menu" style="display:none;"/>
    
    </div>
    <div class="col-xs-5"><p class="text-center font-size18">Welcome to Stock Deal CRM</p></div>
    <div class="col-xs-3"><p class="font-size18 logout"><a href="logout.php">Logout&nbsp; <img src="images/logout.png"/></a></p></div>
  </div>
  <div class="clearfix"></div>
</div>
 
 
 <!-- Stock Tips Notification For Customer -->
 <?php 
 //$username = $_SESSION['username'];
 $sql = ("SELECT st.Ideas, st.Sagment, st.Result FROM stock_tips st,employee e WHERE e.read_notification='0' AND e.username='$username' AND DATE( CURDATE( ) ) = DATE( DateTime) ORDER BY `st`.`Id` DESC LIMIT 1");
 $result = mysqli_query($connect,$sql);
 $data = mysqli_fetch_assoc($result);
 if(mysqli_num_rows($result)>0){
?>
<div class="container-notif-wrap">
<div class="container-notif">
    <div class="notice notice-danger">
        <table style="font-size:16px;">
      <tr>
       <td style="">SEGMENT</td>
        <td style="padding-left: 30px;">STOCK TIPS</td>
      </tr>
          <tr>
            <td style="font-weight: bold;"><?php echo $data['Sagment']; ?></td>
            <td style="font-weight: bold;display: none;"> 
              <div class="btn <?php echo $data['Result']; ?>" style="margin-top:10px;margin-left:10px;margin-right:10px">
                <?php echo $data['Result']; ?>
              </div>
            </td>
            <td style="font-weight: bold;padding-left: 30px;"><?php echo $data['Ideas']; ?></td>
            <!-- <a href="stock-tips.php" class="btn Open pull-right" style="align:right;">Read</a> -->
            <!-- <input type="submit" name="del_notifi" class="btn btn-primary pull-right" value="delete"> -->
            <form method="GET" action="stock-tips.php">
              <input type="hidden" name="ses_user" value="<?php echo $username;?>">
              <!-- <input type="submit" name="del_notifi" class="btn btn-info pull-left" value="Read" style="margin-right: 15px;"> -->
        <a href="stock-tips.php" class="btn btn-info pull-left"  style="margin-right: 15px;">Read</a> 
            </form>
            <form method="GET" action="">
              <input type="hidden" name="ses_user" value="<?php echo $username;?>">
              <input type="submit" name="del_notifi" class="btn btn-primary pull-left" value="Close" style="margin-right: 30px;display:none">
            </form>
          </tr>
        </table>
    </div>    
</div>
  </div>
 <!-- For Notice of Segments End -->
 <?php }?>
 <script>
 function delete_noti(){
  //  alert('hellp');
 var request = $.ajax({
  url: "delete_notification.php/index",
  type: "GET",
  dataType: "html"
});
request.done(function(msg) {
  location.reload();
  // setTimeout(function(){  location.reload(); }, 1000);
});}
 </script>
 
 
 <!-- Demo Stock Tips Notification For Customer -->
 <?php 
 //$username = $_SESSION['username'];
 $sql = ("SELECT st.Ideas, st.Sagment, st.Result FROM Demo_Stock_Tips st,employee e WHERE e.demo_read_notification='0' AND e.username='$username' AND DATE( CURDATE( ) ) = DATE( DateTime) ORDER BY `st`.`Id` DESC LIMIT 1");
 //echo $sql; exit;
 $result = mysqli_query($connect,$sql);

 $data = mysqli_fetch_assoc($result);
 if(mysqli_num_rows($result)>0){
?>
<div class="container-notif-wrap">
<div class="container-notif">
    <div class="notice notice-danger">
        <table style="font-size:16px;">
      <tr>
       <td style="">SEGMENT</td>
        <td style="padding-left: 30px;">STOCK TIPS</td>
      </tr>
          <tr>
            <td style="font-weight: bold;"><?php echo $data['Sagment']; ?></td>
            <td style="font-weight: bold;display: none;"> 
              <div class="btn <?php echo $data['Result']; ?>" style="margin-top:10px;margin-left:10px;margin-right:10px">
                <?php echo $data['Result']; ?>
              </div>
            </td>
            <td style="font-weight: bold;padding-left: 30px;"><?php echo $data['Ideas']; ?></td>
            <!-- <a href="stock-tips.php" class="btn Open pull-right" style="align:right;">Read</a> -->
            <!-- <input type="submit" name="del_notifi" class="btn btn-primary pull-right" value="delete"> -->
            <form method="GET" action="stock-tips.php">
              <input type="hidden" name="ses_user" value="<?php echo $username;?>">
              <!-- <input type="submit" name="del_notifi" class="btn btn-info pull-left" value="Read" style="margin-right: 15px;"> -->
        <a href="demo-stock-tips.php" class="btn btn-info pull-left"  style="margin-right: 15px;">Read</a>  
            </form>
            <form method="GET" action="" >
              <input type="hidden" name="ses_user" value="<?php echo $username;?>">
              <input type="submit" name="del_notifi_demo" class="btn btn-primary pull-left" value="Close" style="margin-right: 30px;display:none">
            </form>
          </tr>
        </table>
    </div>    
</div>
  </div>
 <!-- For Notice of Segments End -->
 <?php }?>
 <script>
 function delete_noti(){
  //  alert('hellp');
 var request = $.ajax({
  url: "delete_notification.php/index",
  type: "GET",
  dataType: "html"
});
request.done(function(msg) {
  location.reload();
  // setTimeout(function(){  location.reload(); }, 1000);
});}
 </script>

<script>

function check_session_id()
{
    var session_id = "<?php echo $_SESSION['user_session_id']; ?>";

    fetch('check_login.php').then(function(response){

        return response.json();

    }).then(function(responseData){

        if(responseData.output == 'logout')
        {
            window.location.href = 'logout.php';
        }

    });
}

setInterval(function(){

    check_session_id();
    
}, 3000);

</script>

<script>
  
function auto_logout() {
    

    fetch('check_login_time.php').then(function(response){
        return response.json();

    }).then(function(responseData){

        // console.log(responseData);
        if(responseData.output == "logout")
        {
            window.location.href = 'logout.php';
        }

    });
}

setInterval(function(){

    auto_logout();
    
}, 300000);


</script>

