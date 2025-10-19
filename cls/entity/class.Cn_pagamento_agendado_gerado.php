<?php
		/**
 * Classe que representa a tabela "Cn_pagamento_agendado_gerado" 
 */
class Cn_pagamento_agendado_gerado
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
	private $id_agenda;
	private $mes;
	private $ano;
	
	
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
	// -- id_agenda
	public function setId_agenda($id_agenda) {
		$this->id_agenda = $id_agenda;
	}
	public function getId_agenda() {
		return $this->id_agenda;
	}
	// -- mes
	public function setMes($mes) {
		$this->mes = $mes;
	}
	public function getMes() {
		return $this->mes;
	}
	// -- ano
	public function setAno($ano) {
		$this->ano = $ano;
	}
	public function getAno() {
		return $this->ano;
	}
	
} 
	?>