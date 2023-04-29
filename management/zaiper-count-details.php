<?php  include('partial/session_start.php'); ?>


<?php
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['disposition'];
 
$agent_name = $_GET['agent_name'];
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
 <a href="memberpage.php">Dashboard</a>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>
<?php
/*
$sql = "";
if(isset($_GET['from']) && isset($_GET['to'])){
    $from = $_GET['from'];
    $to = $_GET['to'];
    $sql = "SELECT * FROM Assigned_Leads WHERE DATE(timestamp) >= '".$from."' AND DATE(timestamp) <= '".$to."'";
    
    if(isset($_GET['agent_name']) &&  $_GET['agent_name'] != ''){
        $sql .= " AND UserName='". $agent_name."' ";
    }
    
    if(isset($_GET['disposition']) && $_GET['disposition'] != ''){
        $sql .= " AND Disposition='".$Disposition."' ";
    }
    
    if(isset($_GET['Source']) && $_GET['Source'] != ''){
        $sql .= " AND Source = '".$_GET['Source']."'";
    }
    
}

*/

 $sql = "SELECT * FROM `CronJob` where Type ='Lead from Zaiper' ORDER BY `CronJob`.`Id`  DESC LIMIT 1000";

 
//echo $sql;

/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
FROM fut_hni");*/


$result = mysqli_query($connect, $sql);

echo('<table id="veiw_Leadstest" class="display" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Type</th>');
  echo('<th>DateTime</th>');
  echo('<th>Count</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
echo('<td>'.$row['Type'].'</td>');
echo('<td>'.$row['DateTime'].'</td>');
echo('<td>'.$row['Count'].'</td>');

}
 echo('</tr>');
echo('</tbody>');
echo('</table>');


?>



</div>

</div>


<?php include('partial/footer.php') ?>
