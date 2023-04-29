<?php
include('connection/dbconnection_cms.php');

if($_GET['id']){
	delete('Future_Intraday',$_GET['id']);
}
header('location:future-intraday.php');



?>