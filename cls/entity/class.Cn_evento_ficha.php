<?php
		/**
 * Classe que representa a tabela "Cn_evento_ficha" 
 */
class Cn_evento_ficha
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
	private $tabelionato_id;
	private $boleto_id;
	private $evento_id;
	private $finalizado;
	private $recibo_file;
	
	
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
	// -- tabelionato_id
	public function setTabelionato_id($tabelionato_id) {
		$this->tabelionato_id = $tabelionato_id;
	}
	public function getTabelionato_id() {
		return $this->tabelionato_id;
	}
	// -- boleto_id
	public function setBoleto_id($boleto_id) {
		$this->boleto_id = $boleto_id;
	}
	public function getBoleto_id() {
		return $this->boleto_id;
	}
	// -- evento_id
	public function setEvento_id($evento_id) {
		$this->evento_id = $evento_id;
	}
	public function getEvento_id() {
		return $this->evento_id;
	}
	// -- finalizado
	public function setFinalizado($finalizado) {
		$this->finalizado = $finalizado;
	}
	public function getFinalizado() {
		return $this->finalizado;
	}
	// -- recibo_file
	public function setRecibo_file($recibo_file) {
		$this->recibo_file = $recibo_file;
	}
	public function getRecibo_file() {
		return $this->recibo_file;
	}
	
} 
	?>