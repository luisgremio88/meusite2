<?php
		/**
 * Classe que representa a tabela "Cn_contas_bancarias" 
 */
class Cn_contas_bancarias
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
	private $nome;
	private $banco;
	private $agencia;
	private $conta;
	private $tipo_conta;
	private $saldo;
	private $observacao;
	private $data_cadastro;
	
	
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
	// -- nome
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	// -- banco
	public function setBanco($banco) {
		$this->banco = $banco;
	}
	public function getBanco() {
		return $this->banco;
	}
	// -- agencia
	public function setAgencia($agencia) {
		$this->agencia = $agencia;
	}
	public function getAgencia() {
		return $this->agencia;
	}
	// -- conta
	public function setConta($conta) {
		$this->conta = $conta;
	}
	public function getConta() {
		return $this->conta;
	}
	// -- tipo_conta
	public function setTipo_conta($tipo_conta) {
		$this->tipo_conta = $tipo_conta;
	}
	public function getTipo_conta() {
		return $this->tipo_conta;
	}
	// -- saldo
	public function setSaldo($saldo) {
		$this->saldo = $saldo;
	}
	public function getSaldo() {
		return $this->saldo;
	}
	// -- observacao
	public function setObservacao($observacao) {
		$this->observacao = $observacao;
	}
	public function getObservacao() {
		return $this->observacao;
	}
	// -- data_cadastro
	public function setData_cadastro($data_cadastro) {
		$this->data_cadastro = $data_cadastro;
	}
	public function getData_cadastro() {
		return $this->data_cadastro;
	}
	
} 
	?>