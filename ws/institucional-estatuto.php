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

$sql2   = "SELECT * FROM cn_institucional_estatuto WHERE id = 1";
$query2 = $dba->query($sql2);
$qntd2  = $dba->rows($query2);
if ($qntd2 > 0) {
	$vet2   = $dba->fetch($query2);
	$id     = $vet2['id'];
	$titulo = stripslashes($vet2['titulo']);
	$texto  = stripslashes($vet2['texto']);		

	$link_anexo = "";
	if (file_exists('../img/'.$vet2['anexo']) && !empty($vet2['anexo'])) {
		$link_anexo = 'https://colnotrs.app.br/img/'.$vet2['anexo'];
	}

	$imagem = "";
	if (file_exists('../img/institucional/estatuto/main.jpg')) {
		$imagem = 'https://colnotrs.app.br/img/institucional/estatuto/main.jpg';
	}

	$link_video = "";
	if (!empty($vet2['link'])) {
		$link = parseVideos($vet2['link']);			
		$link_video = $link['0']['url'];
	}

	$array = array(	
					'success' 		   => "true", 
					'id' 			   => intval($id),
					'titulo' 		   => $titulo, 
					'texto' 		   => strip_tags($texto, "<br>"), 	
					'imagem' 	       => $imagem,
					'link_anexo' 	   => $link_anexo,
					'link_video' 	   => $link_video
				);
}

header('Content-type: application/json');
echo json_encode($array);

?>