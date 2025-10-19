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
$falha  = false;

if(isset($obj["anexo"], $obj["id_tabelionato"], $obj["id_mapa"], $obj["id_ususario_logado"])) {

    $sqlMapa    = "SELECT * FROM cn_mapas_testamentos WHERE id = ".$obj["id_mapa"]." AND TabelionatoId = ".$obj["id_tabelionato"].";";
    $queryMapa  = $dba->query($sqlMapa);
    $qntdMapa   = $dba->rows($queryMapa);
    if ($qntdMapa == 1) {
        $vetMapa = $dba->fetch($queryMapa);

        $anx = $obj['anexo'];

        if(!$falha) {

            // if (!empty($anx)) {  
            //     $type = explode('/', mime_content_type($anx))[1];
            //     if ($type == 'xml') { 
            //         $return = array("ok" => false, "msg" => "Tipo de anexo invalido, deve ser um XML");
            //         $falha  = true;
            //     } 
            //     // Decodifica a string Base64 em dados binários
            //     $data = substr($anx, strpos($anx, ',') + 1); 
            //     $data = base64_decode($data); 
            //     // Verifica se a decodificação foi bem-sucedida
            //     if ($data === false) { 
            //         $return = array("ok" => false, "msg" => "Falha ao decodificar anexo");
            //         $falha  = true;
            //     } 
            //     // Verificar diretorio
            //     $diretorio_upload = "../../files/testamento/".date("Y")."-".date("m")."-".date("d")."/";
            //     if(!is_dir($diretorio_upload)) { 
            //         mkdir($diretorio_upload, 0775, true); 
            //         chmod($diretorio_upload, 0775);
            //     }
            //     $arquivo = $idc.'.'.$type;
            //     // Salva a imagem decodificada no caminho especificado
            //     file_put_contents($diretorio_upload.$arquivo, $data);
            //     // Caminho do arquivo anexo
            //     $anexo = str_replace("../../", "", $diretorio_upload).$arquivo; 
            // }

            $anexo          = 'teste2.xml';
            $anexoSize      = filesize($anexo);
            $anexoContent   = base64_encode(file_get_contents($anexo));
            $xml            = simplexml_load_file($anexo);

            if(isset($xml->Testamento)) {

                $testamentoQtd = count($xml->Testamento);
                $testamentoArr = $xml->Testamento;

                $sqlInsertImportacao = "INSERT INTO TestamentoImportacao 
                (NomeArquivo, Arquivo, Tamanho, Quantidade, Digitado, DataInicial, DataFinal, DataCriacao, TabelionatoId, UsuarioInsertId, MapasDeTestamentosId, QuantidadePartes, QuantidadeTestamentos) VALUES
                ('".$anexo."', '".$anexoContent."', '".$anexoSize."', ".$testamentoQtd.", 0, '".date('Y-m-01')."', '".date("Y-m-t")."', '".date('Y-m-d')."', '".$obj["id_tabelionato"]."', '".$obj["id_ususario_logado"]."', '".$obj["id_mapa"]."', ".$testamentoQtd.", ".$testamentoQtd.");";

                $dba->query($sqlInsertImportacao);
                $idImportacao       = $dba->lastid();
                $inseriuTestamento  = 0;

                foreach($testamentoArr as $testam) {

                    $sqlExiste = "SELECT 1 FROM cn_testamentos WHERE 
                        TestamentoTipoXML = '".$testam->TipoTestamento."' AND
                        Nome = '".$testam->Nome."' AND 
                        DataNascimento = '".$testam->DataNascimento."' AND
                        TipoDocumento = '".$testam->TipoDocumento."' AND
                        Documento = '".$testam->Documento."' AND
                        DocumentoComplemento = '".$testam->DocumentoComplemento."' AND
                        Cpf = '".$testam->Cpf."' AND
                        NomeMae = '".$testam->NomeMae."' AND
                        NomePai = '".$testam->NomePai."' AND
                        Data = '".$testam->DataTestamento."' AND
                        Livro = '".$testam->Livro."' AND
                        LivroComplemento = '".$testam->LivroComplemento."' AND
                        Folha = '".$testam->Folha."' AND
                        FolhaComplemento = '".$testam->FolhaComplemento."' AND
                        RevogacaoCidade = '".$testam->RevogacaoCidade."' AND
                        RevogacaoUF = '".$testam->RevogacaoUF."' AND
                        RevogacaoCartorio = '".$testam->RevogacaoCartorio."' AND
                        RevogacaoLivro = '".$testam->RevogacaoLivro."' AND
                        RevogacaoLivroComplemento = '".$testam->RevogacaoLivroComplemento."' AND
                        RevogacaoFolha = '".$testam->Folha."' AND
                        RevogacaoFolhaComplemento = '".$testam->RevogacaoFolhaComplemento."' AND
                        TabelionatoId = '".$obj["id_tabelionato"]."';";
                    
                    $queryExiste  = $dba->query($sqlExiste);
                    $qntdExiste   = $dba->rows($queryExiste);

                    if($qntdExiste == 0) {
                        $sqlInsertTestamento = "INSERT INTO cn_testamentos (TestamentoTipoXML, Nome, DataNascimento, TipoDocumento, Documento, DocumentoComplemento, Cpf, NomeMae, NomePai, Data, Livro, LivroComplemento, Folha, FolhaComplemento, RevogacaoCidade, RevogacaoUF, RevogacaoCartorio, RevogacaoLivro, RevogacaoLivroComplemento, RevogacaoFolha, RevogacaoFolhaComplemento, TabelionatoId, TestamentoImportacaoId) VALUES ('".$testam->TipoTestamento."', '".$testam->Nome."','".$testam->DataNascimento."', '".$testam->TipoDocumento."', '".$testam->Documento."', '".$testam->DocumentoComplemento."', '".$testam->Cpf."', '".$testam->NomeMae."', '".$testam->NomePai."', '".$testam->DataTestamento."', '".$testam->Livro."', '".$testam->LivroComplemento."', '".$testam->Folha."', '".$testam->FolhaComplemento."', '".$testam->RevogacaoCidade."', '".$testam->RevogacaoUF."', '".$testam->RevogacaoCartorio."', '".$testam->RevogacaoLivro."', '".$testam->RevogacaoLivroComplemento."', '".$testam->Folha."', '".$testam->RevogacaoFolhaComplemento."', '".$obj["id_tabelionato"]."', '".$idImportacao."');";

                        if($dba->query($sqlInsertTestamento) == 1) {
                            $inseriuTestamento++;
                        }

                    }

                    // echo '<pre>';
                    // var_dump($qntdExiste);
                    // var_dump($sqlExiste);
                    // echo '</pre>';
                }

                if($inseriuTestamento === $testamentoQtd) {
                    $return = ["ok" => true, "msg" => "XML importado com sucesso!", "quantidadeTestamento" => $testamentoQtd];
                } else {
                    $sqlUpdateImportacao = "UPDATE TestamentoImportacao SET Quantidade = 0, QuantidadePartes = 0, QuantidadeTestamentos = 0 WHERE TestamentoImportacaoId = $idImportacao";
                    $dba->query($sqlUpdateImportacao);
                    $return = ["ok" => false, "msg" => "Ocorreu um erro ao inserir os testamentos, tente novamente."];
                }
            } else {
                $return = ["ok" => false, "msg" => "XML fora do padrão definido."];
            }
        }

    } else {
        $return = ["ok" => false, "msg" => "O Mapa de testamento não foi localizado."];
    }

}

header('Content-Type: application/json');
echo json_encode($return);
