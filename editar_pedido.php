<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center py-8">
    <header class="w-full bg-indigo-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-semibold">Editar Pedido</h1>
    </header>

    <main class="container mx-auto px-4 py-6">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl">
            <form id="editarPedidoForm">
                <input type="hidden" id="idPedido" name="idPedido">
                <input type="hidden" id="mesa" name="mesa">
                
                <div id="detallesPedido" class="mb-4">
                    <!-- Aquí se llenarán los detalles del pedido dinámicamente -->
                </div>

                <div class="flex justify-between mb-4">
                    <button type="button" onclick="agregarPlatillo()" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">Agregar Platillo</button>
                    <button type="button" onclick="agregarBebida()" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">Agregar Bebida</button>
                </div>

                <div class="flex justify-between">
                    <button type="button" onclick="guardarModificaciones()" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">Guardar Modificaciones</button>
                    <button type="button" onclick="cancelarModificaciones()" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg">Cancelar</button>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-indigo-600 text-white p-4 mt-auto">
        <p class="text-center">Pollería &copy; 2024</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const idPedido = urlParams.get('id');
            document.getElementById('idPedido').value = idPedido;

            fetch(`../controllers/PedidoEdicionController.php?action=get&id=${idPedido}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('mesa').value = data.pedido.mesa;
                    const detallesPedido = document.getElementById('detallesPedido');
                    data.detalles.forEach(detalle => {
                        const div = document.createElement('div');
                        div.innerHTML = `
                            <input type="hidden" name="idDetalle[]" value="${detalle.id_detalle}">
                            <div class="mb-4">
                                <label for="nombre_${detalle.id_detalle}" class="block text-gray-700 font-bold mb-2">Nombre:</label>
                                <input type="text" id="nombre_${detalle.id_detalle}" name="nombre[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="${detalle.nombre_producto}" readonly>
                            </div>
                            <div class="mb-4">
                                <label for="cantidad_${detalle.id_detalle}" class="block text-gray-700 font-bold mb-2">Cantidad:</label>
                                <input type="number" id="cantidad_${detalle.id_detalle}" name="cantidad[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="${detalle.cantidad}" required>
                            </div>
                            <div class="flex justify-end mb-4">
                                <button type="button" onclick="eliminarDetalle(${detalle.id_detalle})" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg">Eliminar</button>
                            </div>
                        `;
                        detallesPedido.appendChild(div);
                    });
                });
        });

        function agregarPlatillo() {
            const formData = new FormData(document.getElementById('editarPedidoForm'));
            localStorage.setItem('editarPedidoForm', JSON.stringify(Object.fromEntries(formData.entries())));
            window.location.href = `menu_platillos.php?return=editar_pedido.php&id=${document.getElementById('idPedido').value}`;
        }

        function agregarBebida() {
            const formData = new FormData(document.getElementById('editarPedidoForm'));
            localStorage.setItem('editarPedidoForm', JSON.stringify(Object.fromEntries(formData.entries())));
            window.location.href = `menu_bebidas.php?return=editar_pedido.php&id=${document.getElementById('idPedido').value}`;
        }

        function eliminarDetalle(idDetalle) {
            // Implementar lógica para eliminar el detalle del pedido
        }

        function guardarModificaciones() {
            const formData = new FormData(document.getElementById('editarPedidoForm'));
            fetch('../controllers/PedidoEdicionController.php?action=update', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('El pedido ha sido modificado');
                    window.location.href = 'lista_pedidos.php';
                } else {
                    alert('Error al modificar el pedido');
                }
            });
        }

        function cancelarModificaciones() {
            window.location.href = 'lista_pedidos.php';
        }

        // Restaurar datos del formulario al volver de agregar platillo o bebida
        document.addEventListener('DOMContentLoaded', () => {
            const savedForm = localStorage.getItem('editarPedidoForm');
            if (savedForm) {
                const formData = JSON.parse(savedForm);
                for (const [key, value] of Object.entries(formData)) {
                    if (document.getElementById(key)) {
                        document.getElementById(key).value = value;
                    }
                }
                localStorage.removeItem('editarPedidoForm');
            }
        });
    </script>
</body>
</html>