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
    $mail->setLanguage("de", "vendor/phpmailer/language/phpmailer.lang-de.php");

    // Recipients
    $mail->setFrom('mirzaoglecevac@hotmail.com', 'SmartLab');
    $mail->addAddress('mirzao@smartlab.ba', 'Gmail Account 1');     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Test message subject';
    $mail->Body    =  file_get_contents("email_template.html"); // load email bodz from external file
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';  // if mail provider of the reciper blocks HTML content set alternative body with no HTML

    // create zip object
    $zip = new ZipArchive();
    $res = $zip->open('email_attachment.zip', ZipArchive::CREATE);

    // if zip file created successfully
    if ($res === true){

        // set all files from attachment_files folder to the $files variable
        $files = glob("attachment_files/*");
        // loop through all files from the attachment_files folder
        foreach($files as $file){
            // add each file to the zip archive
            $zip->addFile($file);
        }

    // exit script
    } else {
        exit(print_r($res));
    }

    // close zip object so that zip file is created
    $zip->close();

    // set created zip folder as an email attachment
    $mail->addAttachment("email_attachment.zip", "course_files.zip");

    // send email
    $mail->send();

    // delete created zip file
    unlink("email_attachment.zip");

    echo 'Message has been sent';

    // catch any exception if occurs
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}