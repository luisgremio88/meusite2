<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_diretoria" 
 */
class Cn_diretoriaDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_diretoria
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$DiretorId = $this->dba->quote($obj->getDiretorid());
		$Nome = $this->dba->quote($obj->getNome());
		$Profissao = $this->dba->quote($obj->getProfissao());
		$Cartorio = $this->dba->quote($obj->getCartorio());
		$Email = $this->dba->quote($obj->getEmail());
		$Endereco = $this->dba->quote($obj->getEndereco());
		$Bairro = $this->dba->quote($obj->getBairro());
		$Cep = $this->dba->quote($obj->getCep());
		$Telefone = $this->dba->quote($obj->getTelefone());
		$CargoId = $this->dba->quote($obj->getCargoid());
		$MandatoId = $this->dba->quote($obj->getMandatoid());
		$MunicipioId = $this->dba->quote($obj->getMunicipioid());
		
		//montar o comando SQL
		$sql = "insert into cn_diretoria 
				(
				DiretorId,
				Nome,
				Profissao,
				Cartorio,
				Email,
				Endereco,
				Bairro,
				Cep,
				Telefone,
				CargoId,
				MandatoId,
				MunicipioId
				) 
				values 
				(
				$DiretorId,
				$Nome,
				$Profissao,
				$Cartorio,
				$Email,
				$Endereco,
				$Bairro,
				$Cep,
				$Telefone,
				$CargoId,
				$MandatoId,
				$MunicipioId
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_diretoria
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$DiretorId = $obj->getDiretorid();
		$Nome = $obj->getNome();
		$Profissao = $obj->getProfissao();
		$Cartorio = $obj->getCartorio();
		$Email = $obj->getEmail();
		$Endereco = $obj->getEndereco();
		$Bairro = $obj->getBairro();
		$Cep = $obj->getCep();
		$Telefone = $obj->getTelefone();
		$CargoId = $obj->getCargoid();
		$MandatoId = $obj->getMandatoid();
		$MunicipioId = $obj->getMunicipioid();
		
        $campos = '';
        if (!empty($DiretorId) || is_numeric($DiretorId)) {
        	$campos .= "DiretorId=".$this->dba->quote($DiretorId).", ";
        }
        if (!empty($Nome) || is_numeric($Nome)) {
        	$campos .= "Nome=".$this->dba->quote($Nome).", ";
        }
        if (!empty($Profissao) || is_numeric($Profissao)) {
        	$campos .= "Profissao=".$this->dba->quote($Profissao).", ";
        }
        if (!empty($Cartorio) || is_numeric($Cartorio)) {
        	$campos .= "Cartorio=".$this->dba->quote($Cartorio).", ";
        }
        if (!empty($Email) || is_numeric($Email)) {
        	$campos .= "Email=".$this->dba->quote($Email).", ";
        }
        if (!empty($Endereco) || is_numeric($Endereco)) {
        	$campos .= "Endereco=".$this->dba->quote($Endereco).", ";
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
        if (!empty($CargoId) || is_numeric($CargoId)) {
        	$campos .= "CargoId=".$this->dba->quote($CargoId).", ";
        }
        if (!empty($MandatoId) || is_numeric($MandatoId)) {
        	$campos .= "MandatoId=".$this->dba->quote($MandatoId).", ";
        }
        if (!empty($MunicipioId) || is_numeric($MunicipioId)) {
        	$campos .= "MunicipioId=".$this->dba->quote($MunicipioId).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_diretoria set
				$campos
				where  = $";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_diretoria
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$ = $obj->get();
		
		//montar o comando SQL
		$sql = "delete from cn_diretoria 
				where  = $";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_diretoria conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_diretoria $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_diretoria
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_diretoria WHERE Field = '".$coluna."'");
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