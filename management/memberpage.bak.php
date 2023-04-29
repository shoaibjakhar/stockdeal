<?php  include('partial/session_start.php'); ?>

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
  <div class="breadcurms"> <a href="#">Dashbord</a> </div>
  <div class="containter" style="padding:20px 20px 0 20px;">
    <?php include('connection/dbconnection_crm.php');
    
     
 
 
function getSharedByTeamLeader($users){

    global $connect;
    //global $username;
    $sql = ("SELECT id,Costumer_ID,Agent,Agent_1,Agent_1_Shared_Amount,Agent_2,Agent_2_Shared_Amount,Agent_3,Agent_3_Shared_Amount, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_Payment_History where MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
   // echo '<br>';
    $qrys = mysqli_query($connect, $sql);

    $am = 0;

    while($rows = mysqli_fetch_assoc($qrys)){

    $id = $rows['id'];

    
    if($rows['Agent_1'] != ''){
        $Agents = $rows['Agent_1'];
        $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
        $qry = mysqli_query($connect, $sel);
        $fetch = mysqli_fetch_assoc($qry);
        if($fetch){
            // $sel = "select Agent_1, Agent_1_Shared_Amount from Customer_Payment_History where id = '$id'";
             //$qry = mysqli_query($connect, $sel);
             //$fetch_data = mysqli_fetch_assoc($qry);
             $am += $rows['Agent_1_Shared_Amount'];
        }
    }
    if($rows['Agent_2'] != ''){
       $Agents = $rows['Agent_2'];
        $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
        $qry = mysqli_query($connect, $sel);
        $fetch = mysqli_fetch_assoc($qry);
        if($fetch){
             $sel = "select Agent_2, Agent_2_Shared_Amount from Customer_Payment_History where id = '$id'";
             //$qry = mysqli_query($connect, $sel);
             //$fetch_data = mysqli_fetch_assoc($qry);
             $am += $rows['Agent_2_Shared_Amount'];
        }
    }
    if($rows['Agent_3'] != ''){
        $Agents = $rows['Agent_3'];
        $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
        $qry = mysqli_query($connect, $sel);
        $fetch = mysqli_fetch_assoc($qry);
        if($fetch){
             //$sel = "select Agent_3, Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";
             //$qry = mysqli_query($connect, $sel);
            // $fetch_data = mysqli_fetch_assoc($qry);
             $am += $rows['Agent_3_Shared_Amount'];
        }
    }

   

    }

    // echo $am;

     return $am;

    

}


function getSharedByTeamLeaderLastMonth($users){

    global $connect;
    //global $username;
    $sql = ("SELECT id,Costumer_ID,Agent,Agent_1,Agent_1_Shared_Amount,Agent_2,Agent_2_Shared_Amount,Agent_3,Agent_3_Shared_Amount, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_Payment_History where MONTH(  `SaleDate` ) = MONTH( CURDATE( ) - INTERVAL 1 MONTH) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
   // echo '<br>';
    $qrys = mysqli_query($connect, $sql);

    $am = 0;

    while($rows = mysqli_fetch_assoc($qrys)){

    $id = $rows['id'];

   // echo "&nbsp;";

   // echo $rows['Costumer_ID'];

    //echo "<br>";
    
    if($rows['Agent_1'] != ''){
        $Agents = $rows['Agent_1'];
        $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
        $qry = mysqli_query($connect, $sel);
        $fetch = mysqli_fetch_assoc($qry);
        if($fetch){
            // $sel = "select Agent_1, Agent_1_Shared_Amount from Customer_Payment_History where id = '$id'";
             //$qry = mysqli_query($connect, $sel);
             //$fetch_data = mysqli_fetch_assoc($qry);
             $am += $rows['Agent_1_Shared_Amount'];
        }
    }
    if($rows['Agent_2'] != ''){
       $Agents = $rows['Agent_2'];
        $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
        $qry = mysqli_query($connect, $sel);
        $fetch = mysqli_fetch_assoc($qry);
        if($fetch){
             $sel = "select Agent_2, Agent_2_Shared_Amount from Customer_Payment_History where id = '$id'";
             //$qry = mysqli_query($connect, $sel);
             //$fetch_data = mysqli_fetch_assoc($qry);
             $am += $rows['Agent_2_Shared_Amount'];
        }
    }
    if($rows['Agent_3'] != ''){
        $Agents = $rows['Agent_3'];
        $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
        $qry = mysqli_query($connect, $sel);
        $fetch = mysqli_fetch_assoc($qry);
        if($fetch){
             //$sel = "select Agent_3, Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";
             //$qry = mysqli_query($connect, $sel);
            // $fetch_data = mysqli_fetch_assoc($qry);
             $am += $rows['Agent_3_Shared_Amount'];
        }
    }

    

    }

    // echo $am;

     return $am;

    

}








 
function getSharedByTeamLeaderCount(){

    global $connect;
    //global $username;
     $sql = ("SELECT id,Costumer_ID,Agent,Agent_1,Agent_1_Shared_Amount,Agent_2,Agent_2_Shared_Amount,Agent_3,Agent_3_Shared_Amount, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_Payment_History where MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
   // echo '<br>';
    $qrys = mysqli_query($connect, $sql);

    $am = 0;
    
    $sel = "select Team_Leader from employee where Team_Leader != '' group by Team_Leader";
                    $qry = mysqli_query($connect, $sel);
                    $total_calculation = 0;
                    while($row = mysqli_fetch_assoc($qry)){
                        $users = $row['Team_Leader'];
                         while($rows = mysqli_fetch_assoc($qrys)){

                                $id = $rows['id'];
                            
                               // echo "&nbsp;";
                            
                               // echo $rows['Costumer_ID'];
                            
                                //echo "<br>";
                                
                                if($rows['Agent_1'] != ''){
                                    $Agents = $rows['Agent_1'];
                                    $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
                                    $qry = mysqli_query($connect, $sel);
                                    $fetch = mysqli_fetch_assoc($qry);
                                    if($fetch){
                                        // $sel = "select Agent_1, Agent_1_Shared_Amount from Customer_Payment_History where id = '$id'";
                                         //$qry = mysqli_query($connect, $sel);
                                         //$fetch_data = mysqli_fetch_assoc($qry);
                                         $am += $rows['Agent_1_Shared_Amount'];
                                    }
                                }
                                if($rows['Agent_2'] != ''){
                                   $Agents = $rows['Agent_2'];
                                    $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
                                    $qry = mysqli_query($connect, $sel);
                                    $fetch = mysqli_fetch_assoc($qry);
                                    if($fetch){
                                         $sel = "select Agent_2, Agent_2_Shared_Amount from Customer_Payment_History where id = '$id'";
                                         //$qry = mysqli_query($connect, $sel);
                                         //$fetch_data = mysqli_fetch_assoc($qry);
                                         $am += $rows['Agent_2_Shared_Amount'];
                                    }
                                }
                                if($rows['Agent_3'] != ''){
                                    $Agents = $rows['Agent_3'];
                                    $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
                                    $qry = mysqli_query($connect, $sel);
                                    $fetch = mysqli_fetch_assoc($qry);
                                    if($fetch){
                                         //$sel = "select Agent_3, Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";
                                         //$qry = mysqli_query($connect, $sel);
                                        // $fetch_data = mysqli_fetch_assoc($qry);
                                         $am += $rows['Agent_3_Shared_Amount'];
                                    }
                                }
                            
                            
                            
                                }
                    }
   

   

    // echo $am;

     return $am;

    

}


 
function getSharedCount($users,$types){
    global $connect;
    global $username;

     
      if($_SESSION['Role'] == 'Super Admin' || $_SESSION['Role'] == 'Admin Assist'  || $_SESSION['Role'] == 'compliance officer') {
          
            $sql = ("SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName, 
     DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status ,
     Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  
     FROM Customer_Payment_History WHERE SaleDate = '".date('Y-m-d')."' AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
      }
        else if($_SESSION['Role'] == 'Team Leader') { 
                $sql = ("SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName, 
     DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status ,
     Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  
     FROM Customer_Payment_History WHERE Team_Leader = '".$users."' AND SaleDate = '".date('Y-m-d')."' AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
        }
     
    //echo $sql;
    $qrys = mysqli_query($connect, $sql);
    $am = 0;
     if($types == 'amounts'){
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
           $am += $row['Agent_1_Shared_Amount']+$row['Agent_2_Shared_Amount']+$row['Agent_3_Shared_Amount'];  
        
     
    
   
    }
     return $am;
    }
    else{
      while($rows = mysqli_fetch_assoc($qrys)){
          $counts[] = $rows['id'];
      }
      return count($counts);
    }
    // echo $am;
     
    
}
 
 
 
  
function getShared($users,$types = ''){
    global $connect;
    // global $username;
   // print_r($_SESSION);
     if($_SESSION['Role'] == 'Super Admin' || $_SESSION['Role'] == 'Admin Assist'  || $_SESSION['Role'] == 'compliance officer') {
    $sql = ("SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  
     DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired'
     else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert 
     FROM Customer_Payment_History where  MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved'  ORDER BY  `Costumer_ID` DESC");
     }
    
    else if($_SESSION['Role'] == 'Team Leader') { 
    $sql = "SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  
     DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired'
     else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert 
     FROM Customer_Payment_History where  Team_Leader = '".$users."' AND MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC";
     }
    
    
    $qrys = mysqli_query($connect, $sql);
    $am = 0;
     if($types == ''){
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
         $am += $row['Agent_1_Shared_Amount']+$row['Agent_2_Shared_Amount']+$row['Agent_3_Shared_Amount']; 
        //echo $am;
       
        }
        return $am;
    }
    else{
      while($rows = mysqli_fetch_assoc($qrys)){
          $counts[] = $rows['id'];
      }
      return count($counts);
    }
    
}
 

    
    
    ?>
    <div class="row">
        
        <div class="col-sm-6">
            
             <div class="col-sm-6" style="visibility:<?php if($_SESSION['Role'] == 'Research Analyst'){ echo 'hidden'; } ?>">
        <div class="panel panel-primary">
          <div class="panel-heading font-size18">Sales Reports</div>
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
     
      
      <div class="col-sm-6">
        <div class="panel panel-primary">
          <div class="panel-heading font-size18"><?php if($_SESSION['Role'] == 'Research Analyst'){ echo ('&nbsp;'); } else { echo('Team Leader wise'); } ?></div>
          <div class="panel-body">
            <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <?php
                    $sel = "select Team_Leader from employee where Team_Leader != ''  AND Team_Leader != 'Admin Assist' group by Team_Leader";
                    $qry = mysqli_query($connect, $sel);
                    $total_calculation = 0;
                    while($rows = mysqli_fetch_assoc($qry)){
                        ?>
                         <tr>
                          <td><strong><?php if($_SESSION['Role'] != 'Research Analyst'){ echo $rows['Team_Leader'];} ?></strong></td>
                          <td><strong>Rs  <?php
                          echo $t_count = getSharedByTeamLeader($rows['Team_Leader']);
                         $total_calculation += $t_count;
                          
                           ?></strong></td>
                        </tr>
                        <?php
                    }
                ?>
                
               <!--<tr>
                  <td><strong>This Month Sale</strong></td>
                  <td><strong><?php // echo getShared($username,'counts');
                   ?></strong></td>
                </tr>-->
                
                <tr>
                  <td><strong>This Month Sale's Amount</strong></td>
                  <td><strong>Rs <?php
                 
                  
                   echo $total_calculation;
             
                   ?></strong></td>
                </tr>
              </tbody>
</table>
          </div>
        </div>
      </div>
      
        <div class="col-sm-6" style="visibility:<?php if($_SESSION['Role'] == 'Research Analyst'){ echo 'hidden'; } ?>">
        <div class="panel panel-primary">
          <div class="panel-heading font-size18">Team Leader wise last month</div>
          <div class="panel-body">
            <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <?php
                    $sel = "select Team_Leader from employee where Team_Leader != '' AND Team_Leader != 'Compliance Officer' AND Team_Leader != 'Admin Assist' group by Team_Leader";
                    $qry = mysqli_query($connect, $sel);
                    $total_calculation = 0;
                    while($rows = mysqli_fetch_assoc($qry)){
                        ?>
                         <tr>
                          <td><strong><?php echo $rows['Team_Leader']; ?></strong></td>
                          <td><strong>Rs  <?php
                          echo $t_count = (int)getSharedByTeamLeaderLastMonth($rows['Team_Leader']);
                         $total_calculation += $t_count;
                          
                           ?></strong></td>
                        </tr>
                        <?php
                    }
                ?>
                
               <!--<tr>
                  <td><strong>This Month Sale</strong></td>
                  <td><strong><?php // echo getShared($username,'counts');
                   ?></strong></td>
                </tr>-->
                
                <tr>
                  <td><strong>Last Month Sale's Amount</strong></td>
                  <td><strong>Rs <?php
                 
                  
                   echo (int)$total_calculation;
             
                   ?></strong></td>
                </tr>
              </tbody>
</table>
          </div>
        </div>
      </div>
      
      <div class="col-sm-6" style="display:<?php if($_SESSION['Role'] != 'Super Admin'){ echo 'none'; } ?>">
        <div class="panel panel-primary">
          <div class="panel-heading font-size18">Fresh Leads with Team Leader</div>
          <div class="panel-body">
            <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                         <?php
                    $sel = "select username from admin where Role = 'Team Leader' AND Status = 'Active'";
                    $qry = mysqli_query($connect, $sel);
                    $total_leads = 0;
                    while($rows = mysqli_fetch_assoc($qry)){
                        ?>
                         <tr>
                          <td><strong><?php echo $rows['username']; ?></strong></td>
                          <td><strong>  
                          <?php
                            $sels = "select count(*) as cn from Assigned_Leads where UserName = '".$rows['username']."' and Disposition = 'Fresh' ";
                            $qrys = mysqli_query($connect, $sels);
                            $fetch = mysqli_fetch_assoc($qrys);
                            $count = $fetch['cn'];
                            $total_leads+=$count;
                            echo $count;
                           ?>
                           </strong></td>
                           <td>
                               <?php if($count>0){ ?>
                               <a href="leads-revert-back.php?Team_Leader=<?php echo $rows['username']; ?>">Revert Back</a>
                               <?php } ?>
                           </td>
                        </tr>
                        <?php
                    }
                ?>
                
                
                <tr>
                  <td><strong>Total fresh leads</strong></td>
                  <td><strong><?php echo $total_leads; ?></strong></td>
                </tr>
              </tbody>
</table>
          </div>
        </div>
      </div>
      
        <div class="col-sm-6">
        <div class="panel panel-primary">
          <div class="panel-heading font-size18">Stock Tips Reports</div>
          <div class="panel-body">
            <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td>&nbsp;</td>
                  <td style="background:#3498db;color:#fff;"><strong>Open</strong></td>
                  <td style="background:#27ae60;color:#fff;"><strong>Positive</strong></td>
                  <td style="background:#e74c3c;color:#fff;"><strong>Negative</strong></td>
                </tr>
                <tr>
                  <td><strong>Today's</strong></td>
                  <td style="background:#3498db;color:#fff;">
                 
                 
                 <?php
                 
        $total_count = array(
                'Positive'=>0,
                'Negative'=>0,
                'Open'=>0
            );

        $result = mysqli_query($connect, "SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Open') AND (`Date` = CURDATE())");

         $open_count = mysql_result($result, 0);
            $total_count['Open'] += $open_count;
            echo $open_count;
       ?>
                 
                  </td>
                  <td style="background:#27ae60;color:#fff;">
                  <?php

        $result = mysqli_query($connect, "SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Positive') AND (`Date` = CURDATE())");
         $positive_count = mysql_result($result, 0);
         $total_count['Positive'] += $positive_count;
         echo $positive_count;
       ?>
                  
                  </td>
                  <td style="background:#e74c3c;color:#FFF;">
                   <?php

        $result = mysqli_query($connect, "SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Negative') AND (`Date` = CURDATE())");

         $Negative_count = mysql_result($result, 0);
         $total_count['Negative'] += $Negative_count;
         echo $Negative_count;

       ?>
                  </td>
                </tr>
                <tr>
                  <td><strong>This week</strong></td>
                  <td style="background:#3498db;color:#fff;"> <?php

        $result = mysqli_query($connect, "SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Open') AND YEARWEEK(`Date`, 1) = YEARWEEK(CURDATE(), 1) ORDER BY Date DESC");
        echo $open_count_this_week = mysql_result($result, 0);

       ?></td>
                  <td style="background:#27ae60;color:#fff;"><?php

        $result = mysqli_query($connect, "SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Positive') AND YEARWEEK(`Date`, 1) = YEARWEEK(CURDATE(), 1) ORDER BY Date DESC");
         echo $positive_count_this_week = mysql_result($result, 0);

       ?></td>
                  <td style="background:#e74c3c;color:#fff;"><?php

        $result = mysqli_query($connect, "SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Negative') AND YEARWEEK(`Date`, 1) = YEARWEEK(CURDATE(), 1) ORDER BY Date DESC");
        echo $Negative_count_this_week = mysql_result($result, 0);

       ?></td>
                </tr>
                <tr>
                  <td><strong>This Month</strong></td>
                  <td style="background:#3498db;color:#fff;">
                  <?php

        $result = mysqli_query($connect, "SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Open') AND (MONTH(Date) = MONTH(CURDATE()) AND YEAR(Date) = YEAR(CURDATE()))ORDER BY Date DESC ");
         echo $open_count_this_month = mysql_result($result, 0);
         

       ?>
               </td>
                  <td style="background:#27ae60;color:#fff;">      <?php

        $result = mysqli_query($connect, "SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Positive') AND (MONTH(Date) = MONTH(CURDATE()) AND YEAR(Date) = YEAR(CURDATE()))ORDER BY Date DESC ");
        echo $positive_count_this_month = mysql_result($result, 0);

       ?></td>
                  <td style="background:#e74c3c;color:#fff;"><?php

        $result = mysqli_query($connect, "SELECT COUNT(`Result`) FROM stock_tips WHERE (Result =  'Negative') AND (MONTH(Date) = MONTH(CURDATE()) AND YEAR(Date) = YEAR(CURDATE()))ORDER BY Date DESC ");
        echo $Negative_count_this_month = mysql_result($result, 0);

       ?></td>
                </tr>
                <tr>
                  <td><strong>Till Now</strong></td>
                  <td style="background:#3498db;color:#fff;"><?php

//      $result = mysqli_query($connect, "SELECT COUNT(`Result`) FROM stock_tips WHERE Result =  'Open'");

//          echo mysql_result($result, 0);
           // echo $total_count['Open'];
           $result = mysqli_query($connect, "SELECT * FROM stock_tips WHERE (Result =  'Open') ");
       echo $total_open_count = mysql_num_rows($result);

       ?></td>
                  <td style="background:#27ae60;color:#fff;"><?php

//      $result = mysqli_query($connect, "SELECT COUNT(`Result`) FROM stock_tips WHERE Result =  'Positive'");

//          echo mysql_result($result, 0);
            //echo $total_count['Positive'];
            $result = mysqli_query($connect, "SELECT * FROM stock_tips WHERE (Result =  'Positive') ");
       echo $total_positive_count = mysql_num_rows($result);
       ?></td>
                  <td style="background:#e74c3c;color:#fff;"><?php

//      $result = mysqli_query($connect, "SELECT COUNT(`Result`) FROM stock_tips WHERE Result =  'Negative'");
        
        
        

        

//          echo mysql_result($result, 0);
            //echo $total_count['Negative'];
            $result = mysqli_query($connect, "SELECT * FROM stock_tips WHERE (Result =  'Negative') ");
       echo $total_Negative_count = mysql_num_rows($result);
       ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default" style="">
                <div class="panel-heading font-size16">Stock Tips Reports This Week</div>
                <div class="panel-body">
                    <div style="max-width: 380px;">
                        <canvas id="this_week" width="330" height="330"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                var ctx = document.getElementById("this_week");
                var myChart = new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: ["Open","Positive","Negative"],
                    datasets: [{
                      label: '#',
                      data: [<?php echo $open_count_this_week.','.$positive_count_this_week.','.$Negative_count_this_week; ?>],
                      backgroundColor: [
                         'rgb(72, 162, 223)',
                         'rgb(109, 219, 156)',
                        'rgba(255, 99, 132, 0.5)'
                      ],
                      borderColor: [
                         'rgb(72, 162, 223)',
                         'rgba(75, 192, 192, 1)',
                        'rgba(255,99,132,1)'
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    cutoutPercentage: 40,
                    responsive: false,
                
                  }
                });
            });
        </script>
        
        <div class="col-md-6">
            <div class="panel panel-default" style="">
                <div class="panel-heading font-size16">Stock Tips Reports This Month</div>
                <div class="panel-body">
                    <div style="max-width: 380px;">
                        <canvas id="this_month" width="330" height="330"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                var ctx = document.getElementById("this_month");
                var myChart = new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: ["Open","Positive","Negative"],
                    datasets: [{
                      label: '#',
                      data: [<?php echo $open_count_this_month.','.$positive_count_this_month.','.$Negative_count_this_month; ?>],
                      backgroundColor: [
                         'rgb(72, 162, 223)',
                         'rgb(109, 219, 156)',
                        'rgba(255, 99, 132, 0.5)'
                      ],
                      borderColor: [
                         'rgb(72, 162, 223)',
                         'rgba(75, 192, 192, 1)',
                        'rgba(255,99,132,1)'
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    cutoutPercentage: 40,
                    responsive: false,
                
                  }
                });
            });
        </script>
        
        
        <div class="col-md-6">
            <div class="panel panel-default" style="">
                <div class="panel-heading font-size16">Stock Tips Reports Total Till Now</div>
                <div class="panel-body">
                    <div style="max-width: 380px;">
                        <canvas id="myChart" width="330" height="330"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                var ctx = document.getElementById("myChart");
                var myChart = new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: ["Open","Positive","Negative"],
                    datasets: [{
                      label: '#',
                      data: [<?php echo $total_open_count.','.$total_positive_count.','.$total_Negative_count; ?>],
                      backgroundColor: [
                         'rgb(72, 162, 223)',
                         'rgb(109, 219, 156)',
                        'rgba(255, 99, 132, 0.5)'
                      ],
                      borderColor: [
                         'rgb(72, 162, 223)',
                         'rgba(75, 192, 192, 1)',
                        'rgba(255,99,132,1)'
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    cutoutPercentage: 40,
                    responsive: false,
                
                  }
                });
            });
        </script>
        
        <div class="col-md-6">
        
        <div class="panel panel-primary">
          <div class="panel-heading font-size18">Total unique customers till date</div>
          <div class="panel-body">
            <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                
                <tr>
                 <?php

        $result = mysqli_query($connect, "SELECT CustomerTill_31_May_2021 FROM `Options` WHERE Id ='1'");
          
             $CustomerTill_31_May_2021 = mysql_result($result, 0);

       ?>
                  <td style="font-size:26px;">
                 
                 
                 <?php

        $result = mysqli_query($connect, "SELECT COUNT(distinct Mobile_No) FROM `Customer_profile` WHERE SaleDate >='2021-06-01'");
           
           $Customerafter_31_May_2021 = mysql_result($result, 0);
           echo ($CustomerTill_31_May_2021 + $Customerafter_31_May_2021)

       ?>
                 
                  </td>
              
                </tr>
               
              </tbody>
            </table>
          </div>
        </div>
        </div>
        
      </div>
            

        
        
     
      
       <div class="col-sm-6" style="visibility:<?php if($_SESSION['Role'] == 'Research Analyst'){ echo 'hidden'; } ?>">  
        <div class="panel panel-primary">
          <div class="panel-heading font-size18">Employee Working Status</div>
          <div class="panel-body" style="">
            <table class="table table-bordered">
                <thead>
                    <tr>
      <th>Agent Name</th>
      <th>Login Status</th>
      <th>Login Time</th>
      <th>Total Time</th>
      <th>Today's Follow ups</th>
    </tr>
                </thead>
  <tbody>
      <?php
      //print_r($_SESSION);
        if($_SESSION['Role'] == 'Team Leader'){
             $sel = "select * from employee where Team_Leader = '".$username."' AND Status='Active'";
             $qry = mysqli_query($connect, $sel);
             $all_agents = array();
             while($fetch = mysqli_fetch_assoc($qry)){
                 $all_agents[] = $fetch['username'];
             }
        }
       // print_r($all_agents);
       $att_sel = 'select Agent_Name,user_id,login_time,total_time,Informed_Late from attendence where date = "'.date("d-m-Y").'"';
        $att_qry = mysqli_query($connect, $att_sel);
        while($row = mysqli_fetch_assoc($att_qry)){
            if($_SESSION['Role'] == 'Team Leader'){
                if(!in_array($row['Agent_Name'],$all_agents)){
                    continue;
                }
            }
      ?>
      
    <tr>
      <td><?php echo $row['Agent_Name']; ?></td>
       <td><?php
      $qrys ="SELECT * FROM employee WHERE Id = '".$row['user_id']."'";
       $get_employ = mysqli_query($connect, $qrys);
       $get_emp_det = mysqli_fetch_assoc($get_employ);
      // echo $get_emp_det['Login_Status'];
       if($get_emp_det['Login_Status'] == 'Active'){
           echo '<span class="badge" style="background:green;">Active</span>';
       }
       else{
           echo '<span class="badge " style="background:red;">InActive</span>'; 
       }
      
      ?></td>
      <td><?php 
        $ex_date_time = explode(" ",$row['login_time']);
    $time = $ex_date_time['1'];
    $manpulate_time = explode(":",$time);
    echo $manpulate_time['0'].":".$manpulate_time['1'];
    echo " ".$a_pm = $ex_date_time['2'];
    
     $login_time = strtotime($row['login_time']);
    // echo (date('m/d/Y')." 09:00:00 PM");
    
    $ontime = strtotime(date('m/d/Y')." 09:01:00 AM");
    
    if($login_time>$ontime){
        //echo $row['Informed_Late'];
         if($row['Informed_Late'] != '' || $row['Informed_Late'] != NULL ){
            echo "<span style='color:blue'> Informed Late</span>";
             
           
        }
        else{
            echo "<span style='color:red'> Late</span>";
            
        }
    }
    else{
        echo "<span style='color:green'> Ontime</span>";
    }
       ?></td>
      <td><?php 
      
        if($row['total_time']>60){
        //$new_total_time = $row['Total_Time']/60;
        echo $hours = floor($row['total_time'] / 60)." Hours "; // Get the number of whole hours
        echo $minutes =  ($row['total_time'] % 60)." Minutes"; // Get the remainder of the hours
    }
    else{
        echo $row['total_time']." Minutes";
    }
      
      ?></td>
        <td>
            <?php
          //  SELECT count(*) FROM `FolllowUpLeads` WHERE DATE(`timestamp`) = CURDATE() AND UserName = 'Afreen Khan'
          $sql = "SELECT count(*) as counts FROM `FolllowUpLeads` WHERE DATE(`timestamp`) = CURDATE() AND UserName = '".$row['Agent_Name']."'  AND Disposition != 'Fresh'";
         //echo $sql; exit; 
          $qry = mysqli_query($connect, $sql);
          $res = mysqli_fetch_assoc($qry);
          echo '<a href="todays-followups.php?UserName='.$row['Agent_Name'].'">'.$res['counts'].'</a>';
            
            ?>
        </td>
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
      
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<?php include('partial/footer.php') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
