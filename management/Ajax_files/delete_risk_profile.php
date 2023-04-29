<?php
//echo "hi"; exit;
include('../connection/database_connection_wordpress.php');

if($_POST){


// Real Stock Ideas
if($domain_name == 'admin.rsi-hg-ind.online' || $domain_name == 'www.admin.rsi-hg-ind.online'){
  $upd = "Delete From wpvf_mlw_results where result_id = '".$_POST['id']."'";  
}



	

	


mysqli_query($connects,$upd);
}
echo 'success';

exit;

?>




