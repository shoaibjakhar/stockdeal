<?php
$result = array();
include('../connection/dbconnection_crm.php');
if($_POST){
    
    $sel = "SELECT `salery` FROM `employee` WHERE Id = '".$_POST['id']."'";

    
    $qry = mysqli_query($connect,$sel);
    $fetch = mysqli_fetch_assoc($qry);

    echo $fetch['salery'];
    // echo $_POST['id'];
   
}
