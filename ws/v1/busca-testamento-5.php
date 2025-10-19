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

require_once('../../admin/inc/inc.configdb.php');
require_once('../../admin/inc/inc.lib.php');
require_once('../../admin/inc/fpdf/fpdf.php');

$json  	    = file_get_contents('php://input');
$obj   	    = json_decode($json, true); // var_dump($obj);
$return     = ["ok" => false, "msg" => "Parâmetros inválidos."];
$inputFail  = false;

if(isset($obj["busca_id"], $obj["cliente_id"])) {

    $sqlBuscaTestamento     = "SELECT * from cn_busca_testamentos WHERE id = ".$obj["busca_id"].";";
    $queryBuscaTestamento   = $dba->query($sqlBuscaTestamento);
    $vetBuscaTestamento     = $dba->fetch($queryBuscaTestamento);
    $qtdBuscaTestamento     = $dba->rows($queryBuscaTestamento);

    if($qtdBuscaTestamento > 0) {
        $return     = ["ok" => true, "msg" => $vetBuscaTestamento];
    } else {
        $return     = ["ok" => false, "msg" => "Não foi possível retornar a busca, revise os parâmetros."];
    }

}

header('Content-Type: application/json');
echo json_encode($return);