<?php  include('partial/session_start.php'); ?>
<?php
// $UserName = $_GET[ 'UserName' ];
// $Source = $_GET[ 'Source' ];
// $Disposition = $_GET[ 'Disposition' ];
date_default_timezone_set( 'Asia/Kolkata' );
function convert($sum) {
    $years = floor($sum / 365);
    $months = floor(($sum - ($years * 365))/30);
    $days = ($sum - ($years * 365) - ($months * 30));
    $rt = '';
    if($years>0){
        $rt .= $years.' years, ';
    }
    if($months>0){
        $rt .= $months.' months, ';
    }
    $rt.=  $days . " days";
    return $rt;
}
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
    <div class="pull-left"> <a href="memberpage.php">Dashbord</a> | <a href="customer-profile-new-this-month.php">This Month</a> | <a href="customer-profile-new-3-month.php">Last 3 Month</a> | <a href="customer-profile-new-all.php">Customer Profile All</a> | <a href="customer-profile-new-3-month-details.php" >Payment History</a> | <a href="clients.php">Clients Login</a> | <a href="clients-update.php">Client Update</a> </div>
    <!-- <div class="pull-right"><a href="#" class="btn btn-md btn-primary"  data-toggle="modal" data-target="#AddCustomerProfile"><i class="fa fa-plus"></i> Existing</a></div> -->
    <div class="pull-right" style="margin-right:15px;"><a href="customer-profile-payment-history-new-add.php?cust=<?php echo $_GET['cust']; ?>" class="btn btn-xs btn-primary add-new-transaction" ><i class="fa fa-plus"></i> New</a></div>
    <div class="clearfix"></div>
  </div>
  <div class="containter" style="padding:20px 20px 0 20px;">
    <?php include('connection/dbconnection_crm.php')?>
    <?php
    $sql = ( "SELECT id,Costumer_ID, Approval_Status, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name,  Email_ID, Mobile_No, Number_of_Days, Pan_Number, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate , 
    DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout,  Company_Amount, Tax_Amount, PaymentMode, 
    Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount, Agent_1_TL,
    Agent_2, Agent_2_Percentange, Agent_2_Shared_Amount, Agent_2_TL,
    Agent_3, Agent_3_Percentange, Trading_Guidence_Mail, Agent_3_Shared_Amount, Agent_3_TL,
    Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_Payment_History where Costumer_ID = '".$_GET['cust']."' ORDER BY  `Id` DESC LIMIT 0 , 60" );
    // echo $sql;
    $result = mysqli_query($connect, $sql );
    echo( '<table id="Customer_profile" class="display" cellspacing="0" width="100%">' );
    echo( '<thead>' );
    echo( '<tr>' );
    echo( '<th>Costumer ID</th>' );

    echo('<th>Download Invoice</th>');

    echo('<th>Trading Guidence Email Status</th>');
    echo( '<th>Sale Date</th>' );
    echo( '<th>Full Name</th>' );
    echo( '<th>Package</th>' );
     echo( '<th>Expiry Date</th>' );
    echo( '<th>Payment Mode</th>' );
    echo( '<th>Total Received</th>' );
    echo( '<th>Company Amount</th>' );
    echo( '<th>Tax</th>' );
   // echo( '<th>Number_of_Days</th>' );
    echo( '<th>Agent</th>' );
    echo( '<th>Percentage</th>' );
    echo( '<th>Shared Amount</th>' );
    echo( '<th>TeamLeads</th>' );
    echo( '<th>Approval Status</th>' );
    if($_SESSION['Role'] == 'Super Admin' || $_SESSION['Role'] == 'Admin Assist' ) { 
   // echo('<th>Update</th>');
    echo('<th>Delete</th>');

}
    echo( '</tr>' );
    echo( '</thead>' );
    echo( '<tbody>' );
    $i = 0;
    while ( $row =  $result->fetch_array() ) {
        $i++;
      echo( '<tr>' );
      echo( '<td>' . $row[ 'Costumer_ID' ] . '</td>' );
      echo('<td><a href="customer-profile-invoice.php?id='.$row["Costumer_ID"].'" class="btn btn-danger btn-xs invoice" download target="_blank"><i class="fa fa-download" aria-hidden="true"></i> Invoice<a/></td>');
      ?>
      <td>
    <?php
        if($row['Trading_Guidence_Mail'] == 'Pending'){
            ?>
            <span class="badge" style="background:#ffc107;color:#000;">Trading Guidence Email Pending</span>
            <?php
                if(1){
            ?>
            <br>
            <a href="Ajax_files/extend-package-email.php?id=<?php echo $row['id']; ?>" style="text-align:center;"><button class="btn btn-xs btn-primary" style="margin-top:5px;margin-left:15px;">Send Trading Guidence Email</button></a>
            <?php
                }
        }
        else{
            ?>
            <span class="badge" style="background:#1e7e34;color:#fff;">Trading Guidence Email Sent</span>
            
            <?php
        }
    ?>
    
</td>
<?php
      echo( '<td>' . $row[ 'SaleDateIND' ] . '</td>' );
      echo( '<td>' . $row[ 'Full_Name' ] . '</td>' );
      echo( '<td>' . $row[ 'PackageName' ] . '</td>' );
      echo( '<td>' . $row[ 'ExpDate' ] . '</td>' );
      echo( '<td>' . $row[ 'PaymentMode' ] . '</td>' );
      echo( '<td>' .'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'. $row[ 'Paid_Amout' ] . '</td>' );
      echo( '<td>' .'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'. $row[ 'Company_Amount' ] . '</td>' );
      echo( '<td>' .'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'. $row[ 'Tax_Amount' ] . '</td>' );
      //echo( '<td>' .'&nbsp;'. convert($row[ 'Number_of_Days' ]) . '</td>' );
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
              echo '<li>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'. $row[ 'Agent_1_Shared_Amount' ].'</li>';
          }
           if( $row[ 'Agent_2_Shared_Amount' ]){
              echo '<li>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'. $row[ 'Agent_2_Shared_Amount' ].'</li>';
          }
           if( $row[ 'Agent_3_Shared_Amount' ]){
              echo '<li>'.'<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;'. $row[ 'Agent_3_Shared_Amount' ].'</li>';
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

     <td>
         <?php echo isset($row['Approval_Status']) ? $row['Approval_Status'] :''; ?>
        <?php if($row['Approval_Status'] != "Approved"){
            // echo "<pre>"; print_r($row); echo "</pre>";
              echo '<br><a href="javascript:void(0)" onclick="changeStatus('.$row['Costumer_ID'].','.$row['id'].')">Approve now</a>';
             }
         ?>    
     </td>
      <?php
      
      
      if($_SESSION['Role'] == 'Super Admin' || $_SESSION['Role'] == 'Admin Assist' ) { 
          echo( '<td>');
          if($i == 1){
             ?>
             <a onclick="return confirm('Are you sure?')" href="customer-profile-payment-history-new-delete.php?cust=<?php echo $_GET['cust']; ?>&id=<?php echo $row['id']; ?>" class="btn btn-xs btn-danger">Delete</a>
             <?php
          }
          
      echo( '<a href="customer-profile-payment-history-new-update.php?Id='.$row['id'].'"  class="btn btn-xs btn-primary"  >Update</a>' );
      
      echo '</td>';
      
      }
    }
    echo( '</tr>' );
    echo( '</tbody>' );
    echo( '</table>' );
    ?>
  </div>
</div>






<?php include('partial/footer.php') ?>

<script>

    // $(document).ready(()=>{
        function changeStatus(Costumer_ID,id){

            $.ajax({
                type:"post",
                url:"Ajax_files/update_profile_status_for_specific_payment_history.php",
                data:{
                    CustomerId: Costumer_ID, row_id:id
                },
                success:(res)=>{
                    window.location.reload();
                    console.log(res);
                }
            })
        }
// });
</script>