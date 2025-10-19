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

$act = base64_encode('access');
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
        $cpf = $vet['cpf']; 
        $ema = $vet['email']; 
        $web = $vet['pagina_web']; 
        $tel = $vet['telefone']; 
        
        $act = base64_encode('access');
        $tpl->assign('act', $act);
        $tpl->assign('idt', $idt);
        $tpl->assign('idu', $idu);
        $tpl->assign('sta', $sta);
        $tpl->assign('tok', $tok);
        $tpl->assign('nom', $nom);
        $tpl->assign('cpf', $cpf);
        $tpl->assign('tel', $tel);
        $tpl->assign('ema', $ema);

        //busca as permissoes de acesso
        $host2 = "https://www.colnotrs.app.br/ws/associados-access.php?api_token=545d6f5cb1d24a4f7c94e1be01d9f474";
        $body2 = '{
            "id_tabelionato" : "'.$idt.'" , 
            "id_usuario" : "'.$idu.'" , 
            "token" : "'.$tok.'"
        }';
        $head2 = array('Content-Type:application/json' , 'Content-Length:'.strlen($body2) , 'Accept: text/json');
        $api2 = new ApiRest($host2);
        $res2 = $api2->post($body2, $head2); 
        $objeto2 = json_decode($res2);
        if ($objeto2->success == true) {
            foreach ($objeto2->access as $obj) {
                $per = $obj->permissao;
                if ($per == '1-home') $tpl->assign('chkini', 'checked');
                if ($per == '2-testamentos') $tpl->assign('chktes', 'checked');
                if ($per == '3-conteudos') $tpl->assign('chkcon', 'checked');
                if ($per == '4-eventos') $tpl->assign('chkeve', 'checked');
                if ($per == '5-gestao') $tpl->assign('chkges', 'checked');
                if ($per == '6-financeiro') $tpl->assign('chkfin', 'checked');
            }
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