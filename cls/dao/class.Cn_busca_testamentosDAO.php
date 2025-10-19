<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_busca_testamentos" 
 */
class Cn_busca_testamentosDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_busca_testamentos
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$data = $this->dba->quote($obj->getData());
		$id_cliente = $this->dba->quote($obj->getId_cliente());
		$id_tabelionato = $this->dba->quote($obj->getId_tabelionato());
		$nome = $this->dba->quote($obj->getNome());
		$cpf = $this->dba->quote($obj->getCpf());
		$falecido = $this->dba->quote($obj->getFalecido());
		$data_falecimento = $this->dba->quote($obj->getData_falecimento());
		$livro = $this->dba->quote($obj->getLivro());
		$folha = $this->dba->quote($obj->getFolha());
		$numero = $this->dba->quote($obj->getNumero());
		$status = $this->dba->quote($obj->getStatus());
		$pagamento = $this->dba->quote($obj->getPagamento());
		$tipo_certidao = $this->dba->quote($obj->getTipo_certidao());
		$link_recibo = $this->dba->quote($obj->getLink_recibo());
		$link_certidao = $this->dba->quote($obj->getLink_certidao());
		$observacoes = $this->dba->quote($obj->getObservacoes());
		$id_boleto = $this->dba->quote($obj->getId_boleto());
		$boleto_gerado = $this->dba->quote($obj->getBoleto_gerado());
		$id_testamento = $this->dba->quote($obj->getId_testamento());
		$qtd_testamento = $this->dba->quote($obj->getQtd_testamento());
		$reconsulta = $this->dba->quote($obj->getReconsulta());
		$id_busca_anterior = $this->dba->quote($obj->getId_busca_anterior());
		$responsabilizo = $this->dba->quote($obj->getResponsabilizo());
		
		//montar o comando SQL
		$sql = "insert into cn_busca_testamentos 
				(
				data,
				id_cliente,
				id_tabelionato,
				nome,
				cpf,
				falecido,
				data_falecimento,
				livro,
				folha,
				numero,
				status,
				pagamento,
				tipo_certidao,
				link_recibo,
				link_certidao,
				observacoes,
				id_boleto,
				boleto_gerado,
				id_testamento,
				qtd_testamento,
				reconsulta,
				id_busca_anterior,
				responsabilizo
				) 
				values 
				(
				$data,
				$id_cliente,
				$id_tabelionato,
				$nome,
				$cpf,
				$falecido,
				$data_falecimento,
				$livro,
				$folha,
				$numero,
				$status,
				$pagamento,
				$tipo_certidao,
				$link_recibo,
				$link_certidao,
				$observacoes,
				$id_boleto,
				$boleto_gerado,
				$id_testamento,
				$qtd_testamento,
				$reconsulta,
				$id_busca_anterior,
				$responsabilizo
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_busca_testamentos
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$data = $obj->getData();
		$id_cliente = $obj->getId_cliente();
		$id_tabelionato = $obj->getId_tabelionato();
		$nome = $obj->getNome();
		$cpf = $obj->getCpf();
		$falecido = $obj->getFalecido();
		$data_falecimento = $obj->getData_falecimento();
		$livro = $obj->getLivro();
		$folha = $obj->getFolha();
		$numero = $obj->getNumero();
		$status = $obj->getStatus();
		$pagamento = $obj->getPagamento();
		$tipo_certidao = $obj->getTipo_certidao();
		$link_recibo = $obj->getLink_recibo();
		$link_certidao = $obj->getLink_certidao();
		$observacoes = $obj->getObservacoes();
		$id_boleto = $obj->getId_boleto();
		$boleto_gerado = $obj->getBoleto_gerado();
		$id_testamento = $obj->getId_testamento();
		$qtd_testamento = $obj->getQtd_testamento();
		$reconsulta = $obj->getReconsulta();
		$id_busca_anterior = $obj->getId_busca_anterior();
		$responsabilizo = $obj->getResponsabilizo();
		
        $campos = '';
        if (!empty($data) || is_numeric($data)) {
        	$campos .= "data=".$this->dba->quote($data).", ";
        }
        if (!empty($id_cliente) || is_numeric($id_cliente)) {
        	$campos .= "id_cliente=".$this->dba->quote($id_cliente).", ";
        }
        if (!empty($id_tabelionato) || is_numeric($id_tabelionato)) {
        	$campos .= "id_tabelionato=".$this->dba->quote($id_tabelionato).", ";
        }
        if (!empty($nome) || is_numeric($nome)) {
        	$campos .= "nome=".$this->dba->quote($nome).", ";
        }
        if (!empty($cpf) || is_numeric($cpf)) {
        	$campos .= "cpf=".$this->dba->quote($cpf).", ";
        }
        if (!empty($falecido) || is_numeric($falecido)) {
        	$campos .= "falecido=".$this->dba->quote($falecido).", ";
        }
        if (!empty($data_falecimento) || is_numeric($data_falecimento)) {
        	$campos .= "data_falecimento=".$this->dba->quote($data_falecimento).", ";
        }
        if (!empty($livro) || is_numeric($livro)) {
        	$campos .= "livro=".$this->dba->quote($livro).", ";
        }
        if (!empty($folha) || is_numeric($folha)) {
        	$campos .= "folha=".$this->dba->quote($folha).", ";
        }
        if (!empty($numero) || is_numeric($numero)) {
        	$campos .= "numero=".$this->dba->quote($numero).", ";
        }
        if (!empty($status) || is_numeric($status)) {
        	$campos .= "status=".$this->dba->quote($status).", ";
        }
        if (!empty($pagamento) || is_numeric($pagamento)) {
        	$campos .= "pagamento=".$this->dba->quote($pagamento).", ";
        }
        if (!empty($tipo_certidao) || is_numeric($tipo_certidao)) {
        	$campos .= "tipo_certidao=".$this->dba->quote($tipo_certidao).", ";
        }
        if (!empty($link_recibo) || is_numeric($link_recibo)) {
        	$campos .= "link_recibo=".$this->dba->quote($link_recibo).", ";
        }
        if (!empty($link_certidao) || is_numeric($link_certidao)) {
        	$campos .= "link_certidao=".$this->dba->quote($link_certidao).", ";
        }
        if (!empty($observacoes) || is_numeric($observacoes)) {
        	$campos .= "observacoes=".$this->dba->quote($observacoes).", ";
        }
        if (!empty($id_boleto) || is_numeric($id_boleto)) {
        	$campos .= "id_boleto=".$this->dba->quote($id_boleto).", ";
        }
        if (!empty($boleto_gerado) || is_numeric($boleto_gerado)) {
        	$campos .= "boleto_gerado=".$this->dba->quote($boleto_gerado).", ";
        }
        if (!empty($id_testamento) || is_numeric($id_testamento)) {
        	$campos .= "id_testamento=".$this->dba->quote($id_testamento).", ";
        }
        if (!empty($qtd_testamento) || is_numeric($qtd_testamento)) {
        	$campos .= "qtd_testamento=".$this->dba->quote($qtd_testamento).", ";
        }
        if (!empty($reconsulta) || is_numeric($reconsulta)) {
        	$campos .= "reconsulta=".$this->dba->quote($reconsulta).", ";
        }
        if (!empty($id_busca_anterior) || is_numeric($id_busca_anterior)) {
        	$campos .= "id_busca_anterior=".$this->dba->quote($id_busca_anterior).", ";
        }
        if (!empty($responsabilizo) || is_numeric($responsabilizo)) {
        	$campos .= "responsabilizo=".$this->dba->quote($responsabilizo).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_busca_testamentos set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_busca_testamentos
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_busca_testamentos 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_busca_testamentos conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_busca_testamentos $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_busca_testamentos
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_busca_testamentos WHERE Field = '".$coluna."'");
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