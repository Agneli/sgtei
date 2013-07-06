<?php

class Database {

    private $host = "";
    private $user = "";
    private $password = "";
    private $database = "";
    private $connection = "";
    private $transaction = "";

    //método construtor________________________________________________________
    function __construct() {
        $this->host = "localhost";
        $this->user = "postgres";
        $this->password = "postgres";
        $this->database = "sgtei";
        $this->connection = NULL;
        $this->transaction = NULL;
    }

    //método que inicia conexao_________________________________________________
    protected function open() {
        try {
            $this->connection = new PDO("pgsql:
                dbname={$this->database};
                user={$this->user};
                password={$this->password};
                host={$this->host}");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
//            echo $e->getMessage();
        }
        return $this->connection;
    }

    //método que encerra a conexao
    protected function close() {
        $this->connection = null;
    }

    //método para abrir a transação_____________________________________________
    public function openTransaction() {
        $this->transaction = true;
    }

    //método para fechar a transação
    public function closeTransaction() {
        if ($this->transaction == true) {//caso a transaction seja true
            $this->connection->commit();
            self::close();
        }
    }

    //método que executa INSERT, UPDATE e DELETE________________________________
    public function cud($sql, $data = NULL) {
        if ($this->transaction == false or $this->connection == NULL) {
            self::open();
            if ($this->transaction == true) {//caso a transaction seja true
                $this->connection->beginTransaction(); //abrindo a transação 
            }
        }
        try {
            $query = $this->connection->prepare($sql);
            $query->execute($data);
            if ($this->transaction == false) {//caso a transação seja false
                self::close(); //fechando a conexão
            }
            return true;
        } catch (PDOException $e) {
            //echo htmlentities('Erro na execução do sql: ' . $e->getMessage());

            if ($this->transaction == true) {//caso a transação seja true
                $this->connection->rollBack();
                self::close(); //fechando a conexão
            }
            return false;
        }
    }

    //método que executa SELECT
    public function read($sql, $data = NULL) {
        if ($this->transaction == false or $this->connection == NULL) {
            self::open();
        }
        try {
            $query = $this->connection->prepare($sql);
            $query->execute($data);
            $list = $query->fetchAll(PDO::FETCH_CLASS);
            return $list;
        } catch (PDOException $e) {
//            echo htmlentities('Erro na execução do sql: ' . $e->getMessage());
            self::close(); //fechando a conexão
            return false;
        }
    }

}

?>