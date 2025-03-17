<!DOCTYPE html>
<html>
<head>
    <title>Cobrar cuenta</title>
    
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #F2B705; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
            position: relative;
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
            padding: 20px; width: 600px; 
            margin: auto; 
            border-radius: 10px; }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
            background-color:  #D97904;
            border: 3px solid #8B4513; 
        }
        th, td { 
            border: 1px solid #8B4513; 
            padding: 8px; 
            text-align: center; 
            color: #fff; 
        }
        th { 
            background-color:  #D97904; 
            padding: 10px;
            text-align: center;
            border: 1px solid #8B4513; 
            color: #0C080D;
        }
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 20px; 
            color: #fff; 
        }
        .header-right { 
            display: flex; 
            gap: 10px; 
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
        .btn-top { 
            background-color: #A64F03; 
            color: #fff; 
            border: 1px solid #fff; 
            padding: 5px 10px; 
            cursor: pointer; 
        }
        .top-right-buttons { 
            position: absolute; 
            top: 10px; 
            right: 10px; 
            display: flex; 
            gap: 10px; 
        }
        .mesa-modal, .resumen-modal, .pago-modal, .recibo-modal {
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
 
    <div class="top-right-buttons">
        <button class="btn-top">Notificaciones</button>
        <button class="btn-top">Ayuda</button>
    </div>

    <div class="container">
        <div class="header">
            <h2>Cobrar cuenta</h2>
            
        </div>
        
        <div class="actions">
            <label for="mesa">Seleccionar Mesa:</label>
            <input type="number" id="mesa" min="1" placeholder="Ingrese el número de mesa">
            <br><br>
            <button class="btn" onclick="mostrarResumen()">Resumen de pedido</button>
            <button class="btn">Cancelar</button>
        </div>
    </div>

    <div class="resumen-modal" id="resumenModal">
        <h3>Resumen del Pedido</h3>
        <p id="mesaResumen"></p>
        <p>1x Pollo a la Brasa - $60</p>
        <p>2x Gaseosa - $6</p>
        <p>1x Papas Fritas - $5</p>
        <p>Total: $71</p>
        <button class="btn" onclick="mostrarPago()">Pagar</button>
        <button class="btn" onclick="cerrarResumen()">Cancelar</button>
    </div>

    <div class="pago-modal" id="pagoModal">
        <h3>Seleccionar método de pago</h3>
        <select id="metodoPago">
            <option value="efectivo">Efectivo</option>
            <option value="yape">Yape</option>
            <option value="tarjeta">Tarjeta de crédito</option>
        </select>
        <br><br>
        <button class="btn" onclick="mostrarRecibo()">Aceptar</button>
        <button class="btn" onclick="cerrarPago()">Cancelar</button>
    </div>

    <div class="recibo-modal" id="reciboModal">
        <h3>Recibo</h3>
        <p>Mesa: <span id="reciboMesa"></span></p>
        <p>Total: $71</p>
        <button class="btn">Imprimir recibo</button>
        <button class="btn" onclick="cerrarRecibo()">Cancelar</button>
    </div>

    <script>
        function mostrarResumen() {
            const mesa = document.getElementById('mesa').value;
            if (!mesa) {
                alert('Por favor, seleccione una mesa antes de continuar.');
                return;
            }
            document.getElementById('mesaResumen').innerText = `Mesa: ${mesa}`;
            document.getElementById('resumenModal').style.display = 'block';
        }

        function cerrarResumen() {
            document.getElementById('resumenModal').style.display = 'none';
        }

        function mostrarPago() {
            cerrarResumen();
            document.getElementById('pagoModal').style.display = 'block';
        }

        function cerrarPago() {
            document.getElementById('pagoModal').style.display = 'none';
        }

        function mostrarRecibo() {
            cerrarPago();
            document.getElementById('reciboModal').style.display = 'block';
        }

        function cerrarRecibo() {
            document.getElementById('reciboModal').style.display = 'none';
        }
    </script>
</body>
</html>
