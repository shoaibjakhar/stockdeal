<?php include_once($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php"); ?>
<?php

$sql = ("SELECT Disposition_Class,disposition FROM `Options` where disposition IS NOT NULL");
 echo('<option value="" selected>Select disposition</option>');
$result = mysqli_query($connect,$sql);
while($row = mysqli_fetch_array($result))
{
  echo('<option data-class="'.$row['Disposition_Class'].'" value="'.$row['disposition'].'">'.$row['disposition'].'</option>');
}

?>

         
















                
              

































































































