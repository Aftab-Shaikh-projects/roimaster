<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require '../vendor/autoload.php'; 

if (!function_exists('sendSMTPMail')) {

    function sendSMTPMail($replyToEmail, $replyToName, $subject, $body) {
        
        $smtp_email    = 'nexgenntechnologies.notify@gmail.com'; 
        $smtp_password = 'zuyi rnvk yuxx ntxu';  
        $admin_email   = 'aftabshaikhrs@gmail.com'; 

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';       
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = $smtp_email;            
            $mail->Password   = $smtp_password;         
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            
            $mail->Port       = 587;                                    

            $mail->setFrom($smtp_email, 'ROI Master');
            $mail->addAddress($admin_email);               
            
            if(filter_var($replyToEmail, FILTER_VALIDATE_EMAIL)) {
                 $mail->addReplyTo($replyToEmail, $replyToName);
            }

            $mail->isHTML(true);                                  
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>