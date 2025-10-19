<?php

$url  = "https://www.colnotrs.app.br/ws/v1/relacao-testamento.php";

$data = [
	"id_tabelionato"    => "1243",
    "limit"             => 50,
    "offset"            => 0,
    // "cpf_pesquisa"      => "07739567000",
    // "nome_pesquisa"     => "Maria de lourdes lopes dos santos"
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
