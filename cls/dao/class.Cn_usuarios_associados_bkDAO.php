<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_usuarios_associados_bk" 
 */
class Cn_usuarios_associados_bkDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_usuarios_associados_bk
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$nome = $this->dba->quote($obj->getNome());
		$funcao = $this->dba->quote($obj->getFuncao());
		$data_nascimento = $this->dba->quote($obj->getData_nascimento());
		$cpf = $this->dba->quote($obj->getCpf());
		$rg = $this->dba->quote($obj->getRg());
		$data_expedicao = $this->dba->quote($obj->getData_expedicao());
		$orgao_expedicao = $this->dba->quote($obj->getOrgao_expedicao());
		$estado_civil = $this->dba->quote($obj->getEstado_civil());
		$email = $this->dba->quote($obj->getEmail());
		$pagina_web = $this->dba->quote($obj->getPagina_web());
		$nome_oficial_servico = $this->dba->quote($obj->getNome_oficial_servico());
		$nome_substituto = $this->dba->quote($obj->getNome_substituto());
		$cep = $this->dba->quote($obj->getCep());
		$endereco = $this->dba->quote($obj->getEndereco());
		$numero = $this->dba->quote($obj->getNumero());
		$complemento = $this->dba->quote($obj->getComplemento());
		$bairro = $this->dba->quote($obj->getBairro());
		$cidade = $this->dba->quote($obj->getCidade());
		$uf = $this->dba->quote($obj->getUf());
		$telefone = $this->dba->quote($obj->getTelefone());
		$fax = $this->dba->quote($obj->getFax());
		$entrancia = $this->dba->quote($obj->getEntrancia());
		$ip_registro = $this->dba->quote($obj->getIp_registro());
		$data_hora_registro = $this->dba->quote($obj->getData_hora_registro());
		$senha = $this->dba->quote($obj->getSenha());
		$status = $this->dba->quote($obj->getStatus());
		$status_associado = $this->dba->quote($obj->getStatus_associado());
		$TabelionatoVinculadoId = $this->dba->quote($obj->getTabelionatovinculadoid());
		$Tipo = $this->dba->quote($obj->getTipo());
		
		//montar o comando SQL
		$sql = "insert into cn_usuarios_associados_bk 
				(
				nome,
				funcao,
				data_nascimento,
				cpf,
				rg,
				data_expedicao,
				orgao_expedicao,
				estado_civil,
				email,
				pagina_web,
				nome_oficial_servico,
				nome_substituto,
				cep,
				endereco,
				numero,
				complemento,
				bairro,
				cidade,
				uf,
				telefone,
				fax,
				entrancia,
				ip_registro,
				data_hora_registro,
				senha,
				status,
				status_associado,
				TabelionatoVinculadoId,
				Tipo
				) 
				values 
				(
				$nome,
				$funcao,
				$data_nascimento,
				$cpf,
				$rg,
				$data_expedicao,
				$orgao_expedicao,
				$estado_civil,
				$email,
				$pagina_web,
				$nome_oficial_servico,
				$nome_substituto,
				$cep,
				$endereco,
				$numero,
				$complemento,
				$bairro,
				$cidade,
				$uf,
				$telefone,
				$fax,
				$entrancia,
				$ip_registro,
				$data_hora_registro,
				$senha,
				$status,
				$status_associado,
				$TabelionatoVinculadoId,
				$Tipo
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_usuarios_associados_bk
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$nome = $obj->getNome();
		$funcao = $obj->getFuncao();
		$data_nascimento = $obj->getData_nascimento();
		$cpf = $obj->getCpf();
		$rg = $obj->getRg();
		$data_expedicao = $obj->getData_expedicao();
		$orgao_expedicao = $obj->getOrgao_expedicao();
		$estado_civil = $obj->getEstado_civil();
		$email = $obj->getEmail();
		$pagina_web = $obj->getPagina_web();
		$nome_oficial_servico = $obj->getNome_oficial_servico();
		$nome_substituto = $obj->getNome_substituto();
		$cep = $obj->getCep();
		$endereco = $obj->getEndereco();
		$numero = $obj->getNumero();
		$complemento = $obj->getComplemento();
		$bairro = $obj->getBairro();
		$cidade = $obj->getCidade();
		$uf = $obj->getUf();
		$telefone = $obj->getTelefone();
		$fax = $obj->getFax();
		$entrancia = $obj->getEntrancia();
		$ip_registro = $obj->getIp_registro();
		$data_hora_registro = $obj->getData_hora_registro();
		$senha = $obj->getSenha();
		$status = $obj->getStatus();
		$status_associado = $obj->getStatus_associado();
		$TabelionatoVinculadoId = $obj->getTabelionatovinculadoid();
		$Tipo = $obj->getTipo();
		
        $campos = '';
        if (!empty($nome) || is_numeric($nome)) {
        	$campos .= "nome=".$this->dba->quote($nome).", ";
        }
        if (!empty($funcao) || is_numeric($funcao)) {
        	$campos .= "funcao=".$this->dba->quote($funcao).", ";
        }
        if (!empty($data_nascimento) || is_numeric($data_nascimento)) {
        	$campos .= "data_nascimento=".$this->dba->quote($data_nascimento).", ";
        }
        if (!empty($cpf) || is_numeric($cpf)) {
        	$campos .= "cpf=".$this->dba->quote($cpf).", ";
        }
        if (!empty($rg) || is_numeric($rg)) {
        	$campos .= "rg=".$this->dba->quote($rg).", ";
        }
        if (!empty($data_expedicao) || is_numeric($data_expedicao)) {
        	$campos .= "data_expedicao=".$this->dba->quote($data_expedicao).", ";
        }
        if (!empty($orgao_expedicao) || is_numeric($orgao_expedicao)) {
        	$campos .= "orgao_expedicao=".$this->dba->quote($orgao_expedicao).", ";
        }
        if (!empty($estado_civil) || is_numeric($estado_civil)) {
        	$campos .= "estado_civil=".$this->dba->quote($estado_civil).", ";
        }
        if (!empty($email) || is_numeric($email)) {
        	$campos .= "email=".$this->dba->quote($email).", ";
        }
        if (!empty($pagina_web) || is_numeric($pagina_web)) {
        	$campos .= "pagina_web=".$this->dba->quote($pagina_web).", ";
        }
        if (!empty($nome_oficial_servico) || is_numeric($nome_oficial_servico)) {
        	$campos .= "nome_oficial_servico=".$this->dba->quote($nome_oficial_servico).", ";
        }
        if (!empty($nome_substituto) || is_numeric($nome_substituto)) {
        	$campos .= "nome_substituto=".$this->dba->quote($nome_substituto).", ";
        }
        if (!empty($cep) || is_numeric($cep)) {
        	$campos .= "cep=".$this->dba->quote($cep).", ";
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
        if (!empty($uf) || is_numeric($uf)) {
        	$campos .= "uf=".$this->dba->quote($uf).", ";
        }
        if (!empty($telefone) || is_numeric($telefone)) {
        	$campos .= "telefone=".$this->dba->quote($telefone).", ";
        }
        if (!empty($fax) || is_numeric($fax)) {
        	$campos .= "fax=".$this->dba->quote($fax).", ";
        }
        if (!empty($entrancia) || is_numeric($entrancia)) {
        	$campos .= "entrancia=".$this->dba->quote($entrancia).", ";
        }
        if (!empty($ip_registro) || is_numeric($ip_registro)) {
        	$campos .= "ip_registro=".$this->dba->quote($ip_registro).", ";
        }
        if (!empty($data_hora_registro) || is_numeric($data_hora_registro)) {
        	$campos .= "data_hora_registro=".$this->dba->quote($data_hora_registro).", ";
        }
        if (!empty($senha) || is_numeric($senha)) {
        	$campos .= "senha=".$this->dba->quote($senha).", ";
        }
        if (!empty($status) || is_numeric($status)) {
        	$campos .= "status=".$this->dba->quote($status).", ";
        }
        if (!empty($status_associado) || is_numeric($status_associado)) {
        	$campos .= "status_associado=".$this->dba->quote($status_associado).", ";
        }
        if (!empty($TabelionatoVinculadoId) || is_numeric($TabelionatoVinculadoId)) {
        	$campos .= "TabelionatoVinculadoId=".$this->dba->quote($TabelionatoVinculadoId).", ";
        }
        if (!empty($Tipo) || is_numeric($Tipo)) {
        	$campos .= "Tipo=".$this->dba->quote($Tipo).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_usuarios_associados_bk set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_usuarios_associados_bk
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_usuarios_associados_bk 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_usuarios_associados_bk conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_usuarios_associados_bk $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_usuarios_associados_bk
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_usuarios_associados_bk WHERE Field = '".$coluna."'");
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