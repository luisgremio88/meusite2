<?php
		/**
 * Classe que representa a tabela "Cn_mapas_testamentos" 
 */
class Cn_mapas_testamentos
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

	private $id;
	private $mes;
	private $ano;
	private $boletoskynetid;
	private $datafechamento;
	private $datacriacao;
	private $tabelionatoid;
	private $usuarioid;
	private $situacao;
	private $faturamentoid;
	private $informado;
	private $atrasomotivo;
	private $atrasoanexo;
	private $boletoid;
	private $permitir_excluir;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- id
	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
	// -- mes
	public function setMes($mes) {
		$this->mes = $mes;
	}
	public function getMes() {
		return $this->mes;
	}
	// -- ano
	public function setAno($ano) {
		$this->ano = $ano;
	}
	public function getAno() {
		return $this->ano;
	}
	// -- boletoskynetid
	public function setBoletoskynetid($boletoskynetid) {
		$this->boletoskynetid = $boletoskynetid;
	}
	public function getBoletoskynetid() {
		return $this->boletoskynetid;
	}
	// -- datafechamento
	public function setDatafechamento($datafechamento) {
		$this->datafechamento = $datafechamento;
	}
	public function getDatafechamento() {
		return $this->datafechamento;
	}
	// -- datacriacao
	public function setDatacriacao($datacriacao) {
		$this->datacriacao = $datacriacao;
	}
	public function getDatacriacao() {
		return $this->datacriacao;
	}
	// -- tabelionatoid
	public function setTabelionatoid($tabelionatoid) {
		$this->tabelionatoid = $tabelionatoid;
	}
	public function getTabelionatoid() {
		return $this->tabelionatoid;
	}
	// -- usuarioid
	public function setUsuarioid($usuarioid) {
		$this->usuarioid = $usuarioid;
	}
	public function getUsuarioid() {
		return $this->usuarioid;
	}
	// -- situacao
	public function setSituacao($situacao) {
		$this->situacao = $situacao;
	}
	public function getSituacao() {
		return $this->situacao;
	}
	// -- faturamentoid
	public function setFaturamentoid($faturamentoid) {
		$this->faturamentoid = $faturamentoid;
	}
	public function getFaturamentoid() {
		return $this->faturamentoid;
	}
	// -- informado
	public function setInformado($informado) {
		$this->informado = $informado;
	}
	public function getInformado() {
		return $this->informado;
	}
	// -- atrasomotivo
	public function setAtrasomotivo($atrasomotivo) {
		$this->atrasomotivo = $atrasomotivo;
	}
	public function getAtrasomotivo() {
		return $this->atrasomotivo;
	}
	// -- atrasoanexo
	public function setAtrasoanexo($atrasoanexo) {
		$this->atrasoanexo = $atrasoanexo;
	}
	public function getAtrasoanexo() {
		return $this->atrasoanexo;
	}
	// -- boletoid
	public function setBoletoid($boletoid) {
		$this->boletoid = $boletoid;
	}
	public function getBoletoid() {
		return $this->boletoid;
	}
	// -- permitir_excluir
	public function setPermitir_excluir($permitir_excluir) {
		$this->permitir_excluir = $permitir_excluir;
	}
	public function getPermitir_excluir() {
		return $this->permitir_excluir;
	}
	
} 
	?>