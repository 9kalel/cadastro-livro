<?php
require_once __DIR__ . '/../usuario/Usuario.php';
require_once __DIR__ . '/../../config/Database.php';

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function buscarPorEmail($email) {
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function validarLogin($email, $senha) {
        $usuario = $this->buscarPorEmail($email);
        if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
            return $usuario;
        }
        return null;
    }

    public function cadastrarUsuario($email, $senha) {
        if ($this->buscarPorEmail($email)) {
            return false;
        }

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuarios (email, senha_hash) VALUES (:email, :senha_hash)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha_hash', $senha_hash);

        return $stmt->execute();
    }
}
?>