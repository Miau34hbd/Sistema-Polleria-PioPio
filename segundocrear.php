<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen del Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function guardarPedido() {
            // Obtener datos del pedido
            var numeroMesa = localStorage.getItem('numeroMesa');
            var platosSeleccionados = localStorage.getItem('platosSeleccionados');
            var bebidasSeleccionadas = localStorage.getItem('bebidasSeleccionadas');

            // Asegurarse de que los datos estén en formato JSON
            platosSeleccionados = platosSeleccionados ? JSON.parse(platosSeleccionados) : [];
            bebidasSeleccionadas = bebidasSeleccionadas ? JSON.parse(bebidasSeleccionadas) : [];

            console.log("Datos enviados: ", {
                mesa: numeroMesa,
                platos: platosSeleccionados,
                bebidas: bebidasSeleccionadas
            });

            // Enviar datos al servidor
            fetch('../controllers/PedidoController.php?action=save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    mesa: numeroMesa,
                    platos: platosSeleccionados,
                    bebidas: bebidasSeleccionadas
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Pedido guardado correctamente');
                    localStorage.removeItem('numeroMesa');
                    localStorage.removeItem('platosSeleccionados');
                    localStorage.removeItem('bebidasSeleccionadas');
                    window.location.href = 'crearpedido.php';
                } else {
                    alert('Error al guardar el pedido');
                    console.error('Detalles del error:', data.error);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Error al guardar el pedido');
            });
        }

        function cancelarPedido() {
            localStorage.removeItem('numeroMesa');
            localStorage.removeItem('platosSeleccionados');
            localStorage.removeItem('bebidasSeleccionadas');
            window.location.href = 'crearpedido.php';
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center py-8">
    <header class="w-full bg-indigo-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-semibold">Resumen del Pedido</h1>
    </header>

    <main class="container mx-auto px-4 py-6">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl">
            <h2 class="text-xl font-semibold mb-4">Mesa: <span id="numeroMesa"></span></h2>
            <h3 class="text-lg font-semibold mb-2">Platos Seleccionados:</h3>
            <ul id="listaPlatos" class="mb-4"></ul>
            <h3 class="text-lg font-semibold mb-2">Bebidas Seleccionadas:</h3>
            <ul id="listaBebidas" class="mb-4"></ul>
            <h3 class="text-lg font-semibold mb-2">Total: S/ <span id="totalPedido"></span></h3>

            <div class="flex justify-between">
                <button onclick="window.location.href='menu_platillos.php?return=segundocrear.php'" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">Agregar Platillo</button>
                <button onclick="window.location.href='menu_bebidas.php?return=segundocrear.php'" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">Agregar Bebida</button>
                <button onclick="guardarPedido()" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">Guardar</button>
                <button onclick="cancelarPedido()" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg">Cancelar</button>
            </div>
        </div>
    </main>

    <footer class="bg-indigo-600 text-white p-4 mt-auto">
        <p class="text-center">Pollería &copy; 2024</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mostrar número de mesa
            document.getElementById('numeroMesa').innerText = localStorage.getItem('numeroMesa');

            // Mostrar platos seleccionados
            var platosSeleccionados = JSON.parse(localStorage.getItem('platosSeleccionados')) || [];
            var listaPlatos = document.getElementById('listaPlatos');
            var totalPlatos = 0;
            platosSeleccionados.forEach(plato => {
                var li = document.createElement('li');
                li.innerText = `${plato.nombre} - S/ ${plato.precio} x ${plato.cantidad}`;
                listaPlatos.appendChild(li);
                totalPlatos += plato.precio * plato.cantidad;
            });

            // Mostrar bebidas seleccionadas
            var bebidasSeleccionadas = JSON.parse(localStorage.getItem('bebidasSeleccionadas')) || [];
            var listaBebidas = document.getElementById('listaBebidas');
            var totalBebidas = 0;
            bebidasSeleccionadas.forEach(bebida => {
                var li = document.createElement('li');
                li.innerText = `${bebida.nombre} - S/ ${bebida.precio} x ${bebida.cantidad}`;
                listaBebidas.appendChild(li);
                totalBebidas += bebida.precio * bebida.cantidad;
            });

            // Calcular y mostrar total
            var totalPedido = totalPlatos + totalBebidas;
            document.getElementById('totalPedido').innerText = totalPedido.toFixed(2);
        });
    </script>
</body>
</html>