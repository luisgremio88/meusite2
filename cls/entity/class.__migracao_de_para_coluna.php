<?php
		/**
 * Classe que representa a tabela "__migracao_de_para_coluna" 
 */
class __migracao_de_para_coluna
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
	private $id__migracao_de_para;
	private $coluna_clone_nome;
	private $coluna_clone_tipo;
	private $coluna_admin_nome;
	private $coluna_admin_tipo;
	
	
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
	// -- id__migracao_de_para
	public function setId__migracao_de_para($id__migracao_de_para) {
		$this->id__migracao_de_para = $id__migracao_de_para;
	}
	public function getId__migracao_de_para() {
		return $this->id__migracao_de_para;
	}
	// -- coluna_clone_nome
	public function setColuna_clone_nome($coluna_clone_nome) {
		$this->coluna_clone_nome = $coluna_clone_nome;
	}
	public function getColuna_clone_nome() {
		return $this->coluna_clone_nome;
	}
	// -- coluna_clone_tipo
	public function setColuna_clone_tipo($coluna_clone_tipo) {
		$this->coluna_clone_tipo = $coluna_clone_tipo;
	}
	public function getColuna_clone_tipo() {
		return $this->coluna_clone_tipo;
	}
	// -- coluna_admin_nome
	public function setColuna_admin_nome($coluna_admin_nome) {
		$this->coluna_admin_nome = $coluna_admin_nome;
	}
	public function getColuna_admin_nome() {
		return $this->coluna_admin_nome;
	}
	// -- coluna_admin_tipo
	public function setColuna_admin_tipo($coluna_admin_tipo) {
		$this->coluna_admin_tipo = $coluna_admin_tipo;
	}
	public function getColuna_admin_tipo() {
		return $this->coluna_admin_tipo;
	}
	
} 
	?>