<?php

if (!isset($_GET['api_token']) || $_GET['api_token'] != '545d6f5cb1d24a4f7c94e1be01d9f474') {
	http_response_code(401);
	$array = array("error" => "true", "type" => "unauthenticated", "msg" => "Falha na autenticação de acesso");
	header('Content-Type: application/json');
	echo json_encode($array);
	exit;
}

?>