<?php include_once($_SERVER['DOCUMENT_ROOT']."/partial/session_start.php"); ?>

<?php
echo('<h2>News and updates insert</h2>');

date_default_timezone_set('Asia/Kolkata');
$Author_Name = $_SESSION['username'];
$Date = date('Y-m-d');
$DateTime = date('Y-m-d H:i:s');

$Subject = addslashes( $_REQUEST['Subject']); //Type_of_sale
$Post_content = addslashes( $_REQUEST['Post_content']); //Customer_Name

echo('Author_Name : '.$Author_Name.'<br>');
echo('Date : '.$Date.'<br>');
echo('DateTime : '.$DateTime.'<br>');
echo('Subject : '.$Subject.'<br>');
echo('Post_content : '.$Post_content.'<br>');


echo('Hello world');
$sql = "INSERT INTO `News_and_Updates` (`Author_Name`, `Subject`, `Post_content`, `Date`, `DateTime`) VALUES ('".$Author_Name."', '".$Subject ."', '".$Post_content."', '".$Date."', '".$DateTime."');";

echo($sql);
if(mysqli_query($connect, $sql)){
    echo "Records added successfully.";
   // header("Location: ../news-and-updates-post-list.php");
   echo "<script>window.location.href='/news-and-updates.php'</script>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysql_error($connect);
}





?>