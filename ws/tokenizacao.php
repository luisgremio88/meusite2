<?php

/**
 * @author			Roberto Rotondo - v 1.0 - mai/2022
 * @description 	
 * @params

 */

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header('Content-type: application/json');
header('X-Content-Type-Options: nosniff');

include('../admin/inc/inc.configdb.php');
include('../admin/inc/inc.lib.php');
include('./auth.php');



// Definir as informações de autenticação
$username = "svc.bnf.homolog";
$password = "CtJ5J";
$apiKey = "675fb311-12d1-3c27-aabb-fc4231a19ddf";

// Definir a URL do endpoint
$url = "https://api.e-unicred.com.br/homolog/oauth2/v2/grant-token";

// Definir o corpo da requisição
$data = array(
    "nomeUsuario" => $username,
    "senha" => $password
);

// Codificar o corpo da requisição em JSON
$data = json_encode($data);

// Definir as opções da requisição
$options = array(
    CURLOPT_URL => $url,
    CURLOPT_HTTPHEADER => array(
        "apiKey: " . $apiKey,
        "Content-Type: application/json"
    ),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data
);

// Inicializar a sessão cURL
$curl = curl_init();

// Definir as opções da sessão cURL
curl_setopt_array($curl, $options);

// Executar a sessão cURL e armazenar a resposta
$response = curl_exec($curl);

// Verificar se houve algum erro na sessão cURL
if(curl_errno($curl)) {
    echo "Erro na requisição: " . curl_error($curl);
}

// Encerrar a sessão cURL
curl_close($curl);

// Exibir a resposta
echo $response.'aaa';