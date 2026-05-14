<?php

require_once __DIR__ . '/../model/Venta.php';
require_once __DIR__ . '/../model/Cliente.php';
require_once __DIR__ . '/../model/Producto.php';

class VentaController {

    private Venta $ventaModel;
    private Cliente $clienteModel;
    private Producto $productoModel;

    public function __construct() {
        $this->ventaModel = new Venta();
        $this->clienteModel = new Cliente();
        $this->productoModel = new Producto();
    }

    // 🔹 Registrar venta
    public function registrar(
        int $id_cliente,
        int $id_producto,
        int $cantidad,
        float $precio_unitario
    ) {

        // Reducir stock antes de registrar la venta
        $this->productoModel->reducirStock($id_producto, $cantidad);

        return $this->ventaModel->registrar(
            $id_cliente,
            $id_producto,
            $cantidad,
            $precio_unitario
        );
    }

    // 🔹 Listar todas las ventas
    public function listarTodas() {
        return $this->ventaModel->obtenerTodas();
    }

    // 🔹 Ver venta por ID
    public function ver(int $id_venta) {
        return $this->ventaModel->obtenerPorId($id_venta);
    }

    // 🔹 Eliminar venta
    public function eliminar(int $id_venta) {
        return $this->ventaModel->eliminar($id_venta);
    }

    // 🔹 Cambiar estado de venta
    public function cambiarEstado(int $id_venta, string $estado) {
        return $this->ventaModel->cambiarEstado($id_venta, $estado);
    }

    // 🔹 Listar clientes (para formulario)
    public function listarClientes() {
        return $this->clienteModel->obtenerTodos();
    }

    // 🔹 Listar productos (para formulario)
    public function listarProductos() {
        return $this->productoModel->obtenerTodos();
    }
}