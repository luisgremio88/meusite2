<?php
		/**
 * Classe que representa a tabela "Cn_testamentos__bk_20241016" 
 */
class Cn_testamentos__bk_20241016
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
	private $id_tabelionato;
	private $tipo_testamento;
	private $data_testamento;
	private $cpf;
	private $nome;
	private $data_nascimento;
	private $nome_mae;
	private $nome_pai;
	private $numero_ato;
	private $livro;
	private $livro_complemento;
	private $folha;
	private $folha_complemento;
	private $observacoes;
	
	
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
	// -- id_tabelionato
	public function setId_tabelionato($id_tabelionato) {
		$this->id_tabelionato = $id_tabelionato;
	}
	public function getId_tabelionato() {
		return $this->id_tabelionato;
	}
	// -- tipo_testamento
	public function setTipo_testamento($tipo_testamento) {
		$this->tipo_testamento = $tipo_testamento;
	}
	public function getTipo_testamento() {
		return $this->tipo_testamento;
	}
	// -- data_testamento
	public function setData_testamento($data_testamento) {
		$this->data_testamento = $data_testamento;
	}
	public function getData_testamento() {
		return $this->data_testamento;
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
	// -- data_nascimento
	public function setData_nascimento($data_nascimento) {
		$this->data_nascimento = $data_nascimento;
	}
	public function getData_nascimento() {
		return $this->data_nascimento;
	}
	// -- nome_mae
	public function setNome_mae($nome_mae) {
		$this->nome_mae = $nome_mae;
	}
	public function getNome_mae() {
		return $this->nome_mae;
	}
	// -- nome_pai
	public function setNome_pai($nome_pai) {
		$this->nome_pai = $nome_pai;
	}
	public function getNome_pai() {
		return $this->nome_pai;
	}
	// -- numero_ato
	public function setNumero_ato($numero_ato) {
		$this->numero_ato = $numero_ato;
	}
	public function getNumero_ato() {
		return $this->numero_ato;
	}
	// -- livro
	public function setLivro($livro) {
		$this->livro = $livro;
	}
	public function getLivro() {
		return $this->livro;
	}
	// -- livro_complemento
	public function setLivro_complemento($livro_complemento) {
		$this->livro_complemento = $livro_complemento;
	}
	public function getLivro_complemento() {
		return $this->livro_complemento;
	}
	// -- folha
	public function setFolha($folha) {
		$this->folha = $folha;
	}
	public function getFolha() {
		return $this->folha;
	}
	// -- folha_complemento
	public function setFolha_complemento($folha_complemento) {
		$this->folha_complemento = $folha_complemento;
	}
	public function getFolha_complemento() {
		return $this->folha_complemento;
	}
	// -- observacoes
	public function setObservacoes($observacoes) {
		$this->observacoes = $observacoes;
	}
	public function getObservacoes() {
		return $this->observacoes;
	}
	
} 
	?>