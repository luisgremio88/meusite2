/**
 * Classe que representa os comandos de acesso aos dados da tabela "{tab}" 
 */
class {tab}DAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela {tab}
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		<!-- START BLOCK : dados_ins -->
		${col} = $this->dba->quote($obj->get{col2}());
		<!-- END BLOCK : dados_ins -->
		
		//montar o comando SQL
		$sql = "insert into {tab2} 
				(
				<!-- START BLOCK : colunas1_ins -->
				{col}{vir}
				<!-- END BLOCK : colunas1_ins -->
				) 
				values 
				(
				<!-- START BLOCK : colunas2_ins -->
				${col}{vir}
				<!-- END BLOCK : colunas2_ins -->
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela {tab}
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		<!-- START BLOCK : dados_upd -->
		${col} = $obj->get{col2}();
		<!-- END BLOCK : dados_upd -->
		
        $campos = '';
        <!-- START BLOCK : colunas1_upd -->
        if (!empty(${col}) || is_numeric(${col})) {
        	$campos .= "{col}=".$this->dba->quote(${col}).", ";
        }
        <!-- END BLOCK : colunas1_upd -->
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update {tab2} set
				$campos
				where {colid} = ${colid}";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela {tab}
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		${colid} = $obj->get{colid}();
		
		//montar o comando SQL
		$sql = "delete from {tab2} 
				where {colid} = ${colid}";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela {tab} conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from {tab2} $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela {tab}
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM {tab2} WHERE Field = '".$coluna."'");
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
    
    
    <!-- START BLOCK : temFK -->
    //----------------------------------------
	/**
	 * metodos gerados para juncao (inner join) com as tabelas usam '{tab2}' como FK 
	 */
    
        <!-- START BLOCK : fks -->
        /**
	 	 * metodo de juncao (inner join) e retorno de dados da tabela '{tabFK}' 
	 	 */
        public function list{tabFK}($filtro) {
            if (!empty($filtro)) {
                $filtro = 'AND '.$filtro;
            }
            $sql = "select {tab2FK}.* from {tab2}, {tab2FK}
                    where {tab2}.{colpk} = {tab2FK}.{colfk} 
                    $filtro";
            $res = $this->dba->query($sql);
            $num = $this->dba->rows($res);
            $vet = array();
            for ($i=0; $i<$num; $i++) {
                <!-- START BLOCK : colunas1_selFks -->
                $vet[$i]['{col}'] = $this->dba->result($res, $i, '{col}');
                <!-- END BLOCK : colunas1_selFks -->			
            }
            //matriz com os dados (linhas e colunas)
            return $vet;
        }
        
        <!-- END BLOCK : fks -->
    <!-- END BLOCK : temFK -->


    <!-- START BLOCK : temFK2 -->
    //----------------------------------------
	/**
	 * metodos gerados para juncao (inner join) com as tabelas 'PK' de '{tab2}'
	 */
    
        <!-- START BLOCK : fks2 -->
        /**
	 	 * metodo de juncao (inner join) e retorno de dados da tabela '{tabFK}' 
	 	 */
        public function list{tabPK}($filtro) {
            if (!empty($filtro)) {
                $filtro = 'AND '.$filtro;
            }
            $sql = "select {tab2PK}.* from {tab2PK}, {tab2}
                    where {tab2PK}.{colpk} = {tab2}.{colfk}
                    $filtro";
            $res = $this->dba->query($sql);
            $num = $this->dba->rows($res);
            $vet = array();
            for ($i=0; $i<$num; $i++) {
                <!-- START BLOCK : colunas1_selFks2 -->
                $vet[$i]['{col}'] = $this->dba->result($res, $i, '{col}');
                <!-- END BLOCK : colunas1_selFks2 -->			
            }
            //matriz com os dados (linhas e colunas)
            return $vet;
        }
        
        <!-- END BLOCK : fks2 -->
    <!-- END BLOCK : temFK2 -->

}
