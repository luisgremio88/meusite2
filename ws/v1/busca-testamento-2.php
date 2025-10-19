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
$idCliente  = 0; 
if(isset($obj["tabelionato_id"], $obj["cliente_id"], $obj["cpf"], $obj["nome"], $obj["email"], $obj["telefone"], $obj["cep"], $obj["endereco"], $obj["complemento"], $obj["bairro"], $obj["municipio"], $obj["estado"])) {

    $idCliente = 0;

    if (empty($obj['nome']) || strlen($obj['nome']) < 5) {
        $return     = array("ok" => false, "msg" => "Nome inválido!");
        $inputFail  = true;
    } 

    if (empty($obj['cpf']) || !validaCPF($obj['cpf'])) {
        $return     = array("ok" => false, "msg" => "CPF inválido!");
        $inputFail  = true;
    }

    if (empty($obj['cep'])) {
        $return     = array("ok" => false, "msg" => "CEP inválido!");
        $inputFail  = true;
    }

    if (empty($obj['endereco'])) {
        $return     = array("ok" => false, "msg" => "Endereço inválido!");
        $inputFail  = true;
    }

    if (empty($obj['bairro'])) {
        $return     = array("ok" => false, "msg" => "Bairro inválido!");
        $inputFail  = true;
    }

    if (empty($obj['municipio'])) {
        $return     = array("ok" => false, "msg" => "Município inválido!");
        $inputFail  = true;
    }
    
    if (empty($obj['estado'])) {
        $return     = array("ok" => false, "msg" => "UF inválido!");
        $inputFail  = true;
    }

    if (empty($obj['email'])) {
        $obj["email"] = 'teste@cnbrs.gov.br';
    }

    if(!$inputFail) {

        $sqlMuni    = "SELECT MunicipioId FROM cn_municipio cm WHERE nome = '".$obj['municipio']."'";
        $queryMuni  = $dba->query($sqlMuni);
        $vetMuni    = $dba->fetch($queryMuni);
        $idMuni     = $vetMuni['MunicipioId'];

        if (empty($obj["cliente_id"]) || $obj["cliente_id"] == 0) { // CADASTRAR USUÁRIO

            $sql = "INSERT INTO cn_clientes (
                Endereco,
                Complemento,
                Bairro,
                Cep,
                Telefone,
                Nome,
                Cpf,
                Email,
                MunicipioId,
                Numero
            ) VALUES (
                '".$obj['endereco']."',
                '".$obj['complemento']."',
                '".$obj['bairro']."',
                '".$obj['cep']."',
                '".$obj['telefone']."',
                '".$obj['nome']."',
                '".$obj['cpf']."',
                '".$obj['email']."',
                '".$idMuni."',
                '0'
            )";
            $dba->query($sql);
            $idCliente = $dba->lastid();

        } else { // EDITAR USUÁRIO
            
            $idCliente = $obj["cliente_id"];

            $sql = "UPDATE cn_clientes SET 
                Endereco='".$obj['endereco']."',
                Complemento='".$obj['complemento']."',
                Bairro='".$obj['bairro']."',
                Cep='".$obj['cep']."',
                Telefone='".$obj['telefone']."',
                Nome='".$obj['nome']."',
                Cpf='".$obj['cpf']."',
                Email='".$obj['email']."',
                MunicipioId=$idMuni,
                Numero='0'
            WHERE ClienteId = ".$idCliente.";";
            $dba->query($sql);

        }

        $BuscaAntariorId    = 0;
        $BuscaAntarior      = 0;

        $sql    = "INSERT INTO cn_busca_testamentos (id_cliente, reconsulta, id_busca_anterior, id_tabelionato) VALUES ('$idCliente', $BuscaAntarior, '$BuscaAntariorId', ".$obj["tabelionato_id"].")";
        $dba->query($sql);

        $sql2   = "SELECT id FROM cn_busca_testamentos ORDER BY id DESC LIMIT 1";
        $query2 = $dba->query($sql2);
        $vet    = $dba->fetch($query2);
        $return = array("ok" => true, "msg" => ["busca_id" => $vet['id'], "cliente_id" => $idCliente]);
    }

}

header('Content-Type: application/json');
echo json_encode($return);
