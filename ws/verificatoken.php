<?php
header('Content-Type: text/html; charset=utf-8');

// Conexão com o banco de dados
if ($_SERVER['HTTP_HOST'] == 'localhost') {
	define('HOSTDB2','mysql02-farm2.uni5.net');
	define('USERDB2','colnotrs');
	define('PASSDB2','c01n0t2022');
	define('BASEDB2','colnotrs');
} else {
	define('HOSTDB2','mysql02-farm2.uni5.net');
	define('USERDB2','colnotrs');
	define('PASSDB2','c01n0t2022');
	define('BASEDB2','colnotrs');
}

function verificaToken($token, $id_usuario) {

	include_once('../admin/inc/class.DbAdmin.php');
	$dba = new DbAdmin('mysqli');
	$dba->connect(HOSTDB2, USERDB2, PASSDB2, BASEDB2);
	$dba->query("SET SQL_BIG_SELECTS=1");

	$tmp = false;

	$sql99   = "SELECT * FROM cn_usuarios_associados_token WHERE id_usuarios = $id_usuario AND token = '$token'"; // print_r($sql99);
	$query99 = $dba->query($sql99);
	$qntd99  = $dba->rows($query99);
	if ($qntd99 > 0) {
		$tmp = true;

		$sql98   = "SELECT status FROM cn_usuarios_associados WHERE id = $id_usuario";
		$query98 = $dba->query($sql98);
		$vet98   = $dba->fetch($query98);
		$status  = $vet98[0];

		if ($status == 0) {
			$tmp = false;
		}
	}

	return $tmp;
}

?>