<?php 

/*
$connect = mysql_connect('localhost','root','');

if(!$connect)
{
die('Could not connect' . mysql_error);	
}

mysql_select_db('test',$connect);

*/


$connect = mysql_connect('103.50.160.116','shareevx_root','Ahmed@123456');
if(!$connect)
{
die('Could not connect!' . mysql_error);
}
mysql_select_db('webcreat_partial', $connect);



?>