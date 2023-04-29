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
<title>User Agreement List</title>
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
  
</header>

<div class="containter" style="padding:20px 20px 0 20px;">
<?php include('connection/dbconnection_crm.php')?>
<h3 style="padding:10px;font-size:18px;" class="brand-color-bg-n-bdr">User Agreement List

</h3>

<?php
$sel = "select * from agreement  order by id DESC";
$qry = mysqli_query($connect,$sel);


?>

<table id="FreshLeads" class="display">
    <thead>
        <tr>
           
            <th>Sr#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Agent</th>
            <th>Pan Number</th>
            <th>Date Of Birth</th>
            <th>IP Address</th>
            <th>Action</th>
           
        </tr>
    </thead>
    <tbody>
        <?php 
            if(1){ 
              $i=0;
                while($fetch = $qry->fetch_assoc())
                {
                  $i++;
                ?>
                <tr>
                   <td><?php echo $i;?> </td>
                   <td><?php echo $fetch['full_name'];?> </td>
                   <td><?php echo $fetch['email'];?></td>
                   <td><?php echo $fetch['mobile'];?></td>
                   <td><?php echo $fetch['agent_name'];?></td>
                   <td><?php echo $fetch['pan_number'];?></td>
                   <td><?php echo $fetch['dob'];?></td>
                   <td><?php echo $fetch['ip'];?></td>
                  <td>
                    <a onclick="return confirm('Are you sure?')" href='agreement_delete.php?id=<?php echo $fetch["id"] ?>' class="btn btn-xs btn-danger">Delete</a>
                  </td>
                 
                </tr>   
               
                <?php   
               }
            }
        ?>
</tbody>
</table>
<br>

</div>

</div>

<script>

    $(document).ready(function(){

       
        $('#FreshLeads').DataTable();

  
    });
    
</script>



<script type="text/javascript">

</script>


<?php include('partial/footer.php') ?>
