<?php

require_once __DIR__ . '/../config/Database.php';

class Producto {

    private PDO $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->conectar();
    }

    // 🔹 Obtener todos los productos
    public function obtenerTodos() {
        $sql = "SELECT * FROM producto ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Obtener producto por ID
    public function obtenerPorId(int $id) {
        $sql = "SELECT * FROM producto WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Crear producto
    public function crear(string $nombre, string $descripcion, float $precio, int $stock) {

        $sql = "INSERT INTO producto (nombre, descripcion, precio, stock)
                VALUES (:nombre, :descripcion, :precio, :stock)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':precio' => $precio,
            ':stock' => $stock
        ]);
    }

    // 🔹 Actualizar producto
    public function actualizar(int $id, string $nombre, string $descripcion, float $precio, int $stock) {

        $sql = "UPDATE producto 
                SET nombre = :nombre,
                    descripcion = :descripcion,
                    precio = :precio,
                    stock = :stock
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':precio' => $precio,
            ':stock' => $stock
        ]);
    }

    // 🔹 Eliminar producto
    public function eliminar(int $id) {
        $sql = "DELETE FROM producto WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // 🔹 Reducir stock (cuando hay ventas)
    public function reducirStock(int $id, int $cantidad) {

        $sql = "UPDATE producto 
                SET stock = stock - :cantidad
                WHERE id = :id AND stock >= :cantidad";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':cantidad' => $cantidad
        ]);
    }

    // 🔹 Aumentar stock
    public function aumentarStock(int $id, int $cantidad) {

        $sql = "UPDATE producto 
                SET stock = stock + :cantidad
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':cantidad' => $cantidad
        ]);
    }
}