<?php
include_once($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm_RSI.php");
//echo ($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm_RSI.php");
$sql = "select * from employee where Status = 'Active' AND (Date_of_Join != '' AND Date_of_Join != '0000-00-00' )";
$qry = mysqli_query($connect,$sql);
$names = array();
while($row = mysqli_fetch_assoc($qry)){
     $joiningDate = new DateTime($row['Date_of_Join']);
     $currentDate = new DateTime(date('Y-m-d'));
     $difference = $joiningDate->diff($currentDate);
     if($difference->days>180){
         $names[] = $row['username'];
          $update ='update employee set Balance_Leave = "'.($row['Balance_Leave']+1).'" where id = "'.$row['Id'].'"';
         mysqli_query($connect, $update);
         
     }
}

if(count($names)>0){
    
    $to = "info@realstockideas.in";
    $subject = "Paid Leaves Cron Job Processed for Real Stock Ideas";
    
    $message = "
    <html>
    <head>
    <title>Paid Leaves Cron Job Processed</title>
    </head>
    <body>
    <p>Names List!</p>
    <table>
    <tr>
    <th>Name</th>
    </tr>";
    foreach($names as $name){
        $message .= "<tr>
    <td>".$name."</td>
    </tr>";
    
    }
    $message .= "
    
    </table>
    </body>
    </html>
    ";
    
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // More headers
    $headers .= 'From: <admin@realstockideas.in>' . "\r\n";
    $headers .= 'Cc: nazirahmed228@gmail.com' . "\r\n";
    
    mail($to,$subject,$message,$headers);
}

echo 'Cronjob Processed, Affected Users - '.count($names); 	
?>