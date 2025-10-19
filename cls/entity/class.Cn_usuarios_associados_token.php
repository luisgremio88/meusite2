<?php
		/**
 * Classe que representa a tabela "Cn_usuarios_associados_token" 
 */
class Cn_usuarios_associados_token
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
	private $id_usuarios;
	private $token;
	private $data_hora_registro;
	
	
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
	// -- id_usuarios
	public function setId_usuarios($id_usuarios) {
		$this->id_usuarios = $id_usuarios;
	}
	public function getId_usuarios() {
		return $this->id_usuarios;
	}
	// -- token
	public function setToken($token) {
		$this->token = $token;
	}
	public function getToken() {
		return $this->token;
	}
	// -- data_hora_registro
	public function setData_hora_registro($data_hora_registro) {
		$this->data_hora_registro = $data_hora_registro;
	}
	public function getData_hora_registro() {
		return $this->data_hora_registro;
	}
	
} 
	?>