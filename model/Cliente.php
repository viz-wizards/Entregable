<?php

require_once __DIR__ . '/../config/Database.php';

class Cliente {

    private PDO $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->conectar();
    }

    // 🔹 Obtener todos los clientes
    public function obtenerTodos() {
        $sql = "SELECT * FROM cliente ORDER BY id_cliente DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Obtener cliente por ID
    public function obtenerPorId(int $id_cliente) {
        $sql = "SELECT * FROM cliente WHERE id_cliente = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_cliente]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Registrar cliente
    public function registrar(
        string $nombres,
        string $apellidos,
        string $telefono,
        string $correo,
        string $direccion
    ) {

        $sql = "INSERT INTO cliente (
                    nombres,
                    apellidos,
                    telefono,
                    correo,
                    direccion,
                    estado,
                    creado_en
                )
                VALUES (
                    :nombres,
                    :apellidos,
                    :telefono,
                    :correo,
                    :direccion,
                    'Activo',
                    NOW()
                )";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nombres' => $nombres,
            ':apellidos' => $apellidos,
            ':telefono' => $telefono,
            ':correo' => $correo,
            ':direccion' => $direccion
        ]);
    }

    // 🔹 Actualizar cliente
    public function actualizar(
        int $id_cliente,
        string $nombres,
        string $apellidos,
        string $telefono,
        string $correo,
        string $direccion,
        string $estado
    ) {

        $sql = "UPDATE cliente SET
                    nombres = :nombres,
                    apellidos = :apellidos,
                    telefono = :telefono,
                    correo = :correo,
                    direccion = :direccion,
                    estado = :estado
                WHERE id_cliente = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id_cliente,
            ':nombres' => $nombres,
            ':apellidos' => $apellidos,
            ':telefono' => $telefono,
            ':correo' => $correo,
            ':direccion' => $direccion,
            ':estado' => $estado
        ]);
    }

    // 🔹 Desactivar cliente
    public function desactivar(int $id_cliente) {
        $sql = "UPDATE cliente SET estado = 'Inactivo' WHERE id_cliente = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([':id' => $id_cliente]);
    }

    // 🔹 Eliminar cliente
    public function eliminar(int $id_cliente) {
        $sql = "DELETE FROM cliente WHERE id_cliente = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([':id' => $id_cliente]);
    }
}