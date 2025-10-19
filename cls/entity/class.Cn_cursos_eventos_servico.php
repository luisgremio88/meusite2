<?php
		/**
 * Classe que representa a tabela "Cn_cursos_eventos_servico" 
 */
class Cn_cursos_eventos_servico
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
	private $id_curso_evento;
	private $id_evento_servico;
	private $status;
	
	
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
	// -- id_curso_evento
	public function setId_curso_evento($id_curso_evento) {
		$this->id_curso_evento = $id_curso_evento;
	}
	public function getId_curso_evento() {
		return $this->id_curso_evento;
	}
	// -- id_evento_servico
	public function setId_evento_servico($id_evento_servico) {
		$this->id_evento_servico = $id_evento_servico;
	}
	public function getId_evento_servico() {
		return $this->id_evento_servico;
	}
	// -- status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	
} 
	?>