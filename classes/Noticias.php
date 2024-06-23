<?php
    class Noticias {

        private $conn;
        private $table_name="noticias"; // Nome da tabela

        public function __construct($db) {
            $this->conn=$db;
        }

        public function registrar($idusu, $data, $titulo, $noticia) {
            $query = "INSERT INTO ".$this->table_name." (idusu, data, titulo, noticia) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$idusu, $data, $titulo, $noticia]);
            return $stmt;
        }

        public function atualizar($idnot, $idusu, $data, $titulo, $noticia) {
            $query = "UPDATE ".$this->table_name." SET idusu=?,data=?,titulo=?,noticia=? WHERE idnot=?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$idusu, $data, $titulo, $noticia, $idnot]);
            return $stmt;
        }

        public function deletar($idnot){
            $query = "DELETE FROM ".$this->table_name." WHERE idnot=?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$idnot]);
            return $stmt;
        }

        public function ler(){
            $query = "SELECT * FROM ".$this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function lerPorIdNot($idnot){
            $query = "SELECT * FROM ".$this->table_name." WHERE idnot=?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$idnot]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function lerPorId($idusu){
            $query = "SELECT * FROM ".$this->table_name." WHERE idusu=?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$idusu]);
            return $stmt;
        }
        
    }
