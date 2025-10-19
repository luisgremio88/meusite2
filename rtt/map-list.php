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

$vetmes = array(1=>'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');

//filtro
if (isset($_REQUEST['ano'])) {
    $ano = request('ano');
} else {
    $ano = date('Y');
}
$tpl->assign('ano', $ano);

if (isset($_REQUEST['mes'])) {
    $mes = request('mes');
} else {
    $mes = date('n', strtotime('last day of last month'));
}
if (!empty($mes)) {
    $tpl->assign('sel'.$mes, 'selected');
}
$tpl->assign('mes', $mes);

try 
{
    if (!empty($mes)) {
        $mes_pesquisa = '"mes_pesquisa":"'.$mes.'", ';
    }
    //lista dos testamentos do mapa atual
    $host = "https://www.colnotrs.app.br/ws/v1/relacao-mapa.php";
    $body = '{"id_tabelionato":'.$idt.' , "ano_pesquisa":"'.$ano.'", '.$mes_pesquisa.' "limit":20, "offset":0}';
    $head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $api = new ApiRest($host);
    $res = $api->post($body, $head); 

    $objeto = json_decode($res);
    if ($objeto->ok == true) {
        if (count($objeto->msg) > 0) {
            foreach ($objeto->msg as $vetobj) {
                $vet = get_object_vars($vetobj);
                $idm = $vet['id'];
                $del = $vet['permitir_excluir'];
                $man = $vet['testamento_manual'];
                $ano = $vet['Ano'];
                $mes = $vet['Mes'];
                //ajustes
                if ($del == 0) $deltxt = 'NÃO';
                else $deltxt = 'SIM';
                if ($man == 0) $mantxt = 'NÃO';
                else $mantxt = 'SIM';
                //exibe na tela
                $tpl->newBlock('mapas');
                $tpl->assign('idm', $idm);
                $tpl->assign('ims', $mes);
                $tpl->assign('mes', $vetmes[$mes]);
                $tpl->assign('ano', $ano);
                $tpl->assign('del', $deltxt);
                $tpl->assign('man', $mantxt);
            }
        }
        else {
            $tpl->newBlock('no-mapas');
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