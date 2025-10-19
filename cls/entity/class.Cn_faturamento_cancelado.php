<?php
		/**
 * Classe que representa a tabela "Cn_faturamento_cancelado" 
 */
class Cn_faturamento_cancelado
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

	private $faturamentocanceladoid;
	private $motivo;
	private $skynetnotafiscalmanualcancelamentoid;
	private $skynetcontareceberrecebimentoid;
	private $skynetarquivoboletoid;
	private $skynetarquivonotafiscalmanualpdfid;
	private $skynetcontareceberid;
	private $skynetcontareceberparcelaid;
	private $datacriacao;
	private $faturamentoid;
	private $usuarioid;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- faturamentocanceladoid
	public function setFaturamentocanceladoid($faturamentocanceladoid) {
		$this->faturamentocanceladoid = $faturamentocanceladoid;
	}
	public function getFaturamentocanceladoid() {
		return $this->faturamentocanceladoid;
	}
	// -- motivo
	public function setMotivo($motivo) {
		$this->motivo = $motivo;
	}
	public function getMotivo() {
		return $this->motivo;
	}
	// -- skynetnotafiscalmanualcancelamentoid
	public function setSkynetnotafiscalmanualcancelamentoid($skynetnotafiscalmanualcancelamentoid) {
		$this->skynetnotafiscalmanualcancelamentoid = $skynetnotafiscalmanualcancelamentoid;
	}
	public function getSkynetnotafiscalmanualcancelamentoid() {
		return $this->skynetnotafiscalmanualcancelamentoid;
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
	// -- datacriacao
	public function setDatacriacao($datacriacao) {
		$this->datacriacao = $datacriacao;
	}
	public function getDatacriacao() {
		return $this->datacriacao;
	}
	// -- faturamentoid
	public function setFaturamentoid($faturamentoid) {
		$this->faturamentoid = $faturamentoid;
	}
	public function getFaturamentoid() {
		return $this->faturamentoid;
	}
	// -- usuarioid
	public function setUsuarioid($usuarioid) {
		$this->usuarioid = $usuarioid;
	}
	public function getUsuarioid() {
		return $this->usuarioid;
	}
	
} 
	?>