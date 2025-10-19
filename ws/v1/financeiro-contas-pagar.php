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

if(isset($obj["id_tabelionato"])) {

    $sql    = "SELECT
        cr.descricao,
        cr.data_vcto,
        cr.valor,
        cr.status,
        cr.recebimento_tipo,
        cr.id_boleto 
    FROM cn_contas_pagar_receber cr
    JOIN cn_usuarios_associados u ON u.id = cr.usuario_id 
    JOIN cr_tabelionatos_associados t ON t.id = u.TabelionatoVinculadoId 
    WHERE u.TabelionatoVinculadoId = ".$obj["id_tabelionato"]."
    ORDER BY cr.id DESC;";

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
