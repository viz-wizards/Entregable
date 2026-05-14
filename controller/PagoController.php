<?php

require_once __DIR__ . '/../model/Pago.php';
require_once __DIR__ . '/../model/Venta.php';

class PagoController {

    private Pago $pagoModel;
    private Venta $ventaModel;

    public function __construct() {
        $this->pagoModel = new Pago();
        $this->ventaModel = new Venta();
    }

    // 🔹 Registrar pago
    public function registrar(
        int $id_venta,
        float $monto,
        string $metodo_pago,
        string $fecha_pago,
        string $observacion = ''
    ) {
        return $this->pagoModel->registrar(
            $id_venta,
            $monto,
            $metodo_pago,
            $fecha_pago,
            $observacion
        );
    }

    // 🔹 Obtener todos los pagos
    public function listarTodos() {
        return $this->pagoModel->obtenerTodos();
    }

    // 🔹 Obtener pago por ID
    public function obtener(int $id_pago) {
        return $this->pagoModel->obtenerPorId($id_pago);
    }

    // 🔹 Obtener pagos por venta
    public function porVenta(int $id_venta) {
        return $this->pagoModel->obtenerPorVenta($id_venta);
    }

    // 🔹 Cambiar estado del pago
    public function cambiarEstado(int $id_pago, string $estado) {
        return $this->pagoModel->cambiarEstado($id_pago, $estado);
    }

    // 🔹 Eliminar pago
    public function eliminar(int $id_pago) {
        return $this->pagoModel->eliminar($id_pago);
    }

    // 🔹 Listar ventas (para seleccionar en formulario)
    public function listarVentas() {
        return $this->ventaModel->obtenerTodas();
    }
}