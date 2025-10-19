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
$array_categorias  = array();

// $sql_categoria = "";
// if (!empty($_GET['id_categoria']) && is_numeric($_GET['id_categoria'])) {
// 	$sql_categoria = " AND id = ".$_GET['id_categoria'];
// }

$sql2   = "SELECT * FROM cn_links_uteis_categorias WHERE status = 1 ORDER BY titulo"; // print_r($sql2);
$query2 = $dba->query($sql2);
$qntd2  = $dba->rows($query2);
if ($qntd2 > 0) {	
	for ($j=0; $j<$qntd2; $j++) {
		$vet2    = $dba->fetch($query2);
		$id      = $vet2['id'];
		$titulo  = stripslashes($vet2['titulo']);

		// $array_links_uteis = array();

		// $sql1   = "SELECT * FROM cn_links_uteis WHERE id_categoria = $id AND status = 1 ORDER BY titulo"; // print_r($sql1);
		// $query1 = $dba->query($sql1);
		// $qntd1  = $dba->rows($query1);
		// if ($qntd1 > 0) {	
		// 	for ($k=0; $k<$qntd1; $k++) {
		// 		$vet1        = $dba->fetch($query1);
		// 		$id_link     = $vet1['id'];
		// 		$titulo_link = stripslashes($vet1['titulo']);
		// 		$link        = stripslashes($vet1['link']);

		// 		$array_links_uteis[] = array('id' 	  => intval($id_link), 
		// 									 'titulo' => $titulo_link,
		// 									 'link'   => $link);
		// 	}
		// }		

		$array_categorias[] = array('id' 	      => intval($id), 
									'titulo'      => $titulo);	
	}
}

$array = array("success" => "true", "categorias" => $array_categorias);

header('Content-type: application/json');
echo json_encode($array);

?>