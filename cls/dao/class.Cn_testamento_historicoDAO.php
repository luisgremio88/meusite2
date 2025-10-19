<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_testamento_historico" 
 */
class Cn_testamento_historicoDAO extends PDO
{
	/**
	 * atributo que representa a conexao com PDF (instancia unica)
	 */
	private $dba;
	
	/**
	 * metodo construtor que ja faz a conexao com o BD
	 */
	public function __construct() {
		$dba = DbAdmin::getInstance();
		$dba->connectDefault();
		$this->dba = $dba->getConn();
	}

	/**
	 * metodo clone do tipo privado previne a clonagem dessa instancia da classe
	 */
	public function __clone(){}

	/**
	 * destrutor do objeto da classe
	 */
	public function __destruct(){}

	/* --------------------------------------------------------- */

	
	/**
	 * metodo que faz a insercao de um registro na tabela Cn_testamento_historico
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$TestamentoTipoXML = $this->dba->quote($obj->getTestamentotipoxml());
		$Nome = $this->dba->quote($obj->getNome());
		$DataNascimento = $this->dba->quote($obj->getDatanascimento());
		$TipoDocumento = $this->dba->quote($obj->getTipodocumento());
		$Documento = $this->dba->quote($obj->getDocumento());
		$DocumentoComplemento = $this->dba->quote($obj->getDocumentocomplemento());
		$Cpf = $this->dba->quote($obj->getCpf());
		$NomeMae = $this->dba->quote($obj->getNomemae());
		$NomePai = $this->dba->quote($obj->getNomepai());
		$Data = $this->dba->quote($obj->getData());
		$Livro = $this->dba->quote($obj->getLivro());
		$LivroComplemento = $this->dba->quote($obj->getLivrocomplemento());
		$Folha = $this->dba->quote($obj->getFolha());
		$FolhaComplemento = $this->dba->quote($obj->getFolhacomplemento());
		$Observacoes = $this->dba->quote($obj->getObservacoes());
		$RevogacaoCidade = $this->dba->quote($obj->getRevogacaocidade());
		$RevogacaoUF = $this->dba->quote($obj->getRevogacaouf());
		$RevogacaoCartorio = $this->dba->quote($obj->getRevogacaocartorio());
		$RevogacaoLivro = $this->dba->quote($obj->getRevogacaolivro());
		$RevogacaoLivroComplemento = $this->dba->quote($obj->getRevogacaolivrocomplemento());
		$RevogacaoFolha = $this->dba->quote($obj->getRevogacaofolha());
		$RevogacaoFolhaComplemento = $this->dba->quote($obj->getRevogacaofolhacomplemento());
		$RevogacaoDataTestamento = $this->dba->quote($obj->getRevogacaodatatestamento());
		$DesconhecidoOutros = $this->dba->quote($obj->getDesconhecidooutros());
		$Numero = $this->dba->quote($obj->getNumero());
		$DataCriacao = $this->dba->quote($obj->getDatacriacao());
		$TestamentoId = $this->dba->quote($obj->getTestamentoid());
		$UsuarioId = $this->dba->quote($obj->getUsuarioid());
		
		//montar o comando SQL
		$sql = "insert into cn_testamento_historico 
				(
				TestamentoTipoXML,
				Nome,
				DataNascimento,
				TipoDocumento,
				Documento,
				DocumentoComplemento,
				Cpf,
				NomeMae,
				NomePai,
				Data,
				Livro,
				LivroComplemento,
				Folha,
				FolhaComplemento,
				Observacoes,
				RevogacaoCidade,
				RevogacaoUF,
				RevogacaoCartorio,
				RevogacaoLivro,
				RevogacaoLivroComplemento,
				RevogacaoFolha,
				RevogacaoFolhaComplemento,
				RevogacaoDataTestamento,
				DesconhecidoOutros,
				Numero,
				DataCriacao,
				TestamentoId,
				UsuarioId
				) 
				values 
				(
				$TestamentoTipoXML,
				$Nome,
				$DataNascimento,
				$TipoDocumento,
				$Documento,
				$DocumentoComplemento,
				$Cpf,
				$NomeMae,
				$NomePai,
				$Data,
				$Livro,
				$LivroComplemento,
				$Folha,
				$FolhaComplemento,
				$Observacoes,
				$RevogacaoCidade,
				$RevogacaoUF,
				$RevogacaoCartorio,
				$RevogacaoLivro,
				$RevogacaoLivroComplemento,
				$RevogacaoFolha,
				$RevogacaoFolhaComplemento,
				$RevogacaoDataTestamento,
				$DesconhecidoOutros,
				$Numero,
				$DataCriacao,
				$TestamentoId,
				$UsuarioId
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_testamento_historico
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$TestamentoHistoricoId = $obj->getTestamentohistoricoid();
		$TestamentoTipoXML = $obj->getTestamentotipoxml();
		$Nome = $obj->getNome();
		$DataNascimento = $obj->getDatanascimento();
		$TipoDocumento = $obj->getTipodocumento();
		$Documento = $obj->getDocumento();
		$DocumentoComplemento = $obj->getDocumentocomplemento();
		$Cpf = $obj->getCpf();
		$NomeMae = $obj->getNomemae();
		$NomePai = $obj->getNomepai();
		$Data = $obj->getData();
		$Livro = $obj->getLivro();
		$LivroComplemento = $obj->getLivrocomplemento();
		$Folha = $obj->getFolha();
		$FolhaComplemento = $obj->getFolhacomplemento();
		$Observacoes = $obj->getObservacoes();
		$RevogacaoCidade = $obj->getRevogacaocidade();
		$RevogacaoUF = $obj->getRevogacaouf();
		$RevogacaoCartorio = $obj->getRevogacaocartorio();
		$RevogacaoLivro = $obj->getRevogacaolivro();
		$RevogacaoLivroComplemento = $obj->getRevogacaolivrocomplemento();
		$RevogacaoFolha = $obj->getRevogacaofolha();
		$RevogacaoFolhaComplemento = $obj->getRevogacaofolhacomplemento();
		$RevogacaoDataTestamento = $obj->getRevogacaodatatestamento();
		$DesconhecidoOutros = $obj->getDesconhecidooutros();
		$Numero = $obj->getNumero();
		$DataCriacao = $obj->getDatacriacao();
		$TestamentoId = $obj->getTestamentoid();
		$UsuarioId = $obj->getUsuarioid();
		
        $campos = '';
        if (!empty($TestamentoTipoXML) || is_numeric($TestamentoTipoXML)) {
        	$campos .= "TestamentoTipoXML=".$this->dba->quote($TestamentoTipoXML).", ";
        }
        if (!empty($Nome) || is_numeric($Nome)) {
        	$campos .= "Nome=".$this->dba->quote($Nome).", ";
        }
        if (!empty($DataNascimento) || is_numeric($DataNascimento)) {
        	$campos .= "DataNascimento=".$this->dba->quote($DataNascimento).", ";
        }
        if (!empty($TipoDocumento) || is_numeric($TipoDocumento)) {
        	$campos .= "TipoDocumento=".$this->dba->quote($TipoDocumento).", ";
        }
        if (!empty($Documento) || is_numeric($Documento)) {
        	$campos .= "Documento=".$this->dba->quote($Documento).", ";
        }
        if (!empty($DocumentoComplemento) || is_numeric($DocumentoComplemento)) {
        	$campos .= "DocumentoComplemento=".$this->dba->quote($DocumentoComplemento).", ";
        }
        if (!empty($Cpf) || is_numeric($Cpf)) {
        	$campos .= "Cpf=".$this->dba->quote($Cpf).", ";
        }
        if (!empty($NomeMae) || is_numeric($NomeMae)) {
        	$campos .= "NomeMae=".$this->dba->quote($NomeMae).", ";
        }
        if (!empty($NomePai) || is_numeric($NomePai)) {
        	$campos .= "NomePai=".$this->dba->quote($NomePai).", ";
        }
        if (!empty($Data) || is_numeric($Data)) {
        	$campos .= "Data=".$this->dba->quote($Data).", ";
        }
        if (!empty($Livro) || is_numeric($Livro)) {
        	$campos .= "Livro=".$this->dba->quote($Livro).", ";
        }
        if (!empty($LivroComplemento) || is_numeric($LivroComplemento)) {
        	$campos .= "LivroComplemento=".$this->dba->quote($LivroComplemento).", ";
        }
        if (!empty($Folha) || is_numeric($Folha)) {
        	$campos .= "Folha=".$this->dba->quote($Folha).", ";
        }
        if (!empty($FolhaComplemento) || is_numeric($FolhaComplemento)) {
        	$campos .= "FolhaComplemento=".$this->dba->quote($FolhaComplemento).", ";
        }
        if (!empty($Observacoes) || is_numeric($Observacoes)) {
        	$campos .= "Observacoes=".$this->dba->quote($Observacoes).", ";
        }
        if (!empty($RevogacaoCidade) || is_numeric($RevogacaoCidade)) {
        	$campos .= "RevogacaoCidade=".$this->dba->quote($RevogacaoCidade).", ";
        }
        if (!empty($RevogacaoUF) || is_numeric($RevogacaoUF)) {
        	$campos .= "RevogacaoUF=".$this->dba->quote($RevogacaoUF).", ";
        }
        if (!empty($RevogacaoCartorio) || is_numeric($RevogacaoCartorio)) {
        	$campos .= "RevogacaoCartorio=".$this->dba->quote($RevogacaoCartorio).", ";
        }
        if (!empty($RevogacaoLivro) || is_numeric($RevogacaoLivro)) {
        	$campos .= "RevogacaoLivro=".$this->dba->quote($RevogacaoLivro).", ";
        }
        if (!empty($RevogacaoLivroComplemento) || is_numeric($RevogacaoLivroComplemento)) {
        	$campos .= "RevogacaoLivroComplemento=".$this->dba->quote($RevogacaoLivroComplemento).", ";
        }
        if (!empty($RevogacaoFolha) || is_numeric($RevogacaoFolha)) {
        	$campos .= "RevogacaoFolha=".$this->dba->quote($RevogacaoFolha).", ";
        }
        if (!empty($RevogacaoFolhaComplemento) || is_numeric($RevogacaoFolhaComplemento)) {
        	$campos .= "RevogacaoFolhaComplemento=".$this->dba->quote($RevogacaoFolhaComplemento).", ";
        }
        if (!empty($RevogacaoDataTestamento) || is_numeric($RevogacaoDataTestamento)) {
        	$campos .= "RevogacaoDataTestamento=".$this->dba->quote($RevogacaoDataTestamento).", ";
        }
        if (!empty($DesconhecidoOutros) || is_numeric($DesconhecidoOutros)) {
        	$campos .= "DesconhecidoOutros=".$this->dba->quote($DesconhecidoOutros).", ";
        }
        if (!empty($Numero) || is_numeric($Numero)) {
        	$campos .= "Numero=".$this->dba->quote($Numero).", ";
        }
        if (!empty($DataCriacao) || is_numeric($DataCriacao)) {
        	$campos .= "DataCriacao=".$this->dba->quote($DataCriacao).", ";
        }
        if (!empty($TestamentoId) || is_numeric($TestamentoId)) {
        	$campos .= "TestamentoId=".$this->dba->quote($TestamentoId).", ";
        }
        if (!empty($UsuarioId) || is_numeric($UsuarioId)) {
        	$campos .= "UsuarioId=".$this->dba->quote($UsuarioId).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_testamento_historico set
				$campos
				where TestamentoHistoricoId = $TestamentoHistoricoId";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_testamento_historico
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$TestamentoHistoricoId = $obj->getTestamentoHistoricoId();
		
		//montar o comando SQL
		$sql = "delete from cn_testamento_historico 
				where TestamentoHistoricoId = $TestamentoHistoricoId";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_testamento_historico conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_testamento_historico $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_testamento_historico
	 */
	public function lastId() {
		return $this->dba->lastInsertId();
	}
    
    
    /**
	 * metodo que permite a execucao de SQL livre
	 */
    public function execSql($sql='') {
    	$vet = array(); //inicializa

    	if (!empty($sql) && $sql!='') {
			$sql = trim($sql);
			$sel = substr($sql,0,6);
            $res = $this->dba->query($sql);
            if (strtolower($sel)=='select') {
				//retorna um vetor associativo
				$vet = $res->fetchAll(PDO::FETCH_ASSOC);
	        } else {
	        	if ($res > 0)
	        		$vet[0]['success'] = $sql;
	        	else 
	        		$vet[0]['failure'] = $sql;
	        }
        } 
		return $vet;
    }
    

	/**
	 * metodo que lista os valores possiveis de uma coluna do tipo enum (ou outra com enumeracao de valores)
	 * @param $coluna string - Nome da coluna do tipo enum
	 * @param $primeiro string - Qual e o primeiro valor do array, por exemplo: Selecione
	 * @param $excluir array - Quais valores nao devem estar no array
	 * return array
	 */
    public function metaValues($coluna, $primeiro = NULL, $excluir = NULL) {
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_testamento_historico WHERE Field = '".$coluna."'");
		$row = $this->dba->fetch($res);
		
		$enum = str_replace("enum(", "", $row['Type']);
		$enum = str_replace("'", "", $enum);
		$enum = substr($enum, 0, strlen($enum) - 1);
		$enum = explode(",", $enum);
		
		if ($excluir) {
			foreach ($enum as $chave=>$campo) {
				foreach ($excluir as $tirar) {
					if ($campo == $tirar) {
						unset($enum[$chave]);
					}
				}
			}
		}
		
		$valores = array();
		$i = 0;
		if ($primeiro) {
			$valores[$i] = $primeiro;
			$i++;
		}
		foreach ($enum as $chave => $campo) {
			$campo = trim($campo);
			$valores[$i] = $campo;
			$i++;
		}
		
		return $valores;
	}
    
    



}
 
	?>