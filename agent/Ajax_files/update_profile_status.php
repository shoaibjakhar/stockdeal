<h1>dsf adsfasd</h1>
<?php
include('../connection/dbconnection_crm.php');

    if($_POST){
        $id = $_POST['id'];
        $sel = "SELECT Id,Status from employee where Id = '".$id."'";
        $qry = mysqli_query($connect,$sel);
        $get_data = mysqli_fetch_assoc($qry);
        if($get_data['Status'] == 'Active'){
            $status = 'disabled';
        }
        else{
            $status = 'Active';
        }
        $upd_qry = 'update employee set Status = "'.$status.'" where Id = "'.$id.'"';
        mysqli_query($connect, $upd_qry);
        echo 'success';
    }





?>




