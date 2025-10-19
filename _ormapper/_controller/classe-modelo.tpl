/**
 * Classe que representa a tabela "{tab}" 
 */
class {tab}
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

	<!-- START BLOCK : atributos -->
	private ${col};
	<!-- END BLOCK : atributos -->
	
	
	/**
	 * metodos para obter e ajustar dados das variaveis (get e set)
	 */
	
	<!-- START BLOCK : metodos -->
	// -- {col}
	public function set{col2}(${col}) {
		$this->{col} = ${col};
	}
	public function get{col2}() {
		return $this->{col};
	}
	<!-- END BLOCK : metodos -->
	
}