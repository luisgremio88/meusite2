<?php
		/**
 * Classe que representa a tabela "Cr_log_altera_senha" 
 */
class Cr_log_altera_senha
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
	private $ip;
	private $data_hora_registro;
	private $usuario;
	
	
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
	// -- ip
	public function setIp($ip) {
		$this->ip = $ip;
	}
	public function getIp() {
		return $this->ip;
	}
	// -- data_hora_registro
	public function setData_hora_registro($data_hora_registro) {
		$this->data_hora_registro = $data_hora_registro;
	}
	public function getData_hora_registro() {
		return $this->data_hora_registro;
	}
	// -- usuario
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}
	public function getUsuario() {
		return $this->usuario;
	}
	
} 
	?>