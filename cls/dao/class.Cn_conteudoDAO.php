<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_conteudo" 
 */
class Cn_conteudoDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_conteudo
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$ConteudoId = $this->dba->quote($obj->getConteudoid());
		$DataCriacao = $this->dba->quote($obj->getDatacriacao());
		$Texto = $this->dba->quote($obj->getTexto());
		$Tipo = $this->dba->quote($obj->getTipo());
		$Discriminator = $this->dba->quote($obj->getDiscriminator());
		$ConteudoUsuarioId_UsuarioId = $this->dba->quote($obj->getConteudousuarioid_usuarioid());
		$Usuario_UsuarioId = $this->dba->quote($obj->getUsuario_usuarioid());
		
		//montar o comando SQL
		$sql = "insert into cn_conteudo 
				(
				ConteudoId,
				DataCriacao,
				Texto,
				Tipo,
				Discriminator,
				ConteudoUsuarioId_UsuarioId,
				Usuario_UsuarioId
				) 
				values 
				(
				$ConteudoId,
				$DataCriacao,
				$Texto,
				$Tipo,
				$Discriminator,
				$ConteudoUsuarioId_UsuarioId,
				$Usuario_UsuarioId
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_conteudo
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$ConteudoId = $obj->getConteudoid();
		$DataCriacao = $obj->getDatacriacao();
		$Texto = $obj->getTexto();
		$Tipo = $obj->getTipo();
		$Discriminator = $obj->getDiscriminator();
		$ConteudoUsuarioId_UsuarioId = $obj->getConteudousuarioid_usuarioid();
		$Usuario_UsuarioId = $obj->getUsuario_usuarioid();
		
        $campos = '';
        if (!empty($ConteudoId) || is_numeric($ConteudoId)) {
        	$campos .= "ConteudoId=".$this->dba->quote($ConteudoId).", ";
        }
        if (!empty($DataCriacao) || is_numeric($DataCriacao)) {
        	$campos .= "DataCriacao=".$this->dba->quote($DataCriacao).", ";
        }
        if (!empty($Texto) || is_numeric($Texto)) {
        	$campos .= "Texto=".$this->dba->quote($Texto).", ";
        }
        if (!empty($Tipo) || is_numeric($Tipo)) {
        	$campos .= "Tipo=".$this->dba->quote($Tipo).", ";
        }
        if (!empty($Discriminator) || is_numeric($Discriminator)) {
        	$campos .= "Discriminator=".$this->dba->quote($Discriminator).", ";
        }
        if (!empty($ConteudoUsuarioId_UsuarioId) || is_numeric($ConteudoUsuarioId_UsuarioId)) {
        	$campos .= "ConteudoUsuarioId_UsuarioId=".$this->dba->quote($ConteudoUsuarioId_UsuarioId).", ";
        }
        if (!empty($Usuario_UsuarioId) || is_numeric($Usuario_UsuarioId)) {
        	$campos .= "Usuario_UsuarioId=".$this->dba->quote($Usuario_UsuarioId).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_conteudo set
				$campos
				where  = $";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_conteudo
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$ = $obj->get();
		
		//montar o comando SQL
		$sql = "delete from cn_conteudo 
				where  = $";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_conteudo conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_conteudo $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_conteudo
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_conteudo WHERE Field = '".$coluna."'");
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