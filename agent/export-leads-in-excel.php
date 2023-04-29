<?php





session_start();
   
   include('../connection/dbconnection_crm.php');
error_reporting(1);


    $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y') AS DateTimeINR FROM  `Assigned_Leads` ORDER BY  `id` DESC LIMIT 0,10");


$qry = mysqli_query($connect,$sel);

$excel_data = []; 

while($rows = $qry->fetch_assoc()){

    $excel_data[$key+1]["SR"]           = $key+1;
    $excel_data[$key+1]["Full Name"]    = isset($row['Full_Name'])?$row['Full_Name']:'';
    $excel_data[$key+1]["Mobile"]       = isset($row['Mobile'])?$row['Mobile']:'';
    $excel_data[$key+1]["User Name"]    = isset($row['UserName'])?$row['UserName']:'';
    $excel_data[$key+1]["Status"]       =  isset($row['Status'])?$row['Status']:'';
    $excel_data[$key+1]["Source"]       = isset($row['Source'])?$row['Source']:'';
    $excel_data[$key+1]["Disposition"]  =isset($row['Disposition'])?$row['Disposition']:'';
    $excel_data[$key+1]["State"]        = isset($row['State'])?$row['State']:'';
    $excel_data[$key+1]["LeadDateTime"] = isset($row['LeadDateTime'])?$row['LeadDateTime']:'';

}

function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {

    $sort_col = array();

    if(!empty($arr)){
        
        foreach ($arr as $key=> $row) {
            $sort_col[$key] = $row[$col];
        }    
        array_multisort($sort_col, $dir, $arr);
    }
}

array_sort_by_column($get_data, 'SalesAgentWise');


$total_sales = 0;

$total_achive =0;

$total_commit = 0;
if(!empty($get_data)){

    foreach($get_data as $row){
        $total_sales += $row['SalesAgentWise'];
    
         $total_commit += $row['Sale_Target'];
    
        $ach[] =$row;
    
    }
    
}




//////////////////////////////////

$data = array(
 '0' => array('Name'=> 'Parvez', 'Status' =>'complete', 'Priority'=>'Low', 'Salary'=>'001'),
 '1' => array('Name'=> 'Alam', 'Status' =>'inprogress', 'Priority'=>'Low', 'Salary'=>'111'),
 '2' => array('Name'=> 'Sunnay', 'Status' =>'hold', 'Priority'=>'Low', 'Salary'=>'333'),
 '3' => array('Name'=> 'Amir', 'Status' =>'pending', 'Priority'=>'Low', 'Salary'=>'444'),
 '4' => array('Name'=> 'Amir1', 'Status' =>'pending', 'Priority'=>'Low', 'Salary'=>'777'),
 '5' => array('Name'=> 'Amir2', 'Status' =>'pending', 'Priority'=>'Low', 'Salary'=>'777')
);

// echo "<pre>";
// print_r($data);
// die();
// if(isset($_POST["ExportType"]))
// {

    $filename ="export-to-excel.xls";     
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    ExportFile($excel_data);
    
    exit();
   
// }

function ExportFile($records) {
  $heading = false;
  if(!empty($records))
    foreach($records as $row) {
      if(!$heading) {
        // display field/column names as a first row
        echo implode("\t", array_keys($row)) . "\n";
        $heading = true;
      }
      echo implode("\t", array_values($row)) . "\n";
    }
    exit;
  }
  ?>
    
  
