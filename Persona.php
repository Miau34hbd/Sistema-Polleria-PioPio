<?php
require_once __DIR__ . '/BaseDatos.php';

class Persona {
    private $db;

    public function __construct() {
        $this->db = new BaseDatos();
        $this->db->conectar();
    }

    public function registrarPersona($dni, $nombre, $apellido, $edad, $direccion, $telefono) {
        $conexion = $this->db->getConexion();
        $stmt = $conexion->prepare("INSERT INTO persona (dni, nombre, apellido, edad, direccion, telefono) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conexion->error));
        }
        $stmt->bind_param("sssiss", $dni, $nombre, $apellido, $edad, $direccion, $telefono);
        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }
    }
}
?>