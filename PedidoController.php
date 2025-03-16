<?php
// controllers/PedidoController.php

include('../models/PedidoModel.php');
include('../models/BaseDatos.php'); // Incluir la clase BaseDatos

class PedidoController {
    private $model;

    public function __construct() {
        // Crear una instancia de BaseDatos y conectar
        $baseDatos = new BaseDatos();
        $baseDatos->conectar();
        $conexion = $baseDatos->getConexion();

        // Pasar la conexión al modelo
        $this->model = new PedidoModel($conexion);
    }

    public function listarPedidos() {
        $pedidos = $this->model->obtenerPedidos();
        echo json_encode(['pedidos' => $pedidos]);
    }

    public function obtenerPedido($idPedido) {
        $pedido = $this->model->obtenerPedido($idPedido);
        $detalles = $this->model->obtenerDetallesPedido($idPedido);
        echo json_encode(['pedido' => $pedido, 'detalles' => $detalles]);
    }

    public function actualizarPedido($data) {
        // Obtener el pedido actual para mantener la mesa sin cambios
        $pedidoActual = $this->model->obtenerPedido($data['idPedido']);
        $data['mesa'] = $pedidoActual['id_mesa'];
    
        $resultado = $this->model->actualizarPedido($data);
        echo json_encode(['success' => $resultado]);
    }
    
    public function guardarPedido($data) {
        $mesa = $data['mesa'];
        $platos = $data['platos'];
        $bebidas = $data['bebidas'];

        // Depuración: Verificar los datos recibidos
        error_log("Datos recibidos para guardar pedido: Mesa: $mesa, Platos: " . print_r($platos, true) . ", Bebidas: " . print_r($bebidas, true));

        // Guardar pedido en la base de datos
        $resultado = $this->model->guardarPedido($mesa, $platos, $bebidas);

        // Verificar si se guardó exitosamente
        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al guardar en la base de datos']);
        }
    }

    public function anularPedido($idPedido) {
        $resultado = $this->model->anularPedido($idPedido);
        echo json_encode(['success' => $resultado]);
    }
}

// Manejar las solicitudes
$action = $_GET['action'] ?? '';
$controller = new PedidoController();

switch ($action) {
    case 'list':
        $controller->listarPedidos();
        break;
    case 'get':
        $idPedido = $_GET['id'] ?? 0;
        $controller->obtenerPedido($idPedido);
        break;
    case 'update':
        $data = $_POST;
        $controller->actualizarPedido($data);
        break;
    case 'save':
        $data = json_decode(file_get_contents('php://input'), true);
        $controller->guardarPedido($data);
        break;
    case 'anular':
        $idPedido = $_GET['id'] ?? 0;
        $controller->anularPedido($idPedido);
        break;
    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}
?>