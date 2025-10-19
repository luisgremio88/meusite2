<?php
		/**
 * Classe que representa a tabela "Cn_evento_ficha_servico" 
 */
class Cn_evento_ficha_servico
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
	private $ficha_id;
	private $participante_id;
	private $servico_id;
	private $ficha_participante_id;
	private $valor;
	
	
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
	// -- ficha_id
	public function setFicha_id($ficha_id) {
		$this->ficha_id = $ficha_id;
	}
	public function getFicha_id() {
		return $this->ficha_id;
	}
	// -- participante_id
	public function setParticipante_id($participante_id) {
		$this->participante_id = $participante_id;
	}
	public function getParticipante_id() {
		return $this->participante_id;
	}
	// -- servico_id
	public function setServico_id($servico_id) {
		$this->servico_id = $servico_id;
	}
	public function getServico_id() {
		return $this->servico_id;
	}
	// -- ficha_participante_id
	public function setFicha_participante_id($ficha_participante_id) {
		$this->ficha_participante_id = $ficha_participante_id;
	}
	public function getFicha_participante_id() {
		return $this->ficha_participante_id;
	}
	// -- valor
	public function setValor($valor) {
		$this->valor = $valor;
	}
	public function getValor() {
		return $this->valor;
	}
	
} 
	?>