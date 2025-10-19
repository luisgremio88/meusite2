<?php
		/**
 * Classe que representa a tabela "Cn_galeria_fotos" 
 */
class Cn_galeria_fotos
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
	private $anexo;
	private $id_galeria_fotos_evento;
	
	
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
	// -- anexo
	public function setAnexo($anexo) {
		$this->anexo = $anexo;
	}
	public function getAnexo() {
		return $this->anexo;
	}
	// -- id_galeria_fotos_evento
	public function setId_galeria_fotos_evento($id_galeria_fotos_evento) {
		$this->id_galeria_fotos_evento = $id_galeria_fotos_evento;
	}
	public function getId_galeria_fotos_evento() {
		return $this->id_galeria_fotos_evento;
	}
	
} 
	?>