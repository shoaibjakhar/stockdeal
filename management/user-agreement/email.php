<?php 


    // global $con;
    // $current=basename($_SERVER['PHP_SELF']);
    // $query=mysqli_query($con,"SELECT * from users where type='admin' ");
    // $fetch=mysqli_fetch_array($query);
    // $phone=$fetch['phone'];
    // $address = getConfig('address');
    // if($data['email'] != '') {
      // send an email

      
      include_once 'PHPMailer-master/PHPMailerAutoload.php';
          $mail = new PHPMailer(true);


          // $mail->SMTPDebug = 3;
          $mail->isSMTP();                                      // Set mailer to use SMTP
             $mail->Host =  "sharebazarexpert.com";  // Specify main and backup SMTP servers
            //$mail->Host = 'zoop.to';
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
             $mail->Username = "info@sharebazarexpert.com";                 // SMTP username
            //$mail->Username = 'mailto:support@zoop.to';
            $mail->Password = "%B_U~vC#O7Vr";
            //$mail->Password = '-3U+ho#(KAg=';                          // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; 


          $senderEmail = "info@sharebazarexpert.com";                                 // TCP port to connect to
          $senderName = "Shoaib";                                 // TCP port to connect to
           // $msg = 'TRestingf';
           // $msg .= '<p><b>Best regards,</b></p>';
           // $msg .= '<p><b>Shoaib</b></p>';
           // $msg .= '<p><b>Address:</b> </p>';
           // $msg .= '<p><b>Phone:</b> </p>';
           // $msg .= include 'email_template.php';
           $msg = file_get_contents('index.html');
          $mail->setFrom($senderEmail, $senderName);
          $mail->addAddress(strtolower("16.bscs.319@gmail.com"));     // Add a recipient
          // $reply_to_email = "admin@sharebazarexpert.com";
        //   $reply_to_name = "Admin";
        //   if($reply_to_email) {
        //     $mail->addReplyTo($reply_to_email, $reply_to_name);
        // }
          // if(isset($message['attachment']))
          //     $mail->AddAttachment($message['attachment']);
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = 'Testing';
          $mail->Body    = $msg;
          $mail->AltBody = '';
          if(!$mail->send()) {
              die("here");
              return 0;
          } else {
            die("Success");
              return 1;
          }

    // }


?>