<?php
		/**
 * Classe que representa a tabela "Cn_evento_ficha_participante" 
 */
class Cn_evento_ficha_participante
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
	private $ficha_id;
	private $participante_id;
	private $nome;
	private $cpf;
	private $endereco;
	private $telefone;
	private $email;
	private $endereco_numero;
	private $endereco_complemento;
	private $bairro;
	private $municipio;
	private $estado;
	private $cep;
	
	
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
	// -- ficha_id
	public function setFicha_id($ficha_id) {
		$this->ficha_id = $ficha_id;
	}
	public function getFicha_id() {
		return $this->ficha_id;
	}
	// -- participante_id
	public function setParticipante_id($participante_id) {
		$this->participante_id = $participante_id;
	}
	public function getParticipante_id() {
		return $this->participante_id;
	}
	// -- nome
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	// -- cpf
	public function setCpf($cpf) {
		$this->cpf = $cpf;
	}
	public function getCpf() {
		return $this->cpf;
	}
	// -- endereco
	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}
	public function getEndereco() {
		return $this->endereco;
	}
	// -- telefone
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}
	public function getTelefone() {
		return $this->telefone;
	}
	// -- email
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return $this->email;
	}
	// -- endereco_numero
	public function setEndereco_numero($endereco_numero) {
		$this->endereco_numero = $endereco_numero;
	}
	public function getEndereco_numero() {
		return $this->endereco_numero;
	}
	// -- endereco_complemento
	public function setEndereco_complemento($endereco_complemento) {
		$this->endereco_complemento = $endereco_complemento;
	}
	public function getEndereco_complemento() {
		return $this->endereco_complemento;
	}
	// -- bairro
	public function setBairro($bairro) {
		$this->bairro = $bairro;
	}
	public function getBairro() {
		return $this->bairro;
	}
	// -- municipio
	public function setMunicipio($municipio) {
		$this->municipio = $municipio;
	}
	public function getMunicipio() {
		return $this->municipio;
	}
	// -- estado
	public function setEstado($estado) {
		$this->estado = $estado;
	}
	public function getEstado() {
		return $this->estado;
	}
	// -- cep
	public function setCep($cep) {
		$this->cep = $cep;
	}
	public function getCep() {
		return $this->cep;
	}
	
} 
	?>