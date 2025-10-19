<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

ini_set('display_errors', 1);

include('../../admin/inc/inc.configdb.php');
include('../../admin/inc/inc.lib.php');

$json  	= file_get_contents('php://input');
$obj   	= json_decode($json, true); // var_dump($obj);
$return = ["ok" => false, "msg" => "Parâmetros inválidos."];
$inputFail  = false;

if(isset($obj["id_mapa"])) {

    require_once '../../admin/inc/inc.unicred.php';
    $unicred = new UnicredBoleto();

    $sqlTaxa    = "SELECT * from cn_tabela_de_precos WHERE id = 7;";
    $queryTaxa  = $dba->query($sqlTaxa);
    $vetTaxa    = $dba->fetch($queryTaxa);

    $sqlMapaF    = "SELECT * FROM cn_mapas_testamentos WHERE Situacao = 0 AND id = ".$obj["id_mapa"].";";
    $queryMapaF  = $dba->query($sqlMapaF);
    $qtdMapaF    = $dba->rows($queryMapaF);

    if($qtdMapaF > 0) {
        $vetMapaF = $dba->fetch($queryMapaF);

        $sqlCliente = "SELECT 
            u.id,
            u.nome,
            u.cpf,
            t.email,
            t.endereco,
            t.municipio
        FROM cn_usuarios_associados u
        JOIN cr_tabelionatos_associados t ON u.TabelionatoVinculadoId = t.id
        WHERE u.TabelionatoVinculadoId = ".$vetMapaF['TabelionatoId']." ORDER BY u.id ASC LIMIT 1;";
        $queryCliente   = $dba->query($sqlCliente);
        $vetCliente     = $dba->fetch($queryCliente);

        $id_boleto  = 0;
        // Gerar ID da tabela tabela
        $data       = date('Y-m-d H:i:s');
        $sqlBoleto  = "INSERT cn_boleto_unicred(data)VALUES('$data')";
        $dba->query($sqlBoleto);
        $id_boleto  = $dba->lastid();

        $pagador = $unicred->getPagador(
            $vetCliente["nome"], 
            "F", 
            $vetCliente["cpf"], 
            "CPF", // "CPF"
            '', //$vetCliente["Nome"], 
            $vetCliente["email"], 
            '', 
            $vetCliente["endereco"], 
            '', //$vetCliente["Numero"], 
            '', //$vetCliente["Complemento"], 
            '', //$vetCliente["Bairro"], 
            $vetCliente["municipio"], 
            'RS', //$vetCliente["estado"], 
            '90000000', //$vetCliente["Cep"]
        );
        
        // Gerar chave do boleto e gravar na tabela
        $chaveBoleto = $unicred->gerarTituloUnicred($id_boleto, date('Y-m-d'), $vetTaxa['valor'], $pagador);

        // var_dump($chaveBoleto);

        if(is_string($chaveBoleto) && strlen($chaveBoleto) === 32) {
            $clienteId      = $vetCliente["id"];
            $sqlBoleto      = "UPDATE cn_boleto_unicred SET chave_boleto = '$chaveBoleto' WHERE id = $id_boleto";
            $dba->query($sqlBoleto);
            $sql = "INSERT INTO cn_contas_pagar_receber(
                descricao,
                recebimento_tipo,
                recebimento_usuario,
                recebimento_cliente,
                recebimento_fornecedor,
                usuario_id,
                cliente_id,
                fornecedor_id,
                evento_id,
                status,
                data_cadastro, 
                data_vcto, 
                valor,
                categoria,
                subcategoria,
                id_boleto,
                boleto_gerado,
                id_consulta
            ) VALUES (
                'Fechamento de mapa',
                3,
                1,
                0,
                0,
                $clienteId,
                0,                    
                0,
                0,
                0,
                NOW(),
                NOW(),
                '".$vetTaxa['valor']."',
                1,
                0,
                $id_boleto,
                1,
                0
            );";
            $dba->query($sql);
        } else {
            $inputFail      = true;
            $return = array("ok" => false, "msg" => 'Error ao gerar o boleto');
            $sqlBoleto      = "UPDATE cn_boleto_unicred SET msg_resposta = '$chaveBoleto' WHERE id = $id_boleto";
            $dba->query($sqlBoleto);
        }     

        if(!$inputFail) {
            $sql = "UPDATE cn_mapas_testamentos SET Situacao = 1, BoletoId = $id_boleto WHERE Mes = '".$mes."' AND Ano = '".$ano."' AND TabelionatoId = ".$vetMapaF['TabelionatoId'].";";
            $dba->query($sql);

            $mes1 = date('m');
            $ano1 = date('Y');

            $sql1 = "INSERT INTO cn_mapas_testamentos(Mes,Ano,DataCriacao,TabelionatoId,Situacao)VALUES('".$mes1."','".$ano1."','".date('Y-m-d H:i:s')."','".$vetTab['id']."',0);";
            $res1 = $dba->query($sql1);

            $return = array("ok" => true, "msg" => 'Mapa fachado com sucesso');
        }

    } else {
        $return = array("ok" => false, "msg" => 'O mapa já está fachado');
    }
}

header('Content-Type: application/json');
echo json_encode($return);
