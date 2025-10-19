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

if(isset($obj["cpf"])) {
	if (validaCPF($obj["cpf"])) {

        $cpf = str_replace(array('.', '-', '/'), "", trim($obj["cpf"]));

        // $sql = "SELECT * FROM cn_clientes WHERE Cpf = $cpf";
        $sql = "SELECT 
            c.ClienteId,
            c.Endereco,
            c.Numero,
            c.Complemento,
            c.Bairro,
            c.Cep,
            c.Telefone,
            c.Nome,
            c.Cpf,
            c.Email,
            m.Nome AS municipio,
            e.Sigla AS estado
        FROM cn_clientes AS c
        JOIN cn_municipio AS m ON m.MunicipioId = c.MunicipioId 
        JOIN cn_estado AS e ON e.EstadoId = m.EstadoId  
        WHERE c.Cpf =  $cpf";
        $query = $dba->query($sql);
        $qntd = $dba->rows($query);

        if ($qntd > 0) {
            $vet = $dba->fetch($query);
			$usuario 				= [];
			$usuario['ClienteId'] 	= $vet['ClienteId'];
			$usuario['Nome'] 		= $vet['Nome'];
			$usuario['Cpf'] 		= $vet['Cpf'];
			$usuario['Email'] 		= $vet['Email'];
			$usuario['Cep'] 		= $vet['Cep'];
			$usuario['Endereco'] 	= $vet['Endereco'];
			$usuario['Complemento'] = $vet['Complemento'];
			$usuario['Bairro'] 		= $vet['Bairro'];
			$usuario['Telefone'] 	= $vet['Telefone'];
			$usuario['Municipio'] 	= $vet['municipio'];
			$usuario['Estado'] 		= $vet['estado'];
			$return = array("ok" => true, "msg" => $usuario);

        } else {
            $return = array("ok" => false, "msg" => "Nenhum agendamento encontrado!");
        }
    } else {
		$return = array("ok" => false, "msg" => "CPF inválido!");
	}

}

header('Content-Type: application/json');
echo json_encode($return);
