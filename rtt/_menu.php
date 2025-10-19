<?php
require_once('../inc/inc.autoload.php');
require_once('../inc/inc.globals.php');
require_once('./config/inc.functions.php');
checkSession();

// dados da session do login
$idu = $_SESSION['idu']; 
$cpf = $_SESSION['cpf'];
$idt = $_SESSION['tab']; 
$tok = $_SESSION['tok'];

// array de controle
$vetmen = array();

// verifica session do menu
if (isset($_SESSION['menu']))
{
    //array menu com as permissoes
    $vetmen = $_SESSION['menu'];
}
else 
{
    // se nao existir, busca na API
    $host = "https://www.colnotrs.app.br/ws/associados-access.php?api_token=545d6f5cb1d24a4f7c94e1be01d9f474";
    $body = '{
        "id_tabelionato" : "'.$idt.'" , 
        "id_usuario" : "'.$idu.'" , 
        "token" : "'.$tok.'" 
    }';
    $head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $api = new ApiRest($host);
    $res = $api->post($body, $head); 
    $objeto = json_decode($res);
    if ($objeto->success == true) {
        foreach ($objeto->access as $obj) {
            $per = $obj->permissao;
            $vetmen[] = $per;
        }
        array_push($vetmen, '0-home', '0-dados');
        $_SESSION['menu'] = $vetmen;
    }
}


// toda página DEVE ter a definicao do grupo que pertence
if (!isset($grppag)) {
    $grppag = ''; // estando empty, vai ser feito logout
}
if (in_array($grppag, $vetmen))
{
    // exibe as opções do menu cfme o login
    // se estiver tentando acesso a uma página que nao tem permissao, logout
    foreach ($vetmen as $per) {
        //if ($per == '1-home') $tpl->newBlock('menu-home');
        if ($per == '2-testamentos') $tpl->newBlock('menu-testamentos');
        if ($per == '3-conteudos') $tpl->newBlock('menu-conteudos');
        if ($per == '4-eventos') $tpl->newBlock('menu-eventos');
        if ($per == '5-gestao') $tpl->newBlock('menu-gestao');
        if ($per == '6-financeiro') $tpl->newBlock('menu-financeiro');
    }
}
else 
{
    header('location: ./action/login.act?act=bG9nb3V0');
    exit;
}

$tpl->gotoBlock('_ROOT');
?>