<?php
include('../connection/dbconnection_crm.php');


if($_POST){
    if($_POST['Reason_for_leave'])
    {
        $reason_for_leave = $_POST['Reason_for_leave'];
    }else{
        $reason_for_leave = null;
    }
    if($_POST['Status'] == 'disabled'){
        $Status = 'Active';
        $Status_1 = 1;
    }
    else{
        $Status = 'disabled';
        $Status_1 = 0;
    }
    $Date_of_Leave = $_POST['Date_of_Leave']?$_POST['Date_of_Leave']:date('Y-m-d');
    $upd = "update employee set Status = '".$Status."' , Reason_for_leave = '".$reason_for_leave."', Date_of_Leave = '".$Date_of_Leave."'  where id = '".$_POST['CustomerId']."'";

    mysqli_query($connect,$upd);

     $upd1 = "SELECT * FROM `employee` WHERE Id='".$_POST['CustomerId']."'";

     $result1 = mysqli_query($connect,$upd1);
     $fetch = mysqli_fetch_assoc($result1);
     $user_id = $fetch['Id'];
     $role = $fetch['Role'];
     $date = Date('Y-m-d');

     $qry="INSERT INTO `employee_status_log`(`user_id`, `role`, `status`, `change_date`) VALUES ('".$user_id."','".$role."','".$Status_1."','".$date."')";
     $result = mysqli_query($connect,$qry);


}
  echo 'success';
 // $upd1 = "SELECT * FROM employee where Id='119' ";

 // $result1 = mysqli_query($connect,$upd1);
 // echo $result1;
 // $fetch = mysqli_fetch_assoc($result1);
 // echo '-id'.$fetch['Id'];
?>
