<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-primary {
            background-color: #F2B705;
        }
        .bg-secondary {
            background-color: #D98E04;
        }
        .bg-tertiary {
            background-color: #D97904;
        }
        .bg-quaternary {
            background-color: #A64F03;
        }
        .hover-bg-quaternary:hover {
            background-color: #A64F03;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center py-8">
    <header class="w-full bg-primary text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-semibold">Lista de Pedidos</h1>
    </header>

    <main class="container mx-auto px-4 py-6">
        <table class="w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr class="bg-secondary text-left">
                    <th class="py-2 px-4">ID Pedido</th>
                    <th class="py-2 px-4">Mesa</th>
                    <th class="py-2 px-4">Estado</th>
                    <th class="py-2 px-4">Acciones</th>
                </tr>
            </thead>
            <tbody id="listaPedidos">
                <!-- Aquí se llenarán los pedidos dinámicamente -->
            </tbody>
        </table>
    </main>

    <footer class="bg-quaternary text-white p-4 mt-auto">
        <p class="text-center">Pollería &copy; 2024</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetch('../controllers/PedidoController.php?action=list')
                .then(response => response.json())
                .then(data => {
                    const listaPedidos = document.getElementById('listaPedidos');
                    data.pedidos.forEach(pedido => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td class="py-2 px-4">${pedido.id_pedido}</td>
                            <td class="py-2 px-4">${pedido.numero_mesa}</td>
                            <td class="py-2 px-4">${pedido.estado}</td>
                            <td class="py-2 px-4">
                                <button onclick="editarPedido(${pedido.id_pedido})" class="bg-tertiary hover-bg-quaternary text-white py-1 px-2 rounded">Editar pedido</button>
                                <button onclick="anularPedido(${pedido.id_pedido})" class="bg-secondary hover-bg-quaternary text-white py-1 px-2 rounded">Anular</button>
                            </td>
                        `;
                        listaPedidos.appendChild(tr);
                    });
                });
        });

        function editarPedido(idPedido) {
            window.location.href = `editar_pedido.php?id=${idPedido}`;
        }

        function anularPedido(idPedido) {
            // Implementar lógica para anular el pedido
        }
    </script>
</body>
</html>