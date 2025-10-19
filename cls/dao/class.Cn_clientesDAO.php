<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_clientes" 
 */
class Cn_clientesDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_clientes
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$Endereco = $this->dba->quote($obj->getEndereco());
		$Numero = $this->dba->quote($obj->getNumero());
		$Complemento = $this->dba->quote($obj->getComplemento());
		$Bairro = $this->dba->quote($obj->getBairro());
		$Cep = $this->dba->quote($obj->getCep());
		$Telefone = $this->dba->quote($obj->getTelefone());
		$MunicipioId = $this->dba->quote($obj->getMunicipioid());
		$UsuarioInsertId = $this->dba->quote($obj->getUsuarioinsertid());
		$Nome = $this->dba->quote($obj->getNome());
		$Cpf = $this->dba->quote($obj->getCpf());
		$Email = $this->dba->quote($obj->getEmail());
		$DataCriacao = $this->dba->quote($obj->getDatacriacao());
		$ServicoBuscaDados_ServicoBuscaDadosId = $this->dba->quote($obj->getServicobuscadados_servicobuscadadosid());
		
		//montar o comando SQL
		$sql = "insert into cn_clientes 
				(
				Endereco,
				Numero,
				Complemento,
				Bairro,
				Cep,
				Telefone,
				MunicipioId,
				UsuarioInsertId,
				Nome,
				Cpf,
				Email,
				DataCriacao,
				ServicoBuscaDados_ServicoBuscaDadosId
				) 
				values 
				(
				$Endereco,
				$Numero,
				$Complemento,
				$Bairro,
				$Cep,
				$Telefone,
				$MunicipioId,
				$UsuarioInsertId,
				$Nome,
				$Cpf,
				$Email,
				$DataCriacao,
				$ServicoBuscaDados_ServicoBuscaDadosId
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_clientes
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$ClienteId = $obj->getClienteid();
		$Endereco = $obj->getEndereco();
		$Numero = $obj->getNumero();
		$Complemento = $obj->getComplemento();
		$Bairro = $obj->getBairro();
		$Cep = $obj->getCep();
		$Telefone = $obj->getTelefone();
		$MunicipioId = $obj->getMunicipioid();
		$UsuarioInsertId = $obj->getUsuarioinsertid();
		$Nome = $obj->getNome();
		$Cpf = $obj->getCpf();
		$Email = $obj->getEmail();
		$DataCriacao = $obj->getDatacriacao();
		$ServicoBuscaDados_ServicoBuscaDadosId = $obj->getServicobuscadados_servicobuscadadosid();
		
        $campos = '';
        if (!empty($Endereco) || is_numeric($Endereco)) {
        	$campos .= "Endereco=".$this->dba->quote($Endereco).", ";
        }
        if (!empty($Numero) || is_numeric($Numero)) {
        	$campos .= "Numero=".$this->dba->quote($Numero).", ";
        }
        if (!empty($Complemento) || is_numeric($Complemento)) {
        	$campos .= "Complemento=".$this->dba->quote($Complemento).", ";
        }
        if (!empty($Bairro) || is_numeric($Bairro)) {
        	$campos .= "Bairro=".$this->dba->quote($Bairro).", ";
        }
        if (!empty($Cep) || is_numeric($Cep)) {
        	$campos .= "Cep=".$this->dba->quote($Cep).", ";
        }
        if (!empty($Telefone) || is_numeric($Telefone)) {
        	$campos .= "Telefone=".$this->dba->quote($Telefone).", ";
        }
        if (!empty($MunicipioId) || is_numeric($MunicipioId)) {
        	$campos .= "MunicipioId=".$this->dba->quote($MunicipioId).", ";
        }
        if (!empty($UsuarioInsertId) || is_numeric($UsuarioInsertId)) {
        	$campos .= "UsuarioInsertId=".$this->dba->quote($UsuarioInsertId).", ";
        }
        if (!empty($Nome) || is_numeric($Nome)) {
        	$campos .= "Nome=".$this->dba->quote($Nome).", ";
        }
        if (!empty($Cpf) || is_numeric($Cpf)) {
        	$campos .= "Cpf=".$this->dba->quote($Cpf).", ";
        }
        if (!empty($Email) || is_numeric($Email)) {
        	$campos .= "Email=".$this->dba->quote($Email).", ";
        }
        if (!empty($DataCriacao) || is_numeric($DataCriacao)) {
        	$campos .= "DataCriacao=".$this->dba->quote($DataCriacao).", ";
        }
        if (!empty($ServicoBuscaDados_ServicoBuscaDadosId) || is_numeric($ServicoBuscaDados_ServicoBuscaDadosId)) {
        	$campos .= "ServicoBuscaDados_ServicoBuscaDadosId=".$this->dba->quote($ServicoBuscaDados_ServicoBuscaDadosId).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_clientes set
				$campos
				where ClienteId = $ClienteId";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_clientes
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$ClienteId = $obj->getClienteId();
		
		//montar o comando SQL
		$sql = "delete from cn_clientes 
				where ClienteId = $ClienteId";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_clientes conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_clientes $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_clientes
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_clientes WHERE Field = '".$coluna."'");
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