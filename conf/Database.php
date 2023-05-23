<?php 

/*class Conexao {
    
    private static $connection;

    private function __construct(){}

    public static  function getConnection() {
        $pdoConfig  = DB_DRIVER  . ":". "Server=" . DB_HOST  . ";";
        $pdoConfig .= "Database=".DB_NAME.";";

        try{
            if(!isset($connection)){
                $connection =  new PDO($pdoConfig, DB_USER, DB_PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $connection;
        }catch (PDOException $e) {
            $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $mensagem .= "<br>Erro: " . $e->getMessage();
            throw new Exception($mensagem);
        }
    }
}*/


class Database extends PDO{
    
    
    /*private $DB_NAME = 'Integracao_Diploma_Abaris';
    private $DB_USER = 'lyceum';
    private $DB_PASSWORD = 'lyceum';
    private $DB_HOST = 'DATASERVER';
    private $DB_PORT = '';
    private $DB_DRIVER = 'sqlsrv';*/


    private $DB_NAME = 'Integracao_Diploma_Abaris';
    private $DB_USER = 'lyceum';
    private $DB_PASSWORD = 'lyceum';
    private $DB_HOST = 'DATASERVER';
    private $DB_PORT = '';
    private $DB_DRIVER = 'sqlsrv';

    /*define('DB_HOST'        , "DES03");
    define('DB_USER'        , "lyceum");
    define('DB_PASSWORD'    , "teste");
    define('DB_NAME'        , "Integracao_Diploma_Abaris");
    define('DB_DRIVER'      , "sqlsrv"); */

    private $con;

    public function __construct(){
        //parent::__construct("sqlsrv:Database=$this->DB_NAME; Server=$this->DB_HOST;");
        parent::__construct("sqlsrv:Database=$this->DB_NAME; Server=$this->DB_HOST", $this->DB_USER, $this->DB_PASSWORD);
        //parent::__construct("sqlsrv:Database=$this->DB_NAME; Server=$this->DB_HOST; DB_USER =$this->DB_USER; DB_PASSWORD=$this->DB_PASSWORD");

    }

    private function setParameters($stmt, $key, $value){
        $stmt->bindParam($key,$value);
    }


    private function mountQuery($stmt, $parameters){
        foreach($parameters as $key => $value){
            $this->setParameters($stmt, $key, $value);
        }
    }

    public function executeQuery(string $query, array $parameters = []){
        $stmt = $this->prepare($query);
        $this->mountQuery($stmt, $parameters);
        $stmt->execute();
        return $stmt;
    }
}