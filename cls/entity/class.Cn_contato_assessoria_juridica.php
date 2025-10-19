<?php
		/**
 * Classe que representa a tabela "Cn_contato_assessoria_juridica" 
 */
class Cn_contato_assessoria_juridica
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
	private $email;
	private $telefone;
	private $profissao;
	private $tabelionato;
	private $cidade_estado;
	private $pergunta;
	private $status;
	private $data_hora_cadastro;
	
	
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
	// -- email
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return $this->email;
	}
	// -- telefone
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}
	public function getTelefone() {
		return $this->telefone;
	}
	// -- profissao
	public function setProfissao($profissao) {
		$this->profissao = $profissao;
	}
	public function getProfissao() {
		return $this->profissao;
	}
	// -- tabelionato
	public function setTabelionato($tabelionato) {
		$this->tabelionato = $tabelionato;
	}
	public function getTabelionato() {
		return $this->tabelionato;
	}
	// -- cidade_estado
	public function setCidade_estado($cidade_estado) {
		$this->cidade_estado = $cidade_estado;
	}
	public function getCidade_estado() {
		return $this->cidade_estado;
	}
	// -- pergunta
	public function setPergunta($pergunta) {
		$this->pergunta = $pergunta;
	}
	public function getPergunta() {
		return $this->pergunta;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- data_hora_cadastro
	public function setData_hora_cadastro($data_hora_cadastro) {
		$this->data_hora_cadastro = $data_hora_cadastro;
	}
	public function getData_hora_cadastro() {
		return $this->data_hora_cadastro;
	}
	
} 
	?>