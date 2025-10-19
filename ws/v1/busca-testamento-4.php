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

require_once('../../admin/inc/inc.configdb.php');
require_once('../../admin/inc/inc.lib.php');
require_once('../../admin/inc/fpdf/fpdf.php');

$json  	    = file_get_contents('php://input');
$obj   	    = json_decode($json, true); // var_dump($obj);
$return     = ["ok" => false, "msg" => "Parâmetros inválidos."];
$inputFail  = false;

if(isset($obj["busca_id"], $obj["cliente_id"], $obj["responsabilizo"])) {

    $cliente_id     = $obj["cliente_id"];
    $busca_id       = $obj["busca_id"];
    $id_boleto      = 0;
    $boleto_gerado  = 0;

    require '../../admin/inc/phpqrcode/qrlib.php';
    $url            = 'https://www.colnotrs.app.br/valid.php?k='.md5($busca_id);
    $fileName       = '../../admin/buscas/qrcode_'.$busca_id.'.png';
    // generating
    if (!file_exists($fileName)) {
        QRcode::png($url, $fileName);
    }

    $sqlBuscaTestamento     = "SELECT * from cn_busca_testamentos WHERE id = ".$obj["busca_id"].";";
    $queryBuscaTestamento   = $dba->query($sqlBuscaTestamento);
    $vetBuscaTestamento     = $dba->fetch($queryBuscaTestamento);
    $qtdBuscaTestamento     = $dba->rows($queryBuscaTestamento);

    $sqlTaxa    = "SELECT * from cn_tabela_de_precos WHERE id = 6;";
    $queryTaxa  = $dba->query($sqlTaxa);
    $vetTaxa    = $dba->fetch($queryTaxa);

    $sqlCliente = "SELECT 
        c.ClienteId,
        c.Endereco,
        c.Numero,
        c.Complemento,
        c.Bairro,
        c.Cep,
        c.Telefone,
        c.Nome,
        c.Cpf,
        c.Email,
        m.Nome AS municipio,
        e.Sigla AS estado
    FROM cn_clientes AS c
    JOIN cn_municipio AS m ON m.MunicipioId = c.MunicipioId 
    JOIN cn_estado AS e ON e.EstadoId = m.EstadoId  
    WHERE c.ClienteId = $cliente_id;";
    $queryCliente   = $dba->query($sqlCliente);
    $vetCliente     = $dba->fetch($queryCliente);

    require_once '../../admin/inc/inc.unicred.php';
    $unicred = new UnicredBoleto();

    // Gerar ID da tabela tabela
    $data       = date('Y-m-d H:i:s');
    $sqlBoleto  = "INSERT cn_boleto_unicred(data)VALUES('$data')";
    $dba->query($sqlBoleto);
    $id_boleto  = $dba->lastid();


    $pagador = $unicred->getPagador(
        $vetCliente["Nome"], 
        "F", 
        $vetCliente["Cpf"], 
        "CPF", 
        $vetCliente["Nome"], 
        $vetCliente["Email"], 
        '', 
        $vetCliente["Endereco"], 
        $vetCliente["Numero"], 
        $vetCliente["Complemento"], 
        $vetCliente["Bairro"], 
        $vetCliente["municipio"], 
        $vetCliente["estado"], 
        $vetCliente["Cep"]
    );
    
    // Gerar chave do boleto e gravar na tabela
    $chaveBoleto = $unicred->gerarTituloUnicred($id_boleto, date('Y-m-d'), $vetTaxa['valor'], $pagador);

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
        // echo 'boleto_denied';
    }

    if(!$inputFail) {
        $sql = "UPDATE cn_busca_testamentos SET 
            pagamento='3', 
            id_boleto=$id_boleto, 
            boleto_gerado=$boleto_gerado,
            responsabilizo='".$obj["responsabilizo"]."'
        WHERE id = '$busca_id'"; //die($sql);
        $dba->query($sql);

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
            'Busca realizada',
            3,
            0,
            1,
            0,
            0,
            $cliente_id,
            0,
            0,
            0,
            NOW(),
            NOW(),
            '".$vetTaxa['valor']."',
            1,
            0,
            $id_boleto,
            $boleto_gerado,
            $busca_id
        );";
        $dba->query($sql);


        $searchCpf = '';
        $searchNome = '';
        $textRecibo = '';

        if(!empty($vetBuscaTestamento['cpf'])) {
            $searchCpf   = " AND t.Cpf = '".$vetBuscaTestamento['cpf']."'";
            $textRecibo  = ' a favor de  CPF: '.$vetBuscaTestamento['cpf'];
        } elseif(!empty($vetBuscaTestamento['nome'])) {
            $searchNome = " AND t.Nome = '".$vetBuscaTestamento['nome']."'";
            $textRecibo = ' a favor de '.$vetBuscaTestamento['nome'];
            if(!empty($vetBuscaTestamento['cpf'])) {
                $textRecibo .= ' (CPF: '.$vetBuscaTestamento['cpf'].')';
            }
        }


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
                $this->MultiCell(190, 5, utf8_decode('TOMADOR DO SERVIÇO'), 1, 'C');
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
        $pdf1->total = 'R$ '.number_format($vetTaxa['valor'],2,',','.');
        $pdf1->AliasNbPages();
        $pdf1->AddPage();
        
        $pdf1->SetFont('Arial', '', 10);
        $pdf1->Cell(30, 5, utf8_decode(stripslashes('Nome / Razão')), 0, 0, 'L');
        $pdf1->SetFont('Arial', 'B', 10);
        $pdf1->Cell(100, 5, utf8_decode(stripslashes($vetCliente['Nome'])), 0, 0, 'L');
        $pdf1->SetFont('Arial', '', 10);
        $pdf1->Cell(40, 5, utf8_decode('Inscrição Municipal: '), 0, 0, 'R');
        $pdf1->SetFont('Arial', 'B', 10);
        $pdf1->MultiCell(20, 5, utf8_decode(''), 0, 'L');
        
        $pdf1->SetFont('Arial', '', 10);
        $pdf1->Cell(30, 5, utf8_decode('CPF / CNPJ: '), 0, 0, 'L');
        $pdf1->SetFont('Arial', 'B', 10);
        $pdf1->Cell(100, 5, utf8_decode($vetCliente['Cpf']), 0, 0, 'L');
        $pdf1->SetFont('Arial', '', 10);
        $pdf1->Cell(40, 5, utf8_decode('CEP: '), 0, 0, 'R');
        $pdf1->SetFont('Arial', 'B', 10);
        $pdf1->MultiCell(20, 5, utf8_decode($vetCliente['Cep']), 0, 'L');
        
        $pdf1->SetFont('Arial', '', 10);
        $pdf1->Cell(30, 5, utf8_decode('Munícípio: '), 0, 0, 'L');
        $pdf1->SetFont('Arial', 'B', 10);
        $pdf1->Cell(100, 5, utf8_decode($vetCliente['municipio']), 0, 0, 'L');
        $pdf1->SetFont('Arial', '', 10);
        $pdf1->Cell(40, 5, utf8_decode('UF: '), 0, 0, 'R');
        $pdf1->SetFont('Arial', 'B', 10);
        $pdf1->MultiCell(20, 5, utf8_decode($vetCliente['estado']), 0, 'L');
        
        $pdf1->SetFont('Arial', '', 10);
        $pdf1->Cell(30, 5, utf8_decode('Endereço: '), 0, 0, 'L');
        $pdf1->SetFont('Arial', 'B', 10);
        $ende = $vetCliente['Endereco'];
        if(!empty($vetCliente['Numero'])) {
            $ende .= ', '.$vetCliente['Numero'];
        }
        if(!empty($vetCliente['Complemento'])) {
            $ende .= ', '.$vetCliente['Complemento'];
        }
        $ende .= ' - '.$vetCliente['Bairro'];
        $pdf1->MultiCell(160, 5, utf8_decode($ende), 0, 'L');
        
        
        $pdf1->ln(10);
        $pdf1->MultiCell(190, 5, utf8_decode('DISCRIMINAÇÃO DOS SERVIÇOS'), 1, 'C');
        $pdf1->ln(10);
        
        $pdf1->SetFont('Arial', '', 10);
        $pdf1->Cell(150, 5, utf8_decode($vetTaxa['titulo']).$textRecibo, 0, 0, 'L');
        $taxa = $vetTaxa['valor'];
        if($gratuito) {
            $taxa = 0;
        }
        $pdf1->MultiCell(40, 5, 'R$ '.number_format($taxa,2,',','.'), 0, 'R');
        
        // $pdf1->Output();
        $pdf1->Output("../../admin/buscas/recibo_$busca_id.pdf", "F");

        $sqlResultado   = "SELECT 
            t.id,
            t.Data AS testamento_data,
            t.Nome AS testador,
            t.Livro AS testamento_livro,
            t.LivroComplemento,
            t.Folha AS testamento_folha,
            t.FolhaComplemento,
            t.DataNascimento, 
            t.Cpf,
            t.NomePai, 
            t.NomeMae,
            t.Numero, 
            t.Observacoes,
            ta.tabelionato,
            ta.municipio AS tabelionato_municipio,
            ta.email AS tabelionato_email,
            ta.telefone AS tabelionato_telefone,
            ta.endereco AS tabelionato_endereco,
            ta.bairro AS tabelionato_bairro,
            ta.numero AS tabelionato_numero,
            tt.Nome AS tipo_testamento
        FROM cn_testamentos t 
        JOIN cr_tabelionatos_associados ta ON ta.id = t.TabelionatoId 
        JOIN cn_testamento_tipo tt ON tt.TestamentoTipoXML = t.TestamentoTipoXML
        WHERE 1 = 1 ".$searchCpf.$searchNome."
        ORDER BY t.id DESC;";
        
        $queryResultado = $dba->query($sqlResultado);
        $qntdResultado  = $dba->rows($queryResultado);
        
        if ($qntdResultado == 0) { // NENHUM RESULTADO
        
            $vetResultado = $dba->fetch($queryResultado);
        
            // $idBusca        = $id;
            $idTestamento   = $vetResultado['id'];
        
            $sql = "UPDATE cn_busca_testamentos SET id_testamento='$idTestamento', qtd_testamento=0, tipo_certidao=0 WHERE id = '$busca_id'";
            $dba->query($sql);
        
            class PDFTestamento1 extends FPDF {
                public $idBusca = 0;
                //Page header
                function Header() {
                    //Logo
                    $this->Image('../../admin/img/logo.png', 10, 8, 30);
                    //Arial bold 15
                    $this->SetFont('Arial', 'B', 14);
                    //Title
                    $this->Cell(0, 15, utf8_decode('Resultado da Busca'), 0, 0, 'C');
                    //Line break
                    $this->Ln(25);
        
                    setlocale(LC_TIME, 'pt_BR.utf-8');
        
                    $this->SetFont('Arial', '', 11);
                    $this->Ln(5);
                    $this->Cell(40, 6, utf8_decode('Consulta nº: '.$this->idBusca));
                    $this->Cell(40, 6, '');
                    $this->Cell(100, 6, utf8_decode('Porto Alegre: '.strftime('%d de %B de %Y', strtotime('today'))), 0, 0, 'R');
                    $this->Ln(15);
                }
        
                //Page footer
                function Footer() {
                    $this->SetY(-30);
                    $this->SetFont('Arial', '', 10);
        
                    $this->Image('../../admin/img/logo.png', 175, 260, 30, 0, 'PNG');
        
                    $this->MultiCell(180, 5, utf8_decode('ARQUIVO CENTRAL DE TESTAMENTOS'), 0, 'C');
                    $this->MultiCell(180, 5, utf8_decode('COLÉGIO NOTARIAL DO BRASIL - SEÇÃO RS'), 0, 'C');
                    $this->MultiCell(180, 5, utf8_decode('AV.BORGES DE MEDEIROS, 2105 - SALA 1308'), 0, 'C');
                    $this->MultiCell(180, 5, utf8_decode('PORTO ALEGRE-RS CEP: 90110-150 FONE: 51 - 3028.3789 FAX: 51 - 3028.3792'), 0, 'C');
                    $this->MultiCell(180, 5, utf8_decode('www.colegionotarialrs.org.br E-mail: secretaria@colnotrs.org.br\colegio@colnotrs.org.br'), 0, 'C');
                }
            }
        
            $pdf = new PDFTestamento1();
            $pdf->idBusca = $idBusca;
            $pdf->AliasNbPages();
            $pdf->AddPage();
        
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(40, 10, 'REQUERENTE');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(45, 6, mb_strtoupper(utf8_decode(stripslashes($vetCliente['Nome']))));
            $pdf->Ln(5);
            $numero = '';
            if(isset($vet2['Numero']) && !empty($vetCliente['Numero'])) {
                $numero = ', nº: '.mb_strtoupper($vetCliente['Numero']);
            }
            $compl = '';
            if(isset($vetCliente['Complemento']) && !empty($vetCliente['Complemento'])) {
                $compl = ' / '.mb_strtoupper($vetCliente['Complemento']);
            }
            $pdf->Cell(45, 6, mb_strtoupper(utf8_encode(stripslashes($vetCliente['Endereco'].$numero.$compl))));
            $pdf->Ln(5);
            $pdf->Cell(45, 6, mb_strtoupper(utf8_decode(stripslashes($vetCliente['Bairro']))));
            $pdf->Ln(5);
            $pdf->Cell(45, 6, mb_strtoupper(utf8_decode(stripslashes($vetCliente['municipio'].' - '.$vetCliente['estado']))));
            

            $textCpf = $vetBuscaTestamento['nome'];
            if(!empty($vetBuscaTestamento['cpf'])) {
                $textCpf .= ' inscrito(a) no CPF/MF sob no '.$vetBuscaTestamento['cpf'];
            }
            $pdf->Ln(25);
            $pdf->MultiCell(180, 6, utf8_decode(stripslashes('O Arquivo Central de Testamentos do Rio Grande do Sul, criado pelo art. 30 da Lei Estadual no. 11.183, de 29 de junho de 1998, instituído pelo provimento no. 09 / 98 - CGJ, e ministrado pelo Colégio Notarial do Brasil - Seção Rio Grande do Sul, por solicitação escrita de V.Sa. informa NÃO EXISTIR registro de testamento comunicado(s) pelo(s) Serviços(s) Notarial(ais) deste Estado, em nome de '.mb_strtoupper($textCpf).'.')));
        
            $pdf->Image('../../admin/buscas/qrcode_'.$busca_id.'.png', 150, 60, 30, 0, 'PNG');
            
            
            // // $pdf->Output();
            $pdf->Output("../../admin/buscas/busca_$busca_id.pdf", "F");
        
        } elseif ($qntdResultado > 0) { // MUITOS RESULTADOS
            $testamentoIds = [];

            class PDFTestamento extends FPDF {
                public $idBusca = 0;
                //Page header
                function Header() {
                    //Logo
                    $this->Image('../../admin/img/logo.png', 10, 8, 30);
                    //Arial bold 15
                    $this->SetFont('Arial', 'B', 14);
                    //Title
                    $this->Cell(0, 15, utf8_decode('Resultado da Busca'), 0, 0, 'C');
                    //Line break
                    $this->Ln(25);

                    setlocale(LC_TIME, 'pt_BR.utf-8');

                    $this->SetFont('Arial', '', 11);
                    $this->Ln(5);
                    $this->Cell(40, 6, utf8_decode('Consulta nº: '.$this->idBusca));
                    $this->Cell(40, 6, '');
                    $this->Cell(100, 6, utf8_decode('Porto Alegre: '.strftime('%d de %B de %Y', strtotime('today'))), 0, 0, 'R');
                    $this->Ln(15);
                }

                //Page footer
                function Footer() {
                    $this->SetY(-30);
                    $this->SetFont('Arial', '', 10);

                    $this->Image('../../admin/img/logo.png', 175, 260, 30, 0, 'PNG');

                    $this->MultiCell(180, 5, utf8_decode('ARQUIVO CENTRAL DE TESTAMENTOS'), 0, 'C');
                    $this->MultiCell(180, 5, utf8_decode('COLÉGIO NOTARIAL DO BRASIL - SEÇÃO RS'), 0, 'C');
                    $this->MultiCell(180, 5, utf8_decode('AV.BORGES DE MEDEIROS, 2105 - SALA 1308'), 0, 'C');
                    $this->MultiCell(180, 5, utf8_decode('PORTO ALEGRE-RS CEP: 90110-150 FONE: 51 - 3028.3789 FAX: 51 - 3028.3792'), 0, 'C');
                    $this->MultiCell(180, 5, utf8_decode('www.colegionotarialrs.org.br E-mail: secretaria@colnotrs.org.br\colegio@colnotrs.org.br'), 0, 'C');
                }
            }

            $pdf = new PDFTestamento();
            $pdf->idBusca = $busca_id;
            $pdf->AliasNbPages();
            $pdf->AddPage();


            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(40, 10, 'REQUERENTE');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(45, 6, mb_strtoupper(utf8_decode(stripslashes($vetCliente['Nome']))));
            $pdf->Ln(5);
            $numero = '';
            if(isset($vet2['Numero']) && !empty($vetCliente['Numero'])) {
                $numero = ', nº: '.mb_strtoupper($vetCliente['Numero']);
            }
            $compl = '';
            if(isset($vetCliente['Complemento']) && !empty($vetCliente['Complemento'])) {
                $compl = ' / '.mb_strtoupper($vetCliente['Complemento']);
            }
            $pdf->Cell(45, 6, mb_strtoupper(utf8_encode(stripslashes($vetCliente['Endereco'].$numero.$compl))));
            $pdf->Ln(5);
            $pdf->Cell(45, 6, mb_strtoupper(utf8_decode(stripslashes($vetCliente['Bairro']))));
            $pdf->Ln(5);
            $pdf->Cell(45, 6, mb_strtoupper(utf8_decode(stripslashes($vetCliente['municipio'].' - '.$vetCliente['estado']))));
            

            $textCpf = $vetBuscaTestamento['nome'];
            if(!empty($vetBuscaTestamento['cpf'])) {
                $textCpf .= ' inscrito(a) no CPF/MF sob no '.$vetBuscaTestamento['cpf'];
            }

            $pdf->Ln(25);
            $pdf->MultiCell(180, 6, utf8_decode(stripslashes('O Arquivo Central de Testamentos do Rio Grande do Sul, criado pelo art. 30 da Lei Estadual no. 11.183, de 29 de junho de 1998, instituído pelo provimento no. 09/98-CGJ, e administrado pelo Colégio Notarial do Brasil - Seção Rio Grande do Sul, por solicitação escrita de V.Sa. informa EXISTIR registro no ATO DE DISPOSIÇÃO DE ÚLTIMA VONTADE comunicado(s) pelo(s) Serviços(s) Notarial(ais) deste Estado, em nome de '.mb_strtoupper($textCpf).'.')));

            for ($i = 0; $i < $qntdResultado; $i++) {
                $vetResultado = $dba->fetch($queryResultado);
                $testamentoIds[] = $vetResultado['id'];    
                $tabText = mb_strtoupper($vetResultado['tabelionato'].' - '.$vetResultado['tabelionato_endereco'].', '.$vetResultado['tabelionato_numero'].' - '.$vetResultado['tabelionato_bairro'].' - '.$vetResultado['tabelionato_municipio'].' - '.$vetResultado['tabelionato_municipio'].' - '.$vetResultado['tabelionato_telefone']);
                    $pdf->Ln(5);
                    $pdf->MultiCell(180, 6, $tabText, 1, 'C');

                    $pdf->Cell(25, 6, utf8_decode('Livro'), 1, 0, 'C');
                    $pdf->Cell(25, 6, utf8_decode('Folha'), 1, 0, 'C');
                    $pdf->Cell(25, 6, utf8_decode('Ato nº'), 1, 0, 'C');
                    $pdf->Cell(35, 6, utf8_decode('Data do ato'), 1, 0, 'C');
                    $pdf->MultiCell(70, 6, utf8_decode('Tipo'), 1, 'C');

                    $pdf->Cell(25, 6, utf8_decode($vetResultado['testamento_livro']), 1, 0, 'C');
                    $pdf->Cell(25, 6, utf8_decode($vetResultado['testamento_folha']), 1, 0, 'C');
                    $pdf->Cell(25, 6, utf8_decode($vetResultado['Numero']), 1, 0, 'C');
                    $pdf->Cell(35, 6, date('d/m/Y', strtotime($vetResultado['testamento_data'])), 1, 0, 'C');
                    $pdf->MultiCell(70, 6, utf8_decode($vetResultado['tipo_testamento']), 1, 'C');
            }
            $sql = "UPDATE cn_busca_testamentos SET id_testamento='".json_encode($testamentoIds)."', qtd_testamento=$qntdResultado, tipo_certidao=1 WHERE id = '$busca_id'";
            $dba->query($sql);

            $pdf->Image('../../admin/buscas/qrcode_'.$busca_id.'.png', 150, 60, 30, 0, 'PNG');
            
            // // $pdf->Output();
            $pdf->Output("../../admin/buscas/busca_$busca_id.pdf", "F");
        }

        $sql = "UPDATE cn_busca_testamentos SET 
            link_certidao='https://www.colnotrs.app.br/admin/buscas/busca_".$busca_id.".pdf', 
            link_recibo='https://www.colnotrs.app.br/admin/buscas/recibo_".$busca_id.".pdf'
        WHERE id = '$busca_id'";
        $dba->query($sql);
        
        $return = array("ok" => true, "msg" => [
            "busca_id" => $busca_id, 
            "cliente_id" => $cliente_id
        ]);
    }

}

header('Content-Type: application/json');
echo json_encode($return);
