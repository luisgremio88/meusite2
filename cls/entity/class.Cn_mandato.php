<?php
		/**
 * Classe que representa a tabela "Cn_mandato" 
 */
class Cn_mandato
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

	private $mandatoid;
	private $datainicio;
	private $datafim;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- mandatoid
	public function setMandatoid($mandatoid) {
		$this->mandatoid = $mandatoid;
	}
	public function getMandatoid() {
		return $this->mandatoid;
	}
	// -- datainicio
	public function setDatainicio($datainicio) {
		$this->datainicio = $datainicio;
	}
	public function getDatainicio() {
		return $this->datainicio;
	}
	// -- datafim
	public function setDatafim($datafim) {
		$this->datafim = $datafim;
	}
	public function getDatafim() {
		return $this->datafim;
	}
	
} 
	?>