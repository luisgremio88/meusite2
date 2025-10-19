<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_usuario_admin" 
 */
class Cn_usuario_adminDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_usuario_admin
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$user = $this->dba->quote($obj->getUser());
		$pass = $this->dba->quote($obj->getPass());
		$name = $this->dba->quote($obj->getName());
		$type = $this->dba->quote($obj->getType());
		$status = $this->dba->quote($obj->getStatus());
		$acess_panel = $this->dba->quote($obj->getAcess_panel());
		
		//montar o comando SQL
		$sql = "insert into cn_usuario_admin 
				(
				user,
				pass,
				name,
				type,
				status,
				acess_panel
				) 
				values 
				(
				$user,
				$pass,
				$name,
				$type,
				$status,
				$acess_panel
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_usuario_admin
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$user = $obj->getUser();
		$pass = $obj->getPass();
		$name = $obj->getName();
		$type = $obj->getType();
		$status = $obj->getStatus();
		$acess_panel = $obj->getAcess_panel();
		
        $campos = '';
        if (!empty($user) || is_numeric($user)) {
        	$campos .= "user=".$this->dba->quote($user).", ";
        }
        if (!empty($pass) || is_numeric($pass)) {
        	$campos .= "pass=".$this->dba->quote($pass).", ";
        }
        if (!empty($name) || is_numeric($name)) {
        	$campos .= "name=".$this->dba->quote($name).", ";
        }
        if (!empty($type) || is_numeric($type)) {
        	$campos .= "type=".$this->dba->quote($type).", ";
        }
        if (!empty($status) || is_numeric($status)) {
        	$campos .= "status=".$this->dba->quote($status).", ";
        }
        if (!empty($acess_panel) || is_numeric($acess_panel)) {
        	$campos .= "acess_panel=".$this->dba->quote($acess_panel).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_usuario_admin set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_usuario_admin
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_usuario_admin 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_usuario_admin conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_usuario_admin $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_usuario_admin
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_usuario_admin WHERE Field = '".$coluna."'");
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