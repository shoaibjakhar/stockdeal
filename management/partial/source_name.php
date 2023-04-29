<?php include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php"); ?>

<?php

$sql = ("SELECT Source FROM `Options` WHERE Source IS NOT NULL");
 echo('<option value="" selected>Select</option>');
$result = mysqli_query($connect, $sql);
while($row = mysqli_fetch_array($result))
{

if(isset($_GET['source']))
	{
		if($_GET['source'] == $row['Source'])
		{
			 echo('<option value="'.$row['Source'].'" selected>'.$row['Source'].'</option>');
		}
		else
		{
			 echo('<option value="'.$row['Source'].'">'.$row['Source'].'</option>');
		}
	}
	else
	{
		 echo('<option value="'.$row['Source'].'">'.$row['Source'].'</option>');
	}

 
}



?>

                
                
                



















                
              

































































































