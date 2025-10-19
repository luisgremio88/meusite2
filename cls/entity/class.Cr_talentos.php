<?php
		/**
 * Classe que representa a tabela "Cr_talentos" 
 */
class Cr_talentos
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
	private $curriculo;
	private $data_registro;
	
	
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
	// -- curriculo
	public function setCurriculo($curriculo) {
		$this->curriculo = $curriculo;
	}
	public function getCurriculo() {
		return $this->curriculo;
	}
	// -- data_registro
	public function setData_registro($data_registro) {
		$this->data_registro = $data_registro;
	}
	public function getData_registro() {
		return $this->data_registro;
	}
	
} 
	?>