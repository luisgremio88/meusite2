<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_paginas_acesso" 
 */
class Cn_paginas_acessoDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_paginas_acesso
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$id_usuario = $this->dba->quote($obj->getId_usuario());
		$id_pagina = $this->dba->quote($obj->getId_pagina());
		$nome_pagina = $this->dba->quote($obj->getNome_pagina());
		$visualizar = $this->dba->quote($obj->getVisualizar());
		$cadastrar = $this->dba->quote($obj->getCadastrar());
		$editar = $this->dba->quote($obj->getEditar());
		$excluir = $this->dba->quote($obj->getExcluir());
		
		//montar o comando SQL
		$sql = "insert into cn_paginas_acesso 
				(
				id_usuario,
				id_pagina,
				nome_pagina,
				visualizar,
				cadastrar,
				editar,
				excluir
				) 
				values 
				(
				$id_usuario,
				$id_pagina,
				$nome_pagina,
				$visualizar,
				$cadastrar,
				$editar,
				$excluir
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_paginas_acesso
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$id_usuario = $obj->getId_usuario();
		$id_pagina = $obj->getId_pagina();
		$nome_pagina = $obj->getNome_pagina();
		$visualizar = $obj->getVisualizar();
		$cadastrar = $obj->getCadastrar();
		$editar = $obj->getEditar();
		$excluir = $obj->getExcluir();
		
        $campos = '';
        if (!empty($id_usuario) || is_numeric($id_usuario)) {
        	$campos .= "id_usuario=".$this->dba->quote($id_usuario).", ";
        }
        if (!empty($id_pagina) || is_numeric($id_pagina)) {
        	$campos .= "id_pagina=".$this->dba->quote($id_pagina).", ";
        }
        if (!empty($nome_pagina) || is_numeric($nome_pagina)) {
        	$campos .= "nome_pagina=".$this->dba->quote($nome_pagina).", ";
        }
        if (!empty($visualizar) || is_numeric($visualizar)) {
        	$campos .= "visualizar=".$this->dba->quote($visualizar).", ";
        }
        if (!empty($cadastrar) || is_numeric($cadastrar)) {
        	$campos .= "cadastrar=".$this->dba->quote($cadastrar).", ";
        }
        if (!empty($editar) || is_numeric($editar)) {
        	$campos .= "editar=".$this->dba->quote($editar).", ";
        }
        if (!empty($excluir) || is_numeric($excluir)) {
        	$campos .= "excluir=".$this->dba->quote($excluir).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_paginas_acesso set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_paginas_acesso
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_paginas_acesso 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_paginas_acesso conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_paginas_acesso $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_paginas_acesso
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_paginas_acesso WHERE Field = '".$coluna."'");
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