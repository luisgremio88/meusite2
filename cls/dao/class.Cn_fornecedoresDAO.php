<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_fornecedores" 
 */
class Cn_fornecedoresDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_fornecedores
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$nome = $this->dba->quote($obj->getNome());
		$cnpj = $this->dba->quote($obj->getCnpj());
		$status = $this->dba->quote($obj->getStatus());
		$telefone = $this->dba->quote($obj->getTelefone());
		$email = $this->dba->quote($obj->getEmail());
		$endereco = $this->dba->quote($obj->getEndereco());
		$numero = $this->dba->quote($obj->getNumero());
		$complemento = $this->dba->quote($obj->getComplemento());
		$bairro = $this->dba->quote($obj->getBairro());
		$cidade = $this->dba->quote($obj->getCidade());
		$estado = $this->dba->quote($obj->getEstado());
		$data_cadastro = $this->dba->quote($obj->getData_cadastro());
		$observacoes = $this->dba->quote($obj->getObservacoes());
		
		//montar o comando SQL
		$sql = "insert into cn_fornecedores 
				(
				nome,
				cnpj,
				status,
				telefone,
				email,
				endereco,
				numero,
				complemento,
				bairro,
				cidade,
				estado,
				data_cadastro,
				observacoes
				) 
				values 
				(
				$nome,
				$cnpj,
				$status,
				$telefone,
				$email,
				$endereco,
				$numero,
				$complemento,
				$bairro,
				$cidade,
				$estado,
				$data_cadastro,
				$observacoes
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_fornecedores
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$nome = $obj->getNome();
		$cnpj = $obj->getCnpj();
		$status = $obj->getStatus();
		$telefone = $obj->getTelefone();
		$email = $obj->getEmail();
		$endereco = $obj->getEndereco();
		$numero = $obj->getNumero();
		$complemento = $obj->getComplemento();
		$bairro = $obj->getBairro();
		$cidade = $obj->getCidade();
		$estado = $obj->getEstado();
		$data_cadastro = $obj->getData_cadastro();
		$observacoes = $obj->getObservacoes();
		
        $campos = '';
        if (!empty($nome) || is_numeric($nome)) {
        	$campos .= "nome=".$this->dba->quote($nome).", ";
        }
        if (!empty($cnpj) || is_numeric($cnpj)) {
        	$campos .= "cnpj=".$this->dba->quote($cnpj).", ";
        }
        if (!empty($status) || is_numeric($status)) {
        	$campos .= "status=".$this->dba->quote($status).", ";
        }
        if (!empty($telefone) || is_numeric($telefone)) {
        	$campos .= "telefone=".$this->dba->quote($telefone).", ";
        }
        if (!empty($email) || is_numeric($email)) {
        	$campos .= "email=".$this->dba->quote($email).", ";
        }
        if (!empty($endereco) || is_numeric($endereco)) {
        	$campos .= "endereco=".$this->dba->quote($endereco).", ";
        }
        if (!empty($numero) || is_numeric($numero)) {
        	$campos .= "numero=".$this->dba->quote($numero).", ";
        }
        if (!empty($complemento) || is_numeric($complemento)) {
        	$campos .= "complemento=".$this->dba->quote($complemento).", ";
        }
        if (!empty($bairro) || is_numeric($bairro)) {
        	$campos .= "bairro=".$this->dba->quote($bairro).", ";
        }
        if (!empty($cidade) || is_numeric($cidade)) {
        	$campos .= "cidade=".$this->dba->quote($cidade).", ";
        }
        if (!empty($estado) || is_numeric($estado)) {
        	$campos .= "estado=".$this->dba->quote($estado).", ";
        }
        if (!empty($data_cadastro) || is_numeric($data_cadastro)) {
        	$campos .= "data_cadastro=".$this->dba->quote($data_cadastro).", ";
        }
        if (!empty($observacoes) || is_numeric($observacoes)) {
        	$campos .= "observacoes=".$this->dba->quote($observacoes).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_fornecedores set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_fornecedores
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_fornecedores 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_fornecedores conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_fornecedores $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_fornecedores
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_fornecedores WHERE Field = '".$coluna."'");
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