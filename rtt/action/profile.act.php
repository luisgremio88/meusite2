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


    
}

// ---------- PROCESSAMENTO ------------
//echo $return;

?>