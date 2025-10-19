<?php
		/**
 * Classe que representa a tabela "Cn_entidade" 
 */
class Cn_entidade
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

	private $entidadeid;
	private $nome;
	private $descricao;
	private $datacriacao;
	private $usuarioid;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- entidadeid
	public function setEntidadeid($entidadeid) {
		$this->entidadeid = $entidadeid;
	}
	public function getEntidadeid() {
		return $this->entidadeid;
	}
	// -- nome
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	// -- descricao
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	// -- datacriacao
	public function setDatacriacao($datacriacao) {
		$this->datacriacao = $datacriacao;
	}
	public function getDatacriacao() {
		return $this->datacriacao;
	}
	// -- usuarioid
	public function setUsuarioid($usuarioid) {
		$this->usuarioid = $usuarioid;
	}
	public function getUsuarioid() {
		return $this->usuarioid;
	}
	
} 
	?>