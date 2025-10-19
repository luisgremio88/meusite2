<?php
		/**
 * Classe que representa a tabela "Cn_mandatos" 
 */
class Cn_mandatos
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

	private $mandatosid;
	private $anoinicial;
	private $anofinal;
	private $expresidenteid;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- mandatosid
	public function setMandatosid($mandatosid) {
		$this->mandatosid = $mandatosid;
	}
	public function getMandatosid() {
		return $this->mandatosid;
	}
	// -- anoinicial
	public function setAnoinicial($anoinicial) {
		$this->anoinicial = $anoinicial;
	}
	public function getAnoinicial() {
		return $this->anoinicial;
	}
	// -- anofinal
	public function setAnofinal($anofinal) {
		$this->anofinal = $anofinal;
	}
	public function getAnofinal() {
		return $this->anofinal;
	}
	// -- expresidenteid
	public function setExpresidenteid($expresidenteid) {
		$this->expresidenteid = $expresidenteid;
	}
	public function getExpresidenteid() {
		return $this->expresidenteid;
	}
	
} 
	?>