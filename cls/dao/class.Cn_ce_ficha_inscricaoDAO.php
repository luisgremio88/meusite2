<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_ce_ficha_inscricao" 
 */
class Cn_ce_ficha_inscricaoDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_ce_ficha_inscricao
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$skynet = $this->dba->quote($obj->getSkynet());
		$cpf = $this->dba->quote($obj->getCpf());
		$nome = $this->dba->quote($obj->getNome());
		$cep = $this->dba->quote($obj->getCep());
		$estado = $this->dba->quote($obj->getEstado());
		$municipio = $this->dba->quote($obj->getMunicipio());
		$endereco = $this->dba->quote($obj->getEndereco());
		$bairro = $this->dba->quote($obj->getBairro());
		$numero = $this->dba->quote($obj->getNumero());
		$telefone = $this->dba->quote($obj->getTelefone());
		$serventia = $this->dba->quote($obj->getServentia());
		$responsavel = $this->dba->quote($obj->getResponsavel());
		$participantes_adicionais = $this->dba->quote($obj->getParticipantes_adicionais());
		$modelo_participacao = $this->dba->quote($obj->getModelo_participacao());
		$somente_socios = $this->dba->quote($obj->getSomente_socios());
		$boleto = $this->dba->quote($obj->getBoleto());
		$entidades = $this->dba->quote($obj->getEntidades());
		
		//montar o comando SQL
		$sql = "insert into cn_ce_ficha_inscricao 
				(
				skynet,
				cpf,
				nome,
				cep,
				estado,
				municipio,
				endereco,
				bairro,
				numero,
				telefone,
				serventia,
				responsavel,
				participantes_adicionais,
				modelo_participacao,
				somente_socios,
				boleto,
				entidades
				) 
				values 
				(
				$skynet,
				$cpf,
				$nome,
				$cep,
				$estado,
				$municipio,
				$endereco,
				$bairro,
				$numero,
				$telefone,
				$serventia,
				$responsavel,
				$participantes_adicionais,
				$modelo_participacao,
				$somente_socios,
				$boleto,
				$entidades
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_ce_ficha_inscricao
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id_curso_evento = $obj->getId_curso_evento();
		$skynet = $obj->getSkynet();
		$cpf = $obj->getCpf();
		$nome = $obj->getNome();
		$cep = $obj->getCep();
		$estado = $obj->getEstado();
		$municipio = $obj->getMunicipio();
		$endereco = $obj->getEndereco();
		$bairro = $obj->getBairro();
		$numero = $obj->getNumero();
		$telefone = $obj->getTelefone();
		$serventia = $obj->getServentia();
		$responsavel = $obj->getResponsavel();
		$participantes_adicionais = $obj->getParticipantes_adicionais();
		$modelo_participacao = $obj->getModelo_participacao();
		$somente_socios = $obj->getSomente_socios();
		$boleto = $obj->getBoleto();
		$entidades = $obj->getEntidades();
		
        $campos = '';
        if (!empty($skynet) || is_numeric($skynet)) {
        	$campos .= "skynet=".$this->dba->quote($skynet).", ";
        }
        if (!empty($cpf) || is_numeric($cpf)) {
        	$campos .= "cpf=".$this->dba->quote($cpf).", ";
        }
        if (!empty($nome) || is_numeric($nome)) {
        	$campos .= "nome=".$this->dba->quote($nome).", ";
        }
        if (!empty($cep) || is_numeric($cep)) {
        	$campos .= "cep=".$this->dba->quote($cep).", ";
        }
        if (!empty($estado) || is_numeric($estado)) {
        	$campos .= "estado=".$this->dba->quote($estado).", ";
        }
        if (!empty($municipio) || is_numeric($municipio)) {
        	$campos .= "municipio=".$this->dba->quote($municipio).", ";
        }
        if (!empty($endereco) || is_numeric($endereco)) {
        	$campos .= "endereco=".$this->dba->quote($endereco).", ";
        }
        if (!empty($bairro) || is_numeric($bairro)) {
        	$campos .= "bairro=".$this->dba->quote($bairro).", ";
        }
        if (!empty($numero) || is_numeric($numero)) {
        	$campos .= "numero=".$this->dba->quote($numero).", ";
        }
        if (!empty($telefone) || is_numeric($telefone)) {
        	$campos .= "telefone=".$this->dba->quote($telefone).", ";
        }
        if (!empty($serventia) || is_numeric($serventia)) {
        	$campos .= "serventia=".$this->dba->quote($serventia).", ";
        }
        if (!empty($responsavel) || is_numeric($responsavel)) {
        	$campos .= "responsavel=".$this->dba->quote($responsavel).", ";
        }
        if (!empty($participantes_adicionais) || is_numeric($participantes_adicionais)) {
        	$campos .= "participantes_adicionais=".$this->dba->quote($participantes_adicionais).", ";
        }
        if (!empty($modelo_participacao) || is_numeric($modelo_participacao)) {
        	$campos .= "modelo_participacao=".$this->dba->quote($modelo_participacao).", ";
        }
        if (!empty($somente_socios) || is_numeric($somente_socios)) {
        	$campos .= "somente_socios=".$this->dba->quote($somente_socios).", ";
        }
        if (!empty($boleto) || is_numeric($boleto)) {
        	$campos .= "boleto=".$this->dba->quote($boleto).", ";
        }
        if (!empty($entidades) || is_numeric($entidades)) {
        	$campos .= "entidades=".$this->dba->quote($entidades).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_ce_ficha_inscricao set
				$campos
				where id_curso_evento = $id_curso_evento";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_ce_ficha_inscricao
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id_curso_evento = $obj->getid_curso_evento();
		
		//montar o comando SQL
		$sql = "delete from cn_ce_ficha_inscricao 
				where id_curso_evento = $id_curso_evento";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_ce_ficha_inscricao conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_ce_ficha_inscricao $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_ce_ficha_inscricao
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_ce_ficha_inscricao WHERE Field = '".$coluna."'");
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