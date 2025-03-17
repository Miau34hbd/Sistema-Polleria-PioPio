<?php
require_once __DIR__ . '/BaseDatos.php';

class Mesa {
    private $db;

    public function __construct() {
        $this->db = new BaseDatos();
        $this->db->conectar();
    }

    public function obtenerTodas() {
        $conexion = $this->db->getConexion();
        $resultado = $conexion->query("SELECT * FROM mesa");
        if ($resultado) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function actualizarMesas($limite) {
        $conexion = $this->db->getConexion();
        $conexion->query("DELETE FROM mesa"); // Eliminar todas las mesas actuales

        for ($i = 1; $i <= $limite; $i++) {
            $stmt = $conexion->prepare("INSERT INTO mesa (numero_mesa) VALUES (?)");
            $stmt->bind_param("i", $i);
            $stmt->execute();
        }
        return true;
    }
}
?>