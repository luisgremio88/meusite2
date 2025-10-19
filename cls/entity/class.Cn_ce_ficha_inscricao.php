<?php
		/**
 * Classe que representa a tabela "Cn_ce_ficha_inscricao" 
 */
class Cn_ce_ficha_inscricao
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

	private $id_curso_evento;
	private $skynet;
	private $cpf;
	private $nome;
	private $cep;
	private $estado;
	private $municipio;
	private $endereco;
	private $bairro;
	private $numero;
	private $telefone;
	private $serventia;
	private $responsavel;
	private $participantes_adicionais;
	private $modelo_participacao;
	private $somente_socios;
	private $boleto;
	private $entidades;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- id_curso_evento
	public function setId_curso_evento($id_curso_evento) {
		$this->id_curso_evento = $id_curso_evento;
	}
	public function getId_curso_evento() {
		return $this->id_curso_evento;
	}
	// -- skynet
	public function setSkynet($skynet) {
		$this->skynet = $skynet;
	}
	public function getSkynet() {
		return $this->skynet;
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
	// -- participantes_adicionais
	public function setParticipantes_adicionais($participantes_adicionais) {
		$this->participantes_adicionais = $participantes_adicionais;
	}
	public function getParticipantes_adicionais() {
		return $this->participantes_adicionais;
	}
	// -- modelo_participacao
	public function setModelo_participacao($modelo_participacao) {
		$this->modelo_participacao = $modelo_participacao;
	}
	public function getModelo_participacao() {
		return $this->modelo_participacao;
	}
	// -- somente_socios
	public function setSomente_socios($somente_socios) {
		$this->somente_socios = $somente_socios;
	}
	public function getSomente_socios() {
		return $this->somente_socios;
	}
	// -- boleto
	public function setBoleto($boleto) {
		$this->boleto = $boleto;
	}
	public function getBoleto() {
		return $this->boleto;
	}
	// -- entidades
	public function setEntidades($entidades) {
		$this->entidades = $entidades;
	}
	public function getEntidades() {
		return $this->entidades;
	}
	
} 
	?>