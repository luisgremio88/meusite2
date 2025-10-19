<?php
		/**
 * Classe que representa a tabela "Cn_faturamento" 
 */
class Cn_faturamento
{
	/**
	 * metodo construtor
	 */ 
	public function __construct(){}

	/**
	 * metodo clone do tipo privado previne a clonagem dessa instancia da classe
	 */
	public function __clone(){}

	/**
	 * destrutor do objeto da classe
	 */
	public function __destruct(){}


	/**
	 * atributos (variaveis) relacionadas as colunas da tabela
	 */

	private $faturamentoid;
	private $skynetcontareceberrecebimentoid;
	private $skynetarquivoboletoid;
	private $skynetarquivonotafiscalmanualpdfid;
	private $status;
	private $datacriacao;
	private $dataatualizacao;
	private $formadepagamento;
	private $skynetcontareceberid;
	private $skynetcontareceberparcelaid;
	private $skynetnotafiscalmanualreciboid;
	private $skynetnotafiscalmanualrecibonumero;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- faturamentoid
	public function setFaturamentoid($faturamentoid) {
		$this->faturamentoid = $faturamentoid;
	}
	public function getFaturamentoid() {
		return $this->faturamentoid;
	}
	// -- skynetcontareceberrecebimentoid
	public function setSkynetcontareceberrecebimentoid($skynetcontareceberrecebimentoid) {
		$this->skynetcontareceberrecebimentoid = $skynetcontareceberrecebimentoid;
	}
	public function getSkynetcontareceberrecebimentoid() {
		return $this->skynetcontareceberrecebimentoid;
	}
	// -- skynetarquivoboletoid
	public function setSkynetarquivoboletoid($skynetarquivoboletoid) {
		$this->skynetarquivoboletoid = $skynetarquivoboletoid;
	}
	public function getSkynetarquivoboletoid() {
		return $this->skynetarquivoboletoid;
	}
	// -- skynetarquivonotafiscalmanualpdfid
	public function setSkynetarquivonotafiscalmanualpdfid($skynetarquivonotafiscalmanualpdfid) {
		$this->skynetarquivonotafiscalmanualpdfid = $skynetarquivonotafiscalmanualpdfid;
	}
	public function getSkynetarquivonotafiscalmanualpdfid() {
		return $this->skynetarquivonotafiscalmanualpdfid;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- datacriacao
	public function setDatacriacao($datacriacao) {
		$this->datacriacao = $datacriacao;
	}
	public function getDatacriacao() {
		return $this->datacriacao;
	}
	// -- dataatualizacao
	public function setDataatualizacao($dataatualizacao) {
		$this->dataatualizacao = $dataatualizacao;
	}
	public function getDataatualizacao() {
		return $this->dataatualizacao;
	}
	// -- formadepagamento
	public function setFormadepagamento($formadepagamento) {
		$this->formadepagamento = $formadepagamento;
	}
	public function getFormadepagamento() {
		return $this->formadepagamento;
	}
	// -- skynetcontareceberid
	public function setSkynetcontareceberid($skynetcontareceberid) {
		$this->skynetcontareceberid = $skynetcontareceberid;
	}
	public function getSkynetcontareceberid() {
		return $this->skynetcontareceberid;
	}
	// -- skynetcontareceberparcelaid
	public function setSkynetcontareceberparcelaid($skynetcontareceberparcelaid) {
		$this->skynetcontareceberparcelaid = $skynetcontareceberparcelaid;
	}
	public function getSkynetcontareceberparcelaid() {
		return $this->skynetcontareceberparcelaid;
	}
	// -- skynetnotafiscalmanualreciboid
	public function setSkynetnotafiscalmanualreciboid($skynetnotafiscalmanualreciboid) {
		$this->skynetnotafiscalmanualreciboid = $skynetnotafiscalmanualreciboid;
	}
	public function getSkynetnotafiscalmanualreciboid() {
		return $this->skynetnotafiscalmanualreciboid;
	}
	// -- skynetnotafiscalmanualrecibonumero
	public function setSkynetnotafiscalmanualrecibonumero($skynetnotafiscalmanualrecibonumero) {
		$this->skynetnotafiscalmanualrecibonumero = $skynetnotafiscalmanualrecibonumero;
	}
	public function getSkynetnotafiscalmanualrecibonumero() {
		return $this->skynetnotafiscalmanualrecibonumero;
	}
	
} 
	?>