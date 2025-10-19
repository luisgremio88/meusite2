<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_mapas_testamentos" 
 */
class Cn_mapas_testamentosDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_mapas_testamentos
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$Mes = $this->dba->quote($obj->getMes());
		$Ano = $this->dba->quote($obj->getAno());
		$BoletoSkyNetId = $this->dba->quote($obj->getBoletoskynetid());
		$DataFechamento = $this->dba->quote($obj->getDatafechamento());
		$DataCriacao = $this->dba->quote($obj->getDatacriacao());
		$TabelionatoId = $this->dba->quote($obj->getTabelionatoid());
		$UsuarioId = $this->dba->quote($obj->getUsuarioid());
		$Situacao = $this->dba->quote($obj->getSituacao());
		$FaturamentoId = $this->dba->quote($obj->getFaturamentoid());
		$Informado = $this->dba->quote($obj->getInformado());
		$AtrasoMotivo = $this->dba->quote($obj->getAtrasomotivo());
		$AtrasoAnexo = $this->dba->quote($obj->getAtrasoanexo());
		$BoletoId = $this->dba->quote($obj->getBoletoid());
		$permitir_excluir = $this->dba->quote($obj->getPermitir_excluir());
		
		//montar o comando SQL
		$sql = "insert into cn_mapas_testamentos 
				(
				Mes,
				Ano,
				BoletoSkyNetId,
				DataFechamento,
				DataCriacao,
				TabelionatoId,
				UsuarioId,
				Situacao,
				FaturamentoId,
				Informado,
				AtrasoMotivo,
				AtrasoAnexo,
				BoletoId,
				permitir_excluir
				) 
				values 
				(
				$Mes,
				$Ano,
				$BoletoSkyNetId,
				$DataFechamento,
				$DataCriacao,
				$TabelionatoId,
				$UsuarioId,
				$Situacao,
				$FaturamentoId,
				$Informado,
				$AtrasoMotivo,
				$AtrasoAnexo,
				$BoletoId,
				$permitir_excluir
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_mapas_testamentos
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$Mes = $obj->getMes();
		$Ano = $obj->getAno();
		$BoletoSkyNetId = $obj->getBoletoskynetid();
		$DataFechamento = $obj->getDatafechamento();
		$DataCriacao = $obj->getDatacriacao();
		$TabelionatoId = $obj->getTabelionatoid();
		$UsuarioId = $obj->getUsuarioid();
		$Situacao = $obj->getSituacao();
		$FaturamentoId = $obj->getFaturamentoid();
		$Informado = $obj->getInformado();
		$AtrasoMotivo = $obj->getAtrasomotivo();
		$AtrasoAnexo = $obj->getAtrasoanexo();
		$BoletoId = $obj->getBoletoid();
		$permitir_excluir = $obj->getPermitir_excluir();
		
        $campos = '';
        if (!empty($Mes) || is_numeric($Mes)) {
        	$campos .= "Mes=".$this->dba->quote($Mes).", ";
        }
        if (!empty($Ano) || is_numeric($Ano)) {
        	$campos .= "Ano=".$this->dba->quote($Ano).", ";
        }
        if (!empty($BoletoSkyNetId) || is_numeric($BoletoSkyNetId)) {
        	$campos .= "BoletoSkyNetId=".$this->dba->quote($BoletoSkyNetId).", ";
        }
        if (!empty($DataFechamento) || is_numeric($DataFechamento)) {
        	$campos .= "DataFechamento=".$this->dba->quote($DataFechamento).", ";
        }
        if (!empty($DataCriacao) || is_numeric($DataCriacao)) {
        	$campos .= "DataCriacao=".$this->dba->quote($DataCriacao).", ";
        }
        if (!empty($TabelionatoId) || is_numeric($TabelionatoId)) {
        	$campos .= "TabelionatoId=".$this->dba->quote($TabelionatoId).", ";
        }
        if (!empty($UsuarioId) || is_numeric($UsuarioId)) {
        	$campos .= "UsuarioId=".$this->dba->quote($UsuarioId).", ";
        }
        if (!empty($Situacao) || is_numeric($Situacao)) {
        	$campos .= "Situacao=".$this->dba->quote($Situacao).", ";
        }
        if (!empty($FaturamentoId) || is_numeric($FaturamentoId)) {
        	$campos .= "FaturamentoId=".$this->dba->quote($FaturamentoId).", ";
        }
        if (!empty($Informado) || is_numeric($Informado)) {
        	$campos .= "Informado=".$this->dba->quote($Informado).", ";
        }
        if (!empty($AtrasoMotivo) || is_numeric($AtrasoMotivo)) {
        	$campos .= "AtrasoMotivo=".$this->dba->quote($AtrasoMotivo).", ";
        }
        if (!empty($AtrasoAnexo) || is_numeric($AtrasoAnexo)) {
        	$campos .= "AtrasoAnexo=".$this->dba->quote($AtrasoAnexo).", ";
        }
        if (!empty($BoletoId) || is_numeric($BoletoId)) {
        	$campos .= "BoletoId=".$this->dba->quote($BoletoId).", ";
        }
        if (!empty($permitir_excluir) || is_numeric($permitir_excluir)) {
        	$campos .= "permitir_excluir=".$this->dba->quote($permitir_excluir).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_mapas_testamentos set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_mapas_testamentos
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_mapas_testamentos 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_mapas_testamentos conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_mapas_testamentos $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_mapas_testamentos
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_mapas_testamentos WHERE Field = '".$coluna."'");
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