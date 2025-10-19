<?php
		/**
 * Classe que representa a tabela "Cn_banners" 
 */
class Cn_banners
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
	private $descricao;
	private $subtitulo;
	private $texto_botao;
	private $link;
	private $posicao;
	private $status;
	
	
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
	// -- descricao
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	// -- subtitulo
	public function setSubtitulo($subtitulo) {
		$this->subtitulo = $subtitulo;
	}
	public function getSubtitulo() {
		return $this->subtitulo;
	}
	// -- texto_botao
	public function setTexto_botao($texto_botao) {
		$this->texto_botao = $texto_botao;
	}
	public function getTexto_botao() {
		return $this->texto_botao;
	}
	// -- link
	public function setLink($link) {
		$this->link = $link;
	}
	public function getLink() {
		return $this->link;
	}
	// -- posicao
	public function setPosicao($posicao) {
		$this->posicao = $posicao;
	}
	public function getPosicao() {
		return $this->posicao;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	
} 
	?>