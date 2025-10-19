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
include('./auth.php');

$array                = array();
$array_cursos_eventos = array();

$data_atual = date("Y-m-d");

$sql2   = "SELECT * FROM cn_cursos_eventos WHERE status = 1 ORDER BY data_ini DESC"; // print_r($sql2);

$query2 = $dba->query($sql2);
$qntd2  = $dba->rows($query2);

if ($qntd2 > 0) {

    for ($j = 0; $j < $qntd2; $j++) {
        $vet2    = $dba->fetch($query2);
        $id      = $vet2['id'];
        $data_ini    = $vet2['data_ini'];
        $data_fim    = $vet2['data_fim'];
        $titulo  = stripslashes($vet2['titulo']);


        $array_cursos_eventos[] = array(
            'id'        => intval($id),
            'title'   => $titulo,
            'start' => $data_ini,
            'end' => $data_fim,
        );
    }
}

$array = array("success" => "true", "cursos_eventos" => $array_cursos_eventos);

header('Content-type: application/json');
echo json_encode($array);
