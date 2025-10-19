<?php
require_once('../../inc/inc.autoload.php');
require_once('../../inc/inc.globals.php');
require_once('../config/inc.functions.php');
checkSession();

//$return = '';
// ---------- PROCESSAMENTO ------------

$act = request('act');
$act = base64_decode($act);

switch($act)
{
    case 'insert': 
        try 
        {
            // pega os dados enviados
            $idt = request('idt');
            $idu = request('idu');
            $sta = request('sta');

            $nom = request('nom');
            $cpf = request('cpf');
            $nas = request('nas');
            $ema = request('ema');
            $tel = request('tel');
            $web = request('web');

            $cep = request('cep');
            $end = request('end');
            $nro = request('nro');
            $com = request('com');
            $bai = request('bai');
            $cid = request('cid');
            $est = request('est');

            $se1 = request('se1');
            $se2 = request('se2');
            if ($se1 == $se2) {
                $sen = base64_encode($se1);
            }

            //chama o endpoint que grava
            $host = "https://www.colnotrs.app.br/ws/associados-cadastro.php?api_token=545d6f5cb1d24a4f7c94e1be01d9f474";
            $body = "{ 
                \"token\" : \"$tok\" , 
                \"id_tabelionato\" : \"$idt\" , 
                \"nome\" : \"$nom\" , 
                \"cpf\" : \"$cpf\" , 
                \"email\" : \"$ema\" , 
                \"data_nascimento\" : \"$nas\" , 
                \"pagina_web\" : \"$web\" , 
                \"senha\" : \"$sen\" , 
                \"telefone\" : \"$tel\" , 
                \"cep\" : \"$cep\" , 
                \"endereco\" : \"$end\" , 
                \"numero\" : \"$nro\" , 
                \"complemento\" : \"$com\" , 
                \"bairro\" : \"$bai\" , 
                \"cidade\" : \"$cid\" , 
                \"uf\" : \"$est\" 
            }";
            $head = array('Content-Type: application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
            $api = new ApiRest($host);
            $res = $api->post($body, $head); 
            $objeto = json_decode($res);
            if ($objeto->success) {
                $destino = '../workers';
            }
            else {
                $destino = '../workers?api';
            }
        }
        catch(Exception $ex) {
            $destino = '../workers?bug='.$ex->getMessage();
        }
        showObject($objeto);
        header('location: '.$destino);
        exit;
    break;



    case 'update': 
        
        // pega os dados enviados
        $idt = request('idt');
        $idu = request('idu');
        $sta = request('sta');

        $nom = request('nom');
        $cpf = request('cpf');
        $nas = request('nas');
        $ema = request('ema');
        $tel = request('tel');
        $web = request('web');

        $cep = request('cep');
        $end = request('end');
        $nro = request('nro');
        $com = request('com');
        $bai = request('bai');
        $cid = request('cid');
        $est = request('est');

        $se1 = request('se1');
        $se2 = request('se2');
        if ($se1 == $se2) {
            $sen = base64_encode($se1);
        }

        // direcionamento
        $pag = request('pag');

        // faz os tratamentos
        // $nas = date_mysql($nas);

        // chamada da API passando dados
        $destino = "../$pag";
        try 
        {
            $host = "https://www.colnotrs.app.br/ws/associados-atualiza.php?api_token=545d6f5cb1d24a4f7c94e1be01d9f474";
            $body = "{ 
                \"token\" : \"$tok\" , 
                \"id_usuario\" : \"$idu\" , 
                \"nome\" : \"$nom\" , 
                \"cpf\" : \"$cpf\" , 
                \"email\" : \"$ema\" , 
                \"data_nascimento\" : \"$nas\" , 
                \"pagina_web\" : \"$web\" , 
                \"senha\" : \"$sen\" , 
                \"telefone\" : \"$tel\" , 
                \"cep\" : \"$cep\" , 
                \"endereco\" : \"$end\" , 
                \"numero\" : \"$nro\" , 
                \"complemento\" : \"$com\" , 
                \"bairro\" : \"$bai\" , 
                \"cidade\" : \"$cid\" , 
                \"uf\" : \"$est\" 
            }";
            //$head = array('Content-Type:application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
            $head = array('Content-Type: application/x-www-form-urlencoded');
            $api = new ApiRest($host);
            $res = $api->post($body, $head); 
            $objeto = json_decode($res);
            if ($objeto->error == true) {
                $destino = "../$pag?msg=api";
            }
        }
        catch(Exception $ex) {
            $destino = "../$pag?msg=bug";
        }
        
        header('location: '.$destino);
        exit;
    break;


    case 'access':
        // dados do form
        $idu = request('idu');
        $idt = request('idt');
        $tok = request('tok');
        $vetper = $_POST['per']; 

        // ajustes
        $objper = json_encode($vetper);

        // direcionamento
        $pag = request('pag');
        $destino = "../$pag";

        // chamada da API passando dados
        // deleta as permissoes do user e cadastra novamente
        try 
        {
            $host = "https://www.colnotrs.app.br/ws/associados-access-cadastro.php?api_token=545d6f5cb1d24a4f7c94e1be01d9f474";
            $body = '{
                "id_tabelionato" : "'.$idt.'" , 
                "id_usuario" : "'.$idu.'" , 
                "token" : "'.$tok.'" , 
                "access" : '.$objper.' 
            }';
            $head = array('Content-Type: application/x-www-form-urlencoded');
            $api = new ApiRest($host);
            $res = $api->post($body, $head); 
            $objeto = json_decode($res);
            if ($objeto->error == true) {
                $destino = "../$pag?msg=api";
            }
        }
        catch(Exception $ex) {
            $destino = "../$pag?msg=bug";
        }

        header('location: '.$destino);
        exit;
    break;
}

// ---------- PROCESSAMENTO ------------
//echo $return;

?>