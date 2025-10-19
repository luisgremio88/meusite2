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

$idu = request('idu');

$act = base64_encode('update');
$tpl->assign('act', $act);

try 
{
    //users associados
    $host = "https://www.colnotrs.app.br/ws/associados.php?token=$tok&id_usuario=$idu";
    $body = '';
    $head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
    $api = new ApiRest($host);
    $res = $api->get($body, $head); 

    $objeto = json_decode($res);
    if ($objeto->success) 
    {
        $vet = get_object_vars($vetobj = $objeto->associados[0]);
        //$idt = $vet['id_tabelionato']; //da session
        $idu = $vet['id']; 
        $nom = $vet['nome']; 
        $pri = $vet['primeiro_nome']; 
        $cpf = $vet['cpf']; 
        $nas = $vet['data_nascimento']; 
        $reg = $vet['rg']; 
        $exp = $vet['data_expedicao']; 
        $org = $vet['orgao_expedicao']; 
        $civ = $vet['estado_civil']; 
        $ema = $vet['email']; 
        $web = $vet['pagina_web']; 
        $ser = $vet['nome_oficial_servico']; 
        $sub = $vet['nome_substituto']; 
        $cep = $vet['cep']; 
        $end = $vet['endereco']; 
        $nro = $vet['numero']; 
        $com = $vet['complemento']; 
        $bai = $vet['bairro']; 
        $cid = $vet['cidade']; 
        $est = $vet['uf']; 
        $tel = $vet['telefone']; 
        $fax = $vet['fax']; 
        $ent = $vet['entrancia']; 
        $sta = $vet['status_associado']; 

        $act = base64_encode('update');
        $tpl->assign('act', $act);
        $tpl->assign('idt', $idt);
        $tpl->assign('idu', $idu);
        $tpl->assign('sta', $sta);

        $tpl->assign('nom', $nom);
        $tpl->assign('cpf', $cpf);
        $tpl->assign('nas', $nas);
        $tpl->assign('tel', $tel);
        $tpl->assign('ema', $ema);
        $tpl->assign('web', $web);
        
        $tpl->assign('cep', $cep);
        $tpl->assign('end', $end);
        $tpl->assign('nro', $nro);
        $tpl->assign('com', $tel);
        $tpl->assign('bai', $bai);
        $tpl->assign('cid', $cid);
        $tpl->assign('est', $est);
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