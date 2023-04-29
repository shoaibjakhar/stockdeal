<?php 
  include('connection/dbconnection_crm.php');

  $role = $_GET['role'];
  $status = $_GET['status'];
  if($role == 'Agent' && $status =='Active')
  {
    $getQuery = "SELECT username AS value  FROM `employee` where  Role ='Agent' AND status='Active'";
  }
  else if($role == 'Agent' && $status =='inActive')
  {
    $getQuery = "SELECT username AS value  FROM `employee` where  Role ='Agent' AND status !='Active'";
  }
  else  if($role == 'Team_Leader' && $status =='Active')
  {
    $getQuery = "SELECT username AS value  FROM `employee` where  Role ='Team Leader' AND status ='Active'";
  }
  else  if($role == 'Team_Leader' && $status =='inActive')
  {
    $getQuery = "SELECT username AS value  FROM `employee` where  Role ='Team Leader' AND status !='Active'";
  }
  else  if($role == 'SR_TL' && $status =='Active')
  {
    $getQuery = "SELECT username AS value  FROM `employee` where  Role ='SR_TL' AND status='Active'";
  }
  else 
  {
    $getQuery = "SELECT username AS value  FROM `employee` where  Role ='SR_TL' AND status !='Active'";
  }
  
  
  $result = mysqli_query($connect, $getQuery); 
    $employee_name = array();
  while($row =mysqli_fetch_assoc($result))
  {
    $employee_name[] = $row;
  } 
    echo json_encode($employee_name);
?>