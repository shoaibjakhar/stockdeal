<?php  include('partial/session_start.php'); ?>
<?php

//session_start();

 //$username = $username;

 //echo $username;

//include('partial/validate-user.php');

?>

<?php

if($_POST['ajax']){
    $username = $_POST['username'];
    if($username != 'Compliance officer'){
        $sql = "SELECT Team_Leader FROM `employee` WHERE username = '$username'";
        $result = mysqli_query($connect,$sql);
        $result = mysqli_fetch_assoc($result);
        if($result['Team_Leader']){
            echo $result['Team_Leader'];
        }
        else{
            echo $username;
        }
    }
    else{
        echo $username;
    }
    
die;
}

if(isset($_GET['UserName']) && isset($_GET['Source']) && isset($_GET['Disposition'])){
 $UserName = $_GET['UserName'];

 $Source = $_GET['Source'];

 $Disposition = $_GET['Disposition'];
}

 ?>

<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Agent Request</title>

<?php require('partial/plugins.php'); ?>

<script type="text/javascript">
/*
function showUser()

{

var Mobile_No = document.getElementById("Mobile_No").value

//var Costumer_ID = document.getElementById("Costumer_ID").value

if (window.XMLHttpRequest)

  {// code for IE7+, Firefox, Chrome, Opera, Safari

  aa=new XMLHttpRequest();

  }

aa.onreadystatechange=function()

  {

  if (aa.readyState==4 && aa.status==200)

    {

    document.getElementById("txtHint").innerHTML=aa.responseText;

    }

  }

aa.open("GET","free-trail-results.php?Mobile_No="+Mobile_No,true);

aa.send();

}
*/
</script>

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

   <a href="memberpage.php">Dashbord</a> | <a href="agent-request-received.php" class="">Received</a> | <a href="agent-request-sent.php" class="btn btn-xs btn-primary">Sent</a> 

 </div>

 <div class="pull-right"><a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> New Request</a></div>

 <div class="clearfix"></div>

</div>

<div class="containter" style="padding:20px 20px 0 20px;">

<?php

//include('connection/dbconnection_crm.php');

$sql = ("SELECT Id,  DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DateTimeConvert, Agent, ToWhom, Team_Leader_Name, Subject, Priority, Message, Respond, Status, Customer_Name, Mobile, Paid_Amount, Package, Duration,  Risk_Profile_Score, KYC, Mode_of_Payment FROM Agent_request where  Agent = '".$username."'  ORDER BY  `Id` DESC");

	//echo($sql);

//Agent = '".$UserNameSession."'

//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");

/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin

FROM fut_hni");*/

$result = mysqli_query($connect,$sql);

echo('<table id="Agent_request" class="display" cellspacing="0" width="100%">');

echo('<thead>');

 echo('<tr>');



  echo('<th>Date</th>');

	echo('<th>To</th>');
		echo('<th>Team Laeder</th>');

  echo('<th>Subject</th>');

  //echo('<th>Customer_Name</th>');

  //echo('<th>Mobile</th>');

  //echo('<th>Paid_Amount</th>');

  //echo('<th>AmountPaidDate</th>');

  //echo('<th>Package</th>');

  //echo('<th>Duration</th>');

  //echo('<th>Risk_Profile_Score</th>');

  //echo('<th>KYC</th>');

  //echo('<th>Mode of Payment</th>');

	

  echo('<th style="width:250px;">Message</th>');

  echo('<th>Respond</th>');

  //echo('<th>Update</th>');

 echo('</tr>');

echo('</thead>');

echo('<tbody>');

while($row = mysqli_fetch_array($result))

{

echo('<tr>');



  echo('<td>'.$row['DateTimeConvert'].'</td>');

  echo('<td><a href="#_" class="btn btn-xs '.$row['Status'].'">'.$row['Status'].'</a>&nbsp;&nbsp;'.$row['ToWhom'].'</td>');
    echo('<td><a href="#_" class="btn btn-xs '.$row['Status'].'">'.$row['Status'].'</a>&nbsp;&nbsp;'.$row['Team_Leader_Name'].'</td>');

  echo('<td>'.$row['Subject'].'</td>');

 // echo('<td>'.$row['Customer_Name'].'</td>');

  //echo('<td>'.$row['Mobile'].'</td>');

  //echo('<td>'.$row['Paid_Amount'].'</td>');

  //echo('<td>'.date( 'd-m-Y', strtotime($row['AmountPaidDate'])).'</td>');

  //echo('<td>'.$row['Package'].'</td>');

  //echo('<td>'.$row['Duration'].'</td>');

  //echo('<td>'.$row['Risk_Profile_Score'].'</td>');

  //echo('<td>'.$row['KYC'].'</td>');

	//echo('<td>'.$row['Mode_of_Payment'].'</td>');

  echo('<td style="width:400px;">'.$row['Message'].'</td>');

  echo('<td>'.$row['Respond'].'</td>');

  

  //echo('<td><input type="hidden" value="'.$row['Id'].'" class="Id"/> <a href="#_" class="UpdateBtn btn RSI-Primary">Update</a></td>');

}

echo('</tr>');

echo('</tbody>');

echo('</table>');

?>

</div>

<div class="modal fade" id="AddFreeTrail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

		<form action="agent-request-back.php?v=<?php echo time(); ?>" method="POST" autocomplete="off">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="AddFreeTrailLabel">Send request to manager</h4>

      </div>

      <div class="modal-body">

	   <input type="hidden" name="DateTime"  value="<?php echo date("Y-m-d h:i:s") ?>"/>

       <input type="hidden" name="Agent"     value="<?php  echo $username;?>"/>

			<div class="row">

			 <div class="col-sm-4">

				  <div class="form-group">

    <label for="ToWhom">Agent Name:</label>

    <select class="form-control" name="ToWhom" id = "agent_name" required>
        <option value="">Select Agent Or Team Leader</option>
        <optgroup label="Compliance Officer">
            <option value="Compliance officer">Compliance Officer</option>
        </optgroup>

          <?php //include('partial/agents.php') ?>
          <?php
            $sel_tl = "SELECT username FROM admin WHERE Role = 'Team Leader' AND Status = 'Active'";
            $qry_tl = mysqli_query($connect,$sel_tl);
            echo '<optgroup label="Team Leader">';
            while($fetch_tl = mysqli_fetch_assoc($qry_tl)){
                echo '<option value="'.$fetch_tl['username'].'">'.$fetch_tl['username'].'</option>';
            }
            echo '</optgroup>';
            $sel_agent = "SELECT username FROM employee WHERE Status = 'Active' ORDER BY username ASC";
            $qry_agent = mysqli_query($connect,$sel_agent);
            echo '<optgroup label="Agent">';
            while($fetch_agent = mysqli_fetch_assoc($qry_agent)){
                echo '<option value="'.$fetch_agent['username'].'">'.$fetch_agent['username'].'</option>';
            }
            echo '</optgroup>';
          ?>
          

          </select>

  </div>

				</div>

 <div class="col-sm-4">

  <div class="form-group">

    <label for="Team_Leader_Name">Team Leader Name:</label>

    <input type="text" value="" name="Team_Leader_Name" id = "team_leader" class="form-control" readonly/>

  </div>

  </div>
  
   <div class="col-sm-4">

  <div class="form-group">

    <label for="Request_Type">Priority:</label>

    <select name="Request_Type" id="Request_Type" class="form-control" required>

       	<option value="Low" selected>Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
       	<!-- <option value="Sales Log">Sales Log</option> -->

       </select>

  </div>

  </div>

				<div class="col-sm-12">

				 <label for="Subject">Subject:</label>

					<input type="text" value="" name="Subject" class="form-control" placeholder="Subject" style="margin-bottom:20px;" required/>

				</div>

				</div>

			<div class="row Sales_Log_wrap" style="display: none;">

			  <div class="col-sm-4">

  <div class="form-group">

    <label for="Customer_Name">Customer Name:</label>

   <input type="text" value="" name="Customer_Name" class="form-control Sales_Log_Input"  placeholder="Customer Name" />

  </div>

  </div>

				<div class="col-sm-4">

  <div class="form-group">

    <label for="Mobile">Mobile:</label>

   <input type="text" value="" name="Mobile" class="form-control Sales_Log_Input" placeholder="Mobile" />

  </div>

  </div>

				<div class="col-sm-4">

  <div class="form-group">

    <label for="Paid_Amount">Paid Amount:</label>

   <input type="text" value="" name="Paid_Amount" class="form-control Sales_Log_Input" placeholder="Paid Amount" />

  </div>

  </div>

					<div class="col-sm-4">

  <div class="form-group">

   <label for="AmountPaidDate">Amount Paid Date:</label>

   <input type="text" value="" id="AmountPaidDateINR" class="form-control Sales_Log_Input" placeholder="Paid Date"/>

   <input type="hidden" value="" id="AmountPaidDate" name="AmountPaidDate" class="form-control Sales_Log_Input" placeholder="Paid Date"/>

  </div>

  </div>

				<div class="col-sm-4">

  <div class="form-group">

    <label for="Package">Package:</label>

   <select name="Package" class="form-control Sales_Log_Input">

       <option value="">Select</option>
			<?php
			$get_risk_qry = "SELECT Segment FROM `Options` where Segment IS NOT NULL";
			$getd_qry = mysqli_query($connect, $get_risk_qry );
			while ( $get_options = mysqli_fetch_assoc( $getd_qry ) ) {
				?>
			<option value="<?php echo $get_options['Segment']; ?>">
				<?php echo $get_options['Segment'] ?>
			</option>
			<?php
			//	echo '<option value="'.$get_options['Package'].'">.$get_options["Package"].</option> ';
			}
			?>

   </select>

  </div>

  </div>

		<div class="col-sm-4">

  <div class="form-group">

    <label for="Duration">Duration:</label>

   <input type="text" value="" name="Duration" class="form-control Sales_Log_Input" placeholder="Duration" />

  </div>

  </div>	

				<div class="col-sm-4">

  <div class="form-group">

    <label for="Riks Profile">Risk_Profile_Score:</label>

      <input type="text" value="" name="Risk_Profile_Score" class="form-control Sales_Log_Input" placeholder="Risk Profile Score" />

  </div>

  </div>	

					<div class="col-sm-4">

  <div class="form-group">

    <label for="KYC">KYC:</label>

   <select name="KYC" id="KYC" class="form-control Sales_Log_Input">

       	<option value="" selected>Select</option>

       	<option value="Yes">Yes</option>

       </select>

  </div>

  </div>

				<div class="col-sm-4">

  <div class="form-group">

    <label for="Mode of Payment">Mode of Payment:</label>

	   <select name="Mode_of_Payment" id="Mode_of_Payment" class="form-control Sales_Log_Input">
			<option value="">Select</option>
			<?php
			$get_risk_qry = "SELECT payment_mode FROM `Options` where payment_mode IS NOT NULL";
			$getd_qry = mysqli_query($connect, $get_risk_qry );
			while ( $get_options = mysqli_fetch_assoc( $getd_qry ) ) {
				?>
			<option value="<?php echo $get_options['payment_mode']; ?>">
				<?php echo $get_options['payment_mode'] ?>
			</option>
			<?php
			//	echo '<option value="'.$get_options['Package'].'">.$get_options["Package"].</option> ';
			}
			?>
		</select>

  </div>

  </div>
  	<div class="col-sm-4">

  <div class="form-group">

    <label for="I Agreed Status Approved ">I Agreed Status Approved:</label>

   <select name="" id="" class="form-control Sales_Log_Input">

       	<option value="" selected>Select</option>

       	<option value="Yes">Yes</option>

       </select>

  </div>

  </div>

			</div>

			<div class="row">

			 <div class="col-sm-12">

				 <textarea rows="4" name="Message" class="form-control" placeholder="Message" required></textarea>

				</div>

			</div>

<!-- -->

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary" id="">Send</button>

      </div>

		  </form> 

    </div>

  </div>

</div>

<script type="text/javascript">

$(document).ready(function(){

	$( "#AmountPaidDateINR" ).datepicker({

	dateFormat: 'dd-mm-yy', 

    altField  : '#AmountPaidDate',

    altFormat : 'yy-mm-dd',

    format    : 'yy-mm-dd'

});

	$("#Request_Type").change(function(){

        var Request_Type = $(this).children("option:selected").val();

        if(Request_Type == 'Normal') {

			$('.Sales_Log_wrap').hide();

			 $('.Sales_Log_Input').prop('required',false); 

		}

		else if (Request_Type == 'Sales Log'){

			$('.Sales_Log_wrap').show();

				 $('.Sales_Log_Input').prop('required',true); 

			}

    });

});

$(document).on("change","#agent_name",function(){
    username = $(this).val();
    if(username != ''){
         $.ajax({
                type : 'POST',
                url  : 'agent-request-sent.php',
                data : {ajax:true,username : username},
              //  dataType: 'json',
                success : function(data){
                    $("#team_leader").val(data)
                }
    })
    }else{
        $("#team_leader").val('') 
    }
   
})

</script>

<?php include('partial/footer.php') ?>