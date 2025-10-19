<?php
		/**
 * Classe que representa a tabela "Cn_links_uteis" 
 */
class Cn_links_uteis
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
	private $tipolink;
	private $titulo;
	private $link;
	private $status;
	private $id_categoria;
	
	
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
	// -- tipolink
	public function setTipolink($tipolink) {
		$this->tipolink = $tipolink;
	}
	public function getTipolink() {
		return $this->tipolink;
	}
	// -- titulo
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	// -- link
	public function setLink($link) {
		$this->link = $link;
	}
	public function getLink() {
		return $this->link;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- id_categoria
	public function setId_categoria($id_categoria) {
		$this->id_categoria = $id_categoria;
	}
	public function getId_categoria() {
		return $this->id_categoria;
	}
	
} 
	?>