<?php
		/**
 * Classe que representa a tabela "Cn_usuario_admin" 
 */
class Cn_usuario_admin
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
	private $user;
	private $pass;
	private $name;
	private $type;
	private $status;
	private $acess_panel;
	
	
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
	// -- user
	public function setUser($user) {
		$this->user = $user;
	}
	public function getUser() {
		return $this->user;
	}
	// -- pass
	public function setPass($pass) {
		$this->pass = $pass;
	}
	public function getPass() {
		return $this->pass;
	}
	// -- name
	public function setName($name) {
		$this->name = $name;
	}
	public function getName() {
		return $this->name;
	}
	// -- type
	public function setType($type) {
		$this->type = $type;
	}
	public function getType() {
		return $this->type;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- acess_panel
	public function setAcess_panel($acess_panel) {
		$this->acess_panel = $acess_panel;
	}
	public function getAcess_panel() {
		return $this->acess_panel;
	}
	
} 
	?>