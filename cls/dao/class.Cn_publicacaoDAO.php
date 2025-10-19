<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_publicacao" 
 */
class Cn_publicacaoDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_publicacao
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$PublicacaoId = $this->dba->quote($obj->getPublicacaoid());
		$Titulo = $this->dba->quote($obj->getTitulo());
		$Edicao = $this->dba->quote($obj->getEdicao());
		$Tipo = $this->dba->quote($obj->getTipo());
		$DataPublicacao = $this->dba->quote($obj->getDatapublicacao());
		$DataCriacao = $this->dba->quote($obj->getDatacriacao());
		$Site = $this->dba->quote($obj->getSite());
		$Discriminator = $this->dba->quote($obj->getDiscriminator());
		
		//montar o comando SQL
		$sql = "insert into cn_publicacao 
				(
				PublicacaoId,
				Titulo,
				Edicao,
				Tipo,
				DataPublicacao,
				DataCriacao,
				Site,
				Discriminator
				) 
				values 
				(
				$PublicacaoId,
				$Titulo,
				$Edicao,
				$Tipo,
				$DataPublicacao,
				$DataCriacao,
				$Site,
				$Discriminator
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_publicacao
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$PublicacaoId = $obj->getPublicacaoid();
		$Titulo = $obj->getTitulo();
		$Edicao = $obj->getEdicao();
		$Tipo = $obj->getTipo();
		$DataPublicacao = $obj->getDatapublicacao();
		$DataCriacao = $obj->getDatacriacao();
		$Site = $obj->getSite();
		$Discriminator = $obj->getDiscriminator();
		
        $campos = '';
        if (!empty($PublicacaoId) || is_numeric($PublicacaoId)) {
        	$campos .= "PublicacaoId=".$this->dba->quote($PublicacaoId).", ";
        }
        if (!empty($Titulo) || is_numeric($Titulo)) {
        	$campos .= "Titulo=".$this->dba->quote($Titulo).", ";
        }
        if (!empty($Edicao) || is_numeric($Edicao)) {
        	$campos .= "Edicao=".$this->dba->quote($Edicao).", ";
        }
        if (!empty($Tipo) || is_numeric($Tipo)) {
        	$campos .= "Tipo=".$this->dba->quote($Tipo).", ";
        }
        if (!empty($DataPublicacao) || is_numeric($DataPublicacao)) {
        	$campos .= "DataPublicacao=".$this->dba->quote($DataPublicacao).", ";
        }
        if (!empty($DataCriacao) || is_numeric($DataCriacao)) {
        	$campos .= "DataCriacao=".$this->dba->quote($DataCriacao).", ";
        }
        if (!empty($Site) || is_numeric($Site)) {
        	$campos .= "Site=".$this->dba->quote($Site).", ";
        }
        if (!empty($Discriminator) || is_numeric($Discriminator)) {
        	$campos .= "Discriminator=".$this->dba->quote($Discriminator).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_publicacao set
				$campos
				where  = $";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_publicacao
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$ = $obj->get();
		
		//montar o comando SQL
		$sql = "delete from cn_publicacao 
				where  = $";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_publicacao conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_publicacao $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_publicacao
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_publicacao WHERE Field = '".$coluna."'");
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