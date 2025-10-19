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

//titulo, data ini, data fim = filtros
$tit = '';
if (!empty($_GET['tit'])) {
	$tit = $_GET['tit'];
    $tpl->assign('tit', $tit);
}
$dti = '';
if (!empty($_GET['dti'])) {
	$dti = $_GET['dti'];
    $tpl->assign('dti', $dti);
}
$dtf = '';
if (!empty($_GET['dtf'])) {
	$dtf = $_GET['dtf'];
    $tpl->assign('dtf', $dtf);
}

try 
{
    //lista das buscas realizadas
    //categoria 8 = restrito aos associados
    $cat = '';
    $host = "https://www.colnotrs.app.br/ws/noticias.php?c=$cat&tit=$tit&dti=$dti&dtf=$dtf"; //die($host);
    $body = 'api_token="545d6f5cb1d24a4f7c94e1be01d9f474"';
    //$head = array('Content-Type:application/form-data');
    $head = array('Content-Type: application/x-www-form-urlencoded');
    $api = new ApiRest($host);
    $res = $api->get($body, $head); 
    
    $objeto = json_decode($res);
    if ($objeto->success == true) {
        $i = 0;
        foreach ($objeto->noticias as $vetobj) {
            $vet = get_object_vars($vetobj);
            $idn = $vet['id'];
            $tit = $vet['titulo'];
            $dat = $vet['data'];
            $img = $vet['imagem'];
            //$dat = datetime_date_ptbr($dat);
            if (empty($img)) {
                $img = './static/img/portfolio/style-5/12.jpg';
            }
            
            //exibe na tela
            if ($i%4 == 0) $tpl->newBlock('noticias-rows');
            $tpl->newBlock('noticias-cols');
            $tpl->assign('idn', $idn);
            $tpl->assign('tit', $tit);
            $tpl->assign('dat', $dat);
            $tpl->assign('img', $img);

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