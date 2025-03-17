<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-primary {
            background-color: #D97904;
        }

        .text-primary {
            color: #0C080D;
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

        .bg-container {
            background-color: #F2B705;
        }

        .text-container {
            color: #0C080D;
        }
    </style>
    <script>
        function redirigirMenu() {
            var cartaSeleccionada = document.getElementById('carta').value;
            var numeroMesa = document.getElementById('mesa').value;
            
            // Guardar número de mesa en localStorage
            if (numeroMesa) {
                localStorage.setItem('numeroMesa', numeroMesa);
            }
            
            // Limpiar selecciones anteriores
            localStorage.removeItem('platosSeleccionados');
            localStorage.removeItem('bebidasSeleccionadas');
            
            if (cartaSeleccionada === 'platillos') {
                window.location.href = 'menu_platillos.php';
            } else if (cartaSeleccionada === 'bebidas') {
                window.location.href = 'menu_bebidas.php';
            }
        }
    </script>
</head>
<body class="bg-white min-h-screen flex items-center justify-center">

    <!-- Formulario de selección -->
    <div class="bg-container p-6 rounded-lg shadow-md max-w-sm w-full">
        <h2 class="text-2xl font-semibold text-center text-primary mb-6">Seleccionar</h2>
        
        <div class="mb-4">
            <label for="mesa" class="block text-primary font-bold mb-2">Elegir N° de mesa:</label>
            <input type="number" id="mesa" name="mesa" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" required>
        </div>

        <div class="mb-6">
            <label for="carta" class="block text-primary font-bold mb-2">Elegir carta:</label>
            <select id="carta" name="carta" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" required>
                <option value="platillos">Platillos</option>
                <option value="bebidas">Bebidas</option>
            </select>
        </div>

        <div class="flex justify-between">
            <button onclick="window.location.href='mesero.php'" class="btn-secondary hover:bg-secondary text-white py-2 px-4 rounded-lg">Cancelar</button>
            <button onclick="redirigirMenu()" class="btn-primary hover:bg-secondary text-white py-2 px-4 rounded-lg">Aceptar</button>
        </div>
    </div>

</body>
</html>