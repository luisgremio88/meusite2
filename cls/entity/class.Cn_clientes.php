<?php
		/**
 * Classe que representa a tabela "Cn_clientes" 
 */
class Cn_clientes
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

	private $clienteid;
	private $endereco;
	private $numero;
	private $complemento;
	private $bairro;
	private $cep;
	private $telefone;
	private $municipioid;
	private $usuarioinsertid;
	private $nome;
	private $cpf;
	private $email;
	private $datacriacao;
	private $servicobuscadados_servicobuscadadosid;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- clienteid
	public function setClienteid($clienteid) {
		$this->clienteid = $clienteid;
	}
	public function getClienteid() {
		return $this->clienteid;
	}
	// -- endereco
	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}
	public function getEndereco() {
		return $this->endereco;
	}
	// -- numero
	public function setNumero($numero) {
		$this->numero = $numero;
	}
	public function getNumero() {
		return $this->numero;
	}
	// -- complemento
	public function setComplemento($complemento) {
		$this->complemento = $complemento;
	}
	public function getComplemento() {
		return $this->complemento;
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
	// -- municipioid
	public function setMunicipioid($municipioid) {
		$this->municipioid = $municipioid;
	}
	public function getMunicipioid() {
		return $this->municipioid;
	}
	// -- usuarioinsertid
	public function setUsuarioinsertid($usuarioinsertid) {
		$this->usuarioinsertid = $usuarioinsertid;
	}
	public function getUsuarioinsertid() {
		return $this->usuarioinsertid;
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
	// -- email
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return $this->email;
	}
	// -- datacriacao
	public function setDatacriacao($datacriacao) {
		$this->datacriacao = $datacriacao;
	}
	public function getDatacriacao() {
		return $this->datacriacao;
	}
	// -- servicobuscadados_servicobuscadadosid
	public function setServicobuscadados_servicobuscadadosid($servicobuscadados_servicobuscadadosid) {
		$this->servicobuscadados_servicobuscadadosid = $servicobuscadados_servicobuscadadosid;
	}
	public function getServicobuscadados_servicobuscadadosid() {
		return $this->servicobuscadados_servicobuscadadosid;
	}
	
} 
	?>