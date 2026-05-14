<?php

require_once __DIR__ . '/../config/Database.php';

class Usuario {

    private PDO $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->conectar();
    }

    // 🔹 Obtener todos los usuarios
    public function obtenerTodos() {
        $sql = "SELECT * FROM usuario";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Obtener usuario por ID
    public function obtenerPorId(int $id) {
        $sql = "SELECT * FROM usuario WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Obtener usuario por correo (login)
    public function obtenerPorCorreo(string $correo) {
        $sql = "SELECT * FROM usuario 
                WHERE correo = :correo 
                AND estado = 'Activo'
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':correo' => $correo]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Login
    public function login(string $correo, string $clave) {

        $usuario = $this->obtenerPorCorreo($correo);

        if ($usuario && password_verify($clave, $usuario['clave'])) {
            return $usuario;
        }

        return false;
    }

    // 🔹 Crear usuario
    public function crear(string $nombre, string $correo, string $clave, string $rol = 'Usuario') {

        $sql = "INSERT INTO usuario (nombre, correo, clave, rol, estado)
                VALUES (:nombre, :correo, :clave, :rol, 'Activo')";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':clave' => password_hash($clave, PASSWORD_DEFAULT),
            ':rol' => $rol
        ]);
    }

    // 🔹 Actualizar usuario
    public function actualizar(int $id, string $nombre, string $correo, string $rol) {

        $sql = "UPDATE usuario 
                SET nombre = :nombre,
                    correo = :correo,
                    rol = :rol
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':rol' => $rol
        ]);
    }

    // 🔹 Eliminar usuario
    public function eliminar(int $id) {
        $sql = "DELETE FROM usuario WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // 🔹 Desactivar usuario (mejor que borrar)
    public function desactivar(int $id) {
        $sql = "UPDATE usuario SET estado = 'Inactivo' WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}