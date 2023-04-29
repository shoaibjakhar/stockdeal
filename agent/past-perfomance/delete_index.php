<?php
include('connection/dbconnection_cms.php');

if($_GET['id']){
	delete('index',$_GET['id']);
}
header('location:index.php');



?>