<?php
require_once('../config/inc.functions.php');
require_once('../config/inc.autoload.php');
checkSession();

function sum_time() {
    $i = 0;
    foreach (func_get_args() as $time) {
        sscanf($time, '%d:%d', $hour, $min);
        $i += $hour * 60 + $min;
    }
    if ($h = floor($i / 60)) {
        $i %= 60;
    }
    return sprintf('%02d:%02d', $h, $i);
}

//-------------------------------

    $act = request('act');
    //$act = base64_decode($act);

    switch ($act) 
    {
        case 'checkout':
            $idp = request('idp');
            $idn = request('idn');
            $urlRedirect = '../payments?err=1';

            //pega os dados da pessoa e endereço da API 
            //passa esses dados para o array
            $host = "45.165.84.169/dedstudio/api/boletos.php?act=uni&idp=$idp&idn=$idn";
            $body = '';
            $head = array(
                'Content-Type:application/json' , 
                'Content-Length:'.strlen($body) , 
                'Accept: text/json'
            );
            $api = new ApiRest($host);
            $res = $api->get($body, $head); 

            $vetbol = json_decode($res);
            foreach ($vetbol->boletos as $objbol) 
            {
                $boleto = get_object_vars($objbol);
                //dados do pagamento
                $idp = $boleto['idp'];
                $matricula = $boleto['matricula'];
                $conta = $boleto['conta'];
                $chave = $boleto['chave'];
                $vencimento = $boleto['vencimento'];
                $nrprest = $boleto['nrprest'];
                $situacao = $boleto['situacao'];
                $validade = $boleto['validade'];
                $valprest = $boleto['valprest'];
                //dados do sócio
                $idn = $boleto['idn'];
                $nome = $boleto['nome'];
                $dtnascim = $boleto['dtnascim'];
                $cpf = trim($boleto['cpf']);
                $celular = trim($boleto['celular']);
                $uf = trim($boleto['uf']);
                $municipio = trim($boleto['municipio']);
                $endresi = trim($boleto['endresi']);
                $nrresi  = trim($boleto['nrresi']);
                $comresi = trim($boleto['comresi']);
                $bairesi = trim($boleto['bairesi']);
                $cepresi = trim($boleto['cepresi']);
                $emaresi = trim($boleto['emaresi']);
                //ajustes
                $dtnascim = datetime_date($dtnascim);
                $celular = fone_pagseg($celular);
                $dddcode = substr($celular, 0, 2);
                $numcel = substr($celular,2);
                $valprest = moeda_pagseg($valprest);

                $codigoref = "$idp-$matricula-$nrprest";
                $vetpag = array(
                    'currency' => 'BRL',
                    'senderName' => $nome,
                    'senderAreaCode' => $dddcode,
                    'senderPhone' => $numcel,
                    'senderCPF' =>  $cpf,
                    'senderBornDate' => $dtnascim,
                    'senderEmail' => $emaresi,
                    'reference' => $codigoref,

                    'regionCode' => $uf,
                    'city' => $municipio,
                    'postalCode' => $cepresi,
                    'street' => $endresi,
                    'number' => $nrresi,
                    'locality' => $bairesi,
                    'complement'=> "'".$comresi."'",

                    'itemId1' => $idp,
                    'itemDescription1' => 'Cobrança CPG',
                    'itemAmount1' => $valprest,
                    'itemQuantity1' => 1,
                );
                // showObject($vetpag);

                // HML
                // $codigoref = rand(1000,9990);
                // $vetpag = array(
                //     'currency' => 'BRL',
                //     'senderName' => 'Odair Souza',
                //     'senderAreaCode' => '51',
                //     'senderPhone' => '982419900',
                //     'senderCPF' =>  '95667890097',
                //     'senderBornDate' => '1978-09-25',
                //     'senderEmail' => 'contato@odix.com.br',
                //     'reference' => $codigoref,

                //     'regionCode' => 'RS',
                //     'city' => 'Porto Alegre',
                //     'postalCode' => '90520310',
                //     'street' => 'Rua Portugal',
                //     'number' => '499',
                //     'locality' => 'São João',
                //     'complement'=> '301',

                //     'itemId1' => '0001',
                //     'itemDescription1' => 'Cobrança CPG',
                //     'itemAmount1' => 100,
                //     'itemQuantity1' => 1,
                // );

                $pagSeguro = new PagSeguro();
                $pagamento = $pagSeguro->linkPagamento($vetpag);
                
                if(isset($pagamento->error_messages)){
                    $code = $pagamento->error_messages[0]->error;
                    $parm = $pagamento->error_messages[0]->parameter_name;
                    $urlRedirect = '../payments?code='.$code.'&param='.$parm;
                }
                else {
                    $json = json_encode($pagamento);
                    //grava no banco para controle
                    $now = date('Y-m-d H:i:s');
                    $objchk = new Pag_checkouts();
                    $objchk->setCheckout($json);
                    $objchk->setCodigoref($codigoref);
                    $objchk->setCreatedat($now);
                    $objchk->setStatus('A');
                    $daochk = new Pag_checkoutsDAO();
                    $daochk->insert($objchk);

                    //direciona
                    $vet = $pagamento->links;
                    $urlRedirect = $vet[1]->href;
                }
            }
            header('Location: '.$urlRedirect);
            exit;
        break;
    }

//out
header("location: /site/");
//---
?>;