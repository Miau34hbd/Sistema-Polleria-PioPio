<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nueva Pollería</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff6f61, #ff9a44); /* Degradado cálido */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9); /* Fondo semi-transparente */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-container h1 {
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
            outline: none;
            transition: border-color 0.3s ease;
        }
        .login-container input:focus {
            border-color: #ff6f61; /* Color principal */
        }
        .login-container button {
            width: 100%;
            padding: 12px;
            background: #ff6f61; /* Color principal */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .login-container button:hover {
            background: #ff4a3d; /* Color más oscuro al hacer hover */
        }
        .error-message {
            color: #ff4a3d; /* Color de error */
            margin-top: 15px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Polleria - Pio Pio</h1>
        <form action="/NuevaPolleria/login" method="POST">
            <input type="text" name="correo" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <?php if (isset($_GET['error'])): ?>
            <p class="error-message">Error: <?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>
    </div>
</body>
</html>