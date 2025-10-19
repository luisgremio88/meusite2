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
//include('./auth.php');

$array               = array();
$array_galeria_videos = array();

//categoria de video
$cat = '%';
if (!empty($_GET['c']) && is_numeric($_GET['c'])) {
	$cat = $_GET['c'];
}

$pagina = 1;
if (!empty($_GET['pagina']) && is_numeric($_GET['pagina'])) {
	$pagina = $_GET['pagina'];
}	

// Seta a quantidade de itens por página, neste caso, 12 itens
$registros = 12;
if (!empty($_GET['registros']) && is_numeric($_GET['registros'])) {
	$registros = $_GET['registros'];
}

// Variavel para calcular o início da visualização com base na página atual
$inicio = ($registros*$pagina)-$registros;

$sql3   = "SELECT id FROM cn_galeria_videos WHERE status = 1 and id_categoria like '$cat' 
			ORDER BY status desc, id DESC";
$query3 = $dba->query($sql3);
$total  = $dba->rows($query3);

$sql2   = "SELECT * FROM cn_galeria_videos WHERE status = 1 and id_categoria like '$cat' 
			ORDER BY status desc, id DESC LIMIT $inicio, $registros"; // print_r($sql2);
$query2 = $dba->query($sql2);
$qntd2  = $dba->rows($query2);
if ($qntd2 > 0) {	
	for ($j=0; $j<$qntd2; $j++) {
		$vet2    = $dba->fetch($query2);
		$id      = $vet2['id'];
		$titulo  = stripslashes($vet2['titulo']);
		$descricao  = stripslashes($vet2['descricao']);

		$link_video = "";
		if (!empty($vet2['link'])) {
			$link = parseVideos($vet2['link']);			
			$link_video = $link['0']['url'];
		}

		$array_galeria_videos[] = array( 
									'id' 			   => intval($id), 
									'titulo' 		   => $titulo, 
									'link_video' 	   => $link_video,
									'descricao' 	   => $descricao
								);	
	}
}

$array = array("success" => "true", "galerias_videos" => $array_galeria_videos, "total" => $total, "pagina" => $pagina);

header('Content-type: application/json');
echo json_encode($array);

?>