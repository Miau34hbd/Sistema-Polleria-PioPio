<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function registrarUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $rol = $_POST['rol'];

            if ($this->usuarioModel->registrarUsuario($nombre, $correo, $rol)) {
                header("Location: /NuevaPolleria/listaUsuarios?action=usuarioRegistrado");
                exit();
            } else {
                $error = "Error al registrar el usuario.";
                require __DIR__ . '/../views/error.php';
            }
        } else {
            require __DIR__ . '/../views/registrarUsuario.php';
        }
    }

    public function listaUsuarios() {
        $usuarios = $this->usuarioModel->obtenerUsuarios();
        require __DIR__ . '/../views/listaUsuarios.php';
    }
}
?>