<?php
		/**
 * Classe que representa a tabela "Cn_ce_custos" 
 */
class Cn_ce_custos
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
	private $id_ficha_inscricao;
	private $tipo;
	private $descricao;
	private $valor_unitario;
	private $valor_associado;
	private $val_crrs;
	private $val_iepro;
	private $val_irirgs;
	private $val_outros;
	
	
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
	// -- id_ficha_inscricao
	public function setId_ficha_inscricao($id_ficha_inscricao) {
		$this->id_ficha_inscricao = $id_ficha_inscricao;
	}
	public function getId_ficha_inscricao() {
		return $this->id_ficha_inscricao;
	}
	// -- tipo
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}
	public function getTipo() {
		return $this->tipo;
	}
	// -- descricao
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	// -- valor_unitario
	public function setValor_unitario($valor_unitario) {
		$this->valor_unitario = $valor_unitario;
	}
	public function getValor_unitario() {
		return $this->valor_unitario;
	}
	// -- valor_associado
	public function setValor_associado($valor_associado) {
		$this->valor_associado = $valor_associado;
	}
	public function getValor_associado() {
		return $this->valor_associado;
	}
	// -- val_crrs
	public function setVal_crrs($val_crrs) {
		$this->val_crrs = $val_crrs;
	}
	public function getVal_crrs() {
		return $this->val_crrs;
	}
	// -- val_iepro
	public function setVal_iepro($val_iepro) {
		$this->val_iepro = $val_iepro;
	}
	public function getVal_iepro() {
		return $this->val_iepro;
	}
	// -- val_irirgs
	public function setVal_irirgs($val_irirgs) {
		$this->val_irirgs = $val_irirgs;
	}
	public function getVal_irirgs() {
		return $this->val_irirgs;
	}
	// -- val_outros
	public function setVal_outros($val_outros) {
		$this->val_outros = $val_outros;
	}
	public function getVal_outros() {
		return $this->val_outros;
	}
	
} 
	?>