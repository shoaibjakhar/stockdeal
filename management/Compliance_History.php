<?php  include('partial/session_start.php'); ?>
<?php
// $UserName = $_GET[ 'UserName' ];
// $Source = $_GET[ 'Source' ];
// $Disposition = $_GET[ 'Disposition' ];
date_default_timezone_set( 'Asia/Kolkata' );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Customer Profile</title>
<?php require('partial/plugins.php'); ?>
</head>
<body>
<?php include('partial/sidebar.php') ?>
<div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>
  </header>
  <div class="breadcurms">
    <div class="pull-left"> <a href="memberpage.php">Dashbord</a> | <a href="customer-profile-new-this-month.php">This Month</a> | <a href="customer-profile-new-3-month.php">Last 3 Month</a> | <a href="customer-profile-new-all.php">Customer Profile All</a> | <a href="customer-profile-new-3-month-details.php" >Payment History</a> | <a href="clients.php">Clients Login</a> | <a href="clients-update.php">Client Update</a> </div>
    <!-- <div class="pull-right"><a href="#" class="btn btn-md btn-primary"  data-toggle="modal" data-target="#AddCustomerProfile"><i class="fa fa-plus"></i> Existing</a></div> -->
    <div class="pull-right" style="margin-right:15px;"><a href="#" class="btn btn-xs btn-primary compliance-history-add"  data-toggle="modal" data-target="#AddCustomerProfile"><i class="fa fa-plus"></i> New</a></div>
    <div class="clearfix"></div>
  </div>
  <div class="containter" style="padding:20px 20px 0 20px;">
    <?php include('connection/dbconnection_crm.php')?>
    <?php
    $sql = ( "SELECT id, Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name,  Email_ID, Mobile_No, Pan_Number, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate , 
    DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Compliance_Remarks, Paid_Amout,  Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange,
    Agent_1_Shared_Amount,Agent_2, Agent_2_Percentange,
    Agent_2_Shared_Amount,Agent_3, Agent_3_Percentange,
    Agent_3_Shared_Amount, Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Compliance_History where Costumer_ID = '".$_GET['cust']."' ORDER BY  `DateTime` DESC LIMIT 0 , 60" );
    $result = mysqli_query($connect, $sql );
    echo( '<table id="Customer_profile" class="display" cellspacing="0" width="100%">' );
    echo( '<thead>' );
    echo( '<tr>' );
    echo( '<th>Costumer ID</th>' );
    echo( '<th>Compliance_Date</th>' );
    echo( '<th>Full_Name</th>' );
    echo( '<th>Remark</th>' );
    echo( '<th>Update</th>' );
    echo( '<th>Delete</th>' );
    echo( '</tr>' );
    echo( '</thead>' );
    echo( '<tbody>' );
    while ( $row = $result->fetch_array() ) {
      echo( '<tr>' );
      echo( '<td>' . $row[ 'Costumer_ID' ] . '</td>' );
      echo( '<td>' . $row[ 'SaleDateIND' ] . '</td>' );
      echo( '<td>' . $row[ 'Full_Name' ] . '</td>' );
      echo( '<td>' . $row[ 'Compliance_Remarks' ] . '</td>' );
      
      ?>

     
      <?php
      echo( '<td><a href="#"  class="btn btn-xs btn-primary update_history"  id="'.$row['id'].'" >Udate</a></td>' );
      echo( '<td>');
      ?>
      <a href="Compliance_History_Delete.php?Id=<?php echo $row['id']; ?>&cust=<?php echo $row[ 'Costumer_ID' ]; ?>&time=<?php echo time(); ?>" onclick="return confirm('Are you sure?')">Delete</a>
      <?php
      echo ('</td>' );
    }
    echo( '</tr>' );
    echo( '</tbody>' );
    echo( '</table>' );
    ?>
  </div>
</div>
<!-- Add Payment details  Modal -->
<div class="modal fade" id="AddCustomerProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="AddCustomerProfileLabel">Add Compliance Details</h4>
      </div>
      <div class="modal-body">
      <form action="Compliance_History_Add.php" method="post" id="update_submits">
        <div class="alert alert-danger" style="display:none"> <strong>Please fill mandatory fields </strong> </div>
        <!-- -->
        <?php
        $sql = "SELECT MAX(Costumer_ID) as MaximumID FROM Customer_profile";
        $result = mysqli_query($connect,$sql);
        ?>
        <input type="hidden" id="Costumer_IDLast" value="<?php  echo mysql_result($result, 0);?>"/>
        <input type="hidden" id="DateTime" name="DateTime"   value="<?php echo date("Y-m-d h:i:s") ?>"/>
        <table width="100%"  border="0" class="table table-bordered" cellspacing="0" cellpadding="0">
          <!--  -->
          <tbody>
            <tr>
              <td>Date*</td>
              <td colspan="2">Remarks*</td>
          
          
            </tr>
            <tr>
              <td><input type="hidden" value="<?php echo $_GET['cust']; ?>" id="Costumer_ID" name="Costumer_ID" class="form-control" placeholder="Costumer ID" />
                <input type="text" value="" id="SaleDate" name="SaleDate"  class="form-control" placeholder="Sale Date"  autocomplete="off" required/>
                <input type="hidden" value="2" id="altSaleDate" name="altSaleDate" class="form-control" placeholder="alt Sale Date"/></td>
             
              <td colspan="2">
				<textarea name="Compliance_Remarks" class="form-control" id="" cols="30" rows="10"></textarea>
				</td>
	            </tr>
          </tbody>
        </table>
        <!-- -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update Payment details  Modal -->
<div class="modal fade" id="UpdateustomerProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="AddCustomerProfileLabel">Update Payment Detailse</h4>
      </div>
     <div id="load_ajax_update">   </div>
    </div>
  </div>
</div>

<?php include('partial/footer.php') ?>
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

//var Costumer_IDLast = $('#Costumer_IDLast').val();
//var Costumer_ID = parseInt(Costumer_IDLast) + 1
//$('#Costumer_ID').val(Costumer_ID);


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

$(".update_history").click((e)=>{
    var id = e.target.id;
   // alert(id);
   $("#UpdateustomerProfile").modal('show');
   $("#load_ajax_update").load('Ajax_files/Compliance_History_Update_ajax.php?id='+id+'&time='+Math.round(+new Date()/1000));
    
})



});



/*

$("#update_submits").submit((e)=>{
   // e.preventDefault();
  var per1 = parseInt($("#Agent_1_Percentanges").val())?parseInt($("#Agent_1_Percentanges").val()):0;
  var per2 = parseInt($("#Agent_2_Percentanges").val())?parseInt($("#Agent_2_Percentanges").val()):0;
  var per3 = parseInt($("#Agent_3_Percentanges").val())?parseInt($("#Agent_3_Percentanges").val()):0;
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

$("#Agent_1_Percentanges").keyup(()=>{
    var company_am =  parseInt($("#Company_Amount").val());
    var per1 = parseInt($("#Agent_1_Percentanges").val())?parseInt($("#Agent_1_Percentanges").val()):0;
    var per =  company_am*(per1/100);
   $("#Agent_1_Shared_Amounts").val(per);
    
    
})

$("#Agent_2_Percentanges").keyup(()=>{
    var company_am =  parseInt($("#Company_Amount").val());
    var per1 = parseInt($("#Agent_2_Percentanges").val())?parseInt($("#Agent_2_Percentanges").val()):0;
    var per =  company_am*(per1/100);
   $("#Agent_2_Shared_Amounts").val(per);
    
    
})

$("#Agent_3_Percentanges").keyup(()=>{
    var company_am =  parseInt($("#Company_Amount").val());
    var per1 = parseInt($("#Agent_3_Percentanges").val())?parseInt($("#Agent_3_Percentanges").val()):0;
    var per =  company_am*(per1/100);
   $("#Agent_3_Shared_Amounts").val(per);
    
    
})
*/
</script>