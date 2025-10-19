<?php
		/**
 * Classe que representa a tabela "Cn_busca_testamentos" 
 */
class Cn_busca_testamentos
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
	private $data;
	private $id_cliente;
	private $id_tabelionato;
	private $nome;
	private $cpf;
	private $falecido;
	private $data_falecimento;
	private $livro;
	private $folha;
	private $numero;
	private $status;
	private $pagamento;
	private $tipo_certidao;
	private $link_recibo;
	private $link_certidao;
	private $observacoes;
	private $id_boleto;
	private $boleto_gerado;
	private $id_testamento;
	private $qtd_testamento;
	private $reconsulta;
	private $id_busca_anterior;
	private $responsabilizo;
	
	
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
	// -- data
	public function setData($data) {
		$this->data = $data;
	}
	public function getData() {
		return $this->data;
	}
	// -- id_cliente
	public function setId_cliente($id_cliente) {
		$this->id_cliente = $id_cliente;
	}
	public function getId_cliente() {
		return $this->id_cliente;
	}
	// -- id_tabelionato
	public function setId_tabelionato($id_tabelionato) {
		$this->id_tabelionato = $id_tabelionato;
	}
	public function getId_tabelionato() {
		return $this->id_tabelionato;
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
	// -- falecido
	public function setFalecido($falecido) {
		$this->falecido = $falecido;
	}
	public function getFalecido() {
		return $this->falecido;
	}
	// -- data_falecimento
	public function setData_falecimento($data_falecimento) {
		$this->data_falecimento = $data_falecimento;
	}
	public function getData_falecimento() {
		return $this->data_falecimento;
	}
	// -- livro
	public function setLivro($livro) {
		$this->livro = $livro;
	}
	public function getLivro() {
		return $this->livro;
	}
	// -- folha
	public function setFolha($folha) {
		$this->folha = $folha;
	}
	public function getFolha() {
		return $this->folha;
	}
	// -- numero
	public function setNumero($numero) {
		$this->numero = $numero;
	}
	public function getNumero() {
		return $this->numero;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- pagamento
	public function setPagamento($pagamento) {
		$this->pagamento = $pagamento;
	}
	public function getPagamento() {
		return $this->pagamento;
	}
	// -- tipo_certidao
	public function setTipo_certidao($tipo_certidao) {
		$this->tipo_certidao = $tipo_certidao;
	}
	public function getTipo_certidao() {
		return $this->tipo_certidao;
	}
	// -- link_recibo
	public function setLink_recibo($link_recibo) {
		$this->link_recibo = $link_recibo;
	}
	public function getLink_recibo() {
		return $this->link_recibo;
	}
	// -- link_certidao
	public function setLink_certidao($link_certidao) {
		$this->link_certidao = $link_certidao;
	}
	public function getLink_certidao() {
		return $this->link_certidao;
	}
	// -- observacoes
	public function setObservacoes($observacoes) {
		$this->observacoes = $observacoes;
	}
	public function getObservacoes() {
		return $this->observacoes;
	}
	// -- id_boleto
	public function setId_boleto($id_boleto) {
		$this->id_boleto = $id_boleto;
	}
	public function getId_boleto() {
		return $this->id_boleto;
	}
	// -- boleto_gerado
	public function setBoleto_gerado($boleto_gerado) {
		$this->boleto_gerado = $boleto_gerado;
	}
	public function getBoleto_gerado() {
		return $this->boleto_gerado;
	}
	// -- id_testamento
	public function setId_testamento($id_testamento) {
		$this->id_testamento = $id_testamento;
	}
	public function getId_testamento() {
		return $this->id_testamento;
	}
	// -- qtd_testamento
	public function setQtd_testamento($qtd_testamento) {
		$this->qtd_testamento = $qtd_testamento;
	}
	public function getQtd_testamento() {
		return $this->qtd_testamento;
	}
	// -- reconsulta
	public function setReconsulta($reconsulta) {
		$this->reconsulta = $reconsulta;
	}
	public function getReconsulta() {
		return $this->reconsulta;
	}
	// -- id_busca_anterior
	public function setId_busca_anterior($id_busca_anterior) {
		$this->id_busca_anterior = $id_busca_anterior;
	}
	public function getId_busca_anterior() {
		return $this->id_busca_anterior;
	}
	// -- responsabilizo
	public function setResponsabilizo($responsabilizo) {
		$this->responsabilizo = $responsabilizo;
	}
	public function getResponsabilizo() {
		return $this->responsabilizo;
	}
	
} 
	?>