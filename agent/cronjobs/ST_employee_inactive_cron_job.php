
<?php
include_once($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm_ST.php");

	$up_qry = "update employee set Login_Status = 'InActive'";
	
	mysqli_query($connect,$up_qry);

	
	?>

<?php //die('goodbye cruel world'); ?>

<?php
/*
echo('Hello 2');
$to = "nazirahmed230@gmail.com, somebodyelse@example.com";
$subject = "HTML email";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Employee Status</th>
<th>Time</th>
</tr>
<tr>
<td>InActive</td>
<td>"
	?>
<?php
 date_default_timezone_set('America/New_York');
 $date = date( 'd-m-Y h:i A');
 echo($date);
?>
<?php
"</td>
</tr>
</table>
</body>
</html>"

;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <test@capatus.online>' . "\r\n";
$headers .= 'Cc: userfirst228@gmail.com' . "\r\n";

mail($to,$subject,$message,$headers);
*/
?>







