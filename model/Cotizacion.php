<?php

require_once __DIR__ . '/../config/Database.php';

class Cotizacion {

    private PDO $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->conectar();
    }

    // 🔹 Registrar cotización
    public function registrar(
        int $id_cliente,
        int $id_producto,
        int $cantidad,
        string $observacion
    ) {

        $sql = "INSERT INTO cotizacion (
                    id_cliente,
                    id_producto,
                    cantidad,
                    observacion,
                    estado,
                    creado_en
                )
                VALUES (
                    :id_cliente,
                    :id_producto,
                    :cantidad,
                    :observacion,
                    'Pendiente',
                    NOW()
                )";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id_cliente' => $id_cliente,
            ':id_producto' => $id_producto,
            ':cantidad' => $cantidad,
            ':observacion' => $observacion
        ]);
    }

    // 🔹 Obtener todas las cotizaciones
    public function obtenerTodas() {
        $sql = "SELECT * FROM cotizacion ORDER BY id_cotizacion DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Obtener por ID
    public function obtenerPorId(int $id_cotizacion) {
        $sql = "SELECT * FROM cotizacion WHERE id_cotizacion = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_cotizacion]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Cambiar estado (Pendiente / Respondido / Rechazado)
    public function cambiarEstado(int $id_cotizacion, string $estado) {
        $sql = "UPDATE cotizacion 
                SET estado = :estado 
                WHERE id_cotizacion = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':estado' => $estado,
            ':id' => $id_cotizacion
        ]);
    }

    // 🔹 Eliminar cotización
    public function eliminar(int $id_cotizacion) {
        $sql = "DELETE FROM cotizacion WHERE id_cotizacion = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([':id' => $id_cotizacion]);
    }
}