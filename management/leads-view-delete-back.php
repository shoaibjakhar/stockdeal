<?php
session_start();
include_once('connection/dbConfig.php');
if(isset($_POST['bulk_delete_submit'])){
    $idArr = $_POST['checked_id'];
    foreach($idArr as $id){
        mysqli_query($conn,"DELETE FROM Assigned_Leads WHERE Id=".$id);
    }
    $_SESSION['success_msg'] = 'Deleted successfully.';
    header('Location: leads-view-delete.php');
}
?>