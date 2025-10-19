<?php
		/**
 * Classe que representa a tabela "Testamentohistorico" 
 */
class Testamentohistorico
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

	private $testamentohistoricoid;
	private $testamentotipoxml;
	private $nome;
	private $datanascimento;
	private $tipodocumento;
	private $documento;
	private $documentocomplemento;
	private $cpf;
	private $nomemae;
	private $nomepai;
	private $data;
	private $livro;
	private $livrocomplemento;
	private $folha;
	private $folhacomplemento;
	private $observacoes;
	private $revogacaocidade;
	private $revogacaouf;
	private $revogacaocartorio;
	private $revogacaolivro;
	private $revogacaolivrocomplemento;
	private $revogacaofolha;
	private $revogacaofolhacomplemento;
	private $revogacaodatatestamento;
	private $desconhecidooutros;
	private $numero;
	private $datacriacao;
	private $testamentoid;
	private $usuarioid;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- testamentohistoricoid
	public function setTestamentohistoricoid($testamentohistoricoid) {
		$this->testamentohistoricoid = $testamentohistoricoid;
	}
	public function getTestamentohistoricoid() {
		return $this->testamentohistoricoid;
	}
	// -- testamentotipoxml
	public function setTestamentotipoxml($testamentotipoxml) {
		$this->testamentotipoxml = $testamentotipoxml;
	}
	public function getTestamentotipoxml() {
		return $this->testamentotipoxml;
	}
	// -- nome
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	// -- datanascimento
	public function setDatanascimento($datanascimento) {
		$this->datanascimento = $datanascimento;
	}
	public function getDatanascimento() {
		return $this->datanascimento;
	}
	// -- tipodocumento
	public function setTipodocumento($tipodocumento) {
		$this->tipodocumento = $tipodocumento;
	}
	public function getTipodocumento() {
		return $this->tipodocumento;
	}
	// -- documento
	public function setDocumento($documento) {
		$this->documento = $documento;
	}
	public function getDocumento() {
		return $this->documento;
	}
	// -- documentocomplemento
	public function setDocumentocomplemento($documentocomplemento) {
		$this->documentocomplemento = $documentocomplemento;
	}
	public function getDocumentocomplemento() {
		return $this->documentocomplemento;
	}
	// -- cpf
	public function setCpf($cpf) {
		$this->cpf = $cpf;
	}
	public function getCpf() {
		return $this->cpf;
	}
	// -- nomemae
	public function setNomemae($nomemae) {
		$this->nomemae = $nomemae;
	}
	public function getNomemae() {
		return $this->nomemae;
	}
	// -- nomepai
	public function setNomepai($nomepai) {
		$this->nomepai = $nomepai;
	}
	public function getNomepai() {
		return $this->nomepai;
	}
	// -- data
	public function setData($data) {
		$this->data = $data;
	}
	public function getData() {
		return $this->data;
	}
	// -- livro
	public function setLivro($livro) {
		$this->livro = $livro;
	}
	public function getLivro() {
		return $this->livro;
	}
	// -- livrocomplemento
	public function setLivrocomplemento($livrocomplemento) {
		$this->livrocomplemento = $livrocomplemento;
	}
	public function getLivrocomplemento() {
		return $this->livrocomplemento;
	}
	// -- folha
	public function setFolha($folha) {
		$this->folha = $folha;
	}
	public function getFolha() {
		return $this->folha;
	}
	// -- folhacomplemento
	public function setFolhacomplemento($folhacomplemento) {
		$this->folhacomplemento = $folhacomplemento;
	}
	public function getFolhacomplemento() {
		return $this->folhacomplemento;
	}
	// -- observacoes
	public function setObservacoes($observacoes) {
		$this->observacoes = $observacoes;
	}
	public function getObservacoes() {
		return $this->observacoes;
	}
	// -- revogacaocidade
	public function setRevogacaocidade($revogacaocidade) {
		$this->revogacaocidade = $revogacaocidade;
	}
	public function getRevogacaocidade() {
		return $this->revogacaocidade;
	}
	// -- revogacaouf
	public function setRevogacaouf($revogacaouf) {
		$this->revogacaouf = $revogacaouf;
	}
	public function getRevogacaouf() {
		return $this->revogacaouf;
	}
	// -- revogacaocartorio
	public function setRevogacaocartorio($revogacaocartorio) {
		$this->revogacaocartorio = $revogacaocartorio;
	}
	public function getRevogacaocartorio() {
		return $this->revogacaocartorio;
	}
	// -- revogacaolivro
	public function setRevogacaolivro($revogacaolivro) {
		$this->revogacaolivro = $revogacaolivro;
	}
	public function getRevogacaolivro() {
		return $this->revogacaolivro;
	}
	// -- revogacaolivrocomplemento
	public function setRevogacaolivrocomplemento($revogacaolivrocomplemento) {
		$this->revogacaolivrocomplemento = $revogacaolivrocomplemento;
	}
	public function getRevogacaolivrocomplemento() {
		return $this->revogacaolivrocomplemento;
	}
	// -- revogacaofolha
	public function setRevogacaofolha($revogacaofolha) {
		$this->revogacaofolha = $revogacaofolha;
	}
	public function getRevogacaofolha() {
		return $this->revogacaofolha;
	}
	// -- revogacaofolhacomplemento
	public function setRevogacaofolhacomplemento($revogacaofolhacomplemento) {
		$this->revogacaofolhacomplemento = $revogacaofolhacomplemento;
	}
	public function getRevogacaofolhacomplemento() {
		return $this->revogacaofolhacomplemento;
	}
	// -- revogacaodatatestamento
	public function setRevogacaodatatestamento($revogacaodatatestamento) {
		$this->revogacaodatatestamento = $revogacaodatatestamento;
	}
	public function getRevogacaodatatestamento() {
		return $this->revogacaodatatestamento;
	}
	// -- desconhecidooutros
	public function setDesconhecidooutros($desconhecidooutros) {
		$this->desconhecidooutros = $desconhecidooutros;
	}
	public function getDesconhecidooutros() {
		return $this->desconhecidooutros;
	}
	// -- numero
	public function setNumero($numero) {
		$this->numero = $numero;
	}
	public function getNumero() {
		return $this->numero;
	}
	// -- datacriacao
	public function setDatacriacao($datacriacao) {
		$this->datacriacao = $datacriacao;
	}
	public function getDatacriacao() {
		return $this->datacriacao;
	}
	// -- testamentoid
	public function setTestamentoid($testamentoid) {
		$this->testamentoid = $testamentoid;
	}
	public function getTestamentoid() {
		return $this->testamentoid;
	}
	// -- usuarioid
	public function setUsuarioid($usuarioid) {
		$this->usuarioid = $usuarioid;
	}
	public function getUsuarioid() {
		return $this->usuarioid;
	}
	
} 
	?>