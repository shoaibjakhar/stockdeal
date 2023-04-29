<?php
ini_set('max_execution_time', '0');
//$connect = mysqli_connect("103.50.160.116", "shareevx_root", "Ahmed@123456", "shareevx_rsicrm");
 include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");
 error_reporting(E_ALL);
 ini_set('display_errors',1);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>RSI Date</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
	<style>
		.DND, .NR, .Sale, .PC { color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;} 
		
		 input[type=checkbox] { 
            width: 20px; 
            height: 20px; cursor: pointer;
        } 
        
        .form-control {width:200px !important;}
		
	</style>
<script>
  
  $( function() {
    $("#StartDate").datepicker({
  	 dateFormat: 'dd-mm-yy', 
     altField  : '#StartDate_SQLFormat',
     altFormat : 'yy-mm-dd',
     format    : 'yy-mm-dd'
  	});
	  
    $("#EndDate").datepicker({
  	 dateFormat: 'dd-mm-yy', 
     altField  : '#EndData',
     altFormat : 'yy-mm-dd',
     format    : 'yy-mm-dd'
  	});
	  
  });
  </script>
</head>

<body>
<div class="container" style="margin-top: 50px;">
  <div class="row">
	  <div class="col-sm-12">
	   <p>Date</p>
	  </div>
    <div class="col-sm-12">
      <form class="form-inline" action="Export-to-Excel/download-excel.php" method="POST" autocomplete="off">
        <div class="form-group">
          <label for="email">Start Date:</label>
          <input type="text" class="form-control" id="StartDate" name="StartDate" placeholder="Start Date" required="">
          <input type="hidden" class="form-control" id="StartDate_SQLFormat"  name="StartDate_SQLFormat" value="">
        </div>
        <div class="form-group">
          <label for="pwd">End Date:</label>
          <input type="text" class="form-control" id="EndDate" name="EndDate" placeholder="End Date" required="">
          <input type="hidden" class="form-control" id="EndData"  name="EndDate_SQLFormat" value="">
        </div>
		 <div class="form-group">
          <label for="pwd">Source:</label>
          <select id="Source" name="Source" class="form-control" required="">
			<option value="" selected>Select Source</option>
			<option value="LEADSFB">LEADSFB</option>
			<option value="Website">Website</option>
			<option value="Blaster">Blaster</option>
			<option value="BOM001">BOM001</option>
			<option value="DP">DP</option>
			<option value="Ebook">Ebook</option>
			<option value="Web registered">Web registered</option>
			<option value="Web registered 2">Web registered 2</option>
			<option value="Churn">Churn</option>
			
			
		  </select>
        </div> 
        
         <div class="form-group">
          <label for="pwd">Segment:</label>
          <select id="Segment" name="Segment" class="form-control">
			<option value="" selected>Select Segment</option>
			<?php
			    $sel_seg = "select Segment from Assigned_Leads order by Id desc";
			    $qry_segment = mysqli_query($connect,$sel_seg);
			     while($get_segment=mysqli_fetch_assoc($qry_segment)){
			        //print_r($get_segment);
			 
			        $segments[] = $get_segment['Segment'];
			        
			    }
			   // print"<pre>";
			    
                // $filter_seg = array_unique($segments);
			   foreach($segments as $sig_mentss){
			       if($sig_mentss == ''){
			           continue;
			       }
			      $filter_se[] = $sig_mentss;
			   }
			   $filter_se = array_unique($filter_se);
			  //print_r($filter_se); 
			   foreach($filter_se as $sig_ments){
			       echo '<option value="'.$sig_ments.'">'.$sig_ments.'</option>';
			   }
			    
			?>
		
		  </select>
        </div> 
        
        
        
         <div class="form-group" style="margin-top:20px;">
          <label for="pwd">State:</label>
          <select id="State" name="State" class="form-control" >
			<option value="" selected>Select State</option>
			<?php
			    $sel_state = "select State from Assigned_Leads group by State order by Id desc";
			    $qry_state = mysqli_query($connect,$sel_state);
			     while($get_state=mysqli_fetch_assoc($qry_state)){
			        //print_r($get_segment);
			 
			        $State[] = $get_state['State'];
			        
			    }
			   // print"<pre>";
			    
                // $filter_seg = array_unique($segments);
			   foreach($State as $statess){
			       if($statess == ''){
			           continue;
			       }
			      $filter_sstates[] = $statess;
			   }
			   $filter_sstates = array_unique($filter_sstates);
			  //print_r($filter_se); 
			   foreach($filter_sstates as $all_states){
			       echo '<option value="'.$all_states.'">'.$all_states.'</option>';
			   }
			    
			?>
		
		  </select>
        </div> 
        
        <?php
       
         
        ?>
        
		  <table width="100%" class="table table-bordered" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;margin-bottom:15px">
  <tbody>
    <tr>
          <?php
          $sql = "select Disposition from Assigned_Leads where Disposition != '' GROUP BY Disposition";
          $qry = mysqli_query($connect,$sql);
         // var_dump($QRY);
         while( $get_data = mysqli_fetch_assoc($qry)){
             $Disposition[] = $get_data['Disposition'];
         }
         $Disposition = array_unique($Disposition);
         //print_r($Disposition);
          ?>
          <option value="" selected></option>
          <?php
         foreach($Disposition as $dispos){
             if($dispos == ''){
                 continue;
             }
          ?>
          <td class="<?php echo $dispos; ?>"><input type="checkbox" name="disposition[]" value="<?php echo $dispos; ?>" checked> <?php echo $dispos; ?></td>
          <?php
         }
          ?>
      
</tr>
  </tbody>
</table>
 <button type="button" id="counts" class="btn btn-success">Count</button> <span id="show_counts"></span>
<br/>
<br/>

        <button type="submit" class="btn btn-primary">Download</button>
      </form>
    </div>
  </div>
</div>
	<script>
	    $("#counts").click(function(){
	        var StartDate = $("#StartDate").val();
	        var EndDate = $("#EndDate").val();
	        var Source = $("#Source").val();
	        if(StartDate == ''){
	            alert("Statrt Date Must be filled");
	            $("#StartDate").focus();
	            return false;
	        }
	        else if(EndDate == ''){
	            alert("End Date Must be filled");
	            $("#EndDate").focus();
	            return false;
	        }
	        else if(Source == ''){
	            alert("Source Must be filled");
	            $("#Source").focus();
	            return false;
	        }
	        else{
	           var formData = $("form").serialize();
	        //console.log(formData);
	        $.ajax({
	            type:"post",
	            url:"Export-to-Excel/count_post.php",
	            data:formData,
	            success:function(result){
	               // console.log(result);
	               $("#show_counts").html("Total Counts : "+ result);
	            }
	        })  
	        }
	       
	    })
	
	</script>
	
</body>
</html>


