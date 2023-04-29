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
    <!-- <div class="breadcurms"> <a href="memberpage.php">Dashbord</a>  </div> -->
    <div class="breadcurms"> <a href="memberpage.php">Dashboard</a> | <a href="daily-tl-wise-report.php">Daily TL Wise Report</a> | <a href="stock-tips-report.php">Stock Tips Report</a> | <a href="employee-working-status.php">Employee Working Status</a> | <a href="management-working-status.php">Management Working Status</a></div>
    <div class="containter" style="padding:20px 20px 0 20px;">
      <?php include('connection/dbconnection_crm.php');


// function definition is written in hearder-top.php
// if agent bank details are missing, will redirect on agent login details page
      check_agent_bank_details();

      function getSharedByTeamLeader($users){

        global $connect;
    //global $username;
        $TL_1_total = 0;
        $TL_2_total = 0;
        $TL_3_total = 0;

        $sql = ("SELECT SUM(Agent_1_Shared_Amount) AS Total1, SUM(Agent_2_Shared_Amount) AS Total2 , SUM(Agent_3_Shared_Amount) AS Total3 
          FROM Customer_Payment_History 
          where 
          (Agent_1_TL='".$users."' OR Agent_2_TL='".$users."' OR Agent_3_TL='".$users."')
          AND MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
            // echo $sql;
            // die();

        $qrys = mysqli_query($connect,$sql);
        $result = mysqli_fetch_assoc($qrys);
        $TL_1_total= $result['Total1'];
        $TL_2_total= $result['Total2'];
        $TL_3_total= $result['Total3'];

        $total = $TL_1_total + $TL_2_total + $TL_3_total; 

        return $total;

      }


      function getSharedByTeamLeaderLastMonth($users){

        global $connect;
    //global $username;
        $TL_1_total = 0;
        $TL_2_total = 0;
        $TL_3_total = 0;

        $sql = ("SELECT SUM(Agent_1_Shared_Amount) AS Total1, SUM(Agent_2_Shared_Amount) AS Total2 , SUM(Agent_3_Shared_Amount) AS Total3  FROM Customer_Payment_History where Agent_1_TL='".$users."' AND MONTH(  `SaleDate` ) = MONTH( CURDATE( ) - INTERVAL 1 MONTH) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");

        $qrys = mysqli_query($connect,$sql);
        $result = mysqli_fetch_assoc($qrys);
        $TL_1_total= $result['Total1'];
        $TL_2_total= $result['Total2'];
        $TL_3_total= $result['Total3'];
        $total = $TL_1_total + $TL_2_total + $TL_3_total; 

        return $total;

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

      $sql = ("SELECT Agent_1_Shared_Amount,Agent_2_Shared_Amount,Agent_3_Shared_Amount,id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName, 
       DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status ,
       Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  
       FROM Customer_Payment_History WHERE SaleDate = '".date('Y-m-d')."' AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
    }
    else if($_SESSION['Role'] == 'Team Leader') { 
      $sql = ("SELECT Agent_1_Shared_Amount,Agent_2_Shared_Amount,Agent_3_Shared_Amount, id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName, 
       DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status ,
       Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  
       FROM Customer_Payment_History WHERE Team_Leader = '".$users."' AND SaleDate = '".date('Y-m-d')."' AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
    }

    //echo $sql;
    $qrys = mysqli_query($connect, $sql);

    $am = 0;
    if($types == 'amounts')
    {

      if(!empty($qrys)){
        while($rows = mysqli_fetch_assoc($qrys)){
          // $id = $rows['id'];
       // echo "&nbsp;";
       // echo $rows['Costumer_ID'];
       //  echo "<br>";

          // $sel = "select Agent_1,Agent,Agent_2,Agent_3,Agent_1_Shared_Amount,Agent_2_Shared_Amount,Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";
          // $qry = mysqli_query($connect, $sel);
          // $row = mysqli_fetch_assoc($qry);
         // print"<pre>";
         // print_r($row);
          $am += $rows['Agent_1_Shared_Amount']+$rows['Agent_2_Shared_Amount']+$rows['Agent_3_Shared_Amount'];  


        }
      }
      return $am;
    }
    else
    { 
      $counts=[] ;
      if(!empty($qrys)){
        while($rows = mysqli_fetch_assoc($qrys)){

          $counts[] = $rows['id'];
        }
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
      $sql = ("SELECT Agent_1_Shared_Amount,Agent_2_Shared_Amount,Agent_3_Shared_Amount, id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  
       DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired'
       else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert 
       FROM Customer_Payment_History where  MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved'  ORDER BY  `Costumer_ID` DESC");
    }
    
    else if($_SESSION['Role'] == 'Team Leader') { 
      $sql = "SELECT Agent_1_Shared_Amount,Agent_2_Shared_Amount,Agent_3_Shared_Amount, id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  
      DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired'
      else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert 
      FROM Customer_Payment_History where  Team_Leader = '".$users."' AND MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC";
    }
    
    $qrys = mysqli_query($connect,$sql);
    $am = 0;
    if($types == ''){
     if(!empty($qrys)){
      while($rows = mysqli_fetch_assoc($qrys)){
        // $id = $rows['id'];
           // echo "&nbsp;";
           // echo $rows['Costumer_ID'];
            //echo "<br>";

        // $sel = "select Agent_1,Agent,Agent_2,Agent_3,Agent_1_Shared_Amount,Agent_2_Shared_Amount,Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";
        // $qry = mysqli_query($connect, $sel);
        // $row = mysqli_fetch_assoc($qry);
             // print"<pre>";
             // print_r($row);
        $am += $rows['Agent_1_Shared_Amount']+$rows['Agent_2_Shared_Amount']+$rows['Agent_3_Shared_Amount']; 
            //echo $am;

      }
    }
    return $am;
  }
  else{
    $counts=[];
    
    if(!empty($qrys)){
      while($rows = mysqli_fetch_assoc($qrys)){
        $counts[] = $rows['id'];
      }
    }
    return count($counts);
  }

}




?>
<?php if(true){ ?>
<div class="row">

  <div class="col-sm-12">

   <div class="col-sm-4" style="visibility:<?php if($_SESSION['Role'] == 'Research Analyst'){ echo 'hidden'; } ?>">
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


  <div class="col-sm-4">
    <div class="panel panel-primary">
      <div class="panel-heading font-size18"><?php if($_SESSION['Role'] == 'Research Analyst'){ echo ('&nbsp;'); } else { echo('Team Leader wise'); } ?></div>
      <div class="panel-body">
        <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <?php
                    //$sel = "select Team_Leader from employee where Team_Leader != ''  AND Team_Leader != 'Admin Assist' group by Team_Leader";
            $sel = "SELECT username as Team_Leader FROM employee WHERE Role = 'Team Leader' AND Status = 'Active'";
            $qry = mysqli_query($connect,$sel);
            $total_calculation = 0;
            while($rows = $qry->fetch_assoc()){
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

      <div class="col-sm-4" style="visibility:<?php if($_SESSION['Role'] == 'Research Analyst'){ echo 'hidden'; } ?>">
        <div class="panel panel-primary">
          <div class="panel-heading font-size18">Team Leader wise last month</div>
          <div class="panel-body">
            <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <?php
                    //$sel = "select Team_Leader from employee where Team_Leader != '' AND Team_Leader != 'Compliance Officer' AND Team_Leader != 'Admin Assist' group by Team_Leader";
                $sel = "SELECT username as Team_Leader FROM employee WHERE Role = 'Team Leader' AND Status = 'Active'";
                $qry = mysqli_query($connect,$sel);
                $total_calculation = 0;
                while($rows = $qry->fetch_assoc()){
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

      <div class="col-sm-4" style="display:<?php if($_SESSION['Role'] != 'Super Admin'){ echo 'none'; } ?>">
        <div class="panel panel-primary">
          <div class="panel-heading font-size18">Fresh Leads with Team Leader</div>
          <div class="panel-body">
            <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
              <tbody>
               <?php
               $sel = "select count(al.id) as user_leads, e.username from employee as e Left JOIN Assigned_Leads as al ON e.username = al.UserName
                        where e.Role = 'Team Leader' AND e.`Status` = 'Active' And al.Disposition = 'Fresh' group by e.username";
               // $sel = "select username from employee where Role = 'Team Leader' AND Status = 'Active'";
               $qry = mysqli_query($connect,$sel);
               $total_leads = 0;
               while($rows = $qry->fetch_assoc()){ 
                ?>
                <tr>
                  <td><strong><?php echo $rows['username']; ?></strong></td>
                  <td><strong>  
                    <?php
                    $count = $rows['user_leads'];
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

     <div class="col-sm-4" style="display:<?php if($_SESSION['Role'] != 'Super Admin'){ echo 'none'; } ?>">
        <div class="panel panel-primary">
          <div class="panel-heading font-size18">Fresh Leads with Sr. Team Leader</div>
          <div class="panel-body">
            <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
              <tbody>
               <?php
               $sel = "select count(al.id) as user_leads, e.username from employee as e Left JOIN Assigned_Leads as al ON e.username = al.UserName
                      where e.Role = 'SR_TL' AND e.`Status` = 'Active' And al.Disposition = 'Fresh' group by e.username";
               $qry = mysqli_query($connect,$sel);
               $total_leads = 0;
               while($rows = $qry->fetch_assoc()){
                ?>
                <tr>
                  <td><strong><?php echo $rows['username']; ?></strong></td>
                  <td><strong>  
                    <?php
                    $count = $rows['user_leads'];
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
  
    <!-- for sr team leader -->
  <div class="col-sm-4" style="display:<?php if($_SESSION['Role'] != 'SR_TL'){ echo 'none'; } ?>">
    <div class="panel panel-primary">
      <div class="panel-heading font-size18">Fresh Leads with Team Leader</div>
      <div class="panel-body">
        <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
          <tbody>
           <?php
           $tl_name = $_SESSION['username'];
           $sel = "select username from employee where Role = 'Team Leader' AND Team_Leader = '". $tl_name."' AND Status = 'Active'";
           $qry = mysqli_query($connect,$sel);
           $total_leads = 0;
           while($rows = $qry->fetch_assoc()){
            ?>
            <tr>
              <td><strong><?php echo $rows['username']; ?></strong></td>
              <td><strong>  
                <?php
                $sels = "select count(*) as cn from Assigned_Leads where UserName = '".$rows['username']."' and Disposition = 'Fresh' ";
                $qrys = mysqli_query($connect,$sels);
                $fetch = $qrys->fetch_assoc();
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

  <!-- for team leader -->
  <div class="col-sm-4" style="display:<?php if($_SESSION['Role'] != 'Team Leader'){ echo 'none'; } ?>">
    <div class="panel panel-primary">
      <div class="panel-heading font-size18">Fresh Leads with Agents</div>
      <div class="panel-body">
        <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
          <tbody>
           <?php
           $tl_name = $_SESSION['username'];
           $sel = "select username from employee where Role = 'Agent' AND Team_Leader = '". $tl_name."' AND Status = 'Active'";
           $qry = mysqli_query($connect,$sel);
           $total_leads = 0;
           while($rows = $qry->fetch_assoc()){
            ?>
            <tr>
              <td><strong><?php echo $rows['username']; ?></strong></td>
              <td><strong>  
                <?php
                $sels = "select count(*) as cn from Assigned_Leads where UserName = '".$rows['username']."' and Disposition = 'Fresh' ";
                $qrys = mysqli_query($connect,$sels);
                $fetch = $qrys->fetch_assoc();
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


<div class="col-sm-4" style="display:<?php if($_SESSION['Role'] != 'Super Admin'){ echo 'none'; } ?>">
  <div class="panel panel-primary">
    <div class="panel-heading font-size18">Active Agents</div>
    <div class="panel-body">
      <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
        <tbody>
         <?php
         // $sel = "select username from employee where Role = 'Team Leader' AND Status = 'Active'";
         // $qry = mysqli_query($connect,$sel);
         // $total_leads = 0;
         // while($rows = $qry->fetch_assoc()){}
          ?>
        <tr>
          <td><strong>Total Agents</strong></td>
          <td><strong> <?php 
          $result = mysqli_query($connect, "SELECT count(id) as total FROM employee Where Role='Agent'");
          $total_agent=$result->fetch_assoc()['total'];
          echo $total_agent;

          ?></strong></td>
        </tr>
        <tr>
          <td><strong>Total Active Agents</strong></td>
          <td><strong> <?php 

          $result = mysqli_query($connect, "SELECT count(id) as total FROM employee Where Role='Agent' AND Status='Active' ");
          $total_active_agent=$result->fetch_assoc()['total'];

          echo $total_active_agent;

          ?></strong></td>
        </tr>
        <tr>
          <td><strong>Total Active Agents %</strong></td>
          <td>
            <strong>
            <?php
              $avg = ($total_active_agent / $total_agent) * 100;
              echo ceil($avg) .'%';
             ?>
             </strong>
          </td>
        </tr>
        <tr>
          <td><strong>Last Month Added Agents</strong></td>
          <td><strong>
           <?php 

           $Month  = date('m', strtotime("-30 days"));
           $Year  = date('Y', strtotime("-0 year"));

           if($Month == 12)
           {
              $Year  = date('Y', strtotime("-1 year"));
           }

           $result = mysqli_query($connect, "SELECT count(id) as total FROM employee Where Role='Agent' AND Status='Active' AND  MONTH(Date_of_join) = '".$Month."'
           AND YEAR(Date_of_join) = '".$Year."' ");
           $last_month_added_agent=$result->fetch_assoc()['total'];

           echo $last_month_added_agent;

           ?>
           </strong>
         </td>
       </tr>
        <tr>
          <td><strong>Currnt Month Added Agents</strong></td>
          <td><strong>
           <?php 

           $result = mysqli_query($connect, "SELECT count(id) as total FROM employee Where Role='Agent' AND Status='Active' AND  MONTH(Date_of_join) = MONTH(now())
           AND YEAR(Date_of_join) = YEAR(now()) ");
           $new_agent=$result->fetch_assoc()['total'];

           echo $new_agent;

           ?>
           </strong>
         </td>
       </tr>
     </tbody>
   </table>
 </div>
</div>
</div>


<div class="col-sm-4" style="display:<?php if($_SESSION['Role'] != 'Super Admin'){ echo 'none'; } ?>">
  <div class="panel panel-primary">
    <div class="panel-heading font-size18">Inactive Agents</div>
    <div class="panel-body">
      <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
        <tbody>
         <?php
         $sel = "select username from employee where Role = 'Team Leader' AND Status = 'Active'";
         $qry = mysqli_query($connect,$sel);
         $total_leads = 0;
         while($rows = $qry->fetch_assoc()){}
          ?>
        <tr>
          <td><strong>Total Agents</strong></td>
          <td><strong> <?php 
          $result = mysqli_query($connect, "SELECT count(id) as total FROM employee Where Role='Agent'");
          $total_agent=$result->fetch_assoc()['total'];
          echo $total_agent;

          ?></strong></td>
        </tr>
        <tr>
          <td><strong>Total Inactive Agents</strong></td>
          <td><strong> <?php 

          $result = mysqli_query($connect, "SELECT count(id) as total FROM employee Where Role='Agent' AND Status='disabled' ");
          $total_inactive_agent=$result->fetch_assoc()['total'];

          echo $total_inactive_agent;

          ?></strong></td>
        </tr>
        <tr>
          <td><strong>Total Inactive Agents %</strong></td>
          <td>
            <strong>
            <?php
              $avg = ($total_inactive_agent / $total_agent) * 100;
              echo ceil($avg) .'%';
             ?>
             </strong>
          </td>
        </tr>
        <tr>
          <td><strong>Last Month Inactive Agents</strong></td>
          <td><strong>
           <?php 

           $Month  = date('m', strtotime("-30 days"));
           $Year  = date('Y', strtotime("-0 year"));

           if($Month == 12)
           {
              $Year  = date('Y', strtotime("-1 year"));
           }

           $result = mysqli_query($connect, "SELECT * FROM employee_status_log Where Role='Agent' AND Status='0' AND  MONTH(change_date) = '".$Month."'
           AND YEAR(change_date) = '".$Year."' GROUP BY user_id ");
           $last_month_added_agent=mysqli_num_rows($result);

           echo $last_month_added_agent;

           ?>
           </strong>
         </td>
       </tr>
        <tr>
          <td><strong>Current Month Inactive Agents</strong></td>
          <td><strong>
           <?php 

           $result = mysqli_query($connect, "SELECT * FROM employee_status_log Where Role='Agent' AND status='0' AND  MONTH(change_date) = MONTH(now())
           AND YEAR(change_date) = YEAR(now()) GROUP BY user_id ");
           $total_active_agent=mysqli_num_rows($result);

           echo $total_active_agent;

           ?>
           </strong>
         </td>
       </tr>
     </tbody>
   </table>
 </div>
</div>
</div>


</div>

</div>



</div>

</div>
<?php } ?>
<div class="clearfix"></div>
</div>
</div>
<?php include('partial/footer.php') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
