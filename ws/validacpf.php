<?php
/**
 * @author			Roberto Rotondo - v 1.0 - mai/2022
 * @description 	Serviço de validação CPF
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
include('../admin/inc/class.ValidaCpfCnpj.php');
include('./auth.php');

$array = array();

if (!empty($_GET['cpf']) && isset($_GET['cpf'])) {

	$cpf = new ValidaCPFCNPJ($_GET['cpf']); // Cria um objeto sobre a classe
    if ($cpf->valida()) { // Verifica se o CPF é válido

		$cpf = $_GET['cpf'];
		$cpf = addslashes($cpf);
		$cpf = preg_replace("/[^0-9]/", "", $cpf);
		
		$sql5   = "SELECT id FROM cn_usuarios_associados WHERE cpf = '$cpf'";
		$query5 = $dba->query($sql5);
		$qntd5  = $dba->rows($query5);
		if ($qntd5 > 0) {
			$array = array("error" => "true", "type" => "cpf_existe", "msg" => "CPF já cadastrado."); 

		} else {
			 $array = array("success" => "true", "type" => "cpf_valido", "msg" => "CPF válido."); 
		}
	
   
    } else {
    	$array = array("error" => "true", "type" => "cpf_invalido", "msg" => "CPF inválido."); 

    }	

} else {
	$array = array("error" => "true", "type" => "cpf", "msg" => "Informe o parâmetro CPF."); 

}

header('Content-type: application/json');
echo json_encode($array);

?>