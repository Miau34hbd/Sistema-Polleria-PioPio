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
    public function obtenerTodos() {
        $conexion = $this->db->getConexion();
        $resultado = $conexion->query("SELECT id_usuario, correo FROM usuarios");
    
        if ($resultado) {
            $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);
            error_log("Usuarios obtenidos: " . print_r($usuarios, true));
            return $usuarios;
        } else {
            error_log("Error en la consulta: " . $conexion->error);
            return [];
        }
    }
    // Eliminar un usuario por ID
    public function eliminarUsuario($id) {
        $conexion = $this->db->getConexion();
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>