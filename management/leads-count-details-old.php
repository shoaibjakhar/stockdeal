<?php  include('partial/session_start.php'); ?>


<?php
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
 
 if ($_SESSION['Role'] == 'Team Leader' || $_SESSION['Role'] == 'compliance officer') {

function CountAttempt($mobile){
    $ss = "select * from FolllowUpLeads where Mobile = '".$mobile."'";
     $sss = mysqli_query($connect, $ss);
     $cn = mysqli_num_rows($sss);
     return $cn;
     return 0;
}

 
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
 <!-- <a href="view-leads.php">View Leads</a> -->
</div>
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>
<?php

//print_r($_GET);

//$sql = ("SELECT * FROM  `Assigned_Leads` where  (Source = '".$Source."') && (Disposition = '".$Disposition."')");

/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
FROM fut_hni");*/
if(isset($_GET['from']) && isset($_GET['to'])){
    $from = $_GET['from'];
    $to = $_GET['to'];
}

$sql = "SELECT * FROM Assigned_Leads WHERE DATE(Leads_Assigned_Date) >= '".$from."' AND DATE(Leads_Assigned_Date) <= '".$to."'";
if(isset($_GET['agent_name']) && $_GET['agent_name'] != '' && $_GET['agent_name'] != 'total'){
    $sql .= " and UserName = '".$_GET['agent_name']."'";
}
if(isset($_GET['source']) && $_GET['source'] != '' && $_GET['source'] != 'total'){
    $sql .= " and Source = '".$_GET['source']."'";
}

if(isset($_GET['category']) && $_GET['category'] != ''){
    if($_GET['category'] == 'total'){
         $sql .= " and (Class = 'yellow-bg' OR Class = 'red-bg' OR Class = 'green-bg' OR Class = 'white-bg')";
    }
   else{
        $sql .= " and Class = '".$_GET['category']."'";
   }
}

if(isset($_GET['disposition']) && $_GET['disposition'] != ''){
    if($_GET['disposition'] == 'total'){
        $sel_options = "SELECT * FROM Options order by id desc";
        $qry_options = mysqli_query($connect,$sel_options);
        $sql_dis = " and (Disposition ";
        $i = 0;
        while($options = mysqli_fetch_assoc($qry_options)){
            if($options['disposition'] == ''){
                continue;
            }
            $i++;
            if($i == 1){
                $sql_dis .= " = '".$options['disposition']."'";
            }
            else{
                $sql_dis .= " or Disposition = '".$options['disposition']."'";
            }
            
           
        }
        $sql .= $sql_dis .")";
    }
    else{
       $sql .= " and Disposition = '".$_GET['disposition']."'"; 
        
    }
}

$sql .= " order by Leads_Assigned_Date desc";
//echo $sql;


$result = mysqli_query($connect, $sql);

echo('<table id="FollowUpHistoryExport" class="display" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
 echo('<th>#</th>');
  echo('<th>Date</th>');
  echo('<th>Customer Name</th>');
  echo('<th>Agent Name</th>');
  echo('<th>Email</th>');
  echo('<th>Mobile</th>');
  if ($_SESSION['Role'] == 'Team Leader' || $_SESSION['Role'] == 'compliance officer') {
    echo('<th>Number of attempt</th>');
  }
  echo('<th>Follow up details</th>');
  echo('<th>State</th>');
 
  echo('<th>Source</th>');
  echo('<th>Disposition</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');
$i = 0;
while($row = mysqli_fetch_array($result))
{
    $i++;
    if($i == 100){
        //break;
    }
echo('<tr>');
echo('<td>'.$i.'</td>');
 echo('<td>'.date('d-F-Y',strtotime($row['Leads_Assigned_Date'])).'</td>');
  echo('<td>'.$row['Full_Name'].'</td>');
  echo('<td>'.$row['UserName'].'</td>');
echo('<td>'.$row['Email'].'</td>');
echo('<td>'.'<a href="'.'disposition.php?Mobile='.$row['Mobile'].'">'.$row['Mobile'].'</a></td>');
 //echo('<td>'.$row['Mobile'].'</td>');
 if ($_SESSION['Role'] == 'Team Leader' || $_SESSION['Role'] == 'compliance officer') {
   echo('<td>'.'<a href="'.'disposition.php?Mobile='.$row['Mobile'].'">'. CountAttempt($row['Mobile']).'</a></td>'); //echo('<td>');echo CountAttempt($row['Mobile']);echo ('</td>');
  }
//echo('<th>Follow up details</th>');
 ?>
 <td>
     <table>
         <?php
            $sqls = ("SELECT DATE_FORMAT( DateTime,  '%d/%m/%Y %h:%i %p' ) AS DATEandTime, Full_Name, Email, Mobile, Disposition, Remark, UserName, DATE_FORMAT( FowllowUpDateTime,  '%d/%m/%Y %h:%i %p' ) AS FollowUpDATEandTime, State from `FolllowUpLeads` where Mobile = '".$row['Mobile']."' ORDER BY  `DATEandTime` DESC");
            $results = mysqli_query($connect, $sqls);
           while($f = mysqli_fetch_assoc($results)){ 
         ?>
         <tr>
            <td><?php echo $f['Disposition']; ?></td>
            <td><?php echo $f['Remark']; ?></td>
            <td><?php echo $f['DATEandTime']; ?></td>
         </tr>
         <?php
           }
         ?>
     </table>
 </td>
 
 <?php
 echo('<td>'.$row['State'].'</td>');
 echo('<td>'.$row['Source'].'</td>');
 echo('<td>'.$row['Disposition'].'</td>');
}
 echo('</tr>');
echo('</tbody>');
echo('</table>');


?>



</div>

</div>


<?php include('partial/footer.php') ?>

 <!-- <script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>   -->
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>	  
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
	

	 var table = $('#FollowUpHistoryExport').DataTable( {
        scrollY:        "500px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
		ordering: true,
        info:     true,
		 bFilter: true,
		 dom: 'Bfrtip',
        buttons: [
             'csv'
        ]
        /*
		 fixedColumns:   {
            leftColumns: 1
            
        } 
		 ,
		 */
    } );
	
	
});

</script>