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

$array          = array();
$array_noticias = array();

$pagina = 1;

if (!empty($_REQUEST['pagina']) && is_numeric($_REQUEST['pagina'])) {
	$pagina = $_REQUEST['pagina'];
}	

// Seta a quantidade de itens por página, neste caso, 12 itens
$registros = 20;
if (!empty($_REQUEST['registros']) && is_numeric($_REQUEST['registros'])) {
	$registros = $_REQUEST['registros'];
}

//categoria da notícia
$cat = '%';
if (!empty($_REQUEST['c']) && is_numeric($_REQUEST['c'])) {
	$cat = $_REQUEST['c'];
}

//titulo, data ini, data fim = filtros
$tit = '%';
if (!empty($_REQUEST['tit'])) {
	$tit = $_REQUEST['tit'];
}
$sqldti = '';
if (!empty($_REQUEST['dti'])) {
	$dti = $_REQUEST['dti'];
	$sqldti = "and DataPublicacao >= '$dti' ";
}
$sqldtf = '';
if (!empty($_REQUEST['dtf'])) {
	$dtf = $_REQUEST['dtf'];
	$sqldtf = "and DataPublicacao <= '$dtf' ";
}
// -------------------

// Variavel para calcular o início da visualização com base na página atual
$inicio = ($registros*$pagina)-$registros;
$sql3   = "SELECT id FROM cn_noticia 
			WHERE status = 1 
			  and TipoNoticia like '$cat' 
			  and Titulo like '%$tit%'
			  $sqldti $sqldtf
			ORDER BY id DESC";
$query3 = $dba->query($sql3);
$total  = $dba->rows($query3);

$sql2   = "SELECT * FROM cn_noticia 
			WHERE status = 1 
			  and TipoNoticia like '$cat' 
			  and Titulo like '%$tit%'
			  $sqldti $sqldtf
			ORDER BY id DESC LIMIT $inicio, $registros"; // print_r($sql2);
$query2 = $dba->query($sql2);
$qntd2  = $dba->rows($query2);
if ($qntd2 > 0) {	
	for ($j=0; $j<$qntd2; $j++) {
		$vet2    = $dba->fetch($query2);
		$id      = $vet2['id'];
		$data    = datetime_date_ptbr($vet2['DataPublicacao']);
		$titulo  = stripslashes($vet2['Titulo']);
		$resumo  = stripslashes($vet2['Resumo']);
		$texto   = stripslashes($vet2['Texto']);	
		$categ   = stripslashes($vet2['TipoNoticia']);	

		// Verifica se existe imagem da news
		$imagem     = '';
		if (file_exists('../img/noticias/'.$id.'.jpg')) {
			$imagem = 'https://colnotrs.app.br/img/noticias/'.$id.'.jpg?v='.date('YmdHmi');
		}

		$array_noticias[] = array( 
									'id' 			   => intval($id), 
									'titulo' 		   => $titulo, 
									'resumo'		   => strip_tags($resumo, '<br>'), 
									'texto' 		   => $texto, 
									'data' 			   => $data, 
									'imagem' 		   => $imagem, 
									'categ'			   => $categ
								);	
	}
}

$array = array("success" => "true", "noticias" => $array_noticias, "total" => $total, "pagina" => $pagina);

header('Content-type: application/json');
echo json_encode($array);

?>