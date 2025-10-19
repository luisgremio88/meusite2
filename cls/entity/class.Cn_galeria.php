<?php
		/**
 * Classe que representa a tabela "Cn_galeria" 
 */
class Cn_galeria
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

	private $galeriaid;
	private $titulo;
	private $descricao;
	private $data;
	private $datacriacao;
	private $usuario_usuarioid;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- galeriaid
	public function setGaleriaid($galeriaid) {
		$this->galeriaid = $galeriaid;
	}
	public function getGaleriaid() {
		return $this->galeriaid;
	}
	// -- titulo
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	// -- descricao
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	// -- data
	public function setData($data) {
		$this->data = $data;
	}
	public function getData() {
		return $this->data;
	}
	// -- datacriacao
	public function setDatacriacao($datacriacao) {
		$this->datacriacao = $datacriacao;
	}
	public function getDatacriacao() {
		return $this->datacriacao;
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