<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_pagamentos_agendados" 
 */
class Cn_pagamentos_agendadosDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_pagamentos_agendados
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$descricao = $this->dba->quote($obj->getDescricao());
		$pagador_usuario = $this->dba->quote($obj->getPagador_usuario());
		$pagador_cliente = $this->dba->quote($obj->getPagador_cliente());
		$pagador_fornecedor = $this->dba->quote($obj->getPagador_fornecedor());
		$usuario_id = $this->dba->quote($obj->getUsuario_id());
		$cliente_id = $this->dba->quote($obj->getCliente_id());
		$fornecedor_id = $this->dba->quote($obj->getFornecedor_id());
		$evento_id = $this->dba->quote($obj->getEvento_id());
		$status = $this->dba->quote($obj->getStatus());
		$categoria_despesa = $this->dba->quote($obj->getCategoria_despesa());
		$despesa = $this->dba->quote($obj->getDespesa());
		$data_vencimento = $this->dba->quote($obj->getData_vencimento());
		$data_pagamento = $this->dba->quote($obj->getData_pagamento());
		$valor = $this->dba->quote($obj->getValor());
		$conta_bancaria_origem = $this->dba->quote($obj->getConta_bancaria_origem());
		$prazo_indeterminado = $this->dba->quote($obj->getPrazo_indeterminado());
		$quant_vezes = $this->dba->quote($obj->getQuant_vezes());
		$dia_vencimento = $this->dba->quote($obj->getDia_vencimento());
		$dia_pagamento = $this->dba->quote($obj->getDia_pagamento());
		
		//montar o comando SQL
		$sql = "insert into cn_pagamentos_agendados 
				(
				descricao,
				pagador_usuario,
				pagador_cliente,
				pagador_fornecedor,
				usuario_id,
				cliente_id,
				fornecedor_id,
				evento_id,
				status,
				categoria_despesa,
				despesa,
				data_vencimento,
				data_pagamento,
				valor,
				conta_bancaria_origem,
				prazo_indeterminado,
				quant_vezes,
				dia_vencimento,
				dia_pagamento
				) 
				values 
				(
				$descricao,
				$pagador_usuario,
				$pagador_cliente,
				$pagador_fornecedor,
				$usuario_id,
				$cliente_id,
				$fornecedor_id,
				$evento_id,
				$status,
				$categoria_despesa,
				$despesa,
				$data_vencimento,
				$data_pagamento,
				$valor,
				$conta_bancaria_origem,
				$prazo_indeterminado,
				$quant_vezes,
				$dia_vencimento,
				$dia_pagamento
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_pagamentos_agendados
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$descricao = $obj->getDescricao();
		$pagador_usuario = $obj->getPagador_usuario();
		$pagador_cliente = $obj->getPagador_cliente();
		$pagador_fornecedor = $obj->getPagador_fornecedor();
		$usuario_id = $obj->getUsuario_id();
		$cliente_id = $obj->getCliente_id();
		$fornecedor_id = $obj->getFornecedor_id();
		$evento_id = $obj->getEvento_id();
		$status = $obj->getStatus();
		$categoria_despesa = $obj->getCategoria_despesa();
		$despesa = $obj->getDespesa();
		$data_vencimento = $obj->getData_vencimento();
		$data_pagamento = $obj->getData_pagamento();
		$valor = $obj->getValor();
		$conta_bancaria_origem = $obj->getConta_bancaria_origem();
		$prazo_indeterminado = $obj->getPrazo_indeterminado();
		$quant_vezes = $obj->getQuant_vezes();
		$dia_vencimento = $obj->getDia_vencimento();
		$dia_pagamento = $obj->getDia_pagamento();
		
        $campos = '';
        if (!empty($descricao) || is_numeric($descricao)) {
        	$campos .= "descricao=".$this->dba->quote($descricao).", ";
        }
        if (!empty($pagador_usuario) || is_numeric($pagador_usuario)) {
        	$campos .= "pagador_usuario=".$this->dba->quote($pagador_usuario).", ";
        }
        if (!empty($pagador_cliente) || is_numeric($pagador_cliente)) {
        	$campos .= "pagador_cliente=".$this->dba->quote($pagador_cliente).", ";
        }
        if (!empty($pagador_fornecedor) || is_numeric($pagador_fornecedor)) {
        	$campos .= "pagador_fornecedor=".$this->dba->quote($pagador_fornecedor).", ";
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
        if (!empty($status) || is_numeric($status)) {
        	$campos .= "status=".$this->dba->quote($status).", ";
        }
        if (!empty($categoria_despesa) || is_numeric($categoria_despesa)) {
        	$campos .= "categoria_despesa=".$this->dba->quote($categoria_despesa).", ";
        }
        if (!empty($despesa) || is_numeric($despesa)) {
        	$campos .= "despesa=".$this->dba->quote($despesa).", ";
        }
        if (!empty($data_vencimento) || is_numeric($data_vencimento)) {
        	$campos .= "data_vencimento=".$this->dba->quote($data_vencimento).", ";
        }
        if (!empty($data_pagamento) || is_numeric($data_pagamento)) {
        	$campos .= "data_pagamento=".$this->dba->quote($data_pagamento).", ";
        }
        if (!empty($valor) || is_numeric($valor)) {
        	$campos .= "valor=".$this->dba->quote($valor).", ";
        }
        if (!empty($conta_bancaria_origem) || is_numeric($conta_bancaria_origem)) {
        	$campos .= "conta_bancaria_origem=".$this->dba->quote($conta_bancaria_origem).", ";
        }
        if (!empty($prazo_indeterminado) || is_numeric($prazo_indeterminado)) {
        	$campos .= "prazo_indeterminado=".$this->dba->quote($prazo_indeterminado).", ";
        }
        if (!empty($quant_vezes) || is_numeric($quant_vezes)) {
        	$campos .= "quant_vezes=".$this->dba->quote($quant_vezes).", ";
        }
        if (!empty($dia_vencimento) || is_numeric($dia_vencimento)) {
        	$campos .= "dia_vencimento=".$this->dba->quote($dia_vencimento).", ";
        }
        if (!empty($dia_pagamento) || is_numeric($dia_pagamento)) {
        	$campos .= "dia_pagamento=".$this->dba->quote($dia_pagamento).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_pagamentos_agendados set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_pagamentos_agendados
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_pagamentos_agendados 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_pagamentos_agendados conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_pagamentos_agendados $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_pagamentos_agendados
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_pagamentos_agendados WHERE Field = '".$coluna."'");
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