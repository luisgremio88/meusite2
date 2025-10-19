<?php
		/**
 * Classe que representa a tabela "Cr_emolumentos" 
 */
class Cr_emolumentos
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
	private $ano;
	private $vigencia;
	private $observacoes;
	private $anexo_emolumentos;
	private $anexo_certidoes;
	
	
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
	// -- ano
	public function setAno($ano) {
		$this->ano = $ano;
	}
	public function getAno() {
		return $this->ano;
	}
	// -- vigencia
	public function setVigencia($vigencia) {
		$this->vigencia = $vigencia;
	}
	public function getVigencia() {
		return $this->vigencia;
	}
	// -- observacoes
	public function setObservacoes($observacoes) {
		$this->observacoes = $observacoes;
	}
	public function getObservacoes() {
		return $this->observacoes;
	}
	// -- anexo_emolumentos
	public function setAnexo_emolumentos($anexo_emolumentos) {
		$this->anexo_emolumentos = $anexo_emolumentos;
	}
	public function getAnexo_emolumentos() {
		return $this->anexo_emolumentos;
	}
	// -- anexo_certidoes
	public function setAnexo_certidoes($anexo_certidoes) {
		$this->anexo_certidoes = $anexo_certidoes;
	}
	public function getAnexo_certidoes() {
		return $this->anexo_certidoes;
	}
	
} 
	?>