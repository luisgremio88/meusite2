<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_galeria" 
 */
class Cn_galeriaDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_galeria
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$GaleriaId = $this->dba->quote($obj->getGaleriaid());
		$Titulo = $this->dba->quote($obj->getTitulo());
		$Descricao = $this->dba->quote($obj->getDescricao());
		$Data = $this->dba->quote($obj->getData());
		$DataCriacao = $this->dba->quote($obj->getDatacriacao());
		$Usuario_UsuarioId = $this->dba->quote($obj->getUsuario_usuarioid());
		
		//montar o comando SQL
		$sql = "insert into cn_galeria 
				(
				GaleriaId,
				Titulo,
				Descricao,
				Data,
				DataCriacao,
				Usuario_UsuarioId
				) 
				values 
				(
				$GaleriaId,
				$Titulo,
				$Descricao,
				$Data,
				$DataCriacao,
				$Usuario_UsuarioId
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_galeria
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$GaleriaId = $obj->getGaleriaid();
		$Titulo = $obj->getTitulo();
		$Descricao = $obj->getDescricao();
		$Data = $obj->getData();
		$DataCriacao = $obj->getDatacriacao();
		$Usuario_UsuarioId = $obj->getUsuario_usuarioid();
		
        $campos = '';
        if (!empty($GaleriaId) || is_numeric($GaleriaId)) {
        	$campos .= "GaleriaId=".$this->dba->quote($GaleriaId).", ";
        }
        if (!empty($Titulo) || is_numeric($Titulo)) {
        	$campos .= "Titulo=".$this->dba->quote($Titulo).", ";
        }
        if (!empty($Descricao) || is_numeric($Descricao)) {
        	$campos .= "Descricao=".$this->dba->quote($Descricao).", ";
        }
        if (!empty($Data) || is_numeric($Data)) {
        	$campos .= "Data=".$this->dba->quote($Data).", ";
        }
        if (!empty($DataCriacao) || is_numeric($DataCriacao)) {
        	$campos .= "DataCriacao=".$this->dba->quote($DataCriacao).", ";
        }
        if (!empty($Usuario_UsuarioId) || is_numeric($Usuario_UsuarioId)) {
        	$campos .= "Usuario_UsuarioId=".$this->dba->quote($Usuario_UsuarioId).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_galeria set
				$campos
				where  = $";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_galeria
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$ = $obj->get();
		
		//montar o comando SQL
		$sql = "delete from cn_galeria 
				where  = $";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_galeria conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_galeria $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_galeria
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_galeria WHERE Field = '".$coluna."'");
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