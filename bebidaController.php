<?php
// controllers/bebidaController.php

include('../models/BebidaModel.php');
include('../models/BaseDatos.php'); // Incluir la clase BaseDatos

class BebidaController {
    private $model;
    private $conexion;

    public function __construct() {
        // Crear una instancia de BaseDatos y conectar
        $baseDatos = new BaseDatos();
        $baseDatos->conectar();
        $this->conexion = $baseDatos->getConexion();

        // Pasar la conexión al modelo
        $this->model = new BebidaModel($this->conexion);
    }

    public function mostrarBebida() {
        $tipo_bebida = isset($_GET['tipo_bebida']) ? $_GET['tipo_bebida'] : '';
        $bebida = $this->model->obtenerBebida($tipo_bebida);

        // Verificar si la consulta devolvió resultados
        if ($bebida === false) {
            die("Error en la consulta: " . $this->model->getConexion()->error);
        }

        // La variable $bebida ya tiene los resultados de la consulta
        return $bebida;
    }
    
    // Método para obtener la conexión y poder cerrarla posteriormente
    public function getConexion() {
        return $this->conexion;
    }
}
?>