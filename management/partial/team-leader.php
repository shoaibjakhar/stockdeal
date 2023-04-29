<?php  include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");   ?>
<?php

$sql = ("SELECT `username` FROM `employee` WHERE `Status` = 'Active' AND `Role` = 'Team Leader' AND `Team_leader` = '".$username."'   AND username !='Akshay Shetty' AND username !='Sudheer Singh' AND username !='Select'  AND username !='Praveen Chhajlane' ORDER BY  `employee`.`username` ASC 
LIMIT 0 , 200");
 echo('<option value="" selected>Choose</option>');
$result = mysqli_query($connect, $sql);
while($row = mysqli_fetch_array($result))
{
	if(isset($_GET['UserName']))
	{
		if($_GET['UserName'] == $row['username'])
		{
			echo('<option value="'.$row['username'].'" selected >'.$row['username'].'</option>');
		}
		else
		{
			echo('<option value="'.$row['username'].'">'.$row['username'].'</option>');
		}
	}
	else
	{
		echo('<option value="'.$row['username'].'">'.$row['username'].'</option>');
	}
  	
}



?>

                
                
                



















                
              

































































































