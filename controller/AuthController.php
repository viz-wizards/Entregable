<?php
session_start();
require_once __DIR__ . '/../model/Usuario.php';

class AuthController {
    private Usuario $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    
    public function login(string $correo, string $clave): bool {
        $usuario = $this->usuarioModel->login($correo, $clave);

        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_rol'] = $usuario['rol'];
            return true;
        }

        return false;
    }

    
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }

    
    public static function estaLogueado(): bool {
        return isset($_SESSION['usuario_id']);
    }

    
    public static function esAdmin(): bool {
        return isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'Administrador';
    }
}