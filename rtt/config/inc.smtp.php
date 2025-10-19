<?php
require_once('../../inc/inc.autoload.php');
require_once('../../inc/inc.globals.php');
require_once('../config/inc.functions.php');

showObject($_ENV);

$smtp_host = $_ENV['SMTP_HOST'];
$smtp_user = $_ENV['SMTP_USER'];
$smtp_pass = $_ENV['SMTP_PASS'];

function smtpMail($email, $subject, $message) 
{
    //INI - enviar código de ativacao por email
    $body = '{
                "api_user": "'.$smtp_user.'",
                "api_key" : "'.$smtp_pass.'",
                "to":
                    [{
                    "email": "'.$email.'"
                    }]
                ,
                "from": 
                {
                    "name": "Jobx - Anúncios",
                    "email": "contato@jobx.com.br",
                    "reply_to": "contato@jobx.com.br"
                }
                ,
                "subject": "'.$subject.'",
                "html": "'.$message.'"
            }';
    $head = array(
                'Content-Type:application/json' , 
                'Content-Length:'.strlen($body) , 
                'Accept: text/json'
            );
    $api = new ApiRest($smtp_host);
    $res = $api->post($body, $head); 
    $vetres = json_decode($res); 
    //FIM - enviar código de ativacao por email
}
?>