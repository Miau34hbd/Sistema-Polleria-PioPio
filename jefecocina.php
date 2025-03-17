<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Jefe de Cocina</title>
    <style>
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #F2B705; /* Fondo amarillo dorado */
        margin: 0;
        padding: 0;
        display: flex;
        min-height: 100vh;
    }
    header {
        background: linear-gradient(135deg, #D98E04, #D97904); /* Naranja oscuro a intenso */
        color: white;
        text-align: center;
        padding: 40px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: calc(100% - 300px);
        min-height: 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }
    header h1 {
        margin: 0;
        font-size: 2.8em;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    .content-header {
        margin-top: 20px;
        font-size: 1.5em;
        font-weight: 300;
        color:rgb(240, 239, 238); /* Texto amarillo dorado */
    }
    .status-panel {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 40px;
    }
    .status-box {
        background-color: #ffffff;
        border: 2px solid #A64F03; /* Borde marrón anaranjado */
        border-radius: 12px;
        padding: 25px;
        margin: 15px;
        width: 220px;
        text-align: center;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        color: #D97904;
        transition: all 0.3s ease;
    }
    .status-box:hover {
        background-color: #f8f8f8;
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .status-box h3 {
        margin: 0 0 13px;
        font-size: 1.5em;
        color: #A64F03; /* Marrón anaranjado */
    }
    .status-box p {
        font-size: 2.2em;
        font-weight: bold;
        margin: 0;
        color: #D98E04;
    }
    .sidebar {
        background: #0C080D; /* Negro */
        color: white;
        width: 300px;
        min-height: 100vh;
        padding: 30px;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.2);
        position: relative;
    }
    .sidebar h2 {
        color: #F2B705; /* Amarillo dorado */
        font-size: 1.8em;
        margin-bottom: 30px;
        text-align: center;
        font-weight: 600;
    }
    .sidebar .nav-item {
        margin: 20px 0;
    }
    .sidebar .nav-item a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 15px;
        border-radius: 8px;
        transition: background 0.3s, padding-left 0.3s;
        position: relative;
        font-size: 1.1em;
    }
    .sidebar .nav-item a:hover {
        background-color: rgba(255, 255, 255, 0.2);
        padding-left: 35px;
    }
    </style>
</head>
<body>

<header>
    <h1>Panel del Jefe Cocina</h1>
    <div class="content-header">
        <p>Bienvenido</p>
    </div>
    <div class="status-panel">
        <div class="status-box">
       
                    <h3>Fomentar un ambiente de trabajo ordenado y eficiente</h3>
                    

        </div>
        <div class="status-box">
        <h3>Garantizar la calidad y presentación de los platillos.</h3>
        </div>

        <div class="status-box">
           <h3>Mantener siempre una actitud profesional y liderazgo con el equipo.</h3>
        </div>





    </div>
</header>

<div class="sidebar">
    <h2>Menú</h2>
    <div class="nav-item">
        <a href="views/ListarPedido.php">Lista de Pedidos</a>
    </div>
  
    <div class="nav-item">
        <a href="/NuevaPolleria/logout">Cerrar Sesión</a>
    </div>
</div>

</body>
</html>



</body>
</html>
