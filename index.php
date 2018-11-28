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
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'oglecevacmirza@gmail.com';                 // SMTP username
    $mail->Password = 'dcqbsysyfysjgtau';                   // Password of the account from which emails are sended (in this case it is hashed)
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('oglecevacmirza@gmail.com', 'SmartLab');
    $mail->addAddress('mirzaoglecevac@hotmail.com', 'Receiver');     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Test message subject';
    $mail->Body    = '<div style="width: 300px; height: 200px; padding: 10px; font-size: 20px; text-align: center; color: #fff; background-color: green;"> HTML message sent from mirzao@smartlab.ba </div>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';  // if mail provider blocks HTML content set alternative body with no HTML

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}