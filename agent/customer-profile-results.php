<?php
$Mobile_No=$_GET["Mobile_No"];
//$Costumer_ID=$_GET["Costumer_ID"];


include('connection/dbconnection_crm.php');

//$sql="SELECT * FROM customer_profile WHERE Mobile_No  = '".$Mobile_No."' or Costumer_ID  = '".$Mobile_No."'";

$sql="SELECT * FROM Customer_profile WHERE Mobile_No = '".$Mobile_No."'";

$result = mysqli_query($connect,$sql);

echo('<table id="Customer_profile" class="display table table-bordered Customer_profile" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Costumer ID</th>');
  echo('<th>First Name</th>');
  echo('<th>Last Name</th>');
  echo('<th>Email ID</th>');
  echo('<th>Mobile No</th>');
  echo('<th>Location</th>');
  echo('<th>Package_Name</th>');
  echo('<th>Activation Date</th>');
  echo('<th>Exp_Date</th>');
  echo('<th >Remark_for_FollowUps</th>');
 echo('<th>Total Amount Received</th>');
  echo("<th>Company's Amout</th>");
  echo('<th>Tax</th>');
  echo('<th>Agent</th>');
  echo('<th>Manager</th>');
  echo('<th>Date_Time</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
   echo('<td>'.$row['Costumer_ID'].'</td>');
   echo('<td>'.$row['FirstName'].'</td>');
   echo('<td>'.$row['LastName'].'</td>');
   echo('<td>'.$row['Email_ID'].'</td>');
   echo('<td>'.$row['Mobile_No'].'</td>');
   echo('<td>'.$row['Location'].'</td>');
   echo('<td>'.$row['PackageName'].'</td>');
   echo('<td>'.$row['Activation_Date'].'</td>');
   echo('<td>'.$row['Exp_Date'].'</td>');
   echo('<td >'.$row['Remark'].'</td>');
  echo('<td >'.$row['Paid_Amout'].'</td>');
 echo('<td >'.$row['Company_Amount'].'</td>');
 echo('<td>'.$row['Tax_Amount'].'</td>');
   echo('<td>'.$row['Agent'].'</td>');
   echo('<td>'.$row['Manager'].'</td>');
   echo('<td>'.$row['DateTime'].'</td>');
  echo "</tr>";
  }
echo "</table>";

mysql_close($con);
?>













