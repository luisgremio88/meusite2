<?php
		/**
 * Classe que representa a tabela "Cn_evento_participante" 
 */
class Cn_evento_participante
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
	private $tipo_sub_id;
	private $tipo_id;
	
	
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
	// -- tipo_sub_id
	public function setTipo_sub_id($tipo_sub_id) {
		$this->tipo_sub_id = $tipo_sub_id;
	}
	public function getTipo_sub_id() {
		return $this->tipo_sub_id;
	}
	// -- tipo_id
	public function setTipo_id($tipo_id) {
		$this->tipo_id = $tipo_id;
	}
	public function getTipo_id() {
		return $this->tipo_id;
	}
	
} 
	?>