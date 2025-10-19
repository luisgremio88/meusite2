<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cr_tabelionatos_associados" 
 */
class Cr_tabelionatos_associadosDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cr_tabelionatos_associados
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$bairro = $this->dba->quote($obj->getBairro());
		$codigo = $this->dba->quote($obj->getCodigo());
		$email = $this->dba->quote($obj->getEmail());
		$endereco = $this->dba->quote($obj->getEndereco());
		$horario_de_funcionamento = $this->dba->quote($obj->getHorario_de_funcionamento());
		$latitude = $this->dba->quote($obj->getLatitude());
		$logradouro = $this->dba->quote($obj->getLogradouro());
		$longitude = $this->dba->quote($obj->getLongitude());
		$municipio = $this->dba->quote($obj->getMunicipio());
		$numero = $this->dba->quote($obj->getNumero());
		$tabeliao = $this->dba->quote($obj->getTabeliao());
		$tabelionato = $this->dba->quote($obj->getTabelionato());
		$telefone = $this->dba->quote($obj->getTelefone());
		$testamento_manual = $this->dba->quote($obj->getTestamento_manual());
		
		//montar o comando SQL
		$sql = "insert into cr_tabelionatos_associados 
				(
				bairro,
				codigo,
				email,
				endereco,
				horario_de_funcionamento,
				latitude,
				logradouro,
				longitude,
				municipio,
				numero,
				tabeliao,
				tabelionato,
				telefone,
				testamento_manual
				) 
				values 
				(
				$bairro,
				$codigo,
				$email,
				$endereco,
				$horario_de_funcionamento,
				$latitude,
				$logradouro,
				$longitude,
				$municipio,
				$numero,
				$tabeliao,
				$tabelionato,
				$telefone,
				$testamento_manual
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cr_tabelionatos_associados
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$bairro = $obj->getBairro();
		$codigo = $obj->getCodigo();
		$email = $obj->getEmail();
		$endereco = $obj->getEndereco();
		$horario_de_funcionamento = $obj->getHorario_de_funcionamento();
		$latitude = $obj->getLatitude();
		$logradouro = $obj->getLogradouro();
		$longitude = $obj->getLongitude();
		$municipio = $obj->getMunicipio();
		$numero = $obj->getNumero();
		$tabeliao = $obj->getTabeliao();
		$tabelionato = $obj->getTabelionato();
		$telefone = $obj->getTelefone();
		$testamento_manual = $obj->getTestamento_manual();
		
        $campos = '';
        if (!empty($bairro) || is_numeric($bairro)) {
        	$campos .= "bairro=".$this->dba->quote($bairro).", ";
        }
        if (!empty($codigo) || is_numeric($codigo)) {
        	$campos .= "codigo=".$this->dba->quote($codigo).", ";
        }
        if (!empty($email) || is_numeric($email)) {
        	$campos .= "email=".$this->dba->quote($email).", ";
        }
        if (!empty($endereco) || is_numeric($endereco)) {
        	$campos .= "endereco=".$this->dba->quote($endereco).", ";
        }
        if (!empty($horario_de_funcionamento) || is_numeric($horario_de_funcionamento)) {
        	$campos .= "horario_de_funcionamento=".$this->dba->quote($horario_de_funcionamento).", ";
        }
        if (!empty($latitude) || is_numeric($latitude)) {
        	$campos .= "latitude=".$this->dba->quote($latitude).", ";
        }
        if (!empty($logradouro) || is_numeric($logradouro)) {
        	$campos .= "logradouro=".$this->dba->quote($logradouro).", ";
        }
        if (!empty($longitude) || is_numeric($longitude)) {
        	$campos .= "longitude=".$this->dba->quote($longitude).", ";
        }
        if (!empty($municipio) || is_numeric($municipio)) {
        	$campos .= "municipio=".$this->dba->quote($municipio).", ";
        }
        if (!empty($numero) || is_numeric($numero)) {
        	$campos .= "numero=".$this->dba->quote($numero).", ";
        }
        if (!empty($tabeliao) || is_numeric($tabeliao)) {
        	$campos .= "tabeliao=".$this->dba->quote($tabeliao).", ";
        }
        if (!empty($tabelionato) || is_numeric($tabelionato)) {
        	$campos .= "tabelionato=".$this->dba->quote($tabelionato).", ";
        }
        if (!empty($telefone) || is_numeric($telefone)) {
        	$campos .= "telefone=".$this->dba->quote($telefone).", ";
        }
        if (!empty($testamento_manual) || is_numeric($testamento_manual)) {
        	$campos .= "testamento_manual=".$this->dba->quote($testamento_manual).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cr_tabelionatos_associados set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cr_tabelionatos_associados
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cr_tabelionatos_associados 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cr_tabelionatos_associados conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cr_tabelionatos_associados $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cr_tabelionatos_associados
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cr_tabelionatos_associados WHERE Field = '".$coluna."'");
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