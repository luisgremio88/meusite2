<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Testamentoimportacao" 
 */
class TestamentoimportacaoDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Testamentoimportacao
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$NomeArquivo = $this->dba->quote($obj->getNomearquivo());
		$Arquivo = $this->dba->quote($obj->getArquivo());
		$Tamanho = $this->dba->quote($obj->getTamanho());
		$Quantidade = $this->dba->quote($obj->getQuantidade());
		$Digitado = $this->dba->quote($obj->getDigitado());
		$DataInicial = $this->dba->quote($obj->getDatainicial());
		$DataFinal = $this->dba->quote($obj->getDatafinal());
		$DataCriacao = $this->dba->quote($obj->getDatacriacao());
		$TabelionatoId = $this->dba->quote($obj->getTabelionatoid());
		$UsuarioInsertId = $this->dba->quote($obj->getUsuarioinsertid());
		$MapasDeTestamentosId = $this->dba->quote($obj->getMapasdetestamentosid());
		$QuantidadePartes = $this->dba->quote($obj->getQuantidadepartes());
		$QuantidadeTestamentos = $this->dba->quote($obj->getQuantidadetestamentos());
		
		//montar o comando SQL
		$sql = "insert into TestamentoImportacao 
				(
				NomeArquivo,
				Arquivo,
				Tamanho,
				Quantidade,
				Digitado,
				DataInicial,
				DataFinal,
				DataCriacao,
				TabelionatoId,
				UsuarioInsertId,
				MapasDeTestamentosId,
				QuantidadePartes,
				QuantidadeTestamentos
				) 
				values 
				(
				$NomeArquivo,
				$Arquivo,
				$Tamanho,
				$Quantidade,
				$Digitado,
				$DataInicial,
				$DataFinal,
				$DataCriacao,
				$TabelionatoId,
				$UsuarioInsertId,
				$MapasDeTestamentosId,
				$QuantidadePartes,
				$QuantidadeTestamentos
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Testamentoimportacao
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$TestamentoImportacaoId = $obj->getTestamentoimportacaoid();
		$NomeArquivo = $obj->getNomearquivo();
		$Arquivo = $obj->getArquivo();
		$Tamanho = $obj->getTamanho();
		$Quantidade = $obj->getQuantidade();
		$Digitado = $obj->getDigitado();
		$DataInicial = $obj->getDatainicial();
		$DataFinal = $obj->getDatafinal();
		$DataCriacao = $obj->getDatacriacao();
		$TabelionatoId = $obj->getTabelionatoid();
		$UsuarioInsertId = $obj->getUsuarioinsertid();
		$MapasDeTestamentosId = $obj->getMapasdetestamentosid();
		$QuantidadePartes = $obj->getQuantidadepartes();
		$QuantidadeTestamentos = $obj->getQuantidadetestamentos();
		
        $campos = '';
        if (!empty($NomeArquivo) || is_numeric($NomeArquivo)) {
        	$campos .= "NomeArquivo=".$this->dba->quote($NomeArquivo).", ";
        }
        if (!empty($Arquivo) || is_numeric($Arquivo)) {
        	$campos .= "Arquivo=".$this->dba->quote($Arquivo).", ";
        }
        if (!empty($Tamanho) || is_numeric($Tamanho)) {
        	$campos .= "Tamanho=".$this->dba->quote($Tamanho).", ";
        }
        if (!empty($Quantidade) || is_numeric($Quantidade)) {
        	$campos .= "Quantidade=".$this->dba->quote($Quantidade).", ";
        }
        if (!empty($Digitado) || is_numeric($Digitado)) {
        	$campos .= "Digitado=".$this->dba->quote($Digitado).", ";
        }
        if (!empty($DataInicial) || is_numeric($DataInicial)) {
        	$campos .= "DataInicial=".$this->dba->quote($DataInicial).", ";
        }
        if (!empty($DataFinal) || is_numeric($DataFinal)) {
        	$campos .= "DataFinal=".$this->dba->quote($DataFinal).", ";
        }
        if (!empty($DataCriacao) || is_numeric($DataCriacao)) {
        	$campos .= "DataCriacao=".$this->dba->quote($DataCriacao).", ";
        }
        if (!empty($TabelionatoId) || is_numeric($TabelionatoId)) {
        	$campos .= "TabelionatoId=".$this->dba->quote($TabelionatoId).", ";
        }
        if (!empty($UsuarioInsertId) || is_numeric($UsuarioInsertId)) {
        	$campos .= "UsuarioInsertId=".$this->dba->quote($UsuarioInsertId).", ";
        }
        if (!empty($MapasDeTestamentosId) || is_numeric($MapasDeTestamentosId)) {
        	$campos .= "MapasDeTestamentosId=".$this->dba->quote($MapasDeTestamentosId).", ";
        }
        if (!empty($QuantidadePartes) || is_numeric($QuantidadePartes)) {
        	$campos .= "QuantidadePartes=".$this->dba->quote($QuantidadePartes).", ";
        }
        if (!empty($QuantidadeTestamentos) || is_numeric($QuantidadeTestamentos)) {
        	$campos .= "QuantidadeTestamentos=".$this->dba->quote($QuantidadeTestamentos).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update TestamentoImportacao set
				$campos
				where TestamentoImportacaoId = $TestamentoImportacaoId";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Testamentoimportacao
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$TestamentoImportacaoId = $obj->getTestamentoImportacaoId();
		
		//montar o comando SQL
		$sql = "delete from TestamentoImportacao 
				where TestamentoImportacaoId = $TestamentoImportacaoId";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Testamentoimportacao conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from TestamentoImportacao $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Testamentoimportacao
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM TestamentoImportacao WHERE Field = '".$coluna."'");
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