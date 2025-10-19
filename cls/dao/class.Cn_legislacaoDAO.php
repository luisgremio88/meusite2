<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_legislacao" 
 */
class Cn_legislacaoDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_legislacao
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$LegislacaoId = $this->dba->quote($obj->getLegislacaoid());
		$DataLegislacao = $this->dba->quote($obj->getDatalegislacao());
		$TipoEsfera = $this->dba->quote($obj->getTipoesfera());
		$TipoLegislacao = $this->dba->quote($obj->getTipolegislacao());
		$Numero = $this->dba->quote($obj->getNumero());
		$Site = $this->dba->quote($obj->getSite());
		$Resumo = $this->dba->quote($obj->getResumo());
		$Texto = $this->dba->quote($obj->getTexto());
		$Discriminator = $this->dba->quote($obj->getDiscriminator());
		
		//montar o comando SQL
		$sql = "insert into cn_legislacao 
				(
				LegislacaoId,
				DataLegislacao,
				TipoEsfera,
				TipoLegislacao,
				Numero,
				Site,
				Resumo,
				Texto,
				Discriminator
				) 
				values 
				(
				$LegislacaoId,
				$DataLegislacao,
				$TipoEsfera,
				$TipoLegislacao,
				$Numero,
				$Site,
				$Resumo,
				$Texto,
				$Discriminator
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_legislacao
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$LegislacaoId = $obj->getLegislacaoid();
		$DataLegislacao = $obj->getDatalegislacao();
		$TipoEsfera = $obj->getTipoesfera();
		$TipoLegislacao = $obj->getTipolegislacao();
		$Numero = $obj->getNumero();
		$Site = $obj->getSite();
		$Resumo = $obj->getResumo();
		$Texto = $obj->getTexto();
		$Discriminator = $obj->getDiscriminator();
		
        $campos = '';
        if (!empty($LegislacaoId) || is_numeric($LegislacaoId)) {
        	$campos .= "LegislacaoId=".$this->dba->quote($LegislacaoId).", ";
        }
        if (!empty($DataLegislacao) || is_numeric($DataLegislacao)) {
        	$campos .= "DataLegislacao=".$this->dba->quote($DataLegislacao).", ";
        }
        if (!empty($TipoEsfera) || is_numeric($TipoEsfera)) {
        	$campos .= "TipoEsfera=".$this->dba->quote($TipoEsfera).", ";
        }
        if (!empty($TipoLegislacao) || is_numeric($TipoLegislacao)) {
        	$campos .= "TipoLegislacao=".$this->dba->quote($TipoLegislacao).", ";
        }
        if (!empty($Numero) || is_numeric($Numero)) {
        	$campos .= "Numero=".$this->dba->quote($Numero).", ";
        }
        if (!empty($Site) || is_numeric($Site)) {
        	$campos .= "Site=".$this->dba->quote($Site).", ";
        }
        if (!empty($Resumo) || is_numeric($Resumo)) {
        	$campos .= "Resumo=".$this->dba->quote($Resumo).", ";
        }
        if (!empty($Texto) || is_numeric($Texto)) {
        	$campos .= "Texto=".$this->dba->quote($Texto).", ";
        }
        if (!empty($Discriminator) || is_numeric($Discriminator)) {
        	$campos .= "Discriminator=".$this->dba->quote($Discriminator).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_legislacao set
				$campos
				where  = $";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_legislacao
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$ = $obj->get();
		
		//montar o comando SQL
		$sql = "delete from cn_legislacao 
				where  = $";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_legislacao conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_legislacao $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_legislacao
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_legislacao WHERE Field = '".$coluna."'");
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