<?php  include('partial/session_start.php'); ?>


<?php
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
 

 
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
$sql = ("SELECT * FROM `FolllowUpLeads` WHERE DATE(`TimeStamp`) = CURDATE() AND UserName = '$UserName' AND Disposition != 'Fresh' ");

/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
FROM fut_hni");*/


$result = mysqli_query($connect, $sql);

echo('<table id="veiw_Leadstest" class="display" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Full_Name</th>');
  echo('<th>Email</th>');
  echo('<th>Mobile</th>');
  echo('<th>Agent Name</th>');
  echo('<th>Source</th>');
  echo('<th>Disposition</th>');
  echo('<th>Remarks</th>');
    echo('<th>Follow ups Date Time</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
 echo('<td>'.$row['Full_Name'].'</td>');
echo('<td>'.$row['Email'].'</td>');
//echo('<td>'.'<a href="'.'disposition.php?Mobile='.$row['Mobile'].'Blaster&Disposition=Sale&UserName='.$_SESSION['username'].'">'.$row['Mobile'].'</a></td>');
echo('<td>'.$row['Mobile'].'</td>');


 echo('<td>'.$row['UserName'].'</td>');
 echo('<td>'.$row['Source'].'</td>');
 echo('<td>'.$row['Disposition'].'</td>');
 echo('<td>'.$row['Remark'].'</td>');
  echo('<td>'.date( 'd-M-Y', strtotime( $row[ 'TimeStamp' ])).'</td>');
  
 
}
 echo('</tr>');
echo('</tbody>');
echo('</table>');


?>



</div>

</div>


<?php include('partial/footer.php') ?>
