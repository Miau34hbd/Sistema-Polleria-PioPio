<?php
class InventarioController {
    public function index() {
        // session_start(); // Elimina esta línea
        if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'EncargadoInventario') {
            header("Location: /NuevaPolleria/login");
            exit();
        }
        require_once __DIR__ . '/../views/encargadoinventario.php';
    }
}
?>