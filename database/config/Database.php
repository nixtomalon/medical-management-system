<?php

class Database {
    private $servername = "localhost";
    private $dbname = "medicaldb";   
    private $username = "postgres";
    private $password = "norman";
    private $conn;

    public function Connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO('pgsql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }
}

?>