<?php

require_once __DIR__ . '/../model/Producto.php';

class ProductoController {

    private Producto $productoModel;

    public function __construct() {
        $this->productoModel = new Producto();
    }

    // 🔹 Listar todos los productos
    public function listar() {
        return $this->productoModel->obtenerTodos();
    }

    // 🔹 Ver producto por ID
    public function ver(int $id) {
        return $this->productoModel->obtenerPorId($id);
    }

    // 🔹 Crear producto
    public function crear(array $datos) {
        return $this->productoModel->crear(
            $datos['nombre'],
            $datos['descripcion'],
            $datos['precio'],
            $datos['stock']
        );
    }

    // 🔹 Actualizar producto
    public function actualizar(int $id, array $datos) {
        return $this->productoModel->actualizar(
            $id,
            $datos['nombre'],
            $datos['descripcion'],
            $datos['precio'],
            $datos['stock']
        );
    }

    // 🔹 Eliminar producto
    public function eliminar(int $id) {
        return $this->productoModel->eliminar($id);
    }

    // 🔹 Reducir stock (ventas)
    public function reducirStock(int $id, int $cantidad) {
        return $this->productoModel->reducirStock($id, $cantidad);
    }

    // 🔹 Aumentar stock
    public function aumentarStock(int $id, int $cantidad) {
        return $this->productoModel->aumentarStock($id, $cantidad);
    }
}