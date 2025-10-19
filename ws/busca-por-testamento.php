<?php

/**
 * @author			Roberto Rotondo - v 1.0 - mai/2022
 * @description 	Serviço de login usuário associado
 * @params

 */
// session_start();
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

include('../admin/inc/inc.configdb.php');
include('../admin/inc/inc.lib.php');
include('./auth.php');

$array = array();

$json  = file_get_contents('php://input');

$array = array("error" => "true", "type" => "format_json", "msg" => $json);
echo json_encode($array);
die;

$obj   = json_decode($json);



if ($obj === null) {
    $array = array("error" => "true", "type" => "format_json", "msg" => "format_json");
    header('Content-Type: application/json');
    echo json_encode($array);
    exit;
}

$cpf = !empty($obj->cpf);
$nome = isset($obj->nome);

$cpf_pesquisa = !empty($obj->cpf_pesquisa);
$nome_pesquisa = isset($obj->nome_pesquisa);
$falecido = isset($obj->falecido);

$cep = !empty($obj->cep);
$endereco = isset($obj->endereco);
$numero = isset($obj->numero);
$complemento = isset($obj->complemento);
$bairro = isset($obj->bairro);
$cidade = isset($obj->cidade);
$estado = isset($obj->estado);

if ($cpf && $nome && $cep && $endereco && $numero && $complemento && $bairro && $cidade && $estado) {

    if (true) {

    } else {
        $array = array("error" => "true", "type" => "cpf", "msg" => "Usuário ou senha incorretos! Tente novamente.");
    }
} else {
    $array = array("error" => "true", "type" => "parametros", "msg" => "Parâmetros inválidos.");
}

// error_log(json_encode($_SERVER));

header('Content-Type: application/json');
echo json_encode($array);

// print_r($_SESSION['app_users_token']);