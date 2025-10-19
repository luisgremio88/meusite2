<?php
/**
 * @author			Roberto Rotondo - v 1.0 - maio/2022
 * @description 	Serviço de cadastro de associados
 * @params

 */

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header('Content-type: application/json');
header('X-Content-Type-Options: nosniff');

include('../admin/inc/inc.configdb.php');
include('../admin/inc/inc.lib.php');
include('../admin/inc/class.ValidaCpfCnpj.php');
include('./auth.php');

$array = array();
$json  = file_get_contents('php://input');
$obj   = json_decode($json); 

if ($obj === null) {
	$array = array("error" => "true", "type" => "format_json", "msg" => "format_json");
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
}

if (empty($obj->nome)){
	$array = array("error" => "true", "type" => "nome", "msg" => "Preencha o Nome corretamente."); 
    header('Content-type: application/json');
    echo json_encode($array);
	exit;
}

// if (empty($obj->funcao)){
// 	$array = array("error" => "true", "type" => "nome", "msg" => "Preencha a Função corretamente."); 
//     header('Content-type: application/json');
//     echo json_encode($array);
// 	exit;
// }

if(empty($obj->data_nascimento) || !validaData($obj->data_nascimento)) {
	$array = array("error" => "true", "type" => "data_nascimento", "msg" => "Preencha a Data de Nascimento corretamente."); 
    header('Content-type: application/json');
    echo json_encode($array);
	exit;
}

if (empty($obj->cpf)) { // Verifica se foi enviado cpf 
	$array = array("error" => "true", "type" => "cpf", "msg" => "Preencha o CPF corretamente."); 
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
}
$cpf = new ValidaCPFCNPJ($obj->cpf); // Cria um objeto sobre a classe
if (!$cpf->valida()) { // Verifica se o CPF é válido
	$array = array("error" => "true", "type" => "cpf_invalido", "msg" => "CPF inválido"); 
    header('Content-type: application/json');
    echo json_encode($array);
	exit;
}
$cpf = preg_replace("/[^0-9]/", "", $obj->cpf); // Retira formatação CPF
//verifica se cpf já está registrado no bd    
$sql2 = "SELECT * FROM cn_usuarios_associados WHERE cpf LIKE '%$cpf%'";
$query2 = $dba->query($sql2);
$qntd2 = $dba->rows($query2);
if ($qntd2 > 0) {
	$array = array("error" => "true", "type" => "cpf_existe", "msg" => "CPF já cadastrado"); 
    header('Content-type: application/json');
    echo json_encode($array);
	exit;
}

// if (empty($obj->rg)){
// 	$array = array("error" => "true", "type" => "nome", "msg" => "Preencha o Documento de Identidade corretamente."); 
//     header('Content-type: application/json');
//     echo json_encode($array);
// 	exit;
// }

// if(empty($obj->data_expedicao) || !validaData($obj->data_expedicao)) {
// 	$array = array("error" => "true", "type" => "data_expedicao", "msg" => "Preencha a Data de Expedição corretamente."); 
//     header('Content-type: application/json');
//     echo json_encode($array);
// 	exit;
// }

// if (empty($obj->orgao_expedicao)){
// 	$array = array("error" => "true", "type" => "nome", "msg" => "Preencha o Órgão de Expedição corretamente."); 
//     header('Content-type: application/json');
//     echo json_encode($array);
// 	exit;
// }

// if (empty($obj->estado_civil)){
// 	$array = array("error" => "true", "type" => "nome", "msg" => "Preencha o Estado Civil corretamente."); 
//     header('Content-type: application/json');
//     echo json_encode($array);
// 	exit;
// }

if(empty($obj->email) || !validaEmail($obj->email)) {
	$array = array("error" => "true", "type" => "email_invalido", "msg" => "Email inválido."); 
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
} 

if (empty($obj->endereco)) {
	$array = array("error" => "true", "type" => "endereco", "msg" => "Preencha o endereço corretamente."); 
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
} 

if (empty($obj->numero)) {
	$array = array("error" => "true", "type" => "numero", "msg" => "Preencha o número corretamente."); 
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
} 

if (empty($obj->bairro)) {
	$array = array("error" => "true", "type" => "bairro", "msg" => "Parâmetro bairro obrigatório."); 
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
} 

if (empty($obj->cep)){
	$array = array("error" => "true", "type" => "cep", "msg" => "Preencha o cep corretamente."); 
    header('Content-type: application/json');
    echo json_encode($array);
	exit;
}

if (empty($obj->cidade)) {
	$array = array("error" => "true", "type" => "cidade", "msg" => "Preencha o cidade corretamente."); 
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
} 

if (empty($obj->uf)) {
	$array = array("error" => "true", "type" => "uf", "msg" => "Preencha a uf corretamente."); 
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
}

if(empty($obj->telefone)) {
	$array = array("error" => "true", "type" => "telefone", "msg" => "Preencha o telefone corretamente."); 
    header('Content-type: application/json');
    echo json_encode($array);
	exit;
}

// if(empty($obj->senha)) {
// 	$array = array("error" => "true", "type" => "senha", "msg" => "Preencha a senha corretamente.");
//     header('Content-type: application/json');
//     echo json_encode($array);
// 	exit;
// } 
// if (!validaSenha($obj->senha)) {
// 	$array = array("error" => "true", "type" => "senha", "msg" => "Senha inválida.");
//     header('Content-type: application/json');
//     echo json_encode($array);
// 	exit;
// }
// if(empty($obj->senha_confirma)) {
// 	$array = array("error" => "true", "type" => "senha_confirma", "msg" => "Informe a senha novamente.");
//     header('Content-type: application/json');
//     echo json_encode($array);
// 	exit;
// }
// if($obj->senha != $obj->senha_confirma) {
// 	$array = array("error" => "true", "type" => "senhas_iguais", "msg" => "As senhas que você digitou não são iguais.");
//     header('Content-type: application/json');
//     echo json_encode($array);
// 	exit;
// }

$id_tabelionato   = strtoupper(addslashes($obj->id_tabelionato));
$nome             = strtoupper(addslashes($obj->nome));
$funcao           = strtoupper(addslashes($obj->funcao));
$data_nascimento  = dataMY($obj->data_nascimento);
// $cpf = preg_replace("/[^0-9]/", "", $obj->cpf); // Retira formatação CPF
$rg               = addslashes($obj->rg);
$data_expedicao   = dataMY($obj->data_expedicao);
$orgao_expedicao  = strtoupper(addslashes($obj->orgao_expedicao));
$estado_civil     = addslashes($obj->estado_civil);
$email            = addslashes($obj->email);
$pagina_web       = addslashes($obj->pagina_web);
$nome_oficial_servico = addslashes($obj->nome_oficial_servico);
$nome_substituto      = addslashes($obj->nome_substituto);

$cep         = addslashes($obj->cep); 
$endereco    = addslashes($obj->endereco);
$numero      = addslashes($obj->numero);
$complemento = addslashes($obj->complemento);  
$bairro      = addslashes($obj->bairro);
$cidade      = addslashes($obj->cidade);
$uf          = addslashes($obj->uf);

$telefone    = addslashes($obj->telefone);
$telefone    = preg_replace("/[^0-9]/", "", $telefone);

$fax         = addslashes($obj->fax);
$fax         = preg_replace("/[^0-9]/", "", $fax);

$entrancia      = addslashes($obj->entrancia);

$senha 			= base64_decode($obj->senha);
$senha_tmp      = md5($senha); // password_hash($senha, PASSWORD_DEFAULT);
$ip_registro    = getIp();

$sql = "INSERT INTO cn_usuarios_associados 
				(nome, funcao, data_nascimento, cpf, rg, data_expedicao, orgao_expedicao, estado_civil, 
				email, pagina_web, nome_oficial_servico, nome_substituto, 
				cep, endereco, numero, complemento, bairro, cidade, uf, telefone, fax, 
				entrancia, ip_registro, data_hora_registro, senha, status, TabelionatoVinculadoId) 
				VALUES 
				('$nome', '$funcao', '$data_nascimento', '$cpf', '$rg', '$data_expedicao', '$orgao_expedicao', '$estado_civil', 
				'$email', '$pagina_web', '$nome_oficial_servico', '$nome_substituto', '$cep', '$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$uf', '$telefone', '$fax', 
				'$entrancia', '$ip_registro', NOW(), '$senha_tmp', 1, $id_tabelionato)"; 
$dba->query($sql);

$id_usuario = $dba->lastid();

$array = array("success" => "true"); 

header('Content-type: application/json');
echo json_encode($array);

?>