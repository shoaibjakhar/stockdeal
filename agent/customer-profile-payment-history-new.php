<?php  include('partial/session_start.php'); ?>
<?php
$UserName = $_GET[ 'UserName' ];
$Source = $_GET[ 'Source' ];
$Disposition = $_GET[ 'Disposition' ];
date_default_timezone_set( 'Asia/Kolkata' );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Customer Profile</title>
<?php require('partial/plugins.php'); ?>
</head>
<body>
<?php include('partial/sidebar.php') ?>
<div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>
  </header>
  <div class="breadcurms">
    <div class="pull-left"> <a href="memberpage.php">Dashbord</a> | <a href="customer-profile-new-this-month.php">This Month</a> </div>
    <!-- <div class="pull-right"><a href="#" class="btn btn-md btn-primary"  data-toggle="modal" data-target="#AddCustomerProfile"><i class="fa fa-plus"></i> Existing</a></div> -->
    <div class="pull-right" style="margin-right:15px;"><a href="customer-profile-payment-history-new-add.php?cust=<?php echo $_GET['cust']; ?>" class="btn btn-xs btn-primary add-new-transaction"  ><i class="fa fa-plus"></i> New</a></div>
    <div class="clearfix"></div>
  </div>
  <div class="containter" style="padding:20px 20px 0 20px;">
    <?php include('connection/dbconnection_crm.php')?>
    <?php
    $sql = ( "SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, Number_of_Days, Email_ID, Mobile_No, Approval_Status, Pan_Number, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate , 
    DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout,  Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount, Agent_1_TL,
    Agent_2, Agent_2_Percentange, Agent_2_Shared_Amount, Agent_2_TL,
    Agent_3, Agent_3_Percentange, Agent_3_Shared_Amount,  Agent_3_TL,
    Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert,Approval_Status  FROM Customer_Payment_History where Costumer_ID = '".$_GET['cust']."' ORDER BY  `Id` DESC LIMIT 0 , 60" );
    $result = mysqli_query($connect, $sql );
    echo( '<table id="Customer_profile" class="display" cellspacing="0" width="100%">' );
    echo( '<thead>' );
    echo( '<tr>' );
    echo( '<th>Costumer ID</th>' );
    echo '<th>Approval Status</th>';
    echo( '<th>Sale Date</th>' );
    echo( '<th>Full Name</th>' );
    echo( '<th>Package</th>' );
     echo( '<th>Expiry Date</th>' );
    echo( '<th>Payment Mode</th>' );
    echo( '<th>Total Received</th>' );
    echo( '<th>Company Amount</th>' );
    echo( '<th>Tax</th>' );
        echo( '<th>Number_of_Days</th>' );
    echo( '<th>Agent</th>' );
    echo( '<th>Percentage</th>' );
    echo( '<th>Shared Amount</th>' );
    echo( '<th>TeamLeads</th>' );
    echo( '<th>Update</th>' );
   // echo( '<th>Delete</th>' );
    echo( '</tr>' );
    echo( '</thead>' );
    echo( '<tbody>' );
    $i = 0;
    while ( $row = mysqli_fetch_array( $result ) ) {
        $i++;
      echo( '<tr>' );
      echo( '<td>' . $row[ 'Costumer_ID' ] . '</td>' );
      if($row['Approval_Status'] == 'Pending'){
          echo '<td><button class="btn btn-xs btn-danger">'.$row['Approval_Status'].'</button></td>';
      }
      else{
          echo '<td><button class="btn btn-xs btn-success">'.$row['Approval_Status'].'</button></td>';
      }
      
      echo( '<td>' . $row[ 'SaleDateIND' ] . '</td>' );
      echo( '<td>' . $row[ 'Full_Name' ] . '</td>' );
      echo( '<td>' . $row[ 'PackageName' ] . '</td>' );
      echo '<td>'.$row['ExpDate'].'</td>';
      echo( '<td>' . $row[ 'PaymentMode' ] . '</td>' );
      echo( '<td>' .'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'. $row[ 'Paid_Amout' ] . '</td>' );
      echo( '<td>' .'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'. $row[ 'Company_Amount' ] . '</td>' );
      echo( '<td>' .'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'. $row[ 'Tax_Amount' ] . '</td>' );
      echo( '<td>' .'&nbsp;'. $row[ 'Number_of_Days' ] . '</td>' );
      ?>
      <td>
          <ol class="">
          <?php
          if( $row[ 'Agent_1' ]){
              echo '<li>'. $row[ 'Agent_1' ].'</li>';
          }
           if( $row[ 'Agent_2' ]){
              echo '<li>'. $row[ 'Agent_2' ].'</li>';
          }
           if( $row[ 'Agent_3' ]){
              echo '<li>'. $row[ 'Agent_3' ].'</li>';
          }
          
           
           ?>
           </ol>
    </td>
     <td>
          <ol class="">
          <?php
          if( $row[ 'Agent_1_Percentange' ]){
              echo '<li>'. $row[ 'Agent_1_Percentange' ].'%'.'</li>';
          }
           if( $row[ 'Agent_2_Percentange' ]){
              echo '<li>'. $row[ 'Agent_2_Percentange' ].'%'.'</li>';
          }
           if( $row[ 'Agent_3_Percentange' ]){
              echo '<li>'. $row[ 'Agent_3_Percentange' ].'%'.'</li>';
          }
          
           
           ?>
           </ol>
    </td> <td>
          <ol class="">
          <?php
          if( $row[ 'Agent_1_Shared_Amount' ]){
              echo '<li>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'. number_format($row[ 'Agent_1_Shared_Amount' ],2).'</li>';
          }
           if( $row[ 'Agent_2_Shared_Amount' ]){
              echo '<li>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'. number_format($row[ 'Agent_2_Shared_Amount' ],2).'</li>';
          }
           if( $row[ 'Agent_3_Shared_Amount' ]){
              echo '<li>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'. number_format($row[ 'Agent_3_Shared_Amount' ],2).'</li>';
          }
          
           
           ?>
           </ol>
    </td>

    <td>
          <ol class="">
          <?php
          if( $row[ 'Agent_1_TL' ]){
              echo '<li>'. $row[ 'Agent_1_TL' ].'</li>';
          }
           if( $row[ 'Agent_2_TL' ]){
              echo '<li>'. $row[ 'Agent_2_TL' ].'</li>';
          }
           if( $row[ 'Agent_3_TL' ]){
              echo '<li>'. $row[ 'Agent_3_TL' ].'</li>';
          }
          
           
           ?>
           </ol>
    </td>
     
      <?php
    //   $cr_time = time();
    //  $sale_date = strtotime($row['SaleDateIND']);
    //  $datediff = $cr_time - $sale_date;
    //  if(round($datediff/(60*60*24))<=2 && $row['Approval_Status'] == 'Pending'){
         
    //      // echo( '<td><a href="customer-profile-payment-history-new-update.php?cust='.$_GET['cust'].'&id='.$row['id'].'"  class="btn btn-xs btn-primary update_history"  id="'.$row['id'].'" >Udate</a></td>' );
    //     }
    // else{
    //     echo ('<td></td>');
    // }
    if($i == 1 && $row['Approval_Status'] != 'Approved'){
         echo( '<td><a href="customer-profile-payment-history-new-delete.php?cust='.$_GET['cust'].'&id='.$row['id'].'"  class="btn btn-xs btn-danger update_history"  id="'.$row['id'].'" >Delete</a></td>' );
    }
    else{
        echo '<td></td>';
    }
     // echo( '<td><a href="#"  class="btn btn-xs btn-primary update_history"  id="'.$row['id'].'" >Udate</a></td>' );
      
    }
    echo( '</tr>' );
    echo( '</tbody>' );
    echo( '</table>' );
    ?>
  </div>
</div>


<?php include('partial/footer.php') ?>
