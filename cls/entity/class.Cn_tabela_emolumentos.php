<?php
		/**
 * Classe que representa a tabela "Cn_tabela_emolumentos" 
 */
class Cn_tabela_emolumentos
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

	private $tabelaemolumentosid;
	private $ano;
	private $titulo;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- tabelaemolumentosid
	public function setTabelaemolumentosid($tabelaemolumentosid) {
		$this->tabelaemolumentosid = $tabelaemolumentosid;
	}
	public function getTabelaemolumentosid() {
		return $this->tabelaemolumentosid;
	}
	// -- ano
	public function setAno($ano) {
		$this->ano = $ano;
	}
	public function getAno() {
		return $this->ano;
	}
	// -- titulo
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	
} 
	?>