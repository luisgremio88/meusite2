<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_contato_assessoria_juridica" 
 */
class Cn_contato_assessoria_juridicaDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_contato_assessoria_juridica
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$nome = $this->dba->quote($obj->getNome());
		$email = $this->dba->quote($obj->getEmail());
		$telefone = $this->dba->quote($obj->getTelefone());
		$profissao = $this->dba->quote($obj->getProfissao());
		$tabelionato = $this->dba->quote($obj->getTabelionato());
		$cidade_estado = $this->dba->quote($obj->getCidade_estado());
		$pergunta = $this->dba->quote($obj->getPergunta());
		$status = $this->dba->quote($obj->getStatus());
		$data_hora_cadastro = $this->dba->quote($obj->getData_hora_cadastro());
		
		//montar o comando SQL
		$sql = "insert into cn_contato_assessoria_juridica 
				(
				nome,
				email,
				telefone,
				profissao,
				tabelionato,
				cidade_estado,
				pergunta,
				status,
				data_hora_cadastro
				) 
				values 
				(
				$nome,
				$email,
				$telefone,
				$profissao,
				$tabelionato,
				$cidade_estado,
				$pergunta,
				$status,
				$data_hora_cadastro
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_contato_assessoria_juridica
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$nome = $obj->getNome();
		$email = $obj->getEmail();
		$telefone = $obj->getTelefone();
		$profissao = $obj->getProfissao();
		$tabelionato = $obj->getTabelionato();
		$cidade_estado = $obj->getCidade_estado();
		$pergunta = $obj->getPergunta();
		$status = $obj->getStatus();
		$data_hora_cadastro = $obj->getData_hora_cadastro();
		
        $campos = '';
        if (!empty($nome) || is_numeric($nome)) {
        	$campos .= "nome=".$this->dba->quote($nome).", ";
        }
        if (!empty($email) || is_numeric($email)) {
        	$campos .= "email=".$this->dba->quote($email).", ";
        }
        if (!empty($telefone) || is_numeric($telefone)) {
        	$campos .= "telefone=".$this->dba->quote($telefone).", ";
        }
        if (!empty($profissao) || is_numeric($profissao)) {
        	$campos .= "profissao=".$this->dba->quote($profissao).", ";
        }
        if (!empty($tabelionato) || is_numeric($tabelionato)) {
        	$campos .= "tabelionato=".$this->dba->quote($tabelionato).", ";
        }
        if (!empty($cidade_estado) || is_numeric($cidade_estado)) {
        	$campos .= "cidade_estado=".$this->dba->quote($cidade_estado).", ";
        }
        if (!empty($pergunta) || is_numeric($pergunta)) {
        	$campos .= "pergunta=".$this->dba->quote($pergunta).", ";
        }
        if (!empty($status) || is_numeric($status)) {
        	$campos .= "status=".$this->dba->quote($status).", ";
        }
        if (!empty($data_hora_cadastro) || is_numeric($data_hora_cadastro)) {
        	$campos .= "data_hora_cadastro=".$this->dba->quote($data_hora_cadastro).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_contato_assessoria_juridica set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_contato_assessoria_juridica
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_contato_assessoria_juridica 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_contato_assessoria_juridica conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_contato_assessoria_juridica $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_contato_assessoria_juridica
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_contato_assessoria_juridica WHERE Field = '".$coluna."'");
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