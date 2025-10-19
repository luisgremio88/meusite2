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

if(isset($obj["id_tabelionato"], $obj["id_mapa"])) {
    $result             = false;
    $remove             = 0;
    $countImportacao    = 0;
    $countTestamento    = 0;

    $sqlImportacao    = "SELECT TestamentoImportacaoId FROM TestamentoImportacao WHERE MapasDeTestamentosId = ".$obj["id_mapa"]." AND TabelionatoId = ".$obj["id_tabelionato"].";";
    $queryImportacao  = $dba->query($sqlImportacao);
    $countImportacao   = $dba->rows($queryImportacao);

    if ($countImportacao > 0) {
        for($a=0; $a<$countImportacao; $a++) {
            $vetImportacao          = $dba->fetch($queryImportacao);
            $TestamentoImportacaoId = $vetImportacao['TestamentoImportacaoId'];
            $sqlTestamento          = "SELECT * FROM cn_testamentos WHERE TestamentoImportacaoId = ".$TestamentoImportacaoId." AND TabelionatoId = ".$obj["id_tabelionato"].";";
            $queryTestamento        = $dba->query($sqlTestamento);
            $countTestamento        = $countTestamento + $dba->rows($queryTestamento);
            if ($countTestamento > 0) {
                for($b=0; $b<$countTestamento; $b++) {
                    $vetTestamento  = $dba->fetch($queryTestamento);
                    $TestamentoId   = $vetTestamento['id'];
                    $sqlDeleteTestamento = "DELETE FROM cn_testamentos WHERE TestamentoImportacaoId = ".$TestamentoImportacaoId." AND TabelionatoId = ".$obj["id_tabelionato"].";";
                    if($dba->query($sqlDeleteTestamento) == 1) {
                        $remove++;
                    }
                }
            }
            $sqlDeleteImportacao = "DELETE FROM TestamentoImportacao WHERE MapasDeTestamentosId = ".$obj["id_mapa"]." AND TabelionatoId = ".$obj["id_tabelionato"].";";
            if($dba->query($sqlDeleteImportacao) == 1) {
                $remove++;
            }
        }
    }

    if(($countImportacao+$countTestamento) === $remove) {
        $result = true;
    }

    $return = array("ok" => true, "msg" => $result);
}

header('Content-Type: application/json');
echo json_encode($return);
