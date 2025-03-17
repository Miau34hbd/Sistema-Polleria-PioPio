<!DOCTYPE html>
<html>
<head>
    <title>Cerrar Caja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F2B705;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }
        .title-bar {
            width: 100%;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            font-size: 28px;
            font-weight: bold;
        }
        .container {
            border: 2px solid #A64F03;
            background-color: #D98E04;
            padding: 20px;
            width: 80%;
            max-width: 1000px;
            margin: auto;
            border-radius: 10px;
            position: relative;
        }
        .estado-container {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #D97904;
            border: 3px solid #8B4513;
        }
        th, td {
            border: 1px solid #8B4513;
            padding: 8px;
            text-align: center;
            color: #fff;
        }
        th {
            background-color: #8B4513;
            color: #fff;
        }
        .actions {
            margin-top: 20px;
            text-align: center;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            background-color: #A64F03;
            color: #fff;
        }
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border: 2px solid #8B4513;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="title-bar">Cerrar Caja</div>

    <div class="container">
        <div class="estado-container">
            <label for="estado">Estado:</label>
            <select id="estado">
                <option value="aperturado">Aperturado</option>
                <option value="sin_aperturar">Sin aperturar</option>
            </select>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Método de Pago</th>
                    <th>Mesa</th>
                    <th>Mesero</th>
                    <th>Total a Pagar</th>
                    <th>Pago</th>
                    <th>Vuelto</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Efectivo</td>
                    <td>5</td>
                    <td>Juan</td>
                    <td>71</td>
                    <td>80</td>
                    <td>9</td>
                </tr>
                <tr>
                    <td>Yape</td>
                    <td>8</td>
                    <td>Pedro</td>
                    <td>120</td>
                    <td>120</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>Efectivo</td>
                    <td>6</td>
                    <td>Pedro</td>
                    <td>50.5</td>
                    <td>51</td>
                    <td>0.5</td>
                </tr>
                <tr>
                    <td>Efectivo</td>
                    <td>4</td>
                    <td>Juan</td>
                    <td>60</td>
                    <td>60</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>Yape</td>
                    <td>3</td>
                    <td>Juan</td>
                    <td>100</td>
                    <td>100</td>
                    <td>0</td>
                </tr>
            </tbody>
        </table>

        <div class="actions">
            <button class="btn" onclick="mostrarModal('Reporte generado con éxito')">Imprimir reporte</button>
            <button class="btn" onclick="mostrarModal('Caja cerrada con éxito', true)">Cerrar</button>
            <button class="btn">Cancelar</button>
        </div>
    </div>

    <div class="modal" id="modalMensaje">
        <p id="mensajeTexto"></p>
        <button class="btn" onclick="cerrarModal()">Aceptar</button>
    </div>

    <script>
        function mostrarModal(texto, cerrarCaja = false) {
            const mensajeTexto = document.getElementById('mensajeTexto');
            const modalMensaje = document.getElementById('modalMensaje');
            mensajeTexto.textContent = texto;
            modalMensaje.style.display = 'block';

            if (cerrarCaja) {
                document.getElementById('estado').value = 'sin_aperturar';
            }
        }

        function cerrarModal() {
            document.getElementById('modalMensaje').style.display = 'none';
        }
    </script>
</body>
</html>
