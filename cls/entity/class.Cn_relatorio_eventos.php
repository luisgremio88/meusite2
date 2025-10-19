<?php
		/**
 * Classe que representa a tabela "Cn_relatorio_eventos" 
 */
class Cn_relatorio_eventos
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
	private $nome_evento;
	private $valor;
	private $descricao;
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
	// -- nome_evento
	public function setNome_evento($nome_evento) {
		$this->nome_evento = $nome_evento;
	}
	public function getNome_evento() {
		return $this->nome_evento;
	}
	// -- valor
	public function setValor($valor) {
		$this->valor = $valor;
	}
	public function getValor() {
		return $this->valor;
	}
	// -- descricao
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
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