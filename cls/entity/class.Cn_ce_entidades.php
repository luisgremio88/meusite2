<?php
		/**
 * Classe que representa a tabela "Cn_ce_entidades" 
 */
class Cn_ce_entidades
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

	private $id_ficha_inscricao;
	private $crrs;
	private $iepro;
	private $irirgs;
	private $outros;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- id_ficha_inscricao
	public function setId_ficha_inscricao($id_ficha_inscricao) {
		$this->id_ficha_inscricao = $id_ficha_inscricao;
	}
	public function getId_ficha_inscricao() {
		return $this->id_ficha_inscricao;
	}
	// -- crrs
	public function setCrrs($crrs) {
		$this->crrs = $crrs;
	}
	public function getCrrs() {
		return $this->crrs;
	}
	// -- iepro
	public function setIepro($iepro) {
		$this->iepro = $iepro;
	}
	public function getIepro() {
		return $this->iepro;
	}
	// -- irirgs
	public function setIrirgs($irirgs) {
		$this->irirgs = $irirgs;
	}
	public function getIrirgs() {
		return $this->irirgs;
	}
	// -- outros
	public function setOutros($outros) {
		$this->outros = $outros;
	}
	public function getOutros() {
		return $this->outros;
	}
	
} 
	?>