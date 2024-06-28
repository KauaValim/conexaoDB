<?php
    class Usuario {

        private $conn;
        private $table_name="usuarios"; // Nome da tabela

        public function __construct($db) {
            $this->conn=$db;
        }

        public function registrar($nome, $sexo, $fone, $email, $senha, $adm, $foto) {
            $query = "INSERT INTO ".$this->table_name." (nome, sexo, fone, email, senha, adm, foto) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $hashed_password = password_hash($senha, PASSWORD_BCRYPT);
           
            // Processar a foto, se fornecida
            $foto_path = null;
            if ($foto && $foto['size'] > 0) {
                $target_dir = "static/uploads/profileImages/";
                date_default_timezone_set('America/Sao_Paulo');
                $target_file = $target_dir . rand(0,100000).date("_d-m-Y_H-i-s").".".basename($foto["type"]);
                move_uploaded_file($foto["tmp_name"], $target_file);
                $foto_path = $target_file;
            }

            $stmt->execute([$nome, $sexo, $fone, $email, $hashed_password, $adm, $foto_path]);
            return $stmt;
        }

        public function login($email, $senha) {
            $query = "SELECT * FROM ".$this->table_name." WHERE email=?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$email]);
            $usuario= $stmt->fetch(PDO::FETCH_ASSOC);
            if($usuario && password_verify($senha,$usuario["senha"])) {
                return $usuario;
            }
            return false;
        }

        public function atualizar($id, $nome, $sexo, $fone, $email, $adm, $foto) {
            $query = "UPDATE ".$this->table_name." SET nome=?,sexo=?,fone=?,email=?,adm=?,foto=? WHERE id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$nome, $sexo, $fone, $email, $adm, $foto, $id]);
            return $stmt;
        }

        public function deletar($id){
            $query = "DELETE FROM ".$this->table_name." WHERE id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
            return $stmt;
        }

        public function ler($search = '', $order_by = '') {
            $query = "SELECT * FROM usuarios";
            $conditions = [];
            $params = [];
            if ($search && $order_by === "") {
            $conditions[] = "(nome LIKE :search OR email LIKE :search)";
            $params[':search'] = '%' . $search . '%';
            } elseif ($search && $order_by === 'nome'){
            $query .= " WHERE (nome LIKE :search OR email LIKE :search) ORDER BY nome";
            $params[':search'] = '%' . $search . '%';
            } elseif ($search && $order_by === 'sexo'){
            $query .= " WHERE (nome LIKE :search OR email LIKE :search) ORDER BY sexo";
            $params[':search'] = '%' . $search . '%';
            } elseif ($order_by === 'nome') {
            $query .= " ORDER BY nome";
            } elseif ($order_by === 'sexo') {
            $query .= " ORDER BY sexo";
            }
            if (count($conditions) > 0) {
            $query .= " WHERE " . implode(' AND ', $conditions);
            }
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt;
        }

        public function lerPorId($id){
            $query = "SELECT * FROM ".$this->table_name." WHERE id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function gerarCodigoVerificacao($email) {
            $codigo = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 10);
            $query = "UPDATE " . $this->table_name . " SET codigo_verificacao=? WHERE email=?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$codigo, $email]);
            return ($stmt->rowCount() > 0) ? $codigo : false;
            }
        
        public function verificarCodigo($codigo) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE codigo_verificacao=?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$codigo]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function redefinirSenha($codigo, $senha) {
            $query = "UPDATE " . $this->table_name . " SET senha=?,codigo_verificacao=NULL WHERE codigo_verificacao=?";
            $stmt = $this->conn->prepare($query);
            $hashed_password = password_hash($senha, PASSWORD_BCRYPT);
            $stmt->execute([$hashed_password, $codigo]);
            return $stmt->rowCount() > 0;
        }
        
    }
