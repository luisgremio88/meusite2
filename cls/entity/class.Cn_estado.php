<?php
		/**
 * Classe que representa a tabela "Cn_estado" 
 */
class Cn_estado
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

	private $estadoid;
	private $nome;
	private $sigla;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- estadoid
	public function setEstadoid($estadoid) {
		$this->estadoid = $estadoid;
	}
	public function getEstadoid() {
		return $this->estadoid;
	}
	// -- nome
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	// -- sigla
	public function setSigla($sigla) {
		$this->sigla = $sigla;
	}
	public function getSigla() {
		return $this->sigla;
	}
	
} 
	?>