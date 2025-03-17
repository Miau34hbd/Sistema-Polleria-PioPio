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
            flex-direction: column;
        }
        .container {
            width: 90%;
            margin-top: 20px;
            overflow-x: auto; /* Permitir desplazamiento horizontal */
        }
        .form-container, .table-container {
            background-color: #ffffff;
            border: 2px solid #A64F03;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            color: #D97904;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container h2, .table-container h2 {
            color: #A64F03;
            margin-bottom: 20px;
        }
        .form-container input, .form-container select, .table-container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #D98E04;
        }
        .form-container button, .table-container button {
            background-color: #D98E04;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .form-container button:hover, .table-container button:hover {
            background-color: #A64F03;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #A64F03;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #D98E04;
            color: white;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            border: 1px solid #888;
            width: 80%;
            padding: 20px;
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once __DIR__ . '/../models/Empleado.php';
                    $empleado = new Empleado();
                    $empleados = $empleado->obtenerEmpleados();
                    foreach ($empleados as $emp) {
                        echo "<tr>
                            <td>{$emp['dni']}</td>
                            <td>{$emp['nombre']}</td>
                            <td>{$emp['apellido']}</td>
                            <td>{$emp['edad']}</td>
                            <td>{$emp['direccion']}</td>
                            <td>{$emp['telefono']}</td>
                            <td>{$emp['rol']}</td>";
                        if ($emp['tiene_credenciales'] == 0) {
                            echo "<td><button onclick='abrirModal({$emp['id_empleado']})'>Generar Credenciales</button></td>";
                        } else {
                            echo "<td>Credenciales Generadas</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="modal" class="modal">
            <div class="modal-content">
                <span onclick="cerrarModal()" style="color:red;float:right;font-size:25px;cursor:pointer">&times;</span>
                <h2>Generar Credenciales</h2>
                <form id="generarCredencialesForm">
                    <input type="hidden" name="id_empleado" id="modalIdEmpleado">
                    <input type="text" name="correo" placeholder="Correo" required>
                    <input type="password" name="contraseña" placeholder="Contraseña" required>
                    <button type="submit">Generar</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function abrirModal(idEmpleado) {
            document.getElementById('modalIdEmpleado').value = idEmpleado;
            document.getElementById('modal').style.display = 'block';
        }

        function cerrarModal() {
            document.getElementById('modal').style.display = 'none';
        }

        document.getElementById('generarCredencialesForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar el envío del formulario

            const formData = new FormData(this);

            fetch('/NuevaPolleria/registrarUsuario', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Mostrar mensaje emergente
                if (data.success) {
                    cerrarModal();
                    location.reload(); // Recargar la página para actualizar la tabla
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>