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
$grppag = '3-conteudos';
//controle do acesso ao menu
include_once('_menu.php');

try 
{
    //lista das buscas realizadas
    $cat = 16;
    $host = "https://www.colnotrs.app.br/ws/galerias-videos.php?c=$cat";
    $body = 'api_token="545d6f5cb1d24a4f7c94e1be01d9f474"';
    //$head = array('Content-Type:application/form-data');
    $head = array('Content-Type: application/x-www-form-urlencoded');
    $api = new ApiRest($host);
    $res = $api->post($body, $head); 
    
    $objeto = json_decode($res);
    if ($objeto->success == true) {
        $i = 0;
        foreach ($objeto->galerias_videos as $vetobj) {
            $vet = get_object_vars($vetobj);
            $idv = $vet['id'];
            $tit = $vet['titulo'];
            $vid = $vet['link_video'];
            $des = $vet['descricao'];
            
            //exibe na tela
            //if ($i%4 == 0) $tpl->newBlock('pautas-row');
            $tpl->newBlock('videos');
            $tpl->assign('idv', $idv);
            $tpl->assign('tit', $tit);
            $tpl->assign('vid', $vid);
            $tpl->assign('des', $des);

            $i++;
        }
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