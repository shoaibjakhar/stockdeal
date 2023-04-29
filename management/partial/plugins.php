<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Raleway:400,900,800,700' rel='stylesheet' type='text/css'>

<link href="css/tabbar.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />

	 <?php include($_SERVER['DOCUMENT_ROOT']."/crm/management/connection/dbconnection_crm.php"); ?>
<?php
 $result = mysqli_query($connect, "SELECT Theme_CSS FROM Options WHERE Id = '1'");
 $Theme_CSS = mysqli_result($result, 0);
 //echo($Theme_CSS);
?>
<link href="css/<?php echo($Theme_CSS); ?>" rel="stylesheet" />

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

	<script>	
	if (location.protocol !== 'https:') {
    location.replace(`https:${location.href.substring(location.protocol.length)}`);
}
</script>
<!-- <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript"  src="js/bootstrap.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.1/js/dataTables.fixedColumns.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript"  src="js/custom.js"></script> 
<script type="text/javascript"  src="js/jquery.preloader.min.js"></script> 





