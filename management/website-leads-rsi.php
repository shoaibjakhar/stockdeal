<?php  include('partial/session_start.php'); ?>
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
  <title>Website Leads</title>
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
   <a href="memberpage.php">Dashbord</a> | 
   <a href="website-leads-rsi.php" class="btn btn-xs btn-primary">Website Leads</a> | 
   <a href="assign-multiple-leads.php">Multiple Assign</a> |
   <a href="assign-bulk-leads.php">Bulk Assign</a> |
   <a href="leads-filter_4_new.php">Re Assign</a> 
   <!--| <a href="leads-count.php">Analytics</a>-->
 </div>
 <div class="containter" style="padding:20px 20px 0 20px;">
  <?php include('connection/dbconnection_crm.php')?>
  <h3 style="padding:10px;font-size:18px;" class="brand-color-bg-n-bdr">Website Today's Leads   (<span>Duplicate Leads </span><span id="duplicate_count"></span>)
   <div class="pull-right" style="display: none;"><span id="totalRecord"></span>  Records</div>
 </h3>

 <?php
 $sel = "select * from employee where Team_Leader = '".$username."' and Status = 'Active' order by username asc";
 $qry = mysqli_query($connect,$sel);
 $teams = array();
 while($fetch = $qry->fetch_assoc()){
  $teams[] = $fetch['username'];
}

if($_SESSION['Role'] == 'SR_TL'){
  $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y %h:%i') AS DateTimeINR FROM  `Assigned_Leads` WHERE UserName = '".$username."' AND Disposition = 'Fresh' ORDER BY  `id` DESC");
}
if($_SESSION['Role'] == 'Team Leader'){
  $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y %h:%i') AS DateTimeINR FROM  `Assigned_Leads` WHERE UserName = '".$username."' AND Disposition = 'Fresh' ORDER BY  `id` DESC");
}

if($_SESSION['Role'] == 'Super Admin'){
  $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y %h:%i') AS DateTimeINR FROM  `Assigned_Leads` WHERE (Status IS NULL OR Status='Open') AND Disposition = 'Fresh' ORDER BY  `id` DESC");


}



$mobile_sql = "SELECT Mobile from Assigned_Leads";




$result = mysqli_query($connect,$sql);
$mobile_sql_result = mysqli_query($connect,$mobile_sql);



while($rm = $mobile_sql_result->fetch_assoc()){
 $mobile[] = $rm['Mobile'];
}
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
    //   if(!in_array($rows['UserName'],$teams)){
    //       $tn[] = $rows['UserName'];
    //       continue;
    //   }
    //   else{
    //       $i++;
    //       $leads[] = $rows; 
    //   }
 $i++;
 $leads[] = $rows; 
 if($i == 1000){
  //break;
} 
}



}
$duplicate = array_count_values($mobile);





if($_SESSION['Role'] == 'SR_TL'){
 $sql1 = ("SELECT `username` FROM `employee` WHERE Role='Team Leader' AND Team_Leader ='".$username."' AND `Status` = 'Active' ORDER BY  `employee`.`username` ASC LIMIT 0 , 200");
}
if($_SESSION['Role'] == 'Team Leader'){
  $sql1 = ("SELECT `username` FROM `employee` WHERE Role='Agent' AND Team_Leader ='".$username."' AND `Status` = 'Active' ORDER BY  `employee`.`username` ASC LIMIT 0 , 200");
}
if($_SESSION['Role'] == 'Super Admin'){

 $sql1 = ("SELECT `username` FROM `employee` WHERE Role='SR_TL' AND `Status` = 'Active' ORDER BY  `employee`.`username` ASC LIMIT 0 , 200");

}

//echo("$('.AgentNames').html('"); 
$result1 = mysqli_query($connect, $sql1);
$sl= '<option value="">Select</option>';
while($row1 = mysqli_fetch_array($result1))

{
  $sl.= '<option value="'.$row1['username'].'">'.$row1['username'].'</option>';
}


?>

<table id="FreshLeads" class="display">
  <thead>
    <tr>
      <th>Status</th>
      <th style="width:100px;">Current Date</th>
      <th>Full Name</th>
      <th>Mobile</th>
      <th>
        <?php
        if($_SESSION['Role'] == 'SR_TL'){
          echo 'SR Team Lead';
         }
         if($_SESSION['Role'] == 'Team Leader'){
            echo 'Team Lead';
         }
        if($_SESSION['Role'] == 'Super Admin'){
           echo 'SR Team Lead';
        }?>
   </th>
   <th>Status</th>
   <th style="">Source</th>
   <th>Disposition</th>
   <th>State</th>
   <th>Investment</th>
   <th>Segment</th>

 </tr>
</thead>
<tbody>
  <?php 
  $count = 0;
  if(!empty($leads)){
    foreach($leads as $row)
    {
      ?>
      <tr>
       <td>
        <select class="form-control AssignToCSR AgentNames" id="target" style="width:160px;">
          <?php 
          echo  $sl;
          ?>
        </select>
        <input type="hidden" class="id" value="<?php echo $row['id']; ?>"> </td>
        <td><?php echo $row['DateTimeINR'];?> </td>
        <td><?php echo $row['Full_Name'];?> </td>
        <td><?php echo $row['Mobile'];
        if($duplicate[$row['Mobile']]>1)
          { 
            $count++;
            ?>
           <button class="btn btn-primary btn-sm" type="button">DUPLICATE <?php //echo $duplicate[$row['Mobile']]; ?></button>

         <?php }
         ?></td>
         <td><?php echo $row['UserName'];?></td>
         <td><a href="#_" class="btn btn-danger"><?php echo $row['Status'];?></a></td>
         <td><?php echo $row['Source'];?></td>
         <td><?php echo $row['Disposition'];?></td>
         <td><?php echo $row['State'];?></td>
         <td><?php echo $row['Investment'];?></td>
         <td><?php echo $row['Segment'];?></td>

       </tr>   

       <?php   
     }
   }
   ?>
 </tbody>
</table>
<br>
<input type="hidden" name="count_duplicate_leads" id="count_duplicate_leads" value="<?php echo $count;?>">

</div>

</div>
<form action="website-leads-assign-agent.php" method="get" style="display:none;">
  <input type="text" id="id" name="id" value="">
  <input type="text" id="AssignToCSR" name="AssignToCSR" value="">
  <input type="text" id="AssignStatus" name="AssignStatus" value="">
  <input type="submit" value="submit" id="submit">
</form>
<script>

  $(document).ready(function(){
       var count_lead = $('#count_duplicate_leads').val();
       $("#duplicate_count").text(count_lead);
       //alert(count_lead);

    $('#FreshLeads').DataTable();


        //$(".AssignToCSR option:first").attr('selected','selected');
        
        $('.AssignToCSR').change(function(){
          var id = $(this).closest("tr").find('.id').val();
          var AssignToCSR = $(this).val();
          $('#id').val(id);
          $('#AssignToCSR').val(AssignToCSR);
          $('#AssignStatus').val('Assigned');

         //alert(id+' '+AssignToCSR);

         if (AssignToCSR != null) {
           setTimeout(function(){ $("#submit").trigger("click"); }, 200);

         }
         else {
          alert('Failed to Assign')
        }  

         //setTimeout(function(){ $("#submit").trigger("click"); }, 100);
       });
      });

    </script>
    <script type="text/javascript">


      $(document).ready(function(){
       var rowCount = $('#FreshLeads tr').length;
       $('#totalRecord').text(rowCount - 1);

       <?php 
        // if($_SESSION['Role'] == 'Super Admin'){
        //     include('partial/agents-name.php');
        // }
        // else{
        //     echo("$('.AgentNames').html('"); 
        //     echo('<option value="">Select</option>');
        //     foreach($teams as $team){
        //         echo '<option value="'.$team.'">'.$team.'</option>';
        //     }
        //     echo("')");
        // }

       ?>

    //alert('asd');
  });





</script>


<script type="text/javascript">

</script>


<?php include('partial/footer.php') ?>
