<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen del Pedido</title>
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

        function modificarCantidad(tipo, indice) {
            var cantidad = prompt("Ingrese la nueva cantidad:");
            if (cantidad == null || cantidad == "" || isNaN(cantidad) || cantidad <= 0) {
                alert("Cantidad inválida.");
                return;
            }

            if (tipo === 'plato') {
                var platosSeleccionados = JSON.parse(localStorage.getItem('platosSeleccionados'));
                platosSeleccionados[indice].cantidad = parseInt(cantidad);
                localStorage.setItem('platosSeleccionados', JSON.stringify(platosSeleccionados));
            } else if (tipo === 'bebida') {
                var bebidasSeleccionadas = JSON.parse(localStorage.getItem('bebidasSeleccionadas'));
                bebidasSeleccionadas[indice].cantidad = parseInt(cantidad);
                localStorage.setItem('bebidasSeleccionadas', JSON.stringify(bebidasSeleccionadas));
            }

            // Recargar la página para reflejar los cambios
            location.reload();
        }
    </script>
</head>
<body class="bg-white min-h-screen flex flex-col items-center py-8">
    <header class="w-full bg-primary text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-semibold">Resumen del Pedido</h1>
    </header>

    <main class="container mx-auto px-4 py-6">
        <div class="bg-container p-6 rounded-lg shadow-lg w-full max-w-3xl">
            <h2 class="text-xl font-semibold mb-4">Mesa: <span id="numeroMesa" class="text-primary"></span></h2>
            <h3 class="text-lg font-semibold mb-2">Platos Seleccionados:</h3>
            <ul id="listaPlatos" class="mb-4"></ul>
            <h3 class="text-lg font-semibold mb-2">Bebidas Seleccionadas:</h3>
            <ul id="listaBebidas" class="mb-4"></ul>
            <h3 class="text-lg font-semibold mb-2">Total: S/ <span id="totalPedido" class="text-primary"></span></h3>

            <div class="flex justify-between">
                <button onclick="window.location.href='menu_platillos.php?return=segundocrear.php'" class="btn-primary hover:bg-secondary text-white py-2 px-4 rounded-lg">Agregar Platillo</button>
                <button onclick="window.location.href='menu_bebidas.php?return=segundocrear.php'" class="btn-primary hover:bg-secondary text-white py-2 px-4 rounded-lg">Agregar Bebida</button>
                <button onclick="guardarPedido()" class="btn-primary hover:bg-secondary text-white py-2 px-4 rounded-lg">Guardar</button>
                <button onclick="cancelarPedido()" class="btn-secondary hover:bg-secondary text-white py-2 px-4 rounded-lg">Cancelar</button>
            </div>
        </div>
    </main>

    <footer class="bg-primary text-white p-4 mt-auto">
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
            platosSeleccionados.forEach((plato, index) => {
                var li = document.createElement('li');
                li.innerHTML = `${plato.nombre} - S/ ${plato.precio} x ${plato.cantidad} <button onclick="modificarCantidad('plato', ${index})" class="btn-secondary hover:bg-secondary text-white py-1 px-2 rounded-lg ml-2">Modificar Cantidad</button>`;
                listaPlatos.appendChild(li);
                totalPlatos += plato.precio * plato.cantidad;
            });

            // Mostrar bebidas seleccionadas
            var bebidasSeleccionadas = JSON.parse(localStorage.getItem('bebidasSeleccionadas')) || [];
            var listaBebidas = document.getElementById('listaBebidas');
            var totalBebidas = 0;
            bebidasSeleccionadas.forEach((bebida, index) => {
                var li = document.createElement('li');
                li.innerHTML = `${bebida.nombre} - S/ ${bebida.precio} x ${bebida.cantidad} <button onclick="modificarCantidad('bebida', ${index})" class="btn-secondary hover:bg-secondary text-white py-1 px-2 rounded-lg ml-2">Modificar Cantidad</button>`;
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