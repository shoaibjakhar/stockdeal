<?php
error_reporting(-1);
ini_set('display_errors',1);
error_reporting(E_ALL);

$connects = mysqli_connect('119.18.58.248','mahapcti_wp539','[7fq6pS-37','mahapcti_wp539');
if(!$connects)
{
die('Could not connect!' . mysql_error);
}

//mysql_select_db('mahapcti_wp539', $connects);
 //$qry = 'select * from wpvf_mlw_results order by result_id desc LIMIT 0 , 120';
 
 if($_GET['page']){
     $qry = 'select * from wpvf_mlw_results order by result_id desc';
}
else{
    
   $qry = 'select * from wpvf_mlw_results order by result_id desc LIMIT 0 , 180';  
}
 
$qrys = mysqli_query($connects,$qry);


$i = 0;
while($results = mysqli_fetch_assoc($qrys)){
   $cont = $resultss = (string)$results['quiz_results'];
   $ex = explode('s:12:',$cont);
    
     $dates = '';
   if(isset($ex[3])){
        $next = $ex[3];
        $ex = explode('s:3:',$next);
        if(isset($ex[0])){
             $dates = ((int) filter_var($ex[0], FILTER_SANITIZE_NUMBER_INT));
        }
   }

    /*
    if($resultss[0]['value'] == ''){
        //continue;
    }*/
    $datas[$i]['Points'] = $results['point_score'];
     $datas[$i]['Dates'] = $results['time_taken_real'];
    $datas[$i]['Full_Name'] = $results['name'];
    $datas[$i]['Email'] = $results['email'];
    $datas[$i]['Phone'] = $results['phone'];
    
     $datas[$i]['DOB'] = $dates; 
      $datas[$i]['PAN'] = $results['business'];
    
   
   
     
    $i++;
             if($i == 30000)
        {
            break;
        } 

}


//print_r($datas);




