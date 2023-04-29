<?php

include_once 'connection.php';
include('../connection/dbconnection_crm.php');
$full_name =  $_POST['full_name'];
$mobile    =   $_POST['mobile'];
$email     =   $_POST['email'];
$agent_name =  $_POST['agent_name'];
$pan_number    =   $_POST['pan_number'];
$dob     =   $_POST['dob'];
$ip =  $_POST['ip'];


$folderPath = "upload/";
//echo $_POST['signature'];

$image_parts = explode(";base64,", $_POST['signature']); 
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
$file = $folderPath . uniqid() . '.'.$image_type;
  
$sql="INSERT INTO agreement(name,full_name,mobile,agent_name,email,pan_number,dob,ip) VALUES('$file','$full_name','$mobile','$agent_name','$email','$pan_number','$dob','$ip')";

mysqli_query($connect,$sql);
 $last_insert_id = $connect->insert_id; 
file_put_contents($file, $image_base64);
$image_email="https://agent.stockdeal.co.in/user-agreement/".$file;
    


// namespace Dompdf;
// require_once 'dompdf/autoload.inc.php';

//$dompdf = new Dompdf(); 

        $html = file_get_contents('email_template.php');
        $html = str_replace('{{full_name}}', $full_name, $html);
        $html = str_replace('{{mobile}}', $mobile, $html);
        $html = str_replace('{{email}}', $email, $html);
        $html = str_replace('{{agent_name}}', $agent_name, $html);

        $html = str_replace('{{pan_number}}', $pan_number, $html);
        $html = str_replace('{{dob}}', $dob, $html);
        $html = str_replace('{{ip}}', $ip, $html);


        $html = str_replace('{{file}}', $image_email, $html);

        $dompdf->set_option('enable_html5_parser', TRUE);
        $dompdf->loadHtml($html);
        //$dompdf->setPaper('A4', 'landscape');

        $dompdf->render();
        //  die();
        ob_end_clean();
//$dompdf->stream("",array("Attachment" => false));
//$dompdf->stream($filename);

$output = $dompdf->output();
$date = date("D M d, Y G:i");
$fileName = $full_name.$date.'.pdf';
file_put_contents('pdf_files/'.$fileName, $output);

include_once 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer(true);


          // $mail->SMTPDebug = 3;
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
        
         //include 'email_template.php';

        $senderEmail = "info@stockdeal.co.in";                                 // TCP port to connect to
        $senderName = "Stock Deal";                                 // TCP port to connect to

        $msg = file_get_contents('email_template.php');
        $msg = str_replace('{{full_name}}', $full_name, $msg);
        $msg = str_replace('{{mobile}}', $mobile, $msg);
        $msg = str_replace('{{email}}', $email, $msg);
        $msg = str_replace('{{agent_name}}', $agent_name, $msg);
        $msg = str_replace('{{pan_number}}', $pan_number, $msg);
        $msg = str_replace('{{dob}}', $dob, $msg);
        $msg = str_replace('{{ip}}', $ip, $msg);
        $msg = str_replace('{{file}}', $image_email, $msg);
  
          $mail->AddAddress($email);
          $mail->AddCC("sale@stockdeal.co.in"); 
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = 'Stock Deal';
          $mail->AddAttachment('pdf_files/'.$fileName, 'user-agreement.pdf');
          $mail->Body    = $msg;
          $mail->AltBody = '';
          if(!$mail->send()) {
              
              echo "error";
          } else 
          {
          //echo "success";
        }



        // include ('../agreement_thanku.php');
        // error_reporting(1);
        header("Location:../agreement_thanku.php?id=".$last_insert_id);
        // header("Location: ../agreement_thanku.php?full_name=".$full_name."&mobile=".$mobile."&email=".$email."&agent_name=".$agent_name."&file=".$file.");


        ?>