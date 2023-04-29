<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'user-agreement/connection.php';
include('connection/dbconnection_crm.php');
$id=$_GET['Id'];

$query = "SELECT * FROM employee WHERE Id='".$id."'";
$result  = mysqli_query($connect, $query);
$row     = $result->fetch_assoc();

$date = date("D M d, Y G:i");
$full_name=$row['username'];
$email    =$row['Email'];
$role     =$row['Role'];
$salery   =$row['salery'] * 12;
$Address  =$row['Address'];

if($role=="Agent")
{
  $role="Sales Executive";
}
$html = file_get_contents('offer-letter-functions-template.php');
     
        $html = str_replace('{{full_name}}', $full_name, $html);
        $html = str_replace('{{date}}', $date, $html);

         $html = str_replace('{{Position}}', $role, $html);
         $html = str_replace('{{salry}}', $salery, $html);
         $html = str_replace('{{Address}}', $Address, $html);
         $html = str_replace('{{Email}}', $email, $html);

$dompdf->set_option('enable_html5_parser', TRUE);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

ob_end_clean();

$output = $dompdf->output();
$date = date("D M d, Y G:i");
$fileName = $full_name.$date.'.pdf';
file_put_contents('user-agreement/pdf_files/'.$fileName, $output);

include_once 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer(true);

          // $mail->SMTPDebug = 3;
        $mail->IsSMTP();                                      // Set mailer to use SMTP
        $mail->Host = "shareidea.co.in";                 // Specify main and backup server
        //$mail->Host = "Give IP Address";                 // If the above does not work.
        $mail->Port = 25;                                    // Set the SMTP port
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = "info@shareidea.co.in";                // SMTP username
        $mail->Password = "2T1zlj_14*KT";                  // SMTP password
        //$mail->SMTPSecure = "ssl";                            // Enable encryption, 'ssl' also accepted
        
        $mail->From = 'info@shareidea.co.in';
        $mail->FromName = 'Shareidea';
        
         //include 'email_template.php';

        $senderEmail = "info@shareidea.co.in";                                 // TCP port to connect to
        $senderName = "Share Idea";                                 // TCP port to connect to

        $context["full_name"]   = $full_name; 
        $context["mobile"]      = $mobile; 
        $context["email"]       = $email; 
        $context["agent_name"]  = $agent_name; 
        $context["file"]        = $file; 

        $mail->setFrom($senderEmail, $senderName);
          // $mail->addAddress(strtolower("16.bscs.319@gmail.com"));     // Add a recipient
          // $mail->addAddress(strtolower($email));     // Add a recipient
    
        $mail->addAddress("16.bscs.319@gmail.com");
        $mail->addAddress("sale@shareidea.co.in");
        // $mail->addAddress("shoaibjakhar11@gmail.com");
         // $mail->addAddress("info@shareidea.co.in"); 
           // $mail->addAddress("akifbaloch3377@gmail.com");    // Add a recipient
          //$mail->addAddress("sales@sharebazarexpert.co.in");     // Add a recipient
    
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = 'Share Idea: Offer Letter!';

          $mail->AddAttachment('user-agreement/pdf_files/'.$fileName);
          $mail->Body    = "Dear ". $full_name . " Your offer letter is attached below!";
          $mail->AltBody = '';
          if(!$mail->send()) {

            echo "Ah! We are facing some issue with sending offer letter, Please contact support!";
          } 
          else 
          {
            echo "Offer letter sent successfully!";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
          }



        // include ('../agreement_thanku.php');
        // error_reporting(1);
        //   header("Location:../agreement_thanku.php?id=".$last_insert_id);
        // header("Location: ../agreement_thanku.php?full_name=".$full_name."&mobile=".$mobile."&email=".$email."&agent_name=".$agent_name."&file=".$file.");


          ?>