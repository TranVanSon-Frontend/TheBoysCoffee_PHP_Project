<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;

// require "../Mailer/src/PHPMailer.php";
// require "../Mailer/src/SMTP.php";
// require "../Mailer/src/Exception.php";

function Sentmail($email, $sub, $name, $message){
    $mail = new PHPMailer(true);
    try {
        // Cấu hình SMTP
        $mail->isSMTP();                                           
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'hugiason16@gmail.com';                     
        $mail->Password   = 'colxtkenbzgnfskv';                               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
        $mail->Port       = 465;  
        
        $mail->CharSet = 'UTF-8';
        // Người gửi
        $mail->setFrom('hugiason16@gmail.com', 'KeHuyDietDarkDecember');
        
        // Người nhận
        $mail->addAddress($email, $name); 
        
        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = $sub;
        $mail->Body    = $message;
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}

//  Sentmail("phevatthienha16@gmail.com","I am here","SOn","day la mot dieu gi do");




// try {
  
                 

//     //Recipients
   
//        //Add a recipient
//     $mail->addAddress('ellen@example.com');               //Name is optional
//     $mail->addReplyTo('info@example.com', 'Information');
//     $mail->addCC('cc@example.com');
//     $mail->addBCC('bcc@example.com');

//     //Attachments
//     $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//     $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

//     //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  
//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }