<?php  include('partial/session_start.php'); ?>

<?php
//  $UserName = $_GET['UserName'];
//  $Source = $_GET['Source'];
//  $Disposition = $_GET['Disposition'];
 
date_default_timezone_set('Asia/Kolkata');
 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Stock Tips</title>
<?php require('partial/plugins.php'); ?>



</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">
 <div class="pull-left">
  <a href="memberpage.php">Dashbord</a> | <a href="demo-stock-tips.php">Demo Stock Tips</a> | <a href="demo-stock-tips-update.php" class="btn btn-xs btn-primary">Demo Today's Update</a> | <a href="demo-stock-tips-update-3month.php">Demo Last 3 Months's Update</a> | <a href="demo-stock-tips-update-open.php">Demo Open</a> 
 </div>
<!-- <div class="pull-right"><a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a></div> -->
 <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">

<?php include('connection/dbconnection_crm.php')?>


<?php
$sql = ("SELECT Id, Ideas, Sagment, Result, DATE_FORMAT( DateTime,  '%d-%m-%Y %H : %i %p' ) AS DateTimeCurrent FROM Demo_Stock_Tips WHERE DATE( CURDATE( ) ) = DATE( DateTime) ORDER BY `Demo_Stock_Tips`.`DateTime` DESC");
$result = mysqli_query($connect, $sql);
echo('<form action="demo-stock-tips-update-back.php" method="post">');
echo('<table id="Customer_profile" class="display table table-bordered" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr class="brand-color-bg">');
  echo('<th>Date Time</th>');
  echo('<th>Sagment</th>');
  echo('<th>Change Results</th>');
  echo('<th>Results</th>');
  echo('<th>Ideas</th>');
   echo('<th>Ideas</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
  echo('<td>'.$row['DateTimeCurrent'].'</td>');
  echo('<td>'.$row['Sagment'].'</td>');
  echo('<td><select class="resultUpdate form-control"><option value="Open">Open</option><option value="Negative">Negative</option><option value="Positive">Positive</option><option value="Follow Up">Follow Up</option><option value="Close">Close</option></select></td>');
  echo('<td><div class="btn text-center '.$row['Result'].'" style="margin-top:30px;margin-left:10px">'.$row['Result'].'</div></td>');
  echo('<td><textarea class="Ideas" style=" width:360px; height:80px;">'.$row['Ideas'].'</textarea></td>');
  echo('<td><input type="hidden" value="'.$row['Id'].'"'. 'class="id"/>'.'<a href="#_"' . 'class="btn btn-primary Updatebtn">Update</a>'.'</td>');
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="AddFreeTrailLabel">Stock Tips</h4>
      </div>
      <div class="modal-body">
      
	  <div class="alert alert-danger" style="display:none">
  <strong>All fields are mandatory except Last Name</strong>
</div>
       
       <input type="hidden" id=""  value="<? /*php echo date("Y-m-d h:i:s")*/ ?>"/>
      
<table width="100%"  border="0" class="table table-bordered" cellspacing="0" cellpadding="0">
  <tbody>
<tr>
              
              <td>Segment</td>
              <td>Date</td>
              <td>Hour</td>
              <td>Minutes</td>
            </tr>
           
            <tr>
            
             
            
              </td>
              <td><select id="Segment" class="form-control">
                  <?php include('partial/segments.php') ?>
                </select></td>
               
                <td><input type="text" class="form-control" id="datepicker" placeholder="Date">
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



<form action="demo-stock-tips-update-back.php" method="get" style="display:none">
<input type="text"  name="Id" class="Id" value=""/>
<input type="text"  name="Idea" class="Idea" value=""/>
<input type="text"  name="resultUpdate" class="resultUpdate" value=""/>

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
    document.getElementById("txtHint").innerHTML=aa.responseText;
	}
  }
  
var StartDate = document.getElementById("StartDate").value
var EndtDate = document.getElementById("EndtDate").value
var Packages = document.getElementById("Packages").value


aa.open("GET","demo-stock-tips-back.php?StartDate="+StartDate+"&EndtDate="+EndtDate+"&Packages="+Packages,true);

aa.send();
//alert(p)

}
</script>


<script type="text/javascript">

function Add() {
	//alert('asd')
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

var Segment  = document.getElementById('Segment').value
var Idea  = document.getElementById('Idea').value



 var FowllowUpDateTime = $('#FowllowUpDateTime').val();
  var Hour = $('#Hour').val();
  var Minuts = $('#Minuts').val();
  var Second = $('#Second').val();
 
var ModalFowllowUpDateTime = FowllowUpDateTime  +' '+ Hour +':'+ Minuts +':'+ Second;




aa.open("GET","demo-stock-tips-add.php?ModalFowllowUpDateTime="+ModalFowllowUpDateTime+"&Segment="+Segment+"&Idea="+Idea+"&FowllowUpDateTime="+FowllowUpDateTime,true); 
aa.send();


//alert( Idea)



setTimeout(function(){  location.reload(); }, 1000);

}



	
	
$(document).ready(function() {
	
	$('.Updatebtn').click(function() {
		var Id = $(this).prevAll("input[type=hidden]").val();
		var resultUpdate  = $(this).closest('tr').find('.resultUpdate').val() 
		var Ideas = $(this).closest('tr').find('.Ideas').val()
		//alert(Id+Ideas);
		$('.Idea').val(Ideas)
		$('.Id').val(Id)
		$('.resultUpdate').val(resultUpdate)
		
		$('#aa').trigger("click");
		});
		
		
		
	
	
	
$( "#datepicker" ).datepicker({
	dateFormat: 'dd-mm-yy', 
    altField  : '#FowllowUpDateTime',
    altFormat : 'yy-mm-dd',
    format    : 'yy-mm-dd',
	minDate: 0
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
	
	 var Segment = $('#Segment').val();
	 var FowllowUpDateTime = $('#FowllowUpDateTime').val();
	 var Idea = $('#Idea').val();
	  var Hour = $('#Hour').val();
	  var Minuts = $('#Minuts').val();
	  var Second = $('#Second').val();
	  
	  

	  if(Segment != "" && FowllowUpDateTime != "" && Idea != "" && Hour != "" && Minuts != "") {
		  $('.alert-danger').hide();
		   Add();
		   // alert('aa')
		  }
		  else {
			  $('.alert-danger').show();
			  //alert('bb')
			
			  }


});


   
});
</script>