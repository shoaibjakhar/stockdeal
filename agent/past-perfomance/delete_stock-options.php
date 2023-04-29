<?php
include('connection/dbconnection_cms.php');

if($_GET['id']){
	delete('Options',$_GET['id']);
}
header('location:stock-options.php');



?>