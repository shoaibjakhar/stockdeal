<?php  include('partial/session_start.php'); ?>

<?php


include('connection/dbconnection_crm.php');

$result_update = mysqli_query($connect,"UPDATE employee SET read_notification=1 where username = '$username' ");
//echo $result_update;
?>


<?php
if(isset($_GET['UserName']) && $_GET['Source'] && $_GET['Disposition']){
 $UserName = $_GET['UserName'];
 //echo $UserName; exit;
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
}
 
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
<a href="memberpage.php">Dashbord</a> | <a href="stock-tips.php" class="btn btn-xs btn-primary">Stock Tips</a> | <a href="stock-tips-filter.php">Filter 3</a>  | <a href="stock-tips-filter_2.php">Filter 4</a> | <a href="stock-tips-update.php">Today's Update</a> | <a href="stock-tips-update-3month.php">Last 3 Months's Update</a> | <a href="stock-tips-update-open.php">Open</a>
 </div>
 <!-- <div class="pull-right"><a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a></div> -->
 <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">




<?php
$sql = ("SELECT Id, Ideas, Sagment, Result, DATE_FORMAT( DateTime,  '%d-%m-%Y %H : %i %p' ) AS DateTimeCurrent FROM stock_tips WHERE DATE( CURDATE( ) ) = DATE( DateTime) ORDER BY `stock_tips`.`DateTime` DESC");
$result = mysqli_query($connect, $sql);
echo('<form action="aa.php" method="post">');
echo('<table id="Customer_profile" class="display table table-bordered" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr class="brand-color-bg">');
  echo('<th>Date Time</th>');
  echo('<th>Sagment</th>');
  
  echo('<th>Result</th>');
  echo('<th>Ideas</th>');
   //echo('<th>Ideas</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
  echo('<td>'.$row['DateTimeCurrent'].'</td>');
  echo('<td>'.$row['Sagment'].'</td>');
  echo('<td> <div class="btn '.$row['Result'].'" style="margin-top:10px;margin-left:10px;margin-right:10px">'.$row['Result'].'</div></td>');
  echo('<td>'.$row['Ideas'].'</td>');
  
 // echo('<td><input type="hidden" value="'.$row['Id'].'"'. 'class="id"/>'.'<a href="#_"' . 'class="btn btn-danger">Delete</a>'.'</td>');
  }
 echo('</tr>');
echo('</tbody>');
echo('</table>');
echo('</form>');
?>



</div>

</div>



<?php include('partial/footer.php') ?>




