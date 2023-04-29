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

        <form action="" method="GET">

            <div class="form-group" style="width: 200px;float: left;">
                <label for="Start Date">Start Date:</label>
                <input class="form-control" type="date" value="<?php echo isset($_GET['start'])?$_GET['start']:date('Y-m-d',strtotime("-1 month"));?>" name="start"  required="">
            </div>

            <div class="form-group" style="width: 200px;float: left;margin-left: 15px;">
                <label for="End Date">End Date:</label>
                <input class="form-control" type="date" value="<?php echo isset($_GET['end'])?$_GET['end']:date('Y-m-d');?>" name="end" required="">
            </div>



            <div class="form-group" style="width: 200px;float: left;margin-left: 15px;">
                <label for="Select Employee">Select Employee:</label>

                <?php
                $sel = "select Team_Leader from employee where Team_Leader != '' group by Team_Leader";
                $qry = mysqli_query($connect,$sel);
                $total_calculation = 0;
                ?>
                 <select class="form-control" name="employee" required>
                  <option value="" >Select</option>
                    <?php
                    while($rows = mysqli_fetch_assoc($qry)){
                        if(isset($_GET['employee']) && $_GET['employee'] == $rows['Team_Leader'] )
                        {?>
                            <option value="<?php echo $rows['Team_Leader'] ?>" selected><?php echo $rows['Team_Leader'] ?></option> 
                       <?php }else{
                        ?>
                        <option value="<?php echo $rows['Team_Leader'] ?>"><?php echo $rows['Team_Leader'] ?></option> 
                        <?php 
                    }}?>

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


      function getSharedByTeamLeader($users,$current_month,$current_year){

        global $connect;
    //global $username;
        $TL_1_total = 0;
        $TL_2_total = 0;
        $TL_3_total = 0;

        $sql = ("SELECT SUM(Agent_1_Shared_Amount) AS Total1, SUM(Agent_2_Shared_Amount) AS Total2 , SUM(Agent_3_Shared_Amount) AS Total3 
          FROM Customer_Payment_History 
          where 
          (Agent_1_TL='".$users."' OR Agent_2_TL='".$users."' OR Agent_3_TL='".$users."')
          AND MONTH(  `SaleDate` ) = $current_month AND YEAR(`SaleDate`) = $current_year AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");
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

            // echo $last_year;
            // die();
                        //   $total_calculation += $t_count;

            if(isset($_GET['start']) && isset($_GET['end']))
            {
                  $date = $_GET['start'];

                  $year = date('Y', strtotime($date));

                  $current_month = date('m', strtotime($_GET['end']));
                   $month = date('M', strtotime($_GET['end']));
                  $ccurrent_month = date('m', strtotime($date));
                  $last_year = date("Y",strtotime($date));
                  $current_year = date("Y",strtotime($_GET['end']));

          }
          ?>
          <?php   while($last_year <= $current_year){   
           ?>
           <div class="panel-heading font-size18">Sales Report of  <?=  $month;?> <?= $current_year; ?> </div>
           <div class="panel-body">
            <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <?php
                 if(isset($_GET['employee']) && $_GET['employee'] !='')
                    {
                        $sel = "select Team_Leader from employee where Team_Leader= '".$_GET['employee']."' group by Team_Leader";
                    }
                    else
                    {
                        $sel = "select Team_Leader from employee where Team_Leader != '' group by Team_Leader";
                    }
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
                      echo $t_count = (int)getSharedByTeamLeader($rows['Team_Leader'],$current_month,$current_year);
                      $total_calculation += $t_count;

                      ?></strong>

                  </td>
              </tr>
              <?php
          }
          ?>

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

if($current_year == $last_year && $current_month == $ccurrent_month){

    break;
}


if($current_month == '1'){
  $current_year = $current_year - 1;
  $current_month = 12;
}
else{
    if($current_year == $last_year && $current_month == $ccurrent_month){
    break;
}
    $current_month = $current_month - 1;
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
