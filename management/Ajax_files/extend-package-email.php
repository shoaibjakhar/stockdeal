<?php 
    include('../connection/dbconnection_crm.php');
    if(isset($_GET['id']) && $_GET['id'] != ''){
        $id = $_GET['id'];
        $sel = "SELECT Full_Name,Email_ID,PackageName,Activation_Date,Exp_Date,Paid_Amout,Costumer_ID FROM Customer_Payment_History WHERE id = '".$id."'";
        $qry = mysqli_query($connect,$sel);
        $fetch = mysqli_fetch_assoc($qry);
        $email = $fetch['Email_ID'];
        $reD_id= $fetch['Costumer_ID'];

        $sel1 = "SELECT Full_Name,Email_ID,PackageName,Activation_Date,Exp_Date,SUM(Paid_Amout) AS total_paid ,Costumer_ID FROM Customer_Payment_History WHERE Costumer_ID = '".$reD_id."'";
        $qry1 = mysqli_query($connect,$sel1);
        $fetch1 = mysqli_fetch_assoc($qry1);
        $total_paid = $fetch1['total_paid'];
        
        $sel_op = "SELECT Sales_Email,Trading_Guidence_Mail_Template FROM Options WHERE Id = 1";
        $qry_op = mysqli_query($connect,$sel_op);
        $fetch_op = mysqli_fetch_assoc($qry_op);
        $template = $fetch_op['Trading_Guidence_Mail_Template'];
        
        $vars = array(
                '{{CUSTOMER_NAME}}'=>$fetch['Full_Name'],
                '{{PACKAGE_NAME}}'=>$fetch['PackageName'],
                '{{PAID_AMOUNT}}'=>$total_paid,
                '{{ACTIVATION_DATE}}'=>date('d M Y',strtotime($fetch['Activation_Date'])),
                '{{EXP_DATE}}'=>date('d M Y',strtotime($fetch['Exp_Date'])),
                '{{logo}}' =>'../images/RSI-Login-Logo.png'
            );
        foreach($vars as $key => $val){
            $template = str_replace($key,$val,$template);
        }
  
        sendEmail($email,$template,$id,$reD_id);
       
     
    }
    
    function sendEmail1($to,$message,$id){
        global $connect;
        $sel = "select Extend_Package_Email_Subject,Sales_Email,Info_Email,Support_Email from Options where Id = 1";
        $qry = mysqli_query($connect,$sel);
        $fetch = mysqli_fetch_assoc($qry);
        $Sales_Email = $fetch['Sales_Email'];
        $Info_Email = $fetch['Info_Email'];
        
        
        $Support_Email = $fetch['Support_Email'];
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$Sales_Email.'>' . "\r\n";
        $headers .= 'Cc: '.$Info_Email . "\r\n";
        $subject = $fetch['Extend_Package_Email_Subject'];

        
        if($mail = mail($to,$subject,$message,$headers)){
            //  $upd = "UPDATE Customer_profile SET Trading_Guidence_Mail = 'Sent' WHERE id = '".$id."'";
            //  mysqli_query($connect,$upd);
            return true;
        }
    }
    function sendEmail($to,$message,$id,$reD_id)
    {
        require("class.phpmailer.php");

        $mail = new PHPMailer;
        
        global $connect;
        $sel = "select Extend_Package_Email_Subject,Sales_Email,Info_Email,Support_Email from Options where Id = 1";
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
        
        $mail->Subject =$fetch['Extend_Package_Email_Subject'];
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if(!$mail->Send()) {
        	print_r($mail);
           echo 'Message could not be sent.';
           echo 'Mailer Error: ' . $mail->ErrorInfo;
           exit;
        }
        
         $upd = "UPDATE Customer_Payment_History SET Trading_Guidence_Mail = 'Sent' WHERE id = '".$id."'";
         mysqli_query($connect,$upd);
            return header("Location: ../customer-profile-payment-history-new.php?cust=".$reD_id);
     
    }
    
?>