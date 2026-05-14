<?php
require_once __DIR__ . '/../model/Cliente.php';

class ClienteController {
    private Cliente $clienteModel;

    public function __construct() {
        $this->clienteModel = new Cliente();
    }

    // 🔹 Listar todos los clientes
    public function listar() {
        return $this->clienteModel->obtenerTodos();
    }

    // 🔹 Ver cliente por ID
    public function ver(int $id_cliente) {
        return $this->clienteModel->obtenerPorId($id_cliente);
    }

   
    public function registrar(array $datos) {
        return $this->clienteModel->registrar(
            $datos['nombres'],
            $datos['apellidos'],
            $datos['telefono'],
            $datos['correo'] ?? '',
            $datos['direccion'] ?? ''
        );
    }

  
    public function actualizar(int $id_cliente, array $datos) {
        return $this->clienteModel->actualizar(
            $id_cliente,
            $datos['nombres'],
            $datos['apellidos'],
            $datos['telefono'],
            $datos['correo'] ?? '',
            $datos['direccion'] ?? '',
            $datos['estado'] ?? 'Activo'
        );
    }

    // 🔹 Desactivar cliente
    public function desactivar(int $id_cliente) {
        return $this->clienteModel->desactivar($id_cliente);
    }

    // 🔹 Eliminar cliente
    public function eliminar(int $id_cliente) {
        return $this->clienteModel->eliminar($id_cliente);
    }
}