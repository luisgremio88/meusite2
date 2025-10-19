<?php
		/**
 * Classe que representa a tabela "Cn_usuarios_associados_bk" 
 */
class Cn_usuarios_associados_bk
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
	private $nome;
	private $funcao;
	private $data_nascimento;
	private $cpf;
	private $rg;
	private $data_expedicao;
	private $orgao_expedicao;
	private $estado_civil;
	private $email;
	private $pagina_web;
	private $nome_oficial_servico;
	private $nome_substituto;
	private $cep;
	private $endereco;
	private $numero;
	private $complemento;
	private $bairro;
	private $cidade;
	private $uf;
	private $telefone;
	private $fax;
	private $entrancia;
	private $ip_registro;
	private $data_hora_registro;
	private $senha;
	private $status;
	private $status_associado;
	private $tabelionatovinculadoid;
	private $tipo;
	
	
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
	// -- nome
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	// -- funcao
	public function setFuncao($funcao) {
		$this->funcao = $funcao;
	}
	public function getFuncao() {
		return $this->funcao;
	}
	// -- data_nascimento
	public function setData_nascimento($data_nascimento) {
		$this->data_nascimento = $data_nascimento;
	}
	public function getData_nascimento() {
		return $this->data_nascimento;
	}
	// -- cpf
	public function setCpf($cpf) {
		$this->cpf = $cpf;
	}
	public function getCpf() {
		return $this->cpf;
	}
	// -- rg
	public function setRg($rg) {
		$this->rg = $rg;
	}
	public function getRg() {
		return $this->rg;
	}
	// -- data_expedicao
	public function setData_expedicao($data_expedicao) {
		$this->data_expedicao = $data_expedicao;
	}
	public function getData_expedicao() {
		return $this->data_expedicao;
	}
	// -- orgao_expedicao
	public function setOrgao_expedicao($orgao_expedicao) {
		$this->orgao_expedicao = $orgao_expedicao;
	}
	public function getOrgao_expedicao() {
		return $this->orgao_expedicao;
	}
	// -- estado_civil
	public function setEstado_civil($estado_civil) {
		$this->estado_civil = $estado_civil;
	}
	public function getEstado_civil() {
		return $this->estado_civil;
	}
	// -- email
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return $this->email;
	}
	// -- pagina_web
	public function setPagina_web($pagina_web) {
		$this->pagina_web = $pagina_web;
	}
	public function getPagina_web() {
		return $this->pagina_web;
	}
	// -- nome_oficial_servico
	public function setNome_oficial_servico($nome_oficial_servico) {
		$this->nome_oficial_servico = $nome_oficial_servico;
	}
	public function getNome_oficial_servico() {
		return $this->nome_oficial_servico;
	}
	// -- nome_substituto
	public function setNome_substituto($nome_substituto) {
		$this->nome_substituto = $nome_substituto;
	}
	public function getNome_substituto() {
		return $this->nome_substituto;
	}
	// -- cep
	public function setCep($cep) {
		$this->cep = $cep;
	}
	public function getCep() {
		return $this->cep;
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
	// -- cidade
	public function setCidade($cidade) {
		$this->cidade = $cidade;
	}
	public function getCidade() {
		return $this->cidade;
	}
	// -- uf
	public function setUf($uf) {
		$this->uf = $uf;
	}
	public function getUf() {
		return $this->uf;
	}
	// -- telefone
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}
	public function getTelefone() {
		return $this->telefone;
	}
	// -- fax
	public function setFax($fax) {
		$this->fax = $fax;
	}
	public function getFax() {
		return $this->fax;
	}
	// -- entrancia
	public function setEntrancia($entrancia) {
		$this->entrancia = $entrancia;
	}
	public function getEntrancia() {
		return $this->entrancia;
	}
	// -- ip_registro
	public function setIp_registro($ip_registro) {
		$this->ip_registro = $ip_registro;
	}
	public function getIp_registro() {
		return $this->ip_registro;
	}
	// -- data_hora_registro
	public function setData_hora_registro($data_hora_registro) {
		$this->data_hora_registro = $data_hora_registro;
	}
	public function getData_hora_registro() {
		return $this->data_hora_registro;
	}
	// -- senha
	public function setSenha($senha) {
		$this->senha = $senha;
	}
	public function getSenha() {
		return $this->senha;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- status_associado
	public function setStatus_associado($status_associado) {
		$this->status_associado = $status_associado;
	}
	public function getStatus_associado() {
		return $this->status_associado;
	}
	// -- tabelionatovinculadoid
	public function setTabelionatovinculadoid($tabelionatovinculadoid) {
		$this->tabelionatovinculadoid = $tabelionatovinculadoid;
	}
	public function getTabelionatovinculadoid() {
		return $this->tabelionatovinculadoid;
	}
	// -- tipo
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}
	public function getTipo() {
		return $this->tipo;
	}
	
} 
	?>