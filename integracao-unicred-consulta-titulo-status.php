<?php
include('./admin/inc/class.ApiRest.php');
session_start();

//configs da conta Unicred
$apikey = 'f86f913d-0417-4864-bf8d-241fd9d6df7f';
$codcoo = 9184;
$codben = '162B62923A8B46CFB5E567A23E2D621A';
$codage = 4371;
$codcon = 348473;
$varcon = 38869;
$user = 'svc.bnf.homolog';
$pass = 'uL&CtJ5J';

if (isset($_SESSION['codtit']) && !empty($_SESSION['codtit']) )
{
    $codtit = $_SESSION['codtit'];

    //autenticacao e geracao do token
    $conn = 'https://api.e-unicred.com.br/homolog/oauth2/v2/grant-token';
    $body = '{"nomeUsuario": "'.$user.'", "senha": "'.$pass.'"}';
    $head = array('Content-Type: application/json','Content-Length: '.strlen($body), 'apiKey: '.$apikey);
    $apitok = new ApiRest($conn); 
    $restok = $apitok->post($body, $head); 
    $objtok = json_decode($restok); 
    $token = $objtok->accessToken; 
    //$apitok->info();
    //$vetpay = $apitok->payload($token); 

    //se tem token gera a cobranca, usando o codigo beneficiario (fixo)
    if (isset($token) && !empty($token)) 
    {
        //com o token de acesso E o cod beneficiario, gera a cobrança
        $conn = 'https://api.e-unicred.com.br/homolog/cobranca/v2/beneficiarios/'.$codben.'/titulos/'.$codtit.'/status';
        $head = array(
            'Authorization: Bearer '.$token, 'cooperativa: '.$codcoo,
            'apiKey: '.$apikey,
            'Content-Type: application/json'
        );
        $body = '';
        $apicob = new ApiRest($conn); 
        $rescob = $apicob->get($body, $head); 
        $objcob = json_decode($rescob); 
        
        echo '<pre>';
        print_r($rescob);
        echo '</pre>';

        // echo '<pre>';
        // print_r($objcob);
        // echo '</pre>';
    } 
    else {
        die('Oooopssss');
    }
}
else 
{
    echo '<a href="integracao-unicred.php">Sem status para exibir. Voltar</a>';
}
?>