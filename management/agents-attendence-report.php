<?php  include('partial/session_start.php'); ?>

<!doctype html>
<html>
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Agents Attendace Report</title>
 <?php require('partial/plugins.php'); ?>
 <style type="text/css">
  .dataTables_info{
    display: none;
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
 <div class="breadcurms">
   <div class="pull-left">
    <a href="memberpage.php">Dashbord</a>
  </div>
  <div class="clearfix"></div>
</div>
<div class="containter" style="padding:20px 20px 0 20px;">
 <?php
 if(isset($_SESSION['message']) && $_SESSION['message'] != ''){
  ?>
  <div class="alert alert-success" role="alert">
   <?php echo $_SESSION['message']; ?>
 </div>
 <?php
 $_SESSION['message'] = null;
}
?>

<?php
if(isset($_SESSION['error_message']) && $_SESSION['error_message'] != ''){
  ?>
  <div class="alert alert-danger" role="alert">
   <?php echo $_SESSION['error_message']; ?>
 </div>
 <?php
 unset($_SESSION['error_message']);
}
?>
<?php include('connection/dbconnection_crm.php')?>
<div class="col-sm-12" style="">
  <div class="panel panel-primary">
    <div class="panel-heading font-size18">Agents Attendace Report Set Ontime</div>
    <div class="panel-body">
      <table id="attentance_Report" class="display">
        <thead>
          <tr>
            <th>SR#</th>

            <th>
              Team Leader 
            </th>
            <th>
              Agent Name
            </th>
            <th>
              Total Set Ontime
            </th>
             <th>
              Set Ontime Exceeding Limit
            </th>
            <th>
              Date
            </th>
           
          </tr>
        </thead>
        <tbody >
         <?php
         $date = Date('Y-m-d');
         $explode_dates_1 = explode("-",$date);
         $explode_year_dates =  $explode_dates_1[0];
         $explode_month_dates  =  $explode_dates_1[1];
         $like_string= '%-'.$explode_month_dates.'-'.$explode_year_dates;
         $i=0;
         $sel = "select username from employee where Role = 'Team Leader' AND  Status = 'Active' ORDER BY username ASC";
         $qry = mysqli_query($connect,$sel);

         while($tl_rows = $qry->fetch_assoc()){
          $sel1 = "select id,username from employee where Role = 'Agent' AND Team_Leader = '".$tl_rows['username']."' AND Status = 'Active'  ORDER BY username ASC";
           // echo $sel1;die();
          $qry1 = mysqli_query($connect,$sel1);

          while($rows = $qry1->fetch_assoc()){

            ?>
            <?php 
                $sels = "SELECT COUNT(*) AS cn FROM attendence WHERE user_id ='".$rows['id']."'  AND date LIKE '".$like_string."'  AND  tl_convert_late_to_ontime='yes' ";
                $qrys = mysqli_query($connect,$sels);
                $fetch = $qrys->fetch_assoc();
                $count = $fetch['cn'];
                if($count>0){
                  $i++;
            ?>
            <tr>
              <td><?php echo $i;?> </td>
              <td><strong><?php echo $tl_rows['username']; ?></strong></td>
              <td><strong><?php echo $rows['username']; ?></strong></td>
              <td >  
                <?php



                echo $count;


                ?>
              </td>
                <td>
                <?php   
                  if($count>3)
                  {
                     echo ($count-3);
                  }
                  else
                  {
                    echo 0;
                  }
                ?>
              </td>
              <td style="text-align: center;">
                <?php
                $sels = "SELECT id,date FROM attendence WHERE user_id ='".$rows['id']."'  AND date LIKE '".$like_string."'  AND  tl_convert_late_to_ontime='yes' ";
                
                $dates = mysqli_query($connect,$sels);
                while($date_rows = $dates->fetch_assoc()){
                  echo'<br>'.$date_rows['date'];
                   echo " <button class='btn btn-success btn-xs' style='line-height: 1.2;' type='button' data-att-id='".$date_rows['id']."'  id='set_ontime' data-att-action='remove_ontime' onclick='display(".$date_rows['id'].")'>Remove Ontime</button>";
                }
                
                ?>
              </td>
            
            
            </tr>
            <?php
          }
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
<script>

  $(document).ready(function(){ 
    $('#attentance_Report').DataTable();
  });

    
        function display(id)
        {
                var att_id = id;
                var att_action ='remove_ontime';// $("#set_ontime").attr("data-att-action");

                $.ajax({
                    type:"post",
                     url:"Attendance/update_late_status.php",
                     data:{"method":att_action,"id":att_id},
                     success:(data)=>{
                         console.log(data);
                         /*if(data == 'success'){
                             window.location.reload();
                         }*/
                          window.location.reload();
                     }
                })
        }

</script>
<?php include('partial/footer.php') ?>