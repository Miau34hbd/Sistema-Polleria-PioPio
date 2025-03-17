<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Empleado.php';

class ControladorUsuario {
    public function registrar() {
        header('Content-Type: application/json'); // Establecer el tipo de contenido a JSON

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id_empleado']) && isset($_POST['correo']) && isset($_POST['contraseña'])) {
                $id_empleado = $_POST['id_empleado'];
                $correo = $_POST['correo'];
                $contraseña = $_POST['contraseña'];

                $empleado = new Empleado();
                $empleado_data = $empleado->obtenerEmpleadoPorId($id_empleado);
                $rol = $empleado_data['rol'];

                $usuario = new Usuario();
                $resultado = $usuario->registrarUsuario($id_empleado, $correo, $contraseña, $rol);

                if ($resultado) {
                    echo json_encode(['success' => true, 'message' => 'Usuario registrado exitosamente.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al registrar el usuario.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Datos del formulario no recibidos correctamente.']);
            }
        }
    }
    public function listarParaEliminar() {
        $usuario = new Usuario();
        $usuarios = $usuario->obtenerTodos();
    
        // Depuración
        echo "<!-- Depuración: ".print_r($usuarios, true)." -->";
        
        // Continuar con la vista
        include __DIR__ . '/../views/listarUsuariosEliminar.php';
    }
   
}
?>