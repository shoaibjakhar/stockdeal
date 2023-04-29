<?php
$username = $_GET["username"];
$Months = $_GET["Months"];
$years = $_GET["years"];


include('connection/dbconnection_crm.php');


  
function getShared($users,$Months,$years){
    global $connect;
     $sql = ("SELECT * FROM Customer_Payment_History where  (Agent = '".$users."' or Agent_1 = '".$users."' or Agent_2 = '".$users."' or Agent_3 = '".$users."')
     && MONTH(  `SaleDate` ) =  $Months AND YEAR(`SaleDate`) = $years AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
    // echo $sql;
    $qrys = mysqli_query($connect, $sql);
    $am = 0;
    while($rows = mysqli_fetch_assoc($qrys)){
    $id = $rows['id'];
   // echo "&nbsp;";
   // echo $rows['Costumer_ID'];
    //echo "<br>";
    
      $sel = "select Agent_1,Agent,Agent_2,Agent_3,Agent_1_Shared_Amount,Agent_2_Shared_Amount,Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";
     $qry = mysqli_query($connect, $sel);
      $row = mysqli_fetch_assoc($qry);
    
         if($users == $row['Agent']){
           $am += $row['Agent_1_Shared_Amount'];  
         }
         else{
        
        if($users != $row['Agent_1']){
           // continue;
        }
        else{
           $am += $row['Agent_1_Shared_Amount']; 
        }
        if($users != $row['Agent_2']){
           // continue;
        }
        else{
            $am += $row['Agent_2_Shared_Amount'];  
        }
        if($users != $row['Agent_3']){
           // continue;
        }
        else{
            $am += $row['Agent_3_Shared_Amount'];  
        }
     }
    
   
    }
     return round($am,0);
   
    
}
 




//echo $sql;


/*
$sql="SELECT Agent, Manager, SUM( Company_Amount ) AS SalesAgentWise , AVG( Company_Amount ) AS AverageSalesAgentWise, 
COUNT( Company_Amount ) AS countSalesAgentWise FROM Customer_profile where Month(SaleDate)='".$Months."' && YEAR(SaleDate)='".$years."' GROUP BY `Agent` ORDER BY `SalesAgentWise` DESC LIMIT 0, 30";
*/



$sql = 'select * from employee where username != "Akshay Shetty" AND username != "Select"  AND username != "Praveen Chhajlane" AND username != "Sudheer Singh"';

$result = mysqli_query($connect, $sql);

echo('<table id="Customer_profile" class="display table table-bordered table-striped table-hover Customer_profile" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Agent</th>');
  //echo('<th>Manager</th>');
  echo('<th>Sales</th>');
  //echo('<th>Average</th>');
 // echo('<th>Count</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');

while($row = mysqli_fetch_array($result))
  {
	$User_Value = getShared($row['username'],$Months,$years);
	
	if($User_Value <= 0) {
		continue;
	}
	
  echo "<tr>";
  echo('<td>'.$row['username'].'</td>');
  //echo('<td>'.$row['Manager'].'</td>');
  echo('<td>'.getShared($row['username'],$Months,$years).'</td>');
 // echo('<td>'.(getShared($row['username'],$Months,$years,'avg')).'</td>');
  //echo('<td>'.getShared($row['username'],$Months,$years,'count').'</td>');
  echo "</tr>";
  }
echo "</table>";

mysql_close($con);
?>













