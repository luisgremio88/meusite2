<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_institucional_diretoria_membros" 
 */
class Cn_institucional_diretoria_membrosDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_institucional_diretoria_membros
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$nome = $this->dba->quote($obj->getNome());
		$cargo = $this->dba->quote($obj->getCargo());
		$descricao = $this->dba->quote($obj->getDescricao());
		$ordem = $this->dba->quote($obj->getOrdem());
		$status = $this->dba->quote($obj->getStatus());
		
		//montar o comando SQL
		$sql = "insert into cn_institucional_diretoria_membros 
				(
				nome,
				cargo,
				descricao,
				ordem,
				status
				) 
				values 
				(
				$nome,
				$cargo,
				$descricao,
				$ordem,
				$status
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_institucional_diretoria_membros
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$nome = $obj->getNome();
		$cargo = $obj->getCargo();
		$descricao = $obj->getDescricao();
		$ordem = $obj->getOrdem();
		$status = $obj->getStatus();
		
        $campos = '';
        if (!empty($nome) || is_numeric($nome)) {
        	$campos .= "nome=".$this->dba->quote($nome).", ";
        }
        if (!empty($cargo) || is_numeric($cargo)) {
        	$campos .= "cargo=".$this->dba->quote($cargo).", ";
        }
        if (!empty($descricao) || is_numeric($descricao)) {
        	$campos .= "descricao=".$this->dba->quote($descricao).", ";
        }
        if (!empty($ordem) || is_numeric($ordem)) {
        	$campos .= "ordem=".$this->dba->quote($ordem).", ";
        }
        if (!empty($status) || is_numeric($status)) {
        	$campos .= "status=".$this->dba->quote($status).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_institucional_diretoria_membros set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_institucional_diretoria_membros
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_institucional_diretoria_membros 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_institucional_diretoria_membros conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_institucional_diretoria_membros $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_institucional_diretoria_membros
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_institucional_diretoria_membros WHERE Field = '".$coluna."'");
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