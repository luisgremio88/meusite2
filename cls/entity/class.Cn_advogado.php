<?php
		/**
 * Classe que representa a tabela "Cn_advogado" 
 */
class Cn_advogado
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

	private $advogadoid;
	private $nome;
	private $texto;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- advogadoid
	public function setAdvogadoid($advogadoid) {
		$this->advogadoid = $advogadoid;
	}
	public function getAdvogadoid() {
		return $this->advogadoid;
	}
	// -- nome
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	// -- texto
	public function setTexto($texto) {
		$this->texto = $texto;
	}
	public function getTexto() {
		return $this->texto;
	}
	
} 
	?>