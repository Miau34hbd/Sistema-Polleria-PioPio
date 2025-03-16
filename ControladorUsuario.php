<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Empleado.php';

class ControladorUsuario {
    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id_empleado']) && isset($_POST['correo']) && isset($_POST['contraseña'])) {
                $id_empleado = $_POST['id_empleado'];
                $correo = $_POST['correo'];
                $contraseña = $_POST['contraseña'];

                $usuario = new Usuario();
                $resultado = $usuario->registrarUsuario($id_empleado, $correo, $contraseña);

                if ($resultado) {
                    echo "Usuario registrado exitosamente.";
                } else {
                    echo "Error al registrar el usuario.";
                }
            } else {
                echo "Datos del formulario no recibidos correctamente.";
            }
        }
    }
}
?>