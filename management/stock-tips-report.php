<?php  include('partial/session_start.php'); ?>
<?php include('connection/dbconnection_crm.php')?>


<?php

	$day_negative = 0;
	$day_positive = 0;
	$day_open     = 0;

	$week_negative = 0;
	$week_positive = 0;
	$week_open     = 0;


	$month_negative = 0;
	$month_positive = 0;
	$month_open     = 0;

	$all_negative = 0;
	$all_positive = 0;
	$all_open     = 0;

// Get report Towday:
$sql1 ="SELECT Result, count(*) as NUM ,DATE_FORMAT( DateTime, '%d-%m-%Y %H : %i' ) AS DateTimeCurrent  FROM stock_tips WHERE Date =  '".$TodaysDate."'  GROUP BY Result";



$result = mysqli_query($connect,$sql1);
while($row = $result->fetch_array())
{
	if($row['Result'] =="Negative")
	{
		$day_negative = $row['NUM'];
	}
	if($row['Result'] =="Positive")
	{
		$day_positive = $row['NUM'];
	}
	if($row['Result'] =="Open")
	{
		$day_open = $row['NUM'];
	}
}

// Get report Thiseek:
$sql2 ="SELECT Result, count(*) as NUM FROM stock_tips WHERE YEARWEEK(`date`, 1) = YEARWEEK(CURDATE(), 1) GROUP BY Result";

$result = mysqli_query($connect,$sql2);
while($row = $result->fetch_array())
{
	if($row['Result'] =="Negative")
	{
		$week_negative = $row['NUM'];

	}
	if($row['Result'] =="Positive")
	{
		$week_positive = $row['NUM'];
	}
	if($row['Result'] =="Open")
	{
		$week_open = $row['NUM'];
	}
}

$sql3 ="SELECT Result, count(*) as NUM FROM stock_tips WHERE Year(date)=Year(CURDATE()) AND Month(`date`)= Month(CURDATE()) GROUP BY Result";

$result = mysqli_query($connect,$sql3);
while($row = $result->fetch_array())
{
	if($row['Result'] =="Negative")
	{
		$month_negative = $row['NUM'];

	}
	if($row['Result'] =="Positive")
	{
		$month_positive = $row['NUM'];
	}
	if($row['Result'] =="Open")
	{
		$month_open = $row['NUM'];
	}
}

$sql4 ="SELECT Result, count(*) as NUM FROM stock_tips GROUP BY Result";

$result = mysqli_query($connect,$sql4);
while($row = $result->fetch_array())
{
	if($row['Result'] =="Negative")
	{
		$all_negative = $row['NUM'];

	}
	if($row['Result'] =="Positive")
	{
		$all_positive = $row['NUM'];
	}
	if($row['Result'] =="Open")
	{
		$all_open = $row['NUM'];
	}
}








//die();




//over all result
$sql5 = "SELECT COUNT(id) AS Total FROM `clients`";
$result = mysqli_query($connect,$sql5);
$result = $result->fetch_array();

$total_customer = $result['Total'];


$sql  = "SELECT Id, Ideas, Sagment, Result, DATE_FORMAT( DateTime,  '%d-%m-%Y %H : %i' ) AS DateTimeCurrent FROM stock_tips WHERE Date = '".$TodaysDate."' ORDER BY `stock_tips`.`DateTime` DESC";
// echo $sql;
// exit; 
$result = mysqli_query($connect,$sql);
// echo "<pre>";
// print_r($result->fetch_array());

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
 <!--  <div class="breadcurms"> <a href="memberpage.php">Dashbord</a>  </div> -->
 <div class="breadcurms"> <a href="memberpage.php">Dashboard</a> | <a href="daily-tl-wise-report.php">Daily TL Wise Report</a> | <a href="stock-tips-report.php" class="btn btn-xs btn-success">Stock Tips Report</a> | <a href="employee-working-status.php">Employee Working Status</a> | <a href="management-working-status.php">Management Working Status</a></div>
<div class="containter" style="padding:20px 20px 0 20px;">
    
    <div class="row">
        
        <div class="col-sm-12">
            
          
      
      
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
                  <td style="background:#e74c3c;color:#fff;"><strong>Negative</strong></td>
                </tr>
                <tr>
                  <td><strong>Today's</strong></td>
                  <td style="background:#3498db;color:#fff;">
                  	<?php echo $day_open;?> 
                	

                  </td>
                  <td style="background:#27ae60;color:#fff;">
                 <?php echo $day_positive;?>
                	             
                  </td>
                  <td style="background:#e74c3c;color:#FFF;">
                  <?php echo $day_negative;?>                  
                   </td>
                </tr>
                <tr>
                  <td><strong>This week</strong></td>
                  <td style="background:#3498db;color:#fff;"> <?php echo $week_open;?></td>
                  <td style="background:#27ae60;color:#fff;"> <?php echo $week_positive;?></td>
                  <td style="background:#e74c3c;color:#fff;"> <?php echo $week_negative;?> </td>
                </tr>
                <tr>
                  <td><strong>This Month</strong></td>
                 <td style="background:#3498db;color:#fff;"> <?php echo $month_open;?></td>
                  <td style="background:#27ae60;color:#fff;"> <?php echo $month_positive;?></td>
                  <td style="background:#e74c3c;color:#fff;"> <?php echo $month_negative;?> </td>
                </tr>
                <tr>
                  <td><strong>Till Now</strong></td>
                  <td style="background:#3498db;color:#fff;"> <?php echo $all_open;?></td>
                  <td style="background:#27ae60;color:#fff;"> <?php echo $all_positive;?></td>
                  <td style="background:#e74c3c;color:#fff;"> <?php echo $all_negative;?> </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        </div>
        
        <div class="col-md-4">
		    <div class="panel panel-default" style="">
                <div class="panel-heading font-size16">Stock Tips Reports This Week</div>
                <div class="panel-body">
                	<div style="max-width: 380px;">
                	    <canvas id="this_week" width="330" height="330" style="display: block;"></canvas>
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
                      data: ["<?php echo$week_open; ?>","<?php echo$week_positive; ?>","<?php echo$week_negative; ?>"],
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
        
        <div class="col-md-4">
		    <div class="panel panel-default" style="">
                <div class="panel-heading font-size16">Stock Tips Reports This Month</div>
                <div class="panel-body">
                	<div style="max-width: 380px;">
                	    <canvas id="this_month" width="330" height="330" style="display: block;"></canvas>
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
                      data: ["<?php echo$month_open; ?>","<?php echo$month_positive; ?>","<?php echo$month_negative; ?>"],
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
        
        
        <div class="col-md-4">
		    <div class="panel panel-default" style="">
                <div class="panel-heading font-size16">Stock Tips Reports Total Till Now</div>
                <div class="panel-body">
                	<div style="max-width: 380px;">
                	    <canvas id="myChart" width="330" height="330" style="display: block;"></canvas>
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
                      data: ["<?php echo$all_open; ?>","<?php echo$all_positive; ?>","<?php echo$all_negative; ?>"],
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
        
        <div class="col-md-4">
        
        <div class="panel panel-primary">
                      <div class="panel-heading font-size18">Total unique customers till date</div>
          <div class="panel-body">
            <table width="" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                
                <!--<tr>
                                   <td style="font-size:26px;">
                
                  </td>
              
                </tr>-->
                
                <tr>
                    <th>Month</th>
                    <th>Customer</th>
                </tr>
                <tr>
                            <td><?php
							 $yrdata= strtotime(date('Y-m-d'));
							    echo date('M-Y', $yrdata);
							 ?>
							 	
							 </td>
                            <td><a target="_blank" href="customer-profile-all-in-one.php?filter=unique&amp;date=2022-10-17"><?php echo $total_customer ?></a></td>
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
    <div class="clearfix"></div>
  </div>
</div>
<?php include('partial/footer.php') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
