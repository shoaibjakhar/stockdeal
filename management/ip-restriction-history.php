<?php  include('partial/session_start.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/partial/access-control-role-base.php"); ?>
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


    <!--    <div class="breadcurms">  <a href="upload-leads.php" class="btn btn-xs btn-primary">Upload Leads</a></div> -->
    <div class="breadcurms"> 
      <a href="analytics-date.php" style="margin-left: -5px;" class="">Analytics Reports</a> | <a href="view-leads.php">View Leads</a> | <a href="export-leads.php">Export Leads</a> | <a href="whatsapp-number-update.php" class="">Whatsapp Number Update</a> | <a href="ip-restriction-history.php" class="btn btn-xs btn-primary">Ip Restriction</a> | <a href="leads-count.php" >Assigned Leads Analytics</a>  | <a href="upload-leads.php">Upload Leads</a>      
    </div>

<div class="containter" style="padding:20px 20px 0 20px;">

















    








<div class="row pb-3" style="    border: #eee solid 2px;">
    <form method="POST" action=""  >
      <div class="col-md-12">
        <h5>Add New IP Address</h5>
        
      </div>
      <div class="col-md-2">
            <div class="form-group">
                <label>IP Address</label>
                <input type="text" name="IP_Address" placeholder="Enter IP address" class="form-control" value="" required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="Full_Name" placeholder="Enter name" class="form-control" value="" required>
            </div>
        </div>
      
        <div class="col-md-2 " style="margin-top: 23px;">
           <input type = "submit" name = "submit" value = "Submit"  class="btn btn-primary  ML10">
        </div>
        
    </form>
</div>
 <?php

    if (isset($_POST['submit'])) {
        
        $IP_Address = $_POST['IP_Address']; 
        $Full_Name = $_POST['Full_Name']; 
        
        
        $qry="INSERT INTO `allowUser`(`IP_Address`, `Full_Name`) VALUES ('".$IP_Address."','".$Full_Name."')";
        
        $result = mysqli_query($connect,$qry );
        // echo mysql_result($result, 0);
        }
  ?>
 



<div id="SalesAgentWise_wrapper" class="dataTables_wrapper no-footer">

<table id="Clients" class="display cell-border dataTable no-footer" cellspacing="0" width="100%" role="grid" style="width: 100%;">
    <thead>
        <tr role="row">
            <th style="text-align: center; width: 47px;" class="sorting_disabled" rowspan="1" colspan="1">SR</th>
            <th style="text-align: center; width: 101px;" class="sorting_disabled" rowspan="1" colspan="1">IP Address</th>
            <th style="text-align: center; width: 80px;" class="sorting_disabled" rowspan="1" colspan="1">Name</th>
            <th style="text-align: center; width: 80px;" class="sorting_disabled" rowspan="1" colspan="1">Action</th>
            
        </tr>
    </thead>
    <tbody>
         <?php
              $sql1 ="SELECT * FROM `allowUser` ORDER BY id DESC ";

                $result = mysqli_query($connect,$sql1);
                $i=1;
                while($row = $result->fetch_array())
                {?>
                 
                  <tr role="row" class="odd">
                    <td style="text-align:center"><?php echo  $i;?></td>
                    <td style="text-align:center"><?php echo  $row['IP_Address'];  ?></td>
                    <td style="text-align:center"><?php echo  $row['Full_Name'];  ?></td>
                    <td style="text-align:center"><a href="delete-IP.php?id=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
                   
                </tr>
              <?php 
               $i=$i+1;
                } ?>
      
        
    </tbody>
</table>
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
