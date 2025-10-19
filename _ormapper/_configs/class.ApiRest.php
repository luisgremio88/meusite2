<?php
/**
 * Comentários sobre a classe e etc, etc.
 * @author  ODIX.com.br
 * @version 1.0
 */

class ApiRest
{
    //definição das variáveis e constantes (propriedades)
    private $conn;
    private $body;
    private $head;
    private $curl;

    /**
     * metodo clone do tipo privado previne a clonagem dessa instância da classe
     */
    public function __clone()
    {
    }
	
    /**
     * metodo unserialize do tipo privado para prevenir a desserialização da instância dessa classe.
     */
    public function __wakeup()
    {
    }

    /**
     * fecha conexao quando classe deixa de ser utilizada
     */
    public function __destruct()
    {
    }

	/**
	 * metodo de retorno da instância caso ja exista. Caso nao exista cria uma nova.
	 */
	public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }
        return $instance;
    }	

    /**
     * metodos GET para os atributos da classe
     */
    public function getConn()
    {
        return $this->conn;
    }
    public function getBody()
    {
        return $this->body;
    }
    public function getHead()
    {
        return $this->head;
    }
    public function getCurl()
    {
        return $this->curl;
    }
	

    /**
     * metodo que inicializa variaveis (propriedades)
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->curl = curl_init($this->conn);

        //Comunicacao via https
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    }

    /**
     * metodo que ajusta os headers do envio
     */
    public function header($head) 
    {
        $this->head = $head;
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->head);
    }

    /**
     * metodos especificos de acesso 
     * post
     */
    public function post($body, $head) 
    {
        $this->body = $body;
        $this->head = $head;

        //Marca que vai enviar por POST (1=SIM)
        curl_setopt($this->curl, CURLOPT_POST, 1);
        
        //Passa o conteúdo para o campo de envio por POST
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->body);
        
        //Marca que vai receber string
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        //Headers
        $this->header($this->head);
        
        //executa e retorna o response
        $response = $this->exec();
        return $response;
    }

    /**
     * metodos especificos de acesso 
     * get
     */
    public function get($body, $head) 
    {
        $this->body = $body;
        $this->head = $head;

        //Marca que vai enviar por GET (1=SIM)
        curl_setopt($this->curl, CURLOPT_GET, 1);
        
        //Passa o conteúdo para o campo de envio por GET
        //curl_setopt($this->curl, CURLOPT_GETFIELDS, $this->body);
        
        //Marca que vai receber string
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        //Headers
        $this->header($head);

        //executa e retorna o response
        $response = $this->exec();
        return $response;
    }

    /**
     * metodo que executa o envio e retorna a resposta
     */
    public function exec() 
    {
        //executa a comunicacao
        $resposta = curl_exec($this->curl);
        
        //Fecha a conexao
        //curl_close($this->curl);

        return $resposta;
    }

    /**
     * metodo que exibe infos do objeto cURL
     */
    public function info()
    {
        $opt = 0;

        echo '<pre>'; 
        print_r( curl_getinfo($this->curl) );
        exit;
    }

}
?>