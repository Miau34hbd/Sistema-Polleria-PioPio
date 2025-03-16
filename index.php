<?php
session_start(); // Aquí se inicia la sesión

// Incluir los controladores
require_once __DIR__ . '/controllers/LoginController.php';
require_once __DIR__ . '/controllers/MeseroController.php';
require_once __DIR__ . '/controllers/CajeroController.php';
require_once __DIR__ . '/controllers/AdminController.php';
require_once __DIR__ . '/controllers/JefeCocinaController.php';
require_once __DIR__ . '/controllers/InventarioController.php';
require_once __DIR__ . '/controllers/AlmacenController.php';
require_once __DIR__ . '/controllers/LogoutController.php';
require_once __DIR__ . '/controllers/ControladorEmpleado.php';
require_once __DIR__ . '/controllers/ControladorUsuario.php';
require_once __DIR__ . '/controllers/ControladorMesa.php';

// Otros controladores

// Obtener la ruta solicitada
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Manejar las rutas
switch ($uri) {
    case '/NuevaPolleria/':
    case '/NuevaPolleria/login':
        $controller = new LoginController();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $controller->login();
        } else {
            require_once __DIR__ . '/views/login.php';
        }
        break;

    case '/NuevaPolleria/mesero':
        $controller = new MeseroController();
        $controller->index();
        break;

    case '/NuevaPolleria/cajero':
        $controller = new CajeroController();
        $controller->index();
        break;

    case '/NuevaPolleria/admin':
        $controller = new AdminController();
        $controller->index();
        break;

    case '/NuevaPolleria/almacen':
        $controller = new AlmacenController();
        $controller->index();
        break;

    case '/NuevaPolleria/inventario':
        $controller = new InventarioController();
        $controller->index();
        break;

    case '/NuevaPolleria/jefe-cocina':
        $controller = new JefeCocinaController();
        $controller->index();
        break;

    case '/NuevaPolleria/logout':
        $controller = new LogoutController();
        $controller->logout();
        break;

    case '/NuevaPolleria/registrarEmpleado':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $controller = new ControladorEmpleado();
            $controller->registrar();
        } else {
            require_once __DIR__ . '/views/registrarEmpleado.php';
        }
        break;

    case '/NuevaPolleria/registrarUsuario':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $controller = new ControladorUsuario();
            $controller->registrar();
        } else {
            require_once __DIR__ . '/views/registrarUsuario.php';
        }
        break;

    // Nueva ruta para listar usuarios
    case '/NuevaPolleria/listarUsuariosEliminar':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $controller = new ControladorUsuario();
            $controller->listarParaEliminar();
        } else {
            require_once __DIR__ . '../views/listarUsuariosEliminar.php';
        }
        break;

    // Nueva ruta para eliminar usuario
    case '/NuevaPolleria/eliminarUsuario':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $controller = new ControladorUsuario();
            $controller->eliminar();
        }
        break;

    // Nueva ruta para gestionar mesas
    case '/NuevaPolleria/gestionarMesas':
        $controller = new ControladorMesa();
        $controller->gestionar();
        break;

    // Nueva ruta para actualizar mesas
    case '/NuevaPolleria/actualizarMesas':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $controller = new ControladorMesa();
            $controller->actualizar();
        }
        break;

    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}
?>