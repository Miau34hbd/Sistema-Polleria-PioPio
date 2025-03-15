<?php
class AdminController {
    public function index() {
        // session_start(); // Elimina esta línea
        if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Administrador') {
            header("Location: /NuevaPolleria/login");
            exit();
        }
        require_once __DIR__ . '/../views/administrador.php';
    }
}
?>