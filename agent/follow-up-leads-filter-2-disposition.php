<?php  include('partial/session_start.php'); ?>

<?php

 $UserName = $_GET['UserName'];

 $Source = $_GET['Source'];

 $Disposition = $_GET['Disposition'];

 $Mobile = $_GET['Mobile'];
 $FollowUpId = $_GET['FollowUpId'];

//echo( $FollowUpId );
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
  <!-- <a href="view-leads.php">View Leads</a> | <a href="lead-details.php" >Lead details</a> | <a href="lead-details-filter2-new.php">Filter 1</a>-->
  
  <a href="memberpage.php">Follow Up Leads</a> | <a href="fresh-leads.php" class="">Fresh Leads</a> | <a href="lead-details-filter2-new.php">Filter 1</a>  | <a href="leads-view.php">Add New Leads</a>
  
  </div>

  <div class="containter" style="padding:20px 20px 0 20px;">

    <?php //include('connection/dbconnection_crm.php')?>

    <?php

$sql = ("SELECT Full_Name, Email, Mobile, State, Source, Disposition , Id, DATE_FORMAT( DateTime,  '%d/%m/%Y %H:%i %p' ) AS DATEandTime FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Mobile = '".$Mobile."')");


$result = mysqli_query($connect,$sql);



//echo('<table id="veiw_Leadstest" class="display" cellspacing="0" width="100%">');

echo('<table id="" class="table" cellspacing="0" width="100%">');

echo('<thead>');

 echo('<tr>');

  echo('<th>Full Name</th>');

  echo('<th>Email</th>');

  echo('<th>Mobile</th>');

  echo('<th>State</th>');

  echo('<th>Source</th>');

  echo('<th>Disposition</th>');

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

 echo('<td id="Mobile"> <span id="bar">'.$row['Mobile'].'</span> <a  class="btn btn-primary btn-xs" data-clipboard-action="copy" data-clipboard-target="#bar"> Copy</a></td>');

 echo('<td id="State">'.$row['State'].'</td>');

 echo('<td id="Source">'.$row['Source'].'</td>');

 echo('<td id="Disposition">'.$row['Disposition'].'</td>');

 echo('<td>'.$row['DATEandTime'].'</td>');

 echo('<td>'.'<a href="#" class="btn btn-primary update" id="'.$row['Id'].'" data-toggle="modal" data-target="#myModal_1">'.'Update'.'</a>'.'</td>');

}

 echo('</tr>');

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









<script src="js/clipboard.min.js"></script>



    <!-- 3. Instantiate clipboard -->

    <script>

    var clipboard = new Clipboard('.btn');



    clipboard.on('success', function(e) {

        console.log(e);

    });



    clipboard.on('error', function(e) {

        console.log(e);

    });

    </script>







<?php include('partial/footer.php') ?>



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

              <td><select id="Disposition_Modal" class="form-control">

                  <?php require('partial/disposition.php'); ?> 

                </select></td>

               

                <td><input type="text" class="form-control disableNow" id="datepicker" placeholder="Date" autocomplete="off">

                        <input type="hidden" class="form-control" id="FowllowUpDateTime" placeholder="Date"></td>

                <td>

      <select id="Hour" class="disableNow">

          <?php require('partial/hour.php'); ?> 

        </select></td>

      <td>

      <select id="Minuts" class="disableNow">

          <?php require('partial/minutes.php'); ?> 

        </select></td>

      <td style="display:none">

       <select id="Second">



          <?php require('partial/seconds.php'); ?> 

        </select></td>

        

            </tr>

             <tr>

              

              <td>Remark</td>

              <td></td>

              <td></td>

              <td></td>

          

            </tr>

             <tr>

              

               <td colspan="2"><textarea id="Modal_remark" class="form-control"></textarea></td>

              

              <td></td>

              <td></td>

          

            </tr>

          

          

             <tr style="display:none">

             <td><input type="text" class="form-control" id="Modal_Full_Name"/></td>

              <td><input type="text" class="form-control" id="Modal_Email"/></td>

              <td><input type="text" class="form-control" id="Modal_Mobile"/></td>

             <td><input type="text" class="form-control" id="Modal_State"/></td>

              <td><input type="text" class="form-control" id="Id_modal"/></td>

              <td><input type="text" class="form-control" id="DateTimeModel" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y-m-d H:i:s");?>"/>

              <td><input type="text" id="Modal_UserName" value="<?php  echo $username;?>" class="form-control"/></td>

             

            </tr>

            

            

          </tbody>

        </table>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="button" class="btn btn-primary" data-dismiss="modal" id="SaveChanges">Save changes</button>

      </div>

    </div>

  </div>

</div>

<form method="get" action="follow-up-done.php" style="display: none">
 <input type="text"  name="FollowUpId" id="FollowUpId"  value="<?php  echo $_GET['FollowUpId']; ?>" />
 <input type="submit" value="Done"  id="FollowUpIdButton"  class="btn btn-primary"/>
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

var Id_modal  = document.getElementById('Id_modal').value

var DateTimeModel  = document.getElementById('DateTimeModel').value

var Disposition_Modal  = document.getElementById('Disposition_Modal').value


var FowllowUpDateTime = $('#FowllowUpDateTime').val();

var Hour = $('#Hour').val();

var Minuts = $('#Minuts').val();

var Second = $('#Second').val();

var ModalFowllowUpDateTime = FowllowUpDateTime +' '+ Hour +':'+ Minuts +':'+ Second;


//alert(ModalFowllowUpDateTime)





//return false;

aa.open("GET","disposition-update.php?Id_modal="+Id_modal+"&DateTimeModel="+DateTimeModel+"&Disposition_Modal="+Disposition_Modal+"&ModalFowllowUpDateTime="+ModalFowllowUpDateTime,true);

aa.send();

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

var Modal_Full_Name  = document.getElementById('Modal_Full_Name').value

var Modal_Email  = document.getElementById('Modal_Email').value

var Modal_Mobile  = document.getElementById('Modal_Mobile').value

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

	 window.location.href="follow-up-leads-filter-2.php"

}, 900);




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

	 

	 if(dispositions.includes(disableNow)){
	$('.disableNow').css({'visibility':'hidden'})//.hide()
	 }

	 else {

		 $('.disableNow').css({'visibility':'visible'})

		 

		 }

	 

});

  

});



</script>



</body>

</html>