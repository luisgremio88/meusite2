<?php
/**
 * @author			Roberto Rotondo - v 1.0 - maio/2022
 * @description 	Serviço de cadastro de jornalistas
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
include('./auth.php');

$array = array();

$json  = file_get_contents('php://input');

$obj   = json_decode($json); // var_dump($obj);

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

if(empty($obj->email) || !validaEmail($obj->email)) {
	$array = array("error" => "true", "type" => "email_invalido", "msg" => "Email inválido."); 
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
} 

if(empty($obj->veiculo)) {
	$array = array("error" => "true", "type" => "senha", "msg" => "Preencha o Veículo corretamente.");
    header('Content-type: application/json');
    echo json_encode($array);
	exit;
} 

if(empty($obj->aceite_termos_politica) || !is_numeric($obj->aceite_termos_politica)) {
	$array = array("error" => "true", "type" => "aceite_termos_politica", "msg" => "Informe que você aceita e concorda com os termos de uso e com a política de privacidade");
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
} 

$nome    = strtoupper(addslashes($obj->nome));
$email   = strtolower(addslashes($obj->email));
$veiculo = strtoupper(addslashes($obj->veiculo));

$sql = "INSERT INTO cn_jornalistas (nome, email, veiculo, data_registro) VALUES ('$nome', '$email', '$veiculo', NOW())"; // print_r($sql);
$dba->query($sql);

$array = array("success" => "true"); 

header('Content-type: application/json');
echo json_encode($array);

?>