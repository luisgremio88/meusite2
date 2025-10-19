<?php
		/**
 * Classe que representa a tabela "Cn_fechamento_diario" 
 */
class Cn_fechamento_diario
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
	private $data_hora_abertura;
	private $data_hora_fechamento;
	private $status;
	
	
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
	// -- data_hora_abertura
	public function setData_hora_abertura($data_hora_abertura) {
		$this->data_hora_abertura = $data_hora_abertura;
	}
	public function getData_hora_abertura() {
		return $this->data_hora_abertura;
	}
	// -- data_hora_fechamento
	public function setData_hora_fechamento($data_hora_fechamento) {
		$this->data_hora_fechamento = $data_hora_fechamento;
	}
	public function getData_hora_fechamento() {
		return $this->data_hora_fechamento;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	
} 
	?>