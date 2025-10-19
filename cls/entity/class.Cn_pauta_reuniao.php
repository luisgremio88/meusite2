<?php
		/**
 * Classe que representa a tabela "Cn_pauta_reuniao" 
 */
class Cn_pauta_reuniao
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
	private $horario;
	private $titulo;
	private $texto;
	private $datapauta;
	private $datacriacao;
	
	
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
	// -- horario
	public function setHorario($horario) {
		$this->horario = $horario;
	}
	public function getHorario() {
		return $this->horario;
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
	// -- datapauta
	public function setDatapauta($datapauta) {
		$this->datapauta = $datapauta;
	}
	public function getDatapauta() {
		return $this->datapauta;
	}
	// -- datacriacao
	public function setDatacriacao($datacriacao) {
		$this->datacriacao = $datacriacao;
	}
	public function getDatacriacao() {
		return $this->datacriacao;
	}
	
} 
	?>