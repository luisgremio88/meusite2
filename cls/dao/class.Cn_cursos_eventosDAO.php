<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_cursos_eventos" 
 */
class Cn_cursos_eventosDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_cursos_eventos
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$titulo = $this->dba->quote($obj->getTitulo());
		$texto = $this->dba->quote($obj->getTexto());
		$anexo = $this->dba->quote($obj->getAnexo());
		$status = $this->dba->quote($obj->getStatus());
		$data_ini = $this->dba->quote($obj->getData_ini());
		$data_fim = $this->dba->quote($obj->getData_fim());
		$prazo_inscricao = $this->dba->quote($obj->getPrazo_inscricao());
		$valor_colaborador = $this->dba->quote($obj->getValor_colaborador());
		$valor_demais = $this->dba->quote($obj->getValor_demais());
		$valor_titular = $this->dba->quote($obj->getValor_titular());
		$link_noticia = $this->dba->quote($obj->getLink_noticia());
		$tipo = $this->dba->quote($obj->getTipo());
		$publico = $this->dba->quote($obj->getPublico());
		
		//montar o comando SQL
		$sql = "insert into cn_cursos_eventos 
				(
				titulo,
				texto,
				anexo,
				status,
				data_ini,
				data_fim,
				prazo_inscricao,
				valor_colaborador,
				valor_demais,
				valor_titular,
				link_noticia,
				tipo,
				publico
				) 
				values 
				(
				$titulo,
				$texto,
				$anexo,
				$status,
				$data_ini,
				$data_fim,
				$prazo_inscricao,
				$valor_colaborador,
				$valor_demais,
				$valor_titular,
				$link_noticia,
				$tipo,
				$publico
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_cursos_eventos
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$id = $obj->getId();
		$titulo = $obj->getTitulo();
		$texto = $obj->getTexto();
		$anexo = $obj->getAnexo();
		$status = $obj->getStatus();
		$data_ini = $obj->getData_ini();
		$data_fim = $obj->getData_fim();
		$prazo_inscricao = $obj->getPrazo_inscricao();
		$valor_colaborador = $obj->getValor_colaborador();
		$valor_demais = $obj->getValor_demais();
		$valor_titular = $obj->getValor_titular();
		$link_noticia = $obj->getLink_noticia();
		$tipo = $obj->getTipo();
		$publico = $obj->getPublico();
		
        $campos = '';
        if (!empty($titulo) || is_numeric($titulo)) {
        	$campos .= "titulo=".$this->dba->quote($titulo).", ";
        }
        if (!empty($texto) || is_numeric($texto)) {
        	$campos .= "texto=".$this->dba->quote($texto).", ";
        }
        if (!empty($anexo) || is_numeric($anexo)) {
        	$campos .= "anexo=".$this->dba->quote($anexo).", ";
        }
        if (!empty($status) || is_numeric($status)) {
        	$campos .= "status=".$this->dba->quote($status).", ";
        }
        if (!empty($data_ini) || is_numeric($data_ini)) {
        	$campos .= "data_ini=".$this->dba->quote($data_ini).", ";
        }
        if (!empty($data_fim) || is_numeric($data_fim)) {
        	$campos .= "data_fim=".$this->dba->quote($data_fim).", ";
        }
        if (!empty($prazo_inscricao) || is_numeric($prazo_inscricao)) {
        	$campos .= "prazo_inscricao=".$this->dba->quote($prazo_inscricao).", ";
        }
        if (!empty($valor_colaborador) || is_numeric($valor_colaborador)) {
        	$campos .= "valor_colaborador=".$this->dba->quote($valor_colaborador).", ";
        }
        if (!empty($valor_demais) || is_numeric($valor_demais)) {
        	$campos .= "valor_demais=".$this->dba->quote($valor_demais).", ";
        }
        if (!empty($valor_titular) || is_numeric($valor_titular)) {
        	$campos .= "valor_titular=".$this->dba->quote($valor_titular).", ";
        }
        if (!empty($link_noticia) || is_numeric($link_noticia)) {
        	$campos .= "link_noticia=".$this->dba->quote($link_noticia).", ";
        }
        if (!empty($tipo) || is_numeric($tipo)) {
        	$campos .= "tipo=".$this->dba->quote($tipo).", ";
        }
        if (!empty($publico) || is_numeric($publico)) {
        	$campos .= "publico=".$this->dba->quote($publico).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_cursos_eventos set
				$campos
				where id = $id";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_cursos_eventos
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$id = $obj->getid();
		
		//montar o comando SQL
		$sql = "delete from cn_cursos_eventos 
				where id = $id";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_cursos_eventos conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_cursos_eventos $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_cursos_eventos
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_cursos_eventos WHERE Field = '".$coluna."'");
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