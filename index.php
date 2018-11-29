<?php

require __DIR__ . "/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.bizmail.yahoo.com';                       // To send email over yahoo SMTP server we need to have business account
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'mirzaoglecevac@yahoo.com';                 // SMTP username
    $mail->Password = '';                   // Password of the account from which emails are sended
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('mirzaoglecevac@yahoo.com', 'SmartLab');
    $mail->addAddress('mirzao@smartlab.ba', 'Receiver');     // Add a recipient

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