<?php 
error_reporting(-1);
ini_set('display_errors',1);
$domain_name = $_SERVER['HTTP_HOST'];


// Real Stock Ideas
if($domain_name == 'crm.rsi-hg-ind.online' || $domain_name == 'www.crm.rsi-hg-ind.online')  {
 include('RSI_Wordpress_Connection.php');
}

// Share Advisor
else if($domain_name == 'crm.share-advisor.in.net' || $domain_name == 'www.crm.share-advisor.in.net'){
 include('SA_Wordpress_Connection.php');
}

// Stock Advisor
else if($domain_name == 'crm.water-or-air.online' || $domain_name == 'www.crm.water-or-air.online'){
 include('ST_Wordpress_Connection.php');
}

// Share Market Ideas
else if($domain_name == 'smi-crm.uxart.online' || $domain_name == 'www.smi-crm.uxart.online'){
 include('SMI_Wordpress_Connection.php');
}



?>

