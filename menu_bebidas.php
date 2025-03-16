<?php
include('../controllers/bebidaController.php');
$controller = new BebidaController();
$bebidas = $controller->mostrarBebida();
// Obtener la conexión del controlador para cerrarla más tarde
$conexion = $controller->getConexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de Bebidas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .icon-menu {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px 0;
        }

        .icon-menu a {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: black;
            text-decoration: none;
        }

        .icon-menu img {
            width: 60px;
            height: 60px;
            margin-bottom: 5px;
        }

        .bebida-card {
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 16px;
            text-align: center;
        }

        .bebida-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .bebida-card h2 {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .bebida-card p {
            font-size: 1.25rem;
            font-weight: bold;
            color: green;
            margin-bottom: 12px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function seleccionarBebida(id, nombre, precio) {
            // Obtener las bebidas seleccionadas del localStorage
            var bebidasSeleccionadas = localStorage.getItem('bebidasSeleccionadas');
            bebidasSeleccionadas = bebidasSeleccionadas ? JSON.parse(bebidasSeleccionadas) : [];
            
            // Agregar la nueva bebida seleccionada
            bebidasSeleccionadas.push({
                id: id,
                nombre: nombre, 
                precio: precio,
                cantidad: 1
            });
            
            // Guardar en localStorage
            localStorage.setItem('bebidasSeleccionadas', JSON.stringify(bebidasSeleccionadas));
            
            // Redirigir a la página de información del pedido
            window.location.href = 'segundocrear.php';
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center py-8">

    <header class="w-full bg-indigo-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-semibold">Carta de Bebidas</h1>
    </header>

    <main class="container mx-auto px-4 py-6">
        <!-- Iconos de tipos de bebida -->
        <div class="icon-menu">
            <a href="?tipo_bebida=" id="all">
                <img src="../icons/todos.png" alt="Todos">
                <span>TODOS</span>
            </a>
            <a href="?tipo_bebida=Café" id="Café">
                <img src="../icons/Café.png" alt="Café">
                <span>Café</span>
            </a>
            <a href="?tipo_bebida=Cerveza" id="Cerveza">
                <img src="../icons/Cerveza.png" alt="Cerveza">
                <span>Cerveza</span>
            </a>
            <a href="?tipo_bebida=Jugo" id="Jugo">
                <img src="../icons/Jugo.png" alt="Jugo">
                <span>Jugo</span>
            </a>
            <a href="?tipo_bebida=Refresco" id="Refresco">
                <img src="../icons/Refresco.png" alt="Refresco">
                <span>Refresco</span>
            </a>
            <a href="?tipo_bebida=Trago" id="Trago">
                <img src="../icons/Trago.png" alt="Trago">
                <span>Trago</span>
            </a>
        </div>

        <!-- Contenedor de bebidas dinámicos -->
        <section id="bebidas-container" class="bg-white p-6 rounded-lg shadow-lg">
            <div id="bebidas" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (isset($bebidas) && $bebidas->num_rows > 0) { ?>
                    <?php while ($fila = $bebidas->fetch_assoc()) { 
                        $imagen_ruta = "../imagenes/" . htmlspecialchars($fila['imagen']);
                    ?>
                        <div class="bebida-card">
                            <img src="<?php echo $imagen_ruta; ?>" alt="<?php echo htmlspecialchars($fila['Nombre']); ?>">
                            <h2 class="text-lg font-bold my-2"><?php echo htmlspecialchars($fila['Nombre']); ?></h2>
                            <p class="text-blue-600 font-semibold mb-4">S/ <?php echo htmlspecialchars($fila['precio']); ?></p>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg w-full" 
                                    onclick="seleccionarBebida('<?php echo htmlspecialchars($fila['id_bebida']); ?>', '<?php echo htmlspecialchars($fila['Nombre']); ?>', '<?php echo htmlspecialchars($fila['precio']); ?>')">
                                Seleccionar
                            </button>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p class="text-red-500 font-semibold col-span-3 text-center py-4">No se encontraron bebidas.</p>
                <?php } ?>
            </div>
        </section>

        <div class="mt-6 flex justify-between w-full max-w-sm mx-auto">
            <a href="crearpedido.php" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg">Volver</a>
            <a href="segundocrear.php" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">Ver Pedido</a>
        </div>
    </main>

    <footer class="bg-indigo-600 text-white p-4 mt-auto">
        <p class="text-center">Pollería &copy; 2024</p>
    </footer>

</body>
</html>

<?php
// Cerrar la conexión a la base de datos solo si existe
if (isset($conexion)) {
    mysqli_close($conexion);
}
?>