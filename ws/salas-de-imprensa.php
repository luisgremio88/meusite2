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
include('./auth.php');

$array = array();
$array_salas = array();

$id = $_GET['id'];

$sql2   = "SELECT * FROM cn_sala_de_imprensa WHERE status = 1 ORDER BY id DESC";

$query2 = $dba->query($sql2);
$qntd2  = $dba->rows($query2);

if ($qntd2 > 0) {

    for ($i = 0; $i < $qntd2; $i++) {
        $vet2 = $dba->fetch($query2);

        $array_salas[] = array(
            "id"     => $vet2['id'],
            "data"   => datetime_date_ptbr($vet2['data']),
            "titulo" => stripslashes($vet2['titulo']),
            "texto"  => stripslashes($vet2['texto']),
            "anexo"  => $vet2['anexo']
        );
    };

    $array = array(
        'success'            => "true",
        'salas'        => $array_salas
    );
} else {
    $array = array("error" => "true", "type" => "parametros", "msg" => "Parâmetros inválidos.");
}

header('Content-type: application/json');
echo json_encode($array);
