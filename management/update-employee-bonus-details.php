<?php
ob_start(); 
$id                     = isset($_POST['id']) ? $_POST['id'] : '';
$amount        = isset($_POST['amount']) ? $_POST['amount'] : '';
$valid_date             = isset($_POST['valid_date']) ? $_POST['valid_date'] : '';
$Role                   = isset($_POST['Role']) ? $_POST['Role'] : '';


?>


<?php include('connection/dbconnection_crm.php')?>



<?php
    session_start();
	$sql = "UPDATE bonus SET `amount`='".$amount."',`valid_date`='".$valid_date."' where `id`='".$id."'";

    mysqli_query($connect, $sql) or die('Error updating database');

    if($Role == "Agent")
    {
        $_SESSION['success'] = 'Record updated successfully!';
        
    	header('Location:agent-bonus-details.php');
    }
    else
    {
    	header('Location: team-lead-advance-payment-details.php');
    }


?>
