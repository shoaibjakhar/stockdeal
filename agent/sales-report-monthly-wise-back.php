<?php  include('partial/session_start.php'); ?>
<?php

//$username = $_SESSION["username"];
if(isset($_GET["Months"])){
$Months = $_GET["Months"];
}
$years = $_GET["years"];


//include('connection/dbconnection_crm.php');

function getShared($users,$Months,$years){
    global $connect;
     $sql = ("SELECT * FROM Customer_Payment_History where  (Agent = '".$users."' or Agent_1 = '".$users."' or Agent_2 = '".$users."' or Agent_3 = '".$users."')
     && MONTH(  `SaleDate` ) =  $Months AND YEAR(`SaleDate`) = $years ORDER BY  `Costumer_ID` DESC");
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

for($i=1;$i<=12;$i++){
  echo "<tr>";
  echo('<td>'.date('F',mktime(0,0,0,$i,10)) .'</td>');
  echo('<td>'.getShared($username,$i,$years).'</td>');
 echo "<th>".$years."</th>";
  echo "</tr>";
  }
echo "</table>";

mysqli_close($connect);
?>













