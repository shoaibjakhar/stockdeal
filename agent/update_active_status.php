<?php  include('partial/session_start.php'); ?>

<?php





//Send Login_Status is Active to te database.



date_default_timezone_set('Asia/Kolkata');

//echo "Hello";

if($_POST){

// session_start(); //to ensure you are using same session



include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");



	$up_qry = "update Users_Details set Login_Status = 'Active' where Id = '".$User_Id."'";

	





  if(mysqli_query($connect,$up_qry)){

 

    echo "Completed";



  }

  else{

    echo "Still Not Completed";

  }

}







?>