<?php include('connection/dbconnection_crm.php')?>


<?php

$StartDateUSA = $_GET['StartDateUSA'];
$EndtDateUSA = $_GET['EndtDateUSA'];
$Packages = $_GET['Packages'];

//$sql = ("SELECT  Ideas, Sagment, DATE_FORMAT( DateTime,  '%d-%m-%Y %h : %i %p' ) AS DateTimeCurrent FROM stock_tips ORDER BY  `DateTime` DESC LIMIT 0 , 30");

//$sql = ("SELECT * FROM stock_tips WHERE Date >= '".$StartDate."' AND Date <= '".$EndtDate ."' && `Sagment` ='".$Packages."' limit 30");

$sql = ("SELECT * FROM stock_tips WHERE Date >= '".$StartDateUSA."' AND Date <= '".$EndtDateUSA."' && `Sagment` ='".$Packages."' limit 30");




$result = mysqli_query($connect, $sql);

echo('<table id="Customer_profile" class="display table table-bordered" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr class="brand-color-bg">');
  echo('<th>Date Time</th>');
  echo('<th>Sagment</th>');
  echo('<th>Ideas</th>');
  echo('<th>Results</th>');
  
  echo('</tr>');
echo('</thead>');
echo('<tbody>');
while($row = mysqli_fetch_array($result))
{
echo('<tr>');
  echo('<td>'.$row['TimeStamp'].'</td>');
  echo('<td>'.$row['Sagment'].'</td>');
  echo('<td>'.$row['Ideas'].'</td>');
  echo('<td> <div class="btn '.$row['Result'].'" style="margin-left:10px;margin-right:10px;margin-bottom:10px">'.$row['Result'].'</div></td>');
  }
 echo('</tr>');
echo('</tbody>');
echo('</table>');

?>

<?php include('partial/footer.php') ?>