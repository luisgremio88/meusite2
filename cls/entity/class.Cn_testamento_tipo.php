<?php
		/**
 * Classe que representa a tabela "Cn_testamento_tipo" 
 */
class Cn_testamento_tipo
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

	private $testamentotipoid;
	private $nome;
	private $testamentotipoxml;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- testamentotipoid
	public function setTestamentotipoid($testamentotipoid) {
		$this->testamentotipoid = $testamentotipoid;
	}
	public function getTestamentotipoid() {
		return $this->testamentotipoid;
	}
	// -- nome
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	// -- testamentotipoxml
	public function setTestamentotipoxml($testamentotipoxml) {
		$this->testamentotipoxml = $testamentotipoxml;
	}
	public function getTestamentotipoxml() {
		return $this->testamentotipoxml;
	}
	
} 
	?>