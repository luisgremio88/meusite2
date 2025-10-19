<?php
require_once('../../inc/inc.autoload.php');
require_once('../../inc/inc.globals.php');

//$return = '';
// ---------- PROCESSAMENTO ------------

$act = request('act');
$act = base64_decode($act);

switch($act)
{
    case 'boleto': 
        $bid = request('bid');
        require_once '../../admin/inc/inc.configdb.php';
        require_once '../../admin/inc/inc.unicred.php';
        
        $unicred = new UnicredBoleto();
        $sqlBoleto = "SELECT 
            bu.chave_boleto AS chave
        FROM cn_boleto_unicred bu
        WHERE bu.id = $bid;";

        $queryBoleto = $dba->query($sqlBoleto);
        $vetBoleto = $dba->fetch($queryBoleto);
        $unicred->buscarTituloUnicred($vetBoleto["chave"]);
    break;
}

// ---------- PROCESSAMENTO ------------
//echo $return;

?>