<?php  include('partial/session_start.php'); ?>
<?php
error_reporting(E_ALL);
// session_start();
 //$username = $_SESSION['username'];
 //echo $username;

//include('partial/validate-user.php');
?>

<?php
if(isset($_GET['UserName']) && isset($_GET['Source']) && isset($_GET['Disposition'])){
 $UserName = $_GET['UserName'];
 $Source = $_GET['Source'];
 $Disposition = $_GET['Disposition'];
}


 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sales Agent Wise</title>
<?php require('partial/plugins.php'); ?>
<style>

.dataTables_filter { display:none;}
</style>
</head>
<body>

 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">
<a href="sales-agent-wise.php">Sales Agent Wise</a> | <a href="sales-agent-report.php">Monthly Report</a> | <a href="sales-report-monthly-wise.php">Yearly Report</a></div>
<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>





<?php

function getShared($users){
    global $connect;
     $sql = ("SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_Payment_History where  (Agent = '".$users."' or Agent_1 = '".$users."' or Agent_2 = '".$users."' or Agent_3 = '".$users."') && MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
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
     // print"<pre>";
     // print_r($row);
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
    // echo $am;
     return $am;
    
}

//echo getShared('Avinash Gaikwad');


$sel = "select * from employee where Status = 'Active' AND username !='Akshay Shetty' AND username !='Sudheer Singh' AND username !='Select'  AND username !='Praveen Chhajlane' AND username !='compliance officer' AND Role !='Team Leader'";
$qry = mysqli_query($connect, $sel);



$i = 0;

while($rows = mysqli_fetch_assoc($qry)){
     //$sql ="select Agent, Manager, SUM( Company_Amount ) AS SalesAgentWise , AVG( Company_Amount ) AS AverageSalesAgentWise, COUNT( Company_Amount ) AS countSalesAgentWise FROM Customer_profile where MONTH( `SaleDate` ) = MONTH(LAST_DAY(NOW() - INTERVAL 1 MONTH) ) AND YEAR( `SaleDate` ) = YEAR( CURDATE( ) ) and Agent = '".$rows['username']."'"; 
     // $sql ="select Agent, Manager, SUM( Company_Amount ) AS SalesAgentWise , AVG( Company_Amount ) AS AverageSalesAgentWise, COUNT( Company_Amount ) AS countSalesAgentWise FROM
      //Customer_profile where MONTH( `SaleDate` ) = MONTH(CURDATE( ))  AND YEAR( `SaleDate` ) = YEAR( CURDATE( ) ) and Agent = '".$rows['username']."'"; 
      
   // $qrys = mysqli_query($connect, $sql);
    //$all_data = mysqli_fetch_assoc($qrys);
    // echo $rows['username'];
    // echo getShared($rows['username']);
    // die();
    $all_data['SalesAgentWise'] = getShared($rows['username']);
    
     $get_data[$i] = $all_data;
     $get_data[$i]['Sale_Target'] = $rows['Sale_Target'];
     $get_data[$i]['Id'] = $rows['Id'];
     $get_data[$i]['Agent'] =  $rows['username'];
     
     // this if commented by ahsan becuse agent name are missing in table due to this if
    // if($all_data['SalesAgentWise'] != '' || $all_data['SalesAgentWise'] != NULL){
    //   $get_data[$i]['Agent'] =  $rows['username'];
        
    // }
    $i++;
    //$users[] = $rows;   
}


function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}


array_sort_by_column($get_data, 'SalesAgentWise');


// print"<pre>";
// print_r($get_data);


//$sql = "SELECT Agent, Manager, SUM( Company_Amount ) AS SalesAgentWise FROM Customer_profile GROUP BY `Agent` ORDER BY `SalesAgentWise` DESC LIMIT 0, 30 ";

/*
$sql ="SELECT Agent, Manager,  SUM( Company_Amount ) AS SalesAgentWise , AVG( Company_Amount ) AS AverageSalesAgentWise, COUNT( Company_Amount ) AS countSalesAgentWise FROM Customer_profile where MONTH(  `SaleDate` ) = MONTH( CURDATE( ) ) 
AND YEAR(  `SaleDate` ) = YEAR( CURDATE( ) )   GROUP BY `Agent` ORDER BY `SalesAgentWise` DESC LIMIT 0, 30"; 
*/
//$sql ="SELECT Agent, Manager, SUM( Company_Amount ) AS SalesAgentWise , AVG( Company_Amount ) AS AverageSalesAgentWise, COUNT( Company_Amount ) AS countSalesAgentWise FROM Customer_profile where MONTH( `SaleDate` ) = MONTH(LAST_DAY(NOW() - INTERVAL 1 MONTH) ) AND YEAR( `SaleDate` ) = YEAR( CURDATE( ) ) GROUP BY `Agent` ORDER BY `SalesAgentWise` DESC LIMIT 0, 30"; 




/*$sql ="SELECT Agent, Manager, SUM( Company_Amount ) AS SalesAgentWise , AVG( Company_Amount ) AS AverageSalesAgentWise, COUNT( Company_Amount ) AS countSalesAgentWise FROM Customer_profile GROUP BY `Agent` ORDER BY `SalesAgentWise` DESC LIMIT 0, 30 ";*/


/*$sql = ("SELECT Costumer_ID, FirstName, LastName, Email_ID, Mobile_No, Location, PackageName, DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , Remark, Company_Amount, Balance_amount, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DateTime FROM Customer_profile");*/

//$sql = ("SELECT * FROM  `Assigned_Leads` where  (UserName = '".$UserName."') && (Source = '".$Source."') && (Disposition = '".$Disposition."')");

/*$sql = ("SELECT DATE_FORMAT( DateTime,  '%d-%m-%Y' ) AS DATE, Scrip, CMP, Target, Exit_Price, Investment, Shares_Lot_Size, Profit_Loss, Margin
FROM fut_hni");*/


$result = mysqli_query($connect, $sql);
$total_sales = 0;
$total_achive =0;
$total_commit = 0;
foreach($get_data as $row){
    $total_sales += $row['SalesAgentWise'];
     
    
    // $total_achive += $per;
     $total_commit += $row['Sale_Target'];
    $ach[] =$row;
}
?>








<?php
echo('<table id="SalesAgentWise" class="display table table-border table-striped cell-border" cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th style="text-align:center">Rank</th>');
 
  echo('<th style="text-align:center">Agent</th>');
  echo('<th style="text-align:center">Sales</th>');
   echo('<th style="text-align:center">Achievement</th>');
    echo('<th style="text-align:center">Commitment</th>');


   
 echo('</tr>');
echo('</thead>');
echo('<tbody>');

foreach($get_data as $key => $row){

     echo"<tr>";

 echo('<td style="text-align:center">'.($key + 1 ).'</td>');
  
 echo('<td style="text-align:center">'.$row['Agent'].'</td>');
  echo('<td style="text-align:center">'.round($row['SalesAgentWise'], 2).'</td>');
  $per = round($row['SalesAgentWise']/$row['Sale_Target']*100,0);
  if($per >=0 && $per<=40){
     echo('<td style="color:#fff;background:#e74c3c;font-size:15px;font-weight:bold;text-align:center">'.$per.'% </td>'); 
  }
  else if($per>41 && $per<=70){
       echo('<td style="color:#333333;background:#ffdf5c;font-size:15px;font-weight:bold;text-align:center">'.$per.'% </td>'); 
  }
  
  else {
      echo('<td style="color:#fff;background:#27ae60;font-size:15px;font-weight:bold;text-align:center"> '.$per.'% </td>');
      //continue;
  }

 echo('<td style="text-align:center">'.$row['Sale_Target'].'</td>');


	
	  echo('</tr>');
 
}
 

echo('</tbody>');
echo('</table>');









/*
foreach ($ach as $row)
{
    $sel = 'select * from employee where username = "'.$row['Agent'].'"';
    $qry = mysqli_query($connect, $sel);
    $fetch = mysqli_fetch_assoc($qry);
     $per = round($row['SalesAgentWise']/$fetch['Sale_Target']*100,0);
   //echo "<br>";
 echo"<tr>";

 echo('<td style="text-align:center"></td>');
  
 echo('<td style="text-align:center">'.$row['Agent'].'</td>');
 echo('<td style="text-align:center">'.round($row['SalesAgentWise'], 2).'</td>');
 
  if($per>0 && $per<=40){
     echo('<td style="color:#fff;background:#e74c3c;font-size:15px;font-weight:bold;text-align:center">'.$per.'% </td>'); 
  }
  else if($per>41 && $per<=70){
       echo('<td style="color:#333333;background:#ffdf5c;font-size:15px;font-weight:bold;text-align:center">'.$per.'% </td>'); 
  }
  
  else {
      echo('<td style="color:#fff;background:#27ae60;font-size:15px;font-weight:bold;text-align:center"> '.$per.'% </td>');
      //continue;
  }

 echo('<td style="text-align:center">'.$fetch['Sale_Target'].'</td>');
  echo('<td style="text-align:center"><a href="#_" class="btn btn-primary upDateCommit" data-update-val="'.$fetch['Sale_Target']."&".$row['Agent']."&".$fetch['Id'].'" >Update</a></td>');
	echo('<td style="text-align:center">'.$row['Manager'].'</td>');
 
}
 echo('</tr>');
echo('</tbody>');
echo('</table>');
*/


?>




	<table class="table table-bordered pull-right" cellspacing="0" cellpadding="0" style="width:500px;font-weight:bold;text-align:center;margin-top:30px;">
  <tbody>
        <tr>
      <td colspan="3" class="text-center">Team Score</td>
     
    </tr>
    <tr>
      <td>Sales</td>
      <td>Achievement</td>
      <td>Commitment</td>
    </tr>
    <tr>
      <td> <?php echo round($total_sales,2); ?></td>
     <?php 
      
        $pp = round($total_sales/$total_commit*100,0);
        
         if($pp>0 && $pp<=40){
     echo('<td style="color:#fff;background:#e74c3c;font-size:15px;font-weight:bold;text-align:center">'.$pp.'% </td>'); 
  }
  else if($pp>41 && $pp<=70){
       echo('<td style="color:#333333;background:#ffdf5c;font-size:15px;font-weight:bold;text-align:center">'.$pp.'% </td>'); 
  }
  
  else {
      echo('<td style="color:#fff;background:#27ae60;font-size:15px;font-weight:bold;text-align:center"> '.$pp.'% </td>');
      //continue;
  }
      
      ?>
      <td><?php echo $total_commit; ?></td>
    </tr>
  </tbody>
</table>

</div>

</div>



<script>
    $(document).ready(function(){
        $(".upDateCommit").click(function(){
            $("#UpdateSaleTarget").modal('show');
            var updatesval = $(this).attr("data-update-val");
            var Exp = updatesval.split("&");
            var Target = (Exp[0]);
            var Agent = Exp[1];
            $("#agent_val").text(Agent);
            $("#updates_val").val(Target);
            $("#updates_val_id").val(Exp[2]);
            
        })
        $("#Update_Commit_Form").submit(function(e){
            e.preventDefault;
            var formData = $("#Update_Commit_Form").serialize();
           $.ajax({
               type:"post",
               url:"Ajax_files/Update_Commit.php",
               data:formData,
               success:function(datas){
                  // console.log(datas);
                  window.location.reload();
               }
               
           })
        })
    })
</script>

<?php include('partial/footer.php') ?>
