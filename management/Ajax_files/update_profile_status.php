<?php
include('../connection/dbconnection_crm.php');

  




if($_POST){
    $upd = "update Customer_profile set Approval_Status = 'Approved' where Costumer_ID = '".$_POST['CustomerId']."'";
    mysqli_query($connect,$upd);

    $upd = "update Customer_Payment_History set Approval_Status = 'Approved' where Costumer_ID = '".$_POST['CustomerId']."'";
    mysqli_query($connect,$upd);
    //die("here");
    // $qry="SELECT id FROM `Customer_profile` WHERE Costumer_ID='".$_POST['CustomerId']."'";
    // $fetch = mysqli_fetch_assoc($qry);
    // $id = $fetch['id'];
    
    //$id =5763;// $_POST['CustomerId'];
    $sel = "SELECT Full_Name,Email_ID,SUM(Paid_Amout) AS total_pay,PackageName,Activation_Date,Exp_Date,Paid_Amout FROM Customer_Payment_History WHERE Costumer_ID = '".$_POST['CustomerId']."'";
    $qry = mysqli_query($connect,$sel);
    $fetch = mysqli_fetch_assoc($qry);
    $email = $fetch['Email_ID'];
    
    $sel_op = "SELECT Sales_Email,Trading_Guidence_Mail_Template FROM Options WHERE Id = 1";
    $qry_op = mysqli_query($connect,$sel_op);
    $fetch_op = mysqli_fetch_assoc($qry_op);
    $template = $fetch_op['Trading_Guidence_Mail_Template'];
    
    $vars = array(
            '{{CUSTOMER_NAME}}'=>$fetch['Full_Name'],
            '{{PACKAGE_NAME}}'=>$fetch['PackageName'],
            '{{PAID_AMOUNT}}'=>$fetch['total_pay'],
            '{{ACTIVATION_DATE}}'=>date('d M Y',strtotime($fetch['Activation_Date'])),
            '{{EXP_DATE}}'=>date('d M Y',strtotime($fetch['Exp_Date'])),
            '{{logo}}' =>'../images/RSI-Login-Logo.png'
        );
    foreach($vars as $key => $val){
        $template = str_replace($key,$val,$template);
}
    
    
     include('../partial/session_start.php');

require('../fpdf/fpdf.php');

// echo $_GET['id'];

$sql = ("SELECT  id, SUM(Paid_Amout) AS total_pay, SUM(Tax_Amount) AS total_tax,SUM(Company_Amount) AS Gross_Amount, Costumer_ID, DATE_FORMAT( SaleDate, '%d-%m-%Y' ) AS SaleDateIND, Full_Name, Email_ID, Mobile_No, Pan_Number, Approval_Status, PackageName, DATE_FORMAT( Activation_Date, '%d-%m-%Y' ) AS ActivationDate , DATE_FORMAT( Exp_Date, '%d-%m-%Y' ) AS ExpDate, Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount,Agent_2, Agent_2_Percentange, Agent_2_Shared_Amount,Agent_3, Agent_3_Percentange, Agent_3_Shared_Amount, Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime, '%d-%m-%Y %h %i' ) AS DateTimeConvert FROM Customer_Payment_History where Costumer_ID=".$_POST['CustomerId']." ORDER BY `Id` DESC LIMIT 50");

    $result = mysqli_query($connect, $sql);
    
   $row = $result->fetch_assoc();


    $qury="SELECT * FROM Customer_Payment_History WHERE Costumer_ID='".$_POST['CustomerId']."' ORDER BY `Id` DESC LIMIT 1";
    $result_date = mysqli_query($connect, $qury);
    $latest_1 = $result_date->fetch_assoc();
    $latest =$latest_1['SaleDate'];
 
$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )
$logo = "../images/RSI-Login-Logo.png";

$pdf->Image($logo,10,7,40);
$pdf->Cell(42   ,5,'',0,0);
$pdf->Cell(115  ,5,'Share Idea',0,0);
$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(255,140,0); 
$pdf->Cell(59   ,5,'INVOICE',0,1);
$pdf->SetTextColor(0,0,0); 
//end of line

$pdf->Cell(48  ,5,'',0,0);
// $pdf->Cell(157  ,5,'GST: 27AOXPP8950P1ZI',0,0);
$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0,0,0); 

$pdf->Cell(195  ,5,'',0,1);
$pdf->Cell(195  ,0,'',1,1);
$pdf->Cell(195  ,5,'',0,1);

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',10);

$pdf->Cell(130  ,5,'Date: '.date('d-M-Y',strtotime($latest)),0,0);
$pdf->Cell(59   ,5,'',0,1);//end of line

$pdf->Cell(100  ,5,'Customer Number: '.$row["Costumer_ID"],0,0);
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,140,0); 
$pdf->Cell(25   ,5,'',0,1);
$pdf->SetTextColor(0,0,0); 
$pdf->SetFont('Arial','',10);
// $pdf->Cell(34    ,5,'[dd/mm/yyyy]',0,1);//end of line

$pdf->Cell(130  ,5,'Package Details:'.$row['PackageName'],0,0);
$pdf->Cell(25   ,5,'',0,1);

// $pdf->Cell(120  ,5,'OPTIONS DIAMOND',0,0);
// $pdf->SetFont('Arial','B',14);
// $pdf->SetTextColor(255,140,0); 
// $pdf->Cell(25   ,5,'',0,1);
// $pdf->SetFont('Arial','',10);
// $pdf->SetTextColor(0,0,0); 
// $pdf->Cell(34   ,5,"c123231321",0,1);

//end of line

//make a dummy empty cell as a vertical spacer
// $pdf->Cell(189   ,10,'',0,1);//end of line

//billing address
$pdf->SetFont('Arial','B',11);
$pdf->Cell(100  ,5,'Customer details',0,1);//end of line
$pdf->SetFont('Arial','',10);
//add dummy cell at beginning of each line for indentation
$pdf->Cell(10   ,5,'',0,0);
$pdf->Cell(90   ,5,"Name:".$row['Full_Name'],0,1);

$pdf->Cell(10   ,5,'',0,0);
$pdf->Cell(90   ,5,"Phone:".$row['Mobile_No'],0,1);

// $pdf->Cell(10   ,5,'',0,0);
// $pdf->Cell(90   ,5,"GST:".$row['Pan_Number'],0,1);


//make a dummy empty cell as a vertical spacer
$pdf->Cell(189  ,6,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(25   ,5,'Sr. No',1,0);
$pdf->Cell(40   ,5,'Payment Date',1,0);
$pdf->Cell(34   ,5,'Payment Mode',1,0);//end of line
$pdf->Cell(34   ,5,'Paid Amount',1,0);//end of line
$pdf->Cell(30   ,5,'Tax',1,0);//end of line

$pdf->Cell(30   ,5,'Conv fee',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

//items
$sql1 = ("SELECT  id,Costumer_ID, DATE_FORMAT( SaleDate, '%d-%m-%Y' ) AS SaleDateIND, Full_Name, Email_ID, Mobile_No, Pan_Number, Approval_Status, PackageName, DATE_FORMAT( Activation_Date, '%d-%m-%Y' ) AS ActivationDate , DATE_FORMAT( Exp_Date, '%d-%m-%Y' ) AS ExpDate, Remark, Paid_Amout, Company_Amount, Tax_Amount, PaymentMode, Agent_1, Agent_1_Percentange, Agent_1_Shared_Amount,Agent_2, Agent_2_Percentange, Agent_2_Shared_Amount,Agent_3, Agent_3_Percentange, Agent_3_Shared_Amount, Date_of_Birth, KYC, Risk_Score, Risk_Level, DATE_FORMAT( DateTime, '%d-%m-%Y %h %i' ) AS DateTimeConvert FROM Customer_Payment_History where Costumer_ID=".$_POST['CustomerId']." ORDER BY `Id` DESC LIMIT 50");

$result1 = mysqli_query($connect, $sql1);
$i=1;
while ($row1=$result1->fetch_assoc()) {

        $pdf->Cell(25   ,7,$i,0,0,'C');
        $pdf->Cell(40   ,7,$row1['SaleDateIND'],0,0,'C');
        $pdf->Cell(34   ,7,$row1['PaymentMode'],0,0,'C');
        $pdf->Cell(34   ,7,$row1['Company_Amount'],0,0,'C');
        $pdf->Cell(30   ,7,$row1['Tax_Amount'],0,0,'C');
        $pdf->Cell(30   ,7,"0",0,1,'C');
        $i++;
} 
$pdf->Cell(195  ,5,'',0,1);
$pdf->Cell(195  ,0,'',1,1);
$pdf->Cell(195  ,3,'',0,1);
//summary
$pdf->Cell(130  ,5,'',0,0);
$pdf->Cell(30   ,5,'Gross Amount',0,0);
// $pdf->Cell(4 ,5,'$',1,0);
$pdf->Cell(30   ,5,number_format($row['Gross_Amount']),1,1,'R');//end of line

$pdf->Cell(130  ,5,'',0,0);
$pdf->Cell(30   ,5,'GST 18%',0,0);
// $pdf->Cell(4 ,5,'$',1,0);
$pdf->Cell(30   ,5,number_format($row['total_tax']),1,1,'R');//end of line

$pdf->Cell(130  ,5,'',0,0);
$pdf->Cell(30   ,5,'Conv fee',0,0);
// $pdf->Cell(4 ,5,'$',1,0);
$pdf->Cell(30   ,5,"0",1,1,'R');//end of line

$pdf->Cell(40   ,10,"",0,1);
$pdf->Cell(35   ,5,'',0,0);



$pdf->SetFont('Arial','B',19);
$pdf->Cell(60   ,5,'Thank You!',0,0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(30   ,5,'GRAND TOTAL',0,1);
$pdf->Cell(100  ,5,'',0,0);
$pdf->Cell(100  ,5,$row['total_pay'],0,1);


$pdf->Cell(40   ,6,"",0,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(30   ,5,'Notice:',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(60   ,5,'The amount once paid is not refundable. Trading in stock market is a risky activity.
',0,1);
$pdf->Cell(30   ,5,'',0,0);
$pdf->Cell(60   ,5,'Please read our Terms and Conditions from time to time.
',0,1);

$pdf->Cell(195  ,3,'',0,1);
$pdf->Cell(195  ,0,'',1,1);
$pdf->Cell(195  ,4,'',0,1);

$pdf->Cell(50   ,3,'',0,0);
$pdf->Cell(60   ,3,'The Receipt is computerized hence does not required signature',0,1);

$fileName = 'pdf_files/'.rand().'invoice.pdf';
$save=$pdf->Output('F',$fileName,true);
    
    sendEmail($email,$template,$id,$fileName);
   // header('location:'.$_SERVER['HTTP_REFERER']);
  
   
    }
    
    function sendEmail($to,$message,$id,$fileName)
    {
        require("class.phpmailer.php");

        $mail = new PHPMailer;
        
        global $connect;
        $sel = "select Trading_Guidence_Email_Subject,Sales_Email,Info_Email,Support_Email from Options where Id = 1";
        $qry = mysqli_query($connect,$sel);
        $fetch = mysqli_fetch_assoc($qry);
        $Sales_Email = $fetch['Sales_Email'];
        $Info_Email = $fetch['Info_Email'];
        $Support_Email = $fetch['Support_Email'];
      
        $mail->IsSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';           //aa
        $mail->Port = '587'; 
        $mail->SMTPDebug = false;                    //new aa
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->SMTPSecure = 'tls' ;              //new aa
        $mail->Username = 'info@stockdeal.co.in';
        $mail->Password = 'B0up#CazN';                       // Enable encryption, 'ssl' also accepted
   
        $mail->From = 'info@stockdeal.co.in';
        $mail->FromName = 'Stock Deal';
        $mail->AddAddress($to);  // Add a recipient
        $mail->AddCC("sale@stockdeal.co.in");
        
        $mail->IsHTML(true);                                  // Set email format to HTML
        
        $mail->Subject =$fetch['Trading_Guidence_Email_Subject'];
        $mail->Body    = $message;
         $mail->AddAttachment($fileName, 'invoice.pdf');
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if(!$mail->Send()) {
        	print_r($mail);
           echo 'Message could not be sent.';
           echo 'Mailer Error: ' . $mail->ErrorInfo;
           exit;
        }
        
        $upd = "UPDATE Customer_profile SET Trading_Guidence_Mail = 'Sent' WHERE Costumer_ID = '".$_POST['CustomerId']."'";
         mysqli_query($connect,$upd);

        $upd = "UPDATE Customer_Payment_History SET Trading_Guidence_Mail = 'Sent' WHERE Costumer_ID = '".$_POST['CustomerId']."'";
         mysqli_query($connect,$upd);
     
    }


   echo 'success';


?>
