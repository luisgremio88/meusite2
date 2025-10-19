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
$grppag = '5-gestao';
//controle do acesso ao menu
include_once('_menu.php');

try 
{
    //users associados
    $host = "https://www.colnotrs.app.br/ws/tabelionatos-associados.php?api_token=545d6f5cb1d24a4f7c94e1be01d9f474";
    $body = '{ "id_tabelionato" : "'.$idt.'" }';
    $head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $api = new ApiRest($host);
    $res = $api->post($body, $head); 

    $objeto = json_decode($res);
    if ($objeto->success) 
    {
        $vet = get_object_vars($vetobj = $objeto->tabelionatos[0]);
        $idt = $vet['id']; 
        $cod = $vet['codigo']; 
        $ofc = $vet['tabeliao']; 
        $nom = $vet['tabelionato']; 
        $bai = $vet['bairro']; 
        $end = $vet['endereco']; 
        $nro = $vet['numero']; 
        $cid = $vet['municipio']; 
        $ema = $vet['email']; 
        $tel = $vet['telefone']; 
        $hor = $vet['horario_de_funcionamento']; 

        $act = base64_encode('update');
        $tpl->assign('act', $act);
        $tpl->assign('idt', $idt);
        $tpl->assign('idu', $idu);

        $tpl->assign('nom', $nom);
        $tpl->assign('cod', $cod);
        $tpl->assign('ofc', $ofc);
        $tpl->assign('tel', $tel);
        $tpl->assign('ema', $ema);
        $tpl->assign('hor', $hor);
        
        $tpl->assign('cep', $cep);
        $tpl->assign('end', $end);
        $tpl->assign('nro', $nro);
        $tpl->assign('bai', $bai);
        $tpl->assign('cid', $cid);
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