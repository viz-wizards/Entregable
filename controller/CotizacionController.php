<?php
// Controller/CotizacionController.php

require_once __DIR__ . '/../model/Cotizacion.php';
require_once __DIR__ . '/../model/Cliente.php';
require_once __DIR__ . '/../model/Producto.php';

class CotizacionController {

    private Cotizacion $cotizacionModel;
    private Cliente $clienteModel;
    private Producto $productoModel;

    public function __construct() {
        $this->cotizacionModel = new Cotizacion();
        $this->clienteModel = new Cliente();
        $this->productoModel = new Producto();
    }

    // 🔹 Registrar nueva cotización
    public function registrar(int $id_cliente, int $id_producto, int $cantidad, string $observacion) {
        return $this->cotizacionModel->registrar($id_cliente, $id_producto, $cantidad, $observacion);
    }

    // 🔹 Obtener todas las cotizaciones
    public function listarTodas() {
        return $this->cotizacionModel->obtenerTodas();
    }

    // 🔹 Obtener cotización por ID
    public function obtener(int $id_cotizacion) {
        return $this->cotizacionModel->obtenerPorId($id_cotizacion);
    }

    // 🔹 Cambiar estado de una cotización
    public function cambiarEstado(int $id_cotizacion, string $estado) {
        return $this->cotizacionModel->cambiarEstado($id_cotizacion, $estado);
    }

    // 🔹 Eliminar cotización
    public function eliminar(int $id_cotizacion) {
        return $this->cotizacionModel->eliminar($id_cotizacion);
    }

    // 🔹 Listar clientes (para formularios de selección)
    public function listarClientes() {
        return $this->clienteModel->obtenerTodos();
    }

    // 🔹 Listar productos (para formularios de selección)
    public function listarProductos() {
        return $this->productoModel->obtenerTodos();
    }
}