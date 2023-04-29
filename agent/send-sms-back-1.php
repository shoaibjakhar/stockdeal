
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>


<?php

$Mobile = $_GET['Mobile'];
$Message = $_GET['Message'];
$sender_id = $_GET['sender_id'];

echo($Mobile.'<br><br>');	
echo($Message.'<br><br>');	
echo($sender_id.'<br><br>');	
	
	
echo('<a href="http://api.msg91.com/api/sendhttp.php?sender='.$_GET['sender_id'].'&route=4&mobiles='.$_GET['Mobile'].'&authkey=194772AKvTih0W91K5a6720c8&country=91&message='.$_GET['Message'].'">Send</a>');
	
?>

	
	
	
<script src="js/jquery.min.js"></script>

<script>

jQuery(document).ready(function(){
	

	 jQuery('a').on('click', function() {
        jQuery('a')[0].click();
    });
	
	$("a").trigger("click");
	
	//setTimeout(function(){ $('a').click()}, 100);
	
	
});
	


</script>

<h1>SMS Sent Successfully! You can close this window Now.</h1>

</body>
</html>
