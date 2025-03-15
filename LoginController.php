<?php
require_once __DIR__ . '/../models/Usuario.php';

class LoginController {
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $correo = $_POST['correo'];
            $contraseña = $_POST['password'];

            $modeloUsuario = new Usuario();
            $usuarioEncontrado = $modeloUsuario->obtenerUsuarioPorCredenciales($correo, $contraseña);

            if ($usuarioEncontrado) {
                session_start();
                $_SESSION['usuario'] = $usuarioEncontrado['correo'];
                $_SESSION['rol'] = $usuarioEncontrado['rol'];

                switch ($usuarioEncontrado['rol']) {
                    case 'Administrador':
                        header("Location: /NuevaPolleria/admin");
                        exit();
                    case 'Cajero':
                        header("Location: /NuevaPolleria/cajero");
                        exit();
                    case 'Mesero':
                        header("Location: /NuevaPolleria/mesero");
                        exit();
                    case 'JefeCocina':
                        header("Location:/NuevaPolleria/jefe-cocina");
                        exit();
                    case 'EncargadoAlmacen':
                        header("Location: /NuevaPolleria/almacen");
                        exit();
                    case 'EncargadoInventario':
                        header("Location: /NuevaPolleria/inventario");
                        exit();
                    default:
                        header("Location: /NuevaPolleria/login?error=invalid_role");
                        exit();
                }
            } else {
                header("Location: /NuevaPolleria/login?error=wrong_credentials");
                exit();
            }
        }
    }
}
?>