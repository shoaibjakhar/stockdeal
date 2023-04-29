<?php
$username = $_GET["username"];
$Months = $_GET["Months"];
$years = $_GET["years"];


include('connection/dbconnection_crm.php');

$sql = "select  sum( case when Agent_1_Shared_Amount IS NULL THEN 0 ELSE Agent_1_Shared_Amount END + case when Agent_2_Shared_Amount IS NULL THEN 0 ELSE Agent_2_Shared_Amount END +case when Agent_3_Shared_Amount IS NULL THEN 0 ELSE Agent_3_Shared_Amount END) as Total,MONTH(SaleDate) as Months from Customer_Payment_History ";

if($years){
   
       $sql .= " where YEAR(SaleDate) = $years";  
   
}

$sql .= ' group by month(SaleDate) ORDER BY `Months` ASC';
$qry = mysqli_query($connect, $sql);


//echo $sql;

//$sql="SELECT SUM( Company_Amount ) AS Total_Sale_Month_Wise, MONTH(SaleDate) as Months FROM Customer_profile where YEAR(SaleDate)='".$years."' group by month(SaleDate) ORDER BY `Months` ASC";

//$result = mysqli_query($connect, $sql);

echo('<table id="Customer_profile" class="display table table-bordered table-striped table-hover Customer_profile" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Month</th>');
  echo('<th>Total Sale Month Wise</th>');
  echo('<th>Year</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');

while($row = mysqli_fetch_assoc($qry)){
  echo "<tr>";
  echo('<td>'.date('F',mktime(0,0,0,$row['Months'],10)) .'</td>');
  echo('<td>'.round($row['Total'],0).'</td>');
 echo "<th>".$years."</th>";
  echo "</tr>";
  }
echo "</table>";

mysqli_close($connect);
?>













