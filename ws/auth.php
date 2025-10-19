<?php

if (!isset($_REQUEST['api_token']) || $_REQUEST['api_token'] != '545d6f5cb1d24a4f7c94e1be01d9f474') {
	http_response_code(403);
	$array = array("error" => "true", "type" => "unauthenticated", "msg" => "Falha na autenticação de acesso");
	header('Content-Type: application/json');
	echo json_encode($array);
	exit;
}

?>