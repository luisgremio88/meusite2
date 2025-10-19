<?php
		/**
 * Classe que representa a tabela "Cn_paginas_acesso" 
 */
class Cn_paginas_acesso
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
	private $id_usuario;
	private $id_pagina;
	private $nome_pagina;
	private $visualizar;
	private $cadastrar;
	private $editar;
	private $excluir;
	
	
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
	// -- id_usuario
	public function setId_usuario($id_usuario) {
		$this->id_usuario = $id_usuario;
	}
	public function getId_usuario() {
		return $this->id_usuario;
	}
	// -- id_pagina
	public function setId_pagina($id_pagina) {
		$this->id_pagina = $id_pagina;
	}
	public function getId_pagina() {
		return $this->id_pagina;
	}
	// -- nome_pagina
	public function setNome_pagina($nome_pagina) {
		$this->nome_pagina = $nome_pagina;
	}
	public function getNome_pagina() {
		return $this->nome_pagina;
	}
	// -- visualizar
	public function setVisualizar($visualizar) {
		$this->visualizar = $visualizar;
	}
	public function getVisualizar() {
		return $this->visualizar;
	}
	// -- cadastrar
	public function setCadastrar($cadastrar) {
		$this->cadastrar = $cadastrar;
	}
	public function getCadastrar() {
		return $this->cadastrar;
	}
	// -- editar
	public function setEditar($editar) {
		$this->editar = $editar;
	}
	public function getEditar() {
		return $this->editar;
	}
	// -- excluir
	public function setExcluir($excluir) {
		$this->excluir = $excluir;
	}
	public function getExcluir() {
		return $this->excluir;
	}
	
} 
	?>