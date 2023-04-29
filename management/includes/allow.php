
 <?php

$connect = mysql_connect('103.50.160.116','shareevx_root','Ahmed@123456');
if(!$connect)
{
die('Could not connect!' . mysql_error);
}
mysql_select_db('shareevx_rsicms', $connect) or die("Unable to select database");
$sql = ("SELECT * FROM `Access_Control` where Id ='2'");
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
  $AccessControlId = $row['Permission'];
}

if($AccessControlId != 'Yes')
 {
  die('This admin website cannot be accessed from your location.'.$_SERVER['REMOTE_ADDR'].'test' );
 }

?>


<?php echo $_SERVER['REMOTE_ADDR']; ?>

<?php

$connect = mysql_connect('103.50.160.116','shareevx_root','Ahmed@123456');

if(!$connect)
{
die('Could not connect!' . mysql_error);
}
mysql_select_db('shareevx_rsicrm', $connect);



$result = mysql_query("SELECT IP_Address FROM  `allowUser`");

$IP_Address = Array();

while ( $row = mysql_fetch_assoc($result) ) {

  $IP_Address[] = $row['IP_Address'];

}


if(!in_array($_SERVER['REMOTE_ADDR'],$IP_Address)){

    die('This admin website cannot be accessed from your location.');
}


?>







