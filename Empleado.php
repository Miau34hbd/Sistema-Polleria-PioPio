<?php
require_once __DIR__ . '/BaseDatos.php';

class Empleado {
    private $db;

    public function __construct() {
        $this->db = new BaseDatos();
        $this->db->conectar();
    }

    public function registrarEmpleado($id_persona, $rol) {
        $conexion = $this->db->getConexion();
        $fecha_contratacion = date('Y-m-d'); // Obtener la fecha actual

        $stmt = $conexion->prepare("INSERT INTO empleados (id_persona, fecha_contratacion, rol) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conexion->error));
        }
        $stmt->bind_param("iss", $id_persona, $fecha_contratacion, $rol);
        if ($stmt->execute()) {
            return true;
        } else {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }
    }

    public function obtenerEmpleados() {
        $conexion = $this->db->getConexion();
        $result = $conexion->query("SELECT e.id_empleado, p.dni, p.nombre, p.apellido, p.edad, p.direccion, p.telefono, e.fecha_contratacion, e.rol, 
                                    (SELECT COUNT(*) FROM usuarios u WHERE u.id_empleado = e.id_empleado) as tiene_credenciales 
                                    FROM empleados e JOIN persona p ON e.id_persona = p.id_persona");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerEmpleadoPorId($id_empleado) {
        $conexion = $this->db->getConexion();
        $stmt = $conexion->prepare("SELECT * FROM empleados WHERE id_empleado = ?");
        $stmt->bind_param("i", $id_empleado);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
}
?>