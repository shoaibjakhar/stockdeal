<?php  include('partial/session_start.php'); ?>
<?php
/*$UserName = $_GET['UserName'];
$Source = $_GET['Source'];
$Disposition = $_GET['Disposition'];*/
$Costumer_ID = $_GET[ 'Id' ];


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sales Agent Wise</title>
<?php require('partial/plugins.php'); ?>
<style>
.dataTables_filter {
    display: none;
}
label{margin-top:10px;}
</style>
</head>
<body>
<?php include('partial/sidebar.php') ?>
<div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>
  </header>
  <div class="breadcurms"> <a href="customer-profile.php">Customer Profile</a> </div>
  <div class="containter" style="padding:20px 20px 0 20px;">
    <?php include('connection/dbconnection_crm.php')?>
    <?php
    //$sql = "SELECT Agent, Manager, SUM( Paid_Amout ) AS SalesAgentWise FROM Customer_profile GROUP BY `Agent` ORDER BY `SalesAgentWise` DESC LIMIT 0, 30 ";
    $sql = "SELECT * FROM  `Customer_Payment_History` WHERE  `Id` = '" . $Costumer_ID . "' ";
    /*$sql = ("SELECT Costumer_ID, FirstName, LastName, Email_ID, Mobile_No, Location, PackageName, DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , Remark, Paid_Amout, Balance_amount, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DateTime FROM Customer_profile");*/
    //$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");
    /*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
    FROM fut_hni");*/
    $result = mysqli_query($connect, $sql );
    
    echo( '<form  action="customer-profile-payment-history-update-back.php" method="POST" id="update_submit">' );
   // while ( $row = mysqli_fetch_array( $result ) ) {
		$row = $result->fetch_assoc();
// 		print"<pre>";
// 		print_r($row);
// 		print"</pre>";
		$exp_date = $row['Exp_Date'];
		
		echo('<div class="row">');
		echo '<input type="hidden" name="Id" value="'.$Costumer_ID.'" />';
		echo '<input type="hidden" name="cust" value="'.$row['Costumer_ID'].'" />';
	
		?>
		<div class="col-sm-3">
			<label for="">Sale Date*</label>
			<input type="text" value="<?php echo date('d-m-Y',strtotime($row['SaleDate'])); ?>" id="SaleDate" name="SaleDate"  class="form-control" placeholder="Sale Date"  autocomplete="off" required/>
            <input type="hidden" value="<?php echo date('Y-m-d',strtotime($row['SaleDate'])); ?>" id="altSaleDate" name="altSaleDate" class="form-control" placeholder="alt Sale Date"/>
	    </div>
	     
	    <div class="col-sm-3">
			<label for="">Payment Mode*</label>
			<select class="form-control" id="PaymentMode" name="PaymentMode" required>
            <?php
                $sql_payment_mode = ("SELECT payment_mode FROM `Options` WHERE payment_mode IS NOT NULL");
                // echo('<option value="" >Payment Mode</option>');
                $result_payment_mode = mysqli_query($connect,$sql_payment_mode);
                while($row_payment_mode = mysqli_fetch_array($result_payment_mode))
                {
                        if($row_payment_mode['payment_mode'] == $row['PaymentMode']){
                            echo('<option value="'.$row_payment_mode['payment_mode'].'" selected>'.$row_payment_mode['payment_mode'].'</option>');
                            continue;
                        }
                  echo('<option value="'.$row_payment_mode['payment_mode'].'">'.$row_payment_mode['payment_mode'].'</option>');
                }
            
            ?>
            </select>
             <small id="result_payment_method" class="text-danger"></small>
		</div>
		<div class="col-sm-3">
		    <label>Total Received Amount</label>
		    <input type="text" readonly name="Paid_Amount" id="TotalReceivedAmount" value="<?php echo $row['Paid_Amout']; ?>" class="form-control" />
		</div>

    <div class="col-sm-3">
     <label for="">Gateway Amount*</label>
       <input type="text" value="" id="Gateway_Amounts_readonly" name="" class="form-control" placeholder="Gateway Amount" disabled/>

       <input type="hidden" value="" id="Gateway_Amounts" name="Gateway_Amount" class="form-control" placeholder="Gateway Amount" required/>
    </div>

		<div class="col-sm-3">
		    <label>Company Amount</label>
		    <input type="text" readonly name="Company_Amount" id="Company_Amounts" value="<?php echo $row['Company_Amount']; ?>" class="form-control" />
		</div>
		
		<div class="col-sm-3">
		    <label>Tax Amount</label>
		    <input type="text" readonly name="Tax_Amount" id="Tax_Amount" value="<?php echo $row['Tax_Amount']; ?>" class="form-control" />
		</div>
		
		<!--<input type="hidden" name="Company_Amounts" value="<?php echo $row['Company_Amount']; ?>" id="Company_Amounts" />-->
		
	<div class="col-sm-3">
				       <?php
				            $sel_agent = "SELECT username,Team_Leader FROM employee WHERE Role = 'Agent' AND Status='Active' AND username != 'Select' AND username != 'Akshay Shetty' ";
                              $qry_agent = mysqli_query($connect, $sel_agent);
                              $fetch_agent_list = array();
                              while($fetch_agent = $qry_agent->fetch_assoc()){
                                 $fetch_agent_list[] = $fetch_agent;
                              }
				        // $sel_cu_agent = "SELECT Team_Leader FROM employee WHERE username = '".$username."'";
				        // $qry_c_agent = mysqli_query($connect,$sel_cu_agent);
				        // $fetch_c_agent = mysqli_fetch_assoc($qry_c_agent);
				        
				       ?>
				        <label for="">Agent One</label>
				        <input type="text" name="Agent_1_TL" value="<?php echo $row['Agent_1_TL']; ?>"  placeholder="Agent_1_TL" class="form-control" readonly/>
				        
					    <!--<input type="text" value="<?php  echo $username;?>" id="" name="" class="form-control" placeholder="" disabled/>-->
         <!--               <input type="hidden" value="<?php  echo $username;?>" id="Agent_1" name="Agent_1" class="form-control" placeholder="" required/>-->
         
                         <select class="form-control Agent_Name_Change" id="Agent_1" name="Agent_1">

                    <?php
                    
                    echo '<option value="">Select Agent</option>';
                             foreach($fetch_agent_list as $fetch_agent){
                                 if($fetch_agent['username'] == $row['Agent_1']){
                                      echo '<option selected data-tl="'.$fetch_agent['Team_Leader'].'" value="'.$fetch_agent['username'].'">'.$fetch_agent['username'].'</option>';
                                      continue;
                                 }
                                   echo '<option data-tl="'.$fetch_agent['Team_Leader'].'" value="'.$fetch_agent['username'].'">'.$fetch_agent['username'].'</option>';
                              }
                            ?>

          </select>
                        
					   <input type="text" placeholder="%" value="<?php echo $row['Agent_1_Percentange']; ?>" id="Agent_1_Percentange" name="Agent_1_Percentange" class="form-control" style="width: 50px;float: left;" required>

			  <input type="text" name="Agent_1_Shared_Amount" id="Agent_1_Shared_Amount" value="<?php echo $row['Agent_1_Shared_Amount']; ?>" placeholder="Shared Amount" class="form-control" style="width: 130px;float: left;" required readonly>
				  </div>
				  
				   <div class="col-sm-3">
				        
				   <label for="">Agent Two</label>
				   <input type="text" name="Agent_2_TL" value="<?php echo $row['Agent_2_TL']; ?>"  placeholder="Agent_2_TL" class="form-control" readonly/>
					  <select class="form-control Agent_Name_Change" id="Agent_2" name="Agent_2">

                    <?php
                    
                    echo '<option value="">Select Agent</option>';
                             foreach($fetch_agent_list as $fetch_agent){
                                 if($fetch_agent['username'] == $row['Agent_2']){
                                      echo '<option selected data-tl="'.$fetch_agent['Team_Leader'].'" value="'.$fetch_agent['username'].'">'.$fetch_agent['username'].'</option>';
                                      continue;
                                 }
                                   echo '<option data-tl="'.$fetch_agent['Team_Leader'].'" value="'.$fetch_agent['username'].'">'.$fetch_agent['username'].'</option>';
                              }
                            ?>

          </select>
					   <input type="text" placeholder="%" value="<?php echo $row['Agent_2_Percentange']; ?>" name="Agent_2_Percentange" id="Agent_2_Percentange" class="form-control" style="width: 50px;float: left;" >

			  <input type="text" value="<?php echo $row['Agent_2_Shared_Amount']; ?>" placeholder="Shared Amount" name="Agent_2_Shared_Amount" id="Agent_2_Shared_Amount" class="form-control" style="width: 130px;float: left;" readonly>
				  </div>
				  
				   <div class="col-sm-3">
				   
				   <label for="">Agent Three</label>
				    <input type="text" name="Agent_3_TL" value="<?php echo $row['Agent_3_TL']; ?>"  placeholder="Agent_3_TL" class="form-control" readonly/>
					  <select class="form-control Agent_Name_Change" id="Agent_3" name="Agent_3">

          <?php
                    
                    echo '<option value="">Select Agent</option>';
                             foreach($fetch_agent_list as $fetch_agent){
                                 if($fetch_agent['username'] == $row['Agent_3']){
                                      echo '<option selected data-tl="'.$fetch_agent['Team_Leader'].'" value="'.$fetch_agent['username'].'">'.$fetch_agent['username'].'</option>';
                                      continue;
                                 }
                                   echo '<option data-tl="'.$fetch_agent['Team_Leader'].'" value="'.$fetch_agent['username'].'">'.$fetch_agent['username'].'</option>';
                              }
                            ?>

          </select>
					   <input type="text" placeholder="%" value="<?php echo $row['Agent_3_Percentange']; ?>" name="Agent_3_Percentange" id="Agent_3_Percentange" class="form-control" style="width: 50px;float: left;" >

			  <input type="text" value="<?php echo $row['Agent_3_Shared_Amount']; ?>" name="Agent_3_Shared_Amount" id="Agent_3_Shared_Amount" placeholder="Shared Amount" class="form-control" style="width: 130px;float: left;" readonly >
				  </div>
		
		
		<?php
		echo('<div class="col-sm-3"><label>&nbsp;</label><input type="submit"  value="UPDATE" class="btn btn-primary btn-block"/></div>');
		
		
		
		echo('</div>');
		

    
	
		
		
		
   // }
 
    echo( '</form>' );
    
    ?>
   
  </div>
</div>

<script>

$( "#SaleDate" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#altSaleDate',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd'
});


    $('.Agent_Name_Change').change((e)=>{
        var agent_name = $(e.target).find(':selected').attr('data-tl');
        $(e.target).closest('div').find('input').filter(':first').val(agent_name);
    })
    $(".Agent_Name_Change").each((i,e)=>{
        console.log(e);
        var agent_name = $(e).find(':selected').attr('data-tl');
        $(e).closest('div').find('input').filter(':first').val(agent_name);
    })



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

$('#PaymentMode').change(function(){

  $('#Gateway_Amounts_readonly, #Gateway_Amounts').val('');

    if($('#PaymentMode').val() == 'HDFC Bank' || $('#PaymentMode').val() == 'ICICI Bank' || $('#PaymentMode').val() == 'Axis Bank'){ 
        var TotalReceivedAmount = $('#TotalReceivedAmount').val();
        var Company_Amount =  Math.round(TotalReceivedAmount/1.18); 
      var TAX_AmountGiven =  TotalReceivedAmount-Company_Amount; 
      var AmountCompanyReceived =  TotalReceivedAmount - TAX_AmountGiven;
      
      $('#Company_Amounts').val(AmountCompanyReceived);
      $("#Tax_Amount").val(TAX_AmountGiven);
      
    }
    else{

      var TotalReceivedAmount = $('#TotalReceivedAmount').val();
        var three_percent =  TotalReceivedAmount/100*3; // updated to 3 percent from 1.95
        var eighteen_percent_of_three_percent =  three_percent/100*18; 
        var Gateway_Amount =  three_percent+eighteen_percent_of_three_percent;  
        var Remaining_Amount = TotalReceivedAmount - Gateway_Amount;
        var Gst_Amount = Remaining_Amount/100*18;
        var Company_Amount =  Math.round(Remaining_Amount - Gst_Amount);  

        var TAX_AmountGiven =  Math.round(Gst_Amount); 
        var AmountCompanyReceived = Company_Amount;

      $('#Company_Amounts').val(AmountCompanyReceived);
      $("#Tax_Amount").val(TAX_AmountGiven);
      $('#Gateway_Amounts, #Gateway_Amounts_readonly').val(Gateway_Amount,2);

    }
    
    ChangePercentage();
})

// $('#PaymentMode').change(function(){
//     if($(this).val() == 'HDFC Bank' || $(this).val() == 'ICICI Bank' || $(this).val() == 'Axis Bank'){ 
//         var TotalReceivedAmount = $('#TotalReceivedAmount').val();
//   	    var Company_Amount =  Math.round(TotalReceivedAmount/1.18); 
// 	    var TAX_AmountGiven =  TotalReceivedAmount-Company_Amount; 
// 	    var AmountCompanyReceived =  TotalReceivedAmount - TAX_AmountGiven;
	    
// 	    $('#Company_Amounts').val(AmountCompanyReceived);
// 	    $("#Tax_Amount").val(TAX_AmountGiven);
	    
//     }
//     else{
//         var TotalReceivedAmount = $('#TotalReceivedAmount').val();
//         var Three_Percent =  Math.round(TotalReceivedAmount/100*3); 
//         var Company_Amount =  Math.round((TotalReceivedAmount-Three_Percent)/(1.18));  
// 	    var TAX_AmountGiven =  TotalReceivedAmount-Company_Amount; 
// 	    var AmountCompanyReceived =  TotalReceivedAmount - TAX_AmountGiven;
	    
// 	    $('#Company_Amounts').val(AmountCompanyReceived);
// 	    $("#Tax_Amount").val(TAX_AmountGiven);
//     }
    
//     ChangePercentage();
// })

function ChangePercentage(){
    
    var company_am =  parseInt($("#Company_Amounts").val());
    var per1 = parseInt($("#Agent_1_Percentange").val())?parseInt($("#Agent_1_Percentange").val()):0;
    var per =  company_am*(per1/100);
    $("#Agent_1_Shared_Amount").val(per);
    
    var per2 = parseInt($("#Agent_2_Percentange").val())?parseInt($("#Agent_2_Percentange").val()):0;
    var per =  company_am*(per2/100);
    $("#Agent_2_Shared_Amount").val(per);
    
    var per3 = parseInt($("#Agent_3_Percentange").val())?parseInt($("#Agent_3_Percentange").val()):0;
    var per =  company_am*(per3/100);
    $("#Agent_3_Shared_Amount").val(per);
   
}

</script>
<?php include('partial/footer.php') ?>