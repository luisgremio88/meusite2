<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cr_emolumentos" 
 */
class Cr_emolumentosDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cr_emolumentos
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$ano = $this->dba->quote($obj->getAno());
		$vigencia = $this->dba->quote($obj->getVigencia());
		$observacoes = $this->dba->quote($obj->getObservacoes());
		$anexo_emolumentos = $this->dba->quote($obj->getAnexo_emolumentos());
		$anexo_certidoes = $this->dba->quote($obj->getAnexo_certidoes());
		
		//montar o comando SQL
		$sql = "insert into cr_emolumentos 
				(
				ano,
				vigencia,
				observacoes,
				anexo_emolumentos,
				anexo_certidoes
				) 
				values 
				(
				$ano,
				$vigencia,
				$observacoes,
				$anexo_emolumentos,
				$anexo_certidoes
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cr_emolumentos
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$ano = $obj->getAno();
		$vigencia = $obj->getVigencia();
		$observacoes = $obj->getObservacoes();
		$anexo_emolumentos = $obj->getAnexo_emolumentos();
		$anexo_certidoes = $obj->getAnexo_certidoes();
		
        $campos = '';
        if (!empty($ano) || is_numeric($ano)) {
        	$campos .= "ano=".$this->dba->quote($ano).", ";
        }
        if (!empty($vigencia) || is_numeric($vigencia)) {
        	$campos .= "vigencia=".$this->dba->quote($vigencia).", ";
        }
        if (!empty($observacoes) || is_numeric($observacoes)) {
        	$campos .= "observacoes=".$this->dba->quote($observacoes).", ";
        }
        if (!empty($anexo_emolumentos) || is_numeric($anexo_emolumentos)) {
        	$campos .= "anexo_emolumentos=".$this->dba->quote($anexo_emolumentos).", ";
        }
        if (!empty($anexo_certidoes) || is_numeric($anexo_certidoes)) {
        	$campos .= "anexo_certidoes=".$this->dba->quote($anexo_certidoes).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cr_emolumentos set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cr_emolumentos
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cr_emolumentos 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cr_emolumentos conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cr_emolumentos $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cr_emolumentos
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cr_emolumentos WHERE Field = '".$coluna."'");
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