<?php

$url  = "https://www.colnotrs.app.br/ws/v1/evento-ficha-inscricao.php";

$data = [
    "evento_id"                         => 1,
    "tabelionato_id"                    => 0,
    "participante_id"                   => 13,
    "responsavel_nome"                  => "Neoclácio da Silva",
    "responsavel_cpf"                   => "11111111111",
    "responsavel_endereco"              => "Rua das alegrias",
    "responsavel_telefone"              => "51999999999",
    "responsavel_email"                 => "neoclacio.silva@gmail.com.br",
    "responsavel_endereco_numero"       => "1",
    "responsavel_endereco_complemento"  => "12",
    "responsavel_bairro"                => "Cristal",
    "responsavel_municipio"             => "Porto Alegre",
    "responsavel_uf"                    => "RS",
    "responsavel_cep"                   => "91820030",
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
