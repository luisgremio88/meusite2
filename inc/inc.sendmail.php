<?php
include_once(__DIR__.'/phpmailer/PHPMailerAutoload.php');
function sendMail($destino, $assunto, $mensagem) 
{
    /* Envia email de notificação */
    $mail = new PHPMailer;
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.colnotrs.app.br';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'contato@colnotrs.app.br';               // SMTP username
    $mail->Password = 'xxxxxxxx';                        // SMTP password
    $mail->SMTPSecure = false;                            // Define se é utilizado SSL/TLS - Mantenha o valor "false"
    $mail->SMTPAutoTLS = false;                           // Define se, por padrão, será utilizado TLS - Mantenha o valor "false"
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->setFrom('noreply@colnotrs.app.br', 'ColNotRS');
    $mail->addAddress($destino);                          // Name is optional
    // $mail->addReplyTo('contato@odix.com.br');
    $mail->isHTML(true);                                   // Set email format to HTML
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $assunto;
    $mail->Body    = $mensagem; 
    $send = $mail->send();
    
    if ($send) {
        return true;
    } else {
        return false;
    }
}

?>