<?php
		/**
 * Classe que representa a tabela "Cn_mapas" 
 */
class Cn_mapas
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
	private $id_tabelionato;
	private $status;
	private $informado;
	private $quantidade;
	
	
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
	// -- id_tabelionato
	public function setId_tabelionato($id_tabelionato) {
		$this->id_tabelionato = $id_tabelionato;
	}
	public function getId_tabelionato() {
		return $this->id_tabelionato;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- informado
	public function setInformado($informado) {
		$this->informado = $informado;
	}
	public function getInformado() {
		return $this->informado;
	}
	// -- quantidade
	public function setQuantidade($quantidade) {
		$this->quantidade = $quantidade;
	}
	public function getQuantidade() {
		return $this->quantidade;
	}
	
} 
	?>