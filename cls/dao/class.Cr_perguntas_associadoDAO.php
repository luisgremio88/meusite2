<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cr_perguntas_associado" 
 */
class Cr_perguntas_associadoDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cr_perguntas_associado
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$id_associado = $this->dba->quote($obj->getId_associado());
		$telefone = $this->dba->quote($obj->getTelefone());
		$email = $this->dba->quote($obj->getEmail());
		$nome = $this->dba->quote($obj->getNome());
		$mensagem = $this->dba->quote($obj->getMensagem());
		$data_registro = $this->dba->quote($obj->getData_registro());
		$status = $this->dba->quote($obj->getStatus());
		$assunto = $this->dba->quote($obj->getAssunto());
		$serventia = $this->dba->quote($obj->getServentia());
		$categoria = $this->dba->quote($obj->getCategoria());
		
		//montar o comando SQL
		$sql = "insert into cr_perguntas_associado 
				(
				id_associado,
				telefone,
				email,
				nome,
				mensagem,
				data_registro,
				status,
				assunto,
				serventia,
				categoria
				) 
				values 
				(
				$id_associado,
				$telefone,
				$email,
				$nome,
				$mensagem,
				$data_registro,
				$status,
				$assunto,
				$serventia,
				$categoria
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cr_perguntas_associado
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$id_associado = $obj->getId_associado();
		$telefone = $obj->getTelefone();
		$email = $obj->getEmail();
		$nome = $obj->getNome();
		$mensagem = $obj->getMensagem();
		$data_registro = $obj->getData_registro();
		$status = $obj->getStatus();
		$assunto = $obj->getAssunto();
		$serventia = $obj->getServentia();
		$categoria = $obj->getCategoria();
		
        $campos = '';
        if (!empty($id_associado) || is_numeric($id_associado)) {
        	$campos .= "id_associado=".$this->dba->quote($id_associado).", ";
        }
        if (!empty($telefone) || is_numeric($telefone)) {
        	$campos .= "telefone=".$this->dba->quote($telefone).", ";
        }
        if (!empty($email) || is_numeric($email)) {
        	$campos .= "email=".$this->dba->quote($email).", ";
        }
        if (!empty($nome) || is_numeric($nome)) {
        	$campos .= "nome=".$this->dba->quote($nome).", ";
        }
        if (!empty($mensagem) || is_numeric($mensagem)) {
        	$campos .= "mensagem=".$this->dba->quote($mensagem).", ";
        }
        if (!empty($data_registro) || is_numeric($data_registro)) {
        	$campos .= "data_registro=".$this->dba->quote($data_registro).", ";
        }
        if (!empty($status) || is_numeric($status)) {
        	$campos .= "status=".$this->dba->quote($status).", ";
        }
        if (!empty($assunto) || is_numeric($assunto)) {
        	$campos .= "assunto=".$this->dba->quote($assunto).", ";
        }
        if (!empty($serventia) || is_numeric($serventia)) {
        	$campos .= "serventia=".$this->dba->quote($serventia).", ";
        }
        if (!empty($categoria) || is_numeric($categoria)) {
        	$campos .= "categoria=".$this->dba->quote($categoria).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cr_perguntas_associado set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cr_perguntas_associado
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cr_perguntas_associado 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cr_perguntas_associado conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cr_perguntas_associado $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cr_perguntas_associado
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cr_perguntas_associado WHERE Field = '".$coluna."'");
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