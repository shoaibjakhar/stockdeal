<?php


session_start();

include('connection/dbconnection_crm.php');
error_reporting(1);

if (isset($_GET['submit'])) {

  $from = $_GET['from']; 
  $to = $_GET['to']; 
  if( $_GET['from'] !='' && $_GET['to'] !='' && $_GET['disposition'] !='All' && $_GET['disposition'] !='')
  {
     // die('here');
    $disposition = $_GET['disposition'];
    $sql = ("SELECT COUNT(*) as total FROM  `Assigned_Leads`  WHERE LeadDateTime BETWEEN '".$from."' AND '".$to."'  AND (Disposition = '".$disposition."')");
 //echo $sql;
  }
  else if($_GET['from'] !='' && $_GET['to'] !='' && $_GET['disposition'] =='All')
  {
    $disposition = $_GET['disposition'];
    $sql = ("SELECT COUNT(*) as total FROM  `Assigned_Leads`  WHERE LeadDateTime BETWEEN '".$from."' AND '".$to."' ");
  }
  else if($_GET['from'] !='' && $_GET['to'] !='')
  {
    $sql = ("SELECT COUNT(*) as total FROM  `Assigned_Leads`  WHERE LeadDateTime BETWEEN '".$from."' AND '".$to."'");
    // echo $sql;
    // die();
  }
  else if($_GET['disposition'] !='All' && $_GET['disposition'] !='')
  { 
    $disposition = $_GET['disposition'];
    $sql = ("SELECT COUNT(*) as total FROM  `Assigned_Leads`  WHERE  (Disposition = '".$disposition."')");
  }
  else
  {
    $sql = ("SELECT COUNT(*) as total FROM  `Assigned_Leads`");
  }
}
else
{
  exit();
}

$qry = mysqli_query($connect,$sql);
$fetch = $qry->fetch_assoc();
$count = $fetch['total'];
//echo '<br>total-records= '.$count;
if($count >=100000)
{    
 $loop_count = ceil($count/100000);
 //echo '<br>loop-count = '.$loop_count;
}
else 
{
    $loop_count=1;
}
 //echo '<br>loop-count = '.$loop_count;
 //die();
require_once 'spout-master/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;
$writer = WriterEntityFactory::createXLSXWriter();
$writer->openToBrowser('export-leads.xlsx');

for($i=0;$i<$loop_count;$i++)
{
     $limit = $i * 100000;

     if( $_GET['from'] !='' && $_GET['to'] !='' && $_GET['disposition'] !='All' && $_GET['disposition'] !='')
     {
      $disposition = $_GET['disposition'];
      $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y') AS DateTimeINR FROM  `Assigned_Leads`  WHERE LeadDateTime BETWEEN '".$from."' AND '".$to."'  AND (Disposition = '".$disposition."') ORDER BY  `id` DESC LIMIT ".$limit.",100000");
    }
    else if($_GET['from'] !='' && $_GET['to'] !='' && $_GET['disposition'] =='All')
    {
      $disposition = $_GET['disposition'];
      $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y') AS DateTimeINR FROM  `Assigned_Leads`  WHERE LeadDateTime BETWEEN '".$from."' AND '".$to."'  ORDER BY  `id` DESC LIMIT ".$limit.",100000");
    }
    else if($_GET['from'] !='' && $_GET['to'] !='')
    {
      $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y') AS DateTimeINR FROM  `Assigned_Leads`  WHERE LeadDateTime BETWEEN '".$from."' AND '".$to."'  ORDER BY  `id` DESC LIMIT ".$limit.",100000");
    }
    else if($_GET['disposition'] !='All' && $_GET['disposition'] !='')
    { 
      $disposition = $_GET['disposition'];
      $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y') AS DateTimeINR FROM  `Assigned_Leads`  WHERE  (Disposition = '".$disposition."') ORDER BY  `id` DESC LIMIT ".$limit.",100000");
    }
    else
    {
      $sql = ("SELECT id, Full_Name, Email, Mobile, State, Source, Disposition,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y') AS DateTimeINR FROM  `Assigned_Leads`    ORDER BY  `id` DESC LIMIT ".$limit.",100000");
    } 

    $qry = mysqli_query($connect,$sql);
    while($row = $qry->fetch_assoc()){
      $Full_Name = isset($row['Full_Name'])?$row['Full_Name']:'';
      $Mobile    = isset($row['Mobile'])?$row['Mobile']:'';
      $UserName = isset($row['UserName'])?$row['UserName']:'';
      $Status    =  isset($row['Status'])?$row['Status']:'';
      $Source = isset($row['Source'])?$row['Source']:'';
      $Disposition    = isset($row['Disposition'])?$row['Disposition']:'';
      $State = isset($row['State'])?$row['State']:'';
      $DateTimeINR    = isset($row['DateTimeINR'])?$row['DateTimeINR']:'';

      $cells = [
        WriterEntityFactory::createCell($Full_Name),
        WriterEntityFactory::createCell($Mobile),
        WriterEntityFactory::createCell($UserName),
        WriterEntityFactory::createCell($Status),
        WriterEntityFactory::createCell($Source),
        WriterEntityFactory::createCell($Disposition),
        WriterEntityFactory::createCell($State),
        WriterEntityFactory::createCell($DateTimeINR),
      ];
      $multipleRows = [
        WriterEntityFactory::createRow($cells),
      ];
      $writer->addRows($multipleRows); 
    }
}
$writer->close();

?>


