<?php
class MeseroController {
    public function index() {
        // session_start(); // Elimina esta línea
        if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Mesero') {
            header("Location: /NuevaPolleria/login");
            exit();
        }
        require_once __DIR__ . '/../views/mesero.php';
    }
}
?>