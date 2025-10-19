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

$json  	    = file_get_contents('php://input');
$obj   	    = json_decode($json, true); // var_dump($obj);
$return     = ["ok" => false, "msg" => "Parâmetros inválidos."];
$inputFail  = false;

if(isset($obj["busca_id"], $obj["cliente_id"], $obj["nome"], $obj["cpf"], $obj["falecido"], $obj["data"], $obj["livro"], $obj["folha"], $obj["numero"], $obj['observacoes'])) {

    if (empty($obj['nome']) || strlen($obj['nome']) < 5) {
        $return     = array("ok" => false, "msg" => "Nome inválido!");
        $inputFail  = true;
    } 

    if (!empty($obj['cpf'])) {
        if(!validaCPF($obj['cpf'])) {
            $return     = array("ok" => false, "msg" => "CPF inválido!");
            $inputFail  = true;
        }
    }

    if($obj['falecido'] == '1') {
        if (empty($obj['data'])) {
            $return     = array("ok" => false, "msg" => "Data do óbito inválido!");
            $inputFail  = true;
        }
        if (empty($obj['livro'])) {
            $return     = array("ok" => false, "msg" => "Livro inválido!");
            $inputFail  = true;
        }
        if (empty($obj['folha'])) {
            $return     = array("ok" => false, "msg" => "Folha inválido!");
            $inputFail  = true;
        }
        if (empty($obj['numero'])) {
            $return     = array("ok" => false, "msg" => "Número inválido!");
            $inputFail  = true;
        }
    }

    if(!$inputFail) {

        $cpf        = str_replace(array('.','-','/'), "",trim($cpf));

        //update dos dados
        $sql = "UPDATE cn_busca_testamentos SET 
            data_falecimento='".$obj['data_falecimento']."', 
            cpf='".$obj['cpf']."', 
            nome='".$obj['nome']."', 
            livro='".$obj['livro']."', 
            folha='".$obj['folha']."', 
            observacoes='".$obj['observacoes']."', 
            status='0', 
            falecido='".$obj['falecido']."'
        WHERE id = '".$obj['busca_id']."'"; //die($sql);
        $dba->query($sql);
        $return = array("ok" => true, "msg" => ["busca_id" => $obj['busca_id'], "cliente_id" => $obj['cliente_id']]);
    }

}

header('Content-Type: application/json');
echo json_encode($return);
