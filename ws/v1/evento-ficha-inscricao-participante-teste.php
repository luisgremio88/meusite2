<?php

$url  = "https://www.colnotrs.app.br/ws/v1/evento-ficha-inscricao-participante.php";

$data = [
    "ficha_id"              => 1,
    "participante_id"       => 13,
    "nome"                  => "Estudante 1",
    "cpf"                   => "32111111111",
    "endereco"              => "Rua das beneditas 11, JOÃO PESSOA",
    "telefone"              => "51999999998",
    "email"                 => "estudante1@gmail.com.br"
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
