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
<?php

if($_POST){
    $dates = $_POST['dates'];
    $remarks = $_POST['remarks'];
    $ins = "insert into Holydays (`Date`,`Remark`) VALUES('$dates','$remarks')";
    mysqli_query($connect, $ins);
    echo "<script>window.location.href='attendance.php?holiday_list=holiday'</script>";
}

if(isset($_GET['action']) && isset($_GET['id'])){
    $id = $_GET['id'];
    $del_qry = "DELETE FROM Holydays WHERE id = '$id'";
    mysqli_query($connect, $del_qry);
     echo "<script>window.location.href='attendance.php?holiday_list=holiday'</script>";
}


$sel_holidays = "SELECT * FROM Holydays";
$get_qry = mysqli_query($connect, $sel_holidays);


?>

<div class="row">



	
	<div class="col-sm-12" style="display:;">
	 
		<div class="panel panel-default" style="">
  <div class="panel-heading font-size16">Holydays List  &nbsp;&nbsp;<a href='attendance.php'>Monthly Attendence </a></div>  
  <div class="panel-body">
	    
<form class="form-inline" action="" method="POST">
  <div class="form-group">
    <label for="email">Date:</label>
    <input type="date" class="form-control" id="dates" name="dates" value="<?php echo date('Y-m-d');?>">
  </div>
  <div class="form-group">
    <label for="text">Remarks:</label>
    <input type="text" class="form-control" id="text" name="remarks">
  </div>
  <button type="submit" class="btn btn-primary">Add Holiday</button>
</form>
	    
	   <table id="Admin_Attendance" class="display nowrap table table-bordered table-hover-attendance" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Remarks</th>
                <th>Action</th>
                 
               
                
            </tr>
        </thead>
        <tbody>
           <?php
                while($row = mysqli_fetch_assoc($get_qry)){
           ?>
            <tr>
               <th><?php echo $row['Date']; ?></th>
                <th><?php echo $row['Remark'] ?></th>
                <th>
                    
                    <button class="btn btn-danger"  onclick='window.location.href="attendance.php?holiday_list=holiday&action=delete&id=<?php echo $row['id']; ?>"'>Delete</button>
                </th>
               
                
                <?php
                }
                
                ?>
               
               
            </tr>
           
            
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