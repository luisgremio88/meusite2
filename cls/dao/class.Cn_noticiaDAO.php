<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_noticia" 
 */
class Cn_noticiaDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_noticia
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$Titulo = $this->dba->quote($obj->getTitulo());
		$Resumo = $this->dba->quote($obj->getResumo());
		$Texto = $this->dba->quote($obj->getTexto());
		$Destaque = $this->dba->quote($obj->getDestaque());
		$Tags = $this->dba->quote($obj->getTags());
		$Link = $this->dba->quote($obj->getLink());
		$Externo = $this->dba->quote($obj->getExterno());
		$DataPublicacao = $this->dba->quote($obj->getDatapublicacao());
		$DataCriacao = $this->dba->quote($obj->getDatacriacao());
		$TipoNoticia = $this->dba->quote($obj->getTiponoticia());
		$Associado = $this->dba->quote($obj->getAssociado());
		$status = $this->dba->quote($obj->getStatus());
		$anexo = $this->dba->quote($obj->getAnexo());
		
		//montar o comando SQL
		$sql = "insert into cn_noticia 
				(
				Titulo,
				Resumo,
				Texto,
				Destaque,
				Tags,
				Link,
				Externo,
				DataPublicacao,
				DataCriacao,
				TipoNoticia,
				Associado,
				status,
				anexo
				) 
				values 
				(
				$Titulo,
				$Resumo,
				$Texto,
				$Destaque,
				$Tags,
				$Link,
				$Externo,
				$DataPublicacao,
				$DataCriacao,
				$TipoNoticia,
				$Associado,
				$status,
				$anexo
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_noticia
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$Titulo = $obj->getTitulo();
		$Resumo = $obj->getResumo();
		$Texto = $obj->getTexto();
		$Destaque = $obj->getDestaque();
		$Tags = $obj->getTags();
		$Link = $obj->getLink();
		$Externo = $obj->getExterno();
		$DataPublicacao = $obj->getDatapublicacao();
		$DataCriacao = $obj->getDatacriacao();
		$TipoNoticia = $obj->getTiponoticia();
		$Associado = $obj->getAssociado();
		$status = $obj->getStatus();
		$anexo = $obj->getAnexo();
		
        $campos = '';
        if (!empty($Titulo) || is_numeric($Titulo)) {
        	$campos .= "Titulo=".$this->dba->quote($Titulo).", ";
        }
        if (!empty($Resumo) || is_numeric($Resumo)) {
        	$campos .= "Resumo=".$this->dba->quote($Resumo).", ";
        }
        if (!empty($Texto) || is_numeric($Texto)) {
        	$campos .= "Texto=".$this->dba->quote($Texto).", ";
        }
        if (!empty($Destaque) || is_numeric($Destaque)) {
        	$campos .= "Destaque=".$this->dba->quote($Destaque).", ";
        }
        if (!empty($Tags) || is_numeric($Tags)) {
        	$campos .= "Tags=".$this->dba->quote($Tags).", ";
        }
        if (!empty($Link) || is_numeric($Link)) {
        	$campos .= "Link=".$this->dba->quote($Link).", ";
        }
        if (!empty($Externo) || is_numeric($Externo)) {
        	$campos .= "Externo=".$this->dba->quote($Externo).", ";
        }
        if (!empty($DataPublicacao) || is_numeric($DataPublicacao)) {
        	$campos .= "DataPublicacao=".$this->dba->quote($DataPublicacao).", ";
        }
        if (!empty($DataCriacao) || is_numeric($DataCriacao)) {
        	$campos .= "DataCriacao=".$this->dba->quote($DataCriacao).", ";
        }
        if (!empty($TipoNoticia) || is_numeric($TipoNoticia)) {
        	$campos .= "TipoNoticia=".$this->dba->quote($TipoNoticia).", ";
        }
        if (!empty($Associado) || is_numeric($Associado)) {
        	$campos .= "Associado=".$this->dba->quote($Associado).", ";
        }
        if (!empty($status) || is_numeric($status)) {
        	$campos .= "status=".$this->dba->quote($status).", ";
        }
        if (!empty($anexo) || is_numeric($anexo)) {
        	$campos .= "anexo=".$this->dba->quote($anexo).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_noticia set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_noticia
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_noticia 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_noticia conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_noticia $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_noticia
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_noticia WHERE Field = '".$coluna."'");
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