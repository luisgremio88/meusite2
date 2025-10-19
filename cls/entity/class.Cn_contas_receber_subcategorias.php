<?php
		/**
 * Classe que representa a tabela "Cn_contas_receber_subcategorias" 
 */
class Cn_contas_receber_subcategorias
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
	private $categoria;
	private $observacao;
	
	
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
	// -- categoria
	public function setCategoria($categoria) {
		$this->categoria = $categoria;
	}
	public function getCategoria() {
		return $this->categoria;
	}
	// -- observacao
	public function setObservacao($observacao) {
		$this->observacao = $observacao;
	}
	public function getObservacao() {
		return $this->observacao;
	}
	
} 
	?>