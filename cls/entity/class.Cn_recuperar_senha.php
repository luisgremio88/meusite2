<?php
		/**
 * Classe que representa a tabela "Cn_recuperar_senha" 
 */
class Cn_recuperar_senha
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
	private $aut;
	private $tipo_usuario;
	private $id_usuario;
	private $data_hora_registro;
	private $ip_registro;
	private $status;
	
	
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
	// -- aut
	public function setAut($aut) {
		$this->aut = $aut;
	}
	public function getAut() {
		return $this->aut;
	}
	// -- tipo_usuario
	public function setTipo_usuario($tipo_usuario) {
		$this->tipo_usuario = $tipo_usuario;
	}
	public function getTipo_usuario() {
		return $this->tipo_usuario;
	}
	// -- id_usuario
	public function setId_usuario($id_usuario) {
		$this->id_usuario = $id_usuario;
	}
	public function getId_usuario() {
		return $this->id_usuario;
	}
	// -- data_hora_registro
	public function setData_hora_registro($data_hora_registro) {
		$this->data_hora_registro = $data_hora_registro;
	}
	public function getData_hora_registro() {
		return $this->data_hora_registro;
	}
	// -- ip_registro
	public function setIp_registro($ip_registro) {
		$this->ip_registro = $ip_registro;
	}
	public function getIp_registro() {
		return $this->ip_registro;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	
} 
	?>