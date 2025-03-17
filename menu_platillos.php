<?php
include('../controllers/PlatoController.php');
$controller = new PlatoController();
$platos = $controller->mostrarPlatos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de Platillos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .icon-menu {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .icon-menu a {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #0C080D;
            transition: transform 0.2s;
        }
        
        .icon-menu a:hover {
            transform: scale(1.1);
        }
        
        .icon-menu img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 5px;
        }
        
        .icon-menu span {
            font-size: 12px;
            font-weight: bold;
        }
        
        .plato-card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.2s;
            background-color: #F2B705;
            color: #0C080D;
        }
        
        .plato-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .plato-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 12px;
        }
        
        .bg-primary {
            background-color: #D97904;
        }

        .text-secondary {
            color: #A64F03;
        }

        .btn-primary {
            background-color: #D97904;
            color: white;
        }

        .btn-secondary {
            background-color: #A64F03;
            color: white;
        }
    </style>
    <script>
        function seleccionarPlato(id, nombre, precio) {
            // Obtener los platos seleccionados del localStorage
            var platosSeleccionados = localStorage.getItem('platosSeleccionados');
            platosSeleccionados = platosSeleccionados ? JSON.parse(platosSeleccionados) : [];
            
            // Agregar el nuevo plato seleccionado
            platosSeleccionados.push({
                id: id,
                nombre: nombre, 
                precio: precio,
                cantidad: 1
            });
            
            // Guardar en localStorage
            localStorage.setItem('platosSeleccionados', JSON.stringify(platosSeleccionados));
            
            // Redirigir a la página de información del pedido
            window.location.href = 'segundocrear.php';
        }
    </script>
</head>
<body class="bg-white min-h-screen flex flex-col items-center py-8">
    <header class="w-full bg-primary text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-semibold">Carta de Platillos</h1>
    </header>

    <main class="container mx-auto px-4 py-6">
        <!-- Iconos de tipos de plato -->
        <div class="icon-menu">
            <a href="?tipo_plato=" id="all">
                <img src="../icons/todos.png" alt="Todos">
                <span class="text-secondary">TODOS</span>
            </a>
            <a href="?tipo_plato=Brasas" id="brasas">
                <img src="../icons/brasas.png" alt="Brasas">
                <span class="text-secondary">BRASAS</span>
            </a>
            <a href="?tipo_plato=Parrillas" id="parrillas">
                <img src="../icons/parilla.png" alt="Parrillas">
                <span class="text-secondary">PARRILLAS</span>
            </a>
            <a href="?tipo_plato=Fusión Criolla" id="fusion">
                <img src="../icons/criolla.png" alt="Fusión Criolla">
                <span class="text-secondary">FUSIÓN CRIOLLA</span>
            </a>
            <a href="?tipo_plato=Hamburguesas" id="hamburguesas">
                <img src="../icons/hambu.png" alt="Hamburguesas">
                <span class="text-secondary">HAMBURGUESAS</span>       
            </a>
            <a href="?tipo_plato=Piqueos" id="piqueos">
                <img src="../icons/acompañantes.png" alt="Piqueos">
                <span class="text-secondary">PIQUEOS</span>
            </a>
            <a href="?tipo_plato=Acompañamientos" id="acompanamientos">
                <img src="../icons/ax.png" alt="Acompañamientos">
                <span class="text-secondary">ACOMPAÑAMIENTOS</span>
            </a>
        </div>

        <!-- Contenedor de platos dinámicos -->
        <section id="platos-container" class="bg-white p-6 rounded-lg shadow-lg">
            <div id="platos" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (isset($platos) && $platos->num_rows > 0) { ?>
                    <?php while ($fila = $platos->fetch_assoc()) { 
                        $imagen_ruta = "../imagenes/" . htmlspecialchars($fila['imagen']);
                    ?>
                        <div class="plato-card">
                            <img src="<?php echo $imagen_ruta; ?>" alt="<?php echo htmlspecialchars($fila['Nombre']); ?>">
                            <h2 class="text-lg font-bold my-2"><?php echo htmlspecialchars($fila['Nombre']); ?></h2>
                            <p class="mb-4">S/ <?php echo htmlspecialchars($fila['precio']); ?></p>
                            <button class="btn-primary py-2 px-4 rounded-lg w-full" 
                                    onclick="seleccionarPlato('<?php echo htmlspecialchars($fila['id_plato']); ?>', '<?php echo htmlspecialchars($fila['Nombre']); ?>', '<?php echo htmlspecialchars($fila['precio']); ?>')">
                                Seleccionar
                            </button>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p class="text-red-500 font-semibold col-span-3 text-center py-4">No se encontraron platos.</p>
                <?php } ?>
            </div>
        </section>

        <div class="mt-6 flex justify-center w-full max-w-sm mx-auto">
            <a href="segundocrear.php" class="btn-secondary py-2 px-4 rounded-lg">Ver Pedido</a>
        </div>
    </main>

    <footer class="bg-primary text-white p-4 mt-auto">
        <p class="text-center">Pollería &copy; 2024</p>
    </footer>
</body>
</html>