<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);




if (isset($_POST["import"])) {

$sel_options = "SELECT Source,Agency_Name,Duplicate_Leads FROM Options";
$qry = mysqli_query($connect,$sel_options);
while($row = mysqli_fetch_assoc($qry)){
   // if($row['Source'] == '' )
  $options['Source'][] = $row['Source'];
    $options['Agency_Name'][] = $row['Agency_Name'];
    $options['Duplicate'][] =  $row['Duplicate_Leads'];
   // $options['Team_Name'][] = $row['Team_Name'];
}

    
 $duplicate = $options['Duplicate'][0];
$source = array_filter($options['Source']);
$source = array_combine(range(1,count($source)),array_values($source));


$agency_name = array_filter($options['Agency_Name']);
$agency_name = array_combine(range(1,count($agency_name)),array_values($agency_name));

//$Team_Name = array_filter($options['Team_Name']);
//$Team_Name = array_combine(range(1,count($Team_Name)),array_values($Team_Name));

//print_r($duplicate);
//print_r($agency_name);

$USADate = date("Y-m-d");

    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {
      $file = fopen($fileName, "r");
      $i=0;
      $count = 0;
      while (($column = fgetcsv($file, 10000, ",")) !== FALSE)
             {
               $i++;

               //Skiping the first row.
               //Start here
               
                if($i == 1){
                    continue;
                }
              //end here
              if($duplicate != 'Allow'){
                  $sel = "select * from Assigned_Leads where Mobile = '".$column[2]."'";
                  $qry = mysqli_query($connect,$sel);
                  $get_data = mysqli_fetch_assoc($qry);
                
                  if($get_data){
                    continue;
                  }
               }
              
              //End here
                 $sqls[] = "INSERT into Assigned_Leads(Full_Name,Email,Mobile,Source,Agency_Name,State,Segment,LeadDateTime,Leads_Assigned_Date,Date,DateTime, remoteAddress) values('$column[0]','$column[1]','$column[2]','$column[3]','$column[4]','$column[5]','$column[6]','$USADate','$USADate','$USADate','$USADate','".get_client_ip()."')";

    $full_name = $column[0];
              $phone = $column[1];
              $email = $column[2];
              $sources = $column[3];
              $agency = $column[4];
              $Branch_Code_sq = $column[5];
              if($full_name == '' || $phone == '' || $email == '' || $sources =='' || $agency == '' ){
                  $null_error = 1;
                  unset($sqls);
                  break;
              }
              else if(!array_search($sources,$source)){
                  $source_error = 1;
                   unset($sqls);
                  break;
              }
              else if(!array_search($agency,$agency_name)){
                  $ag_error = 1;
                   unset($sqls);
                  break;
              }
             // else if(!array_search($Branch_Code_sq,$Team_Name)){
               //   $bc_error = 1;
                 //  unset($sqls);
                  //break;
             // }
              
              /*
              else if(($null_error != 1) && ($source_error != 1) && ($ag_error != 1) ) {

              //Skip Duplicate entry on database
              
              //Start here
                  

             }
             */
             
             }
             
            // print_r($sqls);
             
             for ($i=0; $i <count($sqls) ; $i++) {
               mysqli_query($connect,$sqls[$i]);
             }

            if(isset($null_error)){
                //echo "<script>alert('All fields must be filled')</script>";
                echo ('<script>setTimeout(function(){ window.location.href="upload-leads.php" }, 30000);</script><div class="alert alert-danger fade in alert-dismissible font-size18">All Column in excel must be filled</div>');
            
            }
            else if(isset($source_error)){
                // echo "<script>alert('Source Value is not matching with database values')</script>";
                 echo ('<script>setTimeout(function(){ window.location.href="upload-leads.php" }, 30000);</script><div class="alert alert-danger fade in alert-dismissible font-size18">Source Name is not matching </div>');
            
            }else if(isset($ag_error)){
                //echo "<script>alert('Agency Value is not matching with database values')</script>";
                 echo ('<script>setTimeout(function(){ window.location.href="upload-leads.php" }, 30000);</script><div class="alert alert-danger fade in alert-dismissible font-size18">Agency Name is not matching </div>');
            
            }
            
           // else if(isset($bc_error)){
                //echo "<script>alert('Agency Value is not matching with database values')</script>";
             //    echo ('<script>setTimeout(function(){ window.location.href="upload-leads.php" }, 30000);</script><div class="alert alert-danger fade in alert-dismissible font-size18">Branch Code is not matching </div>');
            
            //}
            else{
                 echo ('<script>setTimeout(function(){ window.location.href="upload-leads.php" }, 3000);</script><div class="alert alert-success fade in alert-dismissible font-size18"> <strong>'.count($sqls).'</strong>&nbsp;&nbsp; Leads inserted successfully</div>');
            
            }
 
  fclose($file);
  
  
  //echo '<script>window.location.href="/upload-leads.php"</script>';
  
  
  
  
  //echo $count;
//}
//echo $sqlInsert = "INSERT into csv (Full_Name,company_name,address,city,country,state,zip,phone1,phone2,email)
  //    values ('" . $column[0]." ".$column['1']."','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "','" . $column[7] . "','" . $column[8] . "','" . $column[9] . "',
    //    '" . $column[10] . "')";
    }
}
?>

<style>
.file-upload-wrapper {
  position: relative;
  width: 100%;
  height: 43px;
	border: #dcdcdc solid 1px;
}
.file-upload-wrapper:after {
  content: attr(data-text);
  font-size: 18px;
  position: absolute;
  top: 0;
  left: 0;
  background: #fff;
  padding: 10px 15px;
  display: block;
  width: calc(100% - 40px);
  pointer-events: none;
  z-index: 20;
  height: 40px;
  line-height: 40px;
  color: #999;
  border-radius: 5px 10px 10px 5px;
  font-weight: 300;
}
.file-upload-wrapper:before {
  content: 'Choose file';
  position: absolute;
  top: 0;
  right: 0;
  display: inline-block;
  height: 40px;
  background: #4daf7c;
  color: #fff;
  font-weight: 700;
  z-index: 25;
  font-size: 16px;
  line-height: 40px;
  padding: 0 15px;
  text-transform: uppercase;
  pointer-events: none;
  border-radius: 0 5px 5px 0;
}
.file-upload-wrapper:hover:before {
  background: #3d8c63;
}
.file-upload-wrapper input {
  opacity: 1;
  position: absolute;
  top: 9px;
  right: 0;
  bottom: 0;
  left: 10px;
  z-index: 99;
  height: 40px;
  margin: 0;
  padding: 0;
  display: block;
  cursor: pointer;
  width: 100%;
}
	
	.file-upload-wrapper input:focus  { outline: none;}


	
</style>

<form class="form-horizontal" action="" method="post" name="uploadCSV"
    enctype="multipart/form-data">
    <div class="input-row">
		<div class="file-upload-wrapper">
        <label class="col-md-4 control-label">Choose CSV File</label> <input
            type="file" name="file" id="file" accept=".csv">
       
			</div>
		 <button type="submit" id="submit" name="import" class="btn-submit btn btn-primary btn-lg" style="margin-top: 20px;">Import</button>
       

    </div>
    <div id="labelError"></div>
</form>


