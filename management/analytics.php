<?php  include('partial/session_start.php'); ?>



<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Analytics Reports</title>

<?php require('partial/plugins.php'); ?>

    <style>

     

        

    </style>

</head>

<body>

    <?php

    

    $StartDate     = $_GET['StartDate'];

    $StartDateUSA  = $_GET['StartDateUSA'];

    $EndtDate      = $_GET['EndtDate'];

    $EndtDateUSA   = $_GET['EndtDateUSA'];

    

    //echo ($StartDate.'INR'.'<br/>');

    //echo ($StartDateUSA.'USA'.'<br/>');  

    //echo ($EndtDate.'INR'.'<br/>');      

    //echo ($EndtDateUSA.'USA'.'<br/>');   

    

    ?>

    

    

<?php

 $result = mysqli_query($connect, "SELECT Source FROM Options WHERE Id = '1'");

 $Source = mysql_result($result, 0);

 //echo($Source);

?>

    

    

<?php include('partial/sidebar.php') ?>

<div class="main_container" style="overflow:auto">

  <header>

    <?php include('partial/header-top.php') ?>

  </header>

  <div class="breadcurms">
     <?php
        if(isset($_GET['filter']) && $_GET['filter'] == 'leads-count'){
    ?>
     <a href="analytics-date.php?filter=leads-count" class="btn btn-sm btn-primary pull-left" style="margin-top:5px; margin-left:-5px">BACK</a>  
      <?php
        }
        else{
    ?>
    <a href="analytics-date.php" class="btn btn-sm btn-primary pull-left" style="margin-top:5px; margin-left:-5px">BACK</a> 
    <?php
        }
    ?>
     <h4 class=" pull-left" style="margin-left:15px;"><?php  if(isset($_GET['filter']) && $_GET['filter'] == 'leads-count'){ echo 'Leads Count'; }else{ ?>Analytical Report<?php } ?> from <strong><?php echo ($StartDate.'&nbsp;---&nbsp;'.$EndtDate); ?></strong> </h5>

      <div class="clearfix"></div>

    </div>

  <div class="containter" style="padding:20px 20px 0 20px;">

    <?php include('connection/dbconnection_crm.php')?>
    <?php
    function createRange($start, $end, $format = 'Y-m-d') {
        $start  = new DateTime($start);
        $end    = new DateTime($end);
        $invert = $start > $end;
        $dates = array();
        $dates[] = $start->format($format);
        while ($start != $end) {
            $start->modify(($invert ? '-' : '+') . '1 day');
            $dates[] = $start->format($format);
        }
        return $dates;
    }
    
        if(isset($_GET['filter']) && $_GET['filter'] == 'leads-count'){
            $dats = createRange($StartDateUSA,$EndtDateUSA);
            array_unshift($dats,"");
            unset($dats[0]);
            
            $sel = "SELECT Source FROM Assigned_Leads WHERE (Date >= '".$StartDateUSA."') AND (Date <= '".$EndtDateUSA."') GROUP BY Source";
            $qry = mysqli_query($connect, $sel);
    ?>
    <table id="" class="table table-bordered" cellspacing="0" border="0" width="100%">
        <thead>
            <tr>
                <th>Source</th>
                <?php
                    if(count($dats)>0){
                        foreach($dats as $dat){
                            echo '<th>'.date('d M Y',strtotime($dat)).' '.date('l',strtotime($dat)).'</th>';
                        }
                    }
                ?>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($fetch = mysqli_fetch_assoc($qry)){
                    $Sources = $fetch['Source'];
                    echo '<tr>';
                        echo '<td>'.$fetch['Source'].'</td>';
                         $total[$Sources] = 0;
                        $total_sale[$Sources] = 0;
                        if(count($dats)>0){
                            foreach($dats as $dat){
                                $cn_sel = "SELECT Mobile FROM Assigned_Leads WHERE Source = '".$Sources."' AND DATE(Date) = DATE('".$dat."')";
                                $cn_qry = mysqli_query($connect,$cn_sel);
                                
                                $cn_count = mysql_num_rows($cn_qry); //$cn_fetch['cn'];
                                
                                $cn_count_sale = 0;
                                while($cn_fetch = mysqli_fetch_assoc($cn_qry)){
                                    $cn_sel_sale = "SELECT COUNT(Id) as cn FROM Customer_profile WHERE Mobile_No = '".$cn_fetch['Mobile']."'";
                                    $cn_qry_sale = mysqli_query($connect,$cn_sel_sale);
                                    $cn_fetch_sale = mysqli_fetch_assoc($cn_qry_sale);
                                    if($cn_fetch_sale){
                                        $cn_count_sale += $cn_fetch_sale['cn'];
                                    }
                                }
                                
                                // echo $cn_sel_sale = "SELECT COUNT(*) AS cn FROM Assigned_Leads WHERE Source = '".$Sources."' AND DATE(Date) = DATE('".$dat."') AND Disposition = 'Sale'";
                                // $cn_qry_sale = mysqli_query($connect,$cn_sel_sale);
                                // $cn_fetch_sale = mysqli_fetch_assoc($cn_qry_sale);
                                // $cn_count_sale = $cn_fetch_sale['cn'];
                                
                                
                                        
                                
                                $total[$agency_name_f] += $cn_count;
                                $total_sale[$agency_name_f] += $cn_count_sale;
                                echo '<td class=" font-size14">';
                                if($cn_count_sale>0){
                                    echo '<span class="badge font-size16" style="background:green;">'.$cn_count_sale.' </span> /';
                                }
                                echo '<strong>'.$cn_count.'</strong>';
                                echo '</td>';
                            }
                        }
                        ?>
                         <td class=" font-size14"><?php if($total_sale[$agency_name_f]>0){ ?><span class="badge font-size16" style="background:green;"><?php echo $total_sale[$agency_name_f].' / '; ?></span><?php } echo  $total[$agency_name_f]; ?></td>
                        
                        <?php
                    echo '</tr>';
                }
            ?>
        </tbody>
        
    </table>
    <?php
        }
        else{
    ?>

    <table id="" class="table table-bordered" cellspacing="0" border="0" width="100%">

      <thead>

        <tr>

         <td colspan="16" class="theading">Over All Leads</td>

        </tr>

          <tr>

          <td><strong>Source</strong></td>

             <td style="display: none;"><strong>Total Percentage</strong></td>  

          <td><strong>NI</strong></td>

            

          <td><strong>NT</strong></td>

          <td><strong>WN</strong></td>

          <td><strong>LB</strong></td>

          <td><strong>CT</strong></td>

          <td><strong>Fresh</strong></td>

          <td><strong>CWOP</strong></td>

          <td><strong>CWP</strong></td>

          <td><strong>FT</strong></td>

          <td><strong>PTP</strong></td>

          <td><strong>PTPO </strong></td>

          <td><strong>PC </strong></td>

          <td><strong>SW </strong></td>

          <td><strong>Sale </strong></td>

            

         <td><strong>Total</strong></td>

        

        </tr>

      </thead>

      <tbody>

        <tr>

          <td>LEADSFB</td>

            <td style="display: none;">

             

                 <input type="text" class="txt-para"  id="LEADSFB_Excel_NI_PercentageTotal">

            </td>

          <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

         (Source =  'LEADSFB')  AND (Disposition = 'NI - less funds/low budget' or Disposition = 'NI - losses/No risk taker' or Disposition = 'NI - Do not want to trade now')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");



         echo mysql_result($result, 0);
//echo($result);
        ?>

            

                <input type="text"  class="txt-para"  id="LEADSFB_Excel_NI_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition = 'NI - less funds/low budget' or Disposition = 'NI - losses/No risk taker' or Disposition = 'NI - Do not want to trade now')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_NI">

                

           

            </td>

            

          <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition = 'NI - less funds/low budget' or Disposition = 'NI - losses/No risk taker' or Disposition = 'NI - Do not want to trade now')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="LEADSFB_Excel_NT_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'NT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_NT">

            </td>

            

             <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'WN')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="LEADSFB_Excel_WN_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'WN')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_WN">

            </td>

            

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'LB')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="LEADSFB_Excel_LB_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'LB')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_LB">

            </td>

            

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'CT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="LEADSFB_Excel_CT_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'CT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_CT">

            </td>

            

           

            

             

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'Fresh')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="LEADSFB_Excel_Fresh_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'Fresh')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_Fresh">

            </td>

        <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'CWOP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="LEADSFB_Excel_CWOP_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'CWOP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_CWOP">

            </td>

        <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'CWP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="LEADSFB_Excel_CWP_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'CWP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_CWP">

            </td>

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'FT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="LEADSFB_Excel_FT_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'FT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_FT">

            </td>

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'PTP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="LEADSFB_Excel_PTP_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'PTP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_PTP">

            </td>

            

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'PTPO')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="LEADSFB_Excel_PTPO_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'PTPO')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_PTPO">

            </td>

            

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'PC')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="LEADSFB_Excel_PC_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'PC')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_PC">

            </td>

            

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'SW')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="LEADSFB_Excel_SW_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'SW')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_SW">

            </td>

            

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'Sale')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="LEADSFB_Excel_Sale_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'LEADSFB')  AND (Disposition =  'Sale')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="LEADSFB_Excel_Sale">

            </td>

            

          

             <td>

                

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT(SubSource) FROM Assigned_Leads WHERE (Source =  'LEADSFB')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>" id="LEADSFB_Excel_Total">

                

             <?php

         $result = mysqli_query($connect, "SELECT COUNT(SubSource) FROM Assigned_Leads WHERE (Source =  'LEADSFB')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            </td>

            

        </tr>

    

 <tr>

          <td>Website</td>

            <td style="display: none;">

             

                 <input type="text" class="txt-para"  id="Google_Ads_NI_PercentageTotal">

            </td>

          <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'NI')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>

            

                <input type="text"  class="txt-para"  id="Google_Ads_NI_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'NI')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_NI">

                

           

            </td>

            

          <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'NT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="Google_Ads_NT_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'NT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_NT">

            </td>

     

     <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'WN')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="Google_Ads_WN_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'WN')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_WN">

            </td>

     

     <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'LB')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="Google_Ads_LB_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'LB')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_LB">

            </td>

     

     <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'CT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="Google_Ads_CT_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'CT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_CT">

            </td>

     

     <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'Fresh')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="Google_Ads_Fresh_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'Fresh')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_Fresh">

            </td>

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'CWOP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="Google_Ads_CWOP_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'CWOP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_CWOP">

            </td>

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'CWP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="Google_Ads_CWP_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'CWP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_CWP">

            </td>

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'FT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="Google_Ads_FT_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'FT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_FT">

            </td>

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'PTP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="Google_Ads_PTP_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'PTP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_PTP">

            </td>

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'PTPO')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="Google_Ads_PTPO_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'PTPO')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_PTPO">

            </td>

     

     <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'PC')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="Google_Ads_PC_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'PC')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_PC">

            </td>

     

     <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'SW')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="Google_Ads_SW_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'SW')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_SW">

            </td>

     

     <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'Sale')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="Google_Ads_Sale_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Website') AND (Disposition =  'Sale')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="Google_Ads_Sale">

            </td>

            

            <td>

                

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT(Source) FROM Assigned_Leads WHERE (Source =  'Website') AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>" id="Google_Ads_Total">

                

             <?php

         $result = mysqli_query($connect, "SELECT COUNT(Source) FROM Assigned_Leads WHERE (Source =  'Website') AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            </td>

            

        </tr>

          

           <tr style="">

          <td>EBooks</td>

            <td style="display: none;">

             

                 <input type="text" class="txt-para"  id="EBooks_NI_PercentageTotal">

            </td>

          <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'NI')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>

            

                <input type="text"  class="txt-para"  id="EBooks_NI_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'NI')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_NI">

                

           

            </td>

            

          <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'NT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="EBooks_NT_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'NT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_NT">

            </td>

               

               <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'WN')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="EBooks_WN_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'WN')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_WN">

            </td>

               

               <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'LB')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="EBooks_LB_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'LB')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_LB">

            </td>

               

                <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'CT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="EBooks_CT_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'CT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_CT">

            </td>

                  <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'Fresh')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="EBooks_Fresh_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'Fresh')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_Fresh">

            </td>

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'CWOP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="EBooks_CWOP_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'CWOP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_CWOP">

            </td>

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'CWP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="EBooks_CWP_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'CWP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_CWP">

            </td>

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'FT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="EBooks_FT_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'FT')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_FT">

            </td>

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'PTP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="EBooks_PTP_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'PTP')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_PTP">

            </td>

            <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'PTPO')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="EBooks_PTPO_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'PTPO')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_PTPO">

            </td>

               

               <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'PC')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="EBooks_PC_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'PC')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_PC">

            </td>

               

               <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'SW')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="EBooks_SW_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'SW')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_SW">

            </td>

               

               <td>

            <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'Sale')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            

                 

                 

       <input type="text" class="txt-para"  id="EBooks_Sale_Percentage">

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT( Disposition ) FROM Assigned_Leads WHERE 

        (Source =  'Ebook') AND (Disposition =  'Sale')  AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

        ?>" id="EBooks_Sale">

            </td>

            

            <td>

                

                <input type="hidden" value=" <?php

         $result = mysqli_query($connect, "SELECT COUNT(Source) FROM Assigned_Leads WHERE Source =  'Ebook' AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>" id="EBooks_Total">

                

             <?php

         $result = mysqli_query($connect, "SELECT COUNT(Source) FROM Assigned_Leads WHERE Source =  'Ebook' AND (DATE >= '".$StartDateUSA."') AND (DATE <= '".$EndtDateUSA."')");

         echo mysql_result($result, 0);

       ?>

            </td>

            

        </tr>

      

      </tbody>

    </table>

    <?php
        }
    ?>



      

  </div>

</div>

<?php include('partial/footer.php') ?>



    <script>

    

$(document).ready(function(){



/****************************************************/

/************** Over All LEADSFB Excel *******************/

/**************************************************/    

var LEADSFB_Excel_NI = $('#LEADSFB_Excel_NI').val();    

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_NI_Percentage = LEADSFB_Excel_NI / LEADSFB_Excel_Total * 100;

$('#LEADSFB_Excel_NI_Percentage').val(Math.round(LEADSFB_Excel_NI_Percentage)+'%'); 



var LEADSFB_Excel_NT = $('#LEADSFB_Excel_NT').val();    

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_NT_Percentage = LEADSFB_Excel_NT / LEADSFB_Excel_Total * 100; 

$('#LEADSFB_Excel_NT_Percentage').val(Math.round(LEADSFB_Excel_NT_Percentage)+'%'); 



var LEADSFB_Excel_WN = $('#LEADSFB_Excel_WN').val();    

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_WN_Percentage = LEADSFB_Excel_WN / LEADSFB_Excel_Total * 100; 

$('#LEADSFB_Excel_WN_Percentage').val(Math.round(LEADSFB_Excel_WN_Percentage)+'%');



var LEADSFB_Excel_LB = $('#LEADSFB_Excel_LB').val();    

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_LB_Percentage = LEADSFB_Excel_LB / LEADSFB_Excel_Total * 100; 

$('#LEADSFB_Excel_LB_Percentage').val(Math.round(LEADSFB_Excel_LB_Percentage)+'%');

    

var LEADSFB_Excel_CT = $('#LEADSFB_Excel_CT').val();    

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_CT_Percentage = LEADSFB_Excel_CT / LEADSFB_Excel_Total * 100; 

$('#LEADSFB_Excel_CT_Percentage').val(Math.round(LEADSFB_Excel_CT_Percentage)+'%'); 



var LEADSFB_Excel_Fresh = $('#LEADSFB_Excel_Fresh').val();  

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_Fresh_Percentage = LEADSFB_Excel_Fresh / LEADSFB_Excel_Total * 100;   

$('#LEADSFB_Excel_Fresh_Percentage').val(Math.round(LEADSFB_Excel_Fresh_Percentage)+'%');   



var LEADSFB_Excel_CWOP = $('#LEADSFB_Excel_CWOP').val();    

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_CWOP_Percentage = LEADSFB_Excel_CWOP / LEADSFB_Excel_Total * 100; 

$('#LEADSFB_Excel_CWOP_Percentage').val(Math.round(LEADSFB_Excel_CWOP_Percentage)+'%');



var LEADSFB_Excel_CWP = $('#LEADSFB_Excel_CWP').val();  

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_CWP_Percentage = LEADSFB_Excel_CWP / LEADSFB_Excel_Total * 100;   

$('#LEADSFB_Excel_CWP_Percentage').val(Math.round(LEADSFB_Excel_CWP_Percentage)+'%');



var LEADSFB_Excel_FT = $('#LEADSFB_Excel_FT').val();    

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_FT_Percentage = LEADSFB_Excel_FT / LEADSFB_Excel_Total * 100; 

$('#LEADSFB_Excel_FT_Percentage').val(Math.round(LEADSFB_Excel_FT_Percentage)+'%');



var LEADSFB_Excel_PTP = $('#LEADSFB_Excel_PTP').val();  

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_PTP_Percentage = LEADSFB_Excel_PTP / LEADSFB_Excel_Total * 100;   

$('#LEADSFB_Excel_PTP_Percentage').val(Math.round(LEADSFB_Excel_PTP_Percentage)+'%');



var LEADSFB_Excel_PTPO = $('#LEADSFB_Excel_PTPO').val();    

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_PTPO_Percentage = LEADSFB_Excel_PTPO / LEADSFB_Excel_Total * 100; 

$('#LEADSFB_Excel_PTPO_Percentage').val(Math.round(LEADSFB_Excel_PTPO_Percentage)+'%');

    

var LEADSFB_Excel_PC = $('#LEADSFB_Excel_PC').val();    

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_PC_Percentage = LEADSFB_Excel_PC / LEADSFB_Excel_Total * 100; 

$('#LEADSFB_Excel_PC_Percentage').val(Math.round(LEADSFB_Excel_PC_Percentage)+'%');

    

var LEADSFB_Excel_SW = $('#LEADSFB_Excel_SW').val();    

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_SW_Percentage = LEADSFB_Excel_SW / LEADSFB_Excel_Total * 100; 

$('#LEADSFB_Excel_SW_Percentage').val(Math.round(LEADSFB_Excel_SW_Percentage)+'%');

    

var LEADSFB_Excel_Sale = $('#LEADSFB_Excel_Sale').val();    

var LEADSFB_Excel_Total = $('#LEADSFB_Excel_Total').val();  

var LEADSFB_Excel_Sale_Percentage = LEADSFB_Excel_Sale / LEADSFB_Excel_Total * 100; 

$('#LEADSFB_Excel_Sale_Percentage').val(Math.round(LEADSFB_Excel_Sale_Percentage)+'%'); 





    

    

$('#LEADSFB_Excel_WN_PercentageTotal').val(Math.round(LEADSFB_Excel_WN_Percentage + LEADSFB_Excel_WN_Percentage)+'%');

    

/****************************************************/

/************** Over All Website *******************/

/**************************************************/    

var Google_Ads_NI = $('#Google_Ads_NI').val();  

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_NI_Percentage = Google_Ads_NI / Google_Ads_Total * 100;

$('#Google_Ads_NI_Percentage').val(Math.round(Google_Ads_NI_Percentage)+'%');   



var Google_Ads_NT = $('#Google_Ads_NT').val();  

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_NT_Percentage = Google_Ads_NT / Google_Ads_Total * 100;  

$('#Google_Ads_NT_Percentage').val(Math.round(Google_Ads_NT_Percentage)+'%');

    

var Google_Ads_WN = $('#Google_Ads_WN').val();  

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_WN_Percentage = Google_Ads_WN / Google_Ads_Total * 100;  

$('#Google_Ads_WN_Percentage').val(Math.round(Google_Ads_WN_Percentage)+'%');

    

var Google_Ads_LB = $('#Google_Ads_LB').val();  

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_LB_Percentage = Google_Ads_LB / Google_Ads_Total * 100;  

$('#Google_Ads_LB_Percentage').val(Math.round(Google_Ads_LB_Percentage)+'%');

    

var Google_Ads_CT = $('#Google_Ads_CT').val();  

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_CT_Percentage = Google_Ads_CT / Google_Ads_Total * 100;  

$('#Google_Ads_CT_Percentage').val(Math.round(Google_Ads_CT_Percentage)+'%');   



var Google_Ads_Fresh = $('#Google_Ads_Fresh').val();    

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_Fresh_Percentage = Google_Ads_Fresh / Google_Ads_Total * 100;    

$('#Google_Ads_Fresh_Percentage').val(Math.round(Google_Ads_Fresh_Percentage)+'%'); 



var Google_Ads_CWOP = $('#Google_Ads_CWOP').val();  

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_CWOP_Percentage = Google_Ads_CWOP / Google_Ads_Total * 100;  

$('#Google_Ads_CWOP_Percentage').val(Math.round(Google_Ads_CWOP_Percentage)+'%');

    

var Google_Ads_CWP = $('#Google_Ads_CWP').val();    

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_CWP_Percentage = Google_Ads_CWP / Google_Ads_Total * 100;    

$('#Google_Ads_CWP_Percentage').val(Math.round(Google_Ads_CWP_Percentage)+'%');

    

var Google_Ads_FT = $('#Google_Ads_FT').val();  

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_FT_Percentage = Google_Ads_FT / Google_Ads_Total * 100;  

$('#Google_Ads_FT_Percentage').val(Math.round(Google_Ads_FT_Percentage)+'%');



var Google_Ads_PTP = $('#Google_Ads_PTP').val();    

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_PTP_Percentage = Google_Ads_PTP / Google_Ads_Total * 100;    

$('#Google_Ads_PTP_Percentage').val(Math.round(Google_Ads_PTP_Percentage)+'%');



    

var Google_Ads_PTPO = $('#Google_Ads_PTPO').val();  

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_PTPO_Percentage = Google_Ads_PTPO / Google_Ads_Total * 100;  

$('#Google_Ads_PTPO_Percentage').val(Math.round(Google_Ads_PTPO_Percentage)+'%');



var Google_Ads_PC = $('#Google_Ads_PC').val();  

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_PC_Percentage = Google_Ads_PC / Google_Ads_Total * 100;  

$('#Google_Ads_PC_Percentage').val(Math.round(Google_Ads_PC_Percentage)+'%');   

    

var Google_Ads_SW = $('#Google_Ads_SW').val();  

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_SW_Percentage = Google_Ads_SW / Google_Ads_Total * 100;  

$('#Google_Ads_SW_Percentage').val(Math.round(Google_Ads_SW_Percentage)+'%');   



var Google_Ads_Sale = $('#Google_Ads_Sale').val();  

var Google_Ads_Total = $('#Google_Ads_Total').val();    

var Google_Ads_Sale_Percentage = Google_Ads_Sale / Google_Ads_Total * 100;  

$('#Google_Ads_Sale_Percentage').val(Math.round(Google_Ads_Sale_Percentage)+'%');   

    

    

$('#Google_Ads_LB_PercentageTotal').val(Math.round(Google_Ads_LB_Percentage + Google_Ads_LB_Percentage)+'%');

    

    

/****************************************************/

/************** Ebooks *******************/

/**************************************************/    

var EBooks_NI = $('#EBooks_NI').val();  

var EBooks_Total = $('#EBooks_Total').val();    

var EBooks_NI_Percentage = EBooks_NI / EBooks_Total * 100;

$('#EBooks_NI_Percentage').val(Math.round(EBooks_NI_Percentage)+'%');   



var EBooks_NT = $('#EBooks_NT').val();  

var EBooks_Total = $('#EBooks_Total').val();    

var EBooks_NT_Percentage = EBooks_NT / EBooks_Total * 100;  

$('#EBooks_NT_Percentage').val(Math.round(EBooks_NT_Percentage)+'%');

    

var EBooks_WN = $('#EBooks_WN').val();  

var EBooks_Total = $('#EBooks_Total').val();    

var EBooks_WN_Percentage = EBooks_WN / EBooks_Total * 100;  

$('#EBooks_WN_Percentage').val(Math.round(EBooks_WN_Percentage)+'%');

    

var EBooks_LB = $('#EBooks_LB').val();  

var EBooks_Total = $('#EBooks_Total').val();    

var EBooks_LB_Percentage = EBooks_LB / EBooks_Total * 100;  

$('#EBooks_LB_Percentage').val(Math.round(EBooks_LB_Percentage)+'%');

    

var EBooks_CT = $('#EBooks_CT').val();  

var EBooks_Total = $('#EBooks_Total').val();    

var EBooks_CT_Percentage = EBooks_CT / EBooks_Total * 100;  

$('#EBooks_CT_Percentage').val(Math.round(EBooks_CT_Percentage)+'%');

    

var EBooks_Fresh = $('#EBooks_Fresh').val();    

var EBooks_Total = $('#EBooks_Total').val();    

var EBooks_Fresh_Percentage = EBooks_Fresh / EBooks_Total * 100;    

$('#EBooks_Fresh_Percentage').val(Math.round(EBooks_Fresh_Percentage)+'%');

    

var EBooks_CWOP = $('#EBooks_CWOP').val();  

var EBooks_Total = $('#EBooks_Total').val();    

var EBooks_CWOP_Percentage = EBooks_CWOP / EBooks_Total * 100;  

$('#EBooks_CWOP_Percentage').val(Math.round(EBooks_CWOP_Percentage)+'%');

    

var EBooks_CWP = $('#EBooks_CWP').val();    

var EBooks_Total = $('#EBooks_Total').val();    

var EBooks_CWP_Percentage = EBooks_CWP / EBooks_Total * 100;    

$('#EBooks_CWP_Percentage').val(Math.round(EBooks_CWP_Percentage)+'%'); 

    

var EBooks_FT = $('#EBooks_FT').val();  

var EBooks_Total = $('#EBooks_Total').val();    

var EBooks_FT_Percentage = EBooks_FT / EBooks_Total * 100;  

$('#EBooks_FT_Percentage').val(Math.round(EBooks_FT_Percentage)+'%');

    

var EBooks_PTP = $('#EBooks_PTP').val();    

var EBooks_Total = $('#EBooks_Total').val();    

var EBooks_PTP_Percentage = EBooks_PTP / EBooks_Total * 100;    

$('#EBooks_PTP_Percentage').val(Math.round(EBooks_PTP_Percentage)+'%');

    

var EBooks_PC = $('#EBooks_PC').val();  

var EBooks_Total = $('#EBooks_Total').val();    

var EBooks_PC_Percentage = EBooks_PC / EBooks_Total * 100;  

$('#EBooks_PC_Percentage').val(Math.round(EBooks_PC_Percentage)+'%');   



var EBooks_SW = $('#EBooks_SW').val();  

var EBooks_Total = $('#EBooks_Total').val();    

var EBooks_SW_Percentage = EBooks_SW / EBooks_Total * 100;  

$('#EBooks_SW_Percentage').val(Math.round(EBooks_SW_Percentage)+'%');   

    

var EBooks_Sale = $('#EBooks_Sale').val();  

var EBooks_Total = $('#EBooks_Total').val();    

var EBooks_Sale_Percentage = EBooks_Sale / EBooks_Total * 100;  

$('#EBooks_Sale_Percentage').val(Math.round(EBooks_Sale_Percentage)+'%');   

    

$('#EBooks_WN_PercentageTotal').val(Math.round(EBooks_WN_Percentage + EBooks_WN_Percentage)+'%');

    

    

/****************************************************/

/************** Google Ads Campaign Nifty *******************/

/**************************************************/    

var Nifty_NI = $('#Nifty_NI').val();    

var Nifty_Total = $('#Nifty_Total').val();  

var Nifty_NI_Percentage = Nifty_NI / Nifty_Total * 100;

$('#Nifty_NI_Percentage').val(Math.round(Nifty_NI_Percentage)+'%'); 



var Nifty_NT = $('#Nifty_NT').val();    

var Nifty_Total = $('#Nifty_Total').val();  

var Nifty_NT_Percentage = Nifty_NT / Nifty_Total * 100; 

$('#Nifty_NT_Percentage').val(Math.round(Nifty_NT_Percentage)+'%'); 



$('#Nifty_NT_Percentage_Total').val(Math.round(Nifty_NI_Percentage + Nifty_NT_Percentage)+'%');     

    

/********************************************************************/

/************** Google Ads Campaign Stock Market *******************/

/*******************************************************************/   

var Stock_Market_NI = $('#Stock_Market_NI').val();  

var Stock_Market_Total = $('#Stock_Market_Total').val();    

var Stock_Market_NI_Percentage = Stock_Market_NI / Stock_Market_Total * 100;

$('#Stock_Market_NI_Percentage').val(Math.round(Stock_Market_NI_Percentage)+'%');   



var Stock_Market_NT = $('#Stock_Market_NT').val();  

var Stock_Market_Total = $('#Stock_Market_Total').val();    

var Stock_Market_NT_Percentage = Stock_Market_NT / Stock_Market_Total * 100;    

$('#Stock_Market_NT_Percentage').val(Math.round(Stock_Market_NT_Percentage)+'%');



$('#Stock_Market_NT_Percentage_Total').val(Math.round(Stock_Market_NI_Percentage + Stock_Market_NT_Percentage)+'%');        

    

/********************************************************************/

/************** Google Ads Campaign Intraday Trading *******************/

/*******************************************************************/   

var Intraday_Trading_NI = $('#Intraday_Trading_NI').val();  

var Intraday_Trading_Total = $('#Intraday_Trading_Total').val();    

var Intraday_Trading_NI_Percentage = Intraday_Trading_NI / Intraday_Trading_Total * 100;

$('#Intraday_Trading_NI_Percentage').val(Math.round(Intraday_Trading_NI_Percentage)+'%');   



var Intraday_Trading_NT = $('#Intraday_Trading_NT').val();  

var Intraday_Trading_Total = $('#Intraday_Trading_Total').val();    

var Intraday_Trading_NT_Percentage = Intraday_Trading_NT / Intraday_Trading_Total * 100;    

$('#Intraday_Trading_NT_Percentage').val(Math.round(Intraday_Trading_NT_Percentage)+'%');



$('#Intraday_Trading_NT_Percentage_Total').val(Math.round(Intraday_Trading_NI_Percentage + Intraday_Trading_NT_Percentage)+'%');    

    

/********************************************************************/

/************** Google Ads Campaign Option Trading *******************/

/*******************************************************************/   

var Option_Trading_NI = $('#Option_Trading_NI').val();  

var Option_Trading_Total = $('#Option_Trading_Total').val();    

var Option_Trading_NI_Percentage = Option_Trading_NI / Option_Trading_Total * 100;

$('#Option_Trading_NI_Percentage').val(Math.round(Option_Trading_NI_Percentage)+'%');   



var Option_Trading_NT = $('#Option_Trading_NT').val();  

var Option_Trading_Total = $('#Option_Trading_Total').val();    

var Option_Trading_NT_Percentage = Option_Trading_NT / Option_Trading_Total * 100;  

$('#Option_Trading_NT_Percentage').val(Math.round(Option_Trading_NT_Percentage)+'%');



$('#Option_Trading_NT_Percentage_Total').val(Math.round(Option_Trading_NI_Percentage + Option_Trading_NT_Percentage)+'%');  



/********************************************************************/

/************** Google Ads Campaign Home page **********************/

/*******************************************************************/   

var Home_page_NI = $('#Home_page_NI').val();    

var Home_page_Total = $('#Home_page_Total').val();  

var Home_page_NI_Percentage = Home_page_NI / Home_page_Total * 100;

$('#Home_page_NI_Percentage').val(Math.round(Home_page_NI_Percentage)+'%'); 



var Home_page_NT = $('#Home_page_NT').val();    

var Home_page_Total = $('#Home_page_Total').val();  

var Home_page_NT_Percentage = Home_page_NT / Home_page_Total * 100; 

$('#Home_page_NT_Percentage').val(Math.round(Home_page_NT_Percentage)+'%');



$('#Home_page_NT_Percentage_Total').val(Math.round(Home_page_NI_Percentage + Home_page_NT_Percentage)+'%'); 

    

    

});

        

        

    

    </script>

    