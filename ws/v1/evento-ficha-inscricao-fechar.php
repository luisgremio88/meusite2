<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

//ini_set('display_errors', 1);

include('../../admin/inc/inc.configdb.php');
include('../../admin/inc/inc.lib.php');
require_once('../../admin/inc/fpdf/fpdf.php');

$json  	= file_get_contents('php://input');
$obj   	= json_decode($json, true); // var_dump($obj);
$return = ["ok" => false, "msg" => "Parâmetros inválidos."];
$inputFail  = false;

if(isset($obj["ficha_id"])) {

    $idCliente  = 0;
    $id_boleto      = 0;
    $boleto_gerado  = 0;
    $servico = [];
    $result     = [];
    $sqlFicha   = "SELECT * FROM cn_evento_ficha WHERE id = ".$obj["ficha_id"].";";
    $queryFicha = $dba->query($sqlFicha);
    $qntdFicha  = $dba->rows($queryFicha);
    $vetFicha           = $dba->fetch($queryFicha);
    if($vetFicha['finalizado'] == 1) {
        $return = ["ok" => false, "msg" => "Ficha já foi finalizada."];
    } else {

        if ($qntdFicha > 0) {

            $sqlResponsavel         = "SELECT * FROM cn_evento_ficha_participante WHERE ficha_id = ".$obj["ficha_id"]." ORDER BY id ASC LIMIT 1;";
            $queryResponsavel       = $dba->query($sqlResponsavel);
            $vetResponsavel         = $dba->fetch($queryResponsavel);

            $valor              = 0;    
            $sqlServico         = "SELECT 
                COUNT(1) AS qtd,
                SUM(efs.valor)  AS valor,
                es.nome AS servico_nome,
                ept.nome AS participante_tipo_nome,
                epts.nome AS participante_tipo_sub_nome
            FROM cn_evento_ficha_servico efs
            JOIN cn_evento_servico es ON es.id = efs.servico_id
            JOIN cn_evento_participante ep ON ep.id = efs.participante_id
            JOIN cn_evento_participante_tipo ept ON ept.id = ep.tipo_id
            JOIN cn_evento_participante_tipo_sub epts ON epts.id = ep.tipo_sub_id
            WHERE ficha_id = ".$obj["ficha_id"]."
            GROUP BY es.nome, ept.nome, epts.nome;";
            $queryServico       = $dba->query($sqlServico);
            $qntdServico        = $dba->rows($queryServico);
            if ($qntdServico > 0) {
                for($a=0;$a<$qntdServico;$a++) {
                    $vetServico         = $dba->fetch($queryServico);
                    $valor              = $valor+$vetServico['valor'];
                    $servico[]= $vetServico;
                }
            }

            /**
             * Verificar se existe o cliente.
             * Realiza o insert na tabela de clientes, caso não seja um usuário logado e não existir na tabela cn_clientes.
             * Usuário logado auto preenche o endereço.
             */
            if($vetFicha['tabelionato_id'] == 0) {

                $sqlClienteExiste       = "SELECT * FROM cn_clientes WHERE
                    Nome = '".$vetResponsavel["nome"]."' AND 
                    Cpf = '".$vetResponsavel["cpf"]."' AND
                    Email = '".$vetResponsavel["email"]."'";
                $queryClienteExiste     = $dba->query($sqlClienteExiste);
                $qntdClienteExiste      = $dba->rows($queryClienteExiste);

                if($qntdClienteExiste == 0) {

                    $municipioId = 325;

                    $sqlMunicipio   = "SELECT MunicipioId FROM cn_municipio WHERE Nome = '".$vetResponsavel["municipio"]."';";
                    $queryMunicipio = $dba->query($sqlMunicipio);
                    $qntdMunicipio  = $dba->rows($queryMunicipio);
                    if($qntdMunicipio == 1) {
                        $vetMunicipio   = $dba->fetch($queryMunicipio);
                        $municipioId    = $vetMunicipio['MunicipioId'];
                    }

                    $sqlInsertCliente = "INSERT INTO cn_clientes (
                        Endereco, 
                        Numero, 
                        Complemento, 
                        Bairro, 
                        Cep, 
                        Telefone, 
                        MunicipioId, 
                        UsuarioInsertId, 
                        Nome, 
                        Cpf, 
                        Email, 
                        DataCriacao, 
                        ServicoBuscaDados_ServicoBuscaDadosId
                    ) VALUES(
                        '".$vetResponsavel["endereco"]."', 
                        '".$vetResponsavel["endereco_numero"]."', 
                        '".$vetResponsavel["endereco_complemento"]."', 
                        '".$vetResponsavel["bairro"]."', 
                        '".$vetResponsavel["cep"]."', 
                        '".$vetResponsavel["telefone"]."', 
                        $municipioId, 
                        1, 
                        '".$vetResponsavel["nome"]."', 
                        '".$vetResponsavel["cpf"]."', 
                        '".$vetResponsavel["email"]."', 
                        NOW(), 
                        NULL
                    );";
                    $dba->query($sqlInsertCliente);

                    $idCliente = $dba->lastid();
                } else {
                    $vetClienteExiste   = $dba->fetch($queryClienteExiste);
                    $idCliente = $vetClienteExiste['ClienteId'];
                }
            }


            require_once '../../admin/inc/inc.unicred.php';
            $unicred = new UnicredBoleto();

            $pagador = $unicred->getPagador(
                $vetResponsavel["nome"], 
                "F", 
                $vetResponsavel["cpf"], 
                "CPF", 
                $vetResponsavel["nome"], 
                $vetResponsavel["email"], 
                '', 
                $vetResponsavel["endereco"], 
                $vetResponsavel["endereco_numero"], 
                $vetResponsavel["endereco_complemento"], 
                $vetResponsavel["bairro"], 
                $vetResponsavel["municipio"], 
                $vetResponsavel["estado"], 
                $vetResponsavel["cep"]
            );

            $data       = date('Y-m-d H:i:s');
            $sqlBoleto  = "INSERT cn_boleto_unicred(data)VALUES('$data')";
            $dba->query($sqlBoleto);
            $id_boleto  = $dba->lastid();

            $chaveBoleto = $unicred->gerarTituloUnicred($id_boleto, date('Y-m-d'), $valor, $pagador);

            if(is_string($chaveBoleto) && strlen($chaveBoleto) === 32) {
                $sqlBoleto      = "UPDATE cn_boleto_unicred SET chave_boleto = '$chaveBoleto' WHERE id = $id_boleto";
                $dba->query($sqlBoleto);
                $boleto_gerado  = 1;
            } else {
                $sqlBoleto      = "UPDATE cn_boleto_unicred SET msg_resposta = '$chaveBoleto' WHERE id = $id_boleto";
                $dba->query($sqlBoleto);
                $boleto_gerado  = 0;
                $inputFail      = true;
                $return     = array("ok" => false, "msg" => "Erro ao gerar o boleto!");
            }

            $sqlUpdateFicha   = "UPDATE cn_evento_ficha SET boleto_id = $id_boleto, finalizado = 1 WHERE id = ".$obj["ficha_id"].";";
            $dba->query($sqlUpdateFicha);

            if(!$inputFail) {
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
                    'Evento ID: ".$vetFicha["evento_id"]."',
                    3,
                    0,
                    1,
                    0,
                    0,
                    $idCliente,
                    0,
                    0,
                    0,
                    NOW(),
                    NOW(),
                    '".$valor."',
                    1,
                    0,
                    $id_boleto,
                    $boleto_gerado,
                    NULL
                );";
                $dba->query($sql);


                class PDFTestamentoRecibo extends FPDF {
                    public $total = 0;
                    //Page header
                    function Header() {
                        $this->SetFont('Arial', 'B', 10);
                        $this->Cell(70, 6, utf8_decode('RECIBO'), 1, 0, 'C');
                        $this->SetFont('Arial', '', 7);
                        $this->Cell(60, 6, utf8_decode('Nº Recido'), 1, 0, 'L');
                        $this->MultiCell(60, 6, utf8_decode('Data e hora de emissão').': '.date('d/m/Y H:i:s'), 1, 'L');
                
                        $this->SetFont('Arial', 'B', 10);
                        $this->MultiCell(190, 5, utf8_decode('PRESTADOR DE SERVIÇO'), 1, 'C');
                
                        $this->Image('../../admin/img/logo.png', 10, 25, 30);
                
                        $this->SetFont('Arial', 'B', 10);
                        $this->SetY(30);
                        $this->SetX(45);
                        $this->Cell(95, 5, utf8_decode('COLEGIO NOTARIAL DO BRASIL SECAO DO RS'), 0, 0, 'L');
                        $this->SetFont('Arial', '', 10);
                        $this->Cell(40, 5, utf8_decode('Inscrição Municipal: '), 0, 0, 'R');
                        $this->SetFont('Arial', 'B', 10);
                        $this->MultiCell(20, 5, utf8_decode('14142'), 0, 'L');
                
                        $this->SetFont('Arial', '', 10);
                        $this->SetX(45);
                        $this->Cell(25, 5, utf8_decode('CNPJ: '), 0, 0, 'L');
                        $this->SetFont('Arial', 'B', 10);
                        $this->Cell(70, 5, utf8_decode('89.007.082/0001-00'), 0, 0, 'L');
                        $this->SetFont('Arial', '', 10);
                        $this->Cell(40, 5, utf8_decode('CEP: '), 0, 0, 'R');
                        $this->SetFont('Arial', 'B', 10);
                        $this->MultiCell(20, 5, utf8_decode('90110-150'), 0, 'L');
                
                        $this->SetFont('Arial', '', 10);
                        $this->SetX(45);
                        $this->Cell(25, 5, utf8_decode('Munícípio: '), 0, 0, 'L');
                        $this->SetFont('Arial', 'B', 10);
                        $this->Cell(70, 5, utf8_decode('PORTO ALEGRE'), 0, 0, 'L');
                        $this->SetFont('Arial', '', 10);
                        $this->Cell(40, 5, utf8_decode('UF: '), 0, 0, 'R');
                        $this->SetFont('Arial', 'B', 10);
                        $this->MultiCell(20, 5, utf8_decode('RS'), 0, 'L');
                
                        $this->SetFont('Arial', '', 10);
                        $this->SetX(45);
                        $this->Cell(25, 5, utf8_decode('Endereço: '), 0, 0, 'L');
                        $this->SetFont('Arial', 'B', 10);
                        $this->MultiCell(130, 5, utf8_decode('BORGES DE MEDEIROS 2105 BAIRRO PRAIA DE BELAS'), 0, 'L');
                
                        $this->ln(10);
                        $this->MultiCell(190, 5, utf8_decode('DADOS DO CLIENTE'), 1, 'C');
                        $this->ln(10);
                    }
                
                    //Page footer
                    function Footer() {
                        $this->SetY(-30);
                        $this->SetFont('Arial', '', 10);
                        $this->MultiCell(180, 5, utf8_decode('Valor Total do Recibo'), 1, 'C');
                        $this->MultiCell(180, 5, $this->total, 0, 'C');
                        // $this->MultiCell(180, 5, utf8_decode('AV.BORGES DE MEDEIROS, 2105 - SALA 1308'), 0, 'C');
                        // $this->MultiCell(180, 5, utf8_decode('PORTO ALEGRE-RS CEP: 90110-150 FONE: 51 - 3028.3789 FAX: 51 - 3028.3792'), 0, 'C');
                        // $this->MultiCell(180, 5, utf8_decode('www.colegionotarialrs.org.br E-mail: secretaria@colnotrs.org.br\colegio@colnotrs.org.br'), 0, 'C');
                    }
                }
        
                $pdf1 = new PDFTestamentoRecibo();
                $pdf1->total = 'R$ '.number_format($valor,2,',','.');
                $pdf1->AliasNbPages();
                $pdf1->AddPage();
                
                $pdf1->SetFont('Arial', '', 10);
                $pdf1->Cell(30, 5, utf8_decode(stripslashes('Nome / Razão')), 0, 0, 'L');
                $pdf1->SetFont('Arial', 'B', 10);
                $pdf1->Cell(100, 5, utf8_decode(stripslashes($vetResponsavel['nome'])), 0, 0, 'L');
                $pdf1->SetFont('Arial', '', 10);
                $pdf1->Cell(40, 5, '', 0, 0, 'R');
                $pdf1->SetFont('Arial', 'B', 10);
                $pdf1->MultiCell(20, 5, '', 0, 'L');
                
                $pdf1->SetFont('Arial', '', 10);
                $pdf1->Cell(30, 5, utf8_decode('CPF / CNPJ: '), 0, 0, 'L');
                $pdf1->SetFont('Arial', 'B', 10);
                $pdf1->Cell(100, 5, utf8_decode($vetResponsavel['cpf']), 0, 0, 'L');
                $pdf1->SetFont('Arial', '', 10);
                $pdf1->Cell(40, 5, '', 0, 0, 'R');
                $pdf1->SetFont('Arial', 'B', 10);
                $pdf1->MultiCell(20, 5, '', 0, 'L');
                
                $pdf1->SetFont('Arial', '', 10);
                $pdf1->Cell(30, 5, utf8_decode('Endereço: '), 0, 0, 'L');
                $pdf1->SetFont('Arial', 'B', 10);
                $pdf1->MultiCell(160, 5, utf8_decode($vetResponsavel['endereco']), 0, 'L');
                
                
                $pdf1->ln(10);
                $pdf1->MultiCell(190, 5, utf8_decode('DISCRIMINAÇÃO DOS SERVIÇOS'), 1, 'C');
                $pdf1->ln(10);
                
                foreach($servico as $servico) {
                    $pdf1->SetFont('Arial', '', 10);
                    $pdf1->Cell(150, 5, utf8_decode($servico['servico_nome'].' ('.$servico['qtd'].'x)'), 0, 0, 'L');        
                    $pdf1->MultiCell(40, 5, 'R$ '.number_format($servico['valor'],2,',','.'), 0, 'R');
                }
        
                $fileName = "admin/buscas/recibo_ficha_".$obj["ficha_id"].".pdf";
                $pdf1->Output("../../".$fileName, "F");
        
                // GERAR BOLETO
                // LANÇAR EM CONTAS A RECEBER
        
                $result['valor'] = $valor;
                $result['recibo_fileName'] = $fileName;
                $result['boleto_id'] = $id_boleto;
        
                $return = array("ok" => true, "msg" => $result);
            }


        } else {
            $return = ["ok" => false, "msg" => "Ficha não localizada."];
        }
    }
}

header('Content-Type: application/json');
echo json_encode($return);
