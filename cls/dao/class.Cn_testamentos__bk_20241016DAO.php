<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_testamentos__bk_20241016" 
 */
class Cn_testamentos__bk_20241016DAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_testamentos__bk_20241016
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$id_tabelionato = $this->dba->quote($obj->getId_tabelionato());
		$tipo_testamento = $this->dba->quote($obj->getTipo_testamento());
		$data_testamento = $this->dba->quote($obj->getData_testamento());
		$cpf = $this->dba->quote($obj->getCpf());
		$nome = $this->dba->quote($obj->getNome());
		$data_nascimento = $this->dba->quote($obj->getData_nascimento());
		$nome_mae = $this->dba->quote($obj->getNome_mae());
		$nome_pai = $this->dba->quote($obj->getNome_pai());
		$numero_ato = $this->dba->quote($obj->getNumero_ato());
		$livro = $this->dba->quote($obj->getLivro());
		$livro_complemento = $this->dba->quote($obj->getLivro_complemento());
		$folha = $this->dba->quote($obj->getFolha());
		$folha_complemento = $this->dba->quote($obj->getFolha_complemento());
		$observacoes = $this->dba->quote($obj->getObservacoes());
		
		//montar o comando SQL
		$sql = "insert into cn_testamentos__BK_20241016 
				(
				id_tabelionato,
				tipo_testamento,
				data_testamento,
				cpf,
				nome,
				data_nascimento,
				nome_mae,
				nome_pai,
				numero_ato,
				livro,
				livro_complemento,
				folha,
				folha_complemento,
				observacoes
				) 
				values 
				(
				$id_tabelionato,
				$tipo_testamento,
				$data_testamento,
				$cpf,
				$nome,
				$data_nascimento,
				$nome_mae,
				$nome_pai,
				$numero_ato,
				$livro,
				$livro_complemento,
				$folha,
				$folha_complemento,
				$observacoes
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_testamentos__bk_20241016
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$id_tabelionato = $obj->getId_tabelionato();
		$tipo_testamento = $obj->getTipo_testamento();
		$data_testamento = $obj->getData_testamento();
		$cpf = $obj->getCpf();
		$nome = $obj->getNome();
		$data_nascimento = $obj->getData_nascimento();
		$nome_mae = $obj->getNome_mae();
		$nome_pai = $obj->getNome_pai();
		$numero_ato = $obj->getNumero_ato();
		$livro = $obj->getLivro();
		$livro_complemento = $obj->getLivro_complemento();
		$folha = $obj->getFolha();
		$folha_complemento = $obj->getFolha_complemento();
		$observacoes = $obj->getObservacoes();
		
        $campos = '';
        if (!empty($id_tabelionato) || is_numeric($id_tabelionato)) {
        	$campos .= "id_tabelionato=".$this->dba->quote($id_tabelionato).", ";
        }
        if (!empty($tipo_testamento) || is_numeric($tipo_testamento)) {
        	$campos .= "tipo_testamento=".$this->dba->quote($tipo_testamento).", ";
        }
        if (!empty($data_testamento) || is_numeric($data_testamento)) {
        	$campos .= "data_testamento=".$this->dba->quote($data_testamento).", ";
        }
        if (!empty($cpf) || is_numeric($cpf)) {
        	$campos .= "cpf=".$this->dba->quote($cpf).", ";
        }
        if (!empty($nome) || is_numeric($nome)) {
        	$campos .= "nome=".$this->dba->quote($nome).", ";
        }
        if (!empty($data_nascimento) || is_numeric($data_nascimento)) {
        	$campos .= "data_nascimento=".$this->dba->quote($data_nascimento).", ";
        }
        if (!empty($nome_mae) || is_numeric($nome_mae)) {
        	$campos .= "nome_mae=".$this->dba->quote($nome_mae).", ";
        }
        if (!empty($nome_pai) || is_numeric($nome_pai)) {
        	$campos .= "nome_pai=".$this->dba->quote($nome_pai).", ";
        }
        if (!empty($numero_ato) || is_numeric($numero_ato)) {
        	$campos .= "numero_ato=".$this->dba->quote($numero_ato).", ";
        }
        if (!empty($livro) || is_numeric($livro)) {
        	$campos .= "livro=".$this->dba->quote($livro).", ";
        }
        if (!empty($livro_complemento) || is_numeric($livro_complemento)) {
        	$campos .= "livro_complemento=".$this->dba->quote($livro_complemento).", ";
        }
        if (!empty($folha) || is_numeric($folha)) {
        	$campos .= "folha=".$this->dba->quote($folha).", ";
        }
        if (!empty($folha_complemento) || is_numeric($folha_complemento)) {
        	$campos .= "folha_complemento=".$this->dba->quote($folha_complemento).", ";
        }
        if (!empty($observacoes) || is_numeric($observacoes)) {
        	$campos .= "observacoes=".$this->dba->quote($observacoes).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_testamentos__BK_20241016 set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_testamentos__bk_20241016
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_testamentos__BK_20241016 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_testamentos__bk_20241016 conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_testamentos__BK_20241016 $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_testamentos__bk_20241016
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_testamentos__BK_20241016 WHERE Field = '".$coluna."'");
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