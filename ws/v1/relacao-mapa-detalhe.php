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

if(isset($obj["id_mapa"])) {

    $sql    = "SELECT * FROM cn_mapas_testamentos WHERE id = ".$obj["id_mapa"].";";
    $query  = $dba->query($sql);
    $vet    = $dba->fetch($query);

    $result = [];

    $sqlImport      = "SELECT Quantidade, TestamentoImportacaoId FROM TestamentoImportacao WHERE MapasDeTestamentosId = ".$obj["id_mapa"].";";
    $queryImport    = $dba->query($sqlImport);
    $qtdImport      = $dba->rows($queryImport);
    $quantidade     = 0;
    if ($qtdImport > 0) {
        for ($i = 0; $i < $qtdImport; $i++) {
            $vetImport      = $dba->fetch($queryImport);

            if(!is_null($vetImport) && isset($vetImport['Quantidade'])) {
                $quantidade = $quantidade + $vetImport['Quantidade'];
            }
            
            if(!is_null($vetImport['TestamentoImportacaoId'])) {
                $sqlTestamento      = "SELECT 
                    t.id,
                    t.Data AS testamento_data,
                    t.Nome AS testador,
                    t.Livro AS testamento_livro,
                    t.LivroComplemento,
                    t.Folha AS testamento_folha,
                    t.FolhaComplemento,
                    t.DataNascimento, 
                    t.Cpf,
                    t.NomePai, 
                    t.NomeMae,
                    t.Numero, 
                    t.Observacoes 
                FROM cn_testamentos t
                WHERE t.TestamentoImportacaoId = ".$vetImport['TestamentoImportacaoId'].";";
                $queryTestamento    = $dba->query($sqlTestamento);
                $qtdTestamento      = $dba->rows($queryTestamento);
                if ($qtdTestamento > 0) {
                    for ($i = 0; $i < $qtdTestamento; $i++) {
                        $vetTestamento = $dba->fetch($queryTestamento);
                        $result[] = $vetTestamento;
                    }
                }
            }

        }
    }

    $return = array("ok" => true, "msg" => $vet, "testamentoQtd" => $quantidade, "testamento" => $result);
}

header('Content-Type: application/json');
echo json_encode($return);
