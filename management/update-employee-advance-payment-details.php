<?php
ob_start();
$id                     = isset($_POST['id']) ? $_POST['id'] : '';
$advance_payment        = isset($_POST['advance_payment']) ? $_POST['advance_payment'] : '';
$return_in_installment  = isset($_POST['return_in_installment']) ? $_POST['return_in_installment'] : '';
$return_payment_date  = isset($_POST['return_payment_date']) ? $_POST['return_payment_date'] : '';
$Role  = isset($_POST['Role']) ? $_POST['Role'] : '';

?>


<?php include('connection/dbconnection_crm.php')?>



<?php

	$sql = "UPDATE Advance_salary SET `advance_payment`='".$advance_payment."',`return_in_installment`='".$return_in_installment."',
	`return_payment_date`='".$return_payment_date."'  where `id`='".$id."'";

    mysqli_query($connect, $sql) or die('Error updating database');

    if($Role == "Agent")
    {
    	header('Location: agent-advance-payment-details.php');
    }
    else
    {
    	header('Location: team-lead-advance-payment-details.php');
    }


?>
