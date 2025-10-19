<?php
		/**
 * Classe que representa a tabela "__migracao_de_para" 
 */
class __migracao_de_para
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
	private $tabela_clone;
	private $tabela_admin;
	private $localizado;
	private $confirmado;
	
	
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
	// -- tabela_clone
	public function setTabela_clone($tabela_clone) {
		$this->tabela_clone = $tabela_clone;
	}
	public function getTabela_clone() {
		return $this->tabela_clone;
	}
	// -- tabela_admin
	public function setTabela_admin($tabela_admin) {
		$this->tabela_admin = $tabela_admin;
	}
	public function getTabela_admin() {
		return $this->tabela_admin;
	}
	// -- localizado
	public function setLocalizado($localizado) {
		$this->localizado = $localizado;
	}
	public function getLocalizado() {
		return $this->localizado;
	}
	// -- confirmado
	public function setConfirmado($confirmado) {
		$this->confirmado = $confirmado;
	}
	public function getConfirmado() {
		return $this->confirmado;
	}
	
} 
	?>