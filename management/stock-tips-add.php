<?php
date_default_timezone_set('Asia/Kolkata');
include('connection/dbconnection_crm.php');

$ModalFowllowUpDateTime = $_POST['ModalFowllowUpDateTime'];
$Segments = $_POST['Segment'];
$Idea = $_POST['Idea'];
$FowllowUpDateTime = $_POST['FowllowUpDateTime'];
?>




<?php 

?>

 <?php
	 $result = mysqli_query($connect, "SELECT Android_Firebase_API_Key FROM Options WHERE Id = '1'");
         $Android_Firebase_API_Key = mysql_result($result, 0);
		//	echo($Android_Firebase_API_Key);
			
	    ?>

<?php
if (count($Segments)){
	foreach($Segments as $Segment){
	$sql ="INSERT INTO `stock_tips` (`Id`, `DateTime`, `Date`, `Sagment`, `Ideas`, `Result`, `TimeStamp`) VALUES (NULL, '".$ModalFowllowUpDateTime."', '".$FowllowUpDateTime."', '".$Segment."', '".$Idea."', 'Open', CURRENT_TIMESTAMP);";
	$added = mysqli_query($connect, $sql) or die('Error updating database');
	//	echo '<br>';
		$sel = "SELECT Mobile_No FROM `Customer_profile` where (DATE(Exp_Date) >= DATE(NOW())) and PackageName = '".$Segment."'";
		$qry = mysqli_query($connect, $sel);
		while($fetch = mysqli_fetch_assoc($qry)){
		    $mobile = $fetch['Mobile_No'];
		     $cl = mysqli_query($connect, "SELECT device_id,device_type FROM `clients` where Mobile = '".$mobile."'");
		      $cl_id = mysqli_fetch_assoc($cl);
		    $device_id = $cl_id['device_id'];
		    $device_type = $cl_id['device_type'];
		    if($device_id != '' || $device_id != NULL){
		        if($device_type == 'iOS'){
		            (send_notification_ios($device_id,$Segment,$Idea,$Android_Firebase_API_Key));
		        }
		        else{
		            push_notification_android($device_id,$Segment,$Idea,$Android_Firebase_API_Key);
		        }
		         
		    }
		}
		
	}
	//if($added){
        $result_update = mysqli_query($connect, "UPDATE employee SET read_notification=0 ");		
	//}
}

echo 'success';



function send_notification_ios($device_id,$title,$message,$api_key){
     $ch = curl_init("https://fcm.googleapis.com/fcm/send");

    //The device token.
    $token = $device_id; //token here

    //Title of the Notification.
   // $title = "Carbon";

    //Body of the Notification.
    //$body = "Bear island knows no king but the king in the north, whose name is stark.";

    //Creating the notification array.
    $notification = array('title' =>$title , 'body' => $message);

    //This array contains, the token and the notification. The 'to' attribute stores the token.
    $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');

    //Generating JSON encoded string form the above array.
    $json = json_encode($arrayToSend);
    //Setup headers:
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key= '.$api_key; // key here

    //Setup curl, add headers and post parameters.
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       

    //Send the request
    $response = curl_exec($ch);

    //Close request
    curl_close($ch);
    return $response;
}


function push_notification_android($device_id,$title,$message,$api_key){

    //API URL of FCM
    $url = 'https://fcm.googleapis.com/fcm/send';

    /*api_key available in:
    Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/   //$api_key = '';
                
    $fields = array (
        'registration_ids' => array (
                $device_id
        ),
        'data' => array
                (
                	'body' 	=> $message,
                	'title'		=>$title,
                	'vibrate'	=> 1,
                	'sound'		=> 1
                )

    );

    //header includes Content type and api key
    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$api_key
    );
                
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}


?>



