<?php
require_once __DIR__ . '/../models/usuario/UsuarioDAO.php';

class Auth {
    public static function login($email, $senha) {
        $dao = new UsuarioDAO();
        $usuario = $dao->validarLogin($email, $senha);
        
        if ($usuario) {
            session_start();
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'email' => $usuario['email']
            ];
            return true;
        }
        return false;
    }

    public static function logout() {
        session_start();
        session_unset();
        session_destroy();
    }

    public static function verificar() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: /public/auth/login.php');
            exit();
        }
    }

    public static function getUsuarioId() {
        session_start();
        return $_SESSION['usuario']['id'] ?? null;
    }
}
?>