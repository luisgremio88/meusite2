<?php

/**
 * @author			Andrey Willian - v 1.0 - aug/2023
 * @description 	Serviço
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
include('../admin/inc/phpmailer/PHPMailerAutoload.php');
include('./auth.php');

$array = array();
$array_categorias = array();

$sql1   = "SELECT * FROM cr_ouvidoria_categorias WHERE status = 1";
$query1 = $dba->query($sql1);
$qntd1  = $dba->rows($query1);

if ($qntd1 > 0) {

    for ($i = 0; $i < $qntd1; $i++) {
        $vet1 = $dba->fetch($query1);

        $id            = $vet1['id'];
        $titulo          = $vet1['titulo'];

        $array_categorias[] = array('id' => $id, 'titulo' => $titulo);
    };
};


$array = array("success" => "true", "categorias" => $array_categorias);

header('Content-type: application/json');
echo json_encode($array);
