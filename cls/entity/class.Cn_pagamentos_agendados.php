<?php
		/**
 * Classe que representa a tabela "Cn_pagamentos_agendados" 
 */
class Cn_pagamentos_agendados
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
	private $conta_bancaria_origem;
	private $prazo_indeterminado;
	private $quant_vezes;
	private $dia_vencimento;
	private $dia_pagamento;
	
	
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
	// -- conta_bancaria_origem
	public function setConta_bancaria_origem($conta_bancaria_origem) {
		$this->conta_bancaria_origem = $conta_bancaria_origem;
	}
	public function getConta_bancaria_origem() {
		return $this->conta_bancaria_origem;
	}
	// -- prazo_indeterminado
	public function setPrazo_indeterminado($prazo_indeterminado) {
		$this->prazo_indeterminado = $prazo_indeterminado;
	}
	public function getPrazo_indeterminado() {
		return $this->prazo_indeterminado;
	}
	// -- quant_vezes
	public function setQuant_vezes($quant_vezes) {
		$this->quant_vezes = $quant_vezes;
	}
	public function getQuant_vezes() {
		return $this->quant_vezes;
	}
	// -- dia_vencimento
	public function setDia_vencimento($dia_vencimento) {
		$this->dia_vencimento = $dia_vencimento;
	}
	public function getDia_vencimento() {
		return $this->dia_vencimento;
	}
	// -- dia_pagamento
	public function setDia_pagamento($dia_pagamento) {
		$this->dia_pagamento = $dia_pagamento;
	}
	public function getDia_pagamento() {
		return $this->dia_pagamento;
	}
	
} 
	?>