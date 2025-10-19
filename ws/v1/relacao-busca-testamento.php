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

if(isset($obj["id_tabelionato"], $obj["limit"], $obj["offset"])) {

    // $sql    = "SELECT * FROM cn_busca_testamentos WHERE id_tabelionato = ".$obj["id_tabelionado"]." ORDER BY id DESC LIMIT ".$obj["limit"]." OFFSET ".$obj["offset"].";";

    $cpf_pesquisa = '%';
    if (isset($obj['cpf_pesquisa']) && !empty($obj['cpf_pesquisa'])) {
        $cpf_pesquisa = $obj['cpf_pesquisa'];
    }
    $nome_pesquisa = '%';
    if (isset($obj['nome_pesquisa']) && !empty($obj['nome_pesquisa'])) {
        $nome_pesquisa = $obj['nome_pesquisa'];
    }
    $limit = $obj['limit'];
    $offset = $obj["offset"];
    $sql    = "select bt.id, bt.data, bt.nome as nome_testador, bt.cpf as cpf_testador, c.nome as nome_cliente, c.cpf as cpf_cliente
                from cn_busca_testamentos bt
                inner join cn_clientes c on c.ClienteId = bt.id_cliente
                where 
                bt.id_tabelionato = '".$obj["id_tabelionato"]."' and 
                bt.nome like '%$nome_pesquisa%' and 
                bt.cpf like '%$cpf_pesquisa%'
                order by bt.id desc 
                limit $offset, $limit";

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
