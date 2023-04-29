<?php  
ini_set('max_execution_time', '0');
ini_set('memory_limit', '1024M');

//export.php  
//$connect = mysqli_connect("103.50.160.116", "shareevx_root", "Ahmed@123456", "shareevx_rsicrm");
 include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");
 

	 $result = mysqli_query($connect, "SELECT LeadsExportIframe FROM Options WHERE Id = '1'");
     $LeadsExportIframe = mysql_result($result, 0);
 
 
 
$output = '';
//echo($StartDate_SQLFormat.'<br/>');
//echo($EndDate_SQLFormat.'<br/>');
//echo($Source.'<br/>');
if($_POST){
//print"<pre>";
$StartDate_SQLFormat = $_POST["StartDate_SQLFormat"];
$EndDate_SQLFormat = $_POST["EndDate_SQLFormat"];
$Source = $_POST["Source"];
$disposition[] = $_POST['disposition'];
$Segment = $_POST['Segment'];
$State = $_POST['State'];
//print_r($disposition);
if($disposition){
    $where = " and (Disposition = '".$disposition[0][0]."'";
    for($i=1;$i<count($disposition[0]); $i++){
    $where.= " Or Disposition = '".$disposition[0][$i]."'";        

    }
}

 $query = "SELECT Full_Name, Mobile, Email,State, Source,Segment, Disposition, DATE_FORMAT(TimeStamp,' %d-%m-%Y') AS DateINR FROM `Assigned_Leads`  WHERE  Source='".$Source."'";
if($State != ''){
    $query.= " AND State = '".$State."'";
   
}
if($Segment != ''){
     $query.= " AND Segment = '".$Segment."'";
}


$query.= " AND  LeadDateTime >= '".$StartDate_SQLFormat."' AND LeadDateTime <= '".$EndDate_SQLFormat."' ".$where.") ORDER BY  `Assigned_Leads`.`TimeStamp` ASC";

 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
    <tr>  
     <th style="text-align:left">Full_Name</th>  
     <th style="text-align:left">Mobile</th>
     <th style="text-align:left">Email</th> 
     <th style="text-align:left" style="text-align:left">Source</th>  
     <th style="text-align:left">Disposition</th>
     <th style="text-align:left">Segment</th>
     <th style="text-align:left">Date</th>
     <th style="text-align:left">State</th>
    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["Full_Name"].'</td>  
                         <td>'.$row["Mobile"].'</td> 
                          <td>'.$row["Email"].'</td>
                         <td>'.$row["Source"].'</td>  
       <td>'.$row["Disposition"].'</td> 
        <td>'.$row["Segment"].'</td> 
       <td>'.$row["DateINR"].'</td>
       <td>'.$row["State"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  
 $StartDate = date("d-F-Y", strtotime($StartDate_SQLFormat));	 
 $EndDate = date("d-F-Y", strtotime($EndDate_SQLFormat));	 
	 
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename='.$LeadsExportIframe.'-'.$Source.'-Data-From-'.$StartDate.'-to-'.$EndDate.'.xls');
    echo $output;
 }
 
}
?>


