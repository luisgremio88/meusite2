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


$url = 'https://api.e-unicred.com.br/homolog/cobranca/v2/beneficiarios/B7CEE6BDC9E04C49A7437EC3E750140A/titulos';
$headers = array(
    'Authorization: Bearer f9d93dk211394f9d93dk211394f9d93dk211394f9d93dk211394f9d93dk211394f9d93dk211',
    'cooperativa: 0001',
    'apiKey: 675fb311gera-12d13c27aabbfc4231a19ddf',
    'Content-Type: application/json'
);
$data = array(
    'beneficiarioVariacaoCarteira' => 43,
    'seuNumero' => '123',
    'valor' => 100.00,
    'vencimento' => '2017-10-01',
    'nossoNumero' => '00000231444',
    'pagador' => array(
        'nomeRazaoSocial' => 'Fulano de Tal',
        'tipoPessoa' => 'F',
        'numeroDocumento' => '01418014077'
    )
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
curl_close($ch);

echo $response;