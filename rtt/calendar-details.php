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
$grppag = '4-eventos';
//controle do acesso ao menu
include_once('_menu.php');

$ide = request('id');
if (empty($ide) || !is_numeric($ide)) {
    header('location: ./calendar?bug=1');
    exit;
}


try 
{
    //listar eventos
    $host = "https://www.colnotrs.app.br/ws/curso-evento.php?api_token=545d6f5cb1d24a4f7c94e1be01d9f474&id=$ide";
    $body = '{"id_tabelionato":'.$idt.' , "id":'.$ide.'}';
    //$head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $head = array('Content-Type: application/x-www-form-urlencoded');
    $api = new ApiRest($host);
    $res = $api->get($body, $head); 
    $objeto = json_decode($res);
    if ($objeto->success == true) {
        $vet = get_object_vars($objeto);
        $ide = $vet['id'];
        $tit = $vet['titulo'];
        $txt = $vet['texto'];
        $dat = $vet['data_ini'];
        $tip = $vet['tipo_anexo']; //1 pdf, 2 img
        $anx = $vet['link_anexo'];
        
        //exibe na tela
        $tpl->assign('ide', $ide);
        $tpl->assign('tit', $tit);
        $tpl->assign('txt', $txt);
        $tpl->assign('dat', $dat);
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