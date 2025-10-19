<?php

/** 
 * funcao para gerar o digito do nosso numero 11 (10 dig + 1 dig verificador)
 * recebe o nro e retorna o digito
 */
function gerarDigitoNN($nro) {
    $qtddig = strlen($nro);
    if ($qtddig != 10) return false;
    
    $vetfat = array(3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
    $som = 0;
    for ($i=$qtddig-1; $i>=0; $i--) {
        $dig = substr($nro,$i,1);
        $mul = $dig * $vetfat[$i];
        $som += $mul;
    }
    $res = $som % 11;
    $dnn = 11 - $res;
    if ($dnn == 0 || $dnn == 10 || $dnn == 11)
        $dnn = 0;
    
    return $dnn; //retorna o dígito do nosso numero
}

/**
 * recebe uma data no formata dd/mm/aaaa e retorna no formato mysql
 */
function dataMY($val, $sep = '/') {
	$vet = explode($sep, $val);
	return $vet[2].'-'.$vet[1].'-'.$vet[0];
}

/**
 * log em txt
 */
function logtxt($arq, $txt) {
	$ref = fopen($arq, 'a+');
	fwrite($ref, $txt."\n");
	fclose($ref);
}
// ###############################################################



include('./admin/inc/class.ApiRest.php');

//configs da conta Unicred
$apikey = 'f86f913d-0417-4864-bf8d-241fd9d6df7f';
$codcoo = 9184;
$codben = '162B62923A8B46CFB5E567A23E2D621A';
$codage = 4371;
$codcon = 348473;
$varcon = 38869;
$user = 'svc.bnf.homolog';
$pass = 'uL&CtJ5J';

//gerar o número com dígito
//precisa gerar um novo para cada cobrança
$nroenv = $_REQUEST['nro'];
$nosnro = '1000001000' + $nroenv; 
$dignro = gerarDigitoNN($nosnro);
$nosnro = $nosnro . $dignro;
//die('nosso nro: ' . $nosnro);

//data vencimento
$datenv = $_REQUEST['dat'];
$datven = $datenv; //dataMY($datenv);

//valor cobrado
$valenv = $_REQUEST['val'];
$valcob = number_format($valenv, 2, '.', '');

//autenticacao e geracao do token
$conn = 'https://api.e-unicred.com.br/homolog/oauth2/v2/grant-token';
$body = '{"nomeUsuario": "'.$user.'", "senha": "'.$pass.'"}';
$head = array('Content-Type: application/json','Content-Length: '.strlen($body), 'apiKey: '.$apikey);
$apitok = new ApiRest($conn); 
$restok = $apitok->post($body, $head); 
$objtok = json_decode($restok); 
$token = $objtok->accessToken; 
//$apitok->info();
//$vetpay = $apitok->payload($token); 

//se tem token gera a cobranca, usando o codigo beneficiario (fixo)
if (isset($token) && !empty($token)) 
{
    //com o token de acesso E o cod beneficiario, gera a cobrança
    $conn = 'https://api.e-unicred.com.br/homolog/cobranca/v2/beneficiarios/'.$codben.'/titulos';
    $head = array(
        'Authorization: Bearer '.$token, 'cooperativa: '.$codcoo,
        'apiKey: '.$apikey,
        'Content-Type: application/json'
    );
    $body = array(
        'beneficiarioVariacaoCarteira' => 38869,
        'seuNumero' => '123xxx',
        'valor' => $valcob,
        'vencimento' => $datven,
        'enviaBoletoEmail' => false,
        'nossoNumero' => $nosnro,
        'mensagensFichaCompensacao' => array (
            'Cobranca de Teste '.$nosnro
        ),
        'pagador' => array(
            'nomeRazaoSocial' => 'Fulano que Paga',
            'tipoPessoa' => 'F',
            'numeroDocumento' => '50644313099',
            'tipoDocumento' => 'CPF',
            'nomeFantasia' => 'Fulano',
            'email' => 'fulano@detal.com',
            'endereco' => array (
                'tipoLogradouro' => 'Rua',
                'logradouro' => 'Rua IV',
                'numero' => '1001',
                'complemento' => 'Casa 01',
                'bairro' => 'Centro',
                'cidade' => 'Porto Alegre',
                'uf' => 'RS',
                'cep' => '92000100'
            )
        )
    );
    $body = json_encode($body);
    
    $apicob = new ApiRest($conn); 
    $rescob = $apicob->post($body, $head); 
    /*
    $objcob = json_decode($rescob); 
    if (//$apicob->http_code == 200 && 
        $objcob->httpStatus == 200) {
        echo "Ok. Nosso Nro: $nosnro";
    }
    else {
        echo "Bug: $nosnro";
    }
    echo '<br><br>';
    echo 'Código da execucao da API: '.$apicob->http_code .'<br>';
    echo 'Código do retorno da API: '.$objcob->httpStatus.'<br>';
    echo 'Mensagem do retorno da API: '.$objcob->message.'<br>';
    
    echo '<br><hr><br>';
    print_r($rescob);
    print_r($objcob);
    */

    session_start();
    $_SESSION['codtit'] = $rescob;
    logtxt('integracao-unicred.txt', $rescob);
    header('location: ./integracao-unicred');
} 
else {
    die('Oooopssss');
}
?>