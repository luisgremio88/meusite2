<?php
		/**
 * Classe que representa os comandos de acesso aos dados da tabela "Cn_faturamento" 
 */
class Cn_faturamentoDAO extends PDO
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
	 * metodo que faz a insercao de um registro na tabela Cn_faturamento
	 */
	public function insert($obj) {
		//pegar os dados do objeto
		$FaturamentoId = $this->dba->quote($obj->getFaturamentoid());
		$SkyNetContaReceberRecebimentoId = $this->dba->quote($obj->getSkynetcontareceberrecebimentoid());
		$SkyNetArquivoBoletoId = $this->dba->quote($obj->getSkynetarquivoboletoid());
		$SkyNetArquivoNotaFiscalManualPdfId = $this->dba->quote($obj->getSkynetarquivonotafiscalmanualpdfid());
		$Status = $this->dba->quote($obj->getStatus());
		$DataCriacao = $this->dba->quote($obj->getDatacriacao());
		$DataAtualizacao = $this->dba->quote($obj->getDataatualizacao());
		$FormaDePagamento = $this->dba->quote($obj->getFormadepagamento());
		$SkyNetContaReceberId = $this->dba->quote($obj->getSkynetcontareceberid());
		$SkyNetContaReceberParcelaId = $this->dba->quote($obj->getSkynetcontareceberparcelaid());
		$SkyNetNotaFiscalManualReciboId = $this->dba->quote($obj->getSkynetnotafiscalmanualreciboid());
		$SkyNetNotaFiscalManualReciboNumero = $this->dba->quote($obj->getSkynetnotafiscalmanualrecibonumero());
		
		//montar o comando SQL
		$sql = "insert into cn_faturamento 
				(
				FaturamentoId,
				SkyNetContaReceberRecebimentoId,
				SkyNetArquivoBoletoId,
				SkyNetArquivoNotaFiscalManualPdfId,
				Status,
				DataCriacao,
				DataAtualizacao,
				FormaDePagamento,
				SkyNetContaReceberId,
				SkyNetContaReceberParcelaId,
				SkyNetNotaFiscalManualReciboId,
				SkyNetNotaFiscalManualReciboNumero
				) 
				values 
				(
				$FaturamentoId,
				$SkyNetContaReceberRecebimentoId,
				$SkyNetArquivoBoletoId,
				$SkyNetArquivoNotaFiscalManualPdfId,
				$Status,
				$DataCriacao,
				$DataAtualizacao,
				$FormaDePagamento,
				$SkyNetContaReceberId,
				$SkyNetContaReceberParcelaId,
				$SkyNetNotaFiscalManualReciboId,
				$SkyNetNotaFiscalManualReciboNumero
				)";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a atualizacao de um registro na tabela Cn_faturamento
	 * para remover o valor de uma coluna, atribua a string '!NULL!'
	 */
	public function update($obj) {
		//pegar os dados do objeto
		$FaturamentoId = $obj->getFaturamentoid();
		$SkyNetContaReceberRecebimentoId = $obj->getSkynetcontareceberrecebimentoid();
		$SkyNetArquivoBoletoId = $obj->getSkynetarquivoboletoid();
		$SkyNetArquivoNotaFiscalManualPdfId = $obj->getSkynetarquivonotafiscalmanualpdfid();
		$Status = $obj->getStatus();
		$DataCriacao = $obj->getDatacriacao();
		$DataAtualizacao = $obj->getDataatualizacao();
		$FormaDePagamento = $obj->getFormadepagamento();
		$SkyNetContaReceberId = $obj->getSkynetcontareceberid();
		$SkyNetContaReceberParcelaId = $obj->getSkynetcontareceberparcelaid();
		$SkyNetNotaFiscalManualReciboId = $obj->getSkynetnotafiscalmanualreciboid();
		$SkyNetNotaFiscalManualReciboNumero = $obj->getSkynetnotafiscalmanualrecibonumero();
		
        $campos = '';
        if (!empty($FaturamentoId) || is_numeric($FaturamentoId)) {
        	$campos .= "FaturamentoId=".$this->dba->quote($FaturamentoId).", ";
        }
        if (!empty($SkyNetContaReceberRecebimentoId) || is_numeric($SkyNetContaReceberRecebimentoId)) {
        	$campos .= "SkyNetContaReceberRecebimentoId=".$this->dba->quote($SkyNetContaReceberRecebimentoId).", ";
        }
        if (!empty($SkyNetArquivoBoletoId) || is_numeric($SkyNetArquivoBoletoId)) {
        	$campos .= "SkyNetArquivoBoletoId=".$this->dba->quote($SkyNetArquivoBoletoId).", ";
        }
        if (!empty($SkyNetArquivoNotaFiscalManualPdfId) || is_numeric($SkyNetArquivoNotaFiscalManualPdfId)) {
        	$campos .= "SkyNetArquivoNotaFiscalManualPdfId=".$this->dba->quote($SkyNetArquivoNotaFiscalManualPdfId).", ";
        }
        if (!empty($Status) || is_numeric($Status)) {
        	$campos .= "Status=".$this->dba->quote($Status).", ";
        }
        if (!empty($DataCriacao) || is_numeric($DataCriacao)) {
        	$campos .= "DataCriacao=".$this->dba->quote($DataCriacao).", ";
        }
        if (!empty($DataAtualizacao) || is_numeric($DataAtualizacao)) {
        	$campos .= "DataAtualizacao=".$this->dba->quote($DataAtualizacao).", ";
        }
        if (!empty($FormaDePagamento) || is_numeric($FormaDePagamento)) {
        	$campos .= "FormaDePagamento=".$this->dba->quote($FormaDePagamento).", ";
        }
        if (!empty($SkyNetContaReceberId) || is_numeric($SkyNetContaReceberId)) {
        	$campos .= "SkyNetContaReceberId=".$this->dba->quote($SkyNetContaReceberId).", ";
        }
        if (!empty($SkyNetContaReceberParcelaId) || is_numeric($SkyNetContaReceberParcelaId)) {
        	$campos .= "SkyNetContaReceberParcelaId=".$this->dba->quote($SkyNetContaReceberParcelaId).", ";
        }
        if (!empty($SkyNetNotaFiscalManualReciboId) || is_numeric($SkyNetNotaFiscalManualReciboId)) {
        	$campos .= "SkyNetNotaFiscalManualReciboId=".$this->dba->quote($SkyNetNotaFiscalManualReciboId).", ";
        }
        if (!empty($SkyNetNotaFiscalManualReciboNumero) || is_numeric($SkyNetNotaFiscalManualReciboNumero)) {
        	$campos .= "SkyNetNotaFiscalManualReciboNumero=".$this->dba->quote($SkyNetNotaFiscalManualReciboNumero).", ";
        }
        $campos = substr($campos,0,strrpos($campos,','));
        
		//montar o comando SQL
        $sql = "update cn_faturamento set
				$campos
				where  = $";

		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que faz a exclusao de um registro na tabela Cn_faturamento
	 */
	public function delete($obj) {
		//pegar os dados do objeto
		$ = $obj->get();
		
		//montar o comando SQL
		$sql = "delete from cn_faturamento 
				where  = $";
				
		//executar o comando SQL 
		$stt = $this->dba->prepare($sql);
		return $stt->execute();
	}
	
	
	/**
	 * metodo que retorna os regsitros da tabela Cn_faturamento conforme o filtro informado
	 * - filtro e ordem opcionais
	 */
	public function select($where='', $order='') {
		if (!empty($where)) {
			$where = 'where '.$where;
		}
		if (!empty($order)) {
			$order = 'order by '.$order;
		}
		$sql = "select * from cn_faturamento $where $order";
		$res = $this->dba->prepare($sql);
		$res->execute();
		$vet = $res->fetchAll();
		return $vet;
	}
    
    
    /**
	 * metodo que retorna o ultimo id cadastrado na tabela Cn_faturamento
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
		
		$res = $this->dba->query("SHOW COLUMNS FROM cn_faturamento WHERE Field = '".$coluna."'");
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