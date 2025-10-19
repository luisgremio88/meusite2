<?php
		/**
 * Classe que representa a tabela "Cn_eventos" 
 */
class Cn_eventos
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

	private $eventoid;
	private $titulo;
	private $descricao;
	private $tipoevento;
	private $vagas;
	private $endereco;
	private $flyer;
	private $enderecogooglemaps;
	private $datainicial;
	private $datafinal;
	private $datacriacao;
	private $urlnoticia;
	private $usuarioinsertid;
	private $final;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- eventoid
	public function setEventoid($eventoid) {
		$this->eventoid = $eventoid;
	}
	public function getEventoid() {
		return $this->eventoid;
	}
	// -- titulo
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	// -- descricao
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	// -- tipoevento
	public function setTipoevento($tipoevento) {
		$this->tipoevento = $tipoevento;
	}
	public function getTipoevento() {
		return $this->tipoevento;
	}
	// -- vagas
	public function setVagas($vagas) {
		$this->vagas = $vagas;
	}
	public function getVagas() {
		return $this->vagas;
	}
	// -- endereco
	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}
	public function getEndereco() {
		return $this->endereco;
	}
	// -- flyer
	public function setFlyer($flyer) {
		$this->flyer = $flyer;
	}
	public function getFlyer() {
		return $this->flyer;
	}
	// -- enderecogooglemaps
	public function setEnderecogooglemaps($enderecogooglemaps) {
		$this->enderecogooglemaps = $enderecogooglemaps;
	}
	public function getEnderecogooglemaps() {
		return $this->enderecogooglemaps;
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
	// -- urlnoticia
	public function setUrlnoticia($urlnoticia) {
		$this->urlnoticia = $urlnoticia;
	}
	public function getUrlnoticia() {
		return $this->urlnoticia;
	}
	// -- usuarioinsertid
	public function setUsuarioinsertid($usuarioinsertid) {
		$this->usuarioinsertid = $usuarioinsertid;
	}
	public function getUsuarioinsertid() {
		return $this->usuarioinsertid;
	}
	// -- final
	public function setFinal($final) {
		$this->final = $final;
	}
	public function getFinal() {
		return $this->final;
	}
	
} 
	?>