<?php  include('partial/session_start.php'); ?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Quality and Attendance Policy</title>
<?php require('partial/plugins.php'); ?>
</head>
<body>
<?php include('partial/sidebar.php') ?>
<div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>
  </header>
  <div class="breadcurms"> <?php if($_SESSION['Role'] != 'Customer Care'){ ?><a href="news-and-updates.php">News and Updates</a> |<?php } ?> <a href="quality-analysis.php">Quality & Compliance</a> | <a href="quality-analysis-others.php"   class="btn btn-xs btn-primary"> Others</a></div>
  <div class="containter" style="padding:20px 20px 0 20px;">
    <?php include('connection/dbconnection_crm.php')?>
 
<?php
$sql = ("SELECT Quality_Others_Column_1, Quality_Others_Column_2 FROM `Options` where Quality_Others_Column_2 IS NOT NULL");
$result = mysqli_query($connect, $sql);

echo('<table cellspacing="0" cellpadding="0" class="table table-bordered">');
echo('<tbody>');
 echo('<tr  class="brand-color-bg">');

  
  echo('<th>CRM</th>');
  echo('<th>OTHERS</th>');

  echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
  echo('<td>'.$row['Quality_Others_Column_1'].'</td>');
  echo('<td>'.$row['Quality_Others_Column_2'].'</td>');

  
 // echo('<td><input type="hidden" value="'.$row['Id'].'"'. 'class="id"/>'.'<a href="#_"' . 'class="btn btn-danger">Delete</a>'.'</td>');
  }
 echo('</tr>');
echo('</tbody>');
echo('</table>');

?>

    

	  

    
  </div>
</div>
<?php include('partial/footer.php') ?>
