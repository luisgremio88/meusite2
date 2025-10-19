<?php
		/**
 * Classe que representa a tabela "Cn_pauta_reuniao_ata" 
 */
class Cn_pauta_reuniao_ata
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

	private $pautareuniaoataid;
	private $horario;
	private $titulo;
	private $texto;
	private $dataata;
	private $datacriacao;
	private $pautaid;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- pautareuniaoataid
	public function setPautareuniaoataid($pautareuniaoataid) {
		$this->pautareuniaoataid = $pautareuniaoataid;
	}
	public function getPautareuniaoataid() {
		return $this->pautareuniaoataid;
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
	// -- dataata
	public function setDataata($dataata) {
		$this->dataata = $dataata;
	}
	public function getDataata() {
		return $this->dataata;
	}
	// -- datacriacao
	public function setDatacriacao($datacriacao) {
		$this->datacriacao = $datacriacao;
	}
	public function getDatacriacao() {
		return $this->datacriacao;
	}
	// -- pautaid
	public function setPautaid($pautaid) {
		$this->pautaid = $pautaid;
	}
	public function getPautaid() {
		return $this->pautaid;
	}
	
} 
	?>