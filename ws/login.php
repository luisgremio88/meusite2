<?php
/**
 * @author			Roberto Rotondo - v 1.0 - mai/2022
 * @description 	Serviço de login usuário associado
 * @params

 */
// session_start();
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

include('../admin/inc/inc.configdb.php');
include('../admin/inc/inc.lib.php');
include('./auth.php');

$array = array();

$json  = file_get_contents('php://input');

$obj   = json_decode($json); // var_dump($obj);

if ($obj === null) {
	$array = array("error" => "true", "type" => "format_json", "msg" => "format_json");
	header('Content-Type: application/json');
	echo json_encode($array);
	exit;
}

if (!empty($obj->user) && isset($obj->user) && !empty($obj->senha) && isset($obj->senha)) {

	$cpf   = preg_replace("/[^0-9]/", "", $obj->user); // Retira formatação do CPF ou CNPJ
	$senha = base64_decode($obj->senha);
	$senha = md5($senha); // password_hash($senha, PASSWORD_DEFAULT);
	
	$sql1   = "SELECT * FROM cn_usuarios_associados WHERE cpf = '$cpf'";
	$query1 = $dba->query($sql1);
	$qntd1  = $dba->rows($query1);
	if ($qntd1 > 0) {
		$vet1 = $dba->fetch($query1);
		$id            = $vet1['id'];
		$nome          = $vet1['nome'];
		$senha_usuario = $vet1['senha']; 
		$status        = $vet1['status'];
		$idt   = $vet1['TabelionatoVinculadoId'];
		$ofc   = $vet1['oficial'];

		if ($senha == $senha_usuario) {
		    if ($status == 0) {
				$array = array("error" => "true", "type" => "bloqueio", "msg" => "Usuário bloqueado entre em contato com o suporte.");

			} else {		
				$token = geraToken();
				$array = array("success"=>"true", "token"=>$token, "user"=>array("id"=>intval($id), "nome"=>$nome, "cpf"=>$cpf, "tabelionato"=>$idt, "oficial"=>$ofc)); 

				$sql4   = "INSERT INTO cn_usuarios_associados_token (id_usuarios, token, data_hora_registro) VALUES ($id, '$token', NOW())";
				$query4 = $dba->query($sql4);
			}
		} else {
		    $array = array("error" => "true", "type" => "senha", "msg" => "Usuário ou senha incorretos! Tente novamente."); 
		}
	} else {
		$array = array("error" => "true", "type" => "cpf", "msg" => "Usuário ou senha incorretos! Tente novamente.");

	}

} else {
	$array = array("error" => "true", "type" => "parametros", "msg" => "Parâmetros inválidos."); 

}

// error_log(json_encode($_SERVER));

header('Content-Type: application/json');
echo json_encode($array);

// print_r($_SESSION['app_users_token']);
