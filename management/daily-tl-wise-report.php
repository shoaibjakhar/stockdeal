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
 <!--  <div class="breadcurms"> <a href="memberpage.php">Dashbord</a>  </div> -->
 <div class="breadcurms"> <a href="memberpage.php">Dashboard</a> | <a href="daily-tl-wise-report.php" class="btn btn-xs btn-success">Daily TL Wise Report</a> | <a href="stock-tips-report.php">Stock Tips Report</a> | <a href="employee-working-status.php">Employee Working Status</a> | <a href="management-working-status.php">Management Working Status</a></div>
<div class="containter" style="padding:20px 20px 0 20px;">


    
    <div class="row">
        
              <div class="col-sm-12" style="">
            <div class="panel panel-primary">
                <div class="panel-heading font-size18">Daily Team Leaders Wise Sales Reports Oct 2022</div>
                <div class="panel-body">
                    <table width="100%;" id="Tl_wise_Report" class="table table-bordered table-hover" border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <!--<tr>-->
                            <!--    <th colspan="2">Daily Team Leaders Wise Sales Reports</th>-->
                                
                            <!--</tr>-->
                            <tr>
                                <th>Date</th>
                                                                <th style="vertical-align: middle;"><strong>Total</strong></th>
                                <!--<th>Meena Sarode</th>-->
                            </tr>
                        </thead>
                            <tbody>
                            <?php 
								   $sql="select SUM(Paid_Amout) as 'total_sale_pr_day',`SaleDate` from Customer_Payment_History group by SaleDate ORDER BY SaleDate, 'ASC'";
								   $qryss = mysqli_query($connect,$sql);
							    
							    if(!empty($qryss))
							    {	
						          
						           	while($rows = mysqli_fetch_assoc($qryss))
						           	{	
						           		echo "<tr>";
						           		echo "<td>".$rows['SaleDate']."</td>";
						                echo "<td><strong>₹".$rows['total_sale_pr_day']."</strong></td>";
						                echo "</tr>";
						          	}
						          	
							    }
							     

							?>
                                <!-- <tr>
                                    <td>01-Oct 2022</td>
                                    <td><strong>₹0.00</strong></td>
                                </tr> -->
                                                       
                            </tbody>
                    </table>
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
<script>
 $('#Tl_wise_Report').DataTable();
</script>