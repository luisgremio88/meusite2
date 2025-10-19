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

$vetper = $obj->access;
// echo json_encode($vetper); exit;

// deleta as permissoes do user
$sql = "delete from cn_usuarios_access where id_tabelionato='$id_tabelionato' and id_usuario='$id_usuario'";
$dba->query($sql);

// cadastra as permissoes novas 
foreach ($vetper as $per) {
    $sql = "insert into cn_usuarios_access (id_tabelionato, id_usuario, permissao) values ($id_tabelionato, $id_usuario, '$per')";
    $dba->query($sql);
}

$array = array("success" => "true"); 
header('Content-type: application/json');
echo json_encode($array);

?>