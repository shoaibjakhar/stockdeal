<?php
    ob_start();
    $employee_id           = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';
    $advance_payment       = isset($_POST['advance_payment']) ? $_POST['advance_payment'] : '';
    $return_in_installment = isset($_POST['return_in_installment']) ? $_POST['return_in_installment'] : '';
    $total_num_installment = isset($_POST['total_num_installment']) ? $_POST['total_num_installment'] : '';
    $Role                  = isset($_POST['Role']) ? $_POST['Role'] : '';
    $advance_payment_date  = isset($_POST['advance_payment_date']) ? $_POST['advance_payment_date'] : '';

?>

<?php include('connection/dbconnection_crm.php')?>

<?php

    if(!empty($employee_id)) {
        
        $sel = "Select * from Advance_salary where status = 'open' AND employee_id = " . $employee_id;
        $result = mysqli_query($connect, $sel);
        $row = $result->fetch_assoc();
        session_start();
        if(!empty($row)){
            $_SESSION['error'] = 'One Advance Is Already Open!';
             
            header('Location:'.$_SERVER['HTTP_REFERER']);
            echo 'here1'.$_SERVER['HTTP_REFERER'];
        } else {
            $sql ="INSERT INTO `Advance_salary` (`Id`, `employee_id`,`Role`, `advance_payment`,`advance_payment_date`, `total_num_installment`, `return_in_installment`) 
        VALUES (NULL, '".$employee_id."', '".$Role."', '".$advance_payment."', '".$advance_payment_date."', '".$total_num_installment."', '".$return_in_installment."')";

            mysqli_query($connect, $sql) or die('Error In Inserting Record In Database');
        
            $_SESSION['success'] = 'Record Has Been Added!';
            header('Location:' . $_SERVER['HTTP_REFERER']);
            
        }
        
    }


?>

