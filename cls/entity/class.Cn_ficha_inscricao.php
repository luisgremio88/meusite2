<?php
		/**
 * Classe que representa a tabela "Cn_ficha_inscricao" 
 */
class Cn_ficha_inscricao
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
	private $nome_campo;
	private $tipo_campo;
	private $descricao_campo;
	private $id_curso_evento;
	
	
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
	// -- nome_campo
	public function setNome_campo($nome_campo) {
		$this->nome_campo = $nome_campo;
	}
	public function getNome_campo() {
		return $this->nome_campo;
	}
	// -- tipo_campo
	public function setTipo_campo($tipo_campo) {
		$this->tipo_campo = $tipo_campo;
	}
	public function getTipo_campo() {
		return $this->tipo_campo;
	}
	// -- descricao_campo
	public function setDescricao_campo($descricao_campo) {
		$this->descricao_campo = $descricao_campo;
	}
	public function getDescricao_campo() {
		return $this->descricao_campo;
	}
	// -- id_curso_evento
	public function setId_curso_evento($id_curso_evento) {
		$this->id_curso_evento = $id_curso_evento;
	}
	public function getId_curso_evento() {
		return $this->id_curso_evento;
	}
	
} 
	?>