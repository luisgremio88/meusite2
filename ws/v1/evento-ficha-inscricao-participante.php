<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

//ini_set('display_errors', 1);

include('../../admin/inc/inc.configdb.php');
include('../../admin/inc/inc.lib.php');

$json  	= file_get_contents('php://input');
$obj   	= json_decode($json, true); // var_dump($obj);
$return = ["ok" => false, "msg" => "Parâmetros inválidos."];

if(isset($obj["ficha_id"], $obj["participante_id"], $obj["nome"], $obj["cpf"], $obj["endereco"], $obj["telefone"], $obj["email"])) {

    $sqlInsert = "INSERT INTO cn_evento_ficha_participante(
        ficha_id, 
        participante_id,
        nome, 
        cpf,
        endereco,
        telefone,
        email
    ) VALUES(
        '".$obj["ficha_id"]."', 
        '".$obj["participante_id"]."', 
        '".$obj["nome"]."', 
        ".$obj["cpf"].",
        '".$obj["endereco"]."', 
        '".$obj["telefone"]."', 
        '".$obj["email"]."'
    );";

    $dba->query($sqlInsert);
    $id = $dba->lastid();
    $return = array("ok" => true, "msg" => ["id_ficha_participante" => $id]);
}

header('Content-Type: application/json');
echo json_encode($return);
