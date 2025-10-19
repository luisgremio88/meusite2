<?php
		/**
 * Classe que representa a tabela "Cn_eventos_bk" 
 */
class Cn_eventos_bk
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
	private $data;
	private $titulo;
	private $texto;
	private $anexo;
	private $status;
	private $link;
	
	
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
	// -- data
	public function setData($data) {
		$this->data = $data;
	}
	public function getData() {
		return $this->data;
	}
	// -- titulo
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	// -- texto
	public function setTexto($texto) {
		$this->texto = $texto;
	}
	public function getTexto() {
		return $this->texto;
	}
	// -- anexo
	public function setAnexo($anexo) {
		$this->anexo = $anexo;
	}
	public function getAnexo() {
		return $this->anexo;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- link
	public function setLink($link) {
		$this->link = $link;
	}
	public function getLink() {
		return $this->link;
	}
	
} 
	?>