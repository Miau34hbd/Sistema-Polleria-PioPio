<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #F2B705; 
            color: #0C080D;
        }
        .container {
            border: 2px solid #A64F03; 
            background-color: #D98E04; 
            padding: 20px; 
            width: 600px; 
            margin: auto; 
            border-radius: 10px;
        }
        .header {
            display: flex; 
            justify-content: space-between; 
            align-items: center;
        }
        .estado {
            background-color: #D97904; 
            padding: 5px 10px; 
            border-radius: 5px;
        }
        table {
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
            background-color: #D97904;
        }
        th, td {
            border: 1px solid #A64F03; 
            padding: 8px; 
            text-align: center;
        }
        .buttons {
            display: flex; 
            justify-content: space-between; 
            margin-top: 15px;
        }
        button {
            background-color: #A64F03; 
            color: #fff; 
            border: none; 
            padding: 8px 15px; 
            cursor: pointer; 
            border-radius: 5px;
        }
    </style>
    <script>
        function enviarACocina() {
            document.getElementById("estado").innerText = "En cola";
        }
        function llamarMesero() {
            document.getElementById("estado").innerText = "Terminado";
            alert("Mensaje enviado al mesero: El pedido está listo.");
        }
        function cancelarPedido() {
            document.getElementById("estado").innerText = "Cancelado";
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Lista de pedidos</h2>
            <span>👤 Jefe de Cocina</span>
        </div>
        <table>
            <tr>
                <th>Plato</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
            <tr>
                <td>Pollo con Papas</td>
                <td>1</td>
                <td id="estado" class="estado">Pendiente</td>
                <td><button onclick="llamarMesero()">Llamar Mesero</button></td>
            </tr>
        </table>
        <div class="buttons">
            <button onclick="cancelarPedido()">Cancelar pedido</button>
            <button onclick="enviarACocina()">Enviar a Cocina</button>
        </div>
    </div>
</body>
</html>
