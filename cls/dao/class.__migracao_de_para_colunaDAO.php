<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "__migracao_de_para_coluna" 
 */
class __migracao_de_para_colunaDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela __migracao_de_para_coluna
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$id__migracao_de_para = $this->dba->quote($obj->getId__migracao_de_para());
		$coluna_clone_nome = $this->dba->quote($obj->getColuna_clone_nome());
		$coluna_clone_tipo = $this->dba->quote($obj->getColuna_clone_tipo());
		$coluna_admin_nome = $this->dba->quote($obj->getColuna_admin_nome());
		$coluna_admin_tipo = $this->dba->quote($obj->getColuna_admin_tipo());
		
		//montar o comando SQL
		$sql = "insert into __migracao_de_para_coluna 
				(
				id__migracao_de_para,
				coluna_clone_nome,
				coluna_clone_tipo,
				coluna_admin_nome,
				coluna_admin_tipo
				) 
				values 
				(
				$id__migracao_de_para,
				$coluna_clone_nome,
				$coluna_clone_tipo,
				$coluna_admin_nome,
				$coluna_admin_tipo
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela __migracao_de_para_coluna
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$id__migracao_de_para = $obj->getId__migracao_de_para();
		$coluna_clone_nome = $obj->getColuna_clone_nome();
		$coluna_clone_tipo = $obj->getColuna_clone_tipo();
		$coluna_admin_nome = $obj->getColuna_admin_nome();
		$coluna_admin_tipo = $obj->getColuna_admin_tipo();
		
        $campos = '';
        if (!empty($id__migracao_de_para) || is_numeric($id__migracao_de_para)) {
        	$campos .= "id__migracao_de_para=".$this->dba->quote($id__migracao_de_para).", ";
        }
        if (!empty($coluna_clone_nome) || is_numeric($coluna_clone_nome)) {
        	$campos .= "coluna_clone_nome=".$this->dba->quote($coluna_clone_nome).", ";
        }
        if (!empty($coluna_clone_tipo) || is_numeric($coluna_clone_tipo)) {
        	$campos .= "coluna_clone_tipo=".$this->dba->quote($coluna_clone_tipo).", ";
        }
        if (!empty($coluna_admin_nome) || is_numeric($coluna_admin_nome)) {
        	$campos .= "coluna_admin_nome=".$this->dba->quote($coluna_admin_nome).", ";
        }
        if (!empty($coluna_admin_tipo) || is_numeric($coluna_admin_tipo)) {
        	$campos .= "coluna_admin_tipo=".$this->dba->quote($coluna_admin_tipo).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update __migracao_de_para_coluna set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela __migracao_de_para_coluna
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from __migracao_de_para_coluna 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela __migracao_de_para_coluna conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from __migracao_de_para_coluna $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela __migracao_de_para_coluna
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM __migracao_de_para_coluna WHERE Field = '".$coluna."'");
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