<?php 
//session_start();
//echo phpversion(); /*include('includes/allow.php') */ ?>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/crm/management/connection/dbconnection_crm.php"); 
  $connect = mysqli_connect('localhost','stockdeal_ra','0YZm0!$F@','stockdeal_ra');
  if(!$connect)
  {
      die('Could not connect!' . mysqli_error);
  }
  // $result ="SELECT * FROM admin WHERE username='".$_POST["username"]."' AND Password = '".$_POST["Password"]."' AND Status = 'Active'";
  // $get_qry_login = mysqli_query($connect,$result);
  // $at_row  = mysqli_fetch_array($get_qry_login);
  // print_r($at_row);
  // die();

?>
<?php


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

  // ahsan
    // $r = mysqli_query($connect,"SELECT DATABASE()") or die(mysql_error());
    // return mysql_result($r,0);
}




$sql = ("SELECT IP_Restriction FROM `Options` where Id ='2'");
$result = mysqli_query($connect,$sql);
//var_dump($result);


while($row = $result->fetch_array())
{
  $AccessControlId = $row['IP_Restriction'];
}


//if admin param is master then no ip restriction

if(isset($_GET["username"]) && $_GET["username"] == "master"){
    $AccessControlId = "No";
}





if($AccessControlId == "Yes")
 {
	
	if(mysql_current_db() == 'shareevx_StockAdvisor_CRM'){
	//	echo 'ST&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	
	else if(mysql_current_db() == 'shareevx_SA_CRM'){
	//	echo 'SA&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	
	else if(mysql_current_db() == 'shareevx_rsicrm'){
	//	echo 'RSI&nbsp;&nbsp;&nbsp;&nbsp;';
	}
     
    //	echo $_SERVER['REMOTE_ADDR'];
        

$result = mysqli_query($connect,"SELECT IP_Address FROM  `allowUser`");

$IP_Address = Array();

while ( $row = $result->fetch_assoc() ) {

  $IP_Address[] = $row['IP_Address'];

}

// print_r($IP_Address);
if(!in_array($_SERVER['REMOTE_ADDR'],$IP_Address)){

    die('&nbsp;&nbsp;&nbsp;&nbsp;'.$_SERVER['REMOTE_ADDR'].' This admin website cannot be accessed from your location.');
}
  	
//	header('Location: index-2.php');
 }
?>
<?php
//session_start();
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

$message="";
if(count($_POST)>0) {
//$conn = mysql_connect("103.50.160.116","shareevx_root","Ahmed@123456");
//mysql_select_db("shareevx_rsicrm",$conn);
// $result = mysqli_query($connect,"SELECT * FROM admin WHERE username='".$_POST["username"]."' AND Password = '".$_POST["Password"]."' AND Status = 'Active'");

   $mysqli = new mysqli("localhost","stockdeal_ra","0YZm0!$F@","stockdeal_ra");
  // $mysqli = new mysqli("localhost","shareidea_ra","2T1zlj_14*KT","shareidea_ra");

   $result ="SELECT * FROM admin WHERE username='".$_POST["username"]."' AND Password = '".$_POST["Password"]."' AND Status = 'Active' AND Role != 'Agent'";
  $get_qry_login = mysqli_query($connect,$result);
  $row  = mysqli_fetch_array($get_qry_login);
  
  // $row  = mysqli_fetch_assoc($result); 

  if(is_array($row))
  {
      // echo "yes";
  }
  else 
  {

    // $result = $mysqli -> query("SELECT * FROM employee WHERE username='".$_POST["username"]."' AND Password = '".$_POST["Password"]."' AND Status = 'Active'");

    $result ="SELECT * FROM employee WHERE username='".$_POST["username"]."' AND Password = '".$_POST["Password"]."' AND Status = 'Active'";
    $get_qry_login = mysqli_query($connect,$result);
   
    $row  = mysqli_fetch_assoc($get_qry_login); 
 
    $up_qry = "update employee set Login_Status = 'Active' where Id = '".$row['Id']."'";
  
      mysqli_query($connect,$up_qry);
  }

  // print_r($row);
  // die();



// print_r($result);exit;
// $row  = mysql_fetch_array($result);
  if(is_array($row)) {
  $_SESSION["Id"] = $row['Id'];
  $_SESSION["username"] = $row['username'];
  $_SESSION["Password"] = $row['Password'];	
  $_SESSION["Role"] = $row['Role'];	
  } else 
  {
     $message = "Invalid username Number or Password!";
  }
}
if(isset($_SESSION["username"])) {
//header("Location:memberpage.php");

  $t = date('m/d/Y h:i:s A',time());

  $qry_login = "SELECT * FROM attendence WHERE user_id = '".$row['Id']."' and date = '".date('d-m-Y')."'";
  $get_qry_login = mysqli_query($connect,$qry_login);
  $at_row  = mysqli_fetch_array($get_qry_login);


    
  if(!is_array($at_row)){
        if($_SESSION["Role"] == "Team Leader")
        {

          $ins_Atd = "INSERT INTO attendence (Agent_Name,user_id,login_time,date,Machine_Name,IP_Address) VALUES('".$row['username']."','".$row['Id']."','$t','".date('d-m-Y')."','','".get_client_ip()."')";
        
        $ins_at_qry = mysqli_query($connect, $ins_Atd);
        $_SESSION['spent_time'] = $t;
      }
        
    }
    else
    {
        if($_SESSION["Role"] == "Team Leader")
        {

         $up_qry = "update attendence set Login_Status = 'Active' where user_id = '".$row['Id']."' AND date='".date('d-m-Y')."'";
         mysqli_query($connect,$up_qry);

        $_SESSION['spent_time'] = $t;
      }
        
    
    }
    
echo '<script>window.location.href="memberpage.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ADMIN | </title>
<meta NAME="description" CONTENT="">
<meta NAME="keywords" CONTENT="">
<link href="css/bootstrap.min.css" rel="stylesheet">
<?php
 $result = mysqli_query($connect, "SELECT Login_CSS FROM Options WHERE Id = '1'");
 $Login_CSS = mysqli_result($result, 0);
 //echo($Login_CSS);
?>
<link href="css/<?php echo($Login_CSS); ?>" rel="stylesheet">
<!--    <link rel="stylesheet" href="css/normalize.css"> --><!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --><!-- WARNING: Respond.js doesn't work if you view the page via file:// --><!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>


	
</style>
	<script>	
	if (location.protocol !== 'https:') {
    location.replace(`https:${location.href.substring(location.protocol.length)}`);
}
</script>
	
</head>

<body>
<form name="frmusername" method="post" action="">

<div class="container-fluid">
  <div class="row">
  <div class="login-wrap-main">
   <!-- <img src="images/girl-callcenter.png" alt="" style="width: 100%; height: auto;" class="hidden-xs hidden-sm"> -->
    <div class="login-wrap white_bg text-center" style="padding:20px 0 0 0;">
		  <?php
	 $result = mysqli_query($connect, "SELECT Login_Logo FROM Options WHERE Id = '1'");
         $Login_Logo = mysqli_result($result, 0);
			//echo($Login_Logo);
			
	    ?>
     <img src="images/<?php echo ($Login_Logo); ?>" height="100px" width="280px" alt=""/>
      <p style=" font-size: 17px; margin-top: 10px;">ADMIN</p>
      
    
      <section id="Tab1Inner">
      <div class="col-sm-12"  style="">
       <div class="message"><?php if($message!="") { echo $message; } ?></div>
        
        <!-- -->
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" class="form-control" name="username" value="" placeholder="Username" style="margin-bottom: 20px;">
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
