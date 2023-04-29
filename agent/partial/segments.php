<?php include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php"); ?>
<?php

$sql = ("SELECT Segment, Segment_Status FROM `Options` WHERE Segment IS NOT NULL and Segment_Status= 'Active' ");
 //echo('<option value="" selected>Segments</option>');
$result = mysqli_query($connect,$sql);
while($row = mysql_fetch_array($result))
{
    if(isset($ids) && isset($PackageName)){
        if($row['Segment'] == $PackageName){
              echo('<option value="'.$row['Segment'].'" selected>'.$row['Segment'].'</option>');
              continue;
        }
    }
  echo('<option value="'.$row['Segment'].'">'.$row['Segment'].'</option>');
}

?>

         
















                
              

































































































