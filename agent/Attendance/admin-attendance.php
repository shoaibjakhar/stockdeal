<style>
   /* .sale1 {display:none;}
   td {padding:10px;}*/
	.active-row {background: #faebcc}
	.table-hover-attendance tbody tr:hover {background: #faebcc}
	div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    margin-top: -52px;
}
	.popover {max-width: 100%;} 
	.badge {cursor: pointer;}
</style>


<div class="row">


<?php
 $get_day_hours = "SELECT Halfday_Hour,Fullday_Hours FROM Options WHERE Id = '1'";
$qry_hours = mysqli_query($connect, $get_day_hours);
$get_hours_data = mysqli_fetch_assoc($qry_hours);
 $Fullday_Hours = $get_hours_data['Fullday_Hours'];
 $Halfday_Hour = $get_hours_data['Halfday_Hour'];

 if(isset($_GET['previous_month'])){
            $previous_month = $_GET['previous_month'] + 1;
        }
        else{
          $previous_month = 1;  
        }
        $monthName = date("F", mktime(0,0,0, date("n") - ($previous_month - 1) ));




?>
	
	<div class="col-sm-12" style="display:;">
	 
		<div class="panel panel-default" style="">
  <div class="panel-heading font-size16">
        <?php
            echo $monthName ." ".date('Y');
        ?> 
        Monthly Attendance &nbsp;&nbsp;|&nbsp;&nbsp;<a href='attendance.php?holiday_list=holiday'>Holydays List</a> &nbsp;&nbsp;|&nbsp;&nbsp;
  <a href="<?php 
        if(isset($_GET['previous_month'])){
            $previous_month = $_GET['previous_month'] + 1;
        }
        else{
          $previous_month = 1;  
        }
        $monthName = date("M", mktime(0,0,0, date("n") - ($previous_month - 1) ));
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
	  
	   <table id="Admin_Attendance" class="display nowrap table table-bordered table-hover-attendance" style="width:100%">
        <thead>
            <tr>
                <th>Agent Names</th>
                <?php
                 if(isset($_GET['previous_month'])){
                        $get_month = $_GET['previous_month'];
                       $current_dates_in_months =  date("t", mktime(0,0,0, date("n") - $get_month));
                        
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
                      
                      
                    echo '<th>'.$i.'<br>'.$monthName.'<br>'.date('Y');
                    
                    
                    
                    echo '</th>';
                  }
                
                
                ?>
               
                
            </tr>
        </thead>
        <tbody>
            <?php
              $qry_agents = "SELECT Id, username from employee where Status = 'Active'";
            $get_qry = mysqli_query($connect, $qry_agents);
            while($get_agents = mysqli_fetch_assoc($get_qry)){
            
            
            
            ?>
            <tr>
                <td style=""><?php echo $get_agents['username']; ?></td>
               
                
                <?php
                
                $holiday_list = array('1'=>'Sun');
                
                     if(isset($_GET['previous_month'])){
                        $get_month = $_GET['previous_month'];
                       $current_dates_in_months =  date("t", mktime(0,0,0, date("n") - $get_month));
                        
                    }
                    else{
                      $current_dates_in_months = date('d');
                    }
                
                 for($i=1;$i<=$current_dates_in_months;$i++){
                     echo " <td>";
                     if(isset($_GET['previous_month'])){
                        $get_month = $_GET['previous_month'];
                       // echo $months =  date("t", mktime(0,0,0, date("n") - $get_month));
                        if($i<10){
                            $dd = "0".$i;
                        }
                        else{
                            $dd = $i;
                        }
                        $cur_date = $dd."-".(date('m')-$get_month)."-".date('Y');
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
                       $nameOfDay = date('D', strtotime($cur_date)); 
                    }
                      
                      
                      if(array_search($nameOfDay,$holiday_list)){
                          echo '<span class="badge badge-info" style="background:#09abf4;color:#fff;">Sunday</span>';
                      }
                      else{
                          
                           $qry = 'SELECT * FROM attendence where date = "'.$cur_date.'" and user_id = "'.$get_agents["Id"].'"';
                          $sql_qry = mysqli_query($connect, $qry);
                          $row = mysqli_fetch_assoc($sql_qry);
                          echo "<span class='attendance-popovers' id='".$row['id']."' data-users-ids='".$get_agents["Id"]."' data-user-date='".$cur_date."' data-agent-name='".$get_agents['username']."'>";
                          
                          
                           $cur_db_date = date('Y')."-".date('m')."-".$i;
                           $get_holidays_sel = "SELECT * FROM Holydays WHERE Date = '$cur_db_date'";
                           $qry_hlyds = mysqli_query($connect, $get_holidays_sel);
                           $get_holidays = mysqli_fetch_assoc($qry_hlyds);
                           
                           if($get_holidays){
                               echo '<span class="badge badge-info" style="background:#3f51b5;color:#fff;">Holiday</span>';
                           }
                           else{
                           
                          if($row){
                              $total_times = ($row['total_time'] + $row['manually_added_time']);
                              $total_hours = floor($total_times / 60);
                             
                             if($total_hours<$Halfday_Hour){
                                 echo '<span title="Agent Name" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true" class="badge badge-danger attendance-popover"  style="background:#e74c3c;">Absent</span>';
                                 
                             }
                             else if($total_hours>=$Halfday_Hour && $total_hours<$Fullday_Hours){
                                  echo '<span style="background:#f1c40f;color:#333" class="badge badge-info attendance-popover" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true">Half Day</span>';
                             }
                             else if($total_hours>=$Fullday_Hours){
                                  echo '<span style="background:#27ae60" class="badge badge-success attendance-popover bg-success" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true">Present</span>';
                             }
                             else{
                                  echo '<span style="background:#e74c3c;" class="badge badge-danger attendance-popover" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true">Absent</span>';
                             }
                             
                          }
                          else{
                                  echo '<span style="background:#e74c3c;" class="badge badge-danger attendance-popover" data-toggle="popover"  data-container="body" data-placement="right" type="button" data-html="true">Absent</span>';
                             }
                             
                           }  
                             
                             
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
                      
                      
                      
                      echo ' </td>';
                    
                 }
                
                ?>
               
               
            </tr>
            <?php
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
	    $("#load_popup_content").load("Attendance/popup_content.php?id="+regis_ids+"&user_id="+users_ids+"&date="+users_date);
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