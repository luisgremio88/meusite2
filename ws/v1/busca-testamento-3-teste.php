<?php

$url  = "https://www.colnotrs.app.br/ws/v1/busca-testamento-3.php";

$data = [
	"busca_id"      => "21",
	"cliente_id"    => "5",
    "nome"          => "Maria de lourdes lopes dos santos",
    "cpf"           => "07739567000",
    "falecido"      => "1",
    "data"           => "2000-01-05",
    "livro"         => "17",
    "folha"         => "12",
    "numero"        => "1",
    "observacoes"   => "Testando"
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
