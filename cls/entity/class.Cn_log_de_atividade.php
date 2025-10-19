<?php
		/**
 * Classe que representa a tabela "Cn_log_de_atividade" 
 */
class Cn_log_de_atividade
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
	private $nome_usuario;
	private $ip;
	private $data_hora;
	private $descricao;
	
	
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
	// -- nome_usuario
	public function setNome_usuario($nome_usuario) {
		$this->nome_usuario = $nome_usuario;
	}
	public function getNome_usuario() {
		return $this->nome_usuario;
	}
	// -- ip
	public function setIp($ip) {
		$this->ip = $ip;
	}
	public function getIp() {
		return $this->ip;
	}
	// -- data_hora
	public function setData_hora($data_hora) {
		$this->data_hora = $data_hora;
	}
	public function getData_hora() {
		return $this->data_hora;
	}
	// -- descricao
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	
} 
	?>