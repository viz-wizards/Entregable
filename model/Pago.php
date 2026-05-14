<?php

require_once __DIR__ . '/../config/Database.php';

class Pago {

    private PDO $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->conectar();
    }

    // 🔹 Registrar pago
    public function registrar(
        int $id_venta,
        float $monto,
        string $metodo_pago,
        string $fecha_pago,
        string $observacion = ''
    ) {

        $sql = "INSERT INTO pago (
                    id_venta,
                    monto,
                    metodo_pago,
                    fecha_pago,
                    estado,
                    observacion,
                    creado_en
                )
                VALUES (
                    :id_venta,
                    :monto,
                    :metodo_pago,
                    :fecha_pago,
                    'Pagado',
                    :observacion,
                    NOW()
                )";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id_venta' => $id_venta,
            ':monto' => $monto,
            ':metodo_pago' => $metodo_pago,
            ':fecha_pago' => $fecha_pago,
            ':observacion' => $observacion
        ]);
    }

    // 🔹 Obtener todos los pagos
    public function obtenerTodos() {
        $sql = "SELECT * FROM pago ORDER BY id_pago DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Obtener pago por ID
    public function obtenerPorId(int $id_pago) {
        $sql = "SELECT * FROM pago WHERE id_pago = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_pago]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Obtener pagos por venta
    public function obtenerPorVenta(int $id_venta) {
        $sql = "SELECT * FROM pago WHERE id_venta = :id_venta";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_venta' => $id_venta]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Cambiar estado del pago
    public function cambiarEstado(int $id_pago, string $estado) {
        $sql = "UPDATE pago SET estado = :estado WHERE id_pago = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':estado' => $estado,
            ':id' => $id_pago
        ]);
    }

    // 🔹 Eliminar pago
    public function eliminar(int $id_pago) {
        $sql = "DELETE FROM pago WHERE id_pago = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([':id' => $id_pago]);
    }
}