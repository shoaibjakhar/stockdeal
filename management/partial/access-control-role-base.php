
<?php
if (isset($_SESSION['Role'])) {

    if($_SESSION['Role'] == 'Super Admin') {
		//echo 'Super Admin';
    } else  {
         echo '<a href="memberpage.php">Back to Dashboard</a><br>';
		 die('This admin content cannot be accessed for your role.');
    }
}

?>	