<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encargado del Almacén</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            display: flex;
        }
        header {
            background: linear-gradient(135deg, #007bff, #00c6ff);
            color: white;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            width: calc(100% - 250px); /* Ajustar para dejar espacio para el menú */
            min-height: 200px; /* Aumentar la altura para el panel de estado y bienvenida */
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }
        header h1 {
            margin: 0;
        }
        .content-header {
            margin-top: 20px;
            font-size: 1.5em;
        }
        .status-panel {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .status-box {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            margin: 10px;
            width: 200px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #333;
        }
        .status-box h3 {
            margin: 0 0 10px;
            font-size: 1.2em;
            color: #555;
        }
        .status-box p {
            font-size: 1.5em;
            font-weight: bold;
            margin: 0;
        }
        .sidebar {
            background: linear-gradient(180deg, #343a40 0%, #212529 100%);
            color: white;
            width: 250px;
            min-height: 100vh;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .sidebar h2 {
            color: #f8f9fa;
            font-size: 1.5em;
            margin-bottom: 20px;
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
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s, padding-left 0.3s;
            position: relative;
        }
        .sidebar .nav-item a::before {
            content: '\f105'; /* Icono de círculo */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1em;
            color: #00c6ff;
            transition: color 0.3s;
        }
        .sidebar .nav-item a:hover {
            background-color: #495057;
            padding-left: 30px;
        }
        .sidebar .nav-item a:hover::before {
            color: #ffffff;
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
    <h1>Encargado del Almacén</h1>
    <div class="content-header">
        <p>Bienvenido</p>
    </div>
    <!-- Panel de Estado en el header -->
    <div class="status-panel">
        <div class="status-box">
            <h3>Insumos Disponibles</h3>
            <p>150</p>
        </div>
        <div class="status-box">
            <h3>Solicitudes Pendientes</h3>
            <p>12</p>
        </div>
    </div>
</header>

<div class="sidebar">
    <h2>Menú</h2>
    <div class="nav-section">
        
        <div id="almacen" class="nav-section-content active">
            <div class="nav-item">
                <a href="control_entrada_insumos.html">Control de Entrada de Insumos</a>
            </div>
            <div class="nav-item">
                <a href="reporte_movimientos.html">Reporte de Movimientos y Operaciones</a>
            </div>
            <div class="nav-item">
        <a href="/NuevaPolleria/logout" >Cerrar Sesión</a> <!-- Agregamos el enlace a cerrar sesión -->
    </div>
        </div>
    </div>
</div>

<script>
    function toggleSection(id) {
        var sectionToShow = document.getElementById(id);
        var isActive = sectionToShow.classList.contains('active');
        
        // Ocultar todas las secciones
        var sections = document.querySelectorAll('.nav-section-content');
        sections.forEach(function(section) {
            section.classList.remove('active');
        });

        // Mostrar o ocultar la sección seleccionada
        if (!isActive) {
            sectionToShow.classList.add('active');
        }
    }
</script>

</body>
</html>
