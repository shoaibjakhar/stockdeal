<?php include('../connection/dbconnection_crm.php')?>

<?php

// Real Stock Ideas
if($domain_name == 'crm.rsi-hg-ind.online' || $domain_name == 'www.crm.rsi-hg-ind.online'){
  $connects_wp = mysqli_connect('119.18.58.248','mahapcti_wp539','[7fq6pS-37','mahapcti_wp539');
}

 
// Share Advisor
else if($domain_name == 'crm.share-advisor.in.net' || $domain_name == 'www.crm.share-advisor.in.net'){
       $connects_wp = mysqli_connect('119.18.58.248','bigsenrl_wp721','S0]7jp5(3b','bigsenrl_wp721');
 }

// Stock Advisor
else if($domain_name == 'crm.water-or-air.online' || $domain_name == 'www.crm.water-or-air.online'){
     $connects_wp = mysqli_connect('119.18.58.248','childshk_wp397','3P-S1p74[C','childshk_wp397');
 }
 
// Share Market Ideas
 else if($domain_name == 'smi-crm.uxart.online' || $domain_name == 'www.smi-crm.uxart.online'){
     $connects_wp = mysqli_connect('localhost','uxartmun_wp134','p9I9z.76]S','uxartmun_wp134');
 }




if($_POST){
    $mobile = $_POST['mobile'];
    $sel = "select * from Customer_profile where Mobile_No = '".$mobile."'";
    $qry = mysqli_query($connect,$sel);
    $fetch = mysqli_fetch_assoc($qry);
    
    if($fetch){
        $fetch['status'] = 'success';
    }
    else {
        
		// Real Stock Ideas
        if($domain_name == 'crm.rsi-hg-ind.online' || $domain_name == 'www.crm.rsi-hg-ind.online'){
            $sel = "select * from wpvf_mlw_results where phone = '".$mobile."' limit 1";
        }
        
		// Share Advisor
        else if($domain_name == 'crm.share-advisor.in.net' || $domain_name == 'www.crm.share-advisor.in.net'){
            $sel = "select * from wpbr_mlw_results where phone = '".$mobile."' limit 1";
        }
        
		// Stock Advisor
        else if($domain_name == 'crm.water-or-air.online' || $domain_name == 'www.crm.water-or-air.online'){
            $sel = "select * from wpx5_mlw_results where phone = '".$mobile."' limit 1";
        }
        
		// Share Market Ideas
        else if($domain_name == 'smi-crm.uxart.online' || $domain_name == 'www.smi-crm.uxart.online'){
            $sel = "select * from wpw9_mlw_results where phone = '".$mobile."' limit 1";
        }
        
        
        
        $qry = mysqli_query($connects_wp,$sel);
        $fetchs = mysqli_fetch_assoc($qry);
        if($fetchs){
           $dob_pan = explode(",",$fetchs['business']);
           $pan = '';
           $dob = '';
           if($dob_pan[0]){
               $pan = $dob_pan[0];
           }
            if($dob_pan[1]){
               $dob = date('Y-m-d',strtotime($dob_pan[1]));
           }
       
            $fetch = array(
                    'Full_Name'=>$fetchs['name'],
                    'Pan_Number'=>$pan,
                    'Email_ID'=>$fetchs['email'],
                    'Date_of_Birth'=>$dob,
                    'Risk_Score'=>$fetchs['point_score'],
                    'Risk_Level'=>'',
                    'KYC'=>''
                );
                
            $fetch['status'] = 'success';
        }
        else{
            $fetch['status'] = 'failed'; 
        }
    }
     print json_encode($fetch);
    
}


?>