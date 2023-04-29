<?php  include('partial/session_start.php'); 
error_reporting(0);
?>
<style>
.Active {color:#27ae60}
	.InActive {color:#e74c3c}
   /* .sale1 {display:none;}*/
	#myChart { margin-top: -60px;}
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<div class="row">

<div class="col-sm-3" style="display:;">

	 

		<div class="panel panel-default" style="">



  <div class="panel-body PB0">

<?php
function maTimes($times){
    $times = gmdate("H:i",$times);
    $ex = explode(":",$times);
    if($ex[0]>0){
       return ltrim($ex[0],"0")." Hours ".ltrim($ex[1],"0")." Minutes"; 
    }
    else{
        return (int)$ex[1]." Minutes";
    }
    
}

date_default_timezone_set('America/New_York');
//echo date('d');
 if(isset($_GET['previous_month'])){
                        $get_month = $_GET['previous_month'];
                        if(date('m') == 1){
                            $dayes_im_c_month =  date("t", strtotime('31-12-'.(date('Y')-1)));
                        }
                       else{
                           //$current_dates_in_months =  date("t", mktime(0,0,0, date("n") - $get_month));
                           $dayes_im_c_month = date("t", mktime(0,0,0, date("n") - $get_month));
                       }
                       
                        
                    }
                    else{
                     $dayes_im_c_month = date('d');
                    }


 $get_day_hours = "SELECT Halfday_Hour,Fullday_Hours FROM Options WHERE Id = '1'";
$qry_hours = mysqli_query($connect, $get_day_hours);
$get_hours_data = mysqli_fetch_assoc($qry_hours);
 $Fullday_Hours = $get_hours_data['Fullday_Hours'];
 $Halfday_Hour = $get_hours_data['Halfday_Hour'];
$absent_count = 0;
$half_day_count = 0;
$present_day_count = 0;

for($i=0;$i<=$dayes_im_c_month;$i++){
     if($i<10){
                            $dd = $i;
                        }
                        else{
                            $dd = $i;
                        }
    if(date('m') == 1){
        $cur_date = $dd."-"."12-".(date('Y')-1);
    }
    else{
        $cur_date = $dd."-".date('m')."-".date('Y');
    }
   
    $qry = 'SELECT * FROM attendence where date = "'.$cur_date.'" and user_id = "'.$User_Id.'"';
     $sql_qry = mysqli_query($connect, $qry);
    $row = mysqli_fetch_assoc($sql_qry);
    $holidays_qry_cmonth = "SELECT * FROM Holydays where Date = '$cur_date'";
    $holdays_qry = mysqli_query($connect, $holidays_qry_cmonth);
    $h_days = mysqli_fetch_assoc($holdays_qry);
    if($h_days){
        continue;
    }
    else{
       if($row){
        $count[] =$row;
        
                              $total_times = ($row['total_time'] + $row['manually_added_time']);
                             //echo "<br>";
                              $total_hours = floor($total_times / 60);
                             
                             if($total_hours<$Halfday_Hour){
                                $absent_count+=1;
                                 
                             }
                             else if($total_hours>=$Halfday_Hour && $total_hours<$Fullday_Hours){
                                $half_day_count+=1;
                             }
                             else if($total_hours>=$Fullday_Hours){
                                 $present_day_count+=1;
                             }
                             else{
                                  $absent_count+=1;
                             }
        
        
        
    }
    else{
        continue;
    }  
    }
    
   
    
}



$holiday_list = array('1'=>'Sun');

for($i=0;$i<=$dayes_im_c_month;$i++){
     if($i<10){
                            $dd = $i;
                        }
                        else{
                            $dd = $i;
                        }
    //$cur_date = $dd."-".date('m')."-".date('Y');
   
    
    
    if(date('m') == 1){
        $cur_date = $dd."-"."12-".(date('Y')-1);
        $c_dates = (date('Y')-1)."-12-".$i;
    }
    else{
        $cur_date = $dd."-".date('m')."-".date('Y');
        $c_dates = date('Y')."-".date('m')."-".$i;
    }
    
     $holidays_qry_cmonth = "SELECT * FROM Holydays where Date = '$c_dates'";
    $holdays_qry = mysqli_query($connect, $holidays_qry_cmonth);
    $rows = mysqli_fetch_assoc($holdays_qry);
    if($rows){
        $holydays[] = $rows;
    }
     $nameOfDay = date('D', strtotime($cur_date));
  if(array_search($nameOfDay,$holiday_list)){
                        $sunday[] = 'sunday';
                      }
    
}

$official_holiday = isset($official_holiday) ? $official_holiday : 0;
$public_holiday = isset($public_holiday) ? $public_holiday : 0;
$dayes_im_c_month = isset($dayes_im_c_month) ? $dayes_im_c_month : 0;
$total_working_days = $dayes_im_c_month - count($sunday) - $official_holiday - $public_holiday;

//echo $absent_count;
 $presents = count($count);
//echo "<br>";

if(empty($holydays)){
    $holydays = 0;
}

 $public_holidays = count($holydays);
 if(date('d')>24){
     $official_holidays = 2;
 }
 else{
     $official_holidays = 0;
 }

$sundays = count($sunday);
//echo $dayes_im_c_month;

//($public_holidays + $official_holidays+ $sundays+$presents ); 
//print_r($holydays);
 $total_working_days = ($dayes_im_c_month - $sundays) - ($official_holidays + $public_holidays);
 $absent = $total_working_days - ($present_day_count + $half_day_count);
 
if($absent<0){
    $absent = 0;
}


   $half_day_to_full = round(($half_day_count/2),1); 

$state_array = array($present_day_count,$half_day_count,$absent);
$stats_chart = implode(",",$state_array);

$select = "select * from employee where Id = '".$User_Id."'";
$qry = mysqli_query($connect, $select);
$fet_leaves = mysqli_fetch_assoc($qry);
$leaves = count((array)json_decode($fet_leaves['Paid_Leaves_Log']));


?>
	  
	  
	  <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped" style="font-weight: bold;">
	<tbody>
	    
	    	<td>Balance Leave</td>
			<td><?php echo $fet_leaves['Balance_Leave']; ?></td>
			<td>Used Leave</td>
			<td><?php echo $leaves; ?></td>
		</tr>
	
		<tr style="background:#f5f5f5;display:none">
			
			
		<td style="color:#3c763d; background: #dff0d8;">Present days</td>
			<td style="color:#3c763d; background: #dff0d8;"><?php echo $present_day_count; ?></td>
			<td style="color:#a94442; background: #f2dede;">Absent days</td>
			<td style="color:#a94442; background: #f2dede;"><?php echo $absent; ?></td>
		</tr>
		
		<tr style="background:#f5f5f5;display:none">
			
		<td>Official leaves</td>
			<td><?php echo $official_holidays; ?></td>
			<td>Public holidays</td>
			<td><?php echo count($holydays); ?></td>
		</tr>
		
		<tr style="background:#f5f5f5;display:none">
			
<td>Sunday</td>
			<td><?php echo count($sunday); ?></td>
			<td style="color:#8a6d3b; background: #fcf8e3;">Halfday</td>
			<td style="color:#8a6d3b; background: #fcf8e3;"><?php echo $half_day_count; ?></td>
		</tr>
		<tr style="background:#f5f5f5;display:none">
			<td>Days in the month</td>
			<td><?php echo date('d'); ?></td>
			<td>Total working days</td>
			<td><?php echo $total_working_days; ?></td>
		
		</tr>
		
		<tr style="background:#f5f5f5;display:none">
		
			<td colspan='4' class="text-center">
			
			<?php
			echo "<b>".($half_day_to_full +$present_day_count) ."</b> Present days out of <b>".($total_working_days)."</b>";
			
			?></td>
			
		</tr>
	
	</tbody>
</table>	  

	</div>

</div>

</div>
<div class="col-sm-3" style="display: none;">
  <div class="panel panel-default" style="">
    <div class="panel-body PB0">
     
		
<div style="width: 260px;">
	<canvas id="myChart" width="260" height="260"></canvas>
	</div>

	
<script>
$(document).ready(function() {
 
	var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ['Present', 'Half Day', 'Absent'],
    datasets: [{
      label: '# of Tomatoes',
      data: [<?php echo $stats_chart; ?>],
      backgroundColor: [
	  'rgba(39, 174, 96, 1)',
      'rgba(241, 196, 15, 1)',
      'rgba(231, 76, 60, 1)'
        
      ],
      borderColor: [
       'rgba(39, 174, 96, 1)',
      'rgba(241, 196, 15, 1)',
      'rgba(231, 76, 60, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    cutoutPercentage: 40,
    responsive: false,
    rotation: 1 * Math.PI,
    circumference: 1 * Math.PI,
	legend: {
            display: false
         },  
  }
});
	
});

</script>
		
    </div>
  </div>
</div>
	
	<div class="col-sm-12" style="display:;">
	 
		<div class="panel panel-default" style="">
  <div class="panel-heading font-size16">
  
 <?php
            // echo $monthName ." ".date('Y');
        ?> 
        Monthly Attendance &nbsp;&nbsp;|&nbsp;&nbsp; &nbsp;&nbsp;|&nbsp;&nbsp;
  <a href="<?php 
        if(isset($_GET['previous_month'])){
            $previous_month = $_GET['previous_month'] + 1;
        }
        else{
          $previous_month = 1;  
        }
        $monthName = date("M", mktime(0,0,0, date("n") - ($previous_month - 1) ));
        if(date('m') == 1){
            if($previous_month == 1){
                    echo "attendance.php?previous_month=".$previous_month; 
                }
                else{
                    echo "javascript:void(0)";
                }
        }
        else{
            if($monthName == 'Jan'){
                echo "javascript:void(0)";
                // if($previous_month == 1){
                //     echo "attendance.php?previous_month=".$previous_month; 
                // }
                // else{
                //     echo "javascript:void(0)";
                // }
                
            }
            else{
                echo "attendance.php?previous_month=".$previous_month; 
            }
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
	
 <table width="100%" id="Agent_Attendance" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <td>Date</td>
            <td>Agent Name</td>
            <td>Login Time</td>
            <td>Status</td>
            <td>Ontime or Late</td>
		      	<td>Online Time</td>
			      <td>Manul Time</td>  
            <td>Total working Time</td>
            
            <td>Total Break Time</td>
            <td>Remarks</td>
            <td>Regularize</td>
           
          
           </thead>
          <tbody>
          
         <?php
         /*
         if( isset($_GET['previous_month'])){
        $c_m = date('m') - $_GET['previous_month'];
            
         $c_y = date('Y');
         $first_date_mo = "01-".$c_m."-".$c_y;
         $dates = $dayes_im_c_month."-".$c_m."-".$c_y;
         
          $sel_dates = "SELECT * FROM attendence where user_id = '".$User_Id."' and date between '".$first_date_mo."' and '".$dates."' order by id desc";
          
          
         }
         else{
             $c_m = date('m');
         $c_y = date('Y'); 
         $dates = date('d-m-Y');
         $first_date_mo = "01-".$c_m."-".$c_y;
          $sel_dates = "SELECT * FROM attendence where user_id = '".$User_Id."' and date between '".$first_date_mo."' and '".$dates."' order by id desc";
         }
        */
        $holiday_list = array('1'=>'Sun');
                
                     if(isset($_GET['previous_month'])){
                        $get_month = $_GET['previous_month'];
                        if(date('m') == 1){
                            $current_dates_in_months =  date("t", strtotime('31-12-'.(date('Y')-1)));
                        }
                       else{
                           $current_dates_in_months =  date("t", mktime(0,0,0, date("n") - $get_month));
                       }
                        
                    }
                    else{
                      $current_dates_in_months = date('d');
                    }
                    
          for($i=$current_dates_in_months;$i>=1;$i--){
                     echo " </tr>";
                     if(isset($_GET['previous_month'])){
                        $get_month = $_GET['previous_month'];
                       // echo $months =  date("t", mktime(0,0,0, date("n") - $get_month));
                        if($i<10){
                            $dd = $i;
                        }
                        else{
                            $dd = $i;
                        }
                        if(date('m') == 1){
                            $cur_date = sprintf("%02d",$dd)."-".sprintf("%02d",12)."-".(date('Y')-1);
                        }
                        else{
                            $cur_date = sprintf("%02d",$dd)."-".sprintf("%02d",(date('m')-$get_month))."-".date('Y');
                        }
                         $nameOfDay = date('D', strtotime($cur_date));
                        
                    }
                    else{
                         if($i<10){
                            $dd = $i;
                        }
                        else{
                            $dd = $i;
                        }
                       $cur_date = sprintf("%02d",$dd)."-".date('m')."-".date('Y');
                       $nameOfDay = date('D', strtotime($cur_date)); 
                    }  
                    
                    echo "<td>".$cur_date." (".$nameOfDay.")</td>";
                    echo "<td>".$username."</td>";
                      $sel_user_det = "SELECT * FROM attendence WHERE user_id = '".$User_Id."' and date = '".$cur_date."'";
                      $qryss = mysqli_query($connect, $sel_user_det);
                      $get_users_dets = mysqli_fetch_assoc($qryss);
                    
                    /*
                    print"<pre>";
                    print_r($get_users_dets);
                    print"</pre>";
                    */
                    
                    $sel_user = "SELECT Login_Status from employee where Id = '".$User_Id."'";
                    
                    $qryd = mysqli_query($connect, $sel_user);
                    $get_userd = mysqli_fetch_assoc($qryd);
                    
                    //print_r($get_users_dets);
                //  echo  $get_users_dets['login_time'];
                  //echo "<br>";

                  $ex_date_time = explode(" ",$get_users_dets['login_time']);

                 // print_r($ex_date_time);

                  //echo "<br>";

                	$time = isset($ex_date_time['1']) ? $ex_date_time['1'] : 0;

                 

                 // print_r($time);
                 
                	$manpulate_time = explode(":",$time);

                  //echo "<br>";

                  //print_r($manpulate_time['0']);

                  //die();

                    echo "<td>";
                    echo (!empty($time)) ? $time : '';
                    // echo isset($manpulate_time['0']) ? $manpulate_time['0']: '';
                    // echo  ":" ;
                    // echo isset($manpulate_time['1']) ? $manpulate_time['1'] :'';
        	          echo " ".$a_pm = isset($ex_date_time['2']) ? $ex_date_time['2'] : '';
                    echo "</td>";
                    echo "<td>";
                    $exx = explode('-',$cur_date);
                     $dt = $exx['2']."-".$exx['1']."-".$exx['0'];
                            $get_holidays_sel = "SELECT * FROM Holydays WHERE Date = '$dt'";
                           $qry_hlyds = mysqli_query($connect, $get_holidays_sel);
                           $get_holidays = mysqli_fetch_assoc($qry_hlyds);
                           
                      $select = "select * from employee where Id = '".$User_Id."' and Paid_Leaves_Log like '%".$cur_date."%'";
		             $qry = mysqli_query($connect, $select);
		             $fet = mysqli_fetch_assoc($qry);
                     
                           if(array_search($nameOfDay,$holiday_list)){
                              echo '<span class="badge badge-info" style="background:#09abf4;color:#fff;">Sunday</span>';
                          }
                          else if($fet){
                              echo '<span class="badge badge-info" style="background:#8e44ad;color:#fff;">Paid Leave</span>';
                          }
                          
                          else{
                           if($get_holidays){
                               echo '<span class="badge badge-info" style="background:#3f51b5;color:#fff;">Holiday</span>';
                           }
                           else{
                           
                          if($get_users_dets){
                              
                               if($get_users_dets['Pl_Upl'] == 'pl' || $get_users_dets['Pl_Upl'] == 'upl'){
                                
                                if($get_users_dets['Pl_Upl'] == 'pl'){
                                 echo '<span title="Agent Name" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true" class="badge badge-info attendance-popover"  style="background:#17a2b8;">PL</span>';
                                 $pl[$counts_d]  +=1;
                                }
                                else if($get_users_dets['Pl_Upl'] == 'upl'){
                                 echo '<span title="Agent Name" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true" class="badge badge-info attendance-popover"  style="background:#007bff;">UIL</span>';
                                 
                                }
                                 
                                 
                              
                              }
                              else{
                              $total_times = ($get_users_dets['total_time'] + $get_users_dets['manually_added_time']);
                              $total_hours = floor($total_times / 60);
                             
                             if($total_hours<$Halfday_Hour){
                                 echo '<span title="Agent Name" type="button" data-html="true" class="badge badge-danger attendance-popover"  style="background:#e74c3c;">Absent</span>';
                                 
                             }
                             else if($total_hours>=$Halfday_Hour && $total_hours<$Fullday_Hours){
                                  echo '<span style="background:#f1c40f;color:#333" class="badge badge-info attendance-popover"  type="button" data-html="true">Half Day</span>';
                             }
                             else if($total_hours>=$Fullday_Hours){
                                  echo '<span style="background:#27ae60" class="badge badge-success attendance-popover bg-success"  type="button" data-html="true">Present</span>';
                             }
                             else{
                                  echo '<span style="background:#e74c3c;" class="badge badge-danger attendance-popover"  type="button" data-html="true">Absent</span>';
                             }
                              }
                             
                             
                          }
                          else{
                                  echo '<span style="background:#e74c3c;" class="badge badge-danger attendance-popover"  type="button" data-html="true">Absent</span>';
                             }
                             
                           }
                           
                          }
                    echo "</td>";
                    echo '<td>';
                    
                    
                	
                	if($get_users_dets['login_time']){
                	   // echo  $get_users_dets['login_time'];
	 $login_time = strtotime($get_users_dets['login_time']);
	 
	// echo (date('m/d/Y')." 09:00:00 PM");
	//echo $date;
	//echo "&nbsp;";
	 $new_date = date('m/d/Y',strtotime($cur_date))." 09:00:00 AM";
	 $ontime = strtotime($new_date);

	if($login_time>$ontime){
	    if($get_users_dets['Informed_Late'] != '' || $get_users_dets['Informed_Late'] != NULL ){
	        echo "<span style='color:blue'> Informed Late</span>&nbsp;&nbsp;";
	        
	       
	    }
	    else{
	        echo "<span style='color:red'> Late</span>&nbsp;&nbsp;";
	         
	    }
		
	}
	else{
		echo "<span style='color:green'> Ontime</span>";
	}
	
            }
                	
                	
                    echo '</td>';
                    echo "<td>";
                       $total_time = ($get_users_dets['total_time'] );
                        if($total_time>60){
                		//$new_total_time = $row['Total_Time']/60;
                		echo $hours = floor($total_time / 60)." Hours "; // Get the number of whole hours
                		echo $minutes =  ($total_time % 60)." Minutes"; // Get the remainder of the hours
                                }
                        else{
                            if($total_time){
                                echo $total_time." Minutes";
                            }
                            else{
                               echo "0 Minutes"; 
                            }
                		
                	}
                    echo "</td>";
                    echo "<td>";
                    $total_time = ($get_users_dets['manually_added_time']);
                if($total_time>60){
            		//$new_total_time = $row['Total_Time']/60;
            		echo $hours = floor($total_time / 60)." Hours "; // Get the number of whole hours
            		echo $minutes =  ($total_time % 60)." Minutes"; // Get the remainder of the hours
                            }else{
            		if($total_time){
                                echo $total_time." Minutes";
                            }
                            else{
                               echo "0 Minutes"; 
                            }
            	}
                    echo "</td>";
                 echo "<td>";
                   $total_time = ($get_users_dets['total_time'] + $get_users_dets['manually_added_time']);
                    if($total_time>60){
                		//$new_total_time = $row['Total_Time']/60;
                		echo $hours = floor($total_time / 60)." Hours "; // Get the number of whole hours
                		echo $minutes =  ($total_time % 60)." Minutes"; // Get the remainder of the hours
                                }else{
                		echo $total_time." Minutes";
                	}
                 echo "</td>";
                    echo('<td>');
                	echo maTimes($get_users_dets['total_break_time']);		
                	echo ('</td>');
                	echo "<td>".$get_users_dets['message']."</td>";
                	echo "<td>";
                	
                	
                     $reg_status = $get_users_dets['reg_status'];
                    
                    if($get_users_dets && $nameOfDay != 'Sun'){
                    
                    if($reg_status == '' || $reg_status == NULL){
                        echo '<a href="javascript:void(0)" class="btn btn-primary Reguler_button" id="'.$get_users_dets["id"].'">Regularize</a>';
                    }
                    else if($reg_status == 'rejected'){
                        echo "<p style='color:red;'>Regularize Rejected By Admin</p>";
                    }
                    else if($reg_status == 'approved'){
                         echo "<p style='color:green;'>Regularize Approved By Admin</p>";
                    }
                    else if($reg_status == 'pending'){
                         echo "<p style='color:blue;'>Regularize Pending</p>";
                    }
                    else{
                        echo "";
                    }
          }
                    
                    echo "</td>";
                    
               echo "</tr>";     
          }
                   
         // echo $sel_dates; 
         
         /*
         $qry_att = mysqli_query($connect, $sel_dates);
         
         
         while($row = mysqli_fetch_assoc($qry_att)){
         
         
         
         ?>
          
         
          <tr>
            <td><?php echo $row['date'];
            
            $dates = explode("-", $row['date']);
	$yy = $dates['2'];
	$mm = $dates['1'];
	$dd = $dates['0'];

	
        $date = $yy."-".$mm."-".$dd;
   echo "  (". date('D', strtotime($date)) .")";
            
            ?></td>
            <td><?php echo $row['Agent_Name']; ?></td>
            <td><?php 
            
                	$ex_date_time = explode(" ",$row['login_time_IST']);
	$time = $ex_date_time['1'];
	$manpulate_time = explode(":",$time);
	echo $manpulate_time['0'].":".$manpulate_time['1'];
	echo " ".$a_pm = $ex_date_time['2'];
            
            ?></td>
            <td>
                <?php
                 $total_times = ($row['total_time'] + $row['manually_added_time']);
                  $total_hours = floor($total_times / 60);
                 if($total_hours<$Halfday_Hour){
                     echo '<span style="background:red;" class="badge badge-danger">Absent</span>';
                 }
                 else if($total_hours>=$Halfday_Hour && $total_hours<$Fullday_Hours){
                      echo '<span style="background:yellow;color:#333" class="badge badge-info">Half Day</span>';
                 }
                 else if($total_hours>=$Fullday_Hours){
                      echo '<span style="background:green" class="badge badge-success bg-success">Present</span>';
                 }
                 else{
                      echo '<span style="background:red;" class="badge badge-danger">Absent</span>';
                 }
                
                ?>
                
               
                </td>
            <td><?php
 date_default_timezone_set('Asia/Kolkata');
	 $login_time = strtotime($row['login_time_IST']);
	// echo (date('m/d/Y')." 09:00:00 PM");
	$ontime = strtotime(date('m/d/Y')." 09:00:00 PM");
    date_default_timezone_set('America/New_York');
    

	if($row['ontime_late'] == 'Late'){
		echo "<span style='color:red'> Late</span>";
	}
	else if($row['ontime_late'] == 'OnTime'){
		echo "<span style='color:green'> OnTime</span>";
	}
            
            ?></td>
            <td style="color:#3c763d; background: #dff0d8; ">
                
                <?php
          $total_time = ($row['total_time'] );
                if($total_time>60){
		//$new_total_time = $row['Total_Time']/60;
		echo $hours = floor($total_time / 60)." Hours "; // Get the number of whole hours
		echo $minutes =  ($total_time % 60)." Minutes"; // Get the remainder of the hours
	}
	else{
		echo $total_time." Minutes";
	}
                
                ?>
                
                
            </td>
            
            <td style="color:#8a6d3b; background: #fcf8e3;">
                <?php
          $total_time = ( $row['manually_added_time']);
                if($total_time>60){
		//$new_total_time = $row['Total_Time']/60;
		echo $hours = floor($total_time / 60)." Hours "; // Get the number of whole hours
		echo $minutes =  ($total_time % 60)." Minutes"; // Get the remainder of the hours
	}
	else{
		echo $total_time." Minutes";
	}
                
                ?>
                
                 </td>
            <td style="font-weight:bold;">
                <?php
          $total_time = ($row['total_time'] + $row['manually_added_time']);
                if($total_time>60){
		//$new_total_time = $row['Total_Time']/60;
		echo $hours = floor($total_time / 60)." Hours "; // Get the number of whole hours
		echo $minutes =  ($total_time % 60)." Minutes"; // Get the remainder of the hours
	}
	else{
		echo $total_time." Minutes";
	}
                
                ?>
                </td>
            <?php 
            	if($row['total_break_time']>=3600){
            	    echo '<td style="color:#a94442; background: #f2dede;">';
		//$new_total_time = $row['Total_Time']/60;
		echo $hourss = floor($row['total_break_time'] / 3600)." Hours "; // Get the number of whole hours
		 $remain_second =  ($row['total_break_time'] % 3600); // Get the remainder of the hours
		 //if()
		 echo $t_minutes = floor($remain_second / 60)." Minutes ";
		 
	}
	else{
	    echo '<td style="color:#3c763d; background: #dff0d8;">';
	echo $t_minutes = floor($row['total_break_time'] / 60)." Minutes ";
	}
            
            ?></td>
             <td><?php  echo $row['message']; ?></td>
            <td>
                
                <?php
                    
                     $reg_status = $row['reg_status'];
                    if($reg_status == '' || $reg_status == NULL){
                        echo '<a href="javascript:void(0)" class="btn btn-primary Reguler_button" id="'.$row["id"].'">Regularize</a>';
                    }
                    else if($reg_status == 'rejected'){
                        echo "<p style='color:red;'>Regularize Rejected By Admin</p>";
                    }
                    else if($reg_status == 'approved'){
                         echo "<p style='color:green;'>Regularize Approved By Admin</p>";
                    }
                    else if($reg_status == 'pending'){
                         echo "<p style='color:blue;'>Regularize Pending</p>";
                    }
                    else{
                        echo "";
                    }
                
                ?>
                
                
                
                </td>
               
          </tr>
            <?php
            
            
         }
         */
            ?>
        
        </tbody>
      </table>

	  
	</div>
</div>
</div>
	
	

	
	
		
	
	
	</div>


<!-- Trigger the modal with a button -->


<!-- Attendance Regularized -->
<div id="AttendanceRegularized" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Attendance Regularized Request</h4>
      </div>
      <div class="modal-body">

		  
		  <div class="form-group">
    <p for="email">Enter Message:</p>
    <input type="hidden" id="data_reg_ids" value=""/>
    <textarea name="" id="reg_message" cols="30" rows="6" class="form-control" placeholder="Enter Message"></textarea> 
  </div>
       
		 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="reg_submit">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<script>
   $(document).ready(function(){
	
	 //  Agent Attendance  datatable

	  var  winHeight = $(window).innerHeight()
	   
	   $('#Agent_Attendance').DataTable( {
	"order": [],
		"columnDefs": [
    { "orderable": false, "targets": [0,2,3,4,5,6] }
  ],
	"bPaginate": false,
 "bLengthChange": false,
 "bFilter": true,
 "bInfo": true,
 "bAutoWidth": false,
 "scrollY": 1400,
 "scrollCollapse": true,
 "paging": false,
        initComplete: function () {
            this.api().columns([5,6,7]).every( function () {
                var column = this;
                var select = $('<select class="form-control"><option value="">Select</option></select>')
                    .appendTo( $(column.header()) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' );
                } );
            } );
        }
    });
	
	   
	   
	   
	   
       $(".Reguler_button").click(function(){
           
           var reg_id = $(this).attr("id");
           $("#data_reg_ids").val(reg_id);
           $("#AttendanceRegularized").modal("show");
           console.log(reg_id);
           })
       $("#reg_submit").click(function(){
           var reg_ids = $("#data_reg_ids").val();
           var message = $("#reg_message").val();
           console.log(reg_ids + message);
           if(message.length<10){
               alert("Minimum 10 Charecters Required");
               
           }
           else{
               $.ajax({
                   type:"post",
                   url:"Attendance/regulerized_request.php",
                   data:{"id":reg_ids,"message":message},
                   success:function(data){
                       var getData = JSON.parse(data);
                       if(getData.status == 'success'){
                           window.location.reload();
                       }
                   }
               })
           }
       })    
           
   })
	
	
	
/*********************************************************/
/******** Agent_Attendance ************************/	
/********************************************************/
	

  
	
</script>








