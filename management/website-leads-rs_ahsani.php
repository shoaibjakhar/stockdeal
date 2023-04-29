<?php  include('partial/session_start.php'); ?>
<?php //include($_SERVER['DOCUMENT_ROOT']."/partial/access-control-role-base.php"); ?>
<?php
 // $UserName = $_GET['UserName'];
 // $Source = $_GET['Source'];
 // $Disposition = $_GET['Disposition'];
 
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Website Leads</title>
<?php require('partial/plugins.php'); ?>
<style>

.duplicate {
    background:#ec7b7b;
		color:#333;
}

	.Administrator  {
		   color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
	}

	
</style>
</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">
 <a href="memberpage.php">Dashbord</a> | 
 <a href="website-leads-rsi.php" class="btn btn-xs btn-primary">Website Leads</a> | 
 <a href="assign-multiple-leads.php">Multiple Assign</a> |
 <a href="assign-bulk-leads.php">Bulk Assign</a> |
 <a href="leads-filter_4_new.php">Re Assign</a> 
 <!--| <a href="leads-count.php">Analytics</a>-->
</div>
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>
<h3 style="padding:10px;font-size:18px;" class="brand-color-bg-n-bdr">Website Today's Leads
 <div class="pull-right"><span id="totalRecord"></span>  Records</div>
</h3>

<?php
$sel = "select * from employee where Team_Leader = '".$username."' and Status = 'Active' order by username asc";
$qry = mysqli_query($connect,$sel);
$teams = array();
while($fetch = $qry->fetch_assoc()){
    $teams[] = $fetch['username'];
}

if($_SESSION['Role'] == 'Team Leader'){
    $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y %h:%i') AS DateTimeINR FROM  `Assigned_Leads` WHERE UserName = '".$username."' AND Disposition = 'Fresh' ORDER BY  `id` DESC");
}

if($_SESSION['Role'] == 'Super Admin'){
    $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y %h:%i') AS DateTimeINR FROM  `Assigned_Leads` WHERE (Status IS NULL OR Status='Open') AND Disposition = 'Fresh' ORDER BY  `id` DESC");

    
}



$mobile_sql = "SELECT Mobile from Assigned_Leads";


//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");

/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
FROM fut_hni");

SELECT * FROM Assigned_Leads WHERE DateTime > DATE(NOW()) and DateTime < NOW() and Source='Website'
*/


$result = mysqli_query($connect,$sql);
$mobile_sql_result = mysqli_query($connect,$mobile_sql);

echo('<table id="FreshLeads" class="table table-bordered table-hover" cellspacing="0" cellpadding="5" width="100%">');
echo('<thead>');
 echo('<tr style="font-wight:bold">');
    echo('<th>Status</th>');
	echo('<th style="width:100px;">Current_Date</th>');
 
  echo('<th>Full_Name</th>');
  //echo('<th>Email</th>');
  
  echo('<th>Mobile</th>');
	echo('<th>Agent</th>');
	echo('<th>Status</th>');
	echo('<th style="">Source</th>');
	echo('<th>Disposition</th>');
	
    //echo('<th>Status</th>');
  //echo('<th>Message</th>');
  
  //echo('<th>Date_Time</th>');
	//echo('<th>IP Address</th>');
	echo('<th>State</th>');
	echo('<th>Investment</th>');
	echo('<th>Segment</th>');
	
 echo('</tr>');
echo('</thead>');
echo('<tbody>');



while($rm = $mobile_sql_result->fetch_assoc()){
     $mobile[] = $rm['Mobile'];
}
$tn = array();
$i = 0;
while($rows = $result->fetch_array())
{
    //print_r($rows['Mobile']);
   //$duplicate[$row['Mobile']];
   if($_SESSION['Role'] == 'Super Admin'){
       $i++;
       $leads[] = $rows; 
       if($i == 1000){
            break;
        }
   }
   else{
    //   if(!in_array($rows['UserName'],$teams)){
    //       $tn[] = $rows['UserName'];
    //       continue;
    //   }
    //   else{
    //       $i++;
    //       $leads[] = $rows; 
    //   }
       $i++;
        $leads[] = $rows; 
        if($i == 1000){
            break;
        } 
   }
   
	
 
}
//print"<pre>";
//print_r($tn);

$duplicate = array_count_values($mobile);

if(!empty($leads)){
    foreach($leads as $row)
    {
       
            
    $trs = ('<tr class="'.$row['UserName'].' "');
    
    if($duplicate[$row['Mobile']]>1){
        $trs.= (' style=""');
    
    }
    
    $trs.=('>');
    echo $trs;
    	echo ('<td><input type="hidden" class="id" value="'.$row['id'].'"><select class="form-control AssignToCSR AgentNames" id="target" style="width:160px;"></select></td>');
    	echo('<td>'.$row['DateTimeINR'].'</td>');
    
     echo('<td class="Full_Name">'.$row['Full_Name'].'</td>');
    //echo('<td class="Email">'.$row['Email'].'</td>');
    
     echo('<td class="Mobile">').$row['Mobile'];
     
     if($duplicate[$row['Mobile']]>1){
        echo (' <button class="btn btn-primary btn-sm" type="button">DUPLICATE</button>');
    
    }
     echo ('</td>');
     echo('<td>'.$row['UserName'].'</td>');
    	echo('<td><a href="#_" class="btn btn-danger">'.$row['Status'].'</a></td>');
    	echo('<td style="">'.$row['Source'].'</td>');
    	echo('<td>'.$row['Disposition'].'</td>');
     //echo('<td>'.'<a href="#_" class="btn btn-danger">'.$row['Status'].'</a></td>');
     //echo('<td>'.$row['Message'].'</td>');
    	//echo('<td>'.$row['CurrentDateTime'].'</td>');
     //echo('<td>'.$row['remoteAddress'].'
     
     //<input type="text" value="'.$row['remoteAddress'].'" class="unique" style="color:#333;display:none;"></td>');
    	echo('<td class="State">'.$row['State'].'</td>');
    	echo('<td class="Investment">'.$row['Investment'].'</td>');
    	echo('<td class="Segment">'.$row['Segment'].'</td>');
    	
    	
     echo('</tr>');	
    }
}

if(!empty($leads)){
    echo ('<tr><td><b>Total</b></td><td colspam="9"><b>'.count($leads).'</b></td></tr>');
}
else{
    echo ('<tr><td><b>Total</b></td><td colspam="9"><b>'."0".'</b></td></tr>');
}

//echo $sel;


echo('</tbody>');
echo('</table>');


?>



</div>

</div>
<form action="website-leads-assign-agent.php" method="get" style="display:none;">
	<input type="text" id="id" name="id" value="">
	<input type="text" id="AssignToCSR" name="AssignToCSR" value="">
	<input type="text" id="AssignStatus" name="AssignStatus" value="">
	<input type="submit" value="submit" id="submit">
</form>
<script>

	$(document).ready(function(){
		
		//$(".AssignToCSR option:first").attr('selected','selected');
		
	 $('.AssignToCSR').change(function(){
  	  var id = $(this).closest("tr").find('.id').val();
	  var AssignToCSR = $(this).val();
   	  $('#id').val(id);
	  $('#AssignToCSR').val(AssignToCSR);
	  $('#AssignStatus').val('Assigned');
		 
		 //alert(id+' '+AssignToCSR);
	  
	 if (AssignToCSR != null) {
		 setTimeout(function(){ $("#submit").trigger("click"); }, 200);
		 
		 
	  }
	  else {
		  alert('Failed to Assign')
	  }	 
		 
		 //setTimeout(function(){ $("#submit").trigger("click"); }, 100);
     });
	});
	
</script>


<script type="text/javascript">
	
	
$(document).ready(function(){
 var rowCount = $('#FreshLeads tr').length;
 $('#totalRecord').text(rowCount - 1);
	
	<?php 
	    if($_SESSION['Role'] == 'Super Admin'){
	        include('partial/agents-name.php');
	    }
	    else{
	        echo("$('.AgentNames').html('"); 
	        echo('<option value="">Select</option>');
	        foreach($teams as $team){
	            echo '<option value="'.$team.'">'.$team.'</option>';
	        }
	        echo("')");
	    }
	    
	?>
	
	//alert('asd');
});
	
	
	/*
 function highlightDuplicates() {
        // loop over all input fields in table
        $('#subscribers').find('input[type="text"]').each(function() {
            // check if there is another one with the same value
            if ($('#subscribers').find('input[value="' + $(this).val() + '"]').size() > 1) {
                // highlight this
                $(this).parent().parent('tr').addClass('duplicate');
				//$(this).parent().parent('tr').find('.btn-primary').trigger("click");
				//alert('duplicate found');
				//window.location.href="follow-up-duplicate-delete.php"
            } else {
                // otherwise remove
                $(this).removeClass('duplicate');
            }
        });
    }


    $().ready(function() {
        // initial test
        highlightDuplicates();

        // fix for newer jQuery versions!
        // since you can select by value, but not by current val
        $('#subscribers').find('input').bind('input',function() {
            $(this).attr('value',this.value)
        });

        // bind test on any change event
        $('#subscribers').find('input').on('input',highlightDuplicates);
    });

  */
	


</script>


<?php include('partial/footer.php') ?>
