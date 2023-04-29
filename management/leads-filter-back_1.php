<?php
$Mobile_No=$_GET["Mobile_No"];
//$Costumer_ID=$_GET["Costumer_ID"];


include('connection/dbconnection_crm.php');

$sql="SELECT * FROM Assigned_Leads WHERE Mobile = '".$Mobile_No."'";

$result = mysqli_query($connect,$sql);

echo('<table id="Customer_profile" class="display table table-bordered Customer_profile" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Full_Name</th>');
  echo('<th>Email</th>');
  echo('<th>Mobile</th>');
  echo('<th>State</th>');
  echo('<th>Disposition</th>');
  echo('<th>Agent</th>');
  echo('<th>Date</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo('<td>'.$row['Full_Name'].'</td>');
  echo('<td>'.$row['Email'].'</td>');
  echo('<td>'.$row['Mobile'].'</td>');
  echo('<td>'.$row['State'].'</td>');
  echo('<td>'.$row['Disposition'].'</td>');
  echo('<td>'.$row['UserName'].'</td>');
  echo('<td>'.$row['DateTime'].'</td>');
  echo "</tr>";
  }
echo "</table>";

mysqli_close($connect);
?>













