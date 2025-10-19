<?php
		/**
 * Classe que representa a tabela "Cn_palestra" 
 */
class Cn_palestra
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

	private $palestraid;
	private $evento;
	private $descricao;
	private $datacriacao;
	private $usuarioid;
	private $datapalestra;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- palestraid
	public function setPalestraid($palestraid) {
		$this->palestraid = $palestraid;
	}
	public function getPalestraid() {
		return $this->palestraid;
	}
	// -- evento
	public function setEvento($evento) {
		$this->evento = $evento;
	}
	public function getEvento() {
		return $this->evento;
	}
	// -- descricao
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	// -- datacriacao
	public function setDatacriacao($datacriacao) {
		$this->datacriacao = $datacriacao;
	}
	public function getDatacriacao() {
		return $this->datacriacao;
	}
	// -- usuarioid
	public function setUsuarioid($usuarioid) {
		$this->usuarioid = $usuarioid;
	}
	public function getUsuarioid() {
		return $this->usuarioid;
	}
	// -- datapalestra
	public function setDatapalestra($datapalestra) {
		$this->datapalestra = $datapalestra;
	}
	public function getDatapalestra() {
		return $this->datapalestra;
	}
	
} 
	?>