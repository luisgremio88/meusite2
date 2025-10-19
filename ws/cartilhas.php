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
//include('./auth.php');

$array               = array();
$array_cartilhas = array();

$sql2 = "SELECT * FROM cn_cartilhas WHERE status = 1 ORDER BY data DESC LIMIT 20";

$query2 = $dba->query($sql2);
$qntd2 = $dba->rows($query2);

if ($qntd2 > 0) {
    for ($j = 0; $j < $qntd2; $j++) {
        $vet2   = $dba->fetch($query2);

        $id = $vet2[0];
        $titulo = limita_caracteres($vet2['titulo'], 100);
        $texto = limita_caracteres($vet2['texto'], 100);
        $data = datetime_date_ptbr($vet2['data']);
        $anexo = 'https://colnotrs.app.br/img/' . $vet2['anexo'];
        $pdf = 'https://colnotrs.app.br/pdf/' . $vet2['pdf'];

        $array_cartilhas[] = array(

            'id' => $id,
            'titulo' => $titulo,
            'texto' => $texto,
            'data' => $data,
            'anexo' => $anexo,
            'pdf' => $pdf,

        );
    };
};

$array = array("success" => "true", "cartilhas" => $array_cartilhas, "total" => $qntd2);

header('Content-type: application/json');
echo json_encode($array);
