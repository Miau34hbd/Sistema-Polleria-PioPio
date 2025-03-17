<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Caja</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #F2B705; color: #0C080D; }
        .container { border: 2px solid #A64F03; background-color: #D98E04; padding: 20px; width: 600px; margin: auto; border-radius: 10px; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .estado { background-color: #D97904; padding: 5px 10px; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #D97904; }
        th, td { border: 1px solid #A64F03; padding: 8px; text-align: center; }
        .buttons { display: flex; justify-content: space-between; margin-top: 15px; }
        button { background-color: #A64F03; color: #fff; border: none; padding: 8px 15px; cursor: pointer; border-radius: 5px; }
        .welcome { text-align: center; margin-bottom: 10px; font-weight: bold; }
        .top-right { position: absolute; top: 10px; right: 10px; display: flex; gap: 10px; }
        .popup { display: none; position: absolute; top: 40px; right: 10px; border: 1px solid #A64F03; background: #D97904; color: #fff; padding: 10px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2); border-radius: 5px; }
    </style>
           <H1> <div class="welcome">Bienvenido Al Sistema De Cajero</div> </H1>

    <script>
        function togglePopup(id) {
            const popup = document.getElementById(id);
            popup.style.display = popup.style.display === 'none' ? 'block' : 'none';
        }

        function checkEstado() {
            const estado = document.getElementById('estado');
            if (estado.value === 'aperturado') {
                alert('Cajero abierto');
                estado.value = 'aperturado';
            }
        }

        function calcularTotal() {
            let total = 0;
            const filas = document.querySelectorAll('tbody tr');
            filas.forEach(fila => {
                const valor = parseFloat(fila.cells[1].textContent);
                const cantidad = parseFloat(fila.cells[2].querySelector('input').value) || 0;
                total += valor * cantidad;
            });
            document.getElementById('total').value = total.toFixed(2);
        }

        function abrirCaja() {
            const estado = document.getElementById('estado');
            if (estado.value === 'sin_apertura') {
                alert('Se ha abierto la caja exitosamente');
                estado.value = 'aperturado';
            }
        }
    </script>
</head>
<body>
    <div class="top-right">
        <button onclick="togglePopup('notificaciones')">Notificaciones</button>
        <button onclick="togglePopup('ayuda')">Ayuda</button>
    </div>

    <div id="notificaciones" class="popup">Aquí van las notificaciones.</div>
    <div id="ayuda" class="popup">Aquí puedes encontrar ayuda sobre el sistema.</div>

    <div class="container">
        <div class="header">
           
            <div>
                <label for="estado">Estado:</label>
                <select id="estado">
                    <option value="sin_apertura">Sin Aperturar</option>
                    <option value="aperturado">Aperturado</option>
                </select>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Billete</td><td>200</td><td><input type="number" onchange="calcularTotal()"></td></tr>
                <tr><td>Billete</td><td>100</td><td><input type="number" onchange="calcularTotal()"></td></tr>
                <tr><td>Billete</td><td>50</td><td><input type="number" onchange="calcularTotal()"></td></tr>
                <tr><td>Billete</td><td>20</td><td><input type="number" onchange="calcularTotal()"></td></tr>
                <tr><td>Billete</td><td>10</td><td><input type="number" onchange="calcularTotal()"></td></tr>
                <tr><td>Moneda</td><td>5</td><td><input type="number" onchange="calcularTotal()"></td></tr>
                <tr><td>Moneda</td><td>2</td><td><input type="number" onchange="calcularTotal()"></td></tr>
                <tr><td>Moneda</td><td>1</td><td><input type="number" onchange="calcularTotal()"></td></tr>
                <tr><td>Moneda</td><td>0.5</td><td><input type="number" onchange="calcularTotal()"></td></tr>
            </tbody>
        </table>

        <div style="margin-top: 10px; text-align: right;">
            <label for="total">Total:</label>
            <input type="text" id="total" readonly>
        </div>

        <div class="buttons">
            <button onclick="abrirCaja()">Aceptar</button>
            <button>Cancelar</button>
        </div>
    </div>
</body>
</html>
