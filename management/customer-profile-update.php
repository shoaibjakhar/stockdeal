<?php  include('partial/session_start.php'); ?>
<?php
/*$UserName = $_GET['UserName'];
$Source = $_GET['Source'];
$Disposition = $_GET['Disposition'];*/
$Costumer_ID = $_GET[ 'Costumer_ID' ];

$sel_sho_hide = "SELECT Show_Hide FROM Options WHERE Show_Hide IS NOT NULL LIMIT 1";
$qry_show_hide = mysqli_query($connect,$sel_sho_hide);
$fetch_show_hide = $qry_show_hide->fetch_assoc();
$show_hide = (array)json_decode($fetch_show_hide['Show_Hide']);

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
    $sql = "SELECT * FROM  `Customer_profile` WHERE  `Costumer_ID` = '" . $Costumer_ID . "' ";
    /*$sql = ("SELECT Costumer_ID, FirstName, LastName, Email_ID, Mobile_No, Location, PackageName, DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , Remark, Paid_Amout, Balance_amount, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DateTime FROM Customer_profile");*/
    //$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");
    /*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
    FROM fut_hni");*/
    $result = mysqli_query($connect, $sql );
    
    echo( '<form  action="customer-profile-update-back.php" method="POST">' );
   // while ( $row = mysql_fetch_array( $result ) ) {
		$row = $result->fetch_assoc();
		$exp_date = $row['Exp_Date'];
		
		echo('<div class="row">');
		echo '<input type="hidden" name="Costumer_ID" value="'.$Costumer_ID.'" />';
		
		if($show_hide['Date_of_Birth']){
		    echo('<div class="col-sm-3"><label>Date_Of_Birth</label><input type="date" name="Date_of_Birth" value="' . date('Y-m-d',strtotime($row[ 'Date_of_Birth' ])) . '" class="form-control"/></div>');
		}
		if($show_hide['KYC']){
    		$sel_kyc = "SELECT KYC FROM Options WHERE KYC IS NOT NULL";
    		$qry_kyc = mysqli_query($connect,$sel_kyc);
    		echo ('<div class="col-sm-3"><label>KYC</label><select name="KYC" required class="form-control">');
    		
    		while($Kyc_details = $qry_kyc->fetch_assoc()){
    		    if($Kyc_details['KYC'] == $row['KYC']){
    		        echo '<option selected value="'.$Kyc_details['KYC'].'">'.$Kyc_details['KYC'].'</option>';
    		        continue;
    		    }
    		    echo '<option value="'.$Kyc_details['KYC'].'">'.$Kyc_details['KYC'].'</option>';
    		}
    		
    		echo ('</select></div>');
		}
		
		if($show_hide['PanNumber']){
		    echo('<div class="col-sm-3"><label>Pan_Number</label><input type="text" name="Pan_Number" value="' .strtoupper($row['Pan_Number']) . '" class="form-control"/></div>');
		}
		if($show_hide['Risk_Score']){
		    echo('<div class="col-sm-3"><label>Risk_Score</label><input type="text" name="Risk_Score" value="' . ucfirst($row[ 'Risk_Score' ]) . '" class="form-control"/></div>');
		}
		echo('<div class="col-sm-3"><label>Mobile No</label><input type="text" name="Mobile_No" value="' . $row[ 'Mobile_No' ] . '" class="form-control"/></div>');
		echo('<div class="col-sm-3"><label>Full_Name</label><input type="text" name="Full_Name" value="' . ucfirst($row[ 'Full_Name' ]) . '" class="form-control"/></div>');
		
		echo('<div class="col-sm-3"><label>Email ID</label><input type="text" name="Email_ID" value="' . strtolower($row[ 'Email_ID' ]) . '" class="form-control"/></div>');
		
	
	
		echo('<div class="col-sm-3"><label>Package Name*</label>');
		
// 		$datas_segments='';
// 			$datas_segments.='<select name="PackageName" id="PackageName" class="form-control">';
// 							  $get_risk_qry = "select Segment from Options where Segment !='' and Segment_Status = 'Active'";
// 							$getd_qry = mysqli_query($connect,$get_risk_qry);
// 					while($get_segments = mysql_fetch_assoc($getd_qry)){
// 						$datas_segments.='<option value="'.$get_segments['Segment'].'" ';
// 						if($get_segments['Segment'] ===$row['PackageName']){
// 							$datas_segments.='selected';
// 						}
// 						$datas_segments.='>'.$get_segments['Segment'].'</option>';
// 					}
// 							$datas_segments.='</select>';
// 					echo $datas_segments;
            echo '<select class="form-control" id="PackageName" onchange="FetchSegment(this);CalculateDays();" name="PackageName" required>';
            $sel_segment = "SELECT Segment, Segment_Amount FROM Options WHERE Segment IS NOT NULL";
                $qry_segment = mysqli_query($connect,$sel_segment);
                while($fetch_segment = $qry_segment->fetch_assoc()){
                    if($row['PackageName'] == $fetch_segment['Segment']){
                        echo '<option selected data-amount="'.$fetch_segment['Segment_Amount'].'" value="'.$fetch_segment['Segment'].'">'.$fetch_segment['Segment'].'</option>';
                        continue;
                    }
                     echo '<option data-amount="'.$fetch_segment['Segment_Amount'].'" value="'.$fetch_segment['Segment'].'">'.$fetch_segment['Segment'].'</option>';
                    
                }
            echo '</select>';
		
		echo('</div>');
		
		?>
		<div class="col-sm-3">
			<label>Package Price</label>
			<input type="text" readonly class="form-control" value="" id="PackagePrice" name="PackagePrice" />
		</div>
		<div class="col-sm-3">
			<label for="">Sale Date*</label>
			<input type="text" value="<?php echo date('d-m-Y',strtotime($row['SaleDate'])); ?>" id="SaleDate" name="SaleDate"  class="form-control" placeholder="Sale Date"  autocomplete="off" required/>
            <input type="hidden" value="<?php echo date('Y-m-d',strtotime($row['SaleDate'])); ?>" id="altSaleDate" name="altSaleDate" class="form-control" placeholder="alt Sale Date"/>
	    </div>
	     <div class="col-sm-3">
			<label for="">Activation Date</label>
			<input type="text"  value="<?php echo date('d-m-Y',strtotime($row['Activation_Date'])) ?>" id="Activation_Date"  onchange="CalculateDays()" name="Activation_Date" class="form-control" placeholder="Activation Date"  autocomplete="off" required/>
            <input type="hidden" value="<?php echo date('Y-m-d',strtotime($row['Activation_Date'])) ?>" id="altActivation_Date" name="altActivation_Date" class="form-control" placeholder="Activation Date"/>
		</div>
		<div class="col-sm-3">
			<label for="">Expired Date</label>
			<input type="text" value="<?php echo date('d-m-Y',strtotime($row['Exp_Date'])) ?>" id="Exp_Date" name="Exp_Date" onchange="CalculateDays();$('#result_exp_date_error').text('')"  class="form-control" placeholder="Expired Date"  autocomplete="off" required/>
            <small id="result_exp_date_error" class="text-danger"></small>
            <input type="hidden" value="<?php echo date('Y-m-d',strtotime($row['Exp_Date'])) ?>" id="altExp_Date" name="altExp_Date" class="form-control" placeholder="Expired Date"/>
        </div>
        <div class="col-sm-3">
			<label for="">Number of days*</label>
				<input type="text" value="" id="Number_of_Days" readonly name="Number_of_Days" class="form-control inherit" placeholder="Number of days" required/>
		</div>
	    <!--<div class="col-sm-3">
			<label for="">Payment Mode*</label>
			<select class="form-control" id="PaymentMode" name="PaymentMode" required>
            <?php
            /*
                $sql_payment_mode = ("SELECT payment_mode FROM `Options` WHERE payment_mode IS NOT NULL");
                // echo('<option value="" >Payment Mode</option>');
                $result_payment_mode = mysqli_query($connect,$sql_payment_mode);
                while($row_payment_mode = mysql_fetch_array($result_payment_mode))
                {
                        if($row_payment_mode['payment_mode'] == $row['PaymentMode']){
                            echo('<option value="'.$row_payment_mode['payment_mode'].'" selected>'.$row_payment_mode['payment_mode'].'</option>');
                            continue;
                        }
                  echo('<option value="'.$row_payment_mode['payment_mode'].'">'.$row_payment_mode['payment_mode'].'</option>');
                }
                */
            
            ?>
            </select>
             <small id="result_payment_method" class="text-danger"></small>
		</div>-->
		<div class="col-sm-3" style="display:none">
			<label for="">Discount</label>
				<input type="text" value="" id="Discount" readonly name="" class="form-control inherit" placeholder="Discount" required/>
		</div>
		
		<div class="col-sm-3">
			<label for="">Remark</label>
			<input type="text" value="<?php echo $row['Remark']; ?>" id="Remark" name="Remark" class="form-control inherit" placeholder="Remark" required/>
	    </div>
		<div class="col-sm-3">
		    <label for="">PPE Credits</label>
			<input type="text" value="<?php echo $row['PPI_Credits']; ?>" class="form-control" name="PPI_Credits" placeholder="PPE Credit">
		</div>
		
		
		<?php
		echo('<div class="col-sm-3"><label>&nbsp;</label><input type="submit" value="UPDATE" class="btn btn-primary btn-block"/></div>');
		
		
		
		echo('</div>');
		

    
	
		
		
		
   // }
 
    echo( '</form>' );
   // echo $row['Exp_Date'];
   //echo date('d-m-Y',strtotime($row['Exp_Date']));
    ?>
   
  </div>
</div>
<?php
 $sel_amount_paid = "SELECT SUM(Paid_Amout) as Amount FROM `Customer_Payment_History` where Costumer_ID = '".$row['Costumer_ID']."'";
$qry_amount_paid = mysqli_query($connect,$sel_amount_paid);
$fetch_amount_paid = $qry_amount_paid->fetch_assoc();

?>
<script>




	$( "#Activation_Date" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#altActivation_Date',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd'
});
//$( "#Activation_Date" ).datepicker('disable');

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
   // minDate:new Date('<?php echo date('Y/m/d',strtotime($exp_date)) ?>')
});



$( "#Date_of_Birth" ).datepicker( {
			changeMonth: true,
			changeYear: true,
			yearRange: '1930:2010',
			dateFormat: 'mm-dd-yy',
			altField: '#altDate_of_Birth',
			altFormat: 'yy-mm-dd',
			format: 'yy-mm-dd'
		} );


$(document).ready(function(){
$('#PackageName').change(function(){	
	$('.PackageName').val($(this).val())
	$('.PackageName').text($(this).val()) 
});
$('#Agent').change(function(){	
	$('.Agent').val($(this).val()) 
	$('.Agent').text($(this).val()) 
});
$('#Manager').change(function(){	
	$('.Manager').val($(this).val())
	$('.Manager').text($(this).val()) 
});
$('#payment_mode').change(function(){	
	$('.payment_mode').val($(this).val())
	$('.payment_mode').text($(this).val())
});	

FetchSegment();
CalculateDays();
})

function CalculateDiscount(Estimated = null){
    var total_paid = "<?php echo $fetch_amount_paid['Amount']; ?>";
    var total_discount = Estimated - total_paid;
    var total_discount_percentage = ((total_discount/Estimated)*100).toFixed(0);
    console.log(Estimated);
    $("#Discount").val(total_discount + " "+total_discount_percentage+"%")
}

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
    
    
    var TimeDifference = parseInt((Exp_Date_UnixTime - Activation_Date_UnixTime)/86400);
    
    if(TimeDifference){
        $("#Number_of_Days").val(TimeDifference);
    }
    else{
        $("#Number_of_Days").val(0);
    }
    
   
    
   // TimeDifference = ((Exp_Date_UnixTime - Activation_Date_UnixTime)/60/60/24);
    
  var PackagePrice = $("#PackagePrice").val();
  var Estimated = parseInt((PackagePrice/30)*TimeDifference);
  
//   $("#TotalReceivedAmount").val('');
//   $("#TotalReceivedAmount").attr('placeholder','Estimated Amount '+Estimated);
//   $("#TotalReceivedAmount").attr('data-max-amount',Estimated);
  CalculateDiscount(Estimated);
  
   
}
</script>
<?php include('partial/footer.php') ?>