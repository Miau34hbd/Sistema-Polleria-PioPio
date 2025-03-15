<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <!-- Formulario de selección -->
    <div class="bg-white p-6 rounded-lg shadow-md max-w-sm w-full">
        <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Seleccionar</h2>
        
        <div class="mb-4">
            <label for="mesa" class="block text-gray-700 font-bold mb-2">Elegir N° de mesa:</label>
            <input type="number" id="mesa" name="mesa" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-6">
            <label for="carta" class="block text-gray-700 font-bold mb-2">Elegir carta:</label>
            <select id="carta" name="carta" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="platillos">Platillos</option>
                <option value="bebidas">Bebidas</option>
            </select>
        </div>

        <div class="flex justify-between">
            <button onclick="window.location.href='mesero.php'" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg">Cancelar</button>
            <button onclick="redirigirMenu()" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">Aceptar</button>
        </div>
    </div>

</body>
</html>
