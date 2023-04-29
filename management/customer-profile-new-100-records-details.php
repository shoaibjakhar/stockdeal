<?php  include('partial/session_start.php'); ?>
<?php
 // $UserName = $_GET['UserName'];
 // $Source = $_GET['Source'];
 // $Disposition = $_GET['Disposition'];
date_default_timezone_set('Asia/Kolkata');
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Customer Profile</title>
<?php require('partial/plugins.php'); ?>
	<style>
		
	</style>
</head>
<body>
 <?php include('partial/sidebar.php') ?>
<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
</header>
<div class="breadcurms">
 <div class="pull-left">
<?php include('partial/customer-profile-header-menu.php');?>
 </div>
 <div class="pull-right" style="margin-right:15px;"><a href="customer-profile-new-3-month-details.php" class="btn btn-xs btn-primary">Load More</a></div>

 <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>
<?php

function calculateSum($type,$id){
    global $connect;
     $sel = "select Paid_Amout,Company_Amount,Tax_Amount from Customer_Payment_History where Costumer_ID = '$id'";
    $qry = mysqli_query($connect,$sel);
     $total_paid = 0;
     $com = 0;
     $tax = 0;
     while($row = $qry->fetch_assoc()){
         $total_paid = $total_paid + $row['Paid_Amout'];
         $com = $com+$row['Company_Amount'];
         $tax = $tax+ $row['Tax_Amount'];
     }
     if($type == 'paid'){
         return $total_paid;
     }
     else if($type == 'com'){
         return $com;
     }
     else if($type == 'tax'){
         return $tax;
     }
     else{
         return false;
     }
    
   
}





$sql = ("SELECT Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, Approval_Status,  Email_ID, Mobile_No, Pan_Number, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,
DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout,  Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount,Agent_2, Agent_2_Percentange,
    Agent_2_Shared_Amount,Agent_3, Agent_3_Percentange,
    Agent_3_Shared_Amount,
Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_Payment_History where (SaleDate>= DATE_FORMAT(CURDATE(),'%Y-%m-01') - INTERVAL 3 MONTH) ORDER BY  `Id` DESC LIMIT 100");
//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");
/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
FROM fut_hni");*/
$result = mysqli_query($connect,$sql);
echo('<table id="Admin_Customer_Profile" class="display" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th style="display:">Approval_Status</th>');
  echo('<th>Costumer ID</th>');
  //echo('<th>Download Invoice</th>');
  echo('<th><div style="width:120px;"></div>Sale_Date</th>');
  echo('<th><div style="width:120px;"></div>Sale Month</th>');
  echo('<th>Full Name</th>');
  //echo('<th>Last Name</th>');
 // echo('<th>Email ID</th>');
  //echo('<th>Mobile No</th>');
  
  echo('<th><div style="width:120px;"></div>Package_Name</th>');
  //echo('<th>Activation Date</th>');
 // echo('<th>Exp_Date</th>');
  //echo('<th>Status</th>');
  //echo('<th >Remark</th>');
  echo('<th>Total Amout Received</th>');
  echo('<th>Company Amount</th>');
    echo('<th>Tax Amount</th>');
  echo('<th>Payment Mode</th>');
  echo('<th><div style="width:120px;"></div>Agent_1</th>');

  echo('<th>Agent_1_Share</th>');
	 echo('<th><div style="width:120px;"></div>Agent_2</th>');

  echo('<th>Agent_2_Share</th>');
	 echo('<th><div style="width:120px;"></div>Agent_3</th>');

  echo('<th>Agent_3_Share</th>');
  echo '<th>Delete</th>';
  //echo('<th>Date_of_Birth</th>');
 // echo('<th>KYC</th>');
  //echo('<th>Pan Number</th>');
  //echo('<th>Risk Score</th>');
  //echo('<th>Risk Level</th>');
  //echo('<th>Date Time</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = $result->fetch_array())
{
echo('<tr>');
	echo('<td>');
	//echo $row['Approval_Status'];
	
	if($row['Approval_Status'] == 'Pending'){
	    echo '<span  class="btn btn-danger">'.$row['Approval_Status'].'</span><a href="javascript:void(0)" onclick="changeStatus('.$row['Costumer_ID'].')">Approve now</a>';
	}
	else{
	     echo '<span  class="btn btn-success">'.$row['Approval_Status'];
	}
	
	
	echo ('</td>');
 echo('<td>'.$row['Costumer_ID'].'</td>');
  
  echo('<td>'.date("d M Y",strtotime($row['SaleDateIND'])).'</td>');
   echo('<td>'.date("M Y",strtotime($row['SaleDateIND'])).'</td>');
echo('<td>'.$row['Full_Name'].'</td>');
//echo('<td>'.'<a href="'.'disposition.php?Mobile='.$row['Mobile'].'Blaster&Disposition=Sale&UserName='.$_SESSION['username'].'">'.$row['Mobile'].'</a></td>');
//echo('<td>'.$row['LastName'].'</td>');
 //echo('<td>'.$row['Email_ID'].'</td>');
 //echo('<td>'.$row['Mobile_No'].'</td>');

 echo('<td>'.$row['PackageName'].'</td>');
 //echo('<td>'.date("d-M-Y", strtotime($row['ActivationDate'])).'</td>') ;
 //echo('<td>'.date("d-M-Y", strtotime($row['ExpDate'])).'</td>') ;
 //echo('<td class="'.$row['Status'].'">'.$row['Status'].'</td>');
 //echo('<td >'.$row['Remark'].'</td>');
 echo('<td>'.calculateSum("paid",$row['Costumer_ID']).'</td>');
 echo('<td>'.calculateSum("com",$row['Costumer_ID']).'</td>');
  echo('<td>'.calculateSum("tax",$row['Costumer_ID']).'</td>');
 echo('<td>'.$row['PaymentMode'].'</td>');
echo '<td>'.$row['Agent_1'].'</td>';
echo '<td>'.round($row['Agent_1_Shared_Amount'],0).'</td>';
echo '<td>'.$row['Agent_2'].'</td>';
echo '<td>'.round($row['Agent_2_Shared_Amount'],0).'</td>';
echo '<td>'.$row['Agent_3'].'</td>';
echo '<td>'.round($row['Agent_3_Shared_Amount'],0).'</td>';
if($row['Approval_Status'] == 'Pending' ){
       echo('<td><a href="#" class="btn btn-danger btn-xs" onclick="deleteCustomer('.$row['Costumer_ID'].')">Delete</a></td>');
  }
 else{
     echo '<td></td>';
 }
?>
      
	
     
      <?php
 
 
 /*echo('<td>');
     if($row['Date_of_Birth']){
         echo $row['Date_of_Birth'];
     }
     else{
          echo "";
     }

 
 echo ('</td>') ; */
 
 
 //echo('<td>'.$row['KYC'].'</td>');
 //echo('<td>'.$row['Pan_Number'].'</td>');
 //echo('<td>'.$row['Risk_Score'].'</td>');
 //echo('<td>'.$row['Risk_Level'].'</td>');
 //echo('<td>'.$row['DateTimeConvert'].'</td>');
}
 echo('</tr>');
echo('</tbody>');
echo('</table>');
?>
</div>
</div>


<?php include('partial/footer.php') ?>
   <!-- popover-content end here -->
 <!-- <script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>   -->
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>	  
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

$( "#Activation_Date" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#altActivation_Date',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd'
});
	
$( "#SaleDate" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#altSaleDate',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd'
});
	
$( "#Exp_Date" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#altExp_Date',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd'
});

$( "#Date_of_Birth" ).datepicker( {
			changeMonth: true,
			changeYear: true,
			yearRange: '1930:2010',
			dateFormat: 'mm-dd-yy',
			altField: '#altDate_of_Birth',
			altFormat: 'yy-mm-dd',
			format: 'yy-mm-dd'
});
  
var Costumer_IDLast = $('#Costumer_IDLast').val();
var Costumer_ID = parseInt(Costumer_IDLast) + 1
$('#Costumer_ID').val(Costumer_ID);
	
/** Temp **/
/*
$('#PackageName').find(":selected").text('Stock Future');	
$('#PackageName').find(":selected").val('Stock Future');

$('#PaymentMode').find(":selected").text('Axis Bank');	
$('#PaymentMode').find(":selected").val('Axis Bank');
	
$('#Agent_1').find(":selected").text('Ashmi Ashish Sonawane');	
$('#Agent_1').find(":selected").val('Ashmi Ashish Sonawane');
	
$('#Agent_2').find(":selected").text('Jaya Sagat');	
$('#Agent_2').find(":selected").val('Jaya Sagat');
	
$('#Agent_3').find(":selected").text('Pooja Kharwar');	
$('#Agent_3').find(":selected").val('Pooja Kharwar');	
	*/
/*	
$( "#PackageName option:selected" ).text();	
$( "#PaymentMode option:selected" ).text('Axis Bank');	
$( "#Agent_1 option:selected" ).text('Ashmi Ashish Sonawane');	
$( "#Agent_2 option:selected" ).text('Jaya Sagat');	
$( "#Agent_3 option:selected" ).text('Pooja Kharwar');	
*/
});


$("#update_submit").submit((e)=>{
   // e.preventDefault();
  var per1 = parseInt($("#Agent_1_Percentange").val())?parseInt($("#Agent_1_Percentange").val()):0;
  var per2 = parseInt($("#Agent_2_Percentange").val())?parseInt($("#Agent_2_Percentange").val()):0;
  var per3 = parseInt($("#Agent_3_Percentange").val())?parseInt($("#Agent_3_Percentange").val()):0;
  var total = parseInt(per1)+parseInt(per2)+parseInt(per3);
  console.log(total);
  if(per1>100 || per2>100 || per3>100){
      alert('Percentage must be less then equals to 100');
      return false;
  }
  else if((total <99 && total<100) || total>100){
      alert('Total percentage must be 100%');
      return false;
  }
   
    
})
$("#Company_Amounts").keyup(()=>{
    var company_am =  parseInt($("#Company_Amounts").val());
    var per1 = parseInt($("#Agent_1_Percentange").val())?parseInt($("#Agent_1_Percentange").val()):0;
    var per2 = parseInt($("#Agent_2_Percentange").val())?parseInt($("#Agent_2_Percentange").val()):0;
    var per3 = parseInt($("#Agent_3_Percentange").val())?parseInt($("#Agent_3_Percentange").val()):0;
    var per =  company_am*(per1/100);
    $("#Agent_1_Shared_Amount").val(per);
     $("#Agent_2_Shared_Amount").val(company_am*(per2/100));
      $("#Agent_3_Shared_Amount").val(company_am*(per3/100));
      
    
    
    
})

$("#Agent_1_Percentange").keyup(()=>{
    var company_am =  parseInt($("#Company_Amounts").val());
    var per1 = parseInt($("#Agent_1_Percentange").val())?parseInt($("#Agent_1_Percentange").val()):0;
    var per =  company_am*(per1/100);
   $("#Agent_1_Shared_Amount").val(per);
    
    
})

$("#Agent_2_Percentange").keyup(()=>{
    var company_am =  parseInt($("#Company_Amounts").val());
    var per1 = parseInt($("#Agent_2_Percentange").val())?parseInt($("#Agent_2_Percentange").val()):0;
    var per =  company_am*(per1/100);
   $("#Agent_2_Shared_Amount").val(per);
    
    
})

$("#Agent_3_Percentange").keyup(()=>{
    var company_am =  parseInt($("#Company_Amounts").val());
    var per1 = parseInt($("#Agent_3_Percentange").val())?parseInt($("#Agent_3_Percentange").val()):0;
    var per =  company_am*(per1/100);
   $("#Agent_3_Shared_Amount").val(per);
    
    
})




$(document).ready(function(){
/*********************************************************/
/******** Admin Customer Profile ************************/	
/********************************************************/
		var	winHeight = $(window).height() - 300; 	
		
		
		
		$('#Admin_Customer_Profile').DataTable( {
	   
		
		 autoWidth:        true, 
		"order": [],
		"ordering": false,
	 /*columnDefs: [
    
		{ "orderable": false, "targets": [0,4,5,6,7,8,] }
      ],*/
	"bPaginate": false,
 "bLengthChange":true,
 "bFilter": true,
 "bInfo": true,
 "bAutoWidth": false,
 // "scrollY": winHeight+"px",
 "scrollCollapse": true,
 "paging": true,
 "scrollX": true,
 "searching":true,
  "pageLength": 10,

 "lengthMenu":[250],
dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],	

        initComplete: function () {
            this.api().columns([1,2,4,9,11,13]).every( function () {
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

  });

function changeStatus(id){
    console.log(id);
    $.ajax({
        type:"post",
        url:"customer-profile-new-3-month-details-back.php",
        data:{
            CustomerId:id
        },
        success:(res)=>{
            window.location.reload();
            console.log(res);
        },
        error:(er)=>{
            console.log(er);
        }
    })
}

	var deleteCustomer = function(id){
	    var r = confirm("Are you sure?");
        if (r == true) {
    	    $.ajax({
    	        type:"post",
    	        url:"Ajax_files/Delete_Payment_History.php",
    	        data:{
    	            CustomerId:id
    	        },
    	        success:(res)=>{
    	            console.log(res)
    	            window.location.reload();
    	        }
    	    })
        }
	}
</script>