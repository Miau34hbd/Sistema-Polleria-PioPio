<?php
require_once __DIR__ . '/BaseDatos.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = new BaseDatos();
        $this->db->conectar();
    }

    public function obtenerUsuarioPorCredenciales($correo, $contraseña) {
        $conexion = $this->db->getConexion();
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ? AND contraseña = ?");
        $stmt->bind_param("ss", $correo, $contraseña);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function registrarUsuario($nombre, $correo, $rol) {
        $conexion = $this->db->getConexion();
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, rol) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $correo, $rol);
        return $stmt->execute();
    }

    public function obtenerUsuarios() {
        $conexion = $this->db->getConexion();
        $result = $conexion->query("SELECT * FROM usuarios");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>