<?php
    class Usuario {

        private $comm;
        private $table_name="usuarios"; // Nome da tabela

        public function __construct($db) {
            $this->comm=$db;
        }

        public function registrar($nome, $sexo, $fone, $email, $senha) {
            $query = "INSERT INTO ".$this->table_name."(nome, sexo, fone, email, senha) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->comm->prepare($query);
            $hashed_password=password_hash($senha, PASSWORD_BCRYPT);
            $stmt->execute([$nome,$sexo, $fone, $email, $hashed_password]);
            return $stmt;
        }

        public function login($email, $senha) {
            $query = "SELECT * FROM ".$this->table_name." WHERE email=?";
            $stmt = $this->comm->prepare($query);
            $stmt->execute([$email]);
            $usuario= $stmt->fetch(PDO::FETCH_ASSOC);
            if($usuario && password_verify($senha,$usuario["senha"])) {
                return $usuario;
            }
            return false;
        }

        public function atualizar($id, $nome, $sexo, $fone, $email) {
            $query = "UPDATE ".$this->table_name." SET nome=?,sexo=?,fone=?,email=? WHERE id=?";
            $stmt = $this->comm->prepare($query);
            $stmt->execute([$nome, $sexo, $fone, $email, $id]);
            return $stmt;
        }

        public function deletar($id){
            $query = "DELETE FROM ".$this->table_name." WHERE id=?";
            $stmt = $this->comm->prepare($query);
            $stmt->execute([$id]);
            return $stmt;
        }

        public function ler(){
            $query = "SELECT * FROM ".$this->table_name;
            $stmt = $this->comm->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function lerPorId($id){
            $query = "SELECT * FROM ".$this->table_name." WHERE id=?";
            $stmt = $this->comm->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
    }
