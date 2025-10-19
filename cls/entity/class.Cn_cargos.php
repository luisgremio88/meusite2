<?php
		/**
 * Classe que representa a tabela "Cn_cargos" 
 */
class Cn_cargos
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

	private $cargoid;
	private $descricao;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- cargoid
	public function setCargoid($cargoid) {
		$this->cargoid = $cargoid;
	}
	public function getCargoid() {
		return $this->cargoid;
	}
	// -- descricao
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	
} 
	?>