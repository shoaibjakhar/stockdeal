<?php  include('partial/session_start.php'); ?>
<?php
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];

 $Full_Name = $_GET['Full_Name'];
 $Mobile = $_GET['Mobile'];
 $FollowUpId = $_GET['FollowUpId'];
//echo( $FollowUpId.$UserName );
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Leads</title>
<?php require('partial/plugins.php'); ?>
<style>
 .follow-up-notif-wrap{display:none;}
</style>
</head>
<body>
<?php include('partial/sidebar.php') ?>
<div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>
    <?php 
      if(isset($_GET['update_count']))
      {
        $Id_Notification = $_GET['FollowUpId'];
        $update_count = (1 + $_GET['update_count']);
        // echo $Id_Notification;
        // echo $update_count;
        // die('here');
         $sql ="UPDATE  `FolllowUpLeads` SET  `update_count` =  '".$update_count."' WHERE  `FolllowUpLeads`.`Id` ='".$Id_Notification."'";
         mysqli_query($connect, $sql) or die('Error updating database');
      }
      
    ?>

  </header>
  <div class="breadcurms"> 
  <!-- <a href="view-leads.php">View Leads</a> | <a href="lead-details.php" >Lead details</a> | <a href="lead-details-filter2-new.php">Filter 1</a>-->
  <a href="memberpage.php">Follow Up Leads</a> | <a href="follow-up-leads-filter-2.php" >Filter 2</a> | <a href="fresh-leads.php" class="">Fresh Leads</a> | <a href="lead-details-filter2-new.php">Filter 1</a>  | <a href="leads-view.php">Add New Leads</a>
  </div>

  <div class="containter" style="padding:20px 20px 0 20px;">
    <?php //include('connection/dbconnection_crm.php')?>
    <?php
$sql = ("SELECT Full_Name, UserName, Email, Mobile, State, Source, Disposition , Id, Segment, DATE_FORMAT( DateTime,  '%d/%m/%Y %H:%i %p' ) AS DATEandTime FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Mobile = '".$Mobile."') && (Full_Name = '".$Full_Name."')");
$result = mysqli_query($connect,$sql);
//echo('<table id="veiw_Leadstest" class="display" cellspacing="0" width="100%">');
echo('<table id="" class="table" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Full Name</th>');
  echo('<th>Email</th>');
  echo('<th>Mobile</th>');
  echo('<th>State</th>');
  echo('<th>Agent</th>');
  //echo('<th>Source</th>');
  echo('<th>Disposition</th>');
  echo('<th>Segment</th>');
  echo('<th>DateTime</th>');
  echo('<th>Update</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
 echo('<td id="Full_Name">'.$row['Full_Name'].'</td>');
 echo('<td id="Email">'.$row['Email'].'</td>');
 echo('<td id="Mobile"> <input type="hidden" id="ActiveCustmerMobile" value="' . $row[ 'Mobile' ] . '" /> <span id="bar">'.$row['Mobile'].'</span> <a  class="btn btn-primary btn-xs" data-clipboard-action="copy" data-clipboard-target="#bar"> Copy</a></td>');
 echo('<td id="State">'.$row['State'].'</td>');
	 echo('<td>'.$row['UserName'].'</td>');
 //echo('<td id="Source">'.$row['Source'].'</td>');
 echo('<td id="Disposition">'.$row['Disposition'].'</td>');
 echo('<td id="Segment">'.$row['Segment'].'</td>');
 echo('<td>'.$row['DATEandTime'].'</td>');
 echo('<td>'.'<a href="#" class="btn btn-primary update" id="'.$row['Id'].'" data-toggle="modal" data-target="#myModal_1">'.'Update'.'</a>'.'</td>');
}
 echo('</tr>');
	echo( '<tr class="NCT-tr" style="display:none;">' );
			echo( '<td colspan="9" class="text-center"><form method="get" action="follow-up-NCD.php"><input type="hidden"  name="FollowUpId" value="' . $_GET[ 'FollowUpId' ] . '"/><input type="submit" value="NCD" class="btn btn-danger" style="width:120px"/></form></td>' );
			echo( '</tr>' );
echo('</tbody>');
echo('</table>');
?>
  </div>
  <div class="containter" style="padding:20px 20px 0 20px;">
  <div style="padding:5px;" class="brand-color-bg"><strong>Follow Up History</strong></div>
    <?php include('connection/dbconnection_crm.php')?>
    <?php
$sql = ("SELECT DATE_FORMAT( DateTime,  '%d/%m/%Y %h:%i %p' ) AS DATEandTime, Full_Name, Email, Mobile, Disposition, Remark, UserName, DATE_FORMAT( FowllowUpDateTime,  '%d/%m/%Y %h:%i %p' ) AS FollowUpDATEandTime, State from `FolllowUpLeads` where Mobile = '".$Mobile."' ORDER BY  `DATEandTime` DESC  
LIMIT 0 , 30");
$result = mysqli_query($connect,$sql);
//echo('<table id="veiw_Leadstest" class="display" cellspacing="0" width="100%">');
echo('<table id="followUpHistory" class="table" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Date</th>');
  echo('<th>Full Name</th>');
  echo('<th>Email</th>');
  echo('<th>Mobile</th>');
  echo('<th>Disposition</th>');
  echo('<th>Segment</th>');
  echo('<th>Remark</th>');
  echo('<th>Agent Name</th>');
  echo('<th>Fowllow Up Date Time</th>');
  echo('<th>State</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
  echo('<td id="">'.$row['DATEandTime'].'</td>');
  echo('<td id="">'.$row['Full_Name'].'</td>');
  echo('<td id="">'.$row['Email'].'</td>');
  echo('<td id="">'.$row['Mobile'].'</a></td>');
  echo('<td id="">'.$row['Disposition'].'</a></td>');
  echo('<td id="">'.$row['Segment'].'</a></td>');
  echo('<td id="">'.$row['Remark'].'</a></td>');
  echo('<td id="">'.$row['UserName'].'</a></td>');
  echo('<td id="">'.$row['FollowUpDATEandTime'].'</a></td>');
  echo('<td id="">'.$row['State'].'</a></td>');
 echo('</tr>');
}
echo('</tbody>');
echo('</table>');
?>
  </div>
</div>
	
<!-- <script src="js/clipboard.min.js"></script>

    <script>
    var clipboard = new Clipboard('.btn');
    clipboard.on('success', function(e) {
        console.log(e);
    });
    clipboard.on('error', function(e) {
        console.log(e);
    });
    </script>
	-->
<?php include('partial/footer.php') ?>
<form action="disposition-update.php" method="get">
<!-- Modal -->
<div class="modal fade" id="myModal_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Disposition</h4>
      </div>
      <div class="modal-body">
      <div class="alert alert-danger" id="InvalidInvestment_Choose_color" role="alert" style="display:none">
       <p>All fields are mandatory</p>
      </div>
        <table width="100%" class="table" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td>Disposition</td>
              <td><span class="disableNow">Date</span></td>
              <td><span class="disableNow">Hour</span></td>
              <td><span class="disableNow">Minutes</span></td>
            </tr>
            <tr>
              </td>
              <td><select id="Disposition_Modal" name="Disposition_Modal" class="form-control">
                  <?php require('partial/disposition.php'); ?> 
                </select></td>
                <td><input type="text" class="form-control disableNow" id="datepicker" placeholder="Date" autocomplete="off">  
                
                  
                        <input type="hidden" class="form-control" id="FowllowUpDateTime" name="FowllowUpDateTime" placeholder="Date"></td>
                <td>
      <select id="Hour" name="Hour" class="disableNow form-control">
          <?php require('partial/hour.php'); ?> 
        </select></td>
      <td>
      <select id="Minuts" name="Minuts" class="disableNow form-control">
    
       
          <?php require('partial/minutes.php'); ?> 
        </select></td>
      <td style="display:none">
       <select id="Second" name="Second" class="form-control">
          <?php require('partial/seconds.php'); ?> 
        </select></td>
            </tr>
             <tr>
              <td>Remark</td>
              <td></td>
				 <td colspan="2"><span class="disableNow">Priority</span></td>
            </tr>
             <tr>
               <td colspan="2"><textarea id="Modal_remark" name="Modal_remark" class="form-control" ></textarea></td>
              <td colspan="2"> <select id="Priority" name="Priority" class="form-control disableNow">
                   <option value="">Select</option>
                   <option value="High">High</option>
                   <option value="Medium">Medium</option>
				   <option value="Low">Low</option>
				   <option value="No Follow Up">No Follow Up</option>
        </select>
        
        <input type="hidden" id="Disposition_Class" value="" name="Disposition_Class" />
        
        </td>
            </tr>
             <tr style="display:none ;">
             <td colspan="4">
				 <input type="text" class="form-control" id="Modal_Full_Name" name="Modal_Full_Name"/>
				 
				 
			
				  <input type="text" class="form-control" id="Modal_Email" name="Modal_Email"/>
			
				  
				  <input type="text" class="form-control" value="<?php  echo($Mobile); ?>" id="" name="Modal_Mobile"/>
				 
				
				 
				 <input type="text" class="form-control" id="Modal_State" name="Modal_State"/>
				 
				
				 
				 <input type="text" class="form-control" id="Modal_Segment" name="Modal_Segment" style="width:200px;"/>
				 
				
				  
				  <input type="text" class="form-control" id="Id_modal" name="Id_modal"/>
				 
				
				  
				  <input type="text" class="form-control" id="DateTimeModel" name="DateTimeModel" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y-m-d H:i:s");?>"/>
			
				  <input type="text" id="Modal_UserName" name="Modal_UserName" value="<?php  echo $username;?>" class="form-control"/>
				  <input type="text"  name="FollowUpId" id="FollowUpId"  value="<?php  echo $_GET['FollowUpId']; ?>" />
				 </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button"  class="btn btn-primary"  id="SaveChanges">Save changes</button>
		  <input type="submit" value="Save changes" class="btn btn-primary" style="display:none;" id="SaveChangesFinal"/>
      </div>
    </div>
  </div>
</div>
</form>
<?php
    $sel = "select disposition from Options where Disposition_Date_Time = 'No'";
    $qry = mysqli_query($connect,$sel);
    $dispositions = array();
    while($row = mysqli_fetch_assoc($qry)){
        $dispositions[] = $row['disposition'];
    }
?>
<script>
var dispositions = '<?php echo json_encode($dispositions); ?>';
$(document).ready(function(e) {
	  var ActiveCustmerMobile = $( '#ActiveCustmerMobile' ).val();
			if ( ActiveCustmerMobile == '' || ActiveCustmerMobile == null ) {
				//alert( 'Null' );
				$('.NCT-tr').show();
			} else {
				$('.NCT-tr').hide();
				//alert( 'Has value' )
			}     
   $('.update').click(function() {
	var Id = $(this).attr("id");
	$('#Id_modal').val(Id )
	var Full_Name = $(this).parent().parent().find('#Full_Name').text(); //$('#Full_Name').text()
	$('#Modal_Full_Name').val(Full_Name)
	var Email = $(this).parent().parent().find('#Email').text(); //$('#Email').text()
	$('#Modal_Email').val(Email)
	var Mobile = $(this).parent().parent().find('#Mobile span').text(); //$('#Mobile span').text()
	$('#Modal_Mobile').val(Mobile)
	var State = $(this).parent().parent().find('#State').text(); //$('#State').text()
	$('#Modal_State').val(State)
	var Segment = $(this).parent().parent().find('#Segment').text(); //$('#Segment').text()
	$('#Modal_Segment').val(Segment)   
  });
  $( "#datepicker" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#FowllowUpDateTime',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd'
});
  $("#Disposition_Modal").on('change', function() {
	 var disableNow = $(this).val()
	 //if(disableNow == 'NT' || disableNow == 'NI' || disableNow == 'CT' || disableNow == 'LB' || disableNow == 'DND' || disableNow == 'WN' || disableNow == 'DC' || disableNow == 'Sale' ||  disableNow == 'NCD') {
    
	if(dispositions.includes(disableNow)){
		//alert('The option with value ' + $(this).val());
	$('.disableNow').css({'visibility':'hidden'})//.hide()
	 }
	 else {
		 $('.disableNow').css({'visibility':'visible'})
		 }
	var Class = $('option:selected',this).attr('data-class');
	$("#Disposition_Class").val(Class);
	console.log(Class)
});
$('#SaveChanges').click(function(){
	var Disposition_Modal = $('#Disposition_Modal').val();
	var Modal_remark = $('#Modal_remark').val();
	var Priority = $('#Priority').val();
  var datepicker = $('#datepicker').val();
  // var Hour       =  $('#Hour').find(":selected").val();
  // var Minuts     = $('#Minuts').find(":selected").val();
   
   // alert(datepicker);
   // alert(Hour);
   // alert(Minuts);

  if(Disposition_Modal == "FT" || Disposition_Modal == "CBWP" || Disposition_Modal == "PTPO")
  {

     
     if(datepicker =="")
     {
       $('#InvalidInvestment_Choose_color').show();  
     }
     else
     {
        if(Disposition_Modal != ""  && Modal_remark != "") 
         {
          $('#InvalidInvestment_Choose_color').hide();
          $('#SaveChangesFinal').trigger('click');
       }
       else
      {
         $('#InvalidInvestment_Choose_color').show();  
      }
     }
    
  }
  else
  {
    if(Disposition_Modal != ""  && Modal_remark != "") {
      $('#InvalidInvestment_Choose_color').hide();
      $('#SaveChangesFinal').trigger('click');
    }
    else
     {
      $('#InvalidInvestment_Choose_color').show();
       
      }
  }

	 
	});	
});
</script>
</body>
</html>