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

$idmenv = request('id');
if (!is_numeric($idmenv)) {
    header('location: map-list');
    exit;
}
$mesenv = request('m');
if (!is_numeric($mesenv)) {
    header('location: map-list');
    exit;
}
$anoenv = request('a');
if (!is_numeric($anoenv)) {
    header('location: map-list');
    exit;
}

$ano = $anoenv;
$mes = $mesenv;
$vetmes = array(1=>'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');
try 
{
    //mapa escolhido
    $host = "https://www.colnotrs.app.br/ws/v1/relacao-mapa.php";
    $body = '{"id_tabelionato":'.$idt.' , "ano_pesquisa":"'.$ano.'", "mes_pesquisa":"'.$mes.'", "limit":20, "offset":0}';
    $head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $api = new ApiRest($host);
    $res = $api->post($body, $head); 
    $objeto = json_decode($res);
    $idm = 0;
    if ($objeto->ok == true) {
        $vetobj = $objeto->msg[0];
        $vet = get_object_vars($vetobj);
        $idm = $vet['id'];
        $del = $vet['permitir_excluir'];
        $man = $vet['testamento_manual'];
        //ajustes
        if ($del == 0) $deltxt = 'NÃO';
        else $deltxt = 'SIM';
        if ($man == 0) $mantxt = 'NÃO';
        else $mantxt = 'SIM';
        //exibe na tela
        $tpl->gotoBlock('_ROOT');
        $tpl->assign('idm', $idm);
        $tpl->assign('mes', $vetmes[$mes]);
        $tpl->assign('ano', $ano);
        $tpl->assign('del', $deltxt);
        $tpl->assign('man', $mantxt);
        if ($man == 1) {
            $tpl->newBlock('cadman');
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

// ===================================

$nom = $cpf = $dti = $dtf = '';
if (isset($_REQUEST['nom'])) $nom = request('nom');
if (isset($_REQUEST['cpf'])) $cpf = request('cpf');
if (isset($_REQUEST['dti'])) $dti = request('dti');
if (isset($_REQUEST['dtf'])) $dtf = request('dtf');
try 
{
    //lista dos testamentos do mapa 
    $host = "https://www.colnotrs.app.br/ws/v1/relacao-mapa-detalhe.php";
    $body = '{"id_mapa":'.$idm.'}';
    $head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $api = new ApiRest($host);
    $res = $api->post($body, $head); 
    $objeto = json_decode($res);
    if ($objeto->ok == true) {
        if ($objeto->testamentoQtd > 0) {
            foreach ($objeto->testamento as $vetobj) {
                $vet = get_object_vars($vetobj);
                $idtt = $vet['id'];
                $nom = $vet['testador'];
                $cpf = $vet['Cpf'];
                $liv = $vet['testamento_livro'];
                $fol = $vet['testamento_folha'];
                //exibe na tela
                $tpl->newBlock('testamentos');
                $tpl->assign('idtt', $idtt);
                $tpl->assign('nom', $nom);
                $tpl->assign('cpf', $cpf);
                $tpl->assign('liv', $liv);
                $tpl->assign('fol', $fol);
            }
        } 
        else {
            $tpl->newBlock('no-testamentos');
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