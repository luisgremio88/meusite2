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

if(isset($obj["ficha_id"])) {

    $sql    = "SELECT 
        efp.id AS ficha_participante_id,
        efp.nome,
        efp.cpf,
        ept.id AS tipo_id,
        ept.nome AS tipo,
        epts.id AS tipo_sub_id,
        epts.nome AS tipo_sub,
        ep.id AS participante_id 
    FROM cn_evento_ficha_participante efp
    JOIN cn_evento_participante ep ON ep.id = efp.participante_id
    JOIN cn_evento_participante_tipo ept ON ept.id = ep.tipo_id
    JOIN cn_evento_participante_tipo_sub epts ON epts.id = ep.tipo_sub_id
    WHERE efp.ficha_id = ".$obj["ficha_id"]."
    ORDER BY efp.id;";

    $query  = $dba->query($sql);
    $qntd   = $dba->rows($query);
    $result = [];
    if ($qntd > 0) {
        for($a=0; $a<$qntd; $a++) {
            $vet        = $dba->fetch($query);
            $result[]   = $vet;
        }
    }
    $return = array("ok" => true, "msg" => $result);
}

header('Content-Type: application/json');
echo json_encode($return);
