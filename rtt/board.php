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
    $host = "https://www.colnotrs.app.br/ws/v1/pauta-reuniao.php";
    $body = '{"id_tabelionato":'.$idt.' , "limit":20 , "offset":0}';
    $head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $api = new ApiRest($host);
    $res = $api->post($body, $head); 
    
    $objeto = json_decode($res);
    if ($objeto->ok == true) {
        $i = 0;
        foreach ($objeto->msg as $vetobj) {
            $vet = get_object_vars($vetobj);
            $idp = $vet['id'];
            $tit = $vet['Titulo'];
            $dat = $vet['DataPauta'];
            $dat = datetime_date_ptbr($dat);
            
            //exibe na tela
            if ($i%4 == 0) $tpl->newBlock('pautas-row');
            $tpl->newBlock('pautas-col');
            $tpl->assign('idp', $idp);
            $tpl->assign('tit', $tit);
            $tpl->assign('dat', $dat);

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