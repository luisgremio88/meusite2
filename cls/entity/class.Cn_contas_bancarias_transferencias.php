<?php
		/**
 * Classe que representa a tabela "Cn_contas_bancarias_transferencias" 
 */
class Cn_contas_bancarias_transferencias
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
	private $descricao;
	private $id_conta_origem;
	private $id_conta_destino;
	private $valor;
	private $status_transferencia;
	private $data_transferencia;
	
	
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
	// -- descricao
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	// -- id_conta_origem
	public function setId_conta_origem($id_conta_origem) {
		$this->id_conta_origem = $id_conta_origem;
	}
	public function getId_conta_origem() {
		return $this->id_conta_origem;
	}
	// -- id_conta_destino
	public function setId_conta_destino($id_conta_destino) {
		$this->id_conta_destino = $id_conta_destino;
	}
	public function getId_conta_destino() {
		return $this->id_conta_destino;
	}
	// -- valor
	public function setValor($valor) {
		$this->valor = $valor;
	}
	public function getValor() {
		return $this->valor;
	}
	// -- status_transferencia
	public function setStatus_transferencia($status_transferencia) {
		$this->status_transferencia = $status_transferencia;
	}
	public function getStatus_transferencia() {
		return $this->status_transferencia;
	}
	// -- data_transferencia
	public function setData_transferencia($data_transferencia) {
		$this->data_transferencia = $data_transferencia;
	}
	public function getData_transferencia() {
		return $this->data_transferencia;
	}
	
} 
	?>