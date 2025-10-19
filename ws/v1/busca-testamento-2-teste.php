<?php

$url  = "https://www.colnotrs.app.br/ws/v1/busca-testamento-2.php";

$data = [
    "tabelionato_id"=> "1041",
	"cliente_id"    => "5",
    "nome"          => "DANIEL TESTE DA COSTA",
    "cpf"           => "95725318087",
    "email"         => "daniel@dedstudio.com.br",
    "cep"           => "90035141",
    "endereco"      => "RUA FELIPE CAMARÃO",
    "complemento"   => "",
    "bairro"        => "Cristal",
    "telefone"      => "5130578100",
    "municipio"     => "Porto Alegre",
    "estado"        => "RS"
];

$json   = json_encode($data);
$ch     = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
   'Content-Type: application/json',
   'Content-Length: ' . strlen($json))
);
$result = curl_exec($ch);
curl_close ($ch);
$resultArray = json_decode($result, true);

echo '<pre>';
var_dump($result);
var_dump($resultArray);
echo '</pre>';
