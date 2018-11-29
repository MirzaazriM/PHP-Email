<?php

require __DIR__ . "/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// NOTE in order this code to work our email from which we sending emails must be set to allow access to less secure apps
// follow this link to do that https://support.google.com/a/answer/6260879
// 2 way verification must be enabled to use it (to get code to use inside PHP script)

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp-mail.outlook.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'mirzaoglecevac@hotmail.com';                 // SMTP username
    $mail->Password = '';                   // Password of the account from which emails are sended (in this case it is hashed) dcqbsysyfysjgtau
    $mail->SMTPSecure = 'tls';                             // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    // Recipients
    $mail->setFrom('mirzaoglecevac@hotmail.com', 'SmartLab');
    $mail->addAddress('mirzao@smartlab.ba', 'Receiver');     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Test message subject';
    $mail->Body    =  file_get_contents("email_template.html");
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';  // if mail provider blocks HTML content set alternative body with no HTML
    $mail->addAttachment("stadion.jpeg", "Stadion Image");

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}