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

    public function registrarUsuario($id_empleado, $correo, $contraseña, $rol) {
        $conexion = $this->db->getConexion();
        $stmt = $conexion->prepare("INSERT INTO usuarios (id_empleado, correo, contraseña, rol) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id_empleado, $correo, $contraseña, $rol);
        return $stmt->execute();
    }

    public function obtenerUsuarios() {
        $conexion = $this->db->getConexion();
        $result = $conexion->query("SELECT u.id_usuario, e.id_empleado, p.nombre, p.apellido, u.correo, e.rol FROM usuarios u JOIN empleados e ON u.id_empleado = e.id_empleado JOIN persona p ON e.id_persona = p.id_persona");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Método para obtener todos los usuarios
    public function obtenerTodos() {
        $conexion = $this->db->getConexion();
        $resultado = $conexion->query("SELECT * FROM usuarios");
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Método para eliminar usuario
    public function eliminarUsuario($id) {
        $conexion = $this->db->getConexion();
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>