<?php
//INI - envio de email API SMTP IAGENTE
function sendSmtp($destino, $assunto, $mensagem) 
{
    $smtp_host = 'api.iagentesmtp.com.br/api/v3/send/';
    $smtp_user = 'contato@odix.com.br';
    $smtp_pass = 'xxxxxxxxxxxxxxxxxxxxxx';

    $body = '{
                "api_user": "'.$smtp_user.'",
                "api_key" : "'.$smtp_pass.'",
                "to":
                    [{
                    "email": "'.$destino.'"
                    }]
                ,
                "from": 
                {
                    "name": "ColNotRS",
                    "email": "contato@colnotrs.app.br",
                    "reply_to": "contato@colnotrs.app.br"
                }
                ,
                "subject": "'.$assunto.'",
                "html": "'.$mensagem.'"
            }';
    $head = array(
                'Content-Type:application/json' , 
                'Content-Length:'.strlen($body) , 
                'Accept: text/json'
            );
    
    $vetres = array();
    try {
        $api = new ApiRest($smtp_host);
        $res = $api->post($body, $head); 
        $vetres = json_decode($res); 
    } 
    catch(Exception $ex) {
        $vetres[0] = $ex->getMessage();
    }

    return $vetres;
}
//FIM - envio de email API SMTP IAGENTE