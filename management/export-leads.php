<?php ini_set("error_reporting", E_ALL);  include('partial/session_start.php');  ?>
<?php //include($_SERVER['DOCUMENT_ROOT']."/partial/access-control-role-base.php"); ?>
<?php
 // $UserName = $_GET['UserName'];
 // $Source = $_GET['Source'];
 // $Disposition = $_GET['Disposition'];

?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Export Leads</title>
  <?php require('partial/plugins.php'); ?>
  <style>

    .duplicate {
      background:#ec7b7b;
      color:#333;
    }

    .Administrator  {
     color: #3c763d;
     background-color: #dff0d8;
     border-color: #d6e9c6;
   }


 </style>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

</head>
<body>


 <?php include('partial/sidebar.php') ?>

 <div class="main_container">
  <header>
    <?php include('partial/header-top.php') ?>

    <?php 
    // function definition is written in hearder-top.php
    // if agent bank details are missing, will redirect on agent login details page
    check_agent_bank_details();
    ?>

  </header>
  <div class="breadcurms"> 
    <a href="analytics-date.php" style="margin-left: -5px;" class="">Analytics Reports</a> | <a href="view-leads.php">View Leads</a> | <a class="btn btn-xs btn-primary" href="export-leads.php">Export Leads</a> | <a href="whatsapp-number-update.php" class="">Whatsapp Number Update</a> | <a href="ip-restriction-history.php" class="">Ip Restriction</a> | <a href="leads-count.php" >Assigned Leads Analytics</a>  | <a href="upload-leads.php">Upload Leads</a>      
  </div>
  <div class="containter" style="padding:20px 20px 0 20px;">

    <?php include('connection/dbconnection_crm.php')?>
    <?php 

    $limit=1000; 
  

    $sql2 = "select count(Id) as count FROM  Assigned_Leads";  
//echo $sql2;
    $result = mysqli_query($connect,$sql2);
// echo "result = "."<pre>"; print_r($result->fetch_object()->count); echo "</pre>";
    // $total_rows = mysqli_num_rows($result);
    $total_rows = $result->fetch_object()->count;
// echo "result = "."<pre>"; print_r($total_rows); echo "</pre>";
    $total_pages = ceil ($total_rows / $limit);  

 

    if (!isset($_GET['page']) ) {  

      $selected_page_number = 1;  

    } else {  

     $selected_page_number = $_GET['page'];  

   } 


   $initial_page = ($selected_page_number-1) * $limit; 

   ?>

   <?php

   $sel = "select * from employee where Team_Leader = '".$username."' and Status = 'Active' order by username asc";
   $qry = mysqli_query($connect,$sel);
   $teams = array();
   while($fetch = $qry->fetch_assoc()){
    $teams[] = $fetch['username'];
  }


  
  if (isset($_GET['submit'])) {

    $from = $_GET['from']; 
    $to = $_GET['to']; 
    if(isset($_GET['disposition']) && $_GET['disposition'] !='All')
    { 
      $disposition = $_GET['disposition'];
       $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y') AS DateTimeINR FROM  `Assigned_Leads`  WHERE LeadDateTime BETWEEN '".$from."' AND '".$to."'  AND (Disposition = '".$disposition."') ORDER BY  `id` DESC");
    }
    else
    {
      $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y') AS DateTimeINR FROM  `Assigned_Leads`  WHERE LeadDateTime BETWEEN '".$from."' AND '".$to."'  ORDER BY  `id` DESC");
    }

  }

  else if($_SESSION['Role'] == 'Super Admin'){
    $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y') AS DateTimeINR FROM  `Assigned_Leads` ORDER BY  `id` DESC LIMIT ".$initial_page." ,".$limit."");

  }

  $result = mysqli_query($connect,$sql);

  $tn = array();
  $i = 0;
  while($rows = $result->fetch_array())
  {
    //print_r($rows['Mobile']);
   //$duplicate[$row['Mobile']];
   if($_SESSION['Role'] == 'Super Admin'){
     $i++;
     $leads[] = $rows; 
     if($i == 1000){
    //break;
     }
   }
   else{

     $i++;
     $leads[] = $rows; 
     if($i == 1000){

     } 
   }



 }
 $duplicate = array_count_values($mobile);




 ?>
 <div class="row">
   <div class="col-sm-12 ML20 MB20" style="padding: 25px 15px;">
    <form class="form-inline" action="export-leads-in-excel.php" method="GET">
      <div class="form-group">
        <label for="email">From Date:</label>
        <input type="date" class="form-control ML10"  id="dates" name="from" value="<?php echo isset($_GET['from'])?$_GET['from']:'';?>">
      </div>
      <div class="form-group">
        <label for="email" class=" ML10">To Date:</label>
        <input type="date" class="form-control ML10"  id="dates" name="to"  value="<?php echo isset($_GET['to'])?$_GET['to']:'';?>">
      </div>
      <div class="form-group">
        <label for="email" class=" ML10" style="display:">Disposition:</label>
        <select class="form-control ML10" name="disposition">
         
         <?php include('partial/disposition.php') ?> 
         <option value="Fresh">Fresh</option>
         <option value="All">All</option>
         <?php 
         if(isset($_GET['disposition']))
         {
          ?>

          <option value="<?php echo $_GET['disposition']?>" selected><?php echo $_GET['disposition']?></option>
        <?php }?>
      </select>
    </div>
    <!--<input type='hidden' name="TabValue" value="" />-->
    <!-- <button type="submit" class="btn btn-primary  ML10" style="margin-left:10px;">Submit</button> -->
    <input type = "submit" name = "submit" value = "Export to excel"  class="btn btn-primary  ML10">
    <a href="export-leads.php" class="btn btn-default  ML10" style="margin-left:20px;">Reset</a>
  </form>
</div>
</div>

<table id="FreshLeads" class="display table-bordered">
  <thead>
    <tr>
      <th>SR</th>
      <th>Full Name</th>
      <th>Mobile</th>
      <th>User Name</th>
      <th>Status</th>
      <th>Source</th>
      <th>Disposition</th>
      <th>State</th>
      <th>Segment</th>
      <th>Date</th>

    </tr>
  </thead>
  <tbody>
    <?php 
    $count = 0;
    if(!empty($leads)){
      foreach($leads as $key=> $row)
      {
        ?>
        <tr>
          <td><?php echo $key+1;?></td>
          <td><?php echo $row['Full_Name'];?> </td>
          <td><?php echo $row['Mobile'];?></td>
          <td><?php echo $row['UserName'];?></td>
          <td><a href="#_" class="btn btn-danger"><?php echo $row['Status'];?></a></td>
          <td><?php echo $row['Source'];?></td>
          <td><?php echo $row['Disposition'];?></td>
          <td><?php echo $row['State'];?></td>
          <td><?php echo $row['Segment'];?></td>
          <td><?php echo $row['DateTimeINR'];?> </td>

        </tr>   

        <?php   
      }
    }
    ?>
  </tbody>
</table>
<br>

</div>
<?php if(!isset($_GET['submit'])){?>
  <div class="pagination" style="padding-left:32px;padding-right: 20px;padding-top: 15px;padding-bottom: 15px;">
    <?php 


    for($page_number = 1; $page_number <= $total_pages; $page_number++) 
    {
     if($page_number == $selected_page_number){  
       ?>
       <a class="btn btn-primary" href = "export-leads.php?page=<?php echo $page_number;?>"><?php echo $page_number; ?></a>
     <?php }else{?>
       <a class="btn btn-danger" href = "export-leads.php?page=<?php echo $page_number;?>"><?php echo $page_number; ?></a>
     <?php }}  
     ?>
   </div>
 <?php }?>
</div>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>     
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script>

  $(document).ready(function(){

    //$('#FreshLeads').DataTable();

  });
  var table = $('#FreshLeads').DataTable( {
    scrollY:        "500px",
    // scrollX:        true,
    // scrollCollapse: true,
    paging:         true,
    ordering: true,
    info:     true,
    bFilter: true,
    "ordering": true,
    dom: 'Bfrtip',
    buttons: [
    // 'csv'
    ]

  } );

</script>
<script type="text/javascript">





</script>


<script type="text/javascript">

</script>


<?php include('partial/footer.php') ?>
