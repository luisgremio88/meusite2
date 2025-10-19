<?php
require_once('../inc/inc.autoload.php');
require_once('../inc/inc.globals.php');
require_once('./config/inc.functions.php');
checkSession();

//página de conteúdo (content)
$npag = $_SERVER['PHP_SELF']; 
$npag = substr($npag, strrpos($npag,'/')+1);
$page = substr($npag, 0, strrpos($npag,'.')).'.html';

//layout "mestre"
$basedir = './static/';
$tpl = new TemplatePower($basedir.'_master.html'); 
//$tpl->assignInclude('header', $basedir.'_header2.html');
$tpl->assignInclude('content', $basedir.$page);
$tpl->prepare();

// ---------- INI PROCESSAMENTO ------------

// grupo dessa página
$grppag = '2-testamentos';
//controle do acesso ao menu
include_once('_menu.php');

//se faltar algum desses dados, volta ao inicio
if (empty($_REQUEST['idt']) || empty($_REQUEST['idc']) || empty($_REQUEST['idb']) || 
    (!isset($_REQUEST['cpf']) && !isset($_REQUEST['nom'])) ) {
    header('location: search-req');
    exit;
} 

try 
{
    //dados enviados do form 1
    $idt = request('idt');
    $idb = request('idb');
    $idc = request('idc');
    $cpf = request('cpf');
    $nom = request('nom');

    $fal = request('fal');
    $dat = request('dat');
    $liv = request('liv');
    $fol = request('fol');
    $tes = request('tes');
    $obs = request('obs');
    
    //etapa 3 - grava ou atualiza de quem vai pesquisar
    $host = "https://www.colnotrs.app.br/ws/v1/busca-testamento-3.php";
    $body = 
    '{
    "tabelionato_id":"'.$idt.'",
    "busca_id":"'.$idb.'",
    "cliente_id":"'.$idc.'",
    "nome":"'.$nom.'",
    "cpf":"'.$cpf.'",
    "falecido":"'.$fal.'",
    "data":"'.$dat.'",
    "livro":"'.$liv.'",
    "folha":"'.$fol.'",
    "numero":"'.$tes.'",
    "observacoes":"'.$obs.'"
    }';
    $head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $api = new ApiRest($host);
    $res = $api->post($body, $head); 

    $objeto = json_decode($res);
    if ($objeto->ok == true) {
        $vet = get_object_vars($objeto->msg);
        $idb = $vet['busca_id'];
        $idc = $vet['cliente_id'];
        $tpl->assign('idt', $idt);
        $tpl->assign('idb', $idb);
        $tpl->assign('idc', $idc);

    }
    else {
        $tpl->newBlock('bug');
        $tpl->assign('msg', 'Falha na comunicação com a API');
    }
}
catch(Exception $ex) {
    $tpl->newBlock('bug');
    $tpl->assign('msg', $ex->getMessage());
}

// ---------- FIM PROCESSAMENTO ------------

$tpl->printToScreen();
?>