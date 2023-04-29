<?php
$Mobile=$_GET["Mobile"];
//$Costumer_ID=$_GET["Costumer_ID"];


include('connection/dbconnection_crm.php');

//$sql="SELECT * FROM FolllowUpLeads WHERE Mobile = '".$Mobile_No."'";

$sql="SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i %p' ) AS DateTimeCurrent, Full_Name, Email, Mobile, Disposition, Remark, UserName, DATE_FORMAT( FowllowUpDateTime,  '%d-%m-%Y %h %i %p' ) AS FowllowUpDateTimeReal , State  FROM FolllowUpLeads Where Mobile='".$Mobile."'  ORDER BY  `DateTime` DESC LIMIT 0 , 30";



$result = mysqli_query($connect,$sql);

echo('<table id="Customer_profile" class="display table table-bordered Customer_profile" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th colspan="9" class="brand-color-bg">Follow Up History</th>');
 echo('</tr>');
  echo('<tr>');
  echo('<th>Date_Time</th>');
  echo('<th>Full Name</th>');
  echo('<th>Email</th>');
  echo('<th>Mobile</th>');
  echo('<th>Disposition</th>');
  echo('<th>Remark</th>');
  echo('<th>Agent</th>');
  echo('<th>Fowllow_Up_Date_Time</th>');
  echo('<th>State</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');

while($row = mysqli_fetch_array($result))
  {
  echo('<tr>');
  echo('<td>'.$row['DateTimeCurrent'].'</td>');
  echo('<td>'.$row['Full_Name'].'</td>');
  echo('<td>'.$row['Email'].'</td>');
  echo('<td>'.$row['Mobile'].'</td>');
  echo('<td>'.$row['Disposition'].'</td>');
  echo('<td>'.$row['Remark'].'</td>');
  echo('<td>'.$row['UserName'].'</td>');
  echo('<td>'.$row['FowllowUpDateTimeReal'].'</td>');
  echo('<td>'.$row['State'].'</td>');
  echo('</tr>');
  }
echo "</table>";

mysql_close($con);
?>














