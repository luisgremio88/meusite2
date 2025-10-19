<?php
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
include('./verificatoken.php');

$array = array();
$json  = file_get_contents('php://input');
$obj   = json_decode($json); // var_dump($obj);

if ($obj === null) {
	$array = array("error" => "true", "type" => "format_json", "msg" => "format_json");
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
}

if (empty($obj->id_usuario)){
	$array = array("error" => "true", "type" => "id_usuario", "msg" => "Parâmetro ID do Usuário obrigatório"); 
    header('Content-type: application/json');
    echo json_encode($array);
	exit;
}

if (empty($obj->id_tabelionato)){
	$array = array("error" => "true", "type" => "id_tabelionato", "msg" => "Parâmetro ID do Tabelionato obrigatório"); 
    header('Content-type: application/json');
    echo json_encode($array);
	exit;
}

if (empty($obj->token)){
	$array = array("error" => "true", "type" => "token", "msg" => "Parâmetro TOKEN obrigatório"); 
    header('Content-type: application/json');
    echo json_encode($array);
	exit;
}

$id_tabelionato = addslashes($obj->id_tabelionato);
$id_usuario = addslashes($obj->id_usuario);
$token      = addslashes($obj->token);

// $verificatoken = verificaToken($token, $id_usuario);
// if ($verificatoken === false) {
// 	$array = array("error" => "true", "type" => "token_invalido", "msg" => "TOKEN inválido");
// 	header('Content-type: application/json');
// 	echo json_encode($array);
// 	exit;
// }

// ---------------------------------------------

// select as permissoes do user
$sql = "SELECT * FROM cn_usuarios_access WHERE id_tabelionato='$id_tabelionato' and id_usuario='$id_usuario'";
$res = $dba->query($sql);
$qtd  = $dba->rows($res);
if ($qtd > 0) {
	for ($i=0; $i<$qtd; $i++) {
		$vet = $dba->fetch($res);
		$id = stripslashes($vet['id']);
		$id_tabelionato = stripslashes($vet['id_tabelionato']);
		$id_usuario = stripslashes($vet['id_usuario']);
		$permissao = stripslashes($vet['permissao']);

		$array_assoc[] = array(
			"success" => "true",
			"id" => $id,
			"id_tabelionato" => $id_tabelionato, 
			"id_usuario" => $id_usuario, 
			"permissao" => $permissao
		);
	}
	$array = array("success" => "true", "access" => $array_assoc);
} 
else {
	$array = array("error" => "true", "type" => "usuario_invalido", "msg" => "Usuário inválido.");
}

header('Content-type: application/json');
echo json_encode($array);

?>