<?php
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
include('./verificatoken.php');

$array = array();

if ( isset($_GET['token']) && !empty($_GET['token']) && 
 	 isset($_GET['id_usuario']) && is_numeric($_GET['id_usuario']) ) 
{
	$token = addslashes($_GET['token']);
	$id_usuario = addslashes($_GET['id_usuario']);

	// $verificatoken = verificaToken($token, $id_usuario);
	// if ($verificatoken === false) {
	// 	$array = array("error" => "true", "type" => "token_invalido", "msg" => "Token inválido.");
	// 	header('Content-type: application/json');
	// 	echo json_encode($array);
	// 	exit;
	// }

	$sqlusu = '';
	if ( isset($_GET['id_usuario']) && is_numeric($_GET['id_usuario']) ){
		// $id_usuario = addslashes($_GET['id_usuario']);
		$sqlusu = "AND id = $id_usuario";
	}
	$sqltab = '';
	if ( isset($_GET['id_tabelionato']) && is_numeric($_GET['id_tabelionato']) ){
		$id_tabelionato = addslashes($_GET['id_tabelionato']);
		$sqltab = "AND TabelionatoVinculadoId = $id_tabelionato";
		$sqlusu = ''; //se enviar idt, pesquisa sem idu
	}

	$sql2   = "SELECT * FROM cn_usuarios_associados WHERE 1=1 $sqlusu $sqltab";
	$query2 = $dba->query($sql2);
	$qntd2  = $dba->rows($query2);
	if ($qntd2 > 0) {
		for ($i=0; $i<$qntd2; $i++) {
			$vet2 = $dba->fetch($query2);

			$id               = stripslashes($vet2['id']);
			$nome             = stripslashes($vet2['nome']);
			$primeiro_nome    = explode(" ", $vet2['nome']);
			$primeiro_nome    = $primeiro_nome[0];
			$funcao           = stripslashes($vet2['funcao']);
			$data_nascimento  = dataBR($vet2['data_nascimento']);
			$cpf              = stripslashes($vet2['cpf']);
			$rg               = stripslashes($vet2['rg']);
			$data_expedicao   = dataBR($vet2['data_expedicao']);
			$orgao_expedicao  = $vet2['orgao_expedicao'];
			$estado_civil     = stripslashes($vet2['estado_civil']);
			$email            = stripslashes($vet2['email']);
			$pagina_web       = stripslashes($vet2['pagina_web']);
			$nome_oficial_servico = stripslashes($vet2['nome_oficial_servico']);
			$nome_substituto      = stripslashes($vet2['nome_substituto']);
			$cep         = stripslashes($vet2['cep']);
			$endereco    = stripslashes($vet2['endereco']);
			$numero      = stripslashes($vet2['numero']);
			$complemento = stripslashes($vet2['complemento']);
			$bairro      = stripslashes($vet2['bairro']);
			$cidade      = stripslashes($vet2['cidade']);
			$uf          = stripslashes($vet2['uf']);
			$telefone    = stripslashes($vet2['telefone']);
			$fax         = stripslashes($vet2['fax']);
			$entrancia   = stripslashes($vet2['entrancia']);
			$status_associado   = stripslashes($vet2['status_associado']);
			$id_tabelionato   = stripslashes($vet2['TabelionatoVinculadoId']);
			$oficial   = stripslashes($vet2['oficial']);

			$array_assoc[] = array(
				"success" => "true",
				"id" => $id,
				"nome" => $nome,
				"primeiro_nome" => $primeiro_nome,
				"cpf" => $cpf,
				"data_nascimento" => $data_nascimento,
				"rg" => $rg,
				"data_expedicao" => $data_expedicao,
				"orgao_expedicao" => $orgao_expedicao,
				"estado_civil" => $estado_civil,
				"email" => $email,
				"pagina_web" => $pagina_web,
				"nome_oficial_servico" => $nome_oficial_servico,
				"nome_substituto" => $nome_substituto,
				"cep" => $cep,
				"endereco" => $endereco,
				"numero" => $numero,
				"complemento" => $complemento,
				"bairro" => $bairro,
				"cidade" => $cidade,
				"uf" => $uf,
				"telefone" => $telefone,
				"fax" => $fax,
				"entrancia" => $entrancia,
				"status_associado" => $status_associado,
				"id_tabelionato" => $id_tabelionato, 
				"oficial" => $oficial
			);
		}
		$array = array("success" => "true", "associados" => $array_assoc);
	} 
	else {
		$array = array("error" => "true", "type" => "usuario_invalido", "msg" => "Usuário inválido.");
	}
} 
else {
	$array = array("error" => "true", "type" => "parametros", "msg" => "Parâmetros inválidos.");
}

header('Content-type: application/json');
echo json_encode($array);
?>