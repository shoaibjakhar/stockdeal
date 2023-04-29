<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SA Update Whatsapp Number</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
	
	<?php 



$connect = mysqli_connect('116.206.105.14','uxartmun_wp134','p9I9z.76]S','uxartmun_wp134');
if(!$connect)
{
die('Could not connect!' . mysqli_error);
}

//mysql_select_db('shareevx_wp510', $connect);

 $sql = "SELECT * FROM `wpw9_options` WHERE  option_id = '11343'";

$qry = mysqli_query($connect,$sql);
$getData = mysqli_fetch_row($qry);
$ID = $getData['0'];
$content  = $getData['2'];
$phone_data = unserialize($content);
//print"<pre>";
//print_r($phone_data);
//echo "<br>";
/*
$explode = explode('s:12:"',$content);
$nd_ex  = $explode['1'];
$ndexplode = explode('";s:7:',$nd_ex);

$number = $ndexplode['0'];
$f_explode = explode('+91',$number);

$final_number =  $f_explode['1'];
*/


if($_POST){
    $en_number = $_POST['en_number'];
    $phone_data['button']['phone'] = $en_number;
   // print_r($phone_data);
    //$new_content = str_replace($number,$en_number,$content);
   $new_content = serialize($phone_data);
   $upd_qry = "UPDATE `wpw9_options` SET `option_value` = '".$new_content."' WHERE  option_id = '11343' ";
   mysqli_query($connect,$upd_qry);
  //header('location:');
  echo '<script>window.location.href="smi-update-whatsapp-number.php?t='.time().'&updated=true"</script>';
    
}
	/*
if(isset($_GET['edit'])){
    echo "Mobile number Updated";
}
*/

?>

<body>
	
	<div class="container">
	 <div class="row">
		  <?php
	        if(isset($_GET['updated']) && $_GET['updated'] != ''){
	            echo '<div class="alert alert-success" role="alert">WhatsApp Number Updated Successfully</div>';
	        }
	    
	    ?>
		
		<div class="col-sm-3">
		 <img src="https://www.shareadvisor.in/SA-Assets/whatsapp.png" style="width:60px;"/>
	   
	<form method="post" action="">
	    <p style="color:red;font-size:24px;display:none;" id="results_data">Please add "91" before 10 digit mobile number</p>
	Mobile: <input type="text" name="en_number" id="Mobile_Numbers" class="form-control" value="<?php echo $phone_data['button']['phone'];  ?>" autocomplete="off"><br/>
	
	<input type="submit" value="Update Mobile Number" class="btn btn-primary" id="Submit_Btn">
		   
	</form>
<script>
    $(document).ready(()=>{
        $("#results_data").hide();
        $("#Submit_Btn").click(()=>{
            var mobile = $("#Mobile_Numbers").val();
            if(mobile.length<12){
                $("#results_data").show();
                return false;
            }
        })
    })
</script>	
		
		 </div>
		</div>
	</div>
	
</body>
</html>
