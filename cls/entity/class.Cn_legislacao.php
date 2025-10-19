<?php
		/**
 * Classe que representa a tabela "Cn_legislacao" 
 */
class Cn_legislacao
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

	private $legislacaoid;
	private $datalegislacao;
	private $tipoesfera;
	private $tipolegislacao;
	private $numero;
	private $site;
	private $resumo;
	private $texto;
	private $discriminator;
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	// -- legislacaoid
	public function setLegislacaoid($legislacaoid) {
		$this->legislacaoid = $legislacaoid;
	}
	public function getLegislacaoid() {
		return $this->legislacaoid;
	}
	// -- datalegislacao
	public function setDatalegislacao($datalegislacao) {
		$this->datalegislacao = $datalegislacao;
	}
	public function getDatalegislacao() {
		return $this->datalegislacao;
	}
	// -- tipoesfera
	public function setTipoesfera($tipoesfera) {
		$this->tipoesfera = $tipoesfera;
	}
	public function getTipoesfera() {
		return $this->tipoesfera;
	}
	// -- tipolegislacao
	public function setTipolegislacao($tipolegislacao) {
		$this->tipolegislacao = $tipolegislacao;
	}
	public function getTipolegislacao() {
		return $this->tipolegislacao;
	}
	// -- numero
	public function setNumero($numero) {
		$this->numero = $numero;
	}
	public function getNumero() {
		return $this->numero;
	}
	// -- site
	public function setSite($site) {
		$this->site = $site;
	}
	public function getSite() {
		return $this->site;
	}
	// -- resumo
	public function setResumo($resumo) {
		$this->resumo = $resumo;
	}
	public function getResumo() {
		return $this->resumo;
	}
	// -- texto
	public function setTexto($texto) {
		$this->texto = $texto;
	}
	public function getTexto() {
		return $this->texto;
	}
	// -- discriminator
	public function setDiscriminator($discriminator) {
		$this->discriminator = $discriminator;
	}
	public function getDiscriminator() {
		return $this->discriminator;
	}
	
} 
	?>