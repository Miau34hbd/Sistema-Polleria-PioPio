<?php
session_start(); // Aquí se inicia la sesión

// Incluir los controladores
require_once __DIR__ . '/controllers/LoginController.php';
require_once __DIR__ . '/controllers/MeseroController.php';
require_once __DIR__ . '/controllers/cajeroController.php';
require_once __DIR__ . '/controllers/adminController.php';
require_once __DIR__ . '/controllers/jefeCocinaController.php';
require_once __DIR__ . '/controllers/inventarioController.php';
require_once __DIR__ . '/controllers/almacenController.php';
require_once __DIR__ . '/controllers/LogoutController.php';

// (otros controladores)

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
                    $controller = new adminController();
                    $controller->index();
                    break;

                case '/NuevaPolleria/almacen':
                    $controller = new almacenController();
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

                            case '/NuevaPolleria/logout': // Ruta para el cierre de sesión
                                $controller = new LogoutController();
                                $controller->logout();
                                break;
                        

     
 
    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}
?>

