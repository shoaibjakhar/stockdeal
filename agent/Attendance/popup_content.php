<?php
 date_default_timezone_set('Asia/Kolkata');
 
include("../connection/dbconnection_crm.php");
error_reporting(0);
//print_r($_GET);

 $get_day_hours = "SELECT Halfday_Hour,Fullday_Hours FROM Options WHERE Id = '1'";
$qry_hours = mysqli_query($connect, $get_day_hours);
$get_hours_data = mysqli_fetch_assoc($qry_hours);
$Fullday_Hours = $get_hours_data['Fullday_Hours'];
$Halfday_Hour = $get_hours_data['Halfday_Hour'];

$id = $_GET['id'];
$user_id = $_GET['user_id'];
$date = $_GET['date'];

$get_id_qry = "SELECT * FROM attendence WHERE id = '".$id."'";
$get_qry = mysqli_query($connect, $get_id_qry);
$row = mysqli_fetch_assoc($get_qry);

    $user_query = "SELECT * FROM employee WHERE Id = '".$user_id."'";
   
   
   $get_qrya = mysqli_query($connect, $user_query);
   $rows = mysqli_fetch_assoc($get_qrya);
  // prvvint_r($connect);






if(!$row){
   $action = 'insert';
}
else{
    $action = 'update';
    $ex_date_time = explode(" ",$row['login_time_IST']);
	$time = $ex_date_time['1'];
	$manpulate_time = explode(":",$time);


}

                    // + 
                 $total_times = ($row['total_time']);
                  $total_hours = floor($total_times / 60);
                 if($total_hours<$Halfday_Hour){
                     $att_status = 'Absent';
                 }
                 else if($total_hours>=$Halfday_Hour && $total_hours<$Fullday_Hours){
                       $att_status = 'Half Day';
                 }
                 else if($total_hours>=$Fullday_Hours){
                      $att_status = 'Present';
                 }
                 else{
                     $att_status = 'Absent';
                 }
                
                
                $total_times = ($row['total_time'] + $row['manually_added_time']);
                  $total_hours = floor($total_times / 60);
                 if($total_hours<$Halfday_Hour){
                     $att_total_status = 'Absent';
                 }
                 else if($total_hours>=$Halfday_Hour && $total_hours<$Fullday_Hours){
                       $att_total_status = 'Half Day';
                 }
                 else if($total_hours>=$Fullday_Hours){
                      $att_total_status = 'Present';
                 }
                 else{
                     $att_total_status = 'Absent';
                 }                 
                 
                 
                  $total_times = ($row['manually_added_time']);
                  $total_hours = floor($total_times / 60);
                 if($total_hours<$Halfday_Hour){
                     $offline_att_status = 'Absent';
                 }
                 else if($total_hours>=$Halfday_Hour && $total_hours<$Fullday_Hours){
                       $offline_att_status = 'Half Day';
                 }
                 else if($total_hours>=$Fullday_Hours){
                      $offline_att_status = 'Present';
                 }
                 else{
                     $offline_att_status = 'Absent';
                 }
                
                ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td style="vertical-align: top;width:100px">
		<div><img src="
		<?php 
		    if($rows['Profile_Picture'] != '' || $rows['Profile_Picture'] != NULL){
							    echo $rows['Profile_Picture'];
							}
							else{
							
							echo "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxATEBIREhAQFRIQEhAQERYTEhEQEhYQFxUYIhUSFRUZHSgiGB0mJxUTIjEhJSsrMC4uFx8zODMsNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIAOAA4AMBIgACEQEDEQH/xAAbAAEAAwEBAQEAAAAAAAAAAAAAAwQFBgIBB//EADsQAAIBAgQDBgIHBwUBAAAAAAABAgMRBAUSIQYxURNBYXGBkSKhBzJyscHR4TRCUmKCorIUQ1NzsxX/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A/cQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD42fSHGStTk/BgQrMafV+zJY4um+U4+9jnUepQkucWvNNAdMpJ8mfTllLp8iWGLmuU5e9wOkBgwzKqu9PzSJYZvLvjF+TaA2QZtPN4vnFr1TNFAfQAAAAAAAAAAAAAAAAAAAAAAAClm8rUn4tL5l0yuIJ2hBdZX9l+oGfgFerBeJ0ljnsjV6vlFs6ICOdCD5xi/REM8upP923ldFoAZ88ppvk5L1uVMZlmiLkpbLqjbM7PJ2peckgMahvKK6tI6pHMZUr1oebfsjpwAAAAAAAAAAAAAAAAAAAAADzOaW7divPHQXK7POZR+FPozOAuSx8m7JJfMocR1PjgukW/d/oWMLG84+ZmZ/UvXl4KK+QF7huO834RX3/oaGOzKFPa95d0V+PQxcNXlTwspRdnOoop+n6GXKbbu3uwOsyvMVVTTspLu8OqLOIxMIK8pJff6I42jXlGSlF2aFavKTvKTb8QNbG53KW1P4V121P8j5mk32NFN7tNvr4GPHd267GpxDK04R/hgkwJeHY3qt9IP3bX6nRGFwxHapL7KN0AAAAAAAAAAAAAAAAAAAAAAixELxa8DHN0xsRC0mvECXL18foznM0q3rVH/M17bfgdNl7tqk+SRxk53bfVtgb1CVGeHhSlVUWpOXrvz9zw8lT+rXpS9V+ZhXGoDZqZFXXcn5MrVcurx505em/3FOniJx5SkvJss083rrlUl67ge8voydamnFr44vdPudyTPat68/Cy9j3DiOsnuoP0sZmIrucpTfOTb8NwOs4ahajf+KTZrFLJYWw9Nfy399/xLoAAAAAAAAAAAAAAAAAAAAAAM7Mobp9Vb2NErY6F4eW4EGEp6qc433knH3RztXh7ELkoy8pfma0ZNcnYkjiZr95/eBzVTLK8edKftf7itUpyj9aMl5po7Sniqj5K/oXKTk/rRS+YH55qFz9Aq4GlL61OD84q5Uq5Bhn/ALdvstoDirhdOp1dXhek+U5r2ZFS4XtOMu0vFNO2nfYDfw8NMIx/hjGPsiQAAAAAAAAAAAAAAAAAAAAAAAHySumuux9AFGOX9ZbE8MJBd1/PcnAHxI+gAAAAAAAAAAAAAAAAAAAAAAAAAACpjsyo0dPa1YQ1atOp2va17e69wLYPMZJpNO6aumuVupBgsfSqpulUjNRemWl3s+jAsghxOKp01qqTjFdZNIhweaUKrtTrU5vpGSb9gLgBFisRCnFznJRjHm3skBKCLDYiFSCnCSlGXJrdMrUM3w86nZRrQlUvJaU/ivHmreFmBeBHiK8YRc5yUYxV5N7JLxIsDj6NZN0qkZqLs3F3s+gFkEOLxUKcXOpOMYq13J2R5weNp1Y6qc4zje14u6v0AsAFDFZzhqb0zr04vo5K4F8FfCY2lVTdOpGaXPS07eZWxOd4WnNwnXpxlHmnKzQGiChg84w1WWinWhOVm7Rd3Zcy+AAAAAAAAAAAA4v6QKKnWwUG7KpKrC/TVKkr/M7Q4/jj9py7/ul/6UQJ+CsxlaeDq7VcM2lfvgnbby29GiD6O3aliH0rX/tPvFmGlQr0sfTX1ZKNdLvjyu/NXXsefo+SlSxKXKVV28nECpk2G/8AoYqtWr3lSpPTCF3p77L5XfW5Z4t4fpUqX+pw8eyqUXGT0Nra/NdGtiHgrERw9evharUZOd432u1fZPxVmjU45zKEMLKlqTnWtGMU7u11d29PmBqcPY918NTqv60o2l9pOz+4q8Z/sNbyj/kiThTBypYSlCStKzk10cm3b5kfGf7DW8o/5ID1wd+w0Psy/wA5HA4Wo6dT/WK/wYtxl3fDJN/Naju+FJWy+k+kJv8AukctlGB7XLcWlvLtHUj5ws/mrr1A3eNsRqp0cPB74qpBf0Jr8XErfR7FReLprlCrFLrZal+CKnC1V4rFUakruOEw8Yb/APLutXzfsi1wVtisbH+e9v6pfmBJxzUdSeGwkedaopS8Ip2X3yf9JHwfLscXisI+Sk6lNeCf5OHsUqzxGIzKpPD9nfDrTF1L6Els+Se93L5kWMeJw+PoYjE9leo9LdK+nStne65/EgN3jnNalKnClSbVSvLTdbNR2vZ9zd0r+Z6y3hDC06a7WCqTaTnKbaWrolco/SFQkuwxEVdUp2l4bpxb8NmvY25Tw+Ow6XaPTLTKWmSjOMlvZ9ALOV5dQo6lRioqbUpJNvdebOPrUqEs3qqvo7PS38btHVpjbf3LHBNJQxmLpxbcYLTG7u7KT7yvVwVKtm9WnWipQ0t2cnHdRjbdNMDp8qwWBjU1YeNHWk/qSu1F8+/yNgy8rybCUJuVGCjKUdL+Oc7xuna0pPojUAAAAAAAAAAAAZua5LTrzo1JuaeHk5w0tJNtxfxXTv8AUXTvNIARYrDxqQlTmrxmnFrwZRyPJKWFjKNNzanLU9bTd7W2skaYAy83yDD4izqQepbKcXplbpfv9Stl3CeFpTU9M5zW6dSWqz8kkvkboAFXM8DCvSlSm5KM7JuLSfPuumWgBTwOXQpUFQi5aIxlFNtOVnfvtbv6EWT5PTw9N0oObjJuT1tN3a35JGiAM7J8mo4ZTVJS+OWqWp3fgl4HnLskpUatWtCVRyrX1KTi4re+1kaYAy8lyKlhu0cJVJOq05ubi3dX6JdWes8ySlioRhUc1olqTg0nys1unt+SNIAQrDR7NU5fHHSovXZ6kl+91MGtwVg3LVHtYX5qE7Ly3T2OkAGXk+Q4fDOTpRlqkkpOUnJtLu6FLMuEMPWqyqznWUp2vplBLZd14s6EAYGVcJ0KFVVYTrOUbpKUouO66KKN8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/9k=";
							}
		
		?>
		
		
		" alt="" style="width: 100px;"></div>
		<div>
		    
		   
		        <?php
                 $total_times = ($row['total_time'] + $row['manually_added_time']);
                  $total_hours = floor($total_times / 60);
                 if($total_hours<$Halfday_Hour){
                     echo '<span style="background:red;margin: 5px 0;" class="btn  btn-xs btn-block btn-danger">Absent</span>';
                 }
                 else if($total_hours>=$Halfday_Hour && $total_hours<$Fullday_Hours){
                      echo '<span style=";margin: 5px 0;" class="btn  btn-xs btn-block btn-warning">Half Day</span>';
                 }
                 else if($total_hours>=$Fullday_Hours){
                      echo '<span style="background:green;margin: 5px 0;" class="btn btn-xs btn-block btn-success">Present</span>';
                 }
                 else{
                      echo '<span style="background:red;margin: 5px 0;" class="btn  btn-xs btn-block btn-danger">Absent</span>';
                 }
                
                ?>
		  
		    <!--<a href="#" class="btn btn-xs btn-block btn-danger" style="margin: 5px 0;">Absent</a>-->
		    
		 </div>
		</td>
      <td style="vertical-align: top;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>
		
		  <table width="100%" class="table table-bordered" border="0" cellspacing="0" cellpadding="0" style="margin-top: 0px;margin-left: 10px;">
  <tbody>
    <tr>
      <td colspan="3" style="font-weight: bold;"><div><?php  echo $rows['username']; ?> / <?php
      $explode_dates = explode("-",$date);
      
      
       $monthName = date("F", mktime(0, 0, 0, $explode_dates['1'], 10));
      echo $explode_dates['0']." ".$monthName." ".$explode_dates['2']
      ?>  </div></td>
    </tr>
    <tr>
      <td style="color:#3c763d; background: #dff0d8;font-weight: bold;">Online Hours</td>
      <td style="color:#8a6d3b; background: #fcf8e3;font-weight: bold;">Manual Enter</td>
      <td style="font-weight: bold;">Total Hours</td>
     
    </tr>
	  <tr>
      <td style="color:#3c763d; background: #dff0d8;font-weight: bold;"><?php
       $total_time = ($row['total_time'] );
                if($total_time>60){
		//$new_total_time = $row['Total_Time']/60;
		echo $hours = floor($total_time / 60)." Hours "; // Get the number of whole hours
		echo $minutes =  ($total_time % 60)." Minutes"; // Get the remainder of the hours
                }else{
		echo $total_time." Minutes";
	}
      
      ?></td>
      <td style="color:#8a6d3b; background: #fcf8e3;font-weight: bold;"><?php
       $total_time = ($row['manually_added_time']);
                if($total_time>60){
		//$new_total_time = $row['Total_Time']/60;
		echo $hours = floor($total_time / 60)." Hours "; // Get the number of whole hours
		echo $minutes =  ($total_time % 60)." Minutes"; // Get the remainder of the hours
                }else{
		echo $total_time." Minutes";
	}
      
      ?></td>
      <td style="font-weight: bold;">
          <?php
          
          $total_time = ($row['total_time'] + $row['manually_added_time']);
                if($total_time>60){
		//$new_total_time = $row['Total_Time']/60;
		echo $hours = floor($total_time / 60)." Hours "; // Get the number of whole hours
		echo $minutes =  ($total_time % 60)." Minutes"; // Get the remainder of the hours
                }else{
		echo $total_time." Minutes";
	}
          ?>
          
      </td>
      
    </tr>
  </tbody>
</table>

		
		</td>
    </tr>
  </tbody>
</table>

		</td>
    </tr>
  </tbody>
</table>
<table width="100%"  class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><strong>Login Time</strong></td>
      <td><strong>Late Status</strong></td>
      <td><strong>Break Hours</strong></td>
    </tr>
    <tr>
      <td><?php
        	echo $manpulate_time['0'].":".$manpulate_time['1'];
        	echo " ".$a_pm = $ex_date_time['2'];
      
      ?></td>
     
     <?php
       date_default_timezone_set('Asia/Kolkata');
	 $login_time = strtotime($row['login_time_IST']);
	// echo (date('m/d/Y')." 09:00:00 PM");
	$ontime = strtotime(date('m/d/Y')." 09:00:00 PM");
    date_default_timezone_set('America/New_York');
    

	if($row['ontime_late'] == 'Late'){
		echo " <td style='color:#a94442; background: #f2dede;'><span'> Late</span>";
	}
	else if($row['ontime_late'] == 'OnTime'){
		echo "<td style='color:#3c763d; background: #dff0d8;'><span> OnTime</span>";
	}
	else{
	    echo "<td style='color:#a94442; background: #f2dede;'>";
	}
      ?></td>
      
      
          
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
            
            ?>
      </td>
    </tr>
  </tbody>
</table>

		<table width="100%" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><strong>Agent Remarks</strong></td>
    </tr>
    <tr>
      <td>
	<p style="max-width:420px; max-height: 100px; overflow: auto;">
		 <?php echo $row['message']; ?>
		 </p> 
	 </td>
    </tr>
  </tbody>
</table>

		<div class="pull-left">
		    <?php
		   // echo $att_status;
		        if($att_status == 'Absent'){
		           if($offline_att_status == 'Absent'){
		               if($att_total_status != 'Half Day'){
		                   ?>
		                   <a href="#" class="btn btn-success" onclick="submitForm('<?php echo $action; ?>','present')">Mark as Present</a>	
		                   <?php
		               }
		               else{
		                   ?>
		                   <a href="#" class="btn btn-danger" onclick="submitForm('<?php echo $action; ?>','absent')">Mark as Absent</a>
		                   
		                   <?php
		               }
		               
		               if($att_total_status != 'Half Day'){
		               
		            ?>
                        	            
		             <a href="#" class="btn btn-warning" onclick="submitForm('<?php echo $action; ?>','half_day')">Mark as Halfday</a>
		             
		            <?php
		               }
		               else{
		                   ?>
		                   <a href="#" class="btn btn-success" onclick="submitForm('<?php echo $action; ?>','present')">Mark as Present</a>
		                   
		                   <?php
		               }
		        }
		        else if($offline_att_status == 'Half Day'  ){
		            if($att_total_status != 'Present'){
		             ?>
                        <a href="#" class="btn btn-success" onclick="submitForm('<?php echo $action; ?>','present')">Mark as Present</a>	
                       <?php
		            }
		            else{
		                ?>
		                <a href="#" class="btn btn-warning" onclick="submitForm('<?php echo $action; ?>','half_day')">Mark as Halfday</a>
		                <?php
		            }
                       
                       ?>
		             <a href="#" class="btn btn-danger" onclick="submitForm('<?php echo $action; ?>','absent')">Mark as Absent</a>
		             
		            <?php
		        }
		        else if($offline_att_status == 'Present'){
		            ?>
                        <a href="#" class="btn btn-danger" onclick="submitForm('<?php echo $action; ?>','absent')">Mark as Absent</a>		            
		             <a href="#" class="btn btn-warning" onclick="submitForm('<?php echo $action; ?>','half_day')">Mark as Halfday</a>
		             
		            <?php
		        }
		  }
		  else if($att_total_status =='Half Day' ){
		            
		        
		    ?>
		    <a href="#" class="btn btn-success" onclick="submitForm('<?php echo $action; ?>','present')">Mark as Present</a>
		    <?php
		
		        }
		      else if($row['manually_added_time'] != 0){
		            ?>
		             <a href="#" class="btn btn-warning" onclick="submitForm('<?php echo $action; ?>','half_day')">Mark as Halfday</a>
		            <?php
		        }
		   // echo $row['reg_status'];    
		        
		 if($row['reg_status'] == 'pending'){
		            ?>
		             <a href="#" class="btn btn-danger" onclick="submitForm('<?php echo $action; ?>','rejected')">Mark as Rejected</a>
		            <?php
		        }
		        
		        //echo 
		       // echo $att_total_status;
		       // echo $offline_att_status;
		  ?>
		</div>
		<div class="pull-right">
		  <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
			
		</div>
		<div class="clearfix"></div>
		<br>
		
		
		
		<script>
		function submitForm(methods,mark){
		        $("#admin_attendence_edit_modal").preloader();
		            var id = "<?php echo $id; ?>";
		            var user_id = "<?php echo $user_id; ?>";
		            var date = "<?php echo $date; ?>";
		            var formData = "id="+id+"&user_id="+user_id+"&date="+date+"&methods="+methods+"&mark="+mark;
		            $.ajax({
		                type:"post",
		                url:"Attendance/edit_attendence.php",
		                data:formData,
		                success:function(data){
		                    console.log(data);
		                    var getData = JSON.parse(data);
		                    if(getData.status == 'success'){
		                       // $("#load_popup_content").load("Attendance/popup_content.php?id="+id+"&user_id="+user_id+"&date="+date);
		                       window.location.reload();
		                    }
		                }
		            })
		        }
		    $(document).ready(function(){
		        $("body").preloader('remove');

    
    
		        const methods = "<?php echo $action; ?>";
		        
		        
		        
		        
		    })
		    
		</script>
		
		
		
		
		
		
		