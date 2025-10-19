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

//include('./auth.php');
include('../../admin/inc/inc.configdb.php');
include('../../admin/inc/inc.lib.php');

$json  	= file_get_contents('php://input');
$obj   	= json_decode($json, true); // var_dump($obj);
$return = array("ok" => false, "msg" => "Parâmetros inválidos.");

if ($obj === null) {
    $return = array("ok" => false, "msg" => "Formato JSON inválido.");
    header('Content-Type: application/json');
    echo json_encode($return);
    exit;
}

if (isset($obj['id_tabelionato']) && !empty($obj['id_tabelionato'])) 
{
    $id_tabelionato = $obj['id_tabelionato'];
    
    $cpf_pesquisa = '%';
    if (isset($obj['cpf_pesquisa']) && !empty($obj['cpf_pesquisa'])) {
        $cpf_pesquisa = $obj['cpf_pesquisa'];
    }
    $nome_pesquisa = '%';
    if (isset($obj['nome_pesquisa']) && !empty($obj['nome_pesquisa'])) {
        $nome_pesquisa = $obj['nome_pesquisa'];
    }

    //lista os testamentos
    $sqltes = "select t.data, t.nome as nome_testador, t.cpf as cpf_testador, t.livro, t.folha
                from cn_testamentos t
                where 
                t.TabelionatoId = '$id_tabelionato' and 
                t.nome like '%$nome_pesquisa%' and 
                t.cpf like '%$cpf_pesquisa%' ";
    $restes = $dba->query($sqltes);
    $qtdtes = $dba->rows($restes);
    if ($qtdtes > 0) {
        $vettmp = array();
        for ($i=0; $i<$qtdtes; $i++) {
            $vettes = $dba->fetch($restes);
            array_push($vettmp, $vettes);
        }
        $return = array("ok" => true, "msg" => $vettmp);
    }
    else {
        $return = array("ok" => true, "msg" => "Nenhum registro encontrado.");
    }
} 
else 
{
    $return = array("ok" => false, "msg" => "Parâmetros inválidos.");
}

// error_log(json_encode($_SERVER));
header('Content-Type: application/json');
echo json_encode($return);
?>