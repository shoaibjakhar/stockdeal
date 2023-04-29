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

  	
  	<div class="breadcurms">  <a href="upload-leads.php" class="btn btn-xs btn-primary">Upload Leads</a></div>
  	
 

  <div class="containter" style="padding:15px 20px 0 10px;">

<?php
$sel_options = "SELECT Duplicate_Leads FROM Options where Id = 1";
$qry = mysqli_query($connect, $sel_options);
$Duplicate = 'Block';
while($row = mysqli_fetch_assoc($qry)){
    $Duplicate =  $row['Duplicate_Leads'];
}
//echo $Duplicate;

?>


			<div class="section-containter">
				<div class="profile_identity">

					<div class="col-lg-6 col-md-6 col-sm-6">
						
						<div class="panel panel-default" style="height: 284px;">
  <!--<div class="panel-heading font-size16"><a href="downloadcsv.php?t=<?php echo time(); ?>" target="_blank">Download Excel Format</a> | <a href="delete-duplicate.php">Delete Duplicate</a> <div class="pull-right">  Allow duplicate leads &nbsp;<label class="switch">-->
    <div class="panel-heading font-size16"><a href="downloadcsv.php?t=<?php echo time(); ?>" target="_blank">Download Excel Format</a> <div class="pull-right">  Allow duplicate leads &nbsp;<label class="switch">
  <input type="checkbox" <?php if($Duplicate == 'Allow'){ echo 'checked'; } ?> class="dup_lead_en_dis">
  <span class="slider round"></span>
</label></div></div>
  <div class="panel-body text-center">
	
	<?php 
	  
	  if($_SESSION['Role'] == 'Admin' or $_SESSION['Role'] == 'Super Admin') {
        include('Admin/upload-leads.php');
	//	echo ('Echo');
    } 
	   ?>
	  
	</div>
</div>
					</div>
					
					<div class="col-sm-3" style="display:;">
	 
		<div class="panel panel-default" style="height: 376px;">
  <div class="panel-heading font-size16">Lead Sources </div>
  <div class="panel-body">
<?php
$sel_options = "SELECT Source,Agency_Name,Duplicate_Leads FROM Options";
$qry = mysqli_query($connect,$sel_options);
while($row = mysqli_fetch_assoc($qry)){
   // if($row['Source'] == '' )
    $optionsT['Source'][] = $row['Source'];
    $optionsT['Agency_Name'][] = $row['Agency_Name'];
   // $options['Duplicate'][] =  $row['Duplicate_Leads'];
}



// $duplicate = $options['Duplicate'][0];
$sourceT = array_filter($optionsT['Source']);
$sourceT = array_combine(range(1,count($sourceT)),array_values($sourceT));
$agency_nameT = array_filter($optionsT['Agency_Name']);
$agency_nameT = array_combine(range(1,count($agency_nameT)),array_values($agency_nameT));


?>
	 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped" style="font-weight: bold;">
  <tbody>
    
    <?php
            $i  =0;
            foreach($sourceT as $src){
                $i++
    ?>
	  <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $src; ?></td>
      </tr>
      <?php } ?>
  </tbody>
</table>

	  
	</div>
</div>


</div>


<div class="col-sm-3" style="display:;">
	 
		<div class="panel panel-default" style="height: 376px;">
  <div class="panel-heading font-size16">Agency Names </div>
  <div class="panel-body">
	
	 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped" style="font-weight: bold;">
  <tbody>
   
      <?php 
      $i = 0;
        foreach($agency_nameT as $agc){
            $i++;
      ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $agc; ?></td>
      </tr>
   <?php } ?>
  </tbody>
</table>

	  
	</div>
</div>
</div>






				</div>
			</div>

	  
<div class="clearfix"></div>
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
