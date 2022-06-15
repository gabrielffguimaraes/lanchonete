<?php
header('Content-type: text/html; charset=utf-8');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email {
    public function __construct() {}

    public function send($emailReceiver,$recoverCode) {
        $enviroments = require __DIR__.'./../../app/enviroments.php';

        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = "smtp.gmail.com";
        $email->SMTPAuth = "true";
        $email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $email->Port ="465";
        $email->IsHTML(true);
        $email->Username = "lanchonete.tcc@gmail.com";
        $email->Password = "wdwrbeaprkghydos";
        $email->Subject = utf8_decode("Código de recuperação de senha .");
        $email->setFrom($emailReceiver);
        //$email->addStringAttachment(file_get_contents("https://quickchart.io/qr?text=Here%27s%20my%20text"), "qr.jpg");
        $email->Body =
            utf8_decode("Link para alteração de senha abaixo :<br/>{$enviroments['url']}recover?token=$recoverCode");
        $email->addAddress($emailReceiver);
        $resultado = false;
        if($email->Send()){
            $resultado = 1;
        }else{
            $resultado = false;
        }
        $email->smtpClose();
        return $resultado;
    }
}
