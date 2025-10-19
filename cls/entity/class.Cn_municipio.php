<?php
		/**
 * Classe que representa a tabela "Cn_municipio" 
 */
class Cn_municipio
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

	private $municipioid;
	private $nome;
	private $codigoibge;
	private $estadoid;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- municipioid
	public function setMunicipioid($municipioid) {
		$this->municipioid = $municipioid;
	}
	public function getMunicipioid() {
		return $this->municipioid;
	}
	// -- nome
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	// -- codigoibge
	public function setCodigoibge($codigoibge) {
		$this->codigoibge = $codigoibge;
	}
	public function getCodigoibge() {
		return $this->codigoibge;
	}
	// -- estadoid
	public function setEstadoid($estadoid) {
		$this->estadoid = $estadoid;
	}
	public function getEstadoid() {
		return $this->estadoid;
	}
	
} 
	?>