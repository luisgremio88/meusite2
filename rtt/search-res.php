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
if (empty($_REQUEST['idt']) || empty($_REQUEST['idc']) || empty($_REQUEST['idb'])) {
    header('location: search-req');
    exit;
} 

try 
{
    //dados enviados do form 
    $idt = request('idt');
    $idb = request('idb');
    $idc = request('idc');
    $pay = request('pay');

    //etapa 4 - grava o boleto, recibo e certidao
    $host = "https://www.colnotrs.app.br/ws/v1/busca-testamento-4.php";
    $body = 
    '{
    "tabelionato_id":"'.$idt.'",
    "busca_id":"'.$idb.'",
    "cliente_id":"'.$idc.'", 
    "responsabilizo":"'.$pay.'"
    }';
    $head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $api = new ApiRest($host);
    $res = $api->post($body, $head); 
    $objeto = json_decode($res);
    if ($objeto->ok == true) {
        $vet = get_object_vars($objeto->msg);
        $rec = $vet['link_recibo'];
        $cer = $vet['link_certidao'];
        $bol = $vet['boleto_gerado'];
        $bid = $vet['id_boleto'];
        $dep = $vet['responsabilizo'];

        //etapa 5 - mostra o resultado
        $host = "https://www.colnotrs.app.br/ws/v1/busca-testamento-5.php";
        $body = 
        '{
        "tabelionato_id":"'.$idt.'",
        "busca_id":"'.$idb.'",
        "cliente_id":"'.$idc.'"
        }';
        $head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
        $api = new ApiRest($host);
        $res = $api->post($body, $head); 
        $objeto = json_decode($res);
        if ($objeto->ok == true) {
            $vet = get_object_vars($objeto->msg);
            $rec = $vet['link_recibo'];
            $cer = $vet['link_certidao'];
            $bol = $vet['boleto_gerado'];
            $bid = $vet['id_boleto'];
            $dep = $vet['responsabilizo'];
            
            //exibe os dados
            $tpl->assign('idt', $idt);
            $tpl->assign('idb', $idb);
            $tpl->assign('idc', $idc);

            if ($dep == 1) {
                $tpl->newBlock('temresponsa');
                $tpl->assign('rec', $rec);
                $tpl->assign('cer', $cer);
            }

            if ($bol == 1) {
                $tpl->newBlock('temboleto');
                $tpl->assign('bid', $bid);
                $tpl->assign('act', base64_encode('boleto'));
            }

        }
        else {
            $tpl->newBlock('bug');
            $tpl->assign('msg', $objeto->msg);
        }

    }
    else {
        $tpl->newBlock('bug');
        $tpl->assign('msg', $objeto->msg);
    }

}
catch(Exception $ex) {
    $tpl->newBlock('bug');
    $tpl->assign('msg', $ex->getMessage());
}

// ---------- FIM PROCESSAMENTO ------------

$tpl->printToScreen();
?>