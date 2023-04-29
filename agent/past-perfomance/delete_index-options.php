<?php
include('connection/dbconnection_cms.php');

if($_GET['id']){
	delete('Future_HNI',$_GET['id']);
}
header('location:index-options.php');



?>