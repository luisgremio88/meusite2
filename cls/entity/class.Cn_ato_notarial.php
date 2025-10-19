<?php
		/**
 * Classe que representa a tabela "Cn_ato_notarial" 
 */
class Cn_ato_notarial
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

	private $atonotarialid;
	private $titulo;
	private $texto;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- atonotarialid
	public function setAtonotarialid($atonotarialid) {
		$this->atonotarialid = $atonotarialid;
	}
	public function getAtonotarialid() {
		return $this->atonotarialid;
	}
	// -- titulo
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function getTitulo() {
		return $this->titulo;
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