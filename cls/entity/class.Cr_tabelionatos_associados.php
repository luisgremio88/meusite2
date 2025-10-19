<?php
		/**
 * Classe que representa a tabela "Cr_tabelionatos_associados" 
 */
class Cr_tabelionatos_associados
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
	private $bairro;
	private $codigo;
	private $email;
	private $endereco;
	private $horario_de_funcionamento;
	private $latitude;
	private $logradouro;
	private $longitude;
	private $municipio;
	private $numero;
	private $tabeliao;
	private $tabelionato;
	private $telefone;
	private $testamento_manual;
	
	
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
	// -- bairro
	public function setBairro($bairro) {
		$this->bairro = $bairro;
	}
	public function getBairro() {
		return $this->bairro;
	}
	// -- codigo
	public function setCodigo($codigo) {
		$this->codigo = $codigo;
	}
	public function getCodigo() {
		return $this->codigo;
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
	// -- horario_de_funcionamento
	public function setHorario_de_funcionamento($horario_de_funcionamento) {
		$this->horario_de_funcionamento = $horario_de_funcionamento;
	}
	public function getHorario_de_funcionamento() {
		return $this->horario_de_funcionamento;
	}
	// -- latitude
	public function setLatitude($latitude) {
		$this->latitude = $latitude;
	}
	public function getLatitude() {
		return $this->latitude;
	}
	// -- logradouro
	public function setLogradouro($logradouro) {
		$this->logradouro = $logradouro;
	}
	public function getLogradouro() {
		return $this->logradouro;
	}
	// -- longitude
	public function setLongitude($longitude) {
		$this->longitude = $longitude;
	}
	public function getLongitude() {
		return $this->longitude;
	}
	// -- municipio
	public function setMunicipio($municipio) {
		$this->municipio = $municipio;
	}
	public function getMunicipio() {
		return $this->municipio;
	}
	// -- numero
	public function setNumero($numero) {
		$this->numero = $numero;
	}
	public function getNumero() {
		return $this->numero;
	}
	// -- tabeliao
	public function setTabeliao($tabeliao) {
		$this->tabeliao = $tabeliao;
	}
	public function getTabeliao() {
		return $this->tabeliao;
	}
	// -- tabelionato
	public function setTabelionato($tabelionato) {
		$this->tabelionato = $tabelionato;
	}
	public function getTabelionato() {
		return $this->tabelionato;
	}
	// -- telefone
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}
	public function getTelefone() {
		return $this->telefone;
	}
	// -- testamento_manual
	public function setTestamento_manual($testamento_manual) {
		$this->testamento_manual = $testamento_manual;
	}
	public function getTestamento_manual() {
		return $this->testamento_manual;
	}
	
} 
	?>