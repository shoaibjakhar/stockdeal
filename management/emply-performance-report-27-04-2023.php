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


        <form>

            <div class="form-group" style="width: 200px;float: left;">
                <label for="Start Date">Start Date:</label>
                <input class="form-control" type="date" value="<?php echo date('Y-m-d');?>" name="start"  required="">
            </div>

            <div class="form-group" style="width: 200px;float: left;margin-left: 15px;">
                <label for="End Date">End Date:</label>
                <input class="form-control" type="date" value="<?php echo date('Y-m-d');?>" name="end" required="">
            </div>



            <div class="form-group" style="width: 200px;float: left;margin-left: 15px;">
                <label for="Select Employee">Select Employee:</label>

                <?php
                $sel = "select Team_Leader from employee where Team_Leader != '' group by Team_Leader";
                $qry = mysqli_query($connect,$sel);
                $total_calculation = 0;
                ?>
                <select class="form-control" name="employee" required="">
                    <?php
                    while($rows = mysqli_fetch_assoc($qry)){
                        ?>
                        <option value="<?php echo $rows['Team_Leader'] ?>"><?php echo $rows['Team_Leader'] ?></option> 
                        <?php 
                    }?>

                </select>
            </div>

            <div class="form-group" style="width: 200px;float: left;margin-left: 15px;margin-top: 25px;">

             <input type="submit" class="btn btn-primary">
         </div>





     </form>

     <div class="clearfix"></div>

 </div>



 <div class="containter" style="padding:20px 20px 0 20px;">
    <?php include('connection/dbconnection_crm.php');




    function getSharedByTeamLeader($users){

        global $connect;
    //global $username;
        $sql = ("SELECT id,Costumer_ID,Agent,Agent_1,Agent_1_Shared_Amount,Agent_2,Agent_2_Shared_Amount,Agent_3,Agent_3_Shared_Amount, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_Payment_History where MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
   // echo '<br>';
        $qrys = mysqli_query($connect,$sql);

        $am = 0;

        while($rows = mysqli_fetch_assoc($qrys)){

            $id = $rows['id'];

   // echo "&nbsp;";

   // echo $rows['Costumer_ID'];

    //echo "<br>";

            if($rows['Agent_1'] != ''){
                $Agents = $rows['Agent_1'];
                $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
                $qry = mysqli_query($connect,$sel);
                $fetch = mysqli_fetch_assoc($qry);
                if($fetch){
            // $sel = "select Agent_1, Agent_1_Shared_Amount from Customer_Payment_History where id = '$id'";
             //$qry = mysqli_query($connect,$sel);
             //$fetch_data = mysqli_fetch_assoc($qry);
                 $am += $rows['Agent_1_Shared_Amount'];
             }
         }
         if($rows['Agent_2'] != ''){
           $Agents = $rows['Agent_2'];
           $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
           $qry = mysqli_query($connect,$sel);
           $fetch = mysqli_fetch_assoc($qry);
           if($fetch){
             $sel = "select Agent_2, Agent_2_Shared_Amount from Customer_Payment_History where id = '$id'";
             //$qry = mysqli_query($connect,$sel);
             //$fetch_data = mysqli_fetch_assoc($qry);
             $am += $rows['Agent_2_Shared_Amount'];
         }
     }
     if($rows['Agent_3'] != ''){
        $Agents = $rows['Agent_3'];
        $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
        $qry = mysqli_query($connect,$sel);
        $fetch = mysqli_fetch_assoc($qry);
        if($fetch){
             //$sel = "select Agent_3, Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";
             //$qry = mysqli_query($connect,$sel);
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
    $qrys = mysqli_query($connect,$sql);

    $am = 0;

    while($rows = mysqli_fetch_assoc($qrys)){

        $id = $rows['id'];

   // echo "&nbsp;";

   // echo $rows['Costumer_ID'];

    //echo "<br>";

        if($rows['Agent_1'] != ''){
            $Agents = $rows['Agent_1'];
            $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
            $qry = mysqli_query($connect,$sel);
            $fetch = mysqli_fetch_assoc($qry);
            if($fetch){
            // $sel = "select Agent_1, Agent_1_Shared_Amount from Customer_Payment_History where id = '$id'";
             //$qry = mysqli_query($connect,$sel);
             //$fetch_data = mysqli_fetch_assoc($qry);
             $am += $rows['Agent_1_Shared_Amount'];
         }
     }
     if($rows['Agent_2'] != ''){
       $Agents = $rows['Agent_2'];
       $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
       $qry = mysqli_query($connect,$sel);
       $fetch = mysqli_fetch_assoc($qry);
       if($fetch){
         $sel = "select Agent_2, Agent_2_Shared_Amount from Customer_Payment_History where id = '$id'";
             //$qry = mysqli_query($connect,$sel);
             //$fetch_data = mysqli_fetch_assoc($qry);
         $am += $rows['Agent_2_Shared_Amount'];
     }
 }
 if($rows['Agent_3'] != ''){
    $Agents = $rows['Agent_3'];
    $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
    $qry = mysqli_query($connect,$sel);
    $fetch = mysqli_fetch_assoc($qry);
    if($fetch){
             //$sel = "select Agent_3, Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";
             //$qry = mysqli_query($connect,$sel);
            // $fetch_data = mysqli_fetch_assoc($qry);
     $am += $rows['Agent_3_Shared_Amount'];
 }
}



}

    // echo $am;

return $am;



}



function getSharedByTeamLeaderss($users,$current_month,$current_year){
//    this one is runing
    global $connect;
//global $username;
    $sql = ("SELECT id,Costumer_ID,Agent,Agent_1,Agent_1_Shared_Amount,Agent_2,Agent_2_Shared_Amount,Agent_3,Agent_3_Shared_Amount, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_Payment_History where MONTH(  `SaleDate` ) = $current_month AND YEAR(`SaleDate`) = $current_year AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
 // echo $sql;
 // die();
    $qrys = mysqli_query($connect,$sql);

    $am = 0;

    while($rows = mysqli_fetch_assoc($qrys)){

        $id = $rows['id'];

// echo "&nbsp;";

// echo $rows['Costumer_ID'];

//echo "<br>";

        if($rows['Agent_1'] != ''){
            $Agents = $rows['Agent_1'];
            $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
            $qry = mysqli_query($connect,$sel);
            $fetch = mysqli_fetch_assoc($qry);
            if($fetch){
        // $sel = "select Agent_1, Agent_1_Shared_Amount from Customer_Payment_History where id = '$id'";
         //$qry = mysqli_query($connect,$sel);
         //$fetch_data = mysqli_fetch_assoc($qry);
             $am += $rows['Agent_1_Shared_Amount'];
         }
     }
     if($rows['Agent_2'] != ''){
       $Agents = $rows['Agent_2'];
       $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
       $qry = mysqli_query($connect,$sel);
       $fetch = mysqli_fetch_assoc($qry);
       if($fetch){
         $sel = "select Agent_2, Agent_2_Shared_Amount from Customer_Payment_History where id = '$id'";
         //$qry = mysqli_query($connect,$sel);
         //$fetch_data = mysqli_fetch_assoc($qry);
         $am += $rows['Agent_2_Shared_Amount'];
     }
 }
 if($rows['Agent_3'] != ''){
    $Agents = $rows['Agent_3'];
    $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
    $qry = mysqli_query($connect,$sel);
    $fetch = mysqli_fetch_assoc($qry);
    if($fetch){
         //$sel = "select Agent_3, Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";
         //$qry = mysqli_query($connect,$sel);
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
    $qrys = mysqli_query($connect,$sql);

    $am = 0;
    
    $sel = "select Team_Leader from employee where Team_Leader != '' group by Team_Leader";
    $qry = mysqli_query($connect,$sel);
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
                $qry = mysqli_query($connect,$sel);
                $fetch = mysqli_fetch_assoc($qry);
                if($fetch){
                                        // $sel = "select Agent_1, Agent_1_Shared_Amount from Customer_Payment_History where id = '$id'";
                                         //$qry = mysqli_query($connect,$sel);
                                         //$fetch_data = mysqli_fetch_assoc($qry);
                 $am += $rows['Agent_1_Shared_Amount'];
             }
         }
         if($rows['Agent_2'] != ''){
           $Agents = $rows['Agent_2'];
           $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
           $qry = mysqli_query($connect,$sel);
           $fetch = mysqli_fetch_assoc($qry);
           if($fetch){
             $sel = "select Agent_2, Agent_2_Shared_Amount from Customer_Payment_History where id = '$id'";
                                         //$qry = mysqli_query($connect,$sel);
                                         //$fetch_data = mysqli_fetch_assoc($qry);
             $am += $rows['Agent_2_Shared_Amount'];
         }
     }
     if($rows['Agent_3'] != ''){
        $Agents = $rows['Agent_3'];
        $sel = "SELECT * FROM employee WHERE username = '$Agents' and Team_Leader = '$users'";
        $qry = mysqli_query($connect,$sel);
        $fetch = mysqli_fetch_assoc($qry);
        if($fetch){
                                         //$sel = "select Agent_3, Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";
                                         //$qry = mysqli_query($connect,$sel);
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
    $sql = ("SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName, 
     DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status ,
     Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  
     FROM Customer_Payment_History  SaleDate = '".date('Y-m-d')."' AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");

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

    die('here');
    global $connect;
    // global $username;
    if($_SESSION['Role'] == 'Super Admin' || $_SESSION['Role'] == 'Admin Assist') {
      $sql = ("SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  
         DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired'
         else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert 
         FROM Customer_Payment_History where  MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
  }
  
  else if($_SESSION['Role'] == 'Team Leader') { 
      $sql = "SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  
      DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired'
      else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert 
      FROM Customer_Payment_History where  Team_Leader = '".$users."' AND MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC";
  }
  
  
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

    <div class="col-sm-12">





       <div class="col-sm-6">
        <div class="panel panel-primary">
            <?php
            $current_year = date("Y");
            $current_month = date("m");
            $ccurrent_month = date("m");
            $month = date("M");
            $last_year = date("Y",strtotime("-2 year"));
                        //   $total_calculation += $t_count;
            ?>
            <?php   while($last_year <= $current_year){   
             ?>
             <div class="panel-heading font-size18">Sales Report of  <?=  $month;?> <?= $current_year; ?> </div>
             <div class="panel-body">
                <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <?php
                    $sel = "select Team_Leader from employee where Team_Leader != '' group by Team_Leader";
                    $qry = mysqli_query($connect,$sel);
                    $total_calculation = 0;
                    while($rows = mysqli_fetch_assoc($qry)){
                        ?>
                        <tr>
                          <td><strong><?php echo $rows['Team_Leader']; ?></strong></td>
                          <td><strong>Rs  <?php

                          // echo $current_month;
                          // echo $current_year;
                          //die('here ah..');
                          echo $t_count = (int)getSharedByTeamLeaderss($rows['Team_Leader'],$current_month,$current_year);
                          $total_calculation += $t_count;
                          
                          ?></strong>
                          <?php //echo $total_calculation;?>
                      </td>
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
              <td><strong> <?=  $month; ?>  <?= $current_year; ?> Sale's Amount</strong></td>
              <td><strong>Rs <?php


              echo (int)$total_calculation;

              ?></strong></td>
          </tr>
      </tbody>
  </table>
</div>
<?php 
$total_calculation = 0;
if($current_month == '1'){
  $current_year = $current_year - 1;
  $current_month = 12;

}
else{
    $current_month = $current_month - 1;
}
if($current_year == $last_year && $current_month == $ccurrent_month){
  break;
}

$month = date("F", mktime(0, 0, 0, $current_month, 10));


} ?>
</div>
</div>



</div>







</div>
<div class="clearfix"></div>
</div>
</div>
<?php include('partial/footer.php') ?>
