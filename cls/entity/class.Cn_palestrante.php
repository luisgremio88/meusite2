<?php
		/**
 * Classe que representa a tabela "Cn_palestrante" 
 */
class Cn_palestrante
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

	private $palestranteid;
	private $nome;
	private $descricao;
	private $site;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- palestranteid
	public function setPalestranteid($palestranteid) {
		$this->palestranteid = $palestranteid;
	}
	public function getPalestranteid() {
		return $this->palestranteid;
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
	// -- site
	public function setSite($site) {
		$this->site = $site;
	}
	public function getSite() {
		return $this->site;
	}
	
} 
	?>