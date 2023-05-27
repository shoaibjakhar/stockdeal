<?php

 include($_SERVER['DOCUMENT_ROOT']."/stockdeal/agent/connection/dbconnection_crm.php"); 
?>


<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Raleway:400,900,800,700' rel='stylesheet' type='text/css'>
<link href="css/style.css?v=1.1" rel="stylesheet" />
<?php
 $result = mysqli_query($connect,"SELECT Theme_CSS FROM Options WHERE Id = '1'");
 $Theme_CSS = mysqli_result($result, 0);
 //echo($Theme_CSS);
?>
<link href="css/<?php echo($Theme_CSS); ?>?v=1.1" rel="stylesheet" />
<link href="css/tabbar.css?v=1.1" rel="stylesheet" />
<link href="css/preloader.css" rel="stylesheet" />
<link href="css/non-responsive.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


<script type="text/javascript"  src="js/jquery.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"  src="js/bootstrap.min.js"></script> 
<script type="text/javascript"  src="js/custom.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript"  src="js/jquery.preloader.min.js"></script> 


