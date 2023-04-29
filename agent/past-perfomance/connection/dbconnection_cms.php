<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);

$domain_name = $_SERVER['HTTP_HOST'];



if(($domain_name == 'crm.realstockideas.in' || $domain_name == 'www.crm.realstockideas.in')){
	
	/**/
	$connect = mysql_connect('103.50.160.116','shareevx_root','Ahmed@123456');
	if(!$connect)
	{
	die('Could not connect!' . mysql_error);
	}
	mysql_select_db('shareevx_rsicms', $connect);
	/**/
	
}

else if($domain_name == 'crm.shareadvisor.in' || $domain_name == 'www.crm.shareadvisor.in' || ($domain_name == 'arif.nazirsayyed.in' || $domain_name == 'www.arif.nazirsayyed.in/')){

	/**/
$connect = mysql_connect('103.50.160.116','shareevx_SA_root','Sayyed@123456');
if(!$connect)
{
die('Could not connect!' . mysql_error);
}
mysql_select_db('shareevx_SA_CRM', $connect);
	/**/
	
}

else if($domain_name == 'crm.stockadvisor.co.in' || $domain_name == 'www.crm.stockadvisor.co.in'){

/**/	
$connect = mysql_connect('103.50.160.116','shareevx_StockdA','Hamzah@123456');
if(!$connect)
{
die('Could not connect!' . mysql_error);
}
mysql_select_db('shareevx_StockAdvisor_CRM', $connect);
/**/	
	
}



function getAll($table,$where = null){
    global $connect;
    $sel = "select * from `".$table."` ".$where;
    $qry = mysqli_query($connet,$sel);
    $data = array();
    while($row = mysqli_fetch_assoc($qry)){
        $data[] = $row;
    }
    return $data;
}

function insert($table,$data){
	global $connect;
	$ins = "insert into `".$table."` (";
	$i = 0;
	foreach ($data as $key => $value) {
		$i++;
		if($i == 1){
			$ins .= $key;
			continue;
		}
		$ins .= ','.$key;
		
	}
	$ins .= ') values(';
	$i = 0;
	foreach ($data as $key => $value) {
		$i++;
		if($i == 1){
			$ins .= "'".$value."'";
			continue;
		}
		$ins .= ',"'.$value.'"';
	}
	$ins .= ')';
	
	mysqli_query($connet,$ins);

	return true;
}


function delete($table,$id){
	global $connect;
	$del = "delete from `".$table."` where id = '".$id."'";
	mysqli_query($connet,$del);
	return true;
}


function update($table,$data,$id){
	global $connect;
	$sel ="update `".$table."` set ";
	$i = 0;
	foreach ($data as $key => $value) {
		$i++;
		if($i == 1){
			$sel .= "$key = '$value'";
			continue;
		}
		$sel .= ", $key = '$value'";
	}
	$sel .= " where id = '$id'";
	mysqli_query($connet,$sel);
	return true;
}



?>

