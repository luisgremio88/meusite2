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

if (!empty($_GET['id']) || is_numeric($_GET['id'])) {

	$id = $_GET['id'];

	$sql2   = "SELECT id, titulo, data, texto, anexo FROM cn_revistas WHERE id = $id";
	$query2 = $dba->query($sql2);
	$qntd2  = $dba->rows($query2);
	if ($qntd2 > 0) {
		$vet2   = $dba->fetch($query2);
		$id     = $vet2['id'];
		$data   = datetime_date_ptbr($vet2['data']);
		$titulo = stripslashes($vet2['titulo']);
		$texto  = stripslashes($vet2['texto']);		

		$link_anexo = "";
		$tipo_anexo = "";
		if (file_exists('../img/'.$vet2['anexo']) && !empty($vet2['anexo'])) {
			$link_anexo = 'https://colnotrs.app.br/img/'.$vet2['anexo'];

			$tipo_anexo = 1; // PDF
			if (isImage('../img/'.$vet2['anexo'])) {
				$tipo_anexo = 2; // Imagem
			}
		}

		$array = array(	
						'success' 		   => "true", 
						'id' 			   => intval($id),
						'data' 			   => $data,  
						'titulo' 		   => $titulo, 
						'texto' 		   => strip_tags($texto, "<br>"), 						
						'link_anexo' 	   => $link_anexo,
						'tipo_anexo' 	   => $tipo_anexo
					);

	} else {
		$array = array("error" => "true", "type" => "parametros", "msg" => "Parâmetros inválidos.");
	}

} else {
	$array = array("error" => "true", "type" => "parametros", "msg" => "Parâmetros inválidos.");
}

header('Content-type: application/json');
echo json_encode($array);

?>