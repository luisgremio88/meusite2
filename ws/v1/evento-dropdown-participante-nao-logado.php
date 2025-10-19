<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

ini_set('display_errors', 1);

include('../../admin/inc/inc.configdb.php');
include('../../admin/inc/inc.lib.php');

$json  	= file_get_contents('php://input');
$obj   	= json_decode($json, true);
$sql    = "SELECT * FROM cn_evento_participante_tipo WHERE id <> 1;";
$query  = $dba->query($sql);
$qntd   = $dba->rows($query);
$result = [];
if ($qntd > 0) {
    for($a=0; $a<$qntd; $a++) {
        $vet        = $dba->fetch($query);
        $result[]   = $vet;
    }
}
$return = array("ok" => true, "msg" => $result);

header('Content-Type: application/json');
echo json_encode($return);
