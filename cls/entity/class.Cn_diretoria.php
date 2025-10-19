<?php
		/**
 * Classe que representa a tabela "Cn_diretoria" 
 */
class Cn_diretoria
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

	private $diretorid;
	private $nome;
	private $profissao;
	private $cartorio;
	private $email;
	private $endereco;
	private $bairro;
	private $cep;
	private $telefone;
	private $cargoid;
	private $mandatoid;
	private $municipioid;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- diretorid
	public function setDiretorid($diretorid) {
		$this->diretorid = $diretorid;
	}
	public function getDiretorid() {
		return $this->diretorid;
	}
	// -- nome
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	// -- profissao
	public function setProfissao($profissao) {
		$this->profissao = $profissao;
	}
	public function getProfissao() {
		return $this->profissao;
	}
	// -- cartorio
	public function setCartorio($cartorio) {
		$this->cartorio = $cartorio;
	}
	public function getCartorio() {
		return $this->cartorio;
	}
	// -- email
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return $this->email;
	}
	// -- endereco
	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}
	public function getEndereco() {
		return $this->endereco;
	}
	// -- bairro
	public function setBairro($bairro) {
		$this->bairro = $bairro;
	}
	public function getBairro() {
		return $this->bairro;
	}
	// -- cep
	public function setCep($cep) {
		$this->cep = $cep;
	}
	public function getCep() {
		return $this->cep;
	}
	// -- telefone
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}
	public function getTelefone() {
		return $this->telefone;
	}
	// -- cargoid
	public function setCargoid($cargoid) {
		$this->cargoid = $cargoid;
	}
	public function getCargoid() {
		return $this->cargoid;
	}
	// -- mandatoid
	public function setMandatoid($mandatoid) {
		$this->mandatoid = $mandatoid;
	}
	public function getMandatoid() {
		return $this->mandatoid;
	}
	// -- municipioid
	public function setMunicipioid($municipioid) {
		$this->municipioid = $municipioid;
	}
	public function getMunicipioid() {
		return $this->municipioid;
	}
	
} 
	?>