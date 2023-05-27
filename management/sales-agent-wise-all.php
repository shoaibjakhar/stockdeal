<?php

error_reporting(E_ALL);

session_start();

 $username = $_SESSION['username'];

 //echo $username;



include('partial/validate-user.php');

?>



<?php

 $UserName = $_GET['UserName'];

 $Source = $_GET['Source'];

 $Disposition = $_GET['Disposition'];


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

<a href="sales-agent-wise.php">Sales Agent Wise</a> | <a href="monthly-report.php">Monthly Report</a> 
<!--| <a href="sales-report-monthly-wise.php">Yearly Report</a>  -->
<!--| <a href="emply-performance-report.php">Employee Perfomance Report</a> -->
<?php
if($_SESSION['Role'] == 'Super Admin') {
  echo('| <a href="monthly-report.php">All Sales report</a>');
  echo(' | <a href="emply-performance-report.php">Emply Performance Report</a>');
}
?>

</div>

  

<div class="containter" style="padding:20px 20px 0 20px;">

<?php include('connection/dbconnection_crm.php')?>











<?php

function getShared($users){

    global $connect;
    if(isset($_GET['from']) && isset($_GET['to'])){
      $sql = ("SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_Payment_History where  (Agent = '".$users."' or Agent_1 = '".$users."' or Agent_2 = '".$users."' or Agent_3 = '".$users."') && SaleDate BETWEEN '".$_GET['from']."' AND '".$_GET['to']."' AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
    }
    else {
     $sql = ("SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_Payment_History where  (Agent = '".$users."' or Agent_1 = '".$users."' or Agent_2 = '".$users."' or Agent_3 = '".$users."') && MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
    }
  
    $qrys = mysqli_query($connect,$sql);

    $am = 0;

    while($rows = $qrys->fetch_assoc()){

    $id = $rows['id'];

    echo "&nbsp;";

    //echo $rows['Costumer_ID'];

    //echo "<br>";

    

      $sel = "select Agent_1,Agent,Agent_2,Agent_3,Agent_1_Shared_Amount,Agent_2_Shared_Amount,Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";

     $qry = mysqli_query($connect, $sel);

      $row = mysqli_fetch_assoc($qry);

    //   print"<pre>";

    //   print_r($row);
      //die();

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





if(isset($_GET['Team_Leader']) && $_GET['Team_Leader'] != ''){
    $sel = "select * from employee where Status = 'Active' AND username = '".$_GET['Team_Leader']."' ";
}
// else if(isset($_GET['from']) && isset($_GET['to'])){
//     $sel = "select * from employee where Status = 'Active' AND username !='Akshay Shetty' AND username !='Sudheer Singh' AND username !='Select' AND username !='Praveen Chhajlane' AND username !='compliance officer' AND Role !='Team Leader' AND Role !='compliance officer' AND Date_of_Join BETWEEN '".$_GET['from']."' AND '".$_GET['to']."' ";
//   }
    
else{


    $sel = "select * from employee where Status = 'Active' AND username !='Akshay Shetty' AND username !='Sudheer Singh' AND username !='Select' AND username !='Praveen Chhajlane' AND username !='compliance officer' AND Role !='Team Leader' AND Role !='compliance officer' ";
}
$qry = mysqli_query($connect,$sel);
// print_r($qry->fetch_assoc());
// die();

$i = 0;
 
while($rows = $qry->fetch_assoc()){



    $all_data['SalesAgentWise'] = getShared($rows['username']);

     $get_data[$i] = $all_data;

     $get_data[$i]['Sale_Target'] = $rows['Sale_Target'];

     $get_data[$i]['Id'] = $rows['Id'];
     $get_data[$i]['Date_of_Join'] = $rows['Date_of_Join'];

// echo "<pre>";
// print_r($all_data);
// echo "</pre>";
     //echo $rows['Id'];
    if(!empty($all_data) || empty($all_data['Agent'])) {
        
        // if(($all_data['Agent'] == '' || $all_data['Agent'] == NULL)) {
            $get_data[$i]['Agent'] =  $rows['username'];
        // }

    }

    $i++;

    //$users[] = $rows;   

}


function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {

    $sort_col = array();

    if(!empty($arr)){
        
        foreach ($arr as $key=> $row) {
            $sort_col[$key] = $row[$col];
        }    
        array_multisort($sort_col, $dir, $arr);
    }

    



    

}





array_sort_by_column($get_data, 'SalesAgentWise');





// print"<pre>";

// print_r($get_data);





$total_sales = 0;

$total_achive =0;

$total_commit = 0;
if(!empty($get_data)){


    foreach($get_data as $row){
        $total_sales += $row['SalesAgentWise'];
    
         
    
        
    
        // $total_achive += $per;
    
         $total_commit += $row['Sale_Target'];
    
        $ach[] =$row;
    
    }
    
}


?>

<?php 

  
  $sel = "SELECT MIN(Date_of_Join) AS 'Min_Date' FROM employee";
  $qry = mysqli_query($connect,$sel);
  $rows = $qry->fetch_assoc();

  $Min_Date = $rows['Min_Date'];
   

  $sel = "SELECT MAX(Date_of_Join) AS 'Max_Date' FROM employee";
  $qry = mysqli_query($connect,$sel);
  $rows = $qry->fetch_assoc();

  $Max_Date = $rows['Max_Date'];

?>


<div class="row">
<form  method="get" action="">
  <div class="col-md-2">
        <div class="form-group">
            <label>From Date</label>
            <input type="date" name="from" class="form-control" value="<?php echo isset($_GET['from'])?$_GET['from']:Date('Y-m-d');?>">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>To Date</label>
            <input type="date" name="to" class="form-control" value="<?php echo isset($_GET['to'])?$_GET['to']:Date('Y-m-d');?>">
        </div>
    </div>
    <div class="col-md-4">
        <label>Agent</label>
        
        <select class="form-control" name="Team_Leader">
            <option value="">Select</option>
            <?php
                //$select_team = "select Team_Leader from employee where Team_Leader != '' AND Team_Leader != 'Admin Assist' AND Team_Leader != 'Compliance Officer' group by Team_Leader";
                $select_team = "SELECT username as agent FROM employee WHERE  Status = 'Active' AND Role='Agent' ORDER BY username ASC";
                $qrys = mysqli_query($connect, $select_team);
                while($fetch_team_leaders = mysqli_fetch_assoc($qrys)){
                    if(isset($_GET['Team_Leader']) && $_GET['Team_Leader'] == $fetch_team_leaders['agent']){
                        echo '<option value="'.$fetch_team_leaders['agent'].'" selected>'.$fetch_team_leaders['agent'].'</option>';
                        continue;
                    }
                    echo '<option value="'.$fetch_team_leaders['agent'].'">'.$fetch_team_leaders['agent'].'</option>';
                }
            ?>
        </select>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary" style="margin-top:25px;">Submit</button>
    </div>
    
</form>

 <!--  <div class="col-md-2">
     <form action="partial/export-excel.php" method="post" id="export-form">
        <button type="" class="btn btn-primary" style="margin-top:25px;">CSV</button>
        <input type="hidden" value='' id='hidden-type' name='ExportType'/>
        </form>
    </div> -->
  </div>

 



<?php


echo('<table id="SalesAgentWiseAll" class="display cell-border" cellspacing="0" width="100%" >');

echo('<thead>');

 echo('<tr>');

  echo('<th style="text-align:center">Rank</th>');

    echo('<th style="text-align:center">Date of Join</th>');
 

  echo('<th style="text-align:center">Agent</th>');
   echo('<th style="text-align:center;">Team Leader</th>');

  echo('<th style="text-align:center">Sales</th>');
 
//   only show to admin
  if($_SESSION['Role'] == 'Super Admin') {
      echo('<th style="text-align:center">Salery</th>');
      echo('<th style="text-align:center">Incentive</th>');
      echo('<th style="text-align:center">Total Payable</th>');
      
  }

   echo('<th style="text-align:center">Achievement</th>');

    echo('<th style="text-align:center">Commitment</th>');

    echo('<th style="text-align:center">Update</th>');

  

   

 echo('</tr>');

echo('</thead>');

echo('<tbody>');
// echo "<pre>";
// print_r($get_data);
// echo "</pre>";
if(!empty($get_data)){

foreach($get_data as $key => $row){

 $select = "select Team_Leader,salery from employee where username = '".$row['Agent']."'";
 $query = mysqli_query($connect,$select);
 $fetch_data = $query->fetch_assoc();

 // if(isset($_GET['Team_Leader']) && $_GET['Team_Leader'] != ''){
   
 //     if($_GET['Team_Leader'] != $fetch_data['Team_Leader']){
 //      die('here1');
 //         continue;
 //     }
 // }

     echo"<tr>";


 echo('<td style="text-align:center">'.($key +1).'</td>');
 
  echo('<td style="text-align:center">'.date('d M Y',strtotime($row['Date_of_Join'])).'</td>');

  

 echo('<td style="text-align:center">'.$row['Agent'].'</td>');
 


 echo('<td style="text-align:center">'.$fetch_data['Team_Leader'].'</td>');

  echo('<td style="text-align:center">'.round($row['SalesAgentWise'], 2).'</td>');
  
//   only show to admin

   if($_SESSION['Role'] == 'Super Admin') {
       
       $incentive = 0;
       
       echo('<td style="text-align:center">'.$fetch_data['salery'].'</td>');


        $sales_amount = $row['SalesAgentWise'];

        if(isset($_GET['from']) && isset($_GET['to'])){
          $sql22 = "select * from incentives_definitions where start_date <= '".$_GET['from']."' and end_date >= '".$_GET['to']."'";
        } else {
          $sql22 = "select * from incentives_definitions where start_date <= now() and (end_date IS NULL OR end_date >= now())";
        }
        $qrys22 = mysqli_query($connect,$sql22);

          while($rows22 = $qrys22->fetch_assoc()){
            if ($sales_amount >= $rows22['value_from'] && $sales_amount <= $rows22['value_to']) {
            // echo "<pre>"; print_r($sales_amount); echo "</pre>";
              $incentive = $rows22['incentive_amount'];
            }
          }
           echo('<td style="text-align:center">'.$incentive.'</td>');
       
      //  if($row['SalesAgentWise'] >= 100000 && $row['SalesAgentWise'] <= 124999){
      //      $incentive = 5000;
      //      echo('<td style="text-align:center">'.$incentive.'</td>');
      //  }
      //  else if($row['SalesAgentWise'] >= 125000 && $row['SalesAgentWise'] <= 149999){
      //      $incentive = 7500;
      //      echo('<td style="text-align:center">'.$incentive.'</td>');
      //  }
      //  else if($row['SalesAgentWise'] >= 150000 && $row['SalesAgentWise'] <= 174999){
      //      $incentive = 10000;
      //      echo('<td style="text-align:center">'.$incentive.'</td>');
      //  }
      // else if($row['SalesAgentWise'] >= 175000 && $row['SalesAgentWise'] <= 199999){
      //      $incentive = 10000;
      //      echo('<td style="text-align:center">'.$incentive.'</td>');
      //  }
      //  else if($row['SalesAgentWise'] >= 200000 && $row['SalesAgentWise'] <= 224999){
      //      $incentive = 12500;    
      //      echo('<td style="text-align:center">'.$incentive.'</td>');
      //  }
      //  else if($row["SalesAgentWise"] > 225000){
          


      //       $incentive = 0;
      //       $devider = intdiv(($row["SalesAgentWise"] - 200000) ,25000);
      //       $incentive = 15000  + ($devider * 3000);
                    
      //     // $addTarget = 25000;
      //     // $incentive = 15000;
      //     //$i = 200000;
      //     // while($row["SalesAgentWise"] > $i){
      //     // echo "string";
      //     //     if($row["SalesAgentWise"]%$addTarget == 0){
      //     //          $incentive = $incentive+3000;
      //     //          $i = $i+25000;
      //     //     }
      //     // }
          
      //     echo('<td style="text-align:center">'.$incentive.'</td>');
      //  }
      //  else{
      //      echo('<td style="text-align:center">'.$incentive.'</td>');
      //  }
       
       echo('<td style="text-align:center">'.($fetch_data['salery'] + $incentive).'</td>');

  }

    if(!empty($row['SalesAgentWise'])) {
        
        $per = round($row['SalesAgentWise']/$row['Sale_Target']*100,0);
        
    } else {
        $per = 0;
    }
    
    

  $per = round($row['SalesAgentWise']/$row['Sale_Target']*100,0);



  if($per>=0 && $per<=40){

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

  echo('<td style="text-align:center"><a href="#_" class="btn btn-primary upDateCommit" data-update-val="'.$row['Sale_Target']."&".$row['Agent']."&".$row['Id'].'" >Update</a></td>');



  

    echo('</tr>');

 

}



}



echo('</tbody>');

echo('</table>');








?>



<table class="table table-bordered pull-right" cellspacing="0" cellpadding="0" style="width:500px;font-weight:bold;text-align:center;margin-top:20px">

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

      
    if(!empty($total_commit)){
        $pp = round($total_sales/$total_commit*100,0);
    } else{
        $pp = 0;
    }
        

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





<!-- Modal -->

<div id="UpdateSaleTarget" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Update Commitment</h4>

      </div>

      <form method="post" action="javascript:void(0)" id="Update_Commit_Form">

      <div class="modal-body">

          <p>Commitment value of : <span id="agent_val">Vishal Kamble</span></p>

        <div> 

        <input id="updates_val" type="number" name="Target" value="15000" required class="form-control"/>

        <input id="updates_val_id" type="hidden" name="Id" value="0" class="form-control"/>

        </div>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary">Update</button>

      </div>

      </form>

    </div>



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
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>     
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script>
 // $('#SalesAgentWiseAll').DataTable();


     $('#SalesAgentWiseAll').DataTable( {
        scrollY:        "500px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        ordering: true,
        info:     true,
         bFilter: true,
         "ordering": true,
         dom: 'Bfrtip',
        buttons: [
             'csv'
        ]
        /*
         fixedColumns:   {
            leftColumns: 1
            
        } 
         ,
         */
    } );
    
    

</script>
