asd
<?php echo phpversion(); /*include('includes/allow.php') */ ?>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php"); ?>

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
    $r = mysql_query("SELECT DATABASE()") or die(mysql_error());
    return mysql_result($r,0);
}




$sql = ("SELECT IP_Restriction FROM `Options` where Id ='2'");
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
  $AccessControlId = $row['IP_Restriction'];
}

if($AccessControlId == 'Yes')
 {
	
	if(mysql_current_db() == 'shareevx_StockAdvisor_CRM'){
		echo 'ST&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	
	else if(mysql_current_db() == 'shareevx_SA_CRM'){
		echo 'SA&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	
	else if(mysql_current_db() == 'shareevx_rsicrm'){
		echo 'RSI&nbsp;&nbsp;&nbsp;&nbsp;';
	}
     
    	echo $_SERVER['REMOTE_ADDR'];
        

$result = mysql_query("SELECT IP_Address FROM  `allowUser`");

$IP_Address = Array();

while ( $row = mysql_fetch_assoc($result) ) {

  $IP_Address[] = $row['IP_Address'];

}


if(!in_array($_SERVER['REMOTE_ADDR'],$IP_Address)){

    die('&nbsp;&nbsp;&nbsp;&nbsp;This admin website cannot be accessed from your location.');
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
$result = mysql_query("SELECT * FROM admin WHERE username='".$_POST["username"]."' AND Password = '".$_POST["Password"]."' AND Status = 'Active'");
$row  = mysql_fetch_array($result);
if(is_array($row)) {
$_SESSION["Id"] = $row[Id];
$_SESSION["username"] = $row[username];
$_SESSION["Password"] = $row[Password];	
$_SESSION["Role"] = $row[Role];	
} else {
$message = "Invalid username Number or Password!";
}
}
if(isset($_SESSION["username"])) {
header("Location:memberpage.php");
}

//$_SESSION['name'] = 'Hello World';
var_dump($_SESSION);

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
 $result = mysql_query("SELECT Login_CSS FROM Options WHERE Id = '1'");
 $Login_CSS = mysql_result($result, 0);
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
	 $result = mysql_query("SELECT Login_Logo FROM Options WHERE Id = '1'");
         $Login_Logo = mysql_result($result, 0);
			//echo($Login_Logo);
			
	    ?>
     <img src="images/<?php //echo ($Login_Logo); ?>" alt=""/>
      <p style=" font-size: 17px; margin-top: 10px;">ADMIN</p>
      
    
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
