<?php
		/**
 * Classe que representa a tabela "Cn_boleto_unicred" 
 */
class Cn_boleto_unicred
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
	private $chave_boleto;
	private $data;
	private $msg_resposta;
	
	
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
	// -- chave_boleto
	public function setChave_boleto($chave_boleto) {
		$this->chave_boleto = $chave_boleto;
	}
	public function getChave_boleto() {
		return $this->chave_boleto;
	}
	// -- data
	public function setData($data) {
		$this->data = $data;
	}
	public function getData() {
		return $this->data;
	}
	// -- msg_resposta
	public function setMsg_resposta($msg_resposta) {
		$this->msg_resposta = $msg_resposta;
	}
	public function getMsg_resposta() {
		return $this->msg_resposta;
	}
	
} 
	?>