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

$array             = array();
$array_links_uteis = array();

if (!empty($_REQUEST['id_categoria']) || is_numeric($_REQUEST['id_categoria'])) {

	$id_categoria = addslashes($_REQUEST['id_categoria']);

	$sql2   = "SELECT * FROM cn_links_uteis_categorias WHERE status = 1 AND id = $id_categoria ORDER BY titulo"; // print_r($sql2);
	$query2 = $dba->query($sql2);
	$qntd2  = $dba->rows($query2);
	if ($qntd2 > 0) {	
		$vet2    = $dba->fetch($query2);
		$id      = $vet2['id'];
		$titulo  = stripslashes($vet2['titulo']);
		
		$sql1   = "SELECT * FROM cn_links_uteis WHERE id_categoria = $id AND status = 1 ORDER BY titulo"; // print_r($sql1);
		$query1 = $dba->query($sql1);
		$qntd1  = $dba->rows($query1);
		if ($qntd1 > 0) {	
			for ($k=0; $k<$qntd1; $k++) {
				$vet1        = $dba->fetch($query1);
				$id_link     = $vet1['id'];
				$titulo_link = stripslashes($vet1['titulo']);
				$link        = stripslashes($vet1['link']);

				$array_links_uteis[] = array('id' 	  => intval($id_link), 
											 'titulo' => $titulo_link,
											 'link'   => $link);
			}
		}		
		
	}

	$array = array("success" => "true", "id"=> $id, "titulo"=> $titulo, "links_uteis" => $array_links_uteis);

} else {
	$array = array("error" => "true", "type" => "parametros", "msg" => "Parâmetros inválidos.");
}

header('Content-type: application/json');
echo json_encode($array);

?>