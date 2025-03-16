<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Empleado</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #F2B705;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #ffffff;
            border: 2px solid #A64F03;
            border-radius: 12px;
            padding: 50px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            color: #D97904;
            width: 300px;
            text-align: center;
        }
        .form-container h2 {
            color: #A64F03;
            margin-bottom: 20px;
        }
        .form-container input, .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #D98E04;
        }
        .form-container button {
            background-color: #D98E04;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
        }
        .form-container button:hover {
            background-color: #A64F03;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registrar Empleado</h2>
        <form action="../controllers/ControladorEmpleado" method="post">
            <input type="text" name="dni" placeholder="DNI" required>
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellido" placeholder="Apellido" required>
            <input type="number" name="edad" placeholder="Edad" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <input type="text" name="telefono" placeholder="Teléfono" required>
            <select name="rol" required>
                <option value="">Seleccione el Rol</option>
                <option value="Administrador">Administrador</option>
                <option value="Cajero">Cajero</option>
                <option value="Mesero">Mesero</option>
                <option value="JefeCocina">Jefe de Cocina</option>
            </select>
            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>