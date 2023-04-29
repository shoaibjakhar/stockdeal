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
  <div class="breadcurms"> <a href="view-leads.php" class="btn btn-xs btn-primary">View Leads</a></div>
  <div class="containter" style="padding:20px 20px 0 20px;">
    <?php include('connection/dbconnection_crm.php')?>
    <table id="veiw_Leads" class="cell-border  table-striped" cellspacing="0" border="0" width="100%">
      <thead>
        <tr>
          <td style="width: 200px;"><strong>Source</strong></td>
          <td><strong>Fresh</strong></td>
          <td><strong>CBWP</strong></td>
          <td><strong>CBWOP</strong></td>
          <td><strong>PTPO</strong></td>
          <td><strong>PTPC</strong></td>
          <td><strong>NR</strong></td>
          <td><strong>SW</strong></td>
          <td><strong>NI</strong></td>
          <td><strong>WN</strong></td>
          <td><strong>DND</strong></td>
          <td><strong>CT</strong></td>
          <td><strong>NT</strong></td>
          <td><strong>LB</strong></td>
          <td><strong>PC</strong></td>
          <td><strong>Sale</strong></td>
          <td><strong>FT</strong></td>
          <td><strong>B</strong></td>
          <td><strong>R</strong></td>
          <td><strong>HU</strong></td>
          <td><strong>FTN</strong></td>
          <td><strong>NCD</strong></td>
         <td><strong>Total</strong></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Blaster</td>
          <td><a href="results.php?Source=Blaster&Disposition=Fresh">
            <?php
        $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 
        (Source =  'Blaster') && (Disposition =  'Fresh')");
         echo mysql_result($result, 0);

         //die('here');
       ?>

            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=CBWP">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 
         (Source =  'Blaster') && (Disposition =  'CBWP')");
         echo mysql_result($result, 0);
        ?>
            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=CBWOP">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'CBWOP')");
         echo mysql_result($result, 0);
        ?>
            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=PTPO">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'PTPO')");
         echo mysql_result($result, 0);
        ?>
            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=PTPC">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'PTPC')");
         echo mysql_result($result, 0);
        ?>
            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=NR">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'NR')");
         echo mysql_result($result, 0);
        ?>
            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=SW">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'SW')");
         echo mysql_result($result, 0);
        ?>
            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=NI">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'NI' OR Disposition =  'NI - less funds/low budget' OR Disposition =  'NI - losses/No risk taker' OR Disposition =  'NI - Do not want to trade now' OR Disposition =  'NI - Others')");
         echo mysql_result($result, 0);
        ?>
            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=WN">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'WN')");
         echo mysql_result($result, 0);
        ?>
            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=DND">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'DND')");
         echo mysql_result($result, 0);
        ?>
            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=CT">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'CT')");
         echo mysql_result($result, 0);
        ?>
            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=NT">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'NT')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=LB">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'LB')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=PC">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'PC')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
          <td><a href="results.php?Source=Blaster&Disposition=Sale">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'Sale')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            
            
            <td><a href="results.php?Source=Blaster&Disposition=FT">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'FT')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Blaster&Disposition=B">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'B')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Blaster&Disposition=R">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'R')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Blaster&Disposition=HU">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'HU')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Blaster&Disposition=FTN">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'FTN')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Blaster&Disposition=NCD">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Blaster') && (Disposition =  'NCD')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td>
             <?php
         $result = mysqli_query($connect, "SELECT COUNT( Source) FROM Assigned_Leads WHERE (Source=  'Blaster')");
         echo mysql_result($result, 0);
       ?>
            </td>
        </tr>
        <tr>
          <td>Churn</td>
          <td><a href="results.php?Source=Churn&Disposition=Fresh">
            <?php
        $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'Fresh')");
        echo mysql_result($result, 0);
       ?>
            </a></td>
          <td><a href="results.php?Source=Churn&Disposition=CBWP">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'CBWP')");
         echo mysql_result($result, 0);
        ?>
            </a></td>
          <td>
          <a href="results.php?Source=Churn&Disposition=CBWOP">
          <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'CBWOP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td>
          <a href="results.php?Source=Churn&Disposition=PTPO">
          <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'PTPO')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td>
           <a href="results.php?Source=Churn&Disposition=PTPC">
          <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'PTPC')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td>
          <a href="results.php?Source=Churn&Disposition=NR">
          <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'NR')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td>
          <a href="results.php?Source=Churn&Disposition=SW">
          <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'SW')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td>
          <a href="results.php?Source=Churn&Disposition=NI">
          <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'NI' OR Disposition =  'NI - less funds/low budget' OR Disposition =  'NI - losses/No risk taker' OR Disposition =  'NI - Do not want to trade now' OR Disposition =  'NI - Others')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td>
          <a href="results.php?Source=Churn&Disposition=WN">
          <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'WN')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td>
          <a href="results.php?Source=Churn&Disposition=DND">
          <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'DND')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td>
          <a href="results.php?Source=Churn&Disposition=CT">
          <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'CT')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td>
           <a href="results.php?Source=Churn&Disposition=NT">
          <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'NT')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td>
          <a href="results.php?Source=Churn&Disposition=LB">
          <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'LB')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td>
          <a href="results.php?Source=Churn&Disposition=PC">
          <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'PC')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td>
          <a href="results.php?Source=Churn&Disposition=Sale">
          <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'Sale')");
         echo mysql_result($result, 0);
       ?></a></td>
       <td><a href="results.php?Source=Churn&Disposition=FT">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'FT')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Churn&Disposition=B">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'B')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Churn&Disposition=R">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'R')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Churn&Disposition=HU">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'HU')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Churn&Disposition=FTN">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'FTN')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Churn&Disposition=NCD">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Churn') && (Disposition =  'NCD')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
             <td>
             <?php
         $result = mysqli_query($connect, "SELECT COUNT( Source) FROM Assigned_Leads WHERE Source=  'Churn'");
         echo mysql_result($result, 0);
       ?>
            </td>
        </tr>
        <tr>
          <td>DP</td>
          <td><a href="results.php?Source=DP&Disposition=Fresh"><?php
        $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'Fresh')");
        echo mysql_result($result, 0);
       ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=CBWP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'CBWP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=CBWOP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'CBWOP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=PTPO"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'PTPO')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=PTPC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'PTPC')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=NR"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'NR')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=SW"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'SW')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=NI"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'NI' OR Disposition =  'NI - less funds/low budget' OR Disposition =  'NI - losses/No risk taker' OR Disposition =  'NI - Do not want to trade now' OR Disposition =  'NI - Others')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=WN"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'WN')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=DND"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'DND')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=CT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'CT')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=NT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'NT')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=LB"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'LB')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=PC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'PC')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td><a href="results.php?Source=DP&Disposition=Sale"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'Sale')");
         echo mysql_result($result, 0);
       ?></a></td>
       <td><a href="results.php?Source=DP&Disposition=FT">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'FT')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=DP&Disposition=B">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'B')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=DP&Disposition=R">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'R')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=DP&Disposition=HU">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'HU')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=DP&Disposition=FTN">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'FTN')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=DP&Disposition=NCD">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'DP') && (Disposition =  'NCD')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td>
             <?php
         $result = mysqli_query($connect, "SELECT COUNT( Source) FROM Assigned_Leads WHERE Source=  'DP'");
         echo mysql_result($result, 0);
       ?>
            </td>
        </tr>
        <tr>
          <td>Website</td>
          <td> <a href="results.php?Source=Website&Disposition=Fresh">
          <?php
        $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'Fresh')");
        echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=CBWP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'CBWP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=CBWOP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'CBWOP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=PTPO"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'PTPO')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=PTPC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'PTPC')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=NR"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'NR')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=SW"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'SW')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=NI"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'NI' OR Disposition =  'NI - less funds/low budget' OR Disposition =  'NI - losses/No risk taker' OR Disposition =  'NI - Do not want to trade now' OR Disposition =  'NI - Others')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=WN"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'WN')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=DND"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'DND')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=CT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'CT')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=NT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'NT')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=LB"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'LB')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=PC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'PC')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Website&Disposition=Sale"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'Sale')");
         echo mysql_result($result, 0);
       ?></a></td>
       <td><a href="results.php?Source=Website&Disposition=FT">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'FT')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Website&Disposition=B">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'B')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Website&Disposition=R">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'R')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Website&Disposition=HU">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'HU')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Website&Disposition=FTN">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'FTN')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Website&Disposition=NCD">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Website') && (Disposition =  'NCD')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td>
             <?php
         $result = mysqli_query($connect, "SELECT COUNT( Source) FROM Assigned_Leads WHERE Source=  'Website'");
         echo mysql_result($result, 0);
       ?>
            </td>
        </tr>
        <tr>
          <td>Event</td>
          <td> <a href="results.php?Source=Event&Disposition=Fresh">
          <?php
        $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'Fresh')");
        echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=CBWP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'CBWP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=CBWOP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'CBWOP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=PTPO"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'PTPO')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=PTPC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'PTPC')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=NR"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'NR')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=SW"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'SW')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=NI"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'NI' OR Disposition =  'NI - less funds/low budget' OR Disposition =  'NI - losses/No risk taker' OR Disposition =  'NI - Do not want to trade now' OR Disposition =  'NI - Others')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=WN"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'WN')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=DND"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'DND')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=CT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'CT')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=NT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'NT')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=LB"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'LB')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=PC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'PC')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Event&Disposition=Sale"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'Sale')");
         echo mysql_result($result, 0);

       ?></a></td>
       <td><a href="results.php?Source=Event&Disposition=FT">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'FT')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Event&Disposition=B">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'B')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Event&Disposition=R">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'R')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Event&Disposition=HU">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'HU')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Event&Disposition=FTN">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'FTN')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Event&Disposition=FTN">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Event') && (Disposition =  'NCD')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td>
             <?php
         $result = mysqli_query($connect, "SELECT COUNT( Source) FROM Assigned_Leads WHERE Source=  'Event'");
         echo mysql_result($result, 0);
       ?>
            </td>
        </tr>
        <tr>
          <td>Web registered</td>
          <td> <a href="results.php?Source=Web registered&Disposition=Fresh">
          <?php
        $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'Fresh')");
        echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=CBWP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'CBWP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=CBWOP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'CBWOP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=PTPO"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'PTPO')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=PTPC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'PTPC')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=NR"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'NR')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=SW"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'SW')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=NI"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'NI' OR Disposition =  'NI - less funds/low budget' OR Disposition =  'NI - losses/No risk taker' OR Disposition =  'NI - Do not want to trade now' OR Disposition =  'NI - Others')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=WN"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'WN')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=DND"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'DND')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=CT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'CT')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=NT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'NT')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=LB"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'LB')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=PC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'PC')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Web registered&Disposition=Sale"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'Sale')");
         echo mysql_result($result, 0);

       ?></a></td>
       <td><a href="results.php?Source=Web registered&Disposition=FT">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'FT')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Web registered&Disposition=B">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'B')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Web registered&Disposition=R">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'R')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Web registered&Disposition=HU">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'HU')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Web registered&Disposition=FTN">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'FTN')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
              <td><a href="results.php?Source=Web registered&Disposition=NCD">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered') && (Disposition =  'NCD')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td>
             <?php
         $result = mysqli_query($connect, "SELECT COUNT( Source) FROM Assigned_Leads WHERE Source=  'Web registered'");
         echo mysql_result($result, 0);
       ?>
            </td>
        </tr>
        <tr>
          <td>Renewal</td>
          <td> <a href="results.php?Source=Renewal&Disposition=Fresh">
          <?php
        $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'Fresh')");
        echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=CBWP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'CBWP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=CBWOP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'CBWOP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=PTPO"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'PTPO')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=PTPC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'PTPC')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=NR"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'NR')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=SW"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'SW')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=NI"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'NI' OR Disposition =  'NI - less funds/low budget' OR Disposition =  'NI - losses/No risk taker' OR Disposition =  'NI - Do not want to trade now' OR Disposition =  'NI - Others')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=WN"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'WN')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=DND"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'DND')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=CT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'CT')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=NT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'NT')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=LB"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'LB')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=PC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'PC')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Renewal&Disposition=Sale"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'Sale')");
         echo mysql_result($result, 0);

       ?></a></td>
       <td><a href="results.php?Source=Renewal&Disposition=FT">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'FT')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Renewal&Disposition=B">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'B')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Renewal&Disposition=R">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'R')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Renewal&Disposition=HU">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'HU')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Renewal&Disposition=FTN">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'FTN')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Renewal&Disposition=NCD">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Renewal') && (Disposition =  'NCD')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td>
             <?php
         $result = mysqli_query($connect, "SELECT COUNT( Source) FROM Assigned_Leads WHERE Source=  'Renewal'");
         echo mysql_result($result, 0);
       ?>
            </td>
        </tr>
        
        <tr>
          <td>Web registered 2</td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=Fresh">
          <?php
        $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'Fresh')");
        echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=CBWP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'CBWP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=CBWOP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'CBWOP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=PTPO"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'PTPO')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=PTPC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'PTPC')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=NR"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'NR')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=SW"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'SW')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=NI"><?php
        echo $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'NI' OR Disposition =  'NI - less funds/low budget' OR Disposition =  'NI - losses/No risk taker' OR Disposition =  'NI - Do not want to trade now' OR Disposition =  'NI - Others')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=WN"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'WN')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=DND"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'DND')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=CT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'CT')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=NT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'NT')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=LB"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'LB')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=PC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'PC')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Web registered 2&Disposition=Sale"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'Sale')");
         echo mysql_result($result, 0);

       ?></a></td>
       <td><a href="results.php?Source=Web registered 2&Disposition=FT">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'FT')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Web registered 2&Disposition=B">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'B')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Web registered 2&Disposition=R">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'R')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Web registered 2&Disposition=HU">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'HU')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Web registered 2&Disposition=FTN">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'FTN')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Web registered 2&Disposition=NCD">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Web registered 2') && (Disposition =  'NCD')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td>
             <?php
         $result = mysqli_query($connect, "SELECT COUNT( Source) FROM Assigned_Leads WHERE Source=  'Web registered 2'");
         echo mysql_result($result, 0);
       ?>
            </td>
        </tr>
          <tr>
          <td>Ebook</td>
          <td> <a href="results.php?Source=Ebook&Disposition=Fresh">
          <?php
        $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'Fresh')");
        echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=CBWP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'CBWP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=CBWOP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'CBWOP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=PTPO"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'PTPO')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=PTPC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'PTPC')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=NR"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'NR')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=SW"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'SW')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=NI"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'NI')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=WN"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'WN')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=DND"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'DND')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=CT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'CT')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=NT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'NT')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=LB"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'LB')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=PC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'PC')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=Ebook&Disposition=Sale"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'Sale')");
         echo mysql_result($result, 0);

       ?></a></td>
       <td><a href="results.php?Source=Ebook&Disposition=FT">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'FT')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Ebook&Disposition=B">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'B')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Ebook&Disposition=R">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'R')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Ebook&Disposition=HU">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'HU')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=Ebook&Disposition=FTN">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'FTN')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
               <td><a href="results.php?Source=Ebook&Disposition=NCD">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'Ebook') && (Disposition =  'NCD')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td>
             <?php
         $result = mysqli_query($connect, "SELECT COUNT( Source) FROM Assigned_Leads WHERE Source=  'Ebook'");
         echo mysql_result($result, 0);
       ?>
            </td>
        </tr>
           <tr>
          <td>LEADSFB</td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=Fresh">
          <?php
        $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'Fresh')");
        echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=CBWP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'CBWP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=CBWOP"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'CBWOP')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=PTPO"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'PTPO')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=PTPC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'PTPC')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=NR"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'NR')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=SW"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'SW')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=NI"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'NI')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=WN"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'WN')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=DND"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'DND')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=CT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'CT')");
         echo mysql_result($result, 0);
        ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=NT"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'NT')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=LB"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'LB')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=PC"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'PC')");
         echo mysql_result($result, 0);
       ?></a></td>
          <td> <a href="results.php?Source=LEADSFB&Disposition=Sale"><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'Sale')");
         echo mysql_result($result, 0);

       ?></a></td>
       <td><a href="results.php?Source=LEADSFB&Disposition=FT">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'FT')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=LEADSFB&Disposition=B">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'B')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=LEADSFB&Disposition=R">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'R')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=LEADSFB&Disposition=HU">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'HU')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td><a href="results.php?Source=LEADSFB&Disposition=FTN">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'FTN')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
                <td><a href="results.php?Source=LEADSFB&Disposition=NCD">
            <?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Source =  'LEADSFB') && (Disposition =  'NCD')");
         echo mysql_result($result, 0);
       ?>
            </a></td>
            <td>
             <?php
         $result = mysqli_query($connect, "SELECT COUNT( Source) FROM Assigned_Leads WHERE Source=  'LEADSFB'");
         echo mysql_result($result, 0);
       ?>
            </td>
        </tr>
        <tr>
          <td><strong>Total</strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'Fresh')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'CBWP')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'CBWOP')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'PTPO')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'PTPC')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'NR')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'SW')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'NI')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'WN')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'DND')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'CT')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'NT')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'LB')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'PC')");
         echo mysql_result($result, 0);
       ?></strong></td>
          <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'Sale')");
         echo mysql_result($result, 0);
       ?></strong></td>
       
       <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'FT')");
         echo mysql_result($result, 0);
       ?></strong></td>
       
       <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'B')");
         echo mysql_result($result, 0);
       ?></strong></td>
       
       <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'R')");
         echo mysql_result($result, 0);
       ?></strong></td>
            <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'HU')");
         echo mysql_result($result, 0);
       ?></strong></td>
             <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'FTN')");
         echo mysql_result($result, 0);
       ?></strong></td>
            <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE (Disposition =  'NCD')");
         echo mysql_result($result, 0);
       ?></strong></td>
              <td><strong><?php
         $result = mysqli_query($connect, "SELECT COUNT( Source) FROM Assigned_Leads");
         echo mysql_result($result, 0);
       ?></strong></td>
       </tr>
      </tbody>
    </table>
    
   
    
  </div>
</div>
<?php include('partial/footer.php') ?>
