<?php
$rdir = str_replace("\\", "/", __DIR__);                    //Root Dir
require $rdir . '/phpmailer/src/Exception.php';
require $rdir . '/phpmailer/src/PHPMailer.php';
require $rdir . '/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($template, $subject, $to)
{
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mianameer998@gmail.com';
    $mail->Password = 'cthsovvemenxjptm';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom("mianameer998@gmail.com");
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $template;
    $mail->MsgHTML($template);
    if ($mail->send()) {
        return array('Status'=>200,"Message"=>"Email Sent Successfully");
    } else {
        return array('Status'=>400,"Message"=>"$mail->ErrorInfo");
    }
}
