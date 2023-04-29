<?php  include('partial/session_start.php'); ?>
<?php
$UserName = $_GET[ 'UserName' ];
$Source = $_GET[ 'Source' ];
$Disposition = $_GET[ 'Disposition' ];
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
    <div class="pull-right" style="margin-right:15px;"><a href="#" class="btn btn-xs btn-primary add-new-transaction"  data-toggle="modal" data-target="#AddCustomerProfile"><i class="fa fa-plus"></i> New</a></div>
    <div class="clearfix"></div>
  </div>
  <div class="containter" style="padding:20px 20px 0 20px;">
      
       <form action="customer-profile-payment-history-add-new.php" method="post" id="update_submit">

        <div class="alert alert-danger" style="display:none">

  <strong>Please fill mandatory fields </strong>

</div>

      <!-- -->

	  <?php

$sql = "SELECT MAX(Costumer_ID) as MaximumID FROM Customer_profile";

$result = mysqli_query($connect,$sql);

$sel_profile = "SELECT * FROM Customer_profile WHERE Costumer_ID = '".$_GET['cust']."'";
$qry_profile = mysqli_query($connect,$sel_profile);
$fetch_profile = $qry_profile->fetch_assoc();
// echo "<pre>"; print_r($fetch_profile['Agent_1']); echo "</pre>";
// echo "<pre>"; print_r($fetch_profile['Agent_1_TL']); echo "</pre>";

?>

        <input type="hidden" name="Costumer_ID" value="<?php echo $_GET['cust']; ?>" />
       <input type="hidden" id="DateTime" name="DateTime"   value="<?php echo date("Y-m-d h:i:s") ?>"/>
			  <div class="row">
				  
				  <?php
				    if($show_hide['PanNumber']){
				  ?>
				  <div class="col-sm-3">
				   <label for="">Pan Number</label>
					  <input type="text" value="" id="PanNumber" name="PanNumber"  class="form-control uppercase" placeholder="Pan Number" maxlength="10" required/>
				  </div>
				  <?php
				    }
				  ?>
				  
				  <?php
				    if($show_hide['KYC']){
				  ?>
				    <div class="col-sm-3">
				   <label for="">KYC</label>
					  <select class="form-control" id="KYC" name="KYC" required>

            <option value="" selected>Select</option>

            <option value="Download">Download</option>

            <option value="Fetch">Fetch</option>

            <option value="Scan">Scan copy</option>

          </select>

				  </div>
				  <?php
				    }
				  ?>
				 
				 
				  <?php
				    if($show_hide['Risk_Score']){
				  ?>
				   <div class="col-sm-3">
				   <label for="">Risk_Score</label>
					  <input type="text" value="" id="Risk_Score" name="Risk_Score" class="form-control" placeholder="Risk Score" required/>
				  </div>
				  <?php
				    }
				  ?>
				  
				  
				  <?php
				    if($show_hide['Date_of_Birth']){
				  ?>
				  <div class="col-sm-3">
				   <label for="">Date of Birth *</label>
					  <input type="text" value="" id="Date_of_Birth" name="Date_of_Birth" class="form-control" placeholder="Date of Birth"  autocomplete="off" required/>

       <input type="hidden" value="" id="altDate_of_Birth" name="altDate_of_Birth" class="form-control" placeholder="Date of Birth"/>
				  </div>
				  <?php
				    }
				  ?>
				  
				  
				  <div class="col-sm-3">
				   <label for="">Package Name*</label>
					   <select class="form-control" id="PackageName" onchange="FetchSegment(this);CalculateDays();" name="PackageName" required>

            <!--<option value="">Select Package</option>-->

           <?php 
               $sel_segment = "SELECT Segment, Segment_Amount FROM Options WHERE Segment IS NOT NULL";
                $qry_segment = mysqli_query($connect,$sel_segment);
                while($fetch_segment = $qry_segment->fetch_assoc()){
                    if($fetch_profile['PackageName'] == $fetch_segment['Segment']){
                        echo '<option data-amount="'.$fetch_segment['Segment_Amount'].'" value="'.$fetch_segment['Segment'].'">'.$fetch_segment['Segment'].'</option>';
                    }
                    
                }
           ?>

          </select>
				  </div>
				  <div class="col-sm-3">
				      <label>Package Price</label>
				      <input type="text" readonly class="form-control" value="" id="PackagePrice" name="PackagePrice" />
				  </div>
				  
				  <div class="col-sm-3">
				   <label for="">Up Sale Date*</label>
					  <input type="text" value="" id="SaleDate" name="SaleDate"  class="form-control" placeholder="Sale Date"  autocomplete="off" required/>

       <input type="hidden" value="" id="altSaleDate" name="altSaleDate" class="form-control" placeholder="alt Sale Date"/>
				  </div>
				  
				  <div class="col-sm-3">
				   <label for="">Activation Date</label>
					  <input type="text"  value="<?php echo date('d-m-Y',strtotime($fetch_profile['Activation_Date'])) ?>" id="Activation_Date" readonly onchange="CalculateDays()" name="Activation_Date" class="form-control" placeholder="Activation Date"  autocomplete="off" required/>

       <input type="hidden" value="" id="altActivation_Date" name="altActivation_Date" class="form-control" placeholder="Activation Date"/>
				  </div>

				  
				  <div class="col-sm-3">
				   <label for="">Expired Date</label>
					  <input type="text" value="<?php echo date('d-m-Y',strtotime($fetch_profile['Exp_Date'])) ?>" id="Exp_Date" name="Exp_Date" onchange="CalculateDays();$('#result_exp_date_error').text('')"  class="form-control" placeholder="Expired Date"  autocomplete="off" required/>
                         <small id="result_exp_date_error" class="text-danger"></small>
       <input type="hidden" value="" id="altExp_Date" name="altExp_Date" class="form-control" placeholder="Expired Date"/>

				  </div>
				  
				  
				  
				<div class="col-sm-3">
				   <label for="">Number of days*</label>
					   <input type="text" value="" id="Number_of_Days" readonly name="Number_of_Days" class="form-control inherit" placeholder="Number of days" required/>
				  </div>
				  
				  <div class="col-sm-3">
				   <label for="">Payment Mode*</label>
					  <select class="form-control" id="PaymentMode" name="PaymentMode" required>

           <?php include('partial/payment_mode.php') ?>

          </select>
           <small id="result_payment_method" class="text-danger"></small>
				  </div>
				 
				 
				  
				  
				  
				  
				  
				  <div class="col-sm-3">
				   <label for="">Total Received Amount*</label>
					  <input type="text" value="" id="TotalReceivedAmount" name="TotalReceivedAmount" class="form-control" placeholder="Estimated Amount" required/>
					  <small id="max_amount_error" class="text-danger"></small>
				  </div>
				  
				  <div class="col-sm-3">
		           <label for="">Gateway Amount*</label>
		             <input type="text" value="" id="Gateway_Amounts_readonly" name="" class="form-control" placeholder="Gateway Amount" disabled/>

		             <input type="hidden" value="" id="Gateway_Amounts" name="Gateway_Amount" class="form-control" placeholder="Gateway Amount" required/>
		          </div>
		          
				  <div class="col-sm-3">
				   <label for="">Company Amount*</label>
					   <input type="text" value="" id="Company_Amounts_readonly" name="" class="form-control" placeholder="Paid Amout" disabled/>

		<input type="hidden" value="" id="Company_Amounts" name="Company_Amount" class="form-control" placeholder="Paid Amout" required/>
				  </div>
				  
				  <div class="col-sm-3">
				   <label for="">Tax Amount*</label>
					  <input type="text" value="" id="TAX_Amount_readonly" name="" class="form-control" placeholder="TAX Amount" disabled/>
      <input type="hidden" value="" id="TAX_Amount" name="TAX_Amount" class="form-control" placeholder="TAX Amount" required/>
				  </div>
				  <div class="col-sm-3">
				   <label for="">Remark</label>
					  <input type="text" value="" id="Remark" name="Remark" class="form-control inherit" placeholder="Remark" required/>
				  </div>
				  
				   <div class="col-sm-3">
				   <label for="">PPE Credits</label>
					  <input type="text" class="form-control" name="PPI_Credits" placeholder="PPE Credit">
				  </div>
				  
				   <div class="col-sm-3">
				       <?php
				            $sel_agent = "SELECT username,Team_Leader FROM employee WHERE Role = 'Agent' AND Status='Active' AND username != 'Select' AND username != 'Akshay Shetty' ";
                              $qry_agent = mysqli_query($connect,$sel_agent);
                              $fetch_agent_list = array();
                              while($fetch_agent = $qry_agent->fetch_assoc()){
                                 $fetch_agent_list[] = $fetch_agent;
                              }
				        $sel_cu_agent = "SELECT Team_Leader FROM employee WHERE username = '".$username."'";
				        $qry_c_agent = mysqli_query($connect,$sel_cu_agent);
				        $fetch_c_agent = $qry_c_agent->fetch_assoc($qry_c_agent);
				       ?>
				        <label for="">Agent One</label>
				        <input type="text" name="Agent_1_TL" value="<?php echo $fetch_profile['Agent_1_TL']; ?>"  placeholder="Agent_1_TL" class="form-control" readonly/>
				        
					    <!--<input type="text" value="<?php  echo $username;?>" id="" name="" class="form-control" placeholder="" disabled/>-->
         <!--               <input type="hidden" value="<?php  echo $username;?>" id="Agent_1" name="Agent_1" class="form-control" placeholder="" required/>-->
         
                         <select class="form-control Agent_Name_Change" id="Agent_1" name="Agent_1">

                    
                    	<option value="">Select Agent</option>
                    <?php
                             foreach($fetch_agent_list as $fetch_agent){ ?>
                                   <option data-tl="<?php echo $fetch_agent['Team_Leader']; ?>" value="<?php echo $fetch_agent['username']; ?>" <?php echo ($fetch_agent['username'] == $fetch_profile['Agent_1']) ? 'selected' : ''; ?> > <?php echo $fetch_agent['username'] ?></option>
                              <?php }
                            ?>

          </select>
                        
					   <input type="text" placeholder="%" value="100" id="Agent_1_Percentange" name="Agent_1_Percentange" class="form-control" style="width: 50px;float: left;" required>

			  <input type="text" name="Agent_1_Shared_Amount" id="Agent_1_Shared_Amount" value="" placeholder="Shared Amount" class="form-control" style="width: 130px;float: left;" required readonly>
				  </div>
				  
				   <div class="col-sm-3">
				        
				   <label for="">Agent Two</label>
				   <input type="text" name="Agent_2_TL"  placeholder="Agent_2_TL" class="form-control" readonly/>
					  <select class="form-control Agent_Name_Change" id="Agent_2" name="Agent_2">

                    <?php
                    
                    echo '<option value="">Select Agent</option>';
                             foreach($fetch_agent_list as $fetch_agent){
                                   echo '<option data-tl="'.$fetch_agent['Team_Leader'].'" value="'.$fetch_agent['username'].'">'.$fetch_agent['username'].'</option>';
                              }
                            ?>

          </select>
					   <input type="text" placeholder="%" value="" disabled="true" name="Agent_2_Percentange" id="Agent_2_Percentange" class="form-control" style="width: 50px;float: left;" >

			  <input type="text" value="" placeholder="Shared Amount" name="Agent_2_Shared_Amount" id="Agent_2_Shared_Amount" class="form-control" style="width: 130px;float: left;" readonly>
				  </div>
				  
				   <div class="col-sm-3">
				   
				   <label for="">Agent Three</label>
				    <input type="text" name="Agent_3_TL"  placeholder="Agent_3_TL" class="form-control" readonly/>
					  <select class="form-control Agent_Name_Change" id="Agent_3" name="Agent_3">

          <?php
                    
                    echo '<option value="">Select Agent</option>';
                             foreach($fetch_agent_list as $fetch_agent){
                                   echo '<option data-tl="'.$fetch_agent['Team_Leader'].'" value="'.$fetch_agent['username'].'">'.$fetch_agent['username'].'</option>';
                              }
                            ?>

          </select>
					   <input type="text" placeholder="%" value="" disabled="true" name="Agent_3_Percentange" id="Agent_3_Percentange" class="form-control" style="width: 50px;float: left;" >

			  <input type="text" value="" name="Agent_3_Shared_Amount" id="Agent_3_Shared_Amount" placeholder="Shared Amount" class="form-control" style="width: 130px;float: left;" readonly >
				  </div>
				   <div class="col-sm-3">
						<label for="">Payment Created Date</label>
						<input type="datetime-local" value="<?php echo date('Y-m-d\TH:i'); ?>" class="form-control" name="Created_payment_date">
					</div>
					<div class="col-sm-3">
						<label for="">UTR NO.#</label>
						<input type="text" value="" class="form-control" name="utr_no" required>
					</div>
				  
				   
				  
				  
			  
			  </div>


			  

<!-- -->

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary" onclick="return checkExpdate()" id="">Add</button>

      </div>

		  </form>
  </div>
  
  
</div>



<?php include('partial/footer.php') ?>
<script>
function checkExpdate(){
    var or_exp_date = "<?php echo date('Y-m-d',strtotime($fetch_profile['Exp_Date'])) ?>";
    var altExp_Date = $("#altExp_Date").val();
    if(altExp_Date == ''){
        $("#result_exp_date_error").text("Kindly Choose A New Expiry Date");
        return false;
    }
    else if(altExp_Date == or_exp_date){
        $("#result_exp_date_error").text("Kindly Choose A New Expiry Date");
        return false;
    }
    else{
        return true;
    }
}
    $(document).ready(function() {


$('#PaymentMode').change(function(){
      
    $('#TotalReceivedAmount, #Company_Amounts, #Company_Amounts_readonly, #TAX_Amount, #TAX_Amount_readonly, #Gateway_Amounts_readonly, #Gateway_Amounts').val('');
   
  $("#TotalReceivedAmount").keyup(function(){

    // alert($("#PaymentMode").val());

    if($("#PaymentMode").val() == 'HDFC Bank' || $("#PaymentMode").val() == 'ICICI Bank' || $("#PaymentMode").val() == 'Axis Bank'){ 
      var TotalReceivedAmount = $('#TotalReceivedAmount').val();
      //    console.log(TotalReceivedAmount);
      var Company_Amount =  Math.round(TotalReceivedAmount/1.18); 
      var TAX_AmountGiven =  TotalReceivedAmount-Company_Amount; 
      var AmountCompanyReceived =  TotalReceivedAmount - TAX_AmountGiven;

      $('#Company_Amount, #Company_Amount_readonly').val(AmountCompanyReceived);
      $('#TAX_Amount, #TAX_Amount_readonly').val(TAX_AmountGiven);
      $('#Company_Amounts, #Company_Amounts_readonly').val(Company_Amount,2);
      console.log(AmountCompanyReceived)
    } else {
        var TotalReceivedAmount = $('#TotalReceivedAmount').val();
        var three_percent =  TotalReceivedAmount/100*3; // updated to 3 percent from 1.95
        var eighteen_percent_of_three_percent =  three_percent/100*18; 
        var Gateway_Amount =  three_percent+eighteen_percent_of_three_percent;  
        var Remaining_Amount = TotalReceivedAmount - Gateway_Amount;
        var Gst_Amount = Remaining_Amount/100*18;
        var Company_Amount =  Math.round(Remaining_Amount - Gst_Amount);  

        var TAX_AmountGiven =  Math.round(Gst_Amount); 
        var AmountCompanyReceived = Company_Amount;
          
        $('#Company_Amount, #Company_Amount_readonly').val(AmountCompanyReceived);
        $('#TAX_Amount, #TAX_Amount_readonly').val(TAX_AmountGiven);
        $('#Company_Amounts, #Company_Amounts_readonly').val(Company_Amount,2);
        $('#Gateway_Amounts, #Gateway_Amounts_readonly').val(Gateway_Amount,2);
    }
  });
    

});





$( "#Activation_Date" ).datepicker({

	dateFormat: 'dd-mm-yy', 

    altField  : '#altActivation_Date',

    altFormat : 'yy-mm-dd',

    format    : 'yy-mm-dd'

});
$( "#Activation_Date" ).datepicker('disable');

	

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

    format    : 'yy-mm-dd',
    minDate:new Date('<?php echo date('Y/m/d',strtotime($fetch_profile['Exp_Date'])) ?>')

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

$("#TotalReceivedAmount").keyup(()=>{
setTimeout(function(){  
    var company_am =  parseInt($("#Company_Amounts").val());
    var per1 = parseInt($("#Agent_1_Percentange").val())?parseInt($("#Agent_1_Percentange").val()):0;
    var per2 = parseInt($("#Agent_2_Percentange").val())?parseInt($("#Agent_2_Percentange").val()):0;
    var per3 = parseInt($("#Agent_3_Percentange").val())?parseInt($("#Agent_3_Percentange").val()):0;
    var per =  company_am*(per1/100);

    $("#Agent_1_Shared_Amount").val(per);
    $("#Agent_2_Shared_Amount").val(company_am*(per2/100));
    $("#Agent_3_Shared_Amount").val(company_am*(per3/100));
}, 1000);
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

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" ></script>

<script>
FetchSegment();
CalculateDays();

function FetchSegment(e = null){
    if(e == null){
        var amount = $("#PackageName").find('option:selected').attr('data-amount');
    }
    else{
     var amount = $(e).find('option:selected').attr('data-amount');   
    }
    
    $("#PackagePrice").val(amount);
}

function CalculateDays(){
    
    var Activation_Date = $("#Activation_Date").val();
    var Exp_Date = $("#Exp_Date").val();
    Activation_Date = Activation_Date.split('-');
    Activation_Date = new Date(Activation_Date[2],Activation_Date[1],Activation_Date[0]);
    
    Exp_Date = Exp_Date.split('-');
    Exp_Date = new Date(Exp_Date[2],Exp_Date[1],Exp_Date[0]);
    var Activation_Date_UnixTime = parseInt(Activation_Date.getTime()/1000);
    var Exp_Date_UnixTime = parseInt(Exp_Date.getTime()/1000);
    
    
    var TimeDifference = parseInt((Exp_Date_UnixTime - Activation_Date_UnixTime)/60/60/24)+parseInt(1);
    
    if(TimeDifference){
        $("#Number_of_Days").val(TimeDifference);
    }
    else{
        $("#Number_of_Days").val(0);
    }
    
    Activation_Date = "<?php echo date('d-m-Y',strtotime($fetch_profile['Exp_Date'])) ?>"
    Activation_Date = Activation_Date.split('-');
    Activation_Date = new Date(Activation_Date[2],Activation_Date[1],Activation_Date[0]);
    Activation_Date_UnixTime = parseInt(Activation_Date.getTime()/1000);
    TimeDifference = ((Exp_Date_UnixTime - Activation_Date_UnixTime)/60/60/24);
    
   var PackagePrice = $("#PackagePrice").val();
   var Estimated = parseInt((PackagePrice/30)*TimeDifference);
   $("#TotalReceivedAmount").val('');
   $("#TotalReceivedAmount").attr('placeholder','Estimated Amount '+Estimated);
   $("#TotalReceivedAmount").attr('data-max-amount',Estimated);
   
}

$("#TotalReceivedAmount").keyup((e)=>{
    $("#max_amount_error").text("");
   var Estimated = $(e.target).attr('data-max-amount');
   var Amount = $(e.target).val();
   console.log(Amount+' '+Estimated)
   var No_Of_days = $("#Number_of_Days").val();
   
   if(parseInt(Amount)>parseInt(Estimated)){
       $("#max_amount_error").text('Maximum '+Estimated+' is allowed for '+No_Of_days+' days')
        $(e.target).val('');
       return false;
   }
})


$(document).ready(()=>{
    $('.Agent_Name_Change').change((e)=>{
        var agent_name = $(e.target).find(':selected').attr('data-tl');
        $(e.target).closest('div').find('input').filter(':first').val(agent_name);
                $(e.target).next('input').prop("disabled", false);

    })
    
    $("#TotalReceivedAmount").focus(()=>{
        var PaymentMode = $("#PaymentMode").val();
        if(!PaymentMode){
            $("#PaymentMode").focus();
            $("#result_payment_method").text('Kindly Choose Payment Method');
        }
        else{
            $("#result_payment_method").text('');
        }
    })
    $("#PaymentMode").change(()=>{
        $("#result_payment_method").text('');
    })
})
</script>



