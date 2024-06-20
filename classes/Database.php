<?php
    class Database {
        private $host = "localhost";
        private $dbname = "bdcrud";
        private $username = "root";
        private $password = "";

        public $conn;
        public function getConnection() {
            $this->conn = null;
            try {
                $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->username,$this->password);
            } catch(PDOException $exception) {
                echo "Erro de conexão: ".$exception->getMessage();
            }
            return $this->conn;
        }
    }