<?php  //include('partial/session_start.php'); ?>
<?php
 //$username = $_SESSION['username'];
 //echo $username;
 ?>



<?php 
//include ($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");
?>













<script type="text/javascript">

 $(document).ready(function() {
  
  var winHeight = $(window).height()
  $('.sidebar, .main_container').height(winHeight);
	var followUpHistory =  winHeight - 420;
	
	  $('#StockTips').dataTable({
	   "bPaginate": false,
    "scrollY": "400px",
	"sScrollX": "100%",
	 "aaSorting": []
	
	 });
	 
	 $('#Freshleads').dataTable({
	   "bPaginate": false,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": true,
		"bAutoWidth": false,
		//scrollY": 200,
		"scrollX": true,
		"scrollY": "460px",
		//"scrollCollapse": true,
		 fixedColumns:   {
            leftColumns: 1,
            rightColumns: 1
        },
		
		
		  "aaSorting": []
		 
		 });
	
  
    $('#veiw_Leads').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": false,
		"bAutoWidth": false,
		//scrollY": 200,
		"scrollX": true,
		"scrollY": "460px",
		//"scrollCollapse": true,
		 fixedColumns:   {
            leftColumns: 1,
            rightColumns: 1
        },
		
		
		  "aaSorting": []
		 
		 });
		 

 $('#stockTips').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": false,
		"bAutoWidth": false,
		//scrollY": 200,
		"scrollX": true,
		"scrollY": "210px",
		//"scrollCollapse": true,
		 fixedColumns:   {
            leftColumns: 1,
            rightColumns: 1
        },
		
		
		  "aaSorting": []
		 
		 });
		 
		 
		 
		 
		  $('#veiw_LeadsData').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": false,
		"bAutoWidth": false,
		//scrollY": 200,
		"scrollX": true,
		"scrollY": "420px",
		//"scrollCollapse": true,
	
		
		
		  "aaSorting": []
		 
		 });
		 
		 
		 
		 $('.Customer_profile, .Customer_profile_1, .Customer_profile_2').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": false,
		"bAutoWidth": false,
		//scrollY": 200,
		"scrollX": true,
		"scrollY": "350px",
		//"scrollCollapse": true,
		 /*fixedColumns:   {
            leftColumns: 1,
            rightColumns: 1
        },*/
		
		
		 "order": [[1, 'ASC']]
		
		 
		 });
	 
	 
	 
	$('#Customer_profile').dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": false,
        "scrollY": $(window).height() - 250+"px",
        "sScrollX": "100%",
        "bScrollCollapse": true,
        "scrollCollapse": true,
        "aaSorting": [],
		 "order": [[ 0, "desc" ]]

    });

	 $('#Agent_request').dataTable({
		 "bPaginate": false,
		"bLengthChange":true,
		"bFilter": true,
		"bInfo": true,
		"bAutoWidth": false,
		//scrollY": 200,
		"scrollX": true,
		// "scrollY": "420px",
		"paging":true,
		//"scrollCollapse": true,
		 
	
		  "aaSorting": []
		 
         
	 });
	 
	 
	 $('#Demo_Customer_profile').dataTable({
		 "bPaginate": false,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": true,
		"bAutoWidth": false,
		//scrollY": 200,
		"scrollX": true,
		"scrollY": "420px",
		//"scrollCollapse": true,
	 });
	 
		 
		 
    $('#veiw_Leadstest').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": true,
		"bAutoWidth": false,
		//scrollY": 200,
		//"scrollX": true,
		"scrollY": "350px",
		//"scrollCollapse": true,
		 "order": [[1, 'ase']]
		 });
	 
	 
	  $('#DispositionResults').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": true,
		"bAutoWidth": false,
		//scrollY": 200,
		//"scrollX": true,
		"scrollY": "350px",
		 "order": false 
		 });
	 
		 
		 $('#followUpHistory, #Result_Customer_Profile').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": true,
		"bAutoWidth": false,
		//scrollY": 200,
		//"scrollX": true,
		//"scrollY": followUpHistory+"px",
		//"scrollCollapse": true,
		 "order": [[1, 'ase']]
		 });
		 
		 
		 /*$('#SalesAgentWise').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bInfo": false,
		"bAutoWidth": false,
		"bSort": false,
		//scrollY": 200,
		//"scrollX": true,
		"scrollY": "250px",
		//"scrollCollapse": true,
		 //"order": [[1, 'ase']]
		 
		 
		 });*/
		 
		 var t = $('#SalesAgentWise').DataTable( {
			 "bPaginate": true,//added by softwebies
			"bLengthChange": true,//added by softwebies

			"bFilter": false,
			"bInfo": false,
			//"bAutoWidth": false,
			"bSort": false,
			 
        	"columnDefs": [ {
			
			"scrollY": "250px",
            "searchable": false,
            "orderable": false,
            "targets": 0,
            "pageLength": 10,//added by softwebies
            "paging": true//added by softwebies
        } ],
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
	
	
	
	var pageTitle = $(document).find("title").text(); //#34495e

        if (pageTitle == 'Follow Up Leads') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(1)').addClass('active')
        } else if (pageTitle == 'Dashboard') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(2)').addClass('active')
        } else if (pageTitle == 'Sales Agent Wise') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(3)').addClass('active')
        } else if (pageTitle == 'Free Trail') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(4)').addClass('active')
        } else if (pageTitle == 'Customer Profile') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(5)').addClass('active')
        } 
	 /*
	 else if (pageTitle == 'Stock Tips') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(5)').addClass('active')
        } else if (pageTitle == 'View Leads') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(6)').addClass('active')
        } else if (pageTitle == 'Quality Analysis') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(7)').addClass('active')
        } else if (pageTitle == 'Send Mail') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(8)').addClass('active')
        } 
		else if (pageTitle == 'Agent Request') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(9)').addClass('active')
        }
	 else if (pageTitle == 'Send SMS') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(10)').addClass('active')
        }
	 
	  else if (pageTitle == 'Change Password') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(11)').addClass('active')
        }
	 
	 else if (pageTitle == 'Demo Stock Tips') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(12)').addClass('active')
        }
*/

	
 });
</script>
    

<script>

	/******************************/
/**** Follow up reminder ******/
/******************************/

	
$(document).ready(function(){

  $( "#Follow_Up_Reminder_datepicker_INR" ).datepicker({

	dateFormat: 'dd-mm-yy', 

    altField  : '#Follow_Up_Reminder_datepicker',

    altFormat : 'yy-mm-dd',

    format    : 'yy-mm-dd',

	minDate: 0 

});

});
				 	
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    function confirmation()
     {
    swal("Sending Offer Letter!");

    }
</script>




