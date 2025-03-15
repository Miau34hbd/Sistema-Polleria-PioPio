<?php
// controllers/PedidoEdicionController.php

include('../models/PedidoModel.php');
include('../models/BaseDatos.php'); // Incluir la clase BaseDatos

class PedidoEdicionController {
    private $model;

    public function __construct() {
        // Crear una instancia de BaseDatos y conectar
        $baseDatos = new BaseDatos();
        $baseDatos->conectar();
        $conexion = $baseDatos->getConexion();

        // Pasar la conexión al modelo
        $this->model = new PedidoModel($conexion);
    }

    public function obtenerPedido($idPedido) {
        $pedido = $this->model->obtenerPedido($idPedido);
        $detalles = $this->model->obtenerDetallesPedido($idPedido);
        echo json_encode(['pedido' => $pedido, 'detalles' => $detalles]);
    }

    public function actualizarPedido($data) {
        $resultado = $this->model->actualizarPedido($data);
        echo json_encode(['success' => $resultado]);
    }

    public function agregarProducto($idPedido, $producto) {
        // Lógica para agregar un producto a un pedido existente
        // Similar a la lógica de guardarPedido, pero solo para agregar productos
    }

    public function eliminarProducto($idDetalle) {
        // Lógica para eliminar un producto del pedido
    }
}

// Manejar las solicitudes
$action = $_GET['action'] ?? '';
$controller = new PedidoEdicionController();

switch ($action) {
    case 'get':
        $idPedido = $_GET['id'] ?? 0;
        $controller->obtenerPedido($idPedido);
        break;
    case 'update':
        $data = $_POST;
        $controller->actualizarPedido($data);
        break;
    case 'add_product':
        $idPedido = $_POST['idPedido'];
        $producto = $_POST['producto'];
        $controller->agregarProducto($idPedido, $producto);
        break;
    case 'delete_product':
        $idDetalle = $_POST['idDetalle'];
        $controller->eliminarProducto($idDetalle);
        break;
    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}
?>