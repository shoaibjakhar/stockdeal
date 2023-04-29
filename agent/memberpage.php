<?php   include('partial/session_start.php'); ?>
<?php
if($_SESSION['Role'] != 'Customer Care'){
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Follow Up Leads</title>
<?php require('partial/plugins.php'); ?>
<?php 
//<span class="request-notification">'.$not_seen.'</span>
        $sel = "select count(*) as cn FROM `Assigned_Leads` WHERE Disposition='Fresh' and UserName ='$username' and (Source='LEADSFB' or Source='Website' or Source='Direct')";
        $qry = mysqli_query($connect,$sel);
        $fetch = mysqli_fetch_assoc($qry);

?>
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
 <a href="memberpage.php"  class="btn btn-xs btn-primary">Follow Up Leads</a> | <a href="follow-up-leads-filter-2.php">Filter 2</a> | <a href="fresh-leads.php">Fresh Leads <span class="badge badge-pill badge-info request-notification" style="background: #5D78FF;color: #fff;margin-left: 0;"><?php echo $fetch['cn'];?></span></a> | <a href="lead-details-filter2-new.php">Filter 1</a>  | <a href="leads-view.php">Add New Leads</a> 
</div>

<div class="containter" style="padding:5px 20px 0 20px">


<div class="clearfix"></div>

<h3 class="panel-heading">Follow Up Details
 <div class="pull-right"><span id="totalRecord"></span>  Records</div>
</h3>
<div style="width:100%; overflow:auto;">

<?php
$sql="SELECT id, DATE_FORMAT( DateTime, '%d/%m/%Y %h:%i %p' ) AS DateTime, Full_Name, Email, Mobile, Disposition, Remark, UserName, DATE_FORMAT( FowllowUpDateTime, '%d-%m-%Y %h:%i' ) AS FowllowUpDateTime , DATE_FORMAT( FowllowUpDateTime, '%d/%m/%Y' ) AS FowllowUpDate, DATE_FORMAT( FowllowUpDateTime, '%H' ) AS FowllowUpTime, DATE_FORMAT( FowllowUpDateTime, '%p') AS FowllowUpTimeAM_PM, State, Priority FROM FolllowUpLeads WHERE id in (SELECT max(id) FROM FolllowUpLeads GROUP BY Mobile) AND DATE(FowllowUpDateTime) <= '".$DateTimeINR."' AND UserName ='".$username."' AND NOT Status='Done' AND NOT Disposition='NT' AND NOT Disposition='NI' AND NOT Disposition='CT' AND NOT Disposition='LB' AND NOT Disposition='DND' AND NOT Disposition='WN' AND NOT Disposition='DC' AND NOT Disposition='Sale' AND NOT Disposition='NCD' AND NOT Disposition='NI - Do not want to trade now' AND NOT Disposition='NI - Others' AND NOT Disposition='NI - losses/No risk taker' AND NOT FowllowUpDateTime='0000-00-00 00:00:00'  AND FowllowUpDateTime >= DATE_FORMAT(CURDATE(), '%Y-%m-01') - INTERVAL 2 MONTH ORDER BY `FolllowUpLeads`.`FowllowUpDateTime` DESC";
$mobile_sql = "SELECT Mobile from Assigned_Leads";
$mobile_sql_result = mysqli_query($connect,$mobile_sql);	
while($rm = mysqli_fetch_assoc($mobile_sql_result)){
    $mobile[] = $rm['Mobile'];
}
$duplicate = array_count_values($mobile);


	
	
$result = mysqli_query($connect,$sql);

echo('<table id="Employee_Wroking_Status" class=" table table-bordered " cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr class="brand-color-bg">');
  echo('<th>Fowllow Up Date</th>');
  echo('<th>Full Name</th>');
  echo('<th>Email</th>');
  echo('<th>Mobile</th>');
  echo('<th>Disposition</th>');
  echo('<th>Remark</th>');
  //echo('<th>Agent</th>');
  //echo('<th>Date</th>');
  echo('<th>State</th>');
	echo('<th>Priority</th>');
  //echo('<th>Status</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');
$leads = [];
while($rows = mysqli_fetch_array($result)){
    $leads[] = $rows;
}

mysqli_close($connect);



foreach($leads as $row){
    // echo '<tr class='.$row['Priority'].'>';
     
     
     
     
       echo('<tr class="'.$row['Priority'].'"');
            // echo $duplicate[$row['Mobile']];
              if((float)$duplicate[$row['Mobile']]>1){
                        echo (' style=""');
                    
                    }
             echo ('>');
             
             
   echo('<td style="width:100px;">'.$row['FowllowUpDateTime'].'</td>');
   echo('<td>'.$row['Full_Name'].'</td>');
   echo('<td>'.$row['Email'].'</td>');
   echo('<td>'.'<a class="" href="'.'disposition.php?Mobile='.$row['Mobile'].'&UserName='.$username.'&FollowUpId='.$row['id'].'&Full_Name='.$row['Full_Name'].'"><i class="fa fa-phone" aria-hidden="true"></i> '.$row['Mobile'].'</a>');
   
   if($duplicate[$row['Mobile']]>1){
    echo "<button class='btn btn-primary'>DUPLICATE</button>";   
   }
  
  echo ('
   <input type="text" value="'.$row['Mobile'].'" class="unique" style="color:#333;display:none;"/>
   </td>
    
   ');
   echo('<td>'.$row['Disposition'].'</td>');
   echo('<td>'.$row['Remark'].'</td>');
   //echo('<td>'.$row['UserName'].'</td>');
   //echo('<td>'.$row['DateTime'].'</td>');
   echo('<td>'.$row['State'].'</td>');
   echo('<td>'.$row['Priority'].'</td>');
  //echo('<td>'.'<form method="get" action="follow-up-done.php"><input type="hidden"  name="FollowUpId" value="'.$row['id'].'"/><input type="submit" value="Done" class="btn btn-primary"/></form>'.'</td>');
  echo "</tr>";
}

echo "</table>";


?>
</div>
</div>

</div>
	


<script type="text/javascript">

	$(document).ready(function(){


var rowCount = $('.table  tr').length;

$('#totalRecord').text(rowCount - 2)

		var	winHeight = 3000 - 300;	
		
$('#Employee_Wroking_Status').DataTable( {
	"order": [],
		"columnDefs": [
    { "orderable": false, "targets": [0,2,3,4,5,6] }
  ],
	
        "lengthMenu": [[-1, 5, 10, 15, 20, 25, 30, 40, 50], ["All", 5, 10, 15, 20, 25, 30, 40, 50]],
     
	"bPaginate": true,
 "bLengthChange": true,
 "bFilter": true,
 "bInfo": true,
 "bAutoWidth": true,
 "scrollY": false,
 //"scrollY": 2000+"px",
 "scrollCollapse": true,
 "paging": true,
        initComplete: function () {
            this.api().columns([4,7]).every( function () {
                var column = this;
                var select = $('<select class="form-control"><option value="">Select</option></select>')
                    .appendTo( $(column.header()) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' );
                } );
            } );
        }
    });	
		
		//alert('asdf');
		
	});	
		
</script>




<?php include('partial/footer.php') ?>
<?php
}
else{
    echo '<script>window.location.href="dashboard.php"</script>';
}
?>