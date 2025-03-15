<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Cocina</title>
    
    <style>
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #f4f4f4; /* Fondo claro y neutro */
        margin: 0;
        padding: 0;
        display: flex;
        min-height: 100vh;
    }
    header {
        background: linear-gradient(135deg, #333333, #555555); /* Degradado oscuro y elegante */
        color: white;
        text-align: center;
        padding: 40px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: calc(100% - 300px); /* Ajuste para el menú lateral */
        min-height: 240px;
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
        color: #e0e0e0; /* Texto más claro */
    }
    .status-panel {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 40px;
    }
    .status-box {
        background-color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 25px;
        margin: 15px;
        width: 220px;
        text-align: center;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        color: #333;
        transition: all 0.3s ease;
    }
    .status-box:hover {
        background-color: #f8f8f8;
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .status-box h3 {
        margin: 0 0 15px;
        font-size: 1.4em;
        color: #555555; /* Color oscuro y elegante */
    }
    .status-box p {
        font-size: 2.2em;
        font-weight: bold;
        margin: 0;
        color: #333;
    }
    .sidebar {
        background: linear-gradient(180deg, #222222, #333333); /* Degradado oscuro */
        color: white;
        width: 300px;
        min-height: 100vh;
        padding: 30px;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.2);
        position: relative;
    }
    .sidebar h2 {
        color: #ffffff;
        font-size: 1.8em;
        margin-bottom: 30px;
        text-align: center;
        font-weight: 600;
    }
    .sidebar .nav-section {
        margin-bottom: 20px;
    }
    .sidebar .nav-section h3 {
        color: #f8f9fa;
        margin-top: 20px;
        font-size: 1.2em;
        cursor: pointer;
        position: relative;
        padding-left: 30px;
    }
    .sidebar .nav-section h3::before {
        content: '\f078'; /* Icono de flecha hacia abajo */
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 0;
        font-size: 1.2em;
        color: #f8f9fa;
        transition: transform 0.3s;
    }
    .sidebar .nav-section h3.active::before {
        transform: rotate(180deg);
    }
    .sidebar .nav-item {
        margin: 10px 0;
        padding-left: 20px;
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
    .sidebar .nav-item a::before {
        content: '\f054'; /* Icono de flecha */
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.9em;
        color: #ffffff;
        transition: color 0.3s;
    }
    .sidebar .nav-item a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        padding-left: 35px;
    }
    .sidebar .nav-item a:hover::before {
        color: #ff6f61; /* Toque de color vibrante */
    }
    .nav-section-content {
        display: none;
    }
    .nav-section-content.active {
        display: block;
    }
</style><style>
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #f4f4f4; /* Fondo claro y neutro */
        margin: 0;
        padding: 0;
        display: flex;
        min-height: 100vh;
    }
    header {
        background: linear-gradient(135deg, #333333, #555555); /* Degradado oscuro y elegante */
        color: white;
        text-align: center;
        padding: 40px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: calc(100% - 300px); /* Ajuste para el menú lateral */
        min-height: 240px;
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
        color: #e0e0e0; /* Texto más claro */
    }
    .status-panel {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 40px;
    }
    .status-box {
        background-color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 25px;
        margin: 15px;
        width: 220px;
        text-align: center;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        color: #333;
        transition: all 0.3s ease;
    }
    .status-box:hover {
        background-color: #f8f8f8;
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .status-box h3 {
        margin: 0 0 15px;
        font-size: 1.4em;
        color: #555555; /* Color oscuro y elegante */
    }
    .status-box p {
        font-size: 2.2em;
        font-weight: bold;
        margin: 0;
        color: #333;
    }
    .sidebar {
        background: linear-gradient(180deg, #222222, #333333); /* Degradado oscuro */
        color: white;
        width: 300px;
        min-height: 100vh;
        padding: 30px;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.2);
        position: relative;
    }
    .sidebar h2 {
        color: #ffffff;
        font-size: 1.8em;
        margin-bottom: 30px;
        text-align: center;
        font-weight: 600;
    }
    .sidebar .nav-section {
        margin-bottom: 20px;
    }
    .sidebar .nav-section h3 {
        color: #f8f9fa;
        margin-top: 20px;
        font-size: 1.2em;
        cursor: pointer;
        position: relative;
        padding-left: 30px;
    }
    .sidebar .nav-section h3::before {
        content: '\f078'; /* Icono de flecha hacia abajo */
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 0;
        font-size: 1.2em;
        color: #f8f9fa;
        transition: transform 0.3s;
    }
    .sidebar .nav-section h3.active::before {
        transform: rotate(180deg);
    }
    .sidebar .nav-item {
        margin: 10px 0;
        padding-left: 20px;
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
    .sidebar .nav-item a::before {
        content: '\f054'; /* Icono de flecha */
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.9em;
        color: #ffffff;
        transition: color 0.3s;
    }
    .sidebar .nav-item a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        padding-left: 35px;
    }
    .sidebar .nav-item a:hover::before {
        color: #ff6f61; /* Toque de color vibrante */
    }
    .nav-section-content {
        display: none;
    }
    .nav-section-content.active {
        display: block;
    }
</style>
    <!-- Incluye FontAwesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<header>
    <h1>Panel de Cocina</h1>
    <div class="content-header">
        <p>Bienvenido </p>
    </div>
    <!-- Panel de Estado en el header -->
    <div class="status-panel">
        <div class="status-box">
            <h3>Pedidos Pendientes</h3>
            <p>45</p>
        </div>
        <div class="status-box">
            <h3>Pedidos Preparados</h3>
            <p>30</p>
        </div>
    </div>
</header>

<div class="sidebar">
    <h2>Menú</h2>
  

            <div class="nav-item">
                <a href="lista_pedidos.html">Lista de Pedidos</a>
            </div>
          
            <div class="nav-item">
                <a href="solicitar_insumos.html">Solicitar Insumos</a>
            </div>
            <div class="nav-item">
        <a href="/NuevaPolleria/logout" >Cerrar Sesión</a> <!-- Agregamos el enlace a cerrar sesión -->
    </div>
        </div>
    </div>
</div>



</body>
</html>
