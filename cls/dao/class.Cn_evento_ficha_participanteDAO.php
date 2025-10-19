<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_evento_ficha_participante" 
 */
class Cn_evento_ficha_participanteDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_evento_ficha_participante
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$ficha_id = $this->dba->quote($obj->getFicha_id());
		$participante_id = $this->dba->quote($obj->getParticipante_id());
		$nome = $this->dba->quote($obj->getNome());
		$cpf = $this->dba->quote($obj->getCpf());
		$endereco = $this->dba->quote($obj->getEndereco());
		$telefone = $this->dba->quote($obj->getTelefone());
		$email = $this->dba->quote($obj->getEmail());
		$endereco_numero = $this->dba->quote($obj->getEndereco_numero());
		$endereco_complemento = $this->dba->quote($obj->getEndereco_complemento());
		$bairro = $this->dba->quote($obj->getBairro());
		$municipio = $this->dba->quote($obj->getMunicipio());
		$estado = $this->dba->quote($obj->getEstado());
		$cep = $this->dba->quote($obj->getCep());
		
		//montar o comando SQL
		$sql = "insert into cn_evento_ficha_participante 
				(
				ficha_id,
				participante_id,
				nome,
				cpf,
				endereco,
				telefone,
				email,
				endereco_numero,
				endereco_complemento,
				bairro,
				municipio,
				estado,
				cep
				) 
				values 
				(
				$ficha_id,
				$participante_id,
				$nome,
				$cpf,
				$endereco,
				$telefone,
				$email,
				$endereco_numero,
				$endereco_complemento,
				$bairro,
				$municipio,
				$estado,
				$cep
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_evento_ficha_participante
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$ficha_id = $obj->getFicha_id();
		$participante_id = $obj->getParticipante_id();
		$nome = $obj->getNome();
		$cpf = $obj->getCpf();
		$endereco = $obj->getEndereco();
		$telefone = $obj->getTelefone();
		$email = $obj->getEmail();
		$endereco_numero = $obj->getEndereco_numero();
		$endereco_complemento = $obj->getEndereco_complemento();
		$bairro = $obj->getBairro();
		$municipio = $obj->getMunicipio();
		$estado = $obj->getEstado();
		$cep = $obj->getCep();
		
        $campos = '';
        if (!empty($ficha_id) || is_numeric($ficha_id)) {
        	$campos .= "ficha_id=".$this->dba->quote($ficha_id).", ";
        }
        if (!empty($participante_id) || is_numeric($participante_id)) {
        	$campos .= "participante_id=".$this->dba->quote($participante_id).", ";
        }
        if (!empty($nome) || is_numeric($nome)) {
        	$campos .= "nome=".$this->dba->quote($nome).", ";
        }
        if (!empty($cpf) || is_numeric($cpf)) {
        	$campos .= "cpf=".$this->dba->quote($cpf).", ";
        }
        if (!empty($endereco) || is_numeric($endereco)) {
        	$campos .= "endereco=".$this->dba->quote($endereco).", ";
        }
        if (!empty($telefone) || is_numeric($telefone)) {
        	$campos .= "telefone=".$this->dba->quote($telefone).", ";
        }
        if (!empty($email) || is_numeric($email)) {
        	$campos .= "email=".$this->dba->quote($email).", ";
        }
        if (!empty($endereco_numero) || is_numeric($endereco_numero)) {
        	$campos .= "endereco_numero=".$this->dba->quote($endereco_numero).", ";
        }
        if (!empty($endereco_complemento) || is_numeric($endereco_complemento)) {
        	$campos .= "endereco_complemento=".$this->dba->quote($endereco_complemento).", ";
        }
        if (!empty($bairro) || is_numeric($bairro)) {
        	$campos .= "bairro=".$this->dba->quote($bairro).", ";
        }
        if (!empty($municipio) || is_numeric($municipio)) {
        	$campos .= "municipio=".$this->dba->quote($municipio).", ";
        }
        if (!empty($estado) || is_numeric($estado)) {
        	$campos .= "estado=".$this->dba->quote($estado).", ";
        }
        if (!empty($cep) || is_numeric($cep)) {
        	$campos .= "cep=".$this->dba->quote($cep).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_evento_ficha_participante set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_evento_ficha_participante
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_evento_ficha_participante 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_evento_ficha_participante conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_evento_ficha_participante $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_evento_ficha_participante
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_evento_ficha_participante WHERE Field = '".$coluna."'");
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