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
    <div class="breadcurms"> <a href="memberpage.php">Dashboard</a> | <a href="daily-tl-wise-report.php">Daily TL Wise Report</a> | <a href="stock-tips-report.php">Stock Tips Report</a> | <a href="employee-working-status.php">Employee Working Status</a> | <a href="management-working-status.php">Management Working Status</a></div>
    <div class="containter" style="padding:20px 20px 0 20px;">



        <div class="row">
            <div class="col-sm-12" style="visibility:">  
                <div class="panel panel-primary">
                  <div class="panel-heading font-size18">Employee Working Status</div>
                  <div class="panel-body" style="">
  
                    <table class="table table-bordered" id="employee_working_status">
                        <thead>
                            <tr>
                              <th>Agent Name</th>
                              <th>Role</th>
                              <th>Login Status</th>
                              <th>Login Time</th>
                              <th>Total Time</th>
                              <th>Dinner</th><th>Tea</th><th>Meeting</th><th>Meeting Remark</th><th>Total Break Time</th><th>Break Status</th><th>Today's Follow ups</th>
                          </tr>
                      </thead>
                   
                         <tbody>
                                    <?php 
                                   // SELECT attendence.*,'employee.Status' AS 'login_status' FROM 'attendence' JOIN 'employee' ON 'attendence.user_id' = 'employee.id' WHERE 'attendence.date' = '19-10-2022';
                                    // SELECT * FROM `attendence` WHERE `date`='19-10-2022'
                                     $current_date = date("d-m-Y");
                                    $sql="SELECT attendence.*, employee.Login_Status AS login_status,employee.Role FROM attendence JOIN employee ON attendence.user_id=employee.id WHERE attendence.date='$current_date' AND employee.Role='Agent'";

                                
                                    $qryss = mysqli_query($connect,$sql);

                                    if(!empty($qryss))
                                    {   

                                      while($rows = mysqli_fetch_assoc($qryss))
                                      { 
                                        echo "<tr>";
                                            echo "<td>".$rows['Agent_Name']."</td>";
                                            echo "<td>".$rows['Role']."</td>";

                                            // echo "<td>".$rows['login_status']."</td>";
                                            if($rows['login_status'] =="Active")
                                            {
                                               echo '<td><span class="badge" style="background:green;">Active</span></td>';
                                            }
                                            else
                                            {
                                                echo '<td><span class="badge" style="background:red;">InActive</span></td>';
                                            }
                                            echo "<td>".$rows['login_time']."</td>";
                                            echo "<td>".$rows['total_time']." Minutes</td>";
                                            echo "<td>".$rows['dinner']." Minutes</td>";
                                            echo "<td>".$rows['tea']." Minutes</td>";
                                            echo "<td>".$rows['meeting']." Minutes</td>";
                                            echo "<td>".$rows['Meeting_Remark']."</td>";
                                            echo "<td>".$rows['total_break_time']." Minutes</td>";
                                            echo "<td>".$rows['SaleDate']."</td>";
                                            echo "<td>".$rows['Today Follow ups']."</td>";
                                        echo "</tr>";
                                     }

                                 }


                                 ?>
                                <!-- <tr>
                                    <td>01-Oct 2022</td>
                                    <td><strong>?0.00</strong></td>
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
 $('#employee_working_status').DataTable();
</script>