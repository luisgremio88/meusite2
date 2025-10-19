<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_observacao_mapas_testamentos" 
 */
class Cn_observacao_mapas_testamentosDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_observacao_mapas_testamentos
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$DescricaoObservacao = $this->dba->quote($obj->getDescricaoobservacao());
		$DataCriacao = $this->dba->quote($obj->getDatacriacao());
		$NomeArquivo = $this->dba->quote($obj->getNomearquivo());
		$CaminhoArquivo = $this->dba->quote($obj->getCaminhoarquivo());
		$UltimaObservacao = $this->dba->quote($obj->getUltimaobservacao());
		$UsuarioId = $this->dba->quote($obj->getUsuarioid());
		$MapasDeTestamentoId = $this->dba->quote($obj->getMapasdetestamentoid());
		
		//montar o comando SQL
		$sql = "insert into cn_observacao_mapas_testamentos 
				(
				DescricaoObservacao,
				DataCriacao,
				NomeArquivo,
				CaminhoArquivo,
				UltimaObservacao,
				UsuarioId,
				MapasDeTestamentoId
				) 
				values 
				(
				$DescricaoObservacao,
				$DataCriacao,
				$NomeArquivo,
				$CaminhoArquivo,
				$UltimaObservacao,
				$UsuarioId,
				$MapasDeTestamentoId
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_observacao_mapas_testamentos
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$ObservacaoMapasDeTestamentosId = $obj->getObservacaomapasdetestamentosid();
		$DescricaoObservacao = $obj->getDescricaoobservacao();
		$DataCriacao = $obj->getDatacriacao();
		$NomeArquivo = $obj->getNomearquivo();
		$CaminhoArquivo = $obj->getCaminhoarquivo();
		$UltimaObservacao = $obj->getUltimaobservacao();
		$UsuarioId = $obj->getUsuarioid();
		$MapasDeTestamentoId = $obj->getMapasdetestamentoid();
		
        $campos = '';
        if (!empty($DescricaoObservacao) || is_numeric($DescricaoObservacao)) {
        	$campos .= "DescricaoObservacao=".$this->dba->quote($DescricaoObservacao).", ";
        }
        if (!empty($DataCriacao) || is_numeric($DataCriacao)) {
        	$campos .= "DataCriacao=".$this->dba->quote($DataCriacao).", ";
        }
        if (!empty($NomeArquivo) || is_numeric($NomeArquivo)) {
        	$campos .= "NomeArquivo=".$this->dba->quote($NomeArquivo).", ";
        }
        if (!empty($CaminhoArquivo) || is_numeric($CaminhoArquivo)) {
        	$campos .= "CaminhoArquivo=".$this->dba->quote($CaminhoArquivo).", ";
        }
        if (!empty($UltimaObservacao) || is_numeric($UltimaObservacao)) {
        	$campos .= "UltimaObservacao=".$this->dba->quote($UltimaObservacao).", ";
        }
        if (!empty($UsuarioId) || is_numeric($UsuarioId)) {
        	$campos .= "UsuarioId=".$this->dba->quote($UsuarioId).", ";
        }
        if (!empty($MapasDeTestamentoId) || is_numeric($MapasDeTestamentoId)) {
        	$campos .= "MapasDeTestamentoId=".$this->dba->quote($MapasDeTestamentoId).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_observacao_mapas_testamentos set
				$campos
				where ObservacaoMapasDeTestamentosId = $ObservacaoMapasDeTestamentosId";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_observacao_mapas_testamentos
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$ObservacaoMapasDeTestamentosId = $obj->getObservacaoMapasDeTestamentosId();
		
		//montar o comando SQL
		$sql = "delete from cn_observacao_mapas_testamentos 
				where ObservacaoMapasDeTestamentosId = $ObservacaoMapasDeTestamentosId";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_observacao_mapas_testamentos conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_observacao_mapas_testamentos $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_observacao_mapas_testamentos
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_observacao_mapas_testamentos WHERE Field = '".$coluna."'");
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