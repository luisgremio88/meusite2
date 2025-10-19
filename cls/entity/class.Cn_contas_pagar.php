<?php
		/**
 * Classe que representa a tabela "Cn_contas_pagar" 
 */
class Cn_contas_pagar
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
	private $descricao;
	private $pagador_usuario;
	private $pagador_cliente;
	private $pagador_fornecedor;
	private $usuario_id;
	private $cliente_id;
	private $fornecedor_id;
	private $evento_id;
	private $status;
	private $categoria_despesa;
	private $despesa;
	private $data_vencimento;
	private $data_pagamento;
	private $valor;
	private $id_conta;
	
	
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
	// -- descricao
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	// -- pagador_usuario
	public function setPagador_usuario($pagador_usuario) {
		$this->pagador_usuario = $pagador_usuario;
	}
	public function getPagador_usuario() {
		return $this->pagador_usuario;
	}
	// -- pagador_cliente
	public function setPagador_cliente($pagador_cliente) {
		$this->pagador_cliente = $pagador_cliente;
	}
	public function getPagador_cliente() {
		return $this->pagador_cliente;
	}
	// -- pagador_fornecedor
	public function setPagador_fornecedor($pagador_fornecedor) {
		$this->pagador_fornecedor = $pagador_fornecedor;
	}
	public function getPagador_fornecedor() {
		return $this->pagador_fornecedor;
	}
	// -- usuario_id
	public function setUsuario_id($usuario_id) {
		$this->usuario_id = $usuario_id;
	}
	public function getUsuario_id() {
		return $this->usuario_id;
	}
	// -- cliente_id
	public function setCliente_id($cliente_id) {
		$this->cliente_id = $cliente_id;
	}
	public function getCliente_id() {
		return $this->cliente_id;
	}
	// -- fornecedor_id
	public function setFornecedor_id($fornecedor_id) {
		$this->fornecedor_id = $fornecedor_id;
	}
	public function getFornecedor_id() {
		return $this->fornecedor_id;
	}
	// -- evento_id
	public function setEvento_id($evento_id) {
		$this->evento_id = $evento_id;
	}
	public function getEvento_id() {
		return $this->evento_id;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- categoria_despesa
	public function setCategoria_despesa($categoria_despesa) {
		$this->categoria_despesa = $categoria_despesa;
	}
	public function getCategoria_despesa() {
		return $this->categoria_despesa;
	}
	// -- despesa
	public function setDespesa($despesa) {
		$this->despesa = $despesa;
	}
	public function getDespesa() {
		return $this->despesa;
	}
	// -- data_vencimento
	public function setData_vencimento($data_vencimento) {
		$this->data_vencimento = $data_vencimento;
	}
	public function getData_vencimento() {
		return $this->data_vencimento;
	}
	// -- data_pagamento
	public function setData_pagamento($data_pagamento) {
		$this->data_pagamento = $data_pagamento;
	}
	public function getData_pagamento() {
		return $this->data_pagamento;
	}
	// -- valor
	public function setValor($valor) {
		$this->valor = $valor;
	}
	public function getValor() {
		return $this->valor;
	}
	// -- id_conta
	public function setId_conta($id_conta) {
		$this->id_conta = $id_conta;
	}
	public function getId_conta() {
		return $this->id_conta;
	}
	
} 
	?>