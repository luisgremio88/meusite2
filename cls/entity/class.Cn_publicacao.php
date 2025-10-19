<?php
		/**
 * Classe que representa a tabela "Cn_publicacao" 
 */
class Cn_publicacao
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

	private $publicacaoid;
	private $titulo;
	private $edicao;
	private $tipo;
	private $datapublicacao;
	private $datacriacao;
	private $site;
	private $discriminator;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- publicacaoid
	public function setPublicacaoid($publicacaoid) {
		$this->publicacaoid = $publicacaoid;
	}
	public function getPublicacaoid() {
		return $this->publicacaoid;
	}
	// -- titulo
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	// -- edicao
	public function setEdicao($edicao) {
		$this->edicao = $edicao;
	}
	public function getEdicao() {
		return $this->edicao;
	}
	// -- tipo
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}
	public function getTipo() {
		return $this->tipo;
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
	// -- site
	public function setSite($site) {
		$this->site = $site;
	}
	public function getSite() {
		return $this->site;
	}
	// -- discriminator
	public function setDiscriminator($discriminator) {
		$this->discriminator = $discriminator;
	}
	public function getDiscriminator() {
		return $this->discriminator;
	}
	
} 
	?>