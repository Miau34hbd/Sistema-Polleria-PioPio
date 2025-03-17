<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
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
            overflow-x: auto;
        }
        .table-container {
            background-color: #ffffff;
            border: 2px solid #A64F03;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            color: #D97904;
            text-align: center;
            margin-bottom: 20px;
        }
        .table-container h1 {
            color: #A64F03;
            margin-bottom: 20px;
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
        td {
            background-color: #ffffff;
        }
        .btn-eliminar {
            background-color: #D98E04;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .btn-eliminar:hover {
            background-color: #A64F03;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="table-container">
            <h1>Lista de Usuarios</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
                <?php if (empty($usuarios)): ?>
                    <tr>
                        <td colspan="3">No hay usuarios para mostrar.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['id_usuario']) ?></td>
                            <td><?= htmlspecialchars($usuario['correo']) ?></td>
                            <td>
                                <form action="/NuevaPolleria/eliminarUsuario" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id_usuario']) ?>">
                                    <button type="submit" class="btn-eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>