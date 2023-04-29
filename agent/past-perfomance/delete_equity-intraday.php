<?php
include('connection/dbconnection_cms.php');

if($_GET['id']){
	delete('Equity_Intraday',$_GET['id']);
}
header('location:equity-intraday.php');



?>