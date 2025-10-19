<?php
		/**
 * Classe que representa a tabela "Cn_conteudo" 
 */
class Cn_conteudo
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

	private $conteudoid;
	private $datacriacao;
	private $texto;
	private $tipo;
	private $discriminator;
	private $conteudousuarioid_usuarioid;
	private $usuario_usuarioid;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- conteudoid
	public function setConteudoid($conteudoid) {
		$this->conteudoid = $conteudoid;
	}
	public function getConteudoid() {
		return $this->conteudoid;
	}
	// -- datacriacao
	public function setDatacriacao($datacriacao) {
		$this->datacriacao = $datacriacao;
	}
	public function getDatacriacao() {
		return $this->datacriacao;
	}
	// -- texto
	public function setTexto($texto) {
		$this->texto = $texto;
	}
	public function getTexto() {
		return $this->texto;
	}
	// -- tipo
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}
	public function getTipo() {
		return $this->tipo;
	}
	// -- discriminator
	public function setDiscriminator($discriminator) {
		$this->discriminator = $discriminator;
	}
	public function getDiscriminator() {
		return $this->discriminator;
	}
	// -- conteudousuarioid_usuarioid
	public function setConteudousuarioid_usuarioid($conteudousuarioid_usuarioid) {
		$this->conteudousuarioid_usuarioid = $conteudousuarioid_usuarioid;
	}
	public function getConteudousuarioid_usuarioid() {
		return $this->conteudousuarioid_usuarioid;
	}
	// -- usuario_usuarioid
	public function setUsuario_usuarioid($usuario_usuarioid) {
		$this->usuario_usuarioid = $usuario_usuarioid;
	}
	public function getUsuario_usuarioid() {
		return $this->usuario_usuarioid;
	}
	
} 
	?>