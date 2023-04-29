<?php  session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', -1);
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
define('EXPIRY',time()+3*60*60);
include($_SERVER['DOCUMENT_ROOT']."/crm/agent/cookie.class.php");



/* include('includes/allow.php'); */


?>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/crm/agent/connection/dbconnection_crm.php"); ?>

<?php


/*
function UniqueMachineID($salt = "") {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $temp = sys_get_temp_dir().DIRECTORY_SEPARATOR."diskpartscript.txt";
        if(!file_exists($temp) && !is_file($temp)) file_put_contents($temp, "select disk 0\ndetail disk");
        $output = shell_exec("diskpart /s ".$temp);
        $lines = explode("\n",$output);
        $result = array_filter($lines,function($line) {
            return stripos($line,"ID:")!==false;
        });
        if(count($result)>0) {
            $result = array_shift(array_values($result));
            $result = explode(":",$result);
            $result = trim(end($result));       
        } else $result = $output;       
    } else {
        $result = shell_exec("blkid -o value -s UUID");  
        if(stripos($result,"blkid")!==false) {
            $result = $_SERVER['HTTP_HOST'];
        }
    }   
    return md5($salt.md5($result));
}
*/


 
// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function mysql_current_db() {
    global $connect;
    $r = mysqli_query($connect,"SELECT DATABASE()") or die(mysql_error());
    return mysqli_result($r,0);
}


$sql = ("SELECT IP_Restriction FROM `Options` where Id ='1'");
$result = mysqli_query($connect,$sql);
while($row = mysqli_fetch_array($result))
{
  $AccessControlId = $row['IP_Restriction'];
}

if($AccessControlId == 'Yes')
 {
   //  echo substr(mysql_current_db(), -4).'&nbsp;&nbsp;&nbsp;&nbsp;';
    // 	echo $_SERVER['REMOTE_ADDR'];
        

$result = mysqli_query($connect,"SELECT IP_Address FROM  `allowUser`");

$IP_Address = Array();

while ( $row = mysqli_fetch_assoc($result) ) {

  $IP_Address[] = $row['IP_Address'];

}


if(!in_array($_SERVER['REMOTE_ADDR'],$IP_Address)){
    echo $_SERVER['REMOTE_ADDR'];
    die(' This admin website cannot be accessed from your location.');
}
  	
//	header('Location: index-2.php');
 }




?>




<?php

date_default_timezone_set('Asia/Kolkata');




$message="";
if(count($_POST)>0) {

$result = mysqli_query($connect,"SELECT * FROM employee WHERE Role='Agent' AND username='".$_POST["username"]."' AND Password = '".$_POST["Password"]."' AND Status = 'Active'");
$row  = mysqli_fetch_array($result);
//print_r($row);
if(is_array($row)) {
    
   $up_qry = "update employee set Login_Status = 'Active' where Id = '".$row['Id']."'";
	
	mysqli_query($connect,$up_qry);

// add session id
  session_regenerate_id();
  $user_session_id = session_id();
  $update_session_id_qry = "Update employee set user_session_id = '". $user_session_id ."' Where id = '". $row['Id'] ."'";
  mysqli_query($connect, $update_session_id_qry);
  $_SESSION['user_session_id'] = $user_session_id;
  $_SESSION['user_session_time'] = time();

$t = date('m/d/Y h:i:s A',time());

	$qry_login = "SELECT * FROM attendence WHERE user_id = '".$row['Id']."' and date = '".date('d-m-Y')."'";
	$get_qry_login = mysqli_query($connect,$qry_login);
	$at_row  = mysqli_fetch_array($get_qry_login);
	
	if(!is_array($at_row)){
		$ins_Atd = "INSERT INTO attendence (Agent_Name,user_id,login_time,date,Machine_Name,IP_Address) VALUES('".$row['username']."','".$row['Id']."','$t','".date('d-m-Y')."','','".get_client_ip()."')";
		//
		$ins_at_qry = mysqli_query($connect, $ins_Atd);
		$_SESSION['spent_time'] = $t;
				
			}
			else{
			$_SESSION['spent_time'] = $t;
			}

	
$_SESSION["Id"] = $row[Id];
$_SESSION["Role"] = $row[Role];
$_SESSION["username"] = $row[username];
$_SESSION["Password"] = $row[Password];	
$_SESSION["Mobile"] = $row[Mobile];	
//print_r($_SESSION); exit;
 //echo "hi";// exit; 
 if($row['Role'] == 'Customer Care'){
     echo '<script>window.location.href="dashboard.php"</script>';
 }
 else{
 ?>
 <script>
     location.href = "memberpage.php"
 </script>
    
    <?php
 }
    ?>
    <!--header("Location: memberpage.php");-->


<?php exit; } else {
$message = "Invalid username Number or Password!";
}
}

 $username = isset($_SESSION['username']); //App_Cookie::getInstance()->getCookie("username");


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Customer Relationship Management</title>
<meta NAME="description" CONTENT="">
<meta NAME="keywords" CONTENT="">
<link href="css/bootstrap.min.css" rel="stylesheet">
<?php
 $result = mysqli_query($connect,"SELECT Login_CSS FROM Options WHERE Id = '1'");
 $Login_CSS = mysqli_result($result, 0);
 //echo($Login_CSS);
//print_r($Login_CSS);
?>
<link href="css/<?php echo($Login_CSS); ?>" rel="stylesheet">


<!--    <link rel="stylesheet" href="css/normalize.css"> --><!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --><!-- WARNING: Respond.js doesn't work if you view the page via file:// --><!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>


	
</style>
</head>

<body>
	
		<div class="brand-logo">
	    <?php
	 $result = mysqli_query($connect,"SELECT Login_Logo FROM Options WHERE Id = '1'");
         $Login_Logo = mysqli_result($result, 0);
			//echo($Login_Logo);
			
	    ?>
  

</div>	
	
<form name="frmusername" method="post" action="">

<div class="container-fluid">
  <div class="row">
  <div class="login-wrap-main">
   <img src="images/girl-callcenter.png" alt="" style="width: 100%; height: auto;" class="hidden-xs hidden-sm">
    <div class="login-wrap white_bg text-center" style="padding:20px 0 0 0;">
    <img src="images/<?php echo ($Login_Logo); ?>" alt=""> 
      <p style=" font-size: 17px; margin-top: 10px;">Customer Relationship Management</p>
      
    
      <section id="Tab1Inner">
      <div class="col-sm-12"  style="">
       <div class="message"><?php if($message!="") { echo $message; } ?></div>
        
        <!-- -->
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" class="form-control" name="username" value="" placeholder="username" style="margin-bottom: 20px;">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <input type="password" class="form-control"  name="Password" value="" placeholder="Password" style="margin-bottom: 10px;">
            </div>
          </div>
           <div class="clearfix"></div>
          <div class="form-group" style="margin-top:10px;margin-bottom:30px;">
            <div class="col-sm-12" style="float:left">
           <input type="submit" class="btn btn-primary btn_1 btn-block btn-lg label_16" name="submit" value="Login">
             </div>
          <div class="clearfix"></div>
          </div>
        </form>
        <!-- --> 
      </div>
      </section>
    <div class="clearfix"></div>
    </div>
  </div>
  </div>
 
</div>
<div  class="crm-version" style="border:red solid 0px; position: absolute; right: 0; bottom: 0;">Version 2.4</div>
<script type="text/javascript"  src="js/jquery.min.js"></script> 
<script type="text/javascript"  src="js/bootstrap.min.js"></script> 
<script>
$(document).ready(function(e) {
    
	$('#Tab1').click(function() {
     	$('#Tab1 ,#Tab2').removeClass('tab_1Active')
		$(this).addClass('tab_1Active')
		//alert('111asdf')	
		$('#Tab2Inner').hide()
		$('#Tab1Inner').show()
	});
	
	$('#Tab2').click(function() {
     	$('#Tab1 ,#Tab2').removeClass('tab_1Active')
		$('#Tab1 ,#Tab2').addClass('tab_1')
		$(this).addClass('tab_1Active')
		$('#Tab1Inner').hide()
		$('#Tab2Inner').show()
	});
	
	
});

</script>
</body>
</html>
<?php
ob_end_flush();

?>
