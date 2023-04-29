<?php include('connection/dbconnection_crm.php')?>
<?php
set_time_limit(0);


//print_r($connect);

// add 3 days to date
//echo $NewDate=Date('Y-m-d', strtotime('-14 days').'<br><br>');
// echo('<br><br>');
 $FromDate = Date('Y-m-d', strtotime('-14 days'));
// echo('<br><br>');
 $ToDate = Date('Y-m-d');
// echo('<br><br>');
//Userfirst Connection
//print"<pre>";
// $con = mysqli_connect(DB_HOST, DB_USERNAME,DB_PASS,DB_NAME);


//Duplicate deletion
    $MobileData = array();
    // $sel ="SELECT *,count(Mobile) as cn FROM `Assigned_Leads` WHERE DATE(Date)>(NOW() - INTERVAL 7 DAY ) GROUP BY Mobile ORDER BY cn desc";
     $sel ="SELECT *,count(Mobile) as cn FROM `Assigned_Leads` WHERE DATE(TimeStamp)>='".$FromDate."' AND DATE(TimeStamp)<='".$ToDate."' GROUP BY Mobile ORDER BY cn desc";

    $qry = mysqli_query($connect,$sel);
    $i = 0;
    while($fetch = mysqli_fetch_assoc($qry)){
        if($fetch['cn']>1){
            $i++;
            $MobileData[] = $fetch['Mobile'];
           $sels = "SELECT * FROM Assigned_Leads WHERE Mobile = '".$fetch['Mobile']."' AND DATE(TimeStamp)>='".$FromDate."' AND DATE(TimeStamp)<='".$ToDate."'";
           $qrys = mysqli_query($connect,$sels);
           $j = 0;
           while($rows = mysqli_fetch_assoc($qrys)){
               $j++;
               if($j == 1){
                   continue;
               }
                $del = "delete from Assigned_Leads where Id = '".$rows['Id']."'";
                mysqli_query($connect,$del); 
           }
        }
        
        if($i==1){
           // break;
        }
    }

?>
