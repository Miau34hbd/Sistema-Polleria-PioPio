<?php
require_once __DIR__ . '/../models/Persona.php';
require_once __DIR__ . '/../models/Empleado.php';

class ControladorEmpleado {
    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dni = isset($_POST['dni']) ? $_POST['dni'] : '';
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
            $edad = isset($_POST['edad']) ? $_POST['edad'] : '';
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
            $rol = isset($_POST['rol']) ? $_POST['rol'] : '';

            if (empty($dni) || empty($nombre) || empty($apellido) || empty($edad) || empty($direccion) || empty($telefono) || empty($rol)) {
                die('Por favor complete todos los campos.');
            }

            $persona = new Persona();
            $id_persona = $persona->registrarPersona($dni, $nombre, $apellido, $edad, $direccion, $telefono);

            if ($id_persona) {
                $empleado = new Empleado();
                $resultado = $empleado->registrarEmpleado($id_persona, $rol);

                if ($resultado) {
                    echo "Empleado registrado exitosamente.";
                } else {
                    echo "Error al registrar el empleado.";
                }
            } else {
                echo "Error al registrar la persona.";
            }
        }
    }
}
?>