<?php
		/**
 * Classe que representa a tabela "Cn_ce_adicionais" 
 */
class Cn_ce_adicionais
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
	private $id_inscricao;
	private $nome;
	private $tipo;
	private $funcao;
	
	
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
	// -- id_inscricao
	public function setId_inscricao($id_inscricao) {
		$this->id_inscricao = $id_inscricao;
	}
	public function getId_inscricao() {
		return $this->id_inscricao;
	}
	// -- nome
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	// -- tipo
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}
	public function getTipo() {
		return $this->tipo;
	}
	// -- funcao
	public function setFuncao($funcao) {
		$this->funcao = $funcao;
	}
	public function getFuncao() {
		return $this->funcao;
	}
	
} 
	?>