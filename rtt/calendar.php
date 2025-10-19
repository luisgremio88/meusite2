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

try 
{
    //listar eventos
    $host = "https://www.colnotrs.app.br/ws/cursos-eventos.php?api_token=545d6f5cb1d24a4f7c94e1be01d9f474";
    $body = '{"id_tabelionato":'.$idt.' , "limit":20 , "offset":0}';
    //$head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $head = array('Content-Type: application/x-www-form-urlencoded');
    $api = new ApiRest($host);
    $res = $api->post($body, $head); 
    $objeto = json_decode($res);
    if ($objeto->success == true) {
        if (count($objeto->cursos_eventos)) {
            $i = 0;
            foreach ($objeto->cursos_eventos as $vetobj) {
                $vet = get_object_vars($vetobj);
                $ide = $vet['id'];
                $tit = $vet['titulo'];
                $dat = $vet['data_ini'];
                //$dat = date_ptbr($dat);
                //exibe na tela
                if ($i%4 == 0) $tpl->newBlock('eves-row');
                $tpl->newBlock('eves-col');
                $tpl->assign('ide', $ide);
                $tpl->assign('tit', $tit);
                $tpl->assign('dat', $dat);
                $i++;
            }
        }
        else {
            $tpl->newBlock('no-eves');
        }
    }
    else {
        $tpl->newBlock('bug');
        $tpl->assign('msg', 'Falha na comunicação com a API');
    }

    //detalhes do evento escolhido

}
catch(Exception $ex) {
    $tpl->newBlock('bug');
    $tpl->assign('msg', $ex->getMessage());
}

// ---------- FIM PROCESSAMENTO ------------

$tpl->printToScreen();
?>