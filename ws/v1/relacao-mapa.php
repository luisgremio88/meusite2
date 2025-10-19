<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

ini_set('display_errors', 1);

include('../../admin/inc/inc.configdb.php');
include('../../admin/inc/inc.lib.php');

$json  	= file_get_contents('php://input');
$obj   	= json_decode($json, true); // var_dump($obj);
$return = ["ok" => false, "msg" => "Parâmetros inválidos."];

if(isset($obj["id_tabelionato"], $obj["limit"], $obj["offset"])) {

    $mes_pesquisa = '';
    if (isset($obj['mes_pesquisa']) && !empty($obj['mes_pesquisa'])) {
        $mes_pesquisa = $obj['mes_pesquisa'];
    }
    $ano_pesquisa = '';
    if (isset($obj['ano_pesquisa']) && !empty($obj['ano_pesquisa'])) {
        $ano_pesquisa = $obj['ano_pesquisa'];
    }

    $sql    = "SELECT 
        mt.*, 
        ta.testamento_manual 
    FROM cn_mapas_testamentos mt
    JOIN cr_tabelionatos_associados ta ON ta.id = mt.TabelionatoId  
    WHERE mt.TabelionatoId = ".$obj["id_tabelionato"]." AND
        mt.Ano LIKE '%$ano_pesquisa%' AND mt.Mes LIKE '%$mes_pesquisa%'
    ORDER BY mt.id DESC LIMIT ".$obj["limit"]." OFFSET ".$obj["offset"].";";

// var_dump($sql);

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
