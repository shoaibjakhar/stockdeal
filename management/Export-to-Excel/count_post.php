<?php  
//$connect = mysqli_connect("103.50.160.116", "shareevx_root", "Ahmed@123456", "shareevx_rsicrm");
 include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");

$output = '';
if($_POST){
//print"<pre>";
$StartDate_SQLFormat = $_POST["StartDate_SQLFormat"];
$EndDate_SQLFormat = $_POST["EndDate_SQLFormat"];
$Source = $_POST["Source"];
$disposition[] = $_POST['disposition'];
$Segment = $_POST['Segment'];
$State = $_POST['State'];
if($disposition){
    $where = " and (Disposition = '".$disposition[0][0]."'";
    for($i=1;$i<count($disposition[0]); $i++){
    $where.= " Or Disposition = '".$disposition[0][$i]."'";        

    }
}
 $query = "SELECT Full_Name, Mobile,State, Source,Segment, Disposition, DATE_FORMAT(TimeStamp,' %d-%m-%Y') AS DateINR FROM `Assigned_Leads`  WHERE  Source='".$Source."'";
if($State != ''){
    $query.= " AND State = '".$State."'";
   
}
if($Segment != ''){
     $query.= " AND Segment = '".$Segment."'";
}
$query.= " AND  LeadDateTime >= '".$StartDate_SQLFormat."' AND LeadDateTime <= '".$EndDate_SQLFormat."' ".$where.") ORDER BY  `Assigned_Leads`.`TimeStamp` ASC";
//echo $query.'<br><br>';
 $result = mysqli_query($connect, $query);
$output = mysqli_num_rows($result);
echo $output;
  
 }
 
?>