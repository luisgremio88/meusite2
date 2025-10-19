<?php

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

$obj   = json_decode($json); // var_dump($obj);

if ($obj === null) {
    $array = array("error" => "true", "type" => "format_json", "msg" => "format_json");
    header('Content-Type: application/json');
    echo json_encode($array);
    exit;
};

if (
    empty($obj->tipoTestamento) ||
    empty($obj->data) ||
    empty($obj->nome) ||
    empty($obj->cpf) ||
    empty($obj->dataNascimento) ||
    empty($obj->nomeMae) ||
    empty($obj->nomePai) ||
    empty($obj->numeroAto) ||
    empty($obj->livro) ||
    empty($obj->complementoLivro) ||
    empty($obj->folha) ||
    empty($obj->complementoFolha)
) {
    $array = array("error" => "true", "msg" => "Todos os campos são obrigatórios");
    header('Content-Type: application/json');
    echo json_encode($array);
    exit;
} else {
    $idUsuario = $obj->idUsuario;
    $tipoTestamento = $obj->tipoTestamento;
    $data = $obj->data;
    $nome = $obj->nome;
    $cpf = $obj->cpf;
    $dataNascimento = $obj->dataNascimento;
    $nomeMae = $obj->nomeMae;
    $nomePai = $obj->nomePai;
    $numeroAto = $obj->numeroAto;
    $livro = $obj->livro;
    $complementoLivro = $obj->complementoLivro;
    $folha = $obj->folha;
    $complementoFolha = $obj->complementoFolha;
    $observacoes = $obj->observacoes;

    $sql   = "INSERT INTO `cn_testamentos`(`id_tabelionato`, `tipo_testamento`, `data_testamento`, `cpf`, `nome`, `data_nascimento`, `nome_mae`, `nome_pai`, `numero_ato`, `livro`, `livro_complemento`, `folha`, `folha_complemento`, `observacoes`) VALUES ('$idUsuario','$tipoTestamento', '$data', '$cpf', '$nome', '$dataNascimento', '$nomeMae', '$nomePai', '$numeroAto', '$livro', '$complementoLivro', '$folha', '$complementoFolha', '$observacoes')";

    $query = $dba->query($sql);

    $array = array("success" => "true", "msg" => "Testamentos incluídos com sucesso!");
    header('Content-Type: application/json');
    echo json_encode($array);
    exit;
};

header('Content-Type: application/json');
echo json_encode($array);
