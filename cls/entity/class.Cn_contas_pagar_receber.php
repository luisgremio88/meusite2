<?php
		/**
 * Classe que representa a tabela "Cn_contas_pagar_receber" 
 */
class Cn_contas_pagar_receber
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
	private $recebimento_tipo;
	private $recebimento_usuario;
	private $recebimento_cliente;
	private $recebimento_fornecedor;
	private $usuario_id;
	private $cliente_id;
	private $fornecedor_id;
	private $evento_id;
	private $numero_nota;
	private $status;
	private $nosso_numero;
	private $data_cadastro;
	private $data_vcto;
	private $valor;
	private $categoria;
	private $subcategoria;
	private $id_boleto;
	private $boleto_gerado;
	private $data_recebimento;
	private $id_conta;
	private $id_consulta;
	
	
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
	// -- recebimento_tipo
	public function setRecebimento_tipo($recebimento_tipo) {
		$this->recebimento_tipo = $recebimento_tipo;
	}
	public function getRecebimento_tipo() {
		return $this->recebimento_tipo;
	}
	// -- recebimento_usuario
	public function setRecebimento_usuario($recebimento_usuario) {
		$this->recebimento_usuario = $recebimento_usuario;
	}
	public function getRecebimento_usuario() {
		return $this->recebimento_usuario;
	}
	// -- recebimento_cliente
	public function setRecebimento_cliente($recebimento_cliente) {
		$this->recebimento_cliente = $recebimento_cliente;
	}
	public function getRecebimento_cliente() {
		return $this->recebimento_cliente;
	}
	// -- recebimento_fornecedor
	public function setRecebimento_fornecedor($recebimento_fornecedor) {
		$this->recebimento_fornecedor = $recebimento_fornecedor;
	}
	public function getRecebimento_fornecedor() {
		return $this->recebimento_fornecedor;
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
	// -- numero_nota
	public function setNumero_nota($numero_nota) {
		$this->numero_nota = $numero_nota;
	}
	public function getNumero_nota() {
		return $this->numero_nota;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- nosso_numero
	public function setNosso_numero($nosso_numero) {
		$this->nosso_numero = $nosso_numero;
	}
	public function getNosso_numero() {
		return $this->nosso_numero;
	}
	// -- data_cadastro
	public function setData_cadastro($data_cadastro) {
		$this->data_cadastro = $data_cadastro;
	}
	public function getData_cadastro() {
		return $this->data_cadastro;
	}
	// -- data_vcto
	public function setData_vcto($data_vcto) {
		$this->data_vcto = $data_vcto;
	}
	public function getData_vcto() {
		return $this->data_vcto;
	}
	// -- valor
	public function setValor($valor) {
		$this->valor = $valor;
	}
	public function getValor() {
		return $this->valor;
	}
	// -- categoria
	public function setCategoria($categoria) {
		$this->categoria = $categoria;
	}
	public function getCategoria() {
		return $this->categoria;
	}
	// -- subcategoria
	public function setSubcategoria($subcategoria) {
		$this->subcategoria = $subcategoria;
	}
	public function getSubcategoria() {
		return $this->subcategoria;
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
	// -- data_recebimento
	public function setData_recebimento($data_recebimento) {
		$this->data_recebimento = $data_recebimento;
	}
	public function getData_recebimento() {
		return $this->data_recebimento;
	}
	// -- id_conta
	public function setId_conta($id_conta) {
		$this->id_conta = $id_conta;
	}
	public function getId_conta() {
		return $this->id_conta;
	}
	// -- id_consulta
	public function setId_consulta($id_consulta) {
		$this->id_consulta = $id_consulta;
	}
	public function getId_consulta() {
		return $this->id_consulta;
	}
	
} 
	?>