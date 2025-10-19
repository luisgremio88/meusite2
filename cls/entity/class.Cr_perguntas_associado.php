<?php
		/**
 * Classe que representa a tabela "Cr_perguntas_associado" 
 */
class Cr_perguntas_associado
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
	private $id_associado;
	private $telefone;
	private $email;
	private $nome;
	private $mensagem;
	private $data_registro;
	private $status;
	private $assunto;
	private $serventia;
	private $categoria;
	
	
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
	// -- id_associado
	public function setId_associado($id_associado) {
		$this->id_associado = $id_associado;
	}
	public function getId_associado() {
		return $this->id_associado;
	}
	// -- telefone
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}
	public function getTelefone() {
		return $this->telefone;
	}
	// -- email
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return $this->email;
	}
	// -- nome
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	// -- mensagem
	public function setMensagem($mensagem) {
		$this->mensagem = $mensagem;
	}
	public function getMensagem() {
		return $this->mensagem;
	}
	// -- data_registro
	public function setData_registro($data_registro) {
		$this->data_registro = $data_registro;
	}
	public function getData_registro() {
		return $this->data_registro;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- assunto
	public function setAssunto($assunto) {
		$this->assunto = $assunto;
	}
	public function getAssunto() {
		return $this->assunto;
	}
	// -- serventia
	public function setServentia($serventia) {
		$this->serventia = $serventia;
	}
	public function getServentia() {
		return $this->serventia;
	}
	// -- categoria
	public function setCategoria($categoria) {
		$this->categoria = $categoria;
	}
	public function getCategoria() {
		return $this->categoria;
	}
	
} 
	?>