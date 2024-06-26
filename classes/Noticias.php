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

        public function ler($search = '', $order_by = '') {
            $query = "SELECT * FROM noticias";
            $conditions = [];
            $params = [];
            if ($search && $order_by === "") {
            $conditions[] = "(titulo LIKE :search OR noticia LIKE :search)";
            $params[':search'] = '%' . $search . '%';
            } elseif ($search && $order_by === 'nome'){
            $query .= " WHERE (titulo LIKE :search OR noticia LIKE :search) ORDER BY nome";
            $params[':search'] = '%' . $search . '%';
            } elseif ($order_by === 'nome') {
            $query .= " ORDER BY nome";
            }
            if (count($conditions) > 0) {
            $query .= " WHERE " . implode(' AND ', $conditions);
            }
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
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
