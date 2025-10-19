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

$idttenv = request('id');
if (!is_numeric($idttenv)) {
    header('location: testament');
    exit;
}

try 
{
    //detalhes do testamento
    $host = "https://www.colnotrs.app.br/ws/v1/relacao-testamento-detalhe.php";
    $body = '{"id_testamento":'.$idttenv.'}';
    $head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $api = new ApiRest($host);
    $res = $api->post($body, $head); 

    $objeto = json_decode($res);
    if ($objeto->ok == true) {
        if ( count($objeto->msg) > 0) {
            foreach ($objeto->msg as $vetobj) {
                $vet = get_object_vars($vetobj);
                $idtt = $vet['id'];
                $nom = $vet['Nome'];
                $cpf = $vet['Cpf'];
                $liv = $vet['Livro'];
                $fol = $vet['Folha'];
                if ($idtt == $idttenv) {
                    //exibe na tela
                    $tpl->assign('idtt', $idtt);
                    $tpl->assign('nom', $nom);
                    $tpl->assign('cpf', $cpf);
                    $tpl->assign('liv', $liv);
                    $tpl->assign('fol', $fol);
                    break;
                }
            }
        }
        else {
            $tpl->newBlock('bug');
            $tpl->assign('msg', 'Nenhum detalhe encontrado!');
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