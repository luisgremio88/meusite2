<?php
		/**
 * Classe que representa a tabela "Cn_certificados" 
 */
class Cn_certificados
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
	private $modalidade;
	private $id_usuario;
	private $nome_usuario;
	private $token;
	private $id_curso_evento;
	private $data_evento;
	
	
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
	// -- modalidade
	public function setModalidade($modalidade) {
		$this->modalidade = $modalidade;
	}
	public function getModalidade() {
		return $this->modalidade;
	}
	// -- id_usuario
	public function setId_usuario($id_usuario) {
		$this->id_usuario = $id_usuario;
	}
	public function getId_usuario() {
		return $this->id_usuario;
	}
	// -- nome_usuario
	public function setNome_usuario($nome_usuario) {
		$this->nome_usuario = $nome_usuario;
	}
	public function getNome_usuario() {
		return $this->nome_usuario;
	}
	// -- token
	public function setToken($token) {
		$this->token = $token;
	}
	public function getToken() {
		return $this->token;
	}
	// -- id_curso_evento
	public function setId_curso_evento($id_curso_evento) {
		$this->id_curso_evento = $id_curso_evento;
	}
	public function getId_curso_evento() {
		return $this->id_curso_evento;
	}
	// -- data_evento
	public function setData_evento($data_evento) {
		$this->data_evento = $data_evento;
	}
	public function getData_evento() {
		return $this->data_evento;
	}
	
} 
	?>