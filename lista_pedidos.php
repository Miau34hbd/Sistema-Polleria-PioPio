<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center py-8">
    <header class="w-full bg-indigo-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-semibold">Lista de Pedidos</h1>
    </header>

    <main class="container mx-auto px-4 py-6">
        <table class="w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-left">
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

    <footer class="bg-indigo-600 text-white p-4 mt-auto">
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
                                <button onclick="editarPedido(${pedido.id_pedido})" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded">Editar pedido</button>
                                <button onclick="confirmarAnulacion(${pedido.id_pedido})" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded">Anular</button>
                            </td>
                        `;
                        listaPedidos.appendChild(tr);
                    });
                });
        });

        function editarPedido(idPedido) {
            window.location.href = `editar_pedido.php?id=${idPedido}`;
        }

        function confirmarAnulacion(idPedido) {
            const confirmar = confirm("¿Está seguro que desea anular el pedido?");
            if (confirmar) {
                anularPedido(idPedido);
            }
        }

        function anularPedido(idPedido) {
            fetch(`../controllers/PedidoController.php?action=anular&id=${idPedido}`, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Pedido anulado');
                    window.location.reload();
                } else {
                    alert('Error al anular el pedido');
                }
            });
        }
    </script>
</body>
</html>