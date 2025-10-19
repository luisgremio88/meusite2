<?php

/**
 * @author			Andrey Willian - v 1.0 - aug/2023
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
$array_perguntas_frequentes = array();

$sql2 = "SELECT pr.*, prc.titulo AS categoria_titulo
FROM cr_perguntas_respostas AS pr
JOIN cr_perguntas_respostas_categorias AS prc ON pr.id_categoria = prc.id
ORDER BY pr.id_categoria DESC
LIMIT 50;";
$query2 = $dba->query($sql2);
$qntd2 = $dba->rows($query2);

if ($qntd2 > 0) {
    for ($j = 0; $j < $qntd2; $j++) {
        $vet2   = $dba->fetch($query2);

        $id = $vet2[0];
        $titulo = ($vet2['titulo']);
        $categoria_titulo = ($vet2['categoria_titulo']);
        $texto = ($vet2['texto']);

        $array_perguntas_frequentes[] = array(

            'id' => $id,
            'titulo' => $titulo,
            'categoria_titulo' => $categoria_titulo,
            'texto' => $texto,
        );
    };
};

$array = array("success" => "true", "perguntas_frequentes" => $array_perguntas_frequentes, "total" => $qntd2);

header('Content-type: application/json');
echo json_encode($array);
