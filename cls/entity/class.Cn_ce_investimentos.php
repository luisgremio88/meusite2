<?php
		/**
 * Classe que representa a tabela "Cn_ce_investimentos" 
 */
class Cn_ce_investimentos
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
	private $id_custo;
	private $quantidade;
	
	
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
	// -- id_custo
	public function setId_custo($id_custo) {
		$this->id_custo = $id_custo;
	}
	public function getId_custo() {
		return $this->id_custo;
	}
	// -- quantidade
	public function setQuantidade($quantidade) {
		$this->quantidade = $quantidade;
	}
	public function getQuantidade() {
		return $this->quantidade;
	}
	
} 
	?>