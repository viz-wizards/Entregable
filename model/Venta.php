<?php

require_once __DIR__ . '/../config/Database.php';

class Venta {

    private PDO $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->conectar();
    }

    // 🔹 Registrar venta
    public function registrar(
        int $id_cliente,
        int $id_producto,
        int $cantidad,
        float $precio_unitario
    ) {

        $total = $cantidad * $precio_unitario;

        $sql = "INSERT INTO venta (
                    id_cliente,
                    id_producto,
                    cantidad,
                    precio_unitario,
                    total,
                    fecha_venta,
                    estado,
                    creado_en
                )
                VALUES (
                    :id_cliente,
                    :id_producto,
                    :cantidad,
                    :precio_unitario,
                    :total,
                    CURDATE(),
                    'Pagado',
                    NOW()
                )";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id_cliente' => $id_cliente,
            ':id_producto' => $id_producto,
            ':cantidad' => $cantidad,
            ':precio_unitario' => $precio_unitario,
            ':total' => $total
        ]);
    }

    // 🔹 Obtener todas las ventas
    public function obtenerTodas() {
        $sql = "SELECT * FROM venta ORDER BY id_venta DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Obtener por ID
    public function obtenerPorId(int $id_venta) {
        $sql = "SELECT * FROM venta WHERE id_venta = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_venta]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Eliminar venta
    public function eliminar(int $id_venta) {
        $sql = "DELETE FROM venta WHERE id_venta = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id_venta]);
    }

    // 🔹 Cambiar estado (Pagado / Cancelado)
    public function cambiarEstado(int $id_venta, string $estado) {
        $sql = "UPDATE venta SET estado = :estado WHERE id_venta = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':estado' => $estado,
            ':id' => $id_venta
        ]);
    }
}