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
    $host = "https://www.colnotrs.app.br/ws/associados.php?token=$tok&id_usuario=$idu&id_tabelionato=$idt";
    $body = '';
    $head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $api = new ApiRest($host);
    $res = $api->get($body, $head); 

    $objeto = json_decode($res);
    if ($objeto->success) {
        $vet = get_object_vars($objeto);
        foreach ($objeto->associados as $vetobj) {
            $vet = get_object_vars($vetobj);
            $idu = $vet['id'];
            $cpf = $vet['cpf'];
            $nom = $vet['nome'];
            $ofc = $vet['oficial'];
            
            //exibe na tela
            // if ($ofc != 1) {
                $tpl->newBlock('users');
                $tpl->assign('idu', $idu);
                $tpl->assign('cpf', $cpf);
                $tpl->assign('nom', $nom);
            //}
            
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