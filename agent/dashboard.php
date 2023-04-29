<?php  include('partial/session_start.php'); 
  // echo $_SESSION["Id"];
  // die();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>
<?php require('partial/plugins.php'); ?>

</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">
 <a href="#">Dashbord</a>
 
</div>

<div class="containter" style="padding:20px 20px 0 20px;">
 <?php //include('connection/dbconnection_crm.php');
 
 
 
 
 
 
function getSharedCount($users,$types){
    global $connect;
     $sql = ("SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName, 
     DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status ,
     Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  
     FROM Customer_Payment_History where  (Agent = '".$users."' or Agent_1 = '".$users."' or Agent_2 = '".$users."' or Agent_3 = '".$users."') and SaleDate = '".date('Y-m-d')."' AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
    $qrys = mysqli_query($connect,$sql);
    $am = 0;
     if($types == 'amounts'){
    while($rows = mysqli_fetch_assoc($qrys)){
    $id = $rows['id'];
   // echo "&nbsp;";
   // echo $rows['Costumer_ID'];
    //echo "<br>";
    
      $sel = "select Agent_1,Agent,Agent_2,Agent_3,Agent_1_Shared_Amount,Agent_2_Shared_Amount,Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";
     $qry = mysqli_query($connect,$sel);
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
     return $am;
    }
    else{
        $counts = [];
      while($rows = mysqli_fetch_assoc($qrys)){
          $counts[] = $rows['id'];
      }
      return count($counts);
    }
    // echo $am;
     
    
}
 
 
 
  
function getShared($users,$types = ''){
    global $connect;
     $sql = ("SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_Payment_History where  (Agent = '".$users."' or Agent_1 = '".$users."' or Agent_2 = '".$users."' or Agent_3 = '".$users."') && MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
    $qrys = mysqli_query($connect,$sql);
    $am = 0;
     if($types == ''){
    while($rows = mysqli_fetch_assoc($qrys)){
    $id = $rows['id'];
   // echo "&nbsp;";
   // echo $rows['Costumer_ID'];
    //echo "<br>";
    
      $sel = "select Agent_1,Agent,Agent_2,Agent_3,Agent_1_Shared_Amount,Agent_2_Shared_Amount,Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";
     $qry = mysqli_query($connect,$sel);
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
     return round($am,0);
    }
    else{
        $counts = [];
      while($rows = mysqli_fetch_assoc($qrys)){
          $counts[] = $rows['id'];
      }
      return count($counts);
    }
    
}
 
 
 
 ?>
 
 
<div class="row">
  
 <div class="col-sm-4">
 
 <div class="panel panel-primary">
  <div class="panel-heading">Sales Reports</div>
  <div class="panel-body">
      <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><strong>Today's Sale</strong></td>
      <td style="width:140px"><strong><?php echo getSharedCount($username,'counts');
	   ?></strong></td>
    </tr>
    <tr>
      <td><strong>Today's Sale Amount</strong></td>
      <td><strong>Rs  <?php echo getSharedCount($username,'amounts');
	   ?></strong></td>
    </tr>
    <tr>
      <td><strong>This Month Sale</strong></td>
      <td><strong><?php  echo getShared($username,'counts');
	   ?></strong></td>
    </tr>
    <tr>
      <td><strong>This Month Sale's Amount</strong></td>
      <td><strong>Rs <?php
     
      
       echo getShared($username);
 
	   ?></strong></td>
    </tr>
  </tbody>
</table>
  </div>
</div>
 

 </div>
  <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading font-size18">Stock Tips Reports</div>
          <div class="panel-body">
            <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td>&nbsp;</td>
                  <td style="background:#3498db;color:#fff;"><strong>Open</strong></td>
                  <td style="background:#27ae60;color:#fff;"><strong>Positive</strong></td>
                  <td style="background:#e74c3c;color:#fff;"><strong>Nagetive</strong></td>
                </tr>
                <tr>
                  <td><strong>Today's</strong></td>
                  <td style="background:#3498db;color:#fff;">
                 
                 
                 <?php

		$result = mysqli_query($connect,"SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Open') AND (`Date` = CURDATE())");

         echo mysqli_result($result, 0);

	   ?>
                 
                  </td>
                  <td style="background:#27ae60;color:#fff;">
                  <?php

		$result = mysqli_query($connect,"SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Positive') AND (`Date` = CURDATE())");

         echo mysqli_result($result, 0);

	   ?>
                  
                  </td>
                  <td style="background:#e74c3c;color:#FFF;">
                   <?php

		$result = mysqli_query($connect,"SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Nagitive') AND (`Date` = CURDATE())");

         echo mysqli_result($result, 0);

	   ?>
                  </td>
                </tr>
                <tr>
                  <td><strong>This week</strong></td>
                  <td style="background:#3498db;color:#fff;"> <?php

		$result = mysqli_query($connect,"SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Open') AND YEARWEEK(`TimeStamp`, 1) = YEARWEEK(CURDATE(), 1) ORDER BY TimeStamp DESC");

         echo mysqli_result($result, 0);

	   ?></td>
                  <td style="background:#27ae60;color:#fff;"><?php

		$result = mysqli_query($connect,"SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Positive') AND YEARWEEK(`TimeStamp`, 1) = YEARWEEK(CURDATE(), 1) ORDER BY TimeStamp DESC");

         echo mysqli_result($result, 0);

	   ?></td>
                  <td style="background:#e74c3c;color:#fff;"><?php

		$result = mysqli_query($connect,"SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Nagitive') AND YEARWEEK(`TimeStamp`, 1) = YEARWEEK(CURDATE(), 1) ORDER BY TimeStamp DESC");

         echo mysqli_result($result, 0);

	   ?></td>
                </tr>
                <tr>
                  <td><strong>This Month</strong></td>
                  <td style="background:#3498db;color:#fff;">
                  <?php

		$result = mysqli_query($connect,"SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Open') AND (MONTH(TimeStamp) = MONTH(CURDATE()) AND YEAR(TimeStamp) = YEAR(CURDATE()))ORDER BY TimeStamp DESC ");

         echo mysqli_result($result, 0);

	   ?>
               </td>
                  <td style="background:#27ae60;color:#fff;">      <?php

		$result = mysqli_query($connect,"SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Positive') AND (MONTH(TimeStamp) = MONTH(CURDATE()) AND YEAR(TimeStamp) = YEAR(CURDATE()))ORDER BY TimeStamp DESC ");

         echo mysqli_result($result, 0);

	   ?></td>
                  <td style="background:#e74c3c;color:#fff;"><?php

		$result = mysqli_query($connect,"SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Nagitive') AND (MONTH(TimeStamp) = MONTH(CURDATE()) AND YEAR(TimeStamp) = YEAR(CURDATE()))ORDER BY TimeStamp DESC ");

         echo mysqli_result($result, 0);

	   ?></td>
                </tr>
                <tr>
                  <td><strong>Total</strong></td>
                  <td style="background:#3498db;color:#fff;"><?php

		$result = mysqli_query($connect,"SELECT COUNT(`Result`) FROM stock_tips WHERE Result =  'Open'");

         echo mysqli_result($result, 0);

	   ?></td>
                  <td style="background:#27ae60;color:#fff;"><?php

		$result = mysqli_query($connect,"SELECT COUNT(`Result`) FROM stock_tips WHERE Result =  'Positive'");

         echo mysqli_result($result, 0);

	   ?></td>
                  <td style="background:#e74c3c;color:#fff;"><?php

		$result = mysqli_query($connect,"SELECT COUNT(`Result`) FROM stock_tips WHERE Result =  'Nagitive'");
		
		
		

		

         echo mysqli_result($result, 0);

	   ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

   <div class="col-sm-4" style="display:none">  
        <div class="panel panel-primary">
          <div class="panel-heading font-size18">Discount Coupouns</div>
          <div class="panel-body" style="height: 250px; overflow: auto">
          	<table class="table table-bordered">
  <tbody>
    <tr>
      <td>5 Percent</td>
      <td>RSI5<?php echo date("dm")?>97</td>
    </tr>
    <tr>
      <td>10 Percent</td>
      <td>RSI0<?php echo date("dy")?>22</td>
    </tr>
    <tr>
     <td>15 Percent</td>
     <td>RSI5<?php echo date("md")?>27</td>
    </tr>
    <tr>
     <td>20 Percent</td>
     <td>RS20<?php echo date("dy")?>44</td>
    </tr>
    <tr>
     <td>25 Percent</td>
     <td>RS25<?php echo date("dy")?>05</td>
    </tr>
    <tr>
     <td>30 Percent</td>
     <td>RS30<?php echo date("yd")?>23</td>
    </tr>
    <tr>
      <td>35 Percent</td>
      <td>RS35<?php echo date("mdy")?></td> 
    </tr>
    <tr>
      <td>40 Percent</td>
      <td>RS40<?php echo date("dm")?>96</td> 
    </tr>
    <tr>
      <td>45 Percent</td>
      <td>RS45<?php echo date("dym")?></td>
    </tr>
    <tr>
      <td>50 Percent</td>
      <td>RS50<?php echo date("dy")?>11</td>
    </tr>
  </tbody>
</table>
          </div>
        </div>
     
 </div>

	
			
	<div class="col-sm-4">
	
		
		
		<div class="panel panel-primary">
  <div class="panel-heading">Demo Stock Tips Login Details</div>
  <div class="panel-body">
    
	  
<?php
	
$sql="SELECT  User, Password FROM Demo_Clients";	
	
	
$result = mysqli_query($connect,$sql);

echo('<table id="FollowUpLeadTable" class=" table table-bordered " cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Client Names</th>');
  echo('<th>Password</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');

$row = mysqli_fetch_assoc($result);
while($row)
  {
  echo '<tr>';
   echo('<td style="width:50%;">'.$row['User'].'</td>');
	echo('<td style="width:50%;">'.$row['Password'].'</td>');
   echo "</tr>";
  }
echo "</table>";

mysqli_close($connect);
?>

		
	  
  </div>
</div>
		
		
		

	</div>
	
	</div>

<div class="clearfix"></div>

<?php
    if($_SESSION['Role'] == 'Customer Care'){
        
        function CountAgentRequest($Agent_Name,$status){
            $sel = "SELECT COUNT(*) AS cn FROM Agent_request WHERE (Agent = '".$Agent_Name."' OR ToWhom = '".$Agent_Name."') AND Status = '".$status."'";
            $qry = mysqli_query($connect ,$sel);
            $fetch = mysqli_fetch_assoc($qry);
            return $fetch['cn']?$fetch['cn']:0;
        }
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Agent Requests Status Count</div>
            <div class="panel-body">
                <table class="table table-bordered" id="Customer_profile">
                    <thead>
                        <tr>
                            <th>Agent Name</th>
                            <th>Open</th>
                            <th>In Progress</th>
                            <th>Close</th>
                            <th>Decline</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sel = "SELECT username FROM employee WHERE Role = 'Agent' AND Status = 'Active' ORDER BY username ASC";
                            $qry = mysqli_query($connect,$sel);
                            while($fetch = mysqli_fetch_assoc($qry)){
                        ?>
                        <tr>
                            <td><?php echo $fetch['username']; ?></td>
                            <td><?php echo CountAgentRequest($fetch['username'],'Open'); ?></td>
                            <td><?php echo CountAgentRequest($fetch['username'],'In Progress'); ?></td>
                            <td><?php echo CountAgentRequest($fetch['username'],'Close'); ?></td>
                            <td><?php echo CountAgentRequest($fetch['username'],'Decline'); ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
}
?>

</div>

</div>




<?php include('partial/footer.php') ?>
