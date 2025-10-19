<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_contas_pagar_receber" 
 */
class Cn_contas_pagar_receberDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_contas_pagar_receber
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$descricao = $this->dba->quote($obj->getDescricao());
		$recebimento_tipo = $this->dba->quote($obj->getRecebimento_tipo());
		$recebimento_usuario = $this->dba->quote($obj->getRecebimento_usuario());
		$recebimento_cliente = $this->dba->quote($obj->getRecebimento_cliente());
		$recebimento_fornecedor = $this->dba->quote($obj->getRecebimento_fornecedor());
		$usuario_id = $this->dba->quote($obj->getUsuario_id());
		$cliente_id = $this->dba->quote($obj->getCliente_id());
		$fornecedor_id = $this->dba->quote($obj->getFornecedor_id());
		$evento_id = $this->dba->quote($obj->getEvento_id());
		$numero_nota = $this->dba->quote($obj->getNumero_nota());
		$status = $this->dba->quote($obj->getStatus());
		$nosso_numero = $this->dba->quote($obj->getNosso_numero());
		$data_cadastro = $this->dba->quote($obj->getData_cadastro());
		$data_vcto = $this->dba->quote($obj->getData_vcto());
		$valor = $this->dba->quote($obj->getValor());
		$categoria = $this->dba->quote($obj->getCategoria());
		$subcategoria = $this->dba->quote($obj->getSubcategoria());
		$id_boleto = $this->dba->quote($obj->getId_boleto());
		$boleto_gerado = $this->dba->quote($obj->getBoleto_gerado());
		$data_recebimento = $this->dba->quote($obj->getData_recebimento());
		$id_conta = $this->dba->quote($obj->getId_conta());
		$id_consulta = $this->dba->quote($obj->getId_consulta());
		
		//montar o comando SQL
		$sql = "insert into cn_contas_pagar_receber 
				(
				descricao,
				recebimento_tipo,
				recebimento_usuario,
				recebimento_cliente,
				recebimento_fornecedor,
				usuario_id,
				cliente_id,
				fornecedor_id,
				evento_id,
				numero_nota,
				status,
				nosso_numero,
				data_cadastro,
				data_vcto,
				valor,
				categoria,
				subcategoria,
				id_boleto,
				boleto_gerado,
				data_recebimento,
				id_conta,
				id_consulta
				) 
				values 
				(
				$descricao,
				$recebimento_tipo,
				$recebimento_usuario,
				$recebimento_cliente,
				$recebimento_fornecedor,
				$usuario_id,
				$cliente_id,
				$fornecedor_id,
				$evento_id,
				$numero_nota,
				$status,
				$nosso_numero,
				$data_cadastro,
				$data_vcto,
				$valor,
				$categoria,
				$subcategoria,
				$id_boleto,
				$boleto_gerado,
				$data_recebimento,
				$id_conta,
				$id_consulta
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_contas_pagar_receber
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$descricao = $obj->getDescricao();
		$recebimento_tipo = $obj->getRecebimento_tipo();
		$recebimento_usuario = $obj->getRecebimento_usuario();
		$recebimento_cliente = $obj->getRecebimento_cliente();
		$recebimento_fornecedor = $obj->getRecebimento_fornecedor();
		$usuario_id = $obj->getUsuario_id();
		$cliente_id = $obj->getCliente_id();
		$fornecedor_id = $obj->getFornecedor_id();
		$evento_id = $obj->getEvento_id();
		$numero_nota = $obj->getNumero_nota();
		$status = $obj->getStatus();
		$nosso_numero = $obj->getNosso_numero();
		$data_cadastro = $obj->getData_cadastro();
		$data_vcto = $obj->getData_vcto();
		$valor = $obj->getValor();
		$categoria = $obj->getCategoria();
		$subcategoria = $obj->getSubcategoria();
		$id_boleto = $obj->getId_boleto();
		$boleto_gerado = $obj->getBoleto_gerado();
		$data_recebimento = $obj->getData_recebimento();
		$id_conta = $obj->getId_conta();
		$id_consulta = $obj->getId_consulta();
		
        $campos = '';
        if (!empty($descricao) || is_numeric($descricao)) {
        	$campos .= "descricao=".$this->dba->quote($descricao).", ";
        }
        if (!empty($recebimento_tipo) || is_numeric($recebimento_tipo)) {
        	$campos .= "recebimento_tipo=".$this->dba->quote($recebimento_tipo).", ";
        }
        if (!empty($recebimento_usuario) || is_numeric($recebimento_usuario)) {
        	$campos .= "recebimento_usuario=".$this->dba->quote($recebimento_usuario).", ";
        }
        if (!empty($recebimento_cliente) || is_numeric($recebimento_cliente)) {
        	$campos .= "recebimento_cliente=".$this->dba->quote($recebimento_cliente).", ";
        }
        if (!empty($recebimento_fornecedor) || is_numeric($recebimento_fornecedor)) {
        	$campos .= "recebimento_fornecedor=".$this->dba->quote($recebimento_fornecedor).", ";
        }
        if (!empty($usuario_id) || is_numeric($usuario_id)) {
        	$campos .= "usuario_id=".$this->dba->quote($usuario_id).", ";
        }
        if (!empty($cliente_id) || is_numeric($cliente_id)) {
        	$campos .= "cliente_id=".$this->dba->quote($cliente_id).", ";
        }
        if (!empty($fornecedor_id) || is_numeric($fornecedor_id)) {
        	$campos .= "fornecedor_id=".$this->dba->quote($fornecedor_id).", ";
        }
        if (!empty($evento_id) || is_numeric($evento_id)) {
        	$campos .= "evento_id=".$this->dba->quote($evento_id).", ";
        }
        if (!empty($numero_nota) || is_numeric($numero_nota)) {
        	$campos .= "numero_nota=".$this->dba->quote($numero_nota).", ";
        }
        if (!empty($status) || is_numeric($status)) {
        	$campos .= "status=".$this->dba->quote($status).", ";
        }
        if (!empty($nosso_numero) || is_numeric($nosso_numero)) {
        	$campos .= "nosso_numero=".$this->dba->quote($nosso_numero).", ";
        }
        if (!empty($data_cadastro) || is_numeric($data_cadastro)) {
        	$campos .= "data_cadastro=".$this->dba->quote($data_cadastro).", ";
        }
        if (!empty($data_vcto) || is_numeric($data_vcto)) {
        	$campos .= "data_vcto=".$this->dba->quote($data_vcto).", ";
        }
        if (!empty($valor) || is_numeric($valor)) {
        	$campos .= "valor=".$this->dba->quote($valor).", ";
        }
        if (!empty($categoria) || is_numeric($categoria)) {
        	$campos .= "categoria=".$this->dba->quote($categoria).", ";
        }
        if (!empty($subcategoria) || is_numeric($subcategoria)) {
        	$campos .= "subcategoria=".$this->dba->quote($subcategoria).", ";
        }
        if (!empty($id_boleto) || is_numeric($id_boleto)) {
        	$campos .= "id_boleto=".$this->dba->quote($id_boleto).", ";
        }
        if (!empty($boleto_gerado) || is_numeric($boleto_gerado)) {
        	$campos .= "boleto_gerado=".$this->dba->quote($boleto_gerado).", ";
        }
        if (!empty($data_recebimento) || is_numeric($data_recebimento)) {
        	$campos .= "data_recebimento=".$this->dba->quote($data_recebimento).", ";
        }
        if (!empty($id_conta) || is_numeric($id_conta)) {
        	$campos .= "id_conta=".$this->dba->quote($id_conta).", ";
        }
        if (!empty($id_consulta) || is_numeric($id_consulta)) {
        	$campos .= "id_consulta=".$this->dba->quote($id_consulta).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_contas_pagar_receber set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_contas_pagar_receber
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_contas_pagar_receber 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_contas_pagar_receber conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_contas_pagar_receber $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_contas_pagar_receber
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_contas_pagar_receber WHERE Field = '".$coluna."'");
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