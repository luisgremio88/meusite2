<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
//error_reporting(0);

/**
 * @author 		odix.com.br
 * @version 	1.0
 * @description	recebe um input (get ou post) e retorna tratado
 * @return		string
 * @use 		<?php $valor = request('user'); ?>
 */
function request($input) 
{
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$return = filter_input(INPUT_GET, $input, FILTER_SANITIZE_SPECIAL_CHARS);
	}
	elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
		$return = filter_input(INPUT_POST, $input, FILTER_SANITIZE_SPECIAL_CHARS);
	}
	else {
		$input = htmlspecialchars($_REQUEST[$input]);
		$return = addslashes($_REQUEST[$input]);
	}
	
	return $return;
}

/**
 * @author 		odix.com.br
 * @version 	1.0
 * @description	recebe um tipo de autenticacao, manipula os dados e retorna
 * @return		array
 * @use 		<?php $valor = request_auth('basic'); ?>
 */
function request_auth($type) 
{
	switch ($type) {
		case 'basic': 
			$auth = array();
			if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ) {
				$auth['user'] = '';
				$auth['pass'] = ''; 
			} 
			else {
				$auth['user'] = $_SERVER['PHP_AUTH_USER'];
				$auth['pass'] = $_SERVER['PHP_AUTH_PW']; 
			}
			return $auth;
			break;
	}
}

/**
 * @author 		odix.com.br
 * @version 	1.0
 * @description	recebe um objeto e mostra os dados estruturados
 * @return		array
 */
function showObject($obj) {
	echo '<pre>';
	print_r($obj);
	echo '</pre>';
	exit;
}

/**
 * log em txt
 */
function logtxt($arq, $txt) {
	$ref = fopen($arq, 'a+');
	fwrite($ref, $txt."\n");
	fclose($ref);
}
?>