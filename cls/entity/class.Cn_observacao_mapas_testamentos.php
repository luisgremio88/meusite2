<?php
		/**
 * Classe que representa a tabela "Cn_observacao_mapas_testamentos" 
 */
class Cn_observacao_mapas_testamentos
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

	private $observacaomapasdetestamentosid;
	private $descricaoobservacao;
	private $datacriacao;
	private $nomearquivo;
	private $caminhoarquivo;
	private $ultimaobservacao;
	private $usuarioid;
	private $mapasdetestamentoid;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- observacaomapasdetestamentosid
	public function setObservacaomapasdetestamentosid($observacaomapasdetestamentosid) {
		$this->observacaomapasdetestamentosid = $observacaomapasdetestamentosid;
	}
	public function getObservacaomapasdetestamentosid() {
		return $this->observacaomapasdetestamentosid;
	}
	// -- descricaoobservacao
	public function setDescricaoobservacao($descricaoobservacao) {
		$this->descricaoobservacao = $descricaoobservacao;
	}
	public function getDescricaoobservacao() {
		return $this->descricaoobservacao;
	}
	// -- datacriacao
	public function setDatacriacao($datacriacao) {
		$this->datacriacao = $datacriacao;
	}
	public function getDatacriacao() {
		return $this->datacriacao;
	}
	// -- nomearquivo
	public function setNomearquivo($nomearquivo) {
		$this->nomearquivo = $nomearquivo;
	}
	public function getNomearquivo() {
		return $this->nomearquivo;
	}
	// -- caminhoarquivo
	public function setCaminhoarquivo($caminhoarquivo) {
		$this->caminhoarquivo = $caminhoarquivo;
	}
	public function getCaminhoarquivo() {
		return $this->caminhoarquivo;
	}
	// -- ultimaobservacao
	public function setUltimaobservacao($ultimaobservacao) {
		$this->ultimaobservacao = $ultimaobservacao;
	}
	public function getUltimaobservacao() {
		return $this->ultimaobservacao;
	}
	// -- usuarioid
	public function setUsuarioid($usuarioid) {
		$this->usuarioid = $usuarioid;
	}
	public function getUsuarioid() {
		return $this->usuarioid;
	}
	// -- mapasdetestamentoid
	public function setMapasdetestamentoid($mapasdetestamentoid) {
		$this->mapasdetestamentoid = $mapasdetestamentoid;
	}
	public function getMapasdetestamentoid() {
		return $this->mapasdetestamentoid;
	}
	
} 
	?>