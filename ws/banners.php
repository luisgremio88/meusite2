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

$sql   = "SELECT * FROM cn_banners where status = 1 ORDER BY posicao asc, id desc";
$query = $dba->query($sql);
$qntd  = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$id_banner   = $vet['id'];		
		$titulo      = stripslashes($vet['titulo']);
		$subtitulo   = stripslashes($vet['subtitulo']);	
		$descricao   = stripslashes($vet['descricao']);		
		$texto_botao = stripslashes($vet['texto_botao']);			
		$link        = stripslashes($vet['link']);
		$posicao     = $vet['posicao'];

		$array_banners[] = array(

							'id'          => $id_banner, 
							'titulo'      => $titulo, 
							'subtitulo'   => $subtitulo, 
							'descricao'   => $descricao, 
							'texto_botao' => $texto_botao, 
							'link'        => $link,
							'posicao'     => $posicao, 
							'imagem'      => 'https://colnotrs.app.br/img/banners/'.$id_banner.'.jpg?'.date('YmdHis')
						);
	}
}

$array = array("success" => "true", "banners" => $array_banners);

header('Content-type: application/json');
echo json_encode($array);

?>