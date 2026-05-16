<?php

declare(strict_types=1);

require_once __DIR__ . '/db.php';

$errores = [];
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmarPassword = $_POST['confirmar_password'] ?? '';

    if ($nombre === '') {
        $errores[] = 'El nombre es obligatorio.';
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Ingresa un correo electronico valido.';
    }

    if (strlen($password) < 6) {
        $errores[] = 'La contrasena debe tener al menos 6 caracteres.';
    }

    if ($password !== $confirmarPassword) {
        $errores[] = 'Las contrasenas no coinciden.';
    }

    if ($errores === []) {
        try {
            $pdo = conectarPDO();

            $consulta = $pdo->prepare('SELECT id FROM usuarios WHERE email = :email LIMIT 1');
            $consulta->execute(['email' => $email]);

            if ($consulta->fetch()) {
                $errores[] = 'Ese correo ya esta registrado.';
            } else {
                $insertar = $pdo->prepare(
                    'INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)'
                );

                $insertar->execute([
                    'nombre' => $nombre,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                ]);

                $mensaje = 'Usuario registrado correctamente.';
                $_POST = [];
            }
        } catch (PDOException $e) {
            $errores[] = 'No fue posible guardar el usuario: ' . $e->getMessage();
        }
    }
}

try {
    $pdo = conectarPDO();
    $usuarios = $pdo->query(
        'SELECT id, nombre, email, creado_en FROM usuarios ORDER BY creado_en DESC'
    )->fetchAll();
} catch (PDOException $e) {
    $usuarios = [];
    $errores[] = 'No fue posible consultar los usuarios: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <style>
        :root {
            color-scheme: light;
            --bg: #f4efe6;
            --panel: #fffaf3;
            --primary: #0f766e;
            --primary-dark: #134e4a;
            --text: #1f2937;
            --danger: #b91c1c;
            --success: #166534;
            --border: #d6d3d1;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            background:
                radial-gradient(circle at top left, #fcd34d 0, transparent 22%),
                linear-gradient(135deg, #f4efe6, #dbeafe);
            color: var(--text);
            min-height: 100vh;
            padding: 24px;
        }

        .contenedor {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .tarjeta {
            background: rgba(255, 250, 243, 0.95);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.12);
        }

        h1, h2 {
            margin-top: 0;
        }

        p {
            line-height: 1.5;
        }

        form {
            display: grid;
            gap: 14px;
        }

        label {
            display: grid;
            gap: 6px;
            font-weight: 700;
        }

        input {
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 12px;
            font-size: 1rem;
        }

        button {
            border: 0;
            border-radius: 999px;
            padding: 13px 18px;
            font-size: 1rem;
            font-weight: 700;
            background: var(--primary);
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background: var(--primary-dark);
        }

        .mensaje,
        .errores {
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 16px;
        }

        .mensaje {
            background: #dcfce7;
            color: var(--success);
        }

        .errores {
            background: #fee2e2;
            color: var(--danger);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 10px;
            border-bottom: 1px solid #e7e5e4;
            text-align: left;
        }

        th {
            color: var(--primary-dark);
        }

        .nota {
            font-size: 0.95rem;
            color: #57534e;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <section class="tarjeta">
            <h1>Registro de usuarios</h1>
            <p>Crea usuarios usando <strong>PHP</strong>, <strong>MySQL</strong> y <strong>PDO</strong>.</p>

            <?php if ($mensaje !== ''): ?>
                <div class="mensaje"><?= htmlspecialchars($mensaje) ?></div>
            <?php endif; ?>

            <?php if ($errores !== []): ?>
                <div class="errores">
                    <strong>Revisa lo siguiente:</strong>
                    <ul>
                        <?php foreach ($errores as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="">
                <label>
                    Nombre
                    <input
                        type="text"
                        name="nombre"
                        value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>"
                        required
                    >
                </label>

                <label>
                    Correo electronico
                    <input
                        type="email"
                        name="email"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        required
                    >
                </label>

                <label>
                    Contrasena
                    <input type="password" name="password" required>
                </label>

                <label>
                    Confirmar contrasena
                    <input type="password" name="confirmar_password" required>
                </label>

                <button type="submit">Registrar usuario</button>
            </form>

            <p class="nota">
                Configura tus credenciales en <code>config.php</code> si tu instalacion de MAMP usa
                un usuario o contrasena diferente.
            </p>
        </section>

        <section class="tarjeta">
            <h2>Usuarios registrados</h2>

            <?php if ($usuarios === []): ?>
                <p>No hay usuarios registrados todavia.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars((string) $usuario['id']) ?></td>
                                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                                <td><?= htmlspecialchars($usuario['email']) ?></td>
                                <td><?= htmlspecialchars($usuario['creado_en']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
