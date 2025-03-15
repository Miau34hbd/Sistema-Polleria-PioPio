<?php
// controllers/PlatoController.php

include('../models/PlatoModel.php');
include('../models/BaseDatos.php'); // Incluir la clase BaseDatos

class PlatoController {
    private $model;

    public function __construct() {
        // Crear una instancia de BaseDatos y conectar
        $baseDatos = new BaseDatos();
        $baseDatos->conectar();
        $conexion = $baseDatos->getConexion();

        // Pasar la conexión al modelo
        $this->model = new PlatoModel($conexion);
    }

    public function mostrarPlatos() {
        $tipo_plato = isset($_GET['tipo_plato']) ? $_GET['tipo_plato'] : '';
        $platos = $this->model->obtenerPlatos($tipo_plato);

        // Verificar si la consulta devolvió resultados
        if ($platos === false) {
            die("Error en la consulta: " . $this->model->getConexion()->error);
        }

        // Incluir la vista y pasar los datos
     // La variable $platos ya tiene los resultados de la consulta
            return $platos;
    }
}

?>