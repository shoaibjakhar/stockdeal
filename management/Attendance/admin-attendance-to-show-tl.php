<style>
   /* .sale1 {display:none;}
   td {padding:10px;}*/
    .active-row {background: #faebcc}
    .table-hover-attendance tbody tr:hover {background: #faebcc}
    
    div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    margin-top:2px;
}
    
    .popover {max-width: 100%;} 
    .badge {cursor: pointer;}
    .dataTables_filter{
        display:inherit !important;
    }
    
    .dt-buttons {float: left;margin-top: 3px;}

.dataTables_filter {float: left;margin-top: 3px;margin-right: 10px;}

.badge {padding: 5px 7px;}
td {text-align:center;}
    
</style>
<?php 
$query_date = date('Y-m-d');
 $first = date('Y-m-01');

$last = date('Y-m-t', strtotime($query_date));

 $qry = "SELECT count(id)  from Holydays WHERE Date(`Date`) >= '$first' and Date(`Date`) <= '$last' ";
   $get_qry = mysqli_query($connect,$qry);
   //print_r($get_qry);
    
            $holidays = $get_qry->fetch_array();
            //  print_r($holidays);
            $holidays =  $holidays[0];
            
            // total no of days in a month
            $d=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
            
            // get sundays in a month
            $sundays=0;
            $month = date('m');
            $year = date('Y');
$total_days=cal_days_in_month(CAL_GREGORIAN, $month, $year);
for($i=1;$i<=$total_days;$i++){
if(date('N',strtotime($year.'-'.$month.'-'.$i))==7){
$sundays++;
}
}
$payable = $d - ($sundays + $holidays);

?>

<form class="form-inline" action='' method="GET">
  <div class="form-group mb-2">
    <label for="staticEmail2" class="sr-only">Start Date</label>
    <input type="text" id='start_date' autocomplete="off"  class="form-control" name="start" value="<?php //echo $_GET['start']; ?>" placeholder="Start Date" required>
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <label for="inputPassword2" class="sr-only">End Date</label>
    <input type="text" id="end_date"  autocomplete="off" class="form-control" name="end" value="<?php //echo $_GET['end']; ?>" placeholder="End Date" required>
  </div>
  <button type="submit" class="btn btn-primary mb-2">Filter</button>
  <button type="button" class="btn btn-danger mb-2" onclick="window.location.href='attendance.php'">Clear</button>
</form>

<div class="row">

<?php
    function createRange($start, $end, $format = 'Y-m-d') {
                                    $start  = new DateTime($start);
                                    $end    = new DateTime($end);
                                    $invert = $start > $end;
                                
                                    $dates = array();
                                    $dates[] = $start->format($format);
                                    while ($start != $end) {
                                        $start->modify(($invert ? '-' : '+') . '1 day');
                                        $dates[] = $start->format($format);
                                    }
                                    return $dates;
                                }
            if(isset($_GET['start']) && isset($_GET['end'])){
                $dats = createRange($_GET['start'],$_GET['end']);
                array_unshift($dats,"");
                unset($dats[0]);
            }


date_default_timezone_set('Asia/Kolkata');
 
 $get_day_hours = "SELECT Halfday_Hour,Fullday_Hours FROM Options WHERE Id = '1'";
$qry_hours = mysqli_query($connect,$get_day_hours);
$get_hours_data = $qry_hours->fetch_assoc();
 $Fullday_Hours = $get_hours_data['Fullday_Hours'];
 $Halfday_Hour = $get_hours_data['Halfday_Hour'];



?>
    
    <div class="col-sm-12" style="display:;">
     
        <div class="panel panel-default" style="">
  <div class="panel-heading font-size16">
        <?php
        if(isset($_GET['previous_month'])){
            $previous_month = $_GET['previous_month'] + 1;
        }
        else{
          $previous_month = 1;  
        }
        $monthName = date("M", mktime(0,0,0, date("n") - ($previous_month - 1) ));
            echo date("F Y", mktime(0,0,0, date("n") - ($previous_month - 1) ));
        ?> 
        Monthly Attendance &nbsp;&nbsp;|&nbsp;&nbsp;<a href='attendance.php?holiday_list=holiday'>Holydays List</a> &nbsp;&nbsp;|&nbsp;&nbsp;
         <a href='attendance.php'>Agent Attendace</a>
         &nbsp;&nbsp;|&nbsp;&nbsp;
         <!--  &nbsp;&nbsp;|&nbsp;&nbsp;
        <a href='team_lead_attendance.php'>Team Lead Attendace</a> &nbsp;&nbsp;|&nbsp;&nbsp; -->
  <a href="<?php 
        
        if($monthName == 'Jan'){
            echo "javvascript:void(0)";
        }
        else{
            echo "attendance.php?previous_month=".$previous_month; 
        }
        
       
  
  ?>" class="MR10 btn btn-xs btn-primary">
      <i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Previous Month&nbsp;</a> 
  
  <?php
    if(isset($_GET['previous_month']) && $_GET['previous_month'] != '0' ){
  
  ?>
      
  <a href="<?php
     if( isset($_GET['previous_month'])){
         if(isset($_GET['previous_month'])){
            $previous_month = $_GET['previous_month'] - 1;
        }
        else{
          $previous_month = 1;  
        }
       
       if($previous_month == '0'){
           echo "attendance.php";  
       }
       else{
           echo "attendance.php?previous_month=".$previous_month;  
       }
        
    } 
  
  ?>" class="MR10 btn btn-xs btn-primary">Next Month &nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i></a>

<?php

}
?>
  </div>  
  <div class="panel-body">
      <a href="#" id="Show_All_Attendance" class="btn btn-success" >Show All</a>
       <table id="Admin_Attendance" class="display nowrap table table-bordered table-hover-attendance" style="width:100%">
        <thead>
            <tr>
                <th style="width:100px;">Agent</th>
                <?php
                 if(isset($_GET['previous_month'])){
                        $get_month = $_GET['previous_month'];
                       $current_dates_in_months =  date("t", mktime(0,0,0, date("n") - $get_month));
                        
                    }
                    else if(isset($_GET['start']) && isset($_GET['end'])){
                        $current_dates_in_months = count($dats)-1;
                    }
                    else{
                      $current_dates_in_months = date('d');
                    }
                    
                  for($i=1;$i<=$current_dates_in_months;$i++){
                      
                      if(isset($_GET['previous_month'])){
                        $get_month = $_GET['previous_month'];
                      // $current_dates_in_months =  date("t", mktime(0,0,0, date("n") - $get_month));
                       
                       $monthName = date("M", mktime(0,0,0, date("n") - $get_month));
                      
                       $dates_v = $i."-".$monthName."-".date('Y');
                        
                    }
                    else{
                      $monthName = date('M', mktime(0, 0, 0, date('m'), 10));
                      
                      $dates_v = $i."-".$monthName."-".date('Y');
                    }
                      
                      
                    //echo '<th>'.$i.'<br>'.$monthName.'<br>'.date('Y');
                    
                     if(isset($_GET['start']) && isset($_GET['end'])){
                        //echo '<th>'.$i.'<br>'.$monthName.'<br>'.date('Y');
                       echo '<th>'.date('d <\b\r> M <\b\r> Y',strtotime($dats[$i]));
                    }
                    else{
                        //echo '<th>'.$i.'<br>'.$monthName.'<br>'.date('Y');
                        echo '<th class="ShowAllTd">'.$i.'<br>';
                    }
                    
                    
                    echo '</th>';
                    
                   
                  }
                // echo '</th>';
                    echo '<th>P </th>';
                     echo '<th>A</th>';
                      echo '<th>HD</th>';
                     echo '<th>L</th>';
                       echo '<th>PL</th>';
                        //echo '<th>Month</th>';
                        echo '<th>Payable</th>';
                
                ?>
               
                
            </tr>
        </thead>
        <tbody>
            <?php
            if($_SESSION['Role'] == 'Team Leader'){
                 $qry_agents = "SELECT Id, username,Date_of_Join from employee where Team_Leader = '".$username."' AND Status = 'Active' AND username !='Akshay Shetty' AND username !='Select'";
            }
            else{
                 $qry_agents = "SELECT Id, username from employee where Status = 'Active' AND username !='Akshay Shetty' AND username !='Select' AND Role='Agent'";
            }
             
            $get_qry = mysqli_query($connect,$qry_agents);
            $counts_d = 0;
            while($get_agents = $get_qry->fetch_assoc()){
            
            
            
            ?>
            <tr>
                <td title="<?php echo $get_agents['username'] ?>"><?php echo wordwrap($get_agents['username'],10,"<br>\n"); ?></td>
               
                
                <?php
                
                $holiday_list = array('1'=>'Sun');
                
                     if(isset($_GET['previous_month'])){
                        $get_month = $_GET['previous_month'];
                       $current_dates_in_months =  date("t", mktime(0,0,0, date("n") - $get_month));
                        
                    }
                    else if(isset($_GET['start']) && isset($_GET['end'])){
                        $current_dates_in_months = count($dats)-1;
                    }
                    else{
                      $current_dates_in_months = date('d');
                    }
                $pl[$counts_d] = 0;
                $present_days[$counts_d] = 0;
                $absent_days[$counts_d] = 0;
                $half_days[$counts_d] = 0;
                $late[$counts_d] = 0;
                 for($i=1;$i<=$current_dates_in_months;$i++){
                     echo " <td class='ShowAllTd'>";
                     if(isset($_GET['previous_month'])){
                        $get_month = $_GET['previous_month'];
                       // echo $months =  date("t", mktime(0,0,0, date("n") - $get_month));
                        if($i<10){
                            $dd = "0".$i;
                        }
                        else{
                            $dd = $i;
                        }
                        $cur_date = $dd."-".sprintf('%02d',(date('m')-$get_month))."-".date('Y');
                         $nameOfDay = date('D', strtotime($cur_date));
                        
                    }
                    else if(isset($_GET['start']) && isset($_GET['end'])){
                         $cur_date = date('d-m-Y',strtotime($dats[$i]));
                         $nameOfDay = date('D', strtotime($cur_date));
                    }
                    
                    else{
                         if($i<10){
                            $dd = "0".$i;
                        }
                        else{
                            $dd = $i;
                        }
                       $cur_date = $dd."-".date('m')."-".date('Y');
                       $cur_date_1 = date('Y').'-'.date('m').'-'.$dd;
                       $nameOfDay = date('D', strtotime($cur_date)); 
                    }
                      
                      

                        $select = "select * from employee where Id = '".$get_agents["Id"]."' and Paid_Leaves_Log like '%".$cur_date."%'";
                        $qry = mysqli_query($connect,$select);
                        $fet_log = mysqli_fetch_assoc($qry);
                      
                      if(array_search($nameOfDay,$holiday_list)){
                         $join_date = date('d-m-Y',strtotime($get_agents['Date_of_Join']));
                              $origin = date_create($join_date);
                              $target = date_create($cur_date);
                               if($target < $origin)
                                {
                                  continue;
                                }
                          echo '<span class="badge badge-info" style="background:#09abf4;color:#fff;">Sunday</span>';
                         // $present_days[$counts_d]+=1;
                      }
                      
                      else{
                              $join_date = date('d-m-Y',strtotime($get_agents['Date_of_Join']));
                              $origin = date_create($join_date);
                              $target = date_create($cur_date);
                               if($target < $origin)
                                {
                                  continue;
                                }
                              if($target >= $origin)
                              {
                                   $interval = date_diff($origin, $target);
                                   $training_day = $interval->format('%R%a days');
                                   if($training_day >=0 && $training_day <= 7)
                                   {
                                       echo '<span style="background:#8e42a9cc;margin-bottom:2px;" class="badge badge-success attendance-popover bg-success"  type="button" data-html="true">Training</span><br>';
                                   }
                              }
                             
                           

                         // die();
                           $qry = 'SELECT * FROM attendence where date = "'.$cur_date.'" and user_id = "'.$get_agents["Id"].'"';
                           $sql_qry = mysqli_query($connect,$qry);
                           $row = mysqli_fetch_assoc($sql_qry);
                           echo "<span class='attendance-popovers' id='".$row['id']."' data-users-ids='".$get_agents["Id"]."' data-user-date='".$cur_date."' data-agent-name='".$get_agents['username']."'>";
                          
                          
                           //$cur_db_date = date('Y')."-".date('m')."-".$i;
                          $cur_db_date = $cur_date;
                          $get_holidays_sel = "SELECT * FROM Holydays WHERE Date = '".date('Y-m-d',strtotime($cur_db_date))."'";
                          $qry_hlyds = mysqli_query($connect,$get_holidays_sel);
                          $get_holidays = mysqli_fetch_assoc($qry_hlyds);
                           
                           if($get_holidays){
                               echo '<span class="badge badge-info" style="background:#3f51b5;color:#fff;">Holiday</span>';
                               //$present_days[$counts_d]+=1;
                           }
                           else if($fet_log){
                           echo '<span title="Agent Name" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true" class="badge badge-danger attendance-popover"  style="background:#8e44ad;">Paid Leave</span>';
                            }
                           
                           else{
                           
                          if($row){
                              
                              if($row['Pl_Upl'] == 'pl' || $row['Pl_Upl'] == 'upl'){
                                
                                if($row['Pl_Upl'] == 'pl'){
                                 echo '<span title="Agent Name" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true" class="badge badge-info attendance-popover"  style="background:#17a2b8;">PL</span>';
                                 $pl[$counts_d]  +=1;
                                }
                                else if($row['Pl_Upl'] == 'upl'){
                                 echo '<span title="Agent Name" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true" class="badge badge-info attendance-popover"  style="background:#007bff;">UIL</span>';
                                 
                                }
                                 
                                 
                              
                              }
                              else{
                              $total_times = ($row['total_time'] + $row['manually_added_time']);
                              $total_hours = floor($total_times / 60);
                             
                             if($total_hours<$Halfday_Hour){
                                 echo '<span title="Agent Name" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true" class="badge badge-danger attendance-popover"  style="background:#e74c3c;">Absent</span>';
                                 $absent_days[$counts_d]+=1;
                                 
                             }
                             else if($total_hours>=$Halfday_Hour && $total_hours<$Fullday_Hours){
                                  echo '<span style="background:#f1c40f;color:#333" class="badge badge-info attendance-popover" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true">Half Day</span>';
                                  $half_days[$counts_d]+=1;
                             }
                             else if($total_hours>=$Fullday_Hours){
                                  echo '<span style="background:#27ae60" class="badge badge-success attendance-popover bg-success" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true">Present</span>';
                                  $present_days[$counts_d]+=1;
                             }
                             else{
                                  echo '<span style="background:#e74c3c;" class="badge badge-danger attendance-popover" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true">Absent</span>';
                                   $absent_days[$counts_d]+=1;
                             }
                             
                              }
                             
                          }
                          else{
                                  echo '<span style="background:#e74c3c;" class="badge badge-danger attendance-popover" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true">Absent</span>';
                                   $absent_days[$counts_d]+=1;
                             }
                             
                           }  
                             
                         echo "<br>";     
                        if($row['reg_status'] == 'pending' && $get_holidays['id'] == ''){
                            echo '<i class="fa fa-envelope" aria-hidden="true" style="font-size: 20px;color:#3f51b5;padding:0px 0 0 10px;"></i>';
                            
                           
                        }
                        else  if($row['reg_status'] == 'rejected' && $get_holidays['id'] == ''){
                            echo '<i class="fa fa-times" aria-hidden="true" style="font-size: 20px;color:red;padding:0px 0 0 10px;"></i>';
                            
                           
                        }
                        //echo $row['manually_added_time'];
                         if($row['manually_added_time'] != 0 && $get_holidays['id'] == ''){
                                echo '<i class="fa fa-clock-o" aria-hidden="true" style="color:#3f51b5;font-size: 20px;padding:5px 0 0 10px;"></i>';
                            }
                            
                            
                        echo "</span>";
                          
                      }
                      
                      //;
                      if($nameOfDay != 'Sun'){
                       if($row['login_time']){
                           
     $login_time = strtotime($row['login_time']);
    
    // echo (date('m/d/Y')." 09:00:00 PM");
    //echo $date;
    //echo $cur_db_date;
      $new_date = date('m/d/Y',strtotime($cur_db_date))." 09:00:00 AM";
     $ontime = strtotime($new_date);

    if($login_time>$ontime){
        if($row['Informed_Late'] != '' || $row['Informed_Late'] != NULL ){
            echo "<span style='color:blue'> Informed Late</span>&nbsp;&nbsp;";
            $late[$counts_d]+=1;
        }
        else{
            echo "<span style='color:red'> Late</span>&nbsp;&nbsp;";
           $late[$counts_d] +=1;
             
        }
        
    }
    else{
        echo "<span style='color:green'> Ontime</span>";
    }
    
            } 
            
                      }
                      
                      echo ' </td>';
                    
                 }
                 
                  echo '<td>'.$present_days[$counts_d].'</td>';
                     echo '<td>'. $absent_days[$counts_d].'</td>';
                      echo '<td>'.$half_days[$counts_d].'</td>';
                      echo '<td>'.$late[$counts_d].'</td>';
                       echo '<td>'.($pl[$counts_d]).' </td>';
                        //echo '<td> '.$dd.'</td>';
                         echo '<td> '.$payable.'</td>';
                
                ?>
               
               
            </tr>
             
            <?php
            $counts_d++;
            }
            
            
            ?>
            
        </tbody>
      </table>
      
     <!-- popover-content start here -->
     
     <div id="admin_attendence_edit_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="agent_name_header">Modal Header</h4>
      </div>
      <div class="modal-body">
               <div id="popover-content" >
                <div id="load_popup_content"></div>
            </div>
      </div>
     
    </div>

  </div>
</div>
     
    
    
    
    <!-- popover-content end here -->
 <!-- <script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>   -->
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>     
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script>
        $("#start_date").datepicker({
            dateFormat: 'yy-mm-d'
        });
        $("#end_date").datepicker({
            dateFormat: 'yy-mm-d'
        })
    </script>
    <script>
$(document).ready(function() {
    
    $(".attendance-popovers").click(function(){
        $("body").preloader();
        $("#admin_attendence_edit_modal").modal('show');
        var regis_ids = $(this).attr("id");
        var users_ids = $(this).attr("data-users-ids");
        var users_date = $(this).attr("data-user-date");
        var agent_name = $(this).attr("data-agent-name");
        $("#agent_name_header").html(agent_name);
        //console.log(regis_ids + users_ids + users_date);
        $("#load_popup_content").load("Attendance/popup_content.php?id="+regis_ids+"&user_id="+users_ids+"&date="+users_date+"&time="+new Date().getTime());
    })
    
$("tr").click(function(){
  $('tr').removeClass("active-row");
  $(this).addClass("active-row");
});

    
   
     var table = $('#Admin_Attendance').DataTable( {
        scrollY:        "500px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        ordering: true,
        info:     true,
         bFilter: true,
         "ordering": true,
         dom: 'Bfrtip',
        buttons: [
             'csv'
        ]
        /*
         fixedColumns:   {
            leftColumns: 1
            
        } 
         ,
         */
    } );
    
    
});
        
        


    $(document).on("click", ".dates_holyday", function() {
        // var dates = $(this).attr("data-dates-v");
         alert('asd');
         
    });
    
       /*
    
    $("[data-toggle=popover]").popover({
        trigger: "click"
    });
    $("[data-toggle=popover]").on("click", function(a) {
        $("[data-toggle=popover]").not(this).popover("hide");
    });
    */
//});   

    
</script>
      
    </div>
</div>
</div>
    
    
    
    </div>
    

<script>

jQuery(document).ready(function(){
  jQuery("#Show_All_Attendance").click(function(){
       
    jQuery('.ShowAllTd').toggle();
    $(this).text(function(i, text){
          return text === "Hide All" ? "Show All" : "Hide All";
      })
    
    
    setTimeout(function(){ $('th:last-child')[0].click();  }, 2000);
    
  });
});
</script>