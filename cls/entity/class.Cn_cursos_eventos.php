<?php
		/**
 * Classe que representa a tabela "Cn_cursos_eventos" 
 */
class Cn_cursos_eventos
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
	private $titulo;
	private $texto;
	private $anexo;
	private $status;
	private $data_ini;
	private $data_fim;
	private $prazo_inscricao;
	private $valor_colaborador;
	private $valor_demais;
	private $valor_titular;
	private $link_noticia;
	private $tipo;
	private $publico;
	
	
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
	// -- titulo
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	// -- texto
	public function setTexto($texto) {
		$this->texto = $texto;
	}
	public function getTexto() {
		return $this->texto;
	}
	// -- anexo
	public function setAnexo($anexo) {
		$this->anexo = $anexo;
	}
	public function getAnexo() {
		return $this->anexo;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	// -- data_ini
	public function setData_ini($data_ini) {
		$this->data_ini = $data_ini;
	}
	public function getData_ini() {
		return $this->data_ini;
	}
	// -- data_fim
	public function setData_fim($data_fim) {
		$this->data_fim = $data_fim;
	}
	public function getData_fim() {
		return $this->data_fim;
	}
	// -- prazo_inscricao
	public function setPrazo_inscricao($prazo_inscricao) {
		$this->prazo_inscricao = $prazo_inscricao;
	}
	public function getPrazo_inscricao() {
		return $this->prazo_inscricao;
	}
	// -- valor_colaborador
	public function setValor_colaborador($valor_colaborador) {
		$this->valor_colaborador = $valor_colaborador;
	}
	public function getValor_colaborador() {
		return $this->valor_colaborador;
	}
	// -- valor_demais
	public function setValor_demais($valor_demais) {
		$this->valor_demais = $valor_demais;
	}
	public function getValor_demais() {
		return $this->valor_demais;
	}
	// -- valor_titular
	public function setValor_titular($valor_titular) {
		$this->valor_titular = $valor_titular;
	}
	public function getValor_titular() {
		return $this->valor_titular;
	}
	// -- link_noticia
	public function setLink_noticia($link_noticia) {
		$this->link_noticia = $link_noticia;
	}
	public function getLink_noticia() {
		return $this->link_noticia;
	}
	// -- tipo
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}
	public function getTipo() {
		return $this->tipo;
	}
	// -- publico
	public function setPublico($publico) {
		$this->publico = $publico;
	}
	public function getPublico() {
		return $this->publico;
	}
	
} 
	?>