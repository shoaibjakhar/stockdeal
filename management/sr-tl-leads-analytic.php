<?php  include('partial/session_start.php'); ?>
<?php //include($_SERVER['DOCUMENT_ROOT']."/partial/access-control-role-base.php"); ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Analytics Reports</title>
  <?php require('partial/plugins.php'); ?>

  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 26px;
    }
    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 18px;
      width: 18px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }

  </style>
</head>
<body>
  <?php include('partial/sidebar.php') ?>
  <div class="main_container">
    <header>
      <?php include('partial/header-top.php') ?>
    </header>


    <!-- 	<div class="breadcurms">  <a href="upload-leads.php" class="btn btn-xs btn-primary">Upload Leads</a></div> -->
    <div class="breadcurms"> 
      <a href="sr-tl-leads-analytic.php" style="margin-left: -5px;" class="">Analytics Reports</a> <!-- | <a href="analytics-date.php?filter=leads-count">Leads Count</a> | <a href="export-leads.php">Export Leads</a> | <a href="whatsapp-number-update.php" class="">Whatsapp Number Update</a> | <a href="ip-restriction-history.php" class="">Ip Restriction</a> | <a href="leads-count.php" class="btn btn-xs btn-primary">Assigned Leads Analytics</a>  | <a href="upload-leads.php">Upload Leads</a> -->      
    </div>


    <div class="containter" style="padding:20px 20px 0 20px;">



      <div class="row">


        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

        <div class="col-sm-12" style="display:;">

          <div class="panel panel-default" style="">
            <div class="panel-heading font-size16">

              <a href="#">Assigned Leads Count</a>

              <div class="clearfix"></div>      </div>  
              <div class="panel-body">



                <div class="col-sm-12" style="display:;">

                  <div class="panel panel-default" style="">

                    <div class="panel-body">


                      <div class="row">
                       <div class="col-sm-12 ML20 MB20" style="padding: 25px 15px;">
                        <form class="form-inline" action="#" method="GET">
                          <div class="form-group">
                            <label for="email">From Date:</label>
                            <input type="date" class="form-control ML10"  id="dates" name="from" value="<?php echo isset($_GET['from'])?$_GET['from']:Date('Y-m-d');?>" required="">
                          </div>
                          <div class="form-group">
                            <label for="email" class=" ML10">To Date:</label>
                            <input type="date" class="form-control ML10"  id="dates" name="to"  value="<?php  echo isset($_GET['from'])?$_GET['to']:Date('Y-m-d');?>" required="">
                          </div>
                          <div class="form-group">
                            <label for="email" class=" ML10" style="display:">Source:</label>
                            <select class="form-control ML10" name="source" style="" required>
                           
                              <?php include('partial/source_name.php') ?>
                              <?php 
                                    if(isset($_GET['source']))
                                    {
                              ?>
                                  <option value="<?php echo $_GET['source']?>" selected><?php echo $_GET['source']?></option>
                            <?php }?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="email" class=" ML10">Filter Leads:</label>
                            <select class="form-control ML10" name="UserName" required>
 
                              <?php include('partial/team-leader.php') ?>
                              <?php 
                                    if(isset($_GET['UserName']))
                                    {
                              ?>
                                  <option value="<?php echo $_GET['UserName']?>" selected><?php echo $_GET['UserName']?></option>
                            <?php }?>
                            </select>
                          </div>
                          <!--<input type='hidden' name="TabValue" value="" />-->
                          <!-- <button type="submit" class="btn btn-primary  ML10" style="margin-left:10px;">Submit</button> -->
                          <input type = "submit" name = "submit" value = "Submit"  class="btn btn-primary  ML10">
                          <a href="sr-tl-leads-analytic.php" class="btn btn-default  ML10" style="margin-left:20px;">Reset</a>
                        </form>
                      </div>
                    </div>

                    <div class="col-sm-4" style="display:;">

                      <div class="panel panel-default" style="">
                        <div class="panel-heading font-size16">Source </div>
                        <div class="panel-body">

                          <table width="100%" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                              <tr>
                                <td><strong>Source</strong></td>
                                <td><strong>Count</strong></td>

                              </tr>
                              <tr>
                                <th>Total</th>
                                <th colspan=""><strong>
                                  <?php 
                                     $result = mysqli_query($connect, "SELECT COUNT(*) as total FROM Assigned_Leads WHERE UserName='".$username."' GROUP BY Source");
                                     $rowcount=mysqli_num_rows($result);
                                      echo $rowcount;
                                  ?>
                                </strong></th>

                              </tr>
                            </tbody>
                          </table>


                        </div>
                      </div>



                      <div class="panel panel-default" style="">
                        <div class="panel-heading font-size16">Leads Assigned Team Leader </div>
                        <div class="panel-body">

                          <table width="100%" class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                              <tr>
                                <td><strong>Total Team Leader</strong></td>
                                <td><strong>Count</strong></td>

                              </tr>
                              <tr>
                                <th>Total</th>
                                <th colspan=""><strong>
                                  <?php 
                                     $query =  $qry_agents = "SELECT Assigned_Leads.* 
                                      from Assigned_Leads 
                                      INNER JOIN employee ON Assigned_Leads.UserName = employee.username
                                      where employee.Team_Leader = '".$username."' GROUP BY Assigned_Leads.UserName ";

                                    
                                     $result =  mysqli_query($connect,$query);
                                     //echo mysql_result($result, 0);
                                      $rowcount=mysqli_num_rows($result);
                                     echo $rowcount;
                                  ?>
                                </strong></th>

                              </tr>
                            </tbody>
                          </table>


                        </div>
                      </div>

                    </div>  

                    <div class="col-sm-4" style="display:;">

                      <div class="panel panel-default" style="">
                        <div class="panel-heading font-size16">Disposition Wise</div>
                        <div class="panel-body">

                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered" style="font-weight: bold;">
                            <thead>
                              <tr>
                                <th>Disposition </th>
                                <th>Leads</th>
                              </tr>
                            </thead>

                           <?php
  
                              if (isset($_GET['submit'])) {
                                  
                                  $from = $_GET['from']; 
                                  $to = $_GET['to']; 
                                  $UserName = $_GET['UserName']; 
                                  $source = $_GET['source'];
                                  
                                  $UserName = str_replace("+"," ",$UserName);
    
                                  // $query="SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'CBWOP') AND UserName ='".$UserName."'";
                                  // echo $query;
                                  // die();
                                  
                                  // $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'CBWOP') AND UserName ='".$UserName."'");
                                  // echo mysql_result($result, 0);

                                    
                                  
                            ?>


                          

                             <tbody>
                              <tr class="yellow-bg">
                                <td>Busy tone</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Busy tone&amp;source=">
                                  <?php
                                 // echo ("SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'B') AND UserName ='".$UserName."'");

                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'B') AND UserName ='".$UserName."'");
                                  
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];

                                  ?>
                                </a></td>
                              </tr>
                              <tr class="green-bg">
                                <td>Paid Customer</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Paid Customer&amp;source=">
                                  <?php
                                 
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'PC') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];

                                  ?>
                                </a></td>
                              </tr>
                              <tr class="yellow-bg">
                                <td>Hung Up</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Hung Up&amp;source=">
                                  <?php
                                

                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'HU') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="green-bg">
                                <td>Sale</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Sale&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'Sale') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="white-bg">
                                <td>Fresh</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Fresh&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'Fresh') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  // $query =  "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'Fresh') AND UserName ='".$UserName."'";
                                  // echo $query;
                                  ?>

                                </a></td>
                              </tr>
                              <tr class="yellow-bg">
                                <td>Live Demo No Response</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Live Demo No Response&amp;source=">

                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>Wrong Number</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Wrong Number&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'WN') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="yellow-bg">
                                <td>Duplicate</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Duplicate&amp;source=">
                                  <?php
                                

                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'Duplicate') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>Do Not Disturb</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Do Not Disturb&amp;source=">
                                  <?php
                                   $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'DND') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>Not Contactable</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Not Contactable&amp;source=">
                                  <?php
                                   $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'NC') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>Language Barrier</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Language Barrier&amp;source=">
                                  <?php
                                   $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'LB') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>Commodity Trader</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Commodity Trader&amp;source=">
                                  <?php
                                   $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'CT') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>Non Trader</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Non Trader&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'NT') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>NI - Others</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NI - Others&amp;source=">
                                 <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'NI - Others') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                 ?>

                               </a></td>
                             </tr>
                             <tr class="red-bg">
                              <td>NI - Do not want to trade now</td>
                              <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NI - Do not want to trade now&amp;source=">
                                <?php
                                $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'NI - Do not want to trade now') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];

                                ?>

                              </a></td>
                            </tr>
                            <tr class="red-bg">
                              <td>NI - losses/No risk taker</td>
                              <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NI - losses/No risk taker&amp;source=">
                                <?php
                                 $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'NI - losses/No risk taker') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                ?>
                              </a></td>
                            </tr>
                            <tr class="yellow-bg">
                              <td>NI - less funds/low budget</td>
                              <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NI - less funds/low budget&amp;source=">
                               <?php
                                $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'NI - less funds/low budget') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                               ?>
                             </a></td>
                           </tr>
                           <tr class="yellow-bg">
                            <td>Switched Off</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Switched Off&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'SW') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a></td>
                          </tr>
                          <tr class="yellow-bg">
                            <td>Not Reachable</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Not Reachable&amp;source=">

                            </a></td>
                          </tr>
                          <tr class="yellow-bg">
                            <td>Ringing</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Ringing&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'R') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a></td>
                          </tr>
                          <tr class="yellow-bg">
                            <td>Live Demo</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Live Demo&amp;source=">

                            </a></td>
                          </tr>
                          <tr class="yellow-bg">
                            <td>Follow up - Live Demo</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Follow up - Live Demo&amp;source=">

                            </a></td>
                          </tr>
                          <tr class="yellow-bg">
                            <td>Promise To Pay Online</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Promise To Pay Online&amp;source=">
                              <?php
                             $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'PTPO') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a></td>
                          </tr>
                          <tr class="yellow-bg">
                            <td>Call Back Without Presentation</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Call Back Without Presentation&amp;source=">
                              <?php
                           
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'CBWOP') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a></td>
                          </tr>


                          <tr class="yellow-bg">
                            <td>Call Back With Presentation</td>
                            <td>
                              <a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Call Back With Presentation&amp;source=">
                              <?php
                             
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'CBWP') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>
                          <!-- //////////////////// -->

                            <tr class="yellow-bg">
                            <td>PTPC</td>
                            <td>
                              <a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=PTPC&amp;source=">
                              <?php
                             
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'PTPC') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>
                            <tr class="yellow-bg">
                            <td>FT</td>
                            <td>
                              <a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=FT&amp;source=">
                              <?php
                             
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'FT') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>
                            <tr class="yellow-bg">
                            <td>NR</td>
                            <td>
                              <a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NR&amp;source=">
                              <?php
                             
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'NR') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>
                            <tr class="yellow-bg">
                            <td>CT</td>
                            <td>
                              <a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=CT&amp;source=">
                              <?php
                             
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'CT') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>
                           <tr class="yellow-bg">
                            <td>FTN</td>
                            <td>
                              <a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=FTN&amp;source=">
                              <?php
                             
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'FTN') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>

                           <tr class="yellow-bg">
                            <td>NCD</td>
                            <td>
                              <a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NCD&amp;source=">
                              <?php
                             
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'NCD') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>

                           <tr class="yellow-bg">
                            <td>NI</td>
                            <td>
                              <a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NI&amp;source=">
                              <?php
                             
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'NI') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>

                           <tr class="yellow-bg">
                            <td>Demat Account Inquiry</td>
                            <td>
                              <a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Demat Account Inquiry&amp;source=">
                              <?php
                             
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND (Disposition = 'Demat Account Inquiry') AND UserName ='".$UserName."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>


                          <!-- //////////////////// -->
                          <tr class="Total">
                            <td>Total</td>
                            <td>
                              <a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=total&amp;source=">
                               <?php
                               $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads  WHERE Date BETWEEN '".$from."' AND '".$to."' AND (source = '".$source."') AND UserName ='".$UserName."'");
                               $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                               ?>


                             </a>
                           </td>
                         </tr>
                       </tbody>

                            <?php 
                                 }
                              else {


                              

                              ?>
                         

                            <tbody>
                              <tr class="yellow-bg">
                                <td>Busy tone</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Busy tone&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'B') AND UserName='".$username."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="green-bg">
                                <td>Paid Customer</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Paid Customer&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'PC') AND UserName='".$username."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="yellow-bg">
                                <td>Hung Up</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Hung Up&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'HU') AND UserName='".$username."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="green-bg">
                                <td>Sale</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Sale&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'Sale') AND UserName='".$username."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="white-bg">
                                <td>Fresh</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Fresh&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'Fresh') AND UserName='".$username."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>

                                </a></td>
                              </tr>
                              <tr class="yellow-bg">
                                <td>Live Demo No Response</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Live Demo No Response&amp;source=">

                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>Wrong Number</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Wrong Number&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'WN') AND UserName='".$username."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="yellow-bg">
                                <td>Duplicate</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Duplicate&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'Duplicate') AND UserName='".$username."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>Do Not Disturb</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Do Not Disturb&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'DND') AND UserName='".$username."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>Not Contactable</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Not Contactable&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'NT') AND UserName='".$username."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>Language Barrier</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Language Barrier&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'LB') AND UserName='".$username."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>Commodity Trader</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Commodity Trader&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'CT') AND UserName='".$username."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>Non Trader</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Non Trader&amp;source=">
                                  <?php
                                  $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'NT') AND UserName='".$username."'");
                                  $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                  ?>
                                </a></td>
                              </tr>
                              <tr class="red-bg">
                                <td>NI - Others</td>
                                <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NI - Others&amp;source=">
                                 <?php
                                 $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'NI - Others') AND UserName='".$username."'");
                                 $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                 ?>

                               </a></td>
                             </tr>
                             <tr class="red-bg">
                              <td>NI - Do not want to trade now</td>
                              <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NI - Do not want to trade now&amp;source=">
                                <?php
                                $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'NI - Do not want to trade now') AND UserName='".$username."'");
                                $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                ?>

                              </a></td>
                            </tr>
                            <tr class="red-bg">
                              <td>NI - losses/No risk taker</td>
                              <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NI - losses/No risk taker&amp;source=">
                                <?php
                                $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'NI - losses/No risk taker') AND UserName='".$username."'");
                                $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                                ?>
                              </a></td>
                            </tr>
                            <tr class="yellow-bg">
                              <td>NI - less funds/low budget</td>
                              <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NI - less funds/low budget&amp;source=">
                               <?php
                               $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'NI - less funds/low budget') AND UserName='".$username."'");
                               $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                               ?>
                             </a></td>
                           </tr>
                           <tr class="yellow-bg">
                            <td>Switched Off</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Switched Off&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'SW') AND UserName='".$username."'");
                              $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a></td>
                          </tr>
                          <tr class="yellow-bg">
                            <td>Not Reachable</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Not Reachable&amp;source=">

                            </a></td>
                          </tr>
                          <tr class="yellow-bg">
                            <td>Ringing</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Ringing&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'R') AND UserName='".$username."'");
                              $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a></td>
                          </tr>
                          <tr class="yellow-bg">
                            <td>Live Demo</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Live Demo&amp;source=">

                            </a></td>
                          </tr>
                          <tr class="yellow-bg">
                            <td>Follow up - Live Demo</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Follow up - Live Demo&amp;source=">

                            </a></td>
                          </tr>
                          <tr class="yellow-bg">
                            <td>Promise To Pay Online</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Promise To Pay Online&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'PTPO') AND UserName='".$username."'");
                              $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a></td>
                          </tr>
                          <tr class="yellow-bg">
                            <td>Call Back Without Presentation</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Call Back Without Presentation&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'CBWOP') AND UserName='".$username."'");
                              $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a></td>
                          </tr>

                          <tr class="yellow-bg">
                            <td>Call Back With Presentation</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Call Back With Presentation&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'CBWP') AND UserName='".$username."'");
                              $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>

                            <!-- ////////////// -->

                          <tr class="yellow-bg">
                            <td>PTPC</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=PTPC&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'PTPC') AND UserName='".$username."'");
                              $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>
                           <tr class="yellow-bg">
                            <td>FT</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=FT&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'FT') AND UserName='".$username."'");
                              $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>
                           <tr class="yellow-bg">
                            <td>NR</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NR&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'NR') AND UserName='".$username."'");
                              $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>
                           <tr class="yellow-bg">
                            <td>CT</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=CT&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'CT') AND UserName='".$username."'");
                              $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>
                           <tr class="yellow-bg">
                            <td>FTN</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=FTN&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'FTN') AND UserName='".$username."'");
                              $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>
                           <tr class="yellow-bg">
                            <td>NCD</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NCD&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'NCD') AND UserName='".$username."'");
                              $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>
                           <tr class="yellow-bg">
                            <td>NI</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=NI&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'NI') AND UserName='".$username."'");
                              $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>
                           <tr class="yellow-bg">
                            <td>Demat Account Inquiry</td>
                            <td><a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=Demat Account Inquiry&amp;source=">
                              <?php
                              $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads WHERE (Disposition =  'Demat Account Inquiry') AND UserName='".$username."'");
                              $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                              ?>
                            </a>
                          </td>
                          </tr>
                            <!-- ////////////// -->

                          <tr class="Total">
                            <td>Total</td>
                            <td>
                              <a href="leads-count-details.php?agent_name=&amp;from=&amp;to=&amp;disposition=total&amp;source=">
                               <?php
                               $result = mysqli_query($connect, "SELECT COUNT( Disposition ) as total FROM Assigned_Leads where UserName='".$username."'");
                               $fetch = $result->fetch_assoc();
                                  echo $fetch['total'];
                               ?>
                             </a>
                           </td>
                         </tr>
                       </tbody>
                     <?php
                      }
                     ?>

                     </table>
                   </div>
                 </div>
               </div>  


               <?php
                  $LEADSFB = 0;
                  $Churn = 0;
                  $DP    =0;
                  $Website = 0;
                  $Event = 0;
                  $Renewal    =0;
                  $Ebook = 0;
                  $Blaster = 0;
                   if(isset($_GET['UserName']))
                      {
                        $sql1 ="SELECT Source, count(*) as NUM FROM Assigned_Leads  where UserName='".$UserName."' GROUP BY Source";
                      }
                      else
                      {
                        $sql1 ="SELECT Source, count(*) as NUM FROM Assigned_Leads  where UserName='".$username."' GROUP BY Source";
                      }
                  

                    $result = mysqli_query($connect,$sql1);
                    while($row = $result->fetch_array())
                    {
                      if($row['Source'] =="LEADSFB")
                      {
                        $LEADSFB = $row['NUM'];
                      }
                      if($row['Source'] =="Churn")
                      {
                        $Churn = $row['NUM'];
                      }
                      if($row['Source'] =="DP")
                      {
                        $DP = $row['NUM'];
                      }
                       if($row['Source'] =="Website")
                      {
                        $Website = $row['NUM'];
                      }
                      if($row['Source'] =="Event")
                      {
                        $Event = $row['NUM'];
                      }
                      if($row['Source'] =="Renewal")
                      {
                        $Renewal = $row['NUM'];
                      }
                      if($row['Source'] =="Ebook")
                      {
                        $Ebook = $row['NUM'];
                      }
                      if($row['Source'] =="Blaster")
                      {
                        $Blaster = $row['NUM'];
                      }

                    }
               ?>

               <div class="col-sm-4" style="display:;">

                <div class="panel panel-default" style="">
                  <div class="panel-heading font-size16">Category Wise Pie Chart</div>
                  <div class="panel-body">

                    <div style="width: 400px;">
                      <canvas id="myChart" width="400" height="400" style="display: block;"></canvas>
                    </div>

                    <script>
                      $(document).ready(function() {

                        var ctx = document.getElementById("myChart");
                        var myChart = new Chart(ctx, 
                       {
                        type: 'pie',
                        data: {
                          labels: ["LEADSFB","Churn","DP","Website","Event","Renewal","Ebook","Blaster"],
                          datasets: [{
                            label: '#',
                            data: ["<?php echo $LEADSFB; ?>","<?php echo $Churn; ?>","<?php echo $DP; ?>","<?php echo $Website; ?>","<?php echo $Event; ?>","<?php echo $Renewal; ?>","<?php echo $Ebook; ?>","<?php echo $Blaster; ?>"],
                            backgroundColor: [
                               'rgb(72, 162, 223)',
                               'rgb(109, 219, 156)',
                               'rgba(255, 99, 132, 0.5)',
                               'rgb(72, 162, 250)',
                               'rgb(109, 219, 180)',
                               'rgba(255, 99, 132, 0.9)',
                               'rgb(109, 219, 200)',
                               'rgba(255, 99, 132, 0.2)'
                            ],
                            borderColor: [
                               'rgb(72, 162, 223)',
                               'rgba(75, 192, 192, 1)',
                              'rgba(255,99,132,1)',
                              'rgb(72, 162, 250)',
                               'rgb(109, 219, 180)',
                               'rgba(255, 99, 132, 0.9)',
                               'rgb(109, 219, 200)',
                               'rgba(255, 99, 132, 0.2)'

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

                  </div>
                </div>
              </div>  



              <!-- popover-content end here -->
              <!-- <script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>   -->

              <script>



              </script>

            </div>
          </div>
        </div>      











        <!-- popover-content end here -->
        <!-- <script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>   -->

        <script>



        </script>

      </div>
    </div>
  </div>
  
  

  
  

  
  
</div>



</div>


</div>
</div>


<?php include('partial/footer.php') ?>

<script>
  $(document).ready(()=>{
   $(".dup_lead_en_dis").click(()=>{
    if($(".dup_lead_en_dis").prop('checked') == true){
      var data = {
        Duplicate_Leads:'Allow'
      };
    }
    else{
     var data = {
      Duplicate_Leads:'Block'
    };
  }
  $.ajax({
    type:"post",
    url:"Ajax_files/Change_Leads_Status.php",
    data:data,
    success:(res)=>{
      console.log(res);
      window.location.reload();
    }
  })
})
 })
</script>
