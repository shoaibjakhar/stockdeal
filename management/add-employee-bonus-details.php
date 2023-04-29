<?php
ob_start(); 
$employee_id           = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';
$amount       = isset($_POST['amount']) ? $_POST['amount'] : '';
$valid_date = isset($_POST['valid_date']) ? $_POST['valid_date'] : '';

?>

<?php include('connection/dbconnection_crm.php')?>

<?php
session_start();
if(!empty($employee_id)) {

    $sel = "Select Role from employee where  Id = '" .$employee_id."'";
    $result = mysqli_query($connect, $sel);
    $row = $result->fetch_array();

    $Role = $row['Role'];

    $sql ="INSERT INTO `bonus` (`Id`, `employee_id`,`role`, `amount`,`valid_date`) 
    VALUES (NULL, '".$employee_id."', '".$Role."', '".$amount."', '".$valid_date."')";

    mysqli_query($connect, $sql) or die('Error In Inserting Record In Database');

    $_SESSION['success'] = 'Record has been saved successfully!';
    header('Location: ' . $_SERVER['HTTP_REFERER']);

}
else
{
    $_SESSION['error'] = 'Something went wrong!';
    header('Location: ' .$_SERVER['HTTP_REFERER']);
}



?>

