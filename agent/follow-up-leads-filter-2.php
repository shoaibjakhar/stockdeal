<?php  include('partial/session_start.php'); ?>


<?php
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
<title>View Leads</title>
<?php require('partial/plugins.php'); ?>



</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">

 <!--<a href="view-leads.php">View Leads</a> | <a href="lead-details.php" >Lead details</a> | <a href="lead-details-filter2-new.php"  class="btn btn-xs btn-primary">Filter 1</a> | <a href="leads-view.php">Add New Leads</a> -->
 
 <!--<a href="memberpage.php">Follow Up Leads</a> | <a href="follow-up-leads-filter-2.php"  class="btn btn-xs btn-primary">Filter 2</a> | <a href="fresh-leads.php">Fresh Leads</a> | <a href="lead-details-filter2-new.php">Filter 1</a>  | <a href="leads-view.php">Add New Leads</a>-->
<?php
    if($_SESSION['Role'] == 'Customer Care'){
        ?>
            <a href="follow-up-leads-filter-2.php" class="btn btn-xs btn-primary">Filter 2</a> | <a href="lead-details-filter2-new.php" >Filter 1</a>
        <?php
    }
    else{
 ?>
 <a href="memberpage.php">Follow Up Leads</a> | <a href="follow-up-leads-filter-2.php">Filter 2</a> | <a href="fresh-leads.php">Fresh Leads</a> | <a href="lead-details-filter2-new.php" class="btn btn-xs btn-primary">Filter 1</a>  | <a href="leads-view.php">Add New Leads</a>
<?php
    }
?>
 <div class="clearfix"></div>
</div>

 <div class="clearfix"></div>
<div class="cont-area" style="margin:20px;">
 <div class="form-group pull-left">
    <input type="text" class="form-control" style="width:120px;" placeholder="Start Date" value="" id="StartDate">
    <input type="hidden" value="" id="StartDateUSA">
  </div>
   <div class="form-group pull-left" style="margin-left:10px;">
    <input type="text" value=""  class="form-control" style="width:120px;"  placeholder="End Date" id="EndtDate">
    <input type="hidden" value="" id="EndtDateUSA">
    <input type="hidden" value="<?php  echo $username;?>" id="username">
  </div>
<!-- <input type="text" value="" id="Mobile_No" class="pull-left form-control" style="width:250px;" placeholder="Mobile Number"/> -->

<button onclick="showUser()" class="pull-left form-control btn btn-primary rowcountbtn" style="margin-left:10px; width:150px;">Search</button>
<div class="pull-left"  style="margin-left:10px;margin-top:6px;">Total: <strong id="totalRecord"></strong></div>
<br /><br />

<div class="clearfix"></div>
 <div id="txtHint" style="width:100%; overflow:auto; margin-top:10px;"></div>
 
<br/>


 <div id="FollowUpHint" style="width:100%; overflow:auto; margin-top:10px;"></div>

</div>
<input type="hidden" id="refresh" value="no">

<!-- Modal -->

</div>


<script type="text/javascript">

function showUser()
{
//var Mobile_No = document.getElementById("Mobile_No").value
var StartDateUSA = document.getElementById("StartDateUSA").value
var EndtDateUSA = document.getElementById("EndtDateUSA").value
var username = document.getElementById("username").value

//alert(username)
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
aa.open("GET","follow-up-leads-filter-2-results.php?StartDateUSA="+StartDateUSA+"&EndtDateUSA="+EndtDateUSA+"&username="+username,true);
aa.send();

	//setTimeout(function(){ totalRecord() }, 1000);


}


/*
function showFollowUpHistory() {
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
    document.getElementById("FollowUpHint").innerHTML=aa.responseText;
    }
  }
aa.open("GET","lead-details-filter3-results.php?Mobile_No="+Mobile_No,true);
aa.send();
}
*/


</script>

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

	if(!!window.performance && window.performance.navigation.type == 2) {
    window.location.reload();
}
	
	$( "#StartDate" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#StartDateUSA',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd',
	
});


$( "#EndtDate" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#EndtDateUSA',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd',
	
});
	
	
	$(".rowcountbtn").on("click", function(){

		setTimeout(function(){ 
			//alert("Hello")
 var rowCount = $('#Customer_profile tr').length;

$('#totalRecord').text(rowCount - 1)
	
	 }, 3000);
});
	
	
	
	
   $('.update').click(function() {
	var Id = $(this).attr("id");
	$('#Id_modal').val(Id )
	var Full_Name = $('#Full_Name').text()
	$('#Modal_Full_Name').val(Full_Name)
	var Email = $('#Email').text()
	$('#Modal_Email').val(Email)
	var Mobile = $('#Mobile').text()
	$('#Modal_Mobile').val(Mobile)
	var State = $('#State').text()
	$('#Modal_State').val(State)
	
	
	//$('#Id_modal').val()
	//$('#Id_modal').val()
	//$('#Id_modal').val()
	//$('#Id_modal').val()
  });
  

  function UpdateDisposition() {
	
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

//var altDatepicker  = document.getElementById('altDatepicker').value
var Id_modal  =  $('.LeadId').val() //document.getElementsByClassName('LeadId').value;
var DateTimeModel  = document.getElementById('DateTimeModel').value
var Disposition_Modal  = document.getElementById('Disposition_Modal').value
var Modal_UserName  = document.getElementById('Modal_UserName').value




//return false;
aa.open("GET","disposition-update1.php?Id_modal="+Id_modal+"&DateTimeModel="+DateTimeModel+"&Disposition_Modal="+Disposition_Modal+"&Modal_UserName="+Modal_UserName,true);
aa.send();
//alert(Id_modal+DateTimeModel+Disposition_Modal+Modal_UserName )

}


  function FolllowUpLeads() {
	//alert('ok')
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

//var altDatepicker  = document.getElementById('altDatepicker').value


var DateTimeModel  = document.getElementById('DateTimeModel').value
var Disposition_Modal  = document.getElementById('Disposition_Modal').value
var Modal_Full_Name  = $('.LeadFull_Name').val() //document.getElementById('Modal_Full_Name').value
var Modal_Email  = $('.LeadEmail').val() //document.getElementById('Modal_Email').value
var Modal_Mobile  = $('.LeadMobile').val() //document.getElementById('LeadMobile').value
var Modal_remark  = document.getElementById('Modal_remark').value
var Modal_UserName  = document.getElementById('Modal_UserName').value

 var FowllowUpDateTime = $('#FowllowUpDateTime').val();
  var Hour = $('#Hour').val();
  var Minuts = $('#Minuts').val();
  var Second = $('#Second').val();
 
var ModalFowllowUpDateTime = FowllowUpDateTime +' '+ Hour +':'+ Minuts +':'+ Second;

var Modal_State  = document.getElementById('Modal_State').value



//return false;
aa.open("GET","followUpleads-add.php?DateTimeModel="+DateTimeModel+"&Modal_Full_Name="+Modal_Full_Name+"&Modal_Email="+Modal_Email+"&Modal_Mobile="+Modal_Mobile+"&Disposition_Modal="+Disposition_Modal+"&Modal_remark="+Modal_remark+"&Modal_UserName="+Modal_UserName+"&ModalFowllowUpDateTime="+ModalFowllowUpDateTime+"&Modal_State="+Modal_State,true);
aa.send();
/*
alert(DateTimeModel+' '+Disposition_Modal+' '+Modal_Full_Name+' '+Modal_Email+' '+Modal_Mobile+' '+Modal_remark+' '+Modal_UserName+' '+ModalFowllowUpDateTime+' '+Modal_State)*/

 setTimeout(function(){ 
  location.reload();
 }, 500);

}
  

 $('#SaveChanges').click(function() {
	
	var Disposition_Modal = $('#Disposition_Modal').val()
	var FowllowUpDateTime = $('#FowllowUpDateTime').val()
	var Hour = $('#Hour').val()
	var Minuts = $('#Minuts').val()
	var Modal_remark = $('#Modal_remark').val()

	
	
	if(Disposition_Modal != ""  && Modal_remark != "") {
		  $('#InvalidInvestment_Choose_color').hide();
		   UpdateDisposition();
	       FolllowUpLeads()
		  }
		  else {
			  $('#InvalidInvestment_Choose_color').show();
			   //alert('Ok')
			 
	
			  }
	
	
 });
  
  
  $( "#datepicker" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#FowllowUpDateTime',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd'
});
  
 
  $("#Disposition_Modal").on('change', function() {
	 var disableNow = $(this).val()
	 
	 //if(disableNow == 'NT' || disableNow == 'NI' || disableNow == 'CT' || disableNow == 'LB' || disableNow == 'DND' || disableNow == 'WN' || disableNow == 'DC') {
	  
    //alert('The option with value ' + $(this).val());
	 if(dispositions.includes(disableNow)){
	$('.disableNow').css({'visibility':'hidden'})//.hide()
	 }
	 else {
		 $('.disableNow').css({'visibility':'visible'})
		 
		 }
	 
});
  
});

</script>

<?php include('partial/footer.php') ?>
