<?php

/**
 * @author			Mateus Gautério - v 1.0 - jan/2023 
 * @params

 */
// session_start();
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

$array = array();
$array_vagas = array();
$json  = file_get_contents('php://input');
$obj   = json_decode($json); // var_dump($obj);
$acentuacoes = array('á'=>'a', 'à'=>'a', 'ã'=>'a', 'â'=>'a', 'é'=> 'e', 'ê'=> 'e', 'í'=>'i', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ú' => 'u', 'ç'=> 'c');
if ($obj) {
    $cidade = str_replace("'", "", $obj->cidade);  
    $query_consulta = "SELECT * FROM cr_consolidacao_normativa_rs";
    if ($obj->link) {
        $query_consulta .= " AND link = '$obj->link'";
    }
 
} else {
    $query_consulta = "SELECT * FROM cr_consolidacao_normativa_rs";
} 
$query_consulta= strtr($query_consulta,$acentuacoes);
 

$query = $dba->query($query_consulta);
$rows = $dba->rows($query);
if ($rows > 0) {
    for ($i = 0; $i < $rows; $i++) {
        $vet = $dba->fetch($query);
        $id = $vet["id"];
        $link = $vet["link"];

        $array_vagas[] = array(
            "id_consolidacao" => $id,
            "link" => mb_convert_encoding($link, 'UTF-8', mb_list_encodings()),
        );
    };
    $array = array("success" => true, "horarios" => $array_vagas, "total" => $rows);
} else {
    $array = array("success" => true, "vagas" => NULL, "total" => $rows);
};

header('Content-type: application/json');
echo json_encode($array);
// echo $query_consulta;