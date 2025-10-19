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
    $host = "https://www.colnotrs.app.br/ws/perguntasFrequentes.php";
    $body = '';
    $head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $api = new ApiRest($host);
    $res = $api->post($body, $head); 

    $objeto = json_decode($res);
    if ($objeto->success == true) {
        $vetcat = array();
        $vetfaq = array();
        foreach ($objeto->perguntas_frequentes as $vetobj) {
            $vet = get_object_vars($vetobj);
            $idp = $vet['id'];
            $tit = $vet['titulo'];
            $cat = $vet['categoria_titulo'];
            $txt = $vet['texto'];
            array_push($vetfaq, array($cat, $idp, $tit, $txt));
            array_push($vetcat, $cat);
        }
        //exibe na tela
        $vetcat = array_unique($vetcat);
        for($i=0; $i<count($vetcat); $i++) {
            $cat = $vetcat[$i];
            $tpl->newBlock('cats');
            $tpl->assign('cat', $cat);

            //perguntas e respostas de cada categoria
            $vetind = array();
            for($x=0; $x<count($vetfaq); $x++) {
                $ind = array_search($cat, $vetfaq[$x]);
                if ($cat == $vetfaq[$x][0]) {
                    array_push($vetind, $x);
                }
            }
            foreach ($vetind as $key) {
                $idp = $vetfaq[$key][1];
                $tit = $vetfaq[$key][2];
                $txt = $vetfaq[$key][3];
                $tpl->newBlock('faqs');
                $tpl->assign('tit', $tit);
                $tpl->assign('txt', $txt);
                $tpl->assign('idp', $idp);
            }
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