<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
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
            padding: 25px;
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
        .table-container {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #A64F03;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registrar Usuario</h2>
        <form action="/NuevaPolleria/registrarUsuario" method="post">
            <select name="id_empleado" required>
                <option value="">Seleccione el Empleado</option>
                <?php
                require_once __DIR__ . '/../models/Empleado.php';
                $empleado = new Empleado();
                $empleados = $empleado->obtenerEmpleados();
                foreach ($empleados as $emp) {
                    echo "<option value='{$emp['id_empleado']}'>{$emp['nombre']} {$emp['apellido']} - {$emp['rol']}</option>";
                }
                ?>
            </select>
            <input type="text" name="correo" placeholder="Correo" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            <button type="submit">Registrar</button>
        </form>
        <div class="table-container">
            <h2>Lista de Empleados</h2>
            <table>
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Edad</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($empleados as $emp) {
                        echo "<tr>
                            <td>{$emp['dni']}</td>
                            <td>{$emp['nombre']}</td>
                            <td>{$emp['apellido']}</td>
                            <td>{$emp['edad']}</td>
                            <td>{$emp['direccion']}</td>
                            <td>{$emp['telefono']}</td>
                            <td>{$emp['rol']}</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>