<?php
		/**
 * Classe que representa a tabela "Cn_ce_inscricao" 
 */
class Cn_ce_inscricao
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
	private $id_curso_evento;
	private $data;
	private $cpf;
	private $nome;
	private $cep;
	private $estado;
	private $municipio;
	private $endereco;
	private $bairro;
	private $numero;
	private $email;
	private $telefone;
	private $serventia;
	private $responsavel;
	private $modelo_participacao;
	private $adicionais;
	private $status;
	private $total;
	
	
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
	// -- id_curso_evento
	public function setId_curso_evento($id_curso_evento) {
		$this->id_curso_evento = $id_curso_evento;
	}
	public function getId_curso_evento() {
		return $this->id_curso_evento;
	}
	// -- data
	public function setData($data) {
		$this->data = $data;
	}
	public function getData() {
		return $this->data;
	}
	// -- cpf
	public function setCpf($cpf) {
		$this->cpf = $cpf;
	}
	public function getCpf() {
		return $this->cpf;
	}
	// -- nome
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	// -- cep
	public function setCep($cep) {
		$this->cep = $cep;
	}
	public function getCep() {
		return $this->cep;
	}
	// -- estado
	public function setEstado($estado) {
		$this->estado = $estado;
	}
	public function getEstado() {
		return $this->estado;
	}
	// -- municipio
	public function setMunicipio($municipio) {
		$this->municipio = $municipio;
	}
	public function getMunicipio() {
		return $this->municipio;
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
	// -- numero
	public function setNumero($numero) {
		$this->numero = $numero;
	}
	public function getNumero() {
		return $this->numero;
	}
	// -- email
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return $this->email;
	}
	// -- telefone
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}
	public function getTelefone() {
		return $this->telefone;
	}
	// -- serventia
	public function setServentia($serventia) {
		$this->serventia = $serventia;
	}
	public function getServentia() {
		return $this->serventia;
	}
	// -- responsavel
	public function setResponsavel($responsavel) {
		$this->responsavel = $responsavel;
	}
	public function getResponsavel() {
		return $this->responsavel;
	}
	// -- modelo_participacao
	public function setModelo_participacao($modelo_participacao) {
		$this->modelo_participacao = $modelo_participacao;
	}
	public function getModelo_participacao() {
		return $this->modelo_participacao;
	}
	// -- adicionais
	public function setAdicionais($adicionais) {
		$this->adicionais = $adicionais;
	}
	public function getAdicionais() {
		return $this->adicionais;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- total
	public function setTotal($total) {
		$this->total = $total;
	}
	public function getTotal() {
		return $this->total;
	}
	
} 
	?>