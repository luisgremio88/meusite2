<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_certificados" 
 */
class Cn_certificadosDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_certificados
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$nome = $this->dba->quote($obj->getNome());
		$modalidade = $this->dba->quote($obj->getModalidade());
		$id_usuario = $this->dba->quote($obj->getId_usuario());
		$nome_usuario = $this->dba->quote($obj->getNome_usuario());
		$token = $this->dba->quote($obj->getToken());
		$id_curso_evento = $this->dba->quote($obj->getId_curso_evento());
		$data_evento = $this->dba->quote($obj->getData_evento());
		
		//montar o comando SQL
		$sql = "insert into cn_certificados 
				(
				nome,
				modalidade,
				id_usuario,
				nome_usuario,
				token,
				id_curso_evento,
				data_evento
				) 
				values 
				(
				$nome,
				$modalidade,
				$id_usuario,
				$nome_usuario,
				$token,
				$id_curso_evento,
				$data_evento
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_certificados
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$nome = $obj->getNome();
		$modalidade = $obj->getModalidade();
		$id_usuario = $obj->getId_usuario();
		$nome_usuario = $obj->getNome_usuario();
		$token = $obj->getToken();
		$id_curso_evento = $obj->getId_curso_evento();
		$data_evento = $obj->getData_evento();
		
        $campos = '';
        if (!empty($nome) || is_numeric($nome)) {
        	$campos .= "nome=".$this->dba->quote($nome).", ";
        }
        if (!empty($modalidade) || is_numeric($modalidade)) {
        	$campos .= "modalidade=".$this->dba->quote($modalidade).", ";
        }
        if (!empty($id_usuario) || is_numeric($id_usuario)) {
        	$campos .= "id_usuario=".$this->dba->quote($id_usuario).", ";
        }
        if (!empty($nome_usuario) || is_numeric($nome_usuario)) {
        	$campos .= "nome_usuario=".$this->dba->quote($nome_usuario).", ";
        }
        if (!empty($token) || is_numeric($token)) {
        	$campos .= "token=".$this->dba->quote($token).", ";
        }
        if (!empty($id_curso_evento) || is_numeric($id_curso_evento)) {
        	$campos .= "id_curso_evento=".$this->dba->quote($id_curso_evento).", ";
        }
        if (!empty($data_evento) || is_numeric($data_evento)) {
        	$campos .= "data_evento=".$this->dba->quote($data_evento).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_certificados set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_certificados
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_certificados 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_certificados conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_certificados $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_certificados
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_certificados WHERE Field = '".$coluna."'");
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