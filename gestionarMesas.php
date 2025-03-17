<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Mesas</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F2B705;
            color: #0C080D;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        h1, h2 {
            color: #A64F03;
            margin: 20px 0;
        }
        form {
            background-color: #D98E04;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            display: block;
            margin: 10px 0;
            font-weight: bold;
            color: #0C080D;
            width: 100%;
            text-align: left;
        }
        input[type="number"], input[type="submit"] {
            padding: 10px;
            border: 1px solid #A64F03;
            border-radius: 5px;
            width: calc(100% - 22px);
            margin: 10px 0;
            font-size: 16px;
        }
        input[type="number"] {
            background-color: #FFFFFF;
            color: #0C080D;
        }
        input[type="submit"] {
            background-color: #A64F03;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #D97904;
        }
        table {
            width: 90%;
            max-width: 600px;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #D98E04;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #A64F03;
        }
        th {
            background-color: #A64F03;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #F2B705;
        }
        tr:nth-child(odd) {
            background-color: #D97904;
        }
        tr:hover {
            background-color: #A64F03;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Gestionar Mesas</h1>
    <form action="/NuevaPolleria/actualizarMesas" method="post">
        <label for="limite">Límite de mesas:</label>
        <input type="number" id="limite" name="limite" required>
        <input type="submit" value="Actualizar">
    </form>
    <h2>Lista de Mesas</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Número de Mesa</th>
        </tr>
        <?php if (isset($mesas) && !empty($mesas)): ?>
            <?php foreach ($mesas as $mesa): ?>
                <tr>
                    <td><?= htmlspecialchars($mesa['id_mesa']) ?></td>
                    <td><?= htmlspecialchars($mesa['numero_mesa']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">No hay mesas para mostrar.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>