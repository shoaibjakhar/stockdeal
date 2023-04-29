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
<title>Stock Tips</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<?php require('partial/plugins.php'); ?>



</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  <?php
// function definition is written in hearder-top.php
// if agent bank details are missing, will redirect on agent login details page
check_agent_bank_details();
?>

</header>
<div class="breadcurms">
 <div class="pull-left">
<a href="memberpage.php">Dashbord</a> | <a href="stock-tips.php" class="btn btn-xs btn-primary">Stock Tips</a> | <a href="stock-tips-download.php">Download</a>  | <a href="stock-tips-filter_4.php">Filter 4</a> | <a href="stock-tips-update.php">Today's Update</a> | <a href="stock-tips-update-3month.php">Last 3 Months's Update</a> | <a href="stock-tips-update-open.php">Open</a>
 </div>
 <div class="pull-right"><a href="#" class="btn btn-xs btn-primary AddFreeTrail" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a></div> 
 <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">

<?php include('connection/dbconnection_crm.php')?>


<?php
$sql = "SELECT Id, Ideas, Sagment, Result, DATE_FORMAT( DateTime,  '%d-%m-%Y %H : %i' ) AS DateTimeCurrent FROM stock_tips WHERE Date = '".$TodaysDate."' ORDER BY `stock_tips`.`DateTime` DESC";
// echo $sql;
// exit; 
$result = mysqli_query($connect,$sql);
echo('<form action="aa.php" method="post">');
echo('<table id="Customer_profile" class="display table table-bordered" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr class="brand-color-bg">');
  echo('<th>Date Time</th>');
  echo('<th>Sagment</th>');
  
  echo('<th>Result</th>');
  echo('<th>Ideas</th>');
   echo('<th>Ideas</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = $result->fetch_array())
{
echo('<tr>');
  echo('<td>'.$row['DateTimeCurrent'].'</td>');
  echo('<td>'.$row['Sagment'].'</td>');
  echo('<td><div class="btn '.$row['Result'].'" style="margin-top:10px;margin-left:10px;margin-right:10px">'.$row['Result'].'</div></td>');
  echo('<td>'.$row['Ideas'].'</td>');
  
  echo('<td><input type="hidden" value="'.$row['Id'].'"'. 'class="id"/>'.'<a href="#_"' . 'class="btn btn-danger delete-stock-tips">Delete</a>'.'</td>');
  }
 echo('</tr>');
echo('</tbody>');
echo('</table>');
echo('</form>');
?>



</div>

</div>


<!-- Modal -->
<div class="modal fade" id="AddFreeTrail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="AddFreeTrailLabel">Stock Tips</h4>
		          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      
	  <div class="alert alert-danger" style="display:none">
  <strong>All fields are mandatory except Last Name</strong>
</div>
       
     <?php /*  <input type="hidden" id=""  value=" echo date("Y-m-d h:i:s")"/> */ ?>
      
<table width="100%"  border="0" class="table table-bordered" cellspacing="0" cellpadding="0">
  <tbody>
<tr>
              
              <td>Segment</td>
              <td>Date</td>
              <td>Hour</td>
              <td>Minutes</td>
            </tr>
           
            <tr>
            
             
              <td style="width: 140px"><select  id="Segment" multiple title='select' class="segment selectpicker form-control" multiple data-live-search="true">
                  <?php include('partial/segments.php') ?>
                </select></td>
               
                <td><input type="text" class="form-control" id="datepicker" placeholder="Date" autocomplete="off">
                        <input type="hidden" class="form-control" id="FowllowUpDateTime" placeholder="Date"></td>
                <td>
      <select id="Hour">
          <?php require('partial/hour.php'); ?> 
        </select></td>
      <td>
      <select id="Minuts">
          <?php require('partial/minutes.php'); ?> 
        </select></td>
      <td style="display:none">
       <select id="Second">

          <?php require('partial/seconds.php'); ?> 
        </select></td>
        
            </tr>
            <tr>
              
              <td>Idea</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              
             
              <td colspan="4"><textarea id="Idea" style="width:100%;"></textarea></td>
            </tr>
  </tbody>
</table>


<!-- -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="Add">Add</button>
      </div>
    </div>
  </div>
</div>

<form action="stock-tips-delete.php" method="get" style="display:none">
<input type="text"  name="Id" class="Id" value=""/>

<input type="submit" id="aa"/>
</form>
<?php include('partial/footer.php') ?>



<script type="text/javascript">
function showUser()
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  aa=new XMLHttpRequest();
  }

aa.onreadystatechange=function()
  {
  if (aa.readyState==4 && aa.status==200)
    {
    //document.getElementById("txtHint").innerHTML=aa.responseText;
	}
  }
  
var StartDate = document.getElementById("StartDate").value
var EndtDate = document.getElementById("EndtDate").value
var Packages = document.getElementById("Packages").value


aa.open("GET","stock-tips-back.php?StartDate="+StartDate+"&EndtDate="+EndtDate+"&Packages="+Packages,true);

aa.send();
//alert(p)

}
</script>


<script type="text/javascript">
	
	


function Add() {
	//alert('asd')
// if (window.XMLHttpRequest)
  // {// code for IE7+, Firefox, Chrome, Opera, Safari
  // aa=new XMLHttpRequest();
  // }

// aa.onreadystatechange=function()
  // {
  // if (aa.readyState==4 && aa.status==200)
    // {
    // //document.getElementById("txtHint").innerHTML=aa.responseText;
	// }
  // }

//var Segment  = document.getElementById('Segment').value
var Segment = [];
$.each($(".segment option:selected"), function(){            
	Segment.push($(this).val());
});
var Idea  = document.getElementById('Idea').value;


 var FowllowUpDateTime = $('#FowllowUpDateTime').val();
 var Hour = $('#Hour').val();
 var Minuts = $('#Minuts').val();
 var Second = $('#Second').val();
 
var ModalFowllowUpDateTime = FowllowUpDateTime  +' '+ Hour +':'+ Minuts +':'+ Second;

var request = $.ajax({
  url: "stock-tips-add.php?v=<?php echo time(); ?>",
  type: "POST",
  data: {ModalFowllowUpDateTime:ModalFowllowUpDateTime, Segment:Segment,Idea:Idea ,FowllowUpDateTime:FowllowUpDateTime},
  dataType: "html"
});

request.done(function(msg) {
    console.log(msg);
	setTimeout(function(){  location.reload(); }, 1000);
});

request.fail(function(jqXHR, textStatus) {
  alert( "Request failed: " + textStatus );
});
//alert("asdf");return;

//aa.open("GET","stock-tips-add.php?ModalFowllowUpDateTime="+ModalFowllowUpDateTime+"&Segment="+Segment+"&Idea="+Idea+"&FowllowUpDateTime="+FowllowUpDateTime,true); 
//aa.send();


//alert( Idea)



//setTimeout(function(){  location.reload(); }, 1000);

}



	
	
$(document).ready(function() {
	
	$('.btn-danger').click(function() {
		
		var deletetip = $(this).prevAll("input[type=hidden]").val();
		//alert(deletetip);
	
	
		$('.Id').val(deletetip)
		$('#aa').trigger("click");
	
		
		});
	
	
	
$( "#datepicker" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#FowllowUpDateTime',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd',
	//minDate: 0
});
 
 
 $( "#StartDate" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#StartDateIndian',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd',
	
});


$( "#EndtDate" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#EndtDateIndian',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd',
	
});
   
   

$('#Add').click(function() {
	
	 //var Segment = $('#Segment').val();
	 var Segment = [];
		$.each($(".segment option:selected"), function(){            
			Segment.push($(this).val());
		});
	 var FowllowUpDateTime = $('#FowllowUpDateTime').val();
	 var Idea = $('#Idea').val();
	  var Hour = $('#Hour').val();
	  var Minuts = $('#Minuts').val();
	  var Second = $('#Second').val();
	  
	  

	  if(Segment.length != 0 && FowllowUpDateTime != "" && Idea != "" && Hour != "" && Minuts != "") {
		  $('.alert-danger').hide();
		  $('#Add').attr('disabled',true);
		  $('#Add').text('Please Wait....');
		  // Add();
		   // alert('aa')
		   var Segment = [];
            $.each($(".segment option:selected"), function(){            
            	Segment.push($(this).val());
            });
            var Idea  = document.getElementById('Idea').value;
            
            
             var FowllowUpDateTime = $('#FowllowUpDateTime').val();
             var Hour = $('#Hour').val();
             var Minuts = $('#Minuts').val();
             var Second = $('#Second').val();
             
            var ModalFowllowUpDateTime = FowllowUpDateTime  +' '+ Hour +':'+ Minuts +':'+ Second;
            
            $.ajax({
              url: "stock-tips-add.php?v=<?php echo time(); ?>",
              type: "POST",
              data: {ModalFowllowUpDateTime:ModalFowllowUpDateTime, Segment:Segment,Idea:Idea ,FowllowUpDateTime:FowllowUpDateTime},
              success:(res)=>{
                  console.log(res);
                  window.location.reload();
              }
            });
		  }
		  else {
			  $('.alert-danger').show();
			  //alert('bb')
			
			  }


});


   
});
</script>
<script>
$(document).ready(()=>{
//  $('select').selectpicker();  
})
</script>