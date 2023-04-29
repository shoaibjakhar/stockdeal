<?php


include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");
if($_POST){

    $sel = "select * from employee where Id = '".$_POST['user_id']."'" ; 
    $qry = mysqli_query($connect, $sel);
    $fetch  = mysqli_fetch_assoc($qry);
    $Paid_Leaves_Log = (array)json_decode($fetch['Paid_Leaves_Log']);

    if($_POST['content'] == 'add_leave'){
        $Balance_Leave = $fetch['Balance_Leave']-1;
        if(empty($Paid_Leaves_Log)){
            
           $Paid_Leaves_Log[1]['date'] = $_POST['date'];
        } 
        else{
            $c = count($Paid_Leaves_Log)+1;
            $datas['date'] = $_POST['date'];
            $Paid_Leaves_Log[$c]['date'] = $_POST['date'];
        }
        
        $Leavea_Log = json_encode($Paid_Leaves_Log);
        $upd = "update employee set Balance_Leave = '$Balance_Leave',Paid_Leaves_Log = '$Leavea_Log' where Id = '".$_POST['user_id']."'";
        
    }
    else{
        $Balance_Leave = $fetch['Balance_Leave']+1;
        $i = 0;
        foreach($Paid_Leaves_Log as $key => $log){
          $i++;
         $logs = $log->date;
         //echo $_POST['date'];
           if($logs == $_POST['date']){
               continue;
           }
          $lo[$i]['date'] = $logs;
          
        }
        

        $j = 0;
        echo count($lo);
        foreach($lo as $log){
            $j++;
             $total_lg[$j]['date'] = $log['date'];
            //echo $log['date'];
            
        }
        
        $leave = json_encode($total_lg);
         $upd = "update employee set Balance_Leave = '$Balance_Leave',Paid_Leaves_Log = '$leave' where Id = '".$_POST['user_id']."'";
        
    }
    mysqli_query($connect, $upd);
    echo 'success';
    
}