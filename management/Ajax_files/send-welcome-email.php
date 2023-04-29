<?php 
    include('../connection/dbconnection_crm.php');
    if(isset($_GET['id']) && $_GET['id'] != ''){
        $id = $_GET['id'];
        $sel = "SELECT Email_ID,PackageName,Activation_Date,Exp_Date,Full_Name FROM Customer_profile WHERE id = '".$id."'";
        $qry = mysqli_query($connect,$sel);
        $fetch = mysqli_fetch_assoc($qry);
        $email = $fetch['Email_ID'];
        
        $sel_op = "SELECT Sales_Email,Welcome_Mail_Template FROM Options WHERE Id = 1";
        $qry_op = mysqli_query($connect,$sel_op);
        $fetch_op = mysqli_fetch_assoc($qry_op);
        $template = $fetch_op['Welcome_Mail_Template'];
        
        $vars = array(
                '{{CUSTOMER_NAME}}'=>$fetch['Full_Name'],
                '{{PACKAGE_NAME}}'=>$fetch['PackageName'],
                '{{ACTIVATION_DATE}}'=>date('d M Y',strtotime($fetch['Activation_Date'])),
                '{{EXP_DATE}}'=>date('d M Y',strtotime($fetch['Exp_Date']))
            );
        foreach($vars as $key => $val){
            $template = str_replace($key,$val,$template);
        }
       // echo $template;
        sendEmail($email,$template,$id);
        header('location:'.$_SERVER['HTTP_REFERER']);
    }
    
    function sendEmail($to,$message,$id){
        global $connect;
        $sel = "select Sales_Email,Info_Email,Support_Email from Options where Id = 1";
        $qry = mysqli_query($connect,$sel);
        $fetch = mysqli_fetch_assoc($qry);
        $Sales_Email = $fetch['Sales_Email'];
        $Info_Email = $fetch['Info_Email'];
        $Support_Email = $fetch['Support_Email'];
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$Sales_Email.'>' . "\r\n";
        $headers .= 'Cc: '.$Sales_Email . "\r\n";
        $headers .= 'Cc: '.$Info_Email . "\r\n";
        $subject = "Welcome";
        if($mail = mail($to,$subject,$message,$headers)){
            $upd = "UPDATE Customer_profile SET Welcome_Mail = 'Sent' WHERE id = '".$id."'";
            mysqli_query($connect,$upd);
            return true;
        }
    }
    
?>