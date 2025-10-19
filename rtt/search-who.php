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

//se faltar algum desses dados, volta
if (empty($_REQUEST['idt']) || !isset($_REQUEST['idc']) || 
    empty($_REQUEST['cpf']) || empty($_REQUEST['nom']) || 
    empty($_REQUEST['ema']) || empty($_REQUEST['tel']) || 
    empty($_REQUEST['cep']) || empty($_REQUEST['end']) ) {
    header('location: search-req');
    exit;
} 

try 
{
    //dados enviados do form 1
    $idt = request('idt');
    $idc = request('idc');
    $cpf = request('cpf');
    $nom = request('nom');
    $ema = request('ema');
    $tel = request('tel');
    $cep = request('cep');
    $end = request('end');
    $nro = request('nro');
    $com = request('com');
    $bai = request('bai');
    $cid = request('cid');
    $est = request('est');
    //ajuste
    $end = $end.', '.$nro;

    //etapa 2 - gravar ou atualizar dados do solicitante
    $host = "https://www.colnotrs.app.br/ws/v1/busca-testamento-2.php";
    $body = 
    '{
    "tabelionato_id":"'.$idt.'",
    "cliente_id":"'.$idc.'",
    "nome":"'.$nom.'",
    "cpf":"'.$cpf.'",
    "email":"'.$ema.'",
    "cep":"'.$cep.'",
    "endereco":"'.$end.'",
    "complemento":"'.$com.'",
    "bairro":"'.$bai.'",
    "telefone":"'.$tel.'",
    "municipio":"'.$cid.'",
    "estado":"'.$est.'"
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