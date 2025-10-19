<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_eventos" 
 */
class Cn_eventosDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_eventos
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$Titulo = $this->dba->quote($obj->getTitulo());
		$Descricao = $this->dba->quote($obj->getDescricao());
		$TipoEvento = $this->dba->quote($obj->getTipoevento());
		$Vagas = $this->dba->quote($obj->getVagas());
		$Endereco = $this->dba->quote($obj->getEndereco());
		$Flyer = $this->dba->quote($obj->getFlyer());
		$EnderecoGoogleMaps = $this->dba->quote($obj->getEnderecogooglemaps());
		$DataInicial = $this->dba->quote($obj->getDatainicial());
		$DataFinal = $this->dba->quote($obj->getDatafinal());
		$DataCriacao = $this->dba->quote($obj->getDatacriacao());
		$UrlNoticia = $this->dba->quote($obj->getUrlnoticia());
		$UsuarioInsertId = $this->dba->quote($obj->getUsuarioinsertid());
		$Final = $this->dba->quote($obj->getFinal());
		
		//montar o comando SQL
		$sql = "insert into cn_eventos 
				(
				Titulo,
				Descricao,
				TipoEvento,
				Vagas,
				Endereco,
				Flyer,
				EnderecoGoogleMaps,
				DataInicial,
				DataFinal,
				DataCriacao,
				UrlNoticia,
				UsuarioInsertId,
				Final
				) 
				values 
				(
				$Titulo,
				$Descricao,
				$TipoEvento,
				$Vagas,
				$Endereco,
				$Flyer,
				$EnderecoGoogleMaps,
				$DataInicial,
				$DataFinal,
				$DataCriacao,
				$UrlNoticia,
				$UsuarioInsertId,
				$Final
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_eventos
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$EventoId = $obj->getEventoid();
		$Titulo = $obj->getTitulo();
		$Descricao = $obj->getDescricao();
		$TipoEvento = $obj->getTipoevento();
		$Vagas = $obj->getVagas();
		$Endereco = $obj->getEndereco();
		$Flyer = $obj->getFlyer();
		$EnderecoGoogleMaps = $obj->getEnderecogooglemaps();
		$DataInicial = $obj->getDatainicial();
		$DataFinal = $obj->getDatafinal();
		$DataCriacao = $obj->getDatacriacao();
		$UrlNoticia = $obj->getUrlnoticia();
		$UsuarioInsertId = $obj->getUsuarioinsertid();
		$Final = $obj->getFinal();
		
        $campos = '';
        if (!empty($Titulo) || is_numeric($Titulo)) {
        	$campos .= "Titulo=".$this->dba->quote($Titulo).", ";
        }
        if (!empty($Descricao) || is_numeric($Descricao)) {
        	$campos .= "Descricao=".$this->dba->quote($Descricao).", ";
        }
        if (!empty($TipoEvento) || is_numeric($TipoEvento)) {
        	$campos .= "TipoEvento=".$this->dba->quote($TipoEvento).", ";
        }
        if (!empty($Vagas) || is_numeric($Vagas)) {
        	$campos .= "Vagas=".$this->dba->quote($Vagas).", ";
        }
        if (!empty($Endereco) || is_numeric($Endereco)) {
        	$campos .= "Endereco=".$this->dba->quote($Endereco).", ";
        }
        if (!empty($Flyer) || is_numeric($Flyer)) {
        	$campos .= "Flyer=".$this->dba->quote($Flyer).", ";
        }
        if (!empty($EnderecoGoogleMaps) || is_numeric($EnderecoGoogleMaps)) {
        	$campos .= "EnderecoGoogleMaps=".$this->dba->quote($EnderecoGoogleMaps).", ";
        }
        if (!empty($DataInicial) || is_numeric($DataInicial)) {
        	$campos .= "DataInicial=".$this->dba->quote($DataInicial).", ";
        }
        if (!empty($DataFinal) || is_numeric($DataFinal)) {
        	$campos .= "DataFinal=".$this->dba->quote($DataFinal).", ";
        }
        if (!empty($DataCriacao) || is_numeric($DataCriacao)) {
        	$campos .= "DataCriacao=".$this->dba->quote($DataCriacao).", ";
        }
        if (!empty($UrlNoticia) || is_numeric($UrlNoticia)) {
        	$campos .= "UrlNoticia=".$this->dba->quote($UrlNoticia).", ";
        }
        if (!empty($UsuarioInsertId) || is_numeric($UsuarioInsertId)) {
        	$campos .= "UsuarioInsertId=".$this->dba->quote($UsuarioInsertId).", ";
        }
        if (!empty($Final) || is_numeric($Final)) {
        	$campos .= "Final=".$this->dba->quote($Final).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_eventos set
				$campos
				where EventoId = $EventoId";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_eventos
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$EventoId = $obj->getEventoId();
		
		//montar o comando SQL
		$sql = "delete from cn_eventos 
				where EventoId = $EventoId";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_eventos conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_eventos $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_eventos
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_eventos WHERE Field = '".$coluna."'");
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