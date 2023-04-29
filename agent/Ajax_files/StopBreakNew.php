<?php 

	include('../connection/dbconnection_crm.php');
	session_start();
    $user_id = $_SESSION['Id'];

    $time =  $_POST['time'];

    $type = $_POST['type'];

    $remark = $_POST['remark'];
    

    $current_date = date("d-m-Y");
    if($type == "Dinner_Lunch")
    {
    	$sql="UPDATE attendence Set dinner = dinner + ".$time." , total_break_time= dinner + tea + meeting Where user_id='".$user_id."' AND `date`='".$current_date."'";
	    $qryss = mysqli_query($connect,$sql);
    }
    if($type == "Meeting")
    {
    	$sql="UPDATE attendence Set meeting = meeting + ".$time.", total_break_time= dinner + tea + meeting Where user_id='".$user_id."' AND `date`='".$current_date."'";
	    $qryss = mysqli_query($connect,$sql);
    }
    if($type == "Tea")
    {
    	$sql="UPDATE attendence Set tea = tea + ".$time." , total_break_time= dinner + tea + meeting Where user_id='".$user_id."' AND `date`='".$current_date."'";
	    $qryss = mysqli_query($connect,$sql);
    }
	   
	if($remark !='')  
	{
		$sql="UPDATE attendence Set Meeting_Remark = '".$remark."'  Where user_id='".$user_id."' AND `date`='".$current_date."'";
	    $qryss = mysqli_query($connect,$sql);
	     echo "done";
	} 
	  


;?>