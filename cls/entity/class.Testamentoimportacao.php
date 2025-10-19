<?php
		/**
 * Classe que representa a tabela "Testamentoimportacao" 
 */
class Testamentoimportacao
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

	private $testamentoimportacaoid;
	private $nomearquivo;
	private $arquivo;
	private $tamanho;
	private $quantidade;
	private $digitado;
	private $datainicial;
	private $datafinal;
	private $datacriacao;
	private $tabelionatoid;
	private $usuarioinsertid;
	private $mapasdetestamentosid;
	private $quantidadepartes;
	private $quantidadetestamentos;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- testamentoimportacaoid
	public function setTestamentoimportacaoid($testamentoimportacaoid) {
		$this->testamentoimportacaoid = $testamentoimportacaoid;
	}
	public function getTestamentoimportacaoid() {
		return $this->testamentoimportacaoid;
	}
	// -- nomearquivo
	public function setNomearquivo($nomearquivo) {
		$this->nomearquivo = $nomearquivo;
	}
	public function getNomearquivo() {
		return $this->nomearquivo;
	}
	// -- arquivo
	public function setArquivo($arquivo) {
		$this->arquivo = $arquivo;
	}
	public function getArquivo() {
		return $this->arquivo;
	}
	// -- tamanho
	public function setTamanho($tamanho) {
		$this->tamanho = $tamanho;
	}
	public function getTamanho() {
		return $this->tamanho;
	}
	// -- quantidade
	public function setQuantidade($quantidade) {
		$this->quantidade = $quantidade;
	}
	public function getQuantidade() {
		return $this->quantidade;
	}
	// -- digitado
	public function setDigitado($digitado) {
		$this->digitado = $digitado;
	}
	public function getDigitado() {
		return $this->digitado;
	}
	// -- datainicial
	public function setDatainicial($datainicial) {
		$this->datainicial = $datainicial;
	}
	public function getDatainicial() {
		return $this->datainicial;
	}
	// -- datafinal
	public function setDatafinal($datafinal) {
		$this->datafinal = $datafinal;
	}
	public function getDatafinal() {
		return $this->datafinal;
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
	// -- usuarioinsertid
	public function setUsuarioinsertid($usuarioinsertid) {
		$this->usuarioinsertid = $usuarioinsertid;
	}
	public function getUsuarioinsertid() {
		return $this->usuarioinsertid;
	}
	// -- mapasdetestamentosid
	public function setMapasdetestamentosid($mapasdetestamentosid) {
		$this->mapasdetestamentosid = $mapasdetestamentosid;
	}
	public function getMapasdetestamentosid() {
		return $this->mapasdetestamentosid;
	}
	// -- quantidadepartes
	public function setQuantidadepartes($quantidadepartes) {
		$this->quantidadepartes = $quantidadepartes;
	}
	public function getQuantidadepartes() {
		return $this->quantidadepartes;
	}
	// -- quantidadetestamentos
	public function setQuantidadetestamentos($quantidadetestamentos) {
		$this->quantidadetestamentos = $quantidadetestamentos;
	}
	public function getQuantidadetestamentos() {
		return $this->quantidadetestamentos;
	}
	
} 
	?>