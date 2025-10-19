<?php
		/**
 * Classe que representa a tabela "Cn_noticia" 
 */
class Cn_noticia
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
	private $titulo;
	private $resumo;
	private $texto;
	private $destaque;
	private $tags;
	private $link;
	private $externo;
	private $datapublicacao;
	private $datacriacao;
	private $tiponoticia;
	private $associado;
	private $status;
	private $anexo;
	
	
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
	// -- titulo
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	// -- resumo
	public function setResumo($resumo) {
		$this->resumo = $resumo;
	}
	public function getResumo() {
		return $this->resumo;
	}
	// -- texto
	public function setTexto($texto) {
		$this->texto = $texto;
	}
	public function getTexto() {
		return $this->texto;
	}
	// -- destaque
	public function setDestaque($destaque) {
		$this->destaque = $destaque;
	}
	public function getDestaque() {
		return $this->destaque;
	}
	// -- tags
	public function setTags($tags) {
		$this->tags = $tags;
	}
	public function getTags() {
		return $this->tags;
	}
	// -- link
	public function setLink($link) {
		$this->link = $link;
	}
	public function getLink() {
		return $this->link;
	}
	// -- externo
	public function setExterno($externo) {
		$this->externo = $externo;
	}
	public function getExterno() {
		return $this->externo;
	}
	// -- datapublicacao
	public function setDatapublicacao($datapublicacao) {
		$this->datapublicacao = $datapublicacao;
	}
	public function getDatapublicacao() {
		return $this->datapublicacao;
	}
	// -- datacriacao
	public function setDatacriacao($datacriacao) {
		$this->datacriacao = $datacriacao;
	}
	public function getDatacriacao() {
		return $this->datacriacao;
	}
	// -- tiponoticia
	public function setTiponoticia($tiponoticia) {
		$this->tiponoticia = $tiponoticia;
	}
	public function getTiponoticia() {
		return $this->tiponoticia;
	}
	// -- associado
	public function setAssociado($associado) {
		$this->associado = $associado;
	}
	public function getAssociado() {
		return $this->associado;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- anexo
	public function setAnexo($anexo) {
		$this->anexo = $anexo;
	}
	public function getAnexo() {
		return $this->anexo;
	}
	
} 
	?>