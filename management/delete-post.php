<?php include_once($_SERVER['DOCUMENT_ROOT']."/partial/session_start.php"); ?>

<?php

$post_id = $_GET['post_id'];
$del_qry = "DELETE FROM News_and_Updates WHERE Id = '{$post_id}'";
mysqli_query($connect, $del_qry);
header('location: news-and-updates.php')



?>