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

$array               = array();
$array_galeria_fotos = array();

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

$sql3   = "SELECT id FROM cn_galeria_fotos_evento WHERE status = 1 ORDER BY data DESC";
$query3 = $dba->query($sql3);
$total  = $dba->rows($query3);

$sql2   = "SELECT * FROM cn_galeria_fotos_evento WHERE status = 1 ORDER BY data DESC LIMIT $inicio, $registros"; // print_r($sql2);
$query2 = $dba->query($sql2);
$qntd2  = $dba->rows($query2);
if ($qntd2 > 0) {	
	for ($j=0; $j<$qntd2; $j++) {
		$vet2    = $dba->fetch($query2);
		$id      = $vet2['id'];
		$data    = datetime_date_ptbr($vet2['data']);
		$titulo  = stripslashes($vet2['titulo']);
		$texto   = stripslashes($vet2['texto']);	

		// Verifica se existe imagem da news
		$imagem     = '';
		if (file_exists('../img/galeria/'.$id.'.jpg')) {
			$imagem = 'https://colnotrs.app.br/img/galeria/'.$id.'.jpg?v='.date('YmdHmi');
		}

		$array_galeria_fotos[] = array( 
									'id' 			   => intval($id), 
									'titulo' 		   => $titulo, 
									'texto' 		   => limita_caracteres(strip_tags($texto, "<br>"), 150), 
									'data' 			   => $data, 
									'imagem' 		   => $imagem
								);	
	}
}

$array = array("success" => "true", "galerias_fotos" => $array_galeria_fotos, "total" => $total, "pagina" => $pagina);

header('Content-type: application/json');
echo json_encode($array);

?>