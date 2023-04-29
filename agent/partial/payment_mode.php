<?php include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php"); ?>
<?php

$sql = ("SELECT payment_mode FROM `Options` WHERE payment_mode IS NOT NULL");
 echo('<option value="" >Payment Mode</option>');
$result = mysqli_query($connect,$sql);
while($row = mysqli_fetch_array($result))
{
    if(isset($ids) && isset($PaymentMode)){
        if($row['payment_mode'] == $PaymentMode){
            echo('<option value="'.$row['payment_mode'].'" selected>'.$row['payment_mode'].'</option>');
            continue;
        }
    }
  echo('<option value="'.$row['payment_mode'].'">'.$row['payment_mode'].'</option>');
}

?>

         
















                
              

































































































