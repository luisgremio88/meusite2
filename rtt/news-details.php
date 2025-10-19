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


$idnenv = request('id');
if (!is_numeric($idnenv)) {
    header('location: news');
    exit;
}

try 
{
    //lista das buscas realizadas
    $host = "https://www.colnotrs.app.br/ws/noticias.php";
    $body = 'api_token="545d6f5cb1d24a4f7c94e1be01d9f474"';
    //$head = array('Content-Type:application/form-data');
    $head = array('Content-Type: application/x-www-form-urlencoded');
    $api = new ApiRest($host);
    $res = $api->post($body, $head); 
    
    $objeto = json_decode($res);
    if ($objeto->success == true) {
        //notícia em detalhes
        foreach ($objeto->noticias as $vetobj) {
            $vet = get_object_vars($vetobj);
            $idn = $vet['id'];
            $tit = $vet['titulo'];
            $rsm = $vet['resumo'];
            $txt = $vet['texto'];
            $dat = $vet['data'];
            $img = $vet['imagem'];
            //exibe na tela
            if ($idn == $idnenv) {
                if (!empty($img)) {
                    $tpl->newBlock('temimg');
                    $tpl->assign('img', $img);
                }
                $tpl->gotoBlock('_ROOT');
                $tpl->assign('idn', $idn);
                $tpl->assign('tit', $tit);
                $tpl->assign('rsm', $rsm);
                $tpl->assign('txt', $txt);
                $tpl->assign('dat', $dat);
                break;
            }
        }

        //ultimas 4 notícias (na lateral)
        $i = 0;
        foreach ($objeto->noticias as $vetobj) {
            $vet = get_object_vars($vetobj);
            $idn = $vet['id'];
            $tit = $vet['titulo'];
            //exibe na tela
            $tpl->newBlock('noticias-ult');
            $tpl->assign('idn', $idn);
            $tpl->assign('tit', $tit);
            $i++;
            if ($i==4) break;
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