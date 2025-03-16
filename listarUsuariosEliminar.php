<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios para Eliminar</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($usuarios)) : ?>
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr>
                        <td><?= $usuario['id']; ?></td>
                        <td><?= $usuario['correo']; ?></td>
                        <td>
                            <form method="POST" action="/controladorUsuario/eliminar">
                                <input type="hidden" name="id" value="<?= $usuario['id']; ?>">
                                <button type="submit">Eliminar usuario</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">No hay usuarios para mostrar.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>