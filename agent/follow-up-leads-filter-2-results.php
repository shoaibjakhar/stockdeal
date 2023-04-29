<?php
$Mobile_No    = $_GET["Mobile_No"];
$StartDateUSA = $_GET["StartDateUSA"];
$EndtDateUSA  = $_GET["EndtDateUSA"];
$username = $_GET["username"];
 
//$Costumer_ID=$_GET["Costumer_ID"];


include('connection/dbconnection_crm.php');

$sql="SELECT id, Full_Name, Email, Mobile, Disposition, Source, State, UserName, DATE_FORMAT( FowllowUpDateTime,  '%d/%m/%Y %h:%i %p' ) AS DateTime  FROM FolllowUpLeads WHERE (FowllowUpDateTime >=  '".$StartDateUSA." 00:00:00') AND (FowllowUpDateTime <=  '".$EndtDateUSA." 23:59:59') AND  `username` =  '".$username."'  AND  NOT `Disposition` = 'NT' AND  NOT `Disposition` = 'NI' AND  NOT `Disposition` = 'CT' AND  NOT `Disposition` = 'LB' AND  NOT `Disposition` = 'DND' AND  NOT `Disposition` = 'WN'  AND  NOT `Disposition` = 'DC' AND  NOT `Disposition` = 'Sale'  ORDER BY  `FolllowUpLeads`.`FowllowUpDateTime` ASC ";


$result = mysqli_query($connect,$sql);

echo('<table id="Customer_profile" class="display table table-bordered Customer_profile rowcount" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th colspan="8" class="brand-color-bg">Follow Up Leads Date wise </th>');
 echo('</tr>');
  echo('<tr>');
echo('<th>Date</th>');
  echo('<th>Full Name</th>');
echo('<th>Mobile</th>');
  //echo('<th>Email</th>');
  echo('<th>Disposition</th>');
  echo('<th>State</th>');
  
  //echo('<th>Agent</th>');
  
  //echo('<th></th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  //echo('<td>'.$row['id'].'</td>');
  echo('<td style="width:100px;">'.$row['DateTime'].'</td>');
  echo('<td>'.$row['Full_Name'].'</td>');
  echo('<td style="display:none;">'.'<input type="text" value="'.$row['Full_Name'].'" class="LeadFull_Name"/>'.'</td>');
  //echo('<td>'.$row['Email'].'</td>');
  //echo('<td style="display:none;">'.'<input type="text" value="'.$row['Email'].'" class="LeadEmail"/>'.'</td>');
  //echo('<td>'.$row['Mobile'].'</td>');
	  echo('<td>'.'<a class="" href="'.'follow-up-leads-filter-2-disposition.php?Mobile='.$row['Mobile'].'Blaster&Disposition=Sale&UserName='.$row['UserName'].'&FollowUpId='.$row['id'].'"><i class="fa fa-phone" aria-hidden="true"></i> '.$row['Mobile'].'</a>');
  //echo('<td style="display:none;">'.'<input type="text" value="'.$row['Mobile'].'" class="LeadMobile"/>'.'</td>');
  
  echo('<td>'.$row['Disposition'].'</td>');
	  echo('<td>'.$row['State'].'</td>');
  //echo('<td>'.$row['UserName'].'</td>');
  
 // echo('<td>'.'<a href="#" class="btn btn-primary update" id="'.$row['Id'].'" data-toggle="modal" data-target="#myModal_1">'.'Update'.'</a>'.'</td>');
  echo('<td style="display:none;">'.'<input type="text" value="'.$row['Id'].'" class="LeadId"/>'.'</td>');
  echo "</tr>";
  }
echo "</table>";

mysql_close($con);

?>







