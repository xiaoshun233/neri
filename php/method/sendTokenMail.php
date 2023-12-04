<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/vendor/autoload.php';

function sendtokenMail($email,$mailtitle,$mailmessage){
    try{
        $mail = new PHPMailer();
        //邮件调试模式 //0输出 2调试
        $mail->SMTPDebug = 0;  
        //设置邮件使用SMTP
        $mail->isSMTP();
        // 设置邮件程序以使用SMTP
        $mail->Host = 'smtp.163.com';
        // 设置邮件内容的编码
        $mail->CharSet='UTF-8';
        // 启用SMTP验证
        $mail->SMTPAuth = true;
        // SMTP username
        $mail->Username = 'xiaoshun233@163.com';
        // SMTP password
        $mail->Password = 'xiaos123.';
        // 允许 TLS 或者ssl协议
        $mail->SMTPSecure = 'ssl';  
        // 服务器端口 25 或者465 具体要看邮箱服务器支持                  
        $mail->Port = 465;                           
        //设置发件人
        $mail->setFrom('xiaoshun233@163.com', 'ねりの小窝');
        //添加收件人
        $mail->addAddress($email);     
        //收件人回复的邮箱
        $mail->addReplyTo('xiaoshun233@163.com', 'ねりの小窝');
        // 将电子邮件格式设置为HTML
        $mail->isHTML(true);
        $mail->Subject = $mailtitle;
        $mail->Body = $mailmessage;
        $mail->send();
        return true;
    }catch (Exception $e){
        return false;
    }
}

?>