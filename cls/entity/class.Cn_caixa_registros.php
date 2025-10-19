<?php
		/**
 * Classe que representa a tabela "Cn_caixa_registros" 
 */
class Cn_caixa_registros
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
	private $descricao;
	private $id_conta;
	private $valor;
	private $data_time;
	private $id_fechamento;
	
	
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
	// -- descricao
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	// -- id_conta
	public function setId_conta($id_conta) {
		$this->id_conta = $id_conta;
	}
	public function getId_conta() {
		return $this->id_conta;
	}
	// -- valor
	public function setValor($valor) {
		$this->valor = $valor;
	}
	public function getValor() {
		return $this->valor;
	}
	// -- data_time
	public function setData_time($data_time) {
		$this->data_time = $data_time;
	}
	public function getData_time() {
		return $this->data_time;
	}
	// -- id_fechamento
	public function setId_fechamento($id_fechamento) {
		$this->id_fechamento = $id_fechamento;
	}
	public function getId_fechamento() {
		return $this->id_fechamento;
	}
	
} 
	?>