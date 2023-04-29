<?php





session_start();
   
   include('../connection/dbconnection_crm.php');
error_reporting(1);
function getShared($users){

    global $connect;

     $sql = ("SELECT id,Costumer_ID, DATE_FORMAT( SaleDate,  '%d-%m-%Y' ) AS SaleDateIND, Full_Name, LastName, Email_ID, Mobile_No, Location, PackageName,  DATE_FORMAT( Activation_Date,  '%d-%m-%Y' ) AS ActivationDate ,  DATE_FORMAT( Exp_Date,  '%d-%m-%Y' ) AS ExpDate , case when Exp_Date< NOW() then 'Expired' else 'Active' end as Status , Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent, Manager, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i' ) AS DateTimeConvert  FROM Customer_Payment_History where  (Agent = '".$users."' or Agent_1 = '".$users."' or Agent_2 = '".$users."' or Agent_3 = '".$users."') && MONTH(  `SaleDate` ) = MONTH( CURDATE( )) AND YEAR(`SaleDate`) = YEAR(CURRENT_DATE()) AND Approval_Status = 'Approved' ORDER BY  `Costumer_ID` DESC");

    $qrys = mysqli_query($connect,$sql);

    $am = 0;

    while($rows = $qrys->fetch_assoc()){

    $id = $rows['id'];


      $sel = "select Agent_1,Agent,Agent_2,Agent_3,Agent_1_Shared_Amount,Agent_2_Shared_Amount,Agent_3_Shared_Amount from Customer_Payment_History where id = '$id'";

     $qry = mysqli_query($connect, $sel);

      $row = mysqli_fetch_assoc($qry);

    //   print"<pre>";

    //   print_r($row);
      //die();

         if($users == $row['Agent']){

           $am += $row['Agent_1_Shared_Amount'];  

         }

         else{

        

        if($users != $row['Agent_1']){

           // continue;

        }

        else{

           $am += $row['Agent_1_Shared_Amount']; 

        }

        if($users != $row['Agent_2']){

           // continue;

        }

        else{

            $am += $row['Agent_2_Shared_Amount'];  

        }

        if($users != $row['Agent_3']){

           // continue;

        }

        else{

            $am += $row['Agent_3_Shared_Amount'];  

        }

     }

    }

     return $am; 

}

if(isset($_GET['Team_Leader']) && $_GET['Team_Leader'] != ''){
    $sel = "select * from employee where Status = 'Active' AND Team_Leader = '".$_GET['Team_Leader']."' AND username !='Akshay Shetty' AND username !='Sudheer Singh' AND username !='Select' AND username !='Praveen Chhajlane' AND username !='compliance officer' AND Role !='Team Leader' AND Role !='compliance officer'  AND Date_of_Join BETWEEN '".$_GET['from']."' AND '".$_GET['to']."' ";
  
}
else if(isset($_GET['from']) && isset($_GET['to'])){
    $sel = "select * from employee where Status = 'Active' AND username !='Akshay Shetty' AND username !='Sudheer Singh' AND username !='Select' AND username !='Praveen Chhajlane' AND username !='compliance officer' AND Role !='Team Leader' AND Role !='compliance officer' AND Date_of_Join BETWEEN '".$_GET['from']."' AND '".$_GET['to']."' ";
  }
    
else{


    $sel = "select * from employee where Status = 'Active' AND username !='Akshay Shetty' AND username !='Sudheer Singh' AND username !='Select' AND username !='Praveen Chhajlane' AND username !='compliance officer' AND Role !='Team Leader' AND Role !='compliance officer' ";
}

$qry = mysqli_query($connect,$sel);
//print_r($qry);
//die();

$i = 0;

while($rows = $qry->fetch_assoc()){

    $all_data['SalesAgentWise'] = getShared($rows['username']);

     $get_data[$i] = $all_data;

     $get_data[$i]['Sale_Target'] = $rows['Sale_Target'];

     $get_data[$i]['Id'] = $rows['Id'];
     $get_data[$i]['Date_of_Join'] = $rows['Date_of_Join'];

// echo "<pre>";
// print_r($all_data);
// echo "</pre>";
    if(!empty($all_data) || empty($all_data['Agent'])) {
        
        // if(($all_data['Agent'] == '' || $all_data['Agent'] == NULL)) {
            $get_data[$i]['Agent'] =  $rows['username'];
        // }

    }

    $i++;

    //$users[] = $rows;   

}
// echo "<pre>";
// print_r($all_data);
// echo "</pre>";


$excel_data = []; 


if(!empty($get_data)){

  foreach($get_data as $key => $row)
  {

   $select = "select Team_Leader,salery from employee where username = '".$row['Agent']."'";
   $query = mysqli_query($connect,$select);
   $fetch_data = $query->fetch_assoc();
   if(isset($_GET['Team_Leader']) && $_GET['Team_Leader'] != ''){
       if($_GET['Team_Leader'] != $fetch_data['Team_Leader']){
           continue;
       }
   }

   
    //echo('<td style="text-align:center">'.date('d M Y',strtotime($row['Date_of_Join'])).'</td>');

    

   //echo('<td style="text-align:center">'.$row['Agent'].'</td>');
   

   
   //echo('<td style="text-align:center">'.$fetch_data['Team_Leader'].'</td>');

    //echo('<td style="text-align:center">'.round($row['SalesAgentWise'], 2).'</td>');
    
  //   only show to admin
     if($_SESSION['Role'] == 'Super Admin') {

      // die('here');
         
         $incentive = 0;
         
         
         if($row['Sale_Target'] >= 100000 && $row['Sale_Target'] <= 125000){
             $incentive = 5000;
            
         }
         else if($row['Sale_Target'] > 125000 && $row['Sale_Target'] <= 150000){
             $incentive = 7500;
          
         }
         else if($row['Sale_Target'] > 150000 && $row['Sale_Target'] <= 175000){
             $incentive = 10000;
             
         }
         else if($row['Sale_Target'] > 175000 && $row['Sale_Target'] < 200000){
             $incentive = 12500;    
            
         }
         else if($row['Sale_Target'] == 200000){
             $incentive = 15000;
         }
         else if($row["Sale_Target"] > 200000){
             $addTarget = 25000;
              $incentive = 15000;
      
             $i = 200000;
             while($row["Sale_Target"] > $i){
                 if($row["Sale_Target"]%$addTarget == 0){
                      $incentive = $incentive+3000;
                      $i = $i+25000;
                 }
             }
           // echo('<td style="text-align:center">'.$incentive.'</td>');
         }
         else{
             //echo('<td style="text-align:center">'.$incentive.'</td>');
         }
         
         //echo('<td style="text-align:center">'.($fetch_data['salery'] + $incentive).'</td>');

    }

      if(!empty($row['SalesAgentWise'])) {
          
          $per = round($row['SalesAgentWise']/$row['Sale_Target']*100,0);
          
      } else {
          $per = 0;
      }
      
      

    $per = round($row['SalesAgentWise']/$row['Sale_Target']*100,0);


    $excel_data[$key+1]["Rank"] = $key+1;
    $excel_data[$key+1]["Date of Join"] = date('d M Y',strtotime($row['Date_of_Join']));
    $excel_data[$key+1]["Agent"] = $row['Agent'];
    $excel_data[$key+1]["Team Leader"] =$fetch_data['Team_Leader'];
    $excel_data[$key+1]["Sales"] = round($row['SalesAgentWise'], 2);
    $excel_data[$key+1]["Salery"] = $fetch_data['salery'];
    $excel_data[$key+1]["Incentive"] = $incentive;
    $excel_data[$key+1]["Achievement"] = $per;
    $excel_data[$key+1]["Total Payable"] = $fetch_data['salery'] + $incentive;
   



  }

  // echo "<pre>";
  // print_r($excel_data);
  // die();

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
    
  
