<?php  include('partial/session_start.php'); ?>


<!doctype html>

<html>

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>View Leads</title>

	<?php require('partial/plugins.php'); ?>

</head>

<body>

	<?php include('partial/sidebar.php') ?>

	<div class="main_container" style="overflow:auto">

		<header>

			<?php include('partial/header-top.php') ?>

		</header>

		<div class="breadcurms"> <a href="view-leads.php" class="btn btn-xs btn-primary">View Leads</a>
			<!-- | <a href="follow-up-leads-filter-2.php" >Filter 2</a>  | <a href="lead-details.php" >Lead details</a> | <a href="lead-details-filter2-new.php" >Filter 1</a> | <a href="leads-view.php">Add New Leads</a>-->
		</div>

		<div class="containter" style="padding:20px 20px 0 20px;">

			<?php include('connection/dbconnection_crm.php')?>

			<table id="veiw_Leads" class="cell-border table-striped " cellspacing="0" border="0" width="100%">
			    <?php
			       $sel = "SELECT Disposition FROM Assigned_Leads WHERE UserName = '".$username."' GROUP BY Disposition";
			        $qry = mysqli_query($connect,$sel);
			        //print_r($qry);
			        $Dispositions = array();
			        while($fetch = mysqli_fetch_assoc($qry)){
			            $Dispositions[] = $fetch['Disposition'];
			        }
			        
			       // print_r($Dispositions);
			       //WHERE UserName = '".$username."'
			       $sel = "SELECT Source FROM Assigned_Leads WHERE UserName = '".$username."' GROUP BY Source";
			       $qry = mysqli_query($connect,$sel);
			       $Sources = array();
			       while($fetch = mysqli_fetch_assoc($qry)){
			           $Sources[] = $fetch['Source'];
			       }
			    
			    ?>

				<thead>
					<tr>
                        <th style="display:none">Source</th>
						<!-- <td><strong>Source</strong></td> -->
                       <?php
                      
                         if(count($Dispositions)){
                             foreach($Dispositions as $Disposition){
                                 echo '<th>'.$Disposition.'</th>';
                             }
                         }
                       ?>
                       <th>Total </th>
					</tr>

				</thead>

				<tbody>

				 <?php
                        if(count($Sources)){
                             $rowtotal = array();
                            foreach($Sources as $Source){
                                echo '<tr><td style="display:none">'.$Source.'</td>';
                                 if(count($Dispositions)){
                                     $total = 0;
                                     foreach($Dispositions as $Disposition){
                                         echo '<td class="'.$Disposition.'">';
                                          $sel = "SELECT count(*) as cn from Assigned_Leads WHERE UserName = '".$username."' AND Disposition = '".$Disposition."' AND Source = '".$Source."'";
                                          $qry = mysqli_query($connect,$sel);
                                          $fetch = mysqli_fetch_assoc($qry);
                                          echo '<a href="results.php?Source='.$Source.'&Disposition='.$Disposition.'&UserName='.$username.'"  target="_blank">'. $fetch['cn'].'<a>';
                                          $total = $total + $fetch['cn'];
                                         // $rowtotal = $rowtotal + $fetch['cn'];
                                         $rowtotal[$Disposition] = (int)$rowtotal[$Disposition] + $fetch['cn'];
                                         echo '</td>';
                                     }
                                     $rowtotal['Total'] = (int)$rowtotal['Total'] + $total;
                                     echo ' <td>'.$total.'</td>';
                                 }
                                 
                                 echo '</tr>';
                            }
                            echo '<tr><td style="display:none"><strong>Total</strong></td>';
                            foreach($Dispositions as $Disposition){
                                echo '<td><strong>'.$rowtotal[$Disposition].'</strong></td>' ;
                            }
                            
                            echo '<td><strong>'.$rowtotal['Total'].'</strong></td><tr>';
                            
                        }
                    ?>
				

				</tbody>

			</table>







		</div>

	</div>

	<?php include('partial/footer.php') ?>