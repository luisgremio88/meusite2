<?php

/**
 * @author			Roberto Rotondo - v 1.0 - mai/2022
 * @description 	
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
include('../admin/inc/youtube-vimeo-embed-urls.php');
require_once('../admin/inc/inc.lib.php');
include('./auth.php');

$array               = array();
$array_tabelionatos = array();

$json  = file_get_contents('php://input');
$obj   = json_decode($json); // var_dump($obj);
if ($obj === null) {
	$array = array("error" => "true", "type" => "format_json", "msg" => "format_json");
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
}
if (empty($obj->id_tabelionato)){
	$array = array("error" => "true", "type" => "id_tabelionato", "msg" => "Parâmetro ID tabelionato obrigatório"); 
    header('Content-type: application/json');
    echo json_encode($array);
	exit;
}

$sqltab = '';
if ( isset($obj->id_tabelionato) && is_numeric($obj->id_tabelionato) ){
    $id_tabelionato = addslashes($obj->id_tabelionato);
    $sqltab = "AND id = $id_tabelionato";
}

$sql2 = "SELECT * FROM cr_tabelionatos_associados WHERE 1=1 $sqltab ORDER BY municipio";
$query2 = $dba->query($sql2);
$qntd2 = $dba->rows($query2);

if ($qntd2 > 0) {
    for ($j=0; $j<$qntd2; $j++) {
    $vet2   = $dba->fetch($query2);


    $id = $vet2[0];
    $bairro = limita_caracteres($vet2['bairro'], 100);
    $codigo = $vet2['codigo'];
    $email = limita_caracteres($vet2['email'], 100);
    $endereco = limita_caracteres($vet2['endereco'], 100);
    $horario_de_funcionamento = limita_caracteres($vet2['horario_de_funcionamento'], 100);
    $latitude = limita_caracteres($vet2['latitude'], 100);
    $logradouro = limita_caracteres($vet2['logradouro'], 100);
    $longitude = limita_caracteres($vet2['longitude'], 100);
    $municipio = limita_caracteres($vet2['municipio'], 100);
    $numero = $vet2['numero'];
    $tabeliao = limita_caracteres($vet2['tabeliao'], 100);
    $tabelionato = limita_caracteres($vet2['tabelionato'], 100);
    $telefone = $vet2['telefone'];

    $array_tabelionatos[] = array( 

        'id' => $id,
        'bairro' => $bairro,
        'codigo' => $codigo,
        'email' => $email,
        'endereco' => $endereco,
        'horario_de_funcionamento' => $horario_de_funcionamento,
        'latitude' => $latitude,
        'logradouro' => $logradouro,
        'longitude' => $longitude,
        'municipio' => $municipio,
        'numero' => $numero,
        'tabeliao' => $tabeliao,
        'tabelionato' => $tabelionato,
        'telefone' => $telefone,

    );
    }}
    $array = array("success" => "true", "tabelionatos" => $array_tabelionatos, "total" => $qntd2);

header('Content-type: application/json');
echo json_encode($array);
