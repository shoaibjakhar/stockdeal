<?php include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php"); ?>

<?php

$sql = ("SELECT disposition FROM `Options` WHERE disposition IS NOT NULL");
 echo('<option value="" selected>Select</option>');
$result = mysqli_query($connect, $sql);
while($row = mysqli_fetch_array($result))
{
  echo('<option value="'.$row['disposition'].'">'.$row['disposition'].'</option>');
}



?>

                
                
                



















                
              

































































































