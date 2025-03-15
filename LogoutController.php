<?php
class LogoutController {
    public function logout() {
        session_start(); // Iniciar la sesión si no está iniciada
        session_unset(); // Eliminar todas las variables de sesión
        session_destroy(); // Destruir la sesión
        header("Location: /NuevaPolleria/login"); // Redirigir al login
        exit();
    }
}
?>